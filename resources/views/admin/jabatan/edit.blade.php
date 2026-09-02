<x-app-layout>

    <div class="max-w-4xl mx-auto p-6">

        <h1 class="text-2xl font-bold mb-6">
            Edit Data Jabatan
        </h1>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.jabatan.update', $jabatan->id) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block mb-2 font-semibold">
                    Nama Jabatan
                </label>

                <input
                    type="text"
                    name="nama_jabatan"
                    class="w-full border rounded-lg p-2"
                    value="{{ old('nama_jabatan', $jabatan->nama_jabatan) }}"
                    required>
            </div>

            <div class="mb-4">
                <label class="block mb-2 font-semibold">
                    Gaji Pokok
                </label>

                <input
                    type="number"
                    name="gaji_pokok"
                    class="w-full border rounded-lg p-2"
                    value="{{ old('gaji_pokok', $jabatan->gaji_pokok) }}"
                    required>
            </div>

            <div class="mb-4">
                <label class="block mb-2 font-semibold">
                    Tunjangan
                </label>

                <input
                    type="number"
                    name="tunjangan"
                    class="w-full border rounded-lg p-2"
                    value="{{ old('tunjangan', $jabatan->tunjangan) }}"
                    required>
            </div>

            <div class="flex gap-3 mt-6">

                <button
                    type="submit"
                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-5 py-2 rounded-lg">
                    Update
                </button>

                <a href="{{ route('admin.jabatan.index') }}"
                    class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded-lg">
                    Batal
                </a>

            </div>

        </form>

    </div>

</x-app-layout>