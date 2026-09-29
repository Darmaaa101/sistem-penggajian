<x-guest-layout>
    <div class="min-h-screen grid grid-cols-1 lg:grid-cols-2 bg-slate-50">

        <!-- ================= LEFT SIDE ================= -->
        <div class="hidden lg:flex flex-col justify-between bg-slate-900 p-12 text-white relative overflow-hidden">

            <!-- Dekorasi Background -->
            <div class="absolute -top-24 -left-24 w-96 h-96 bg-blue-600/20 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-indigo-600/20 rounded-full blur-3xl"></div>

            <!-- Logo -->
            <div class="relative z-10 flex items-center gap-3">
                <div class="w-11 h-11 rounded-xl bg-blue-600 flex items-center justify-center shadow-lg shadow-blue-600/30">
                    <span class="text-xl font-bold">P</span>
                </div>

                <span class="text-xl font-semibold tracking-wide">
                    Sistem Penggajian
                </span>
            </div>

            <!-- Content -->
            <div class="relative z-10 max-w-md">
                <span class="inline-flex items-center px-3 py-1 mb-5 text-xs font-medium
                    bg-blue-500/10 text-blue-400 rounded-full border border-blue-500/20">
                    Portal Kepegawaian & Gaji
                </span>

                <h1 class="text-4xl font-bold tracking-tight leading-tight mb-5">
                    Kelola Penggajian dengan Mudah dan Efisien
                </h1>

                <p class="text-slate-400 text-sm leading-relaxed">
                    Kelola data karyawan, proses penggajian, dan laporan
                    secara lebih cepat, terstruktur, dan akurat dalam satu sistem.
                </p>
            </div>

            <!-- Footer -->
            <div class="relative z-10 text-xs text-slate-500">
                &copy; {{ date('Y') }} Sistem Penggajian. All rights reserved.
            </div>
        </div>


        <!-- ================= RIGHT SIDE ================= -->
        <div class="flex flex-col justify-center items-center p-6 sm:p-10 lg:p-16">

            <div class="w-full max-w-md">

                <!-- Mobile Logo -->
                <div class="lg:hidden flex items-center gap-3 mb-10">
                    <div class="w-10 h-10 rounded-xl bg-blue-600 flex items-center justify-center
                        text-white font-bold shadow-lg shadow-blue-600/20">
                        P
                    </div>

                    <span class="font-bold text-slate-800 text-lg">
                        Sistem Penggajian
                    </span>
                </div>


                <!-- Heading -->
                <div class="mb-8">
                    <h2 class="text-3xl font-bold tracking-tight text-slate-900">
                        Selamat Datang 👋
                    </h2>

                    <p class="text-sm text-slate-500 mt-2">
                        Silakan masuk ke akun Anda untuk melanjutkan.
                    </p>
                </div>


                <!-- Session Status -->
                <x-auth-session-status
                    class="mb-4"
                    :status="session('status')"
                />


                <!-- Login Form -->
                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf


                    <!-- Email -->
                    <div>
                        <label
                            for="email"
                            class="block text-sm font-medium text-slate-700 mb-2"
                        >
                            Email
                        </label>

                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autofocus
                            autocomplete="username"
                            placeholder="Masukkan email Anda"
                            class="w-full px-4 py-3 rounded-xl border border-slate-300
                            bg-white text-slate-900 text-sm
                            focus:ring-2 focus:ring-blue-600 focus:border-blue-600
                            outline-none transition-all
                            placeholder:text-slate-400"
                        >

                        <x-input-error
                            :messages="$errors->get('email')"
                            class="mt-2"
                        />
                    </div>


                    <!-- Password -->
                    <div>
                        <div class="flex items-center justify-between mb-2">

                            <label
                                for="password"
                                class="block text-sm font-medium text-slate-700"
                            >
                                Password
                            </label>

                            @if (Route::has('password.request'))
                                <a
                                    href="{{ route('password.request') }}"
                                    class="text-xs font-medium text-blue-600 hover:text-blue-700 transition"
                                >
                                    Lupa password?
                                </a>
                            @endif

                        </div>

                        <input
                            id="password"
                            type="password"
                            name="password"
                            required
                            autocomplete="current-password"
                            placeholder="Masukkan password"
                            class="w-full px-4 py-3 rounded-xl border border-slate-300
                            bg-white text-slate-900 text-sm
                            focus:ring-2 focus:ring-blue-600 focus:border-blue-600
                            outline-none transition-all
                            placeholder:text-slate-400"
                        >

                        <x-input-error
                            :messages="$errors->get('password')"
                            class="mt-2"
                        />
                    </div>


                    <!-- Remember Me -->
                    <div class="flex items-center">

                        <input
                            id="remember_me"
                            type="checkbox"
                            name="remember"
                            class="w-4 h-4 rounded border-slate-300
                            text-blue-600 focus:ring-blue-500"
                        >

                        <label
                            for="remember_me"
                            class="ml-2 text-sm text-slate-600"
                        >
                            Ingat saya
                        </label>

                    </div>


                    <!-- Login Button -->
                    <button
                        type="submit"
                        class="w-full py-3 px-4
                        bg-blue-600 hover:bg-blue-700
                        text-white font-semibold text-sm
                        rounded-xl
                        shadow-lg shadow-blue-600/20
                        transition-all
                        focus:outline-none focus:ring-2
                        focus:ring-blue-600 focus:ring-offset-2"
                    >
                        Masuk
                    </button>

                </form>


                <!-- Information -->
                <div class="mt-8 pt-6 border-t border-slate-200 text-center">
                    <p class="text-xs text-red-300">
                        *Gunakan email & password untuk demo
                        <br>
                        email: admin@simaji.com 
                        <br>
                        pass: admin123
                    </p>

                    <p class="text-xs text-slate-400">
                        Sistem Penggajian — Peoplesync
                    </p>
                </div>

            </div>
        </div>

    </div>
</x-guest-layout>
