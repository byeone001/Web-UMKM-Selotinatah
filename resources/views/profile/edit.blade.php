<x-app-layout>
    <div class="space-y-6" x-data="{ activeTab: 'profile' }">

        {{-- Page Header --}}
        <div class="page-header">
            <div>
                <h1 class="page-title">Pengaturan Profil</h1>
                <p class="page-subtitle">Kelola informasi akun dan keamanan Anda</p>
            </div>
        </div>

        {{-- Profile Card Header --}}
        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-card overflow-hidden">
            <div class="h-24 bg-gradient-to-r from-emerald-600 via-teal-600 to-sapphire-600 relative">
                <div class="absolute inset-0 weave-bg opacity-60"></div>
            </div>
            <div class="px-6 pb-6">
                <div class="flex flex-col sm:flex-row sm:items-end gap-4 -mt-10">
                    {{-- Avatar --}}
                    <div class="relative flex-shrink-0">
                        <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center text-white font-black text-3xl border-4 border-white shadow-lg">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <div class="absolute -bottom-1 -right-1 w-6 h-6 rounded-full bg-emerald-500 border-2 border-white flex items-center justify-center">
                            <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                    </div>
                    <div class="pb-1">
                        <h2 class="text-xl font-black text-slate-900">{{ Auth::user()->name }}</h2>
                        <p class="text-sm text-slate-500">{{ Auth::user()->email }}</p>
                        <div class="flex items-center gap-2 mt-1.5">
                            <span class="badge-green text-[10px]">Admin</span>
                            <span class="badge-blue text-[10px]">UMKM Selotinatah</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tab Navigation --}}
        <div class="flex items-center gap-1 p-1 bg-slate-100 rounded-xl w-full sm:w-fit">
            <button @click="activeTab = 'profile'"
                    :class="activeTab === 'profile' ? 'bg-white text-emerald-700 shadow-sm font-bold' : 'text-slate-500 hover:text-slate-700'"
                    class="flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-medium transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                Info Profil
            </button>
            <button @click="activeTab = 'password'"
                    :class="activeTab === 'password' ? 'bg-white text-emerald-700 shadow-sm font-bold' : 'text-slate-500 hover:text-slate-700'"
                    class="flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-medium transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
                Ganti Password
            </button>
            <button @click="activeTab = 'danger'"
                    :class="activeTab === 'danger' ? 'bg-white text-red-700 shadow-sm font-bold' : 'text-slate-500 hover:text-slate-700'"
                    class="flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-medium transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
                Hapus Akun
            </button>
        </div>

        {{-- Tab Content --}}

        {{-- Profile Info Tab --}}
        <div x-show="activeTab === 'profile'" class="bg-white rounded-2xl border border-slate-200/80 shadow-card">
            <div class="px-6 py-4 border-b border-slate-100">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-emerald-50 flex items-center justify-center">
                        <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-black text-slate-800">Informasi Profil</h3>
                        <p class="text-xs text-slate-400">Perbarui nama dan alamat email akun Anda</p>
                    </div>
                </div>
            </div>
            <div class="p-6">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        {{-- Password Tab --}}
        <div x-show="activeTab === 'password'" x-cloak class="bg-white rounded-2xl border border-slate-200/80 shadow-card">
            <div class="px-6 py-4 border-b border-slate-100">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-sapphire-50 flex items-center justify-center">
                        <svg class="w-4 h-4 text-sapphire-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-black text-slate-800">Ganti Password</h3>
                        <p class="text-xs text-slate-400">Pastikan akun Anda menggunakan password yang kuat</p>
                    </div>
                </div>
            </div>
            <div class="p-6">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        {{-- Danger Tab --}}
        <div x-show="activeTab === 'danger'" x-cloak class="bg-white rounded-2xl border border-red-200 shadow-card">
            <div class="px-6 py-4 border-b border-red-100 bg-red-50/50 rounded-t-2xl">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-red-100 flex items-center justify-center">
                        <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-black text-red-800">Zona Berbahaya</h3>
                        <p class="text-xs text-red-500">Tindakan ini bersifat permanen dan tidak dapat dibatalkan</p>
                    </div>
                </div>
            </div>
            <div class="p-6">
                @include('profile.partials.delete-user-form')
            </div>
        </div>

    </div>
</x-app-layout>
