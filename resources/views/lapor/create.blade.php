<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lapor Banjir - BPBD Kabupaten Bandung</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100 text-gray-900">

    <div class="bg-white border-b border-gray-200">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 h-14 flex items-center justify-between">
            <span class="font-semibold text-lg">LaporBanjir</span>

            @auth
                <a href="{{ route('dashboard') }}" class="text-sm text-gray-600 hover:text-gray-900">Dashboard Petugas</a>
            @else
                <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:text-gray-900">Login Petugas</a>
            @endauth
        </div>
    </div>

    <div class="py-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-6 px-4 sm:px-0">
                <h1 class="text-2xl font-bold">Form Laporan Banjir</h1>
                <p class="text-gray-600 mt-1">Laporkan kondisi banjir di sekitar Anda kepada BPBD Kabupaten Bandung.</p>
            </div>

            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                @if (session('success'))
                    <div class="mb-4 p-3 rounded bg-green-100 text-green-700">{{ session('success') }}</div>
                @endif

                <form action="{{ route('lapor.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <x-input-label for="nama_pelapor" value="Nama Pelapor" />
                        <x-text-input id="nama_pelapor" name="nama_pelapor" type="text"
                                      class="mt-1 block w-full" :value="old('nama_pelapor')" required autofocus />
                        <x-input-error :messages="$errors->get('nama_pelapor')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="no_hp" value="No. HP" />
                        <x-text-input id="no_hp" name="no_hp" type="text"
                                      class="mt-1 block w-full" :value="old('no_hp')" required />
                        <x-input-error :messages="$errors->get('no_hp')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="lokasi" value="Lokasi Banjir (alamat lengkap)" />
                        <x-text-input id="lokasi" name="lokasi" type="text"
                                      class="mt-1 block w-full" :value="old('lokasi')" required />
                        <x-input-error :messages="$errors->get('lokasi')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="kecamatan" value="Kecamatan" />
                        <x-text-input id="kecamatan" name="kecamatan" type="text"
                                      class="mt-1 block w-full" :value="old('kecamatan')" required />
                        <x-input-error :messages="$errors->get('kecamatan')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="tinggi_air" value="Tinggi Air (cm)" />
                        <x-text-input id="tinggi_air" name="tinggi_air" type="number" min="0"
                                      class="mt-1 block w-full" :value="old('tinggi_air')" required />
                        <x-input-error :messages="$errors->get('tinggi_air')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="keterangan" value="Keterangan (opsional)" />
                        <textarea id="keterangan" name="keterangan" rows="3"
                                  class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('keterangan') }}</textarea>
                        <x-input-error :messages="$errors->get('keterangan')" class="mt-2" />
                    </div>

                    <div class="mb-6">
                        <x-input-label for="foto" value="Foto Kondisi Banjir (jpg, jpeg, png - maks. 2 MB)" />
                        <input id="foto" name="foto" type="file" accept=".jpg,.jpeg,.png"
                               class="mt-1 block w-full" required>
                        <x-input-error :messages="$errors->get('foto')" class="mt-2" />
                    </div>

                    <x-primary-button>Kirim Laporan</x-primary-button>
                </form>
            </div>
        </div>
    </div>

</body>
</html>