<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DesaMedia;
use App\Models\ProfilDesa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProfilDesaController extends Controller
{
    public function edit()
    {
        // Karena desa hanya satu, kita ambil record pertama. Jika kosong, kita buat instance baru.
        $profil = ProfilDesa::first() ?? new ProfilDesa;
        $medias = $profil->exists ? $profil->medias()->orderBy('urutan')->get() : collect();

        return view('admin.profil-desa.edit', compact('profil', 'medias'));
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

    public function storeMedia(Request $request)
    {
        \Illuminate\Support\Facades\Log::info('storeMedia hit', ['files' => $request->allFiles(), 'post' => $request->all()]);
        
        $request->validate([
            'file' => 'required|file|mimes:jpg,jpeg,png,webp,gif,mp4,webm,mov|max:51200',
            'judul' => 'nullable|string|max:255',
        ]);

        $profil = ProfilDesa::first();
        if (! $profil) {
            return back()->with('error', 'Profil desa belum ada. Simpan profil desa terlebih dahulu.');
        }

        $file = $request->file('file');
        $extension = strtolower($file->getClientOriginalExtension());
        $isVideo = in_array($extension, ['mp4', 'webm', 'mov']);
        $type = $isVideo ? 'video' : 'foto';

        $filename = 'desa-media/'.Str::uuid().'.'.$extension;
        Storage::disk('supabase')->put($filename, file_get_contents($file->getRealPath()));

        $lastUrutan = $profil->medias()->max('urutan') ?? -1;

        DesaMedia::create([
            'profil_desa_id' => $profil->id,
            'path' => $filename,
            'type' => $type,
            'judul' => $request->judul,
            'urutan' => $lastUrutan + 1,
        ]);

        return back()->with('success', 'Media berhasil diunggah.');
    }

    public function destroyMedia(DesaMedia $desaMedia)
    {
        // Hapus file dari storage
        if (Storage::disk('supabase')->exists($desaMedia->path)) {
            Storage::disk('supabase')->delete($desaMedia->path);
        }

        $desaMedia->delete();

        return back()->with('success', 'Media berhasil dihapus.');
    }
}
