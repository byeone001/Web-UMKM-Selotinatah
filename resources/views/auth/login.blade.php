<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/logo-header.svg') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('favicon-32x32.png') }}">
    <meta name="description" content="Login Admin - Sistem Informasi UMKM Anyaman Bambu Desa Selotinatah, Magetan">
    <title>Login Admin — UMKM Selotinatah</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="font-sans antialiased" x-data="{ showPassword: false }">
    <div class="min-h-screen grid lg:grid-cols-2">

        <!-- =============================================
         LEFT PANEL — Visual Banner
         ============================================= -->
        <div class="auth-left-panel">
            <!-- Weave Pattern Overlay -->
            <div class="absolute inset-0 weave-bg pointer-events-none"></div>

            <!-- Decorative Blobs -->
            <div
                class="absolute top-0 right-0 w-80 h-80 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/3 pointer-events-none">
            </div>
            <div
                class="absolute bottom-0 left-0 w-96 h-96 bg-sapphire-600/20 rounded-full translate-y-1/2 -translate-x-1/3 pointer-events-none">
            </div>
            <div
                class="absolute top-1/2 left-1/2 w-64 h-64 bg-teal-500/10 rounded-full -translate-x-1/2 -translate-y-1/2 blur-2xl pointer-events-none">
            </div>

            <!-- Content -->
            <div class="relative z-10 p-10 flex-1 flex flex-col justify-between">
                <!-- Logo -->
                <div class="flex items-center gap-3">
                    <div
                        class="w-11 h-11 rounded-2xl bg-white/20 backdrop-blur-sm flex items-center justify-center border border-white/30">
                        <img src="{{ asset('images/logo-header.svg') }}" alt="Logo UMKM Selotinatah"
                            class="w-8 h-8 object-contain">
                    </div>
                    <div>
                        <p class="text-white font-black text-sm">UMKM Selotinatah</p>
                        <p class="text-emerald-200/70 text-[10px] font-medium">Desa Selotinatah · Magetan</p>
                    </div>
                </div>

                <!-- Headline -->
                <div class="space-y-5">
                    <div>
                        <p class="text-emerald-300 text-sm font-semibold uppercase tracking-widest mb-2">🌿 Panel
                            Administrasi</p>
                        <h1 class="text-4xl xl:text-5xl font-black text-white leading-tight">
                            Selamat Datang,<br>
                            <span class="text-emerald-300">Admin</span> 👋
                        </h1>
                        <p class="text-emerald-100/80 text-sm leading-relaxed mt-4 max-w-sm">
                            Kelola data UMKM, produk anyaman bambu, dan laporan desa Selotinatah dari satu panel yang
                            terintegrasi.
                        </p>
                    </div>

                    <!-- Stats Grid -->
                    <div class="grid grid-cols-2 gap-3">
                        <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-4 border border-white/20">
                            <div class="w-8 h-8 rounded-xl bg-emerald-400/20 flex items-center justify-center mb-2">
                                <svg class="w-4 h-4 text-emerald-300" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            </div>
                            <p class="text-2xl font-black text-white">50+</p>
                            <p class="text-xs text-emerald-200/80 font-medium">UMKM Terdaftar</p>
                        </div>
                        <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-4 border border-white/20">
                            <div class="w-8 h-8 rounded-xl bg-sapphire-400/20 flex items-center justify-center mb-2">
                                <svg class="w-4 h-4 text-blue-300" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                </svg>
                            </div>
                            <p class="text-2xl font-black text-white">200+</p>
                            <p class="text-xs text-emerald-200/80 font-medium">Produk Anyaman</p>
                        </div>
                    </div>
                </div>

                <!-- Quote -->
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-5 border border-white/20">
                    <svg class="w-6 h-6 text-emerald-300/80 mb-2" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z" />
                    </svg>
                    <p class="text-white/90 text-sm font-medium italic leading-relaxed">
                        "Anyaman bambu, warisan leluhur yang menjadi kebanggaan dan penghidup masyarakat Desa
                        Selotinatah."
                    </p>
                    <p class="text-emerald-300/70 text-xs mt-2 font-semibold">— Pengelola UMKM Selotinatah</p>
                </div>
            </div>
        </div>

        <!-- =============================================
         RIGHT PANEL — Form Card
         ============================================= -->
        <div class="auth-right-panel">
            <div class="w-full max-w-md">

                <!-- Mobile logo -->
                <div class="lg:hidden text-center mb-8">
                    <div
                        class="inline-flex items-center gap-3 bg-emerald-50 px-4 py-2.5 rounded-2xl border border-emerald-200 mb-2">
                        <div
                            class="w-8 h-8 rounded-xl bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" />
                            </svg>
                        </div>
                        <span class="text-sm font-black text-emerald-800">UMKM Selotinatah</span>
                    </div>
                </div>

                <!-- Form Card -->
                <div class="bg-white rounded-3xl shadow-xl border border-slate-200/80 p-8 animate-slide-up">

                    <!-- Card Header -->
                    <div class="mb-7">
                        <div
                            class="w-12 h-12 rounded-2xl bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center mb-4 shadow-lg shadow-emerald-500/30">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <h2 class="text-2xl font-black text-slate-900">Masuk ke Panel</h2>
                        <p class="text-sm text-slate-500 mt-1">Masukkan kredensial Anda untuk mengakses panel
                            administrasi.</p>
                    </div>

                    <!-- Error Alert -->
                    @if ($errors->any())
                        <div class="alert-error mb-6">
                            <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <ul class="space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('status'))
                        <div class="alert-success mb-6">
                            <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>{{ session('status') }}</span>
                        </div>
                    @endif

                    <!-- Login Form -->
                    <form method="POST" action="{{ route('login') }}" class="space-y-5">
                        @csrf

                        <!-- Email -->
                        <div>
                            <label for="email" class="form-label">Alamat Email</label>
                            <div class="relative">
                                <div
                                    class="absolute inset-y-0 left-3.5 flex items-center pointer-events-none text-slate-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <input id="email" type="email" name="email" value="{{ old('email') }}" required
                                    autofocus autocomplete="email" placeholder="admin@selotinatah.desa.id"
                                    class="form-input pl-10 @error('email') border-red-400 focus:border-red-400 focus:ring-red-100 @enderror">
                            </div>
                            @error('email')
                                <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <label for="password" class="form-label mb-0">Kata Sandi</label>
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}"
                                        class="text-xs text-emerald-600 hover:text-emerald-700 font-semibold transition-colors">
                                        Lupa password?
                                    </a>
                                @endif
                            </div>
                            <div class="relative">
                                <div
                                    class="absolute inset-y-0 left-3.5 flex items-center pointer-events-none text-slate-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                </div>
                                <input id="password" :type="showPassword ? 'text' : 'password'" name="password" required
                                    autocomplete="current-password" placeholder="••••••••"
                                    class="form-input pl-10 pr-12 @error('password') border-red-400 focus:border-red-400 focus:ring-red-100 @enderror">
                                <!-- Toggle visibility -->
                                <button type="button" @click="showPassword = !showPassword"
                                    class="absolute inset-y-0 right-3.5 flex items-center text-slate-400 hover:text-slate-600 transition-colors">
                                    <svg x-show="!showPassword" class="w-4 h-4" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    <svg x-show="showPassword" x-cloak class="w-4 h-4" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                    </svg>
                                </button>
                            </div>
                            @error('password')
                                <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Remember Me -->
                        <div class="flex items-center gap-2.5">
                            <input id="remember_me" type="checkbox" name="remember"
                                class="w-4 h-4 rounded border-slate-300 text-emerald-600 focus:ring-emerald-500 cursor-pointer">
                            <label for="remember_me" class="text-sm text-slate-600 cursor-pointer">Ingat saya di
                                perangkat ini</label>
                        </div>

                        <!-- Submit -->
                        <button type="submit"
                            class="w-full py-3.5 px-4 bg-gradient-to-r from-emerald-600 to-emerald-700 hover:from-emerald-700 hover:to-emerald-800 text-white font-bold text-sm rounded-xl shadow-lg shadow-emerald-600/25 hover:shadow-xl hover:shadow-emerald-600/30 transition-all duration-200 flex items-center justify-center gap-2 active:scale-[0.98]">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                            </svg>
                            Masuk ke Dashboard
                        </button>
                    </form>

                    <!-- Back link -->
                    <div class="mt-6 pt-5 border-t border-slate-100 text-center">
                        <a href="/"
                            class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-500 hover:text-emerald-600 transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Kembali ke Halaman Utama
                        </a>
                    </div>
                </div>

                <!-- Footer -->
                <p class="text-center text-xs text-slate-400 mt-6">
                    &copy; {{ date('Y') }} Pemerintah Desa Selotinatah · Ngariboyo, Magetan
                </p>
            </div>
        </div>
    </div>
</body>

</html>