<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Sistem Penggajian</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">

<div class="flex min-h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-gray-800 text-white shadow-lg">

        <!-- Logo -->
        <div class="p-6 text-center border-b border-blue-500">

            <div class="flex justify-center mb-3">
               
            </div>

            <h1 class="text-2xl font-bold">
                Sistem Penggajian
            </h1>

            <p class="text-sm text-blue-100">
                Signature Visual
            </p>

        </div>

        <!-- Menu -->
        <nav class="mt-6 px-3 space-y-2">

            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-yellow-800 transition-all duration-300 hover:translate-x-2">

                <i data-lucide="layout-dashboard" class="w-5 h-5"></i>

                Dashboard
            </a>

            <a href="{{ route('admin.jabatan.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-yellow-800 transition-all duration-300 hover:translate-x-2">

                <i data-lucide="briefcase" class="w-5 h-5"></i>

                Jabatan
            </a>

            <a href="{{ route('admin.pegawai.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-yellow-800 transition-all duration-300 hover:translate-x-2">

                <i data-lucide="users" class="w-5 h-5"></i>

                Pegawai
            </a>

            <a href="{{ route('admin.penggajian.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-yellow-800 transition-all duration-300 hover:translate-x-2">

                <i data-lucide="wallet" class="w-5 h-5"></i>

                Penggajian
            </a>

            <a href="{{ route('admin.laporan.index') }}"
                class="flex items-center gap-3 px-6 py-3 hover:bg-yellow-800 transition rounded-lg">

                <i data-lucide="file-text"></i>

                <span>Laporan</span>
            </a>

        </nav>

    </aside>

    <!-- Content -->
    <main class="flex-1">

        <!-- Navbar -->
        <div class="bg-white shadow px-8 py-5 flex justify-between items-center">

            <div>

                <h2 class="text-2xl font-bold text-gray-800">
                    @yield('title')
                </h2>

                <p class="text-sm text-gray-500">
                    Selamat datang di Sistem Penggajian
                </p>

            </div>

            <div class="flex items-center gap-4">

                <div class="text-right">

                    <p class="font-semibold">
                        {{ Auth::user()->name }}
                    </p>

                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button class="flex items-center gap-2 text-red-600 hover:text-red-700 transition">

                        <i data-lucide="log-out" class="w-5 h-5"></i>

                        Logout

                    </button>

                </form>

            </div>

        </div>

        <!-- Isi -->
        <div class="p-8">

            @yield('content')

        </div>

    </main>

</div>

<script src="https://unpkg.com/lucide@latest"></script>

<script>
    lucide.createIcons();
</script>

{{-- 🔥 DITAMBAHKAN DI SINI 🔥 --}}
@stack('scripts')

</body>
</html>