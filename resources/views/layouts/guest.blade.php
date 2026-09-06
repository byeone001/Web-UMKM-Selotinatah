<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Sistem Informasi UMKM Anyaman Bambu & Produk Lokal Desa Selotinatah">

    <title>{{ config('app.name', 'UMKM Selotinatah') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>[x-cloak] { display: none !important; }</style>
</head>
<body class="font-sans antialiased" x-data>
    <div class="min-h-screen grid lg:grid-cols-2">

        <!-- =============================================
             LEFT PANEL — Visual Banner
             ============================================= -->
        <div class="auth-left-panel">
            <!-- Weave Pattern Overlay -->
            <div class="absolute inset-0 weave-bg opacity-100 pointer-events-none"></div>

            <!-- Decorative shapes -->
            <div class="absolute top-0 right-0 w-72 h-72 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/2 pointer-events-none"></div>
            <div class="absolute bottom-0 left-0 w-96 h-96 bg-sapphire-600/20 rounded-full translate-y-1/2 -translate-x-1/2 pointer-events-none"></div>

            <!-- Content -->
            <div class="relative z-10 p-10 flex-1 flex flex-col justify-between">

                <!-- Top: Logo & Title -->
                <div>
                    <div class="flex items-center gap-3 mb-8">
                        <div class="w-11 h-11 rounded-2xl bg-white/20 backdrop-blur-sm flex items-center justify-center border border-white/30">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-white font-black text-sm tracking-tight">UMKM Selotinatah</p>
                            <p class="text-emerald-200/70 text-[10px] font-medium">Desa Selotinatah · Magetan</p>
                        </div>
                    </div>

                    <!-- Headline -->
                    <h1 class="text-4xl xl:text-5xl font-black text-white leading-tight mb-4">
                        Anyaman Bambu<br>
                        <span class="text-emerald-300">Desa Selotinatah</span>
                    </h1>
                    <p class="text-emerald-100/80 text-base leading-relaxed max-w-sm">
                        Platform digital pengelolaan UMKM kerajinan anyaman bambu dan produk lokal unggulan Desa Selotinatah.
                    </p>
                </div>

                <!-- Middle: Stats -->
                <div class="grid grid-cols-3 gap-4 my-8">
                    <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-4 text-center border border-white/20">
                        <p class="text-2xl font-black text-white">50+</p>
                        <p class="text-xs text-emerald-200/80 mt-1">UMKM Aktif</p>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-4 text-center border border-white/20">
                        <p class="text-2xl font-black text-white">200+</p>
                        <p class="text-xs text-emerald-200/80 mt-1">Produk Anyaman</p>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-4 text-center border border-white/20">
                        <p class="text-2xl font-black text-white">∞</p>
                        <p class="text-xs text-emerald-200/80 mt-1">Potensi Desa</p>
                    </div>
                </div>

                <!-- Bottom: Quote -->
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-5 border border-white/20">
                    <svg class="w-7 h-7 text-emerald-300/80 mb-3" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                    </svg>
                    <p class="text-white/90 text-sm leading-relaxed font-medium italic">
                        "Anyaman bambu bukan hanya kerajinan — ini adalah warisan budaya, sumber kehidupan, dan kebanggaan Desa Selotinatah untuk dunia."
                    </p>
                    <p class="text-emerald-300/70 text-xs mt-3 font-semibold">— Pemerintah Desa Selotinatah</p>
                </div>
            </div>
        </div>

        <!-- =============================================
             RIGHT PANEL — Form Area
             ============================================= -->
        <div class="auth-right-panel">
            <div class="w-full max-w-md">

                <!-- Mobile logo (shown on small screens) -->
                <div class="lg:hidden text-center mb-8">
                    <div class="inline-flex items-center gap-3 bg-emerald-50 px-4 py-2 rounded-2xl border border-emerald-200">
                        <div class="w-8 h-8 rounded-xl bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                            </svg>
                        </div>
                        <span class="text-sm font-black text-emerald-800">UMKM Selotinatah</span>
                    </div>
                </div>

                <!-- Form Card -->
                <div class="bg-white rounded-3xl shadow-xl border border-slate-200/80 p-8">
                    {{ $slot }}
                </div>

                <!-- Footer note -->
                <p class="text-center text-xs text-slate-400 mt-6">
                    &copy; {{ date('Y') }} Pemerintah Desa Selotinatah · Ngariboyo, Magetan
                </p>
            </div>
        </div>
    </div>
</body>
</html>
