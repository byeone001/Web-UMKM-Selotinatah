<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Umkm;
use Closure;
use Illuminate\Http\Request;
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
            $query->where('nama_umkm', 'like', '%'.$request->search.'%')
                ->orWhere('pemilik', 'like', '%'.$request->search.'%')
                ->orWhere('kategori', 'like', '%'.$request->search.'%');
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
        $request->merge([
            'kontak' => $this->normalizeWhatsAppNumber($request->input('kontak')),
        ]);

        $validated = $request->validate($this->validationRules(), $this->validationMessages());

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

        $request->merge([
            'kontak' => $this->normalizeWhatsAppNumber($request->input('kontak')),
        ]);

        $validated = $request->validate($this->validationRules(), $this->validationMessages());

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

    /**
     * @return array<string, array<int, string|Closure>>
     */
    private function validationRules(): array
    {
        return [
            'nama_umkm' => 'required|string|max:100',
            'pemilik' => 'required|string|max:100',
            'kategori' => 'required|string|max:50',
            'kontak' => ['required', 'regex:/^628[1-9][0-9]{7,11}$/'],
            'alamat' => 'nullable|string',
            'deskripsi' => 'nullable|string',
            'link_lokasi' => ['nullable', 'url:http,https', 'max:255', $this->googleMapsUrlRule()],
            'foto' => 'nullable|image|mimes:png,jpg,jpeg,webp|max:5120',
        ];
    }

    /**
     * @return array<string, string>
     */
    private function validationMessages(): array
    {
        return [
            'nama_umkm.required' => 'Nama UMKM wajib diisi.',
            'pemilik.required' => 'Nama pemilik usaha wajib diisi.',
            'kategori.required' => 'Kategori usaha wajib dipilih/diisi.',
            'kontak.required' => 'Nomor kontak WhatsApp wajib diisi.',
            'kontak.regex' => 'Nomor WhatsApp harus menggunakan nomor Indonesia yang valid, misalnya 08123456789.',
            'link_lokasi.url' => 'Link lokasi harus berupa URL yang valid.',
            'foto.image' => 'File harus berupa gambar.',
            'foto.mimes' => 'Format foto harus PNG, JPG, JPEG, atau WEBP.',
            'foto.max' => 'Ukuran foto maksimal 5 MB.',
            'link_lokasi.regex' => 'Link lokasi harus berasal dari Google Maps.',
        ];
    }

    private function normalizeWhatsAppNumber(?string $phoneNumber): string
    {
        $digits = preg_replace('/\D+/', '', $phoneNumber ?? '') ?? '';

        if (str_starts_with($digits, '0')) {
            return '62'.substr($digits, 1);
        }

        return $digits;
    }

    private function googleMapsUrlRule(): Closure
    {
        return function (string $attribute, mixed $value, Closure $fail): void {
            $host = strtolower((string) parse_url($value, PHP_URL_HOST));
            $allowedHosts = [
                'goo.gl',
                'maps.app.goo.gl',
                'maps.google.com',
                'www.google.com',
                'google.com',
            ];

            if (! in_array($host, $allowedHosts, true)) {
                $fail('Link lokasi harus berasal dari Google Maps.');
            }
        };
    }
}
