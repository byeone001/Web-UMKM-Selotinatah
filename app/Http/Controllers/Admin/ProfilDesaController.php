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

    public function createMediaUpload(Request $request)
    {
        $request->validate([
            'filename' => 'required|string|max:255',
            'content_type' => 'required|string|max:100',
        ]);

        $profil = ProfilDesa::first();

        if (! $profil) {
            return response()->json([
                'message' => 'Profil desa belum ada. Simpan profil desa terlebih dahulu.'
            ], 422);
        }

        $extension = strtolower(
            pathinfo($request->filename, PATHINFO_EXTENSION)
        );

        $allowedExtensions = [
            'jpg',
            'jpeg',
            'png',
            'webp',
            'gif',
            'mp4',
            'webm',
            'mov',
        ];

        if (! in_array($extension, $allowedExtensions)) {
            return response()->json([
                'message' => 'Format file tidak didukung.'
            ], 422);
        }

        $filename = 'desa-media/' . Str::uuid() . '.' . $extension;

        $disk = Storage::disk('supabase');

        $uploadUrl = $disk->temporaryUploadUrl(
            $filename,
            now()->addMinutes(15)
        ); 

        return response()->json([
            'path' => $filename,
            'upload_url' => $uploadUrl['url'],
            'headers' => $uploadUrl['headers'] ?? [],
        ]);
    }

    public function completeMediaUpload(Request $request)
    {
        $validated = $request->validate([
            'path' => 'required|string|max:500',
            'type' => 'required|in:foto,video',
            'judul' => 'nullable|string|max:255',
        ]);

        $profil = ProfilDesa::first();

        if (! $profil) {
            return response()->json([
                'message' => 'Profil desa belum ada.'
            ], 422);
        }

        // Pastikan file benar-benar ada di Supabase
        if (! Storage::disk('supabase')->exists($validated['path'])) {
            return response()->json([
                'message' => 'File belum ditemukan di storage.'
            ], 422);
        }

        $lastUrutan = $profil->medias()->max('urutan') ?? -1;

        $media = DesaMedia::create([
            'profil_desa_id' => $profil->id,
            'path' => $validated['path'],
            'type' => $validated['type'],
            'judul' => $validated['judul'] ?? null,
            'urutan' => $lastUrutan + 1,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Media berhasil diunggah.',
            'media' => $media,
        ]);
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
