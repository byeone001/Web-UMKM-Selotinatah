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
        $umkm = Umkm::find($id);
        return view('admin.umkm.edit', compact('umkm'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
            'nama_umkm' => 'required',
            'pemilik' => 'required',
            'kategori' => 'required',
            'kontak' => 'required',
            'link_lokasi' => 'required',
            'foto' => 'required|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('umkm', 'public');
        }

        Umkm::create($data);
        return redirect()->route('admin.umkm.index')->with('success', 'Data Umkm berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $umkm = Umkm::find($id);

        $request->validate([
            'nama_umkm' => 'required',
            'pemilik' => 'required',
            'kategori' => 'required',
            'kontak' => 'required',
            'link_lokasi' => 'required',
            'foto' => 'required|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            if ($umkm->foto){
                Storage::disk('public')->delete($umkm->foto);
            }
            $data['foto'] = $request->file('foto')->store('umkm', 'public');
        }

        $umkm->update($data);

        return redirect()->route('admin.umkm.index')->with('success', 'Data Umkm berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $umkm = Umkm::find($id);

        if ($umkm){
            storage::disk('public')->delete($umkm->foto);
        }

        $umkm->delete();

        return redirect()->route('admin.umkm.index')->with('success', 'Data Umkm berhasil dihapus');
    }
}
