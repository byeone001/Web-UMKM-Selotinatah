<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description"
        content="Sistem Informasi UMKM Anyaman Bambu & Produk Lokal Desa Selotinatah, Ngariboyo, Magetan">
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/logo-header.svg') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('favicon-32x32.png') }}">

    <title>{{ config('app.name', 'UMKM Selotinatah') }} — Panel Admin</title>

    <!-- Preconnect & Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Sidebar transition for mobile drawer */
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="font-sans antialiased bg-slate-50 text-slate-800" x-data="{ sidebarOpen: false, profileOpen: false }">
    {{-- NOTIFIKASI BERHASIL --}}
    @if(session('success'))
        <div
            x-data="{ show: true }"
            x-show="show"
            x-cloak
            class="fixed inset-0 z-[9999] flex items-center justify-center bg-slate-900/40 backdrop-blur-sm"
            x-transition.opacity
        >
            <div
                class="w-[90%] max-w-md bg-white rounded-2xl shadow-2xl border border-slate-200 p-6 text-center"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
            >

                {{-- Icon --}}
                <div class="mx-auto mb-4 w-16 h-16 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2.5"
                            d="M5 13l4 4L19 7"
                        />
                    </svg>
                </div>

                {{-- Judul --}}
                <h3 class="text-lg font-bold text-slate-800">
                    Berhasil
                </h3>

                {{-- Pesan --}}
                <p class="text-sm text-slate-500 mt-2">
                    {{ session('success') }}
                </p>

                {{-- Tombol --}}
                <button
                    type="button"
                    @click="show = false"
                    class="mt-6 px-6 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold transition-colors"
                >
                    Oke
                </button>

            </div>
        </div>
    @endif

    <!-- =============================================
         MOBILE SIDEBAR OVERLAY
         ============================================= -->
    <div x-show="sidebarOpen" x-cloak @click="sidebarOpen = false"
        class="fixed inset-0 z-40 bg-slate-900/60 backdrop-blur-sm lg:hidden"
        x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"></div>

    <!-- =============================================
         SIDEBAR NAVIGATION
         ============================================= -->
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'" class="sidebar-nav" x-cloak>
        <!-- Logo Area -->
        <div class="sidebar-logo-area">
            <div class="w-10 h-10 flex-shrink-0 flex items-center justify-center">
                <img src="{{ asset('images/logo-header.svg') }}" alt="Logo UMKM Selotinatah"
                    class="w-10 h-10 object-contain">
            </div>
            <div class="min-w-0">
                <p class="text-sm font-bold text-slate-900 truncate">UMKM Selotinatah</p>
                <p class="text-[11px] text-slate-500 truncate">Desa Selotinatah · Magetan</p>
            </div>
            <!-- Close button mobile -->
            <button @click="sidebarOpen = false"
                class="ml-auto lg:hidden text-slate-400 hover:text-slate-700 transition-colors flex-shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Navigation Menu -->
        <nav class="flex-1 overflow-y-auto py-4 space-y-0.5">

            <!-- MAIN MENU -->
            <p class="sidebar-section-label">Menu Utama</p>

            <a href="{{ route('dashboard') }}"
                class="sidebar-nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                <span>Dashboard Rekap</span>
                @if(request()->routeIs('dashboard'))
                    <span class="ml-auto w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                @endif
            </a>

            <!-- DATA MANAGEMENT -->
            <p class="sidebar-section-label">Kelola Data</p>

            <a href="{{ route('admin.umkm.index') }}"
                class="sidebar-nav-item {{ request()->routeIs('admin.umkm.*') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
                <span>Kelola UMKM</span>
                @if(request()->routeIs('admin.umkm.*'))
                    <span class="ml-auto w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                @endif
            </a>

            <a href="{{ route('admin.produk.index') }}"
                class="sidebar-nav-item {{ request()->routeIs('admin.produk.*') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                </svg>
                <span>Kelola Produk</span>
                @if(request()->routeIs('admin.produk.*'))
                    <span class="ml-auto w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                @endif
            </a>

            <a href="{{ route('admin.profil-desa.edit') }}"
                class="sidebar-nav-item {{ request()->routeIs('admin.profil-desa.*') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
                <span>Profil Desa</span>
                @if(request()->routeIs('admin.profil-desa.*'))
                    <span class="ml-auto w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                @endif
            </a>

            <!-- REPORTS -->
            <p class="sidebar-section-label">Laporan</p>

            <a href="{{ route('admin.laporan.pdf') }}" target="_blank" class="sidebar-nav-item">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <span>Cetak PDF</span>
            </a>

            <a href="{{ route('admin.laporan.excel') }}" class="sidebar-nav-item">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <span>Export Excel</span>
            </a>

            <!-- SETTINGS -->
            <p class="sidebar-section-label">Lainnya</p>

            <a href="{{ route('home') }}" target="_blank" class="sidebar-nav-item">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                </svg>
                <span>Lihat Web Publik</span>
            </a>

            <a href="{{ route('profile.edit') }}"
                class="sidebar-nav-item {{ request()->routeIs('profile.*') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <span>Pengaturan Profil</span>
                @if(request()->routeIs('profile.*'))
                    <span class="ml-auto w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                @endif
            </a>
        </nav>

        <!-- User Info Footer -->
        <div class="px-4 py-4 border-t border-slate-100 bg-slate-50/60">
            <div class="flex items-center gap-3 p-2.5 rounded-xl bg-white border border-slate-200/80 shadow-sm">
                <div
                    class="w-9 h-9 rounded-full bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center text-white font-bold text-sm flex-shrink-0">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div class="min-w-0 flex-1">
                    <p class="text-sm font-semibold text-slate-800 truncate">{{ Auth::user()->name }}</p>
                    <p class="text-[11px] text-slate-500 truncate">{{ Auth::user()->email }}</p>
                </div>
                <form method="POST" action="{{ route('logout') }}" class="flex-shrink-0">
                    @csrf
                    <button type="submit" title="Keluar"
                        class="w-8 h-8 rounded-lg bg-red-50 hover:bg-red-500 text-red-500 hover:text-white flex items-center justify-center transition-all border border-red-200/60">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- =============================================
         MAIN CONTENT WRAPPER
         ============================================= -->
    <div class="lg:pl-64 flex flex-col min-h-screen">

        <!-- TOPBAR -->
        <header class="topbar">
            <div class="flex items-center gap-4">
                <!-- Mobile hamburger -->
                <button @click="sidebarOpen = true"
                    class="lg:hidden w-9 h-9 rounded-lg bg-slate-100 hover:bg-slate-200 flex items-center justify-center text-slate-600 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>

                <!-- Page heading from slot or route -->
                <div class="animate-fade-in">
                    @isset($header)
                        {{ $header }}
                    @else
                        <h1 class="page-title text-lg">
                            @if(request()->routeIs('dashboard'))
                                Dashboard Rekap
                            @elseif(request()->routeIs('admin.umkm.*'))
                                Kelola UMKM
                            @elseif(request()->routeIs('admin.produk.*'))
                                Kelola Produk
                            @elseif(request()->routeIs('profile.*'))
                                Pengaturan Profil
                            @else
                                Panel Admin
                            @endif
                        </h1>
                    @endisset
                </div>
            </div>

            <!-- Topbar Right -->
            <div class="flex items-center gap-3">
                <!-- Notification Bell -->
                <button
                    class="relative w-9 h-9 rounded-lg bg-slate-100 hover:bg-slate-200 flex items-center justify-center text-slate-500 hover:text-slate-700 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                    <span
                        class="absolute top-1.5 right-1.5 w-2 h-2 rounded-full bg-emerald-500 ring-2 ring-white"></span>
                </button>

                <!-- User Avatar Dropdown -->
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open"
                        class="flex items-center gap-2.5 px-3 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 transition-colors">
                        <div
                            class="w-7 h-7 rounded-full bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center text-white font-bold text-xs">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <span
                            class="hidden sm:block text-sm font-semibold text-slate-700">{{ Auth::user()->name }}</span>
                        <svg class="w-4 h-4 text-slate-400 transition-transform duration-200"
                            :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <!-- Dropdown Menu -->
                    <div x-show="open" x-cloak @click.outside="open = false"
                        x-transition:enter="transition ease-out duration-150"
                        x-transition:enter-start="opacity-0 translate-y-1"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-100"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 translate-y-1"
                        class="absolute right-0 mt-2 w-56 bg-white rounded-2xl shadow-xl border border-slate-200/80 py-2 z-50">

                        <div class="px-4 py-3 border-b border-slate-100">
                            <p class="text-sm font-bold text-slate-800">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-slate-500 truncate">{{ Auth::user()->email }}</p>
                        </div>

                        <a href="{{ route('profile.edit') }}"
                            class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-700 hover:bg-slate-50 hover:text-emerald-600 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Profil & Pengaturan
                        </a>

                        <a href="{{ route('home') }}" target="_blank"
                            class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-700 hover:bg-slate-50 hover:text-emerald-600 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            Lihat Web Publik
                        </a>

                        <div class="border-t border-slate-100 mt-1 pt-1">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="flex items-center gap-3 w-full px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                    Keluar dari Akun
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- PAGE CONTENT -->
        <main class="flex-1 p-4 sm:p-6 lg:p-8 animate-fade-in">
            {{ $slot }}
        </main>

        <!-- FOOTER -->
        <footer class="py-4 px-6 border-t border-slate-200/80 bg-white/50">
            <p class="text-xs text-slate-400 text-center">
                &copy; {{ date('Y') }} Pemerintah Desa Selotinatah, Kec. Ngariboyo, Kabupaten Magetan
                <span class="mx-2">·</span>
                <> Powered by KKNT UNESA 2026
            </p>
        </footer>
    </div>

    @stack('scripts')

    <script>
    function showToast(message, type = 'success', onClose = null) {

        const config = {
            success: {
                title: 'Berhasil',
                icon: `
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                            d="M5 13l4 4L19 7"/>
                    </svg>
                `,
                color: 'emerald'
            },

            error: {
                title: 'Gagal',
                icon: `
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                            d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                `,
                color: 'red'
            },

            warning: {
                title: 'Peringatan',
                icon: `
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                            d="M12 9v3m0 4h.01M10.29 3.86l-7.82 13a2 2 0 001.71 3h15.64a2 2 0 001.71-3l-7.82-13a2 2 0 00-3.42 0z"/>
                    </svg>
                `,
                color: 'amber'
            }
        };

        const selected = config[type] || config.success;

        const overlay = document.createElement('div');

        overlay.className = `
            fixed inset-0 z-[9999]
            flex items-center justify-center
            bg-slate-900/40 backdrop-blur-sm
            opacity-0
            transition-opacity duration-300
        `;

        overlay.innerHTML = `
            <div class="
                w-[90%] max-w-md
                bg-white
                rounded-2xl
                shadow-2xl
                border border-slate-200
                p-6
                text-center
                scale-95
                transition-transform duration-300
            ">

                <div class="
                    mx-auto mb-4
                    w-16 h-16
                    rounded-full
                    bg-${selected.color}-100
                    text-${selected.color}-600
                    flex items-center justify-center
                ">
                    ${selected.icon}
                </div>

                <h3 class="text-lg font-bold text-slate-800">
                    ${selected.title}
                </h3>

                <p class="text-sm text-slate-500 mt-2">
                    ${message}
                </p>

                <button
                    type="button"
                    class="
                        mt-6
                        min-w-[100px]
                        px-6 py-2.5
                        rounded-xl
                        bg-emerald-600
                        hover:bg-emerald-700
                        text-white
                        text-sm font-semibold
                        shadow-sm
                        transition-all
                        hover:shadow-md
                    "
                    data-toast-ok
                >
                    Oke
                </button>

            </div>
        `;

        document.body.appendChild(overlay);

        const box = overlay.querySelector('div');
        const okButton = overlay.querySelector('[data-toast-ok]');

        // Animasi masuk
        requestAnimationFrame(() => {
            overlay.classList.remove('opacity-0');
            box.classList.remove('scale-95');
            box.classList.add('scale-100');
        });

        function closeToast() {

            overlay.classList.add('opacity-0');
            box.classList.remove('scale-100');
            box.classList.add('scale-95');

            setTimeout(() => {
                overlay.remove();

                if (typeof onClose === 'function') {
                    onClose();
                }
            }, 300);
        }

        okButton.addEventListener('click', closeToast);
    }
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        document.querySelectorAll('.delete-media-form').forEach(function (form) {

            form.addEventListener('submit', function (event) {

                event.preventDefault();

                const modal = document.createElement('div');

                modal.className = `
                    fixed inset-0 z-[9999]
                    flex items-center justify-center
                    bg-slate-900/40 backdrop-blur-sm
                    opacity-0
                    transition-opacity duration-300
                `;

                modal.innerHTML = `
                    <div class="
                        w-[90%] max-w-md
                        bg-white
                        rounded-2xl
                        shadow-2xl
                        border border-slate-200
                        p-6
                        text-center
                        scale-95
                        transition-transform duration-300
                    ">

                        <div class="
                            mx-auto mb-4
                            w-16 h-16
                            rounded-full
                            bg-red-100
                            text-red-600
                            flex items-center justify-center
                        ">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2.5"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                        </div>

                        <h3 class="text-lg font-bold text-slate-800">
                            Hapus Media?
                        </h3>

                        <p class="text-sm text-slate-500 mt-2">
                            Media ini akan dihapus secara permanen.
                            Tindakan ini tidak dapat dibatalkan.
                        </p>

                        <div class="flex justify-center gap-3 mt-6">

                            <button
                                type="button"
                                data-delete-cancel
                                class="
                                    px-5 py-2.5
                                    rounded-xl
                                    bg-slate-100
                                    hover:bg-slate-200
                                    text-slate-700
                                    text-sm font-semibold
                                    transition-colors
                                "
                            >
                                Batal
                            </button>

                            <button
                                type="button"
                                data-delete-confirm
                                class="
                                    px-5 py-2.5
                                    rounded-xl
                                    bg-red-600
                                    hover:bg-red-700
                                    text-white
                                    text-sm font-semibold
                                    transition-colors
                                "
                            >
                                Ya, Hapus
                            </button>

                        </div>
                    </div>
                `;

                document.body.appendChild(modal);

                const box = modal.querySelector('div');

                // Animasi masuk
                requestAnimationFrame(() => {
                    modal.classList.remove('opacity-0');
                    box.classList.remove('scale-95');
                    box.classList.add('scale-100');
                });

                const closeModal = function () {

                    modal.classList.add('opacity-0');
                    box.classList.remove('scale-100');
                    box.classList.add('scale-95');

                    setTimeout(() => {
                        modal.remove();
                    }, 300);
                };

                // Tombol Batal
                modal.querySelector('[data-delete-cancel]')
                    .addEventListener('click', closeModal);

                // Tombol Ya, Hapus
                modal.querySelector('[data-delete-confirm]')
                    .addEventListener('click', function () {

                        closeModal();

                        // Submit form asli
                        setTimeout(() => {
                            form.submit();
                        }, 300);
                    });

            });

        });

    });
</script>

</body>

</html>