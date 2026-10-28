<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Detail Laporan Banjir</h2>
    </x-slot>

    @php
        $badge = match ($laporan->status) {
            'Diproses' => 'bg-blue-100 text-blue-700',
            'Selesai'  => 'bg-green-100 text-green-700',
            default    => 'bg-yellow-100 text-yellow-700',
        };
    @endphp

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                {{-- Foto bukti --}}
                @if ($laporan->foto)
                    <a href="{{ asset('storage/' . $laporan->foto) }}" target="_blank">
                        <img src="{{ asset('storage/' . $laporan->foto) }}"
                             alt="Foto laporan {{ $laporan->nama_pelapor }}"
                             class="w-full max-h-96 object-cover rounded mb-6">
                    </a>
                @endif

                <table class="w-full text-left">
                    <tr>
                        <th class="py-2 pe-4 w-40 align-top text-gray-600">Nama Pelapor</th>
                        <td class="py-2">{{ $laporan->nama_pelapor }}</td>
                    </tr>
                    <tr>
                        <th class="py-2 pe-4 align-top text-gray-600">No. HP</th>
                        <td class="py-2">{{ $laporan->no_hp }}</td>
                    </tr>
                    <tr>
                        <th class="py-2 pe-4 align-top text-gray-600">Lokasi</th>
                        <td class="py-2">{{ $laporan->lokasi }}</td>
                    </tr>
                    <tr>
                        <th class="py-2 pe-4 align-top text-gray-600">Kecamatan</th>
                        <td class="py-2">{{ $laporan->kecamatan }}</td>
                    </tr>
                    <tr>
                        <th class="py-2 pe-4 align-top text-gray-600">Tinggi Air</th>
                        <td class="py-2">{{ $laporan->tinggi_air }} cm</td>
                    </tr>
                    <tr>
                        <th class="py-2 pe-4 align-top text-gray-600">Keterangan</th>
                        <td class="py-2">{{ $laporan->keterangan ?: '-' }}</td>
                    </tr>
                    <tr>
                        <th class="py-2 pe-4 align-top text-gray-600">Status</th>
                        <td class="py-2">
                            <span class="px-2 py-1 rounded text-sm {{ $badge }}">{{ $laporan->status }}</span>
                        </td>
                    </tr>
                    <tr>
                        <th class="py-2 pe-4 align-top text-gray-600">Waktu Lapor</th>
                        <td class="py-2">{{ $laporan->created_at->format('d-m-Y H:i') }}</td>
                    </tr>
                </table>

                <div class="mt-6">
                    <a href="{{ route('laporan.edit', $laporan) }}"
                       class="inline-block px-4 py-2 bg-yellow-500 text-white rounded">Edit</a>
                    <a href="{{ route('laporan.index') }}" class="ms-3 text-gray-600">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>