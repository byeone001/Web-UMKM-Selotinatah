<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Umkm;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Produk::with('umkm');

        if ($request->filled('search')) {
            $query->where('nama_produk', 'like', '%' . $request->search . '%')
                ->orWhereHas('umkm', function($q) use ($request) {
                    $q->where('nama_umkm', 'like', '%' . $request->search . '%')
                      ->orWhere('pemilik', 'like', '%' . $request->search . '%');
                });
        }

        $produks = $query->latest()->paginate(10)->withQueryString();

        return view('admin.produk.index', compact('produks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $umkms = Umkm::orderBy('nama_umkm', 'asc')->get();
        $umkm = $umkms; // Alias for backward compatibility
        return view('admin.produk.create', compact('umkms', 'umkm'))->withTitle('Tambah Produk');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_umkm'     => 'required|exists:umkms,id_umkm',
            'nama_produk' => 'required|string|max:100',
            'harga'       => 'required|numeric|min:0',
            'deskripsi'   => 'nullable|string',
            'foto'        => 'nullable|image|mimes:png,jpg,jpeg,webp|max:5120',
        ], [
            'id_umkm.required'     => 'Silakan pilih UMKM pemilik produk.',
            'id_umkm.exists'       => 'UMKM yang dipilih tidak valid.',
            'nama_produk.required' => 'Nama produk wajib diisi.',
            'harga.required'       => 'Harga produk wajib diisi.',
            'harga.numeric'        => 'Harga produk harus berupa angka.',
            'foto.image'           => 'File harus berupa gambar.',
            'foto.mimes'           => 'Format foto harus PNG, JPG, JPEG, atau WEBP.',
            'foto.max'             => 'Ukuran foto maksimal 5 MB.',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('produk', 'public');
        }

        Produk::create($validated);

        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $produk = Produk::with('umkm')->findOrFail($id);
        return redirect()->route('admin.produk.edit', $produk->id_produk);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $produk = Produk::findOrFail($id);
        $umkms = Umkm::orderBy('nama_umkm', 'asc')->get();
        $umkm = $umkms; // Alias for backward compatibility
        return view('admin.produk.edit', compact('produk', 'umkms', 'umkm'))->withTitle('Edit Produk');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $produk = Produk::findOrFail($id);

        $validated = $request->validate([
            'id_umkm'     => 'required|exists:umkms,id_umkm',
            'nama_produk' => 'required|string|max:100',
            'harga'       => 'required|numeric|min:0',
            'deskripsi'   => 'nullable|string',
            'foto'        => 'nullable|image|mimes:png,jpg,jpeg,webp|max:5120',
        ], [
            'id_umkm.required'     => 'Silakan pilih UMKM pemilik produk.',
            'id_umkm.exists'       => 'UMKM yang dipilih tidak valid.',
            'nama_produk.required' => 'Nama produk wajib diisi.',
            'harga.required'       => 'Harga produk wajib diisi.',
            'harga.numeric'        => 'Harga produk harus berupa angka.',
            'foto.image'           => 'File harus berupa gambar.',
            'foto.mimes'           => 'Format foto harus PNG, JPG, JPEG, atau WEBP.',
            'foto.max'             => 'Ukuran foto maksimal 5 MB.',
        ]);

        if ($request->hasFile('foto')) {
            if ($produk->foto && Storage::disk('public')->exists($produk->foto)) {
                Storage::disk('public')->delete($produk->foto);
            }
            $validated['foto'] = $request->file('foto')->store('produk', 'public');
        }

        $produk->update($validated);

        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $produk = Produk::findOrFail($id);

        if ($produk->foto && Storage::disk('public')->exists($produk->foto)) {
            Storage::disk('public')->delete($produk->foto);
        }

        $produk->delete();

        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil dihapus.');
    }
}
