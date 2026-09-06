<section class="space-y-6">
    <div class="rounded-xl bg-red-50 border border-red-200 p-4">
        <div class="flex items-start gap-3">
            <svg class="w-5 h-5 text-red-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
            </svg>
            <div>
                <h4 class="text-sm font-bold text-red-900">Perhatian Sebelum Menghapus Akun</h4>
                <p class="text-xs text-red-700 mt-1 leading-relaxed">
                    Setelah akun Anda dihapus, semua data dan sumber daya yang terhubung akan dihapus secara permanen. Pastikan Anda telah mengunduh data penting sebelum melanjutkan.
                </p>
            </div>
        </div>
    </div>

    <button
        type="button"
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="btn-danger"
    >
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
        </svg>
        Hapus Akun Saya
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-xl bg-red-100 flex items-center justify-center text-red-600 flex-shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-base font-black text-slate-900">
                        Konfirmasi Hapus Akun
                    </h2>
                    <p class="text-xs text-slate-500">
                        Tindakan ini tidak dapat dibatalkan
                    </p>
                </div>
            </div>

            <p class="text-xs text-slate-600 leading-relaxed mb-4">
                Masukkan password Anda untuk memverifikasi bahwa Anda benar-benar ingin menghapus akun ini secara permanen.
            </p>

            <div>
                <label for="password" class="form-label">Password Konfirmasi</label>
                <input
                    id="password"
                    name="password"
                    type="password"
                    class="form-input @error('password', 'userDeletion') border-red-400 focus:border-red-500 focus:ring-red-100 @enderror"
                    placeholder="Masukkan password Anda"
                />
                @error('password', 'userDeletion')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <button type="button" x-on:click="$dispatch('close')" class="btn-secondary">
                    Batal
                </button>

                <button type="submit" class="btn-danger">
                    Ya, Hapus Akun
                </button>
            </div>
        </form>
    </x-modal>
</section>
