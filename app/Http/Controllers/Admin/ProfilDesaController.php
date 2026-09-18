<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProfilDesa;
use Illuminate\Http\Request;

class ProfilDesaController extends Controller
{
    public function edit()
    {
        // Karena desa hanya satu, kita ambil record pertama. Jika kosong, kita buat instance baru.
        $profil = ProfilDesa::first() ?? new ProfilDesa();
        return view('admin.profil-desa.edit', compact('profil'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'nama_desa' => 'nullable|string|max:255',
            'sejarah' => 'nullable|string',
            'visi' => 'nullable|string',
            'misi' => 'nullable|string',
            'geografis' => 'nullable|string',
            'jumlah_penduduk' => 'nullable|integer',
            'jumlah_laki_laki' => 'nullable|integer',
            'jumlah_perempuan' => 'nullable|integer',
            'jumlah_kk' => 'nullable|integer',
            'kontak_telepon' => 'nullable|string|max:255',
            'kontak_email' => 'nullable|string|email|max:255',
            'alamat_lengkap' => 'nullable|string',
        ]);

        $profil = ProfilDesa::first();
        if ($profil) {
            $profil->update($validated);
        } else {
            ProfilDesa::create($validated);
        }

        return redirect()->back()->with('success', 'Profil Desa berhasil diperbarui.');
    }
}
