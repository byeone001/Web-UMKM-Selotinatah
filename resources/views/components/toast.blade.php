@if(session('success') || session('error') || session('warning') || session('info'))
    <div
        id="toast-notification"
        class="fixed top-5 right-5 z-[9999] w-[calc(100%-2rem)] max-w-sm
               bg-white rounded-2xl shadow-2xl border border-slate-200
               overflow-hidden animate-slide-in-right"
    >

        @if(session('success'))
            <div class="flex items-start gap-3 p-4">
                <div class="flex-shrink-0 w-10 h-10 rounded-xl bg-emerald-100
                            flex items-center justify-center">
                    <svg class="w-5 h-5 text-emerald-600"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M5 13l4 4L19 7"/>
                    </svg>
                </div>

                <div class="flex-1 min-w-0">
                    <p class="text-sm font-bold text-slate-800">
                        Berhasil!
                    </p>

                    <p class="text-sm text-slate-500 mt-0.5">
                        {{ session('success') }}
                    </p>
                </div>

                <button
                    onclick="closeToast()"
                    class="text-slate-400 hover:text-slate-600 transition-colors"
                >
                    <svg class="w-5 h-5"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <div class="h-1 bg-emerald-500 animate-toast-progress"></div>

        @elseif(session('error'))
            <div class="flex items-start gap-3 p-4">
                <div class="flex-shrink-0 w-10 h-10 rounded-xl bg-red-100
                            flex items-center justify-center">
                    <svg class="w-5 h-5 text-red-600"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </div>

                <div class="flex-1 min-w-0">
                    <p class="text-sm font-bold text-slate-800">
                        Gagal!
                    </p>

                    <p class="text-sm text-slate-500 mt-0.5">
                        {{ session('error') }}
                    </p>
                </div>

                <button
                    onclick="closeToast()"
                    class="text-slate-400 hover:text-slate-600 transition-colors"
                >
                    <svg class="w-5 h-5"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <div class="h-1 bg-red-500 animate-toast-progress"></div>

        @elseif(session('warning'))
            <div class="flex items-start gap-3 p-4">
                <div class="flex-shrink-0 w-10 h-10 rounded-xl bg-amber-100
                            flex items-center justify-center">
                    <svg class="w-5 h-5 text-amber-600"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M12 9v4m0 4h.01M10.29 3.86l-8.82 15a2 2 0 001.71 2.57h17.64a2 2 0 001.71-2.57 2 2 0 001.71-2.57l-8.82-15a2 2 0 00-3.42 0z"/>
                    </svg>
                </div>

                <div class="flex-1 min-w-0">
                    <p class="text-sm font-bold text-slate-800">
                        Peringatan!
                    </p>

                    <p class="text-sm text-slate-500 mt-0.5">
                        {{ session('warning') }}
                    </p>
                </div>

                <button
                    onclick="closeToast()"
                    class="text-slate-400 hover:text-slate-600 transition-colors"
                >
                    <svg class="w-5 h-5"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <div class="h-1 bg-amber-500 animate-toast-progress"></div>

        @elseif(session('info'))
            <div class="flex items-start gap-3 p-4">
                <div class="flex-shrink-0 w-10 h-10 rounded-xl bg-blue-100
                            flex items-center justify-center">
                    <svg class="w-5 h-5 text-blue-600"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M12 16v-4m0-4h.01M12 22a10 10 0 100-20 10 10 0 000 20z"/>
                    </svg>
                </div>

                <div class="flex-1 min-w-0">
                    <p class="text-sm font-bold text-slate-800">
                        Informasi
                    </p>

                    <p class="text-sm text-slate-500 mt-0.5">
                        {{ session('info') }}
                    </p>
                </div>

                <button
                    onclick="closeToast()"
                    class="text-slate-400 hover:text-slate-600 transition-colors"
                >
                    <svg class="w-5 h-5"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <div class="h-1 bg-blue-500 animate-toast-progress"></div>
        @endif

    </div>

    <script>
        function closeToast() {
            const toast = document.getElementById('toast-notification');

            if (toast) {
                toast.classList.add('animate-toast-out');

                setTimeout(() => {
                    toast.remove();
                }, 300);
            }
        }

        setTimeout(() => {
            closeToast();
        }, 4000);
    </script>
@endif