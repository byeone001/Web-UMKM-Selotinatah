<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Umkm;
use App\Models\Produk;
use Illuminate\Support\Facades\Storage;

class UmkmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Umkm::query();

        if ($request->filled('search')) {
            $query->where('nama_umkm', 'like', '%' . $request->search . '%')
                ->orWhere('pemilik', 'like', '%' . $request->search . '%')
                ->orWhere('kategori', 'like', '%' . $request->search . '%');
        }

        $umkms = $query->latest()->paginate(10)->withQueryString();

        return view('admin.umkm.index', compact('umkms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view('admin.umkm.create');
    }

    public function edit($id)
    {
        $umkm = Umkm::findOrFail($id);
        return view('admin.umkm.edit', compact('umkm'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_umkm'   => 'required|string|max:100',
            'pemilik'     => 'required|string|max:100',
            'kategori'    => 'required|string|max:50',
            'kontak'      => 'required|string|max:100',
            'alamat'      => 'nullable|string',
            'deskripsi'   => 'nullable|string',
            'link_lokasi' => 'nullable|string|max:255',
            'foto'        => 'nullable|image|mimes:png,jpg,jpeg,webp|max:5120',
        ], [
            'nama_umkm.required' => 'Nama UMKM wajib diisi.',
            'pemilik.required'   => 'Nama pemilik usaha wajib diisi.',
            'kategori.required'  => 'Kategori usaha wajib dipilih/diisi.',
            'kontak.required'    => 'Nomor kontak WhatsApp wajib diisi.',
            'foto.image'         => 'File harus berupa gambar.',
            'foto.mimes'         => 'Format foto harus PNG, JPG, JPEG, atau WEBP.',
            'foto.max'           => 'Ukuran foto maksimal 5 MB.',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('umkm', 'public');
        }

        Umkm::create($validated);

        return redirect()->route('admin.umkm.index')->with('success', 'Data UMKM berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $umkm = Umkm::findOrFail($id);
        return redirect()->route('admin.umkm.edit', $umkm->id_umkm);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $umkm = Umkm::findOrFail($id);

        $validated = $request->validate([
            'nama_umkm'   => 'required|string|max:100',
            'pemilik'     => 'required|string|max:100',
            'kategori'    => 'required|string|max:50',
            'kontak'      => 'required|string|max:100',
            'alamat'      => 'nullable|string',
            'deskripsi'   => 'nullable|string',
            'link_lokasi' => 'nullable|string|max:255',
            'foto'        => 'nullable|image|mimes:png,jpg,jpeg,webp|max:5120',
        ], [
            'nama_umkm.required' => 'Nama UMKM wajib diisi.',
            'pemilik.required'   => 'Nama pemilik usaha wajib diisi.',
            'kategori.required'  => 'Kategori usaha wajib dipilih/diisi.',
            'kontak.required'    => 'Nomor kontak WhatsApp wajib diisi.',
            'foto.image'         => 'File harus berupa gambar.',
            'foto.mimes'         => 'Format foto harus PNG, JPG, JPEG, atau WEBP.',
            'foto.max'           => 'Ukuran foto maksimal 5 MB.',
        ]);

        if ($request->hasFile('foto')) {
            if ($umkm->foto && Storage::disk('public')->exists($umkm->foto)) {
                Storage::disk('public')->delete($umkm->foto);
            }
            $validated['foto'] = $request->file('foto')->store('umkm', 'public');
        }

        $umkm->update($validated);

        return redirect()->route('admin.umkm.index')->with('success', 'Data UMKM berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $umkm = Umkm::findOrFail($id);

        if ($umkm->foto && Storage::disk('public')->exists($umkm->foto)) {
            Storage::disk('public')->delete($umkm->foto);
        }

        $umkm->delete();

        return redirect()->route('admin.umkm.index')->with('success', 'Data UMKM berhasil dihapus.');
    }
}
