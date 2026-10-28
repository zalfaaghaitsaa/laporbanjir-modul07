<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Daftar Laporan Banjir</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                @if (session('success'))
                    <div class="mb-4 p-3 rounded bg-green-100 text-green-700">{{ session('success') }}</div>
                @endif

                <div class="overflow-x-auto">
                    <table class="w-full border text-left">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="border p-2">No</th>
                                <th class="border p-2">Foto</th>
                                <th class="border p-2">Pelapor</th>
                                <th class="border p-2">Lokasi</th>
                                <th class="border p-2">Tinggi Air</th>
                                <th class="border p-2">Status</th>
                                <th class="border p-2">Tanggal</th>
                                <th class="border p-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($laporans as $laporan)
                                @php
                                    $badge = match ($laporan->status) {
                                        'Diproses' => 'bg-blue-100 text-blue-700',
                                        'Selesai'  => 'bg-green-100 text-green-700',
                                        default    => 'bg-yellow-100 text-yellow-700',
                                    };
                                @endphp
                                <tr>
                                    <td class="border p-2">{{ $laporans->firstItem() + $loop->index }}</td>
                                    <td class="border p-2">
                                        @if ($laporan->foto)
                                            <img src="{{ asset('storage/' . $laporan->foto) }}"
                                                 alt="Foto laporan {{ $laporan->nama_pelapor }}"
                                                 class="h-16 w-16 object-cover rounded">
                                        @else
                                            <span class="text-gray-400">-</span>
                                        @endif
                                    </td>
                                    <td class="border p-2">
                                        {{ $laporan->nama_pelapor }}
                                        <div class="text-sm text-gray-500">{{ $laporan->no_hp }}</div>
                                    </td>
                                    <td class="border p-2">
                                        {{ $laporan->lokasi }}
                                        <div class="text-sm text-gray-500">Kec. {{ $laporan->kecamatan }}</div>
                                    </td>
                                    <td class="border p-2">{{ $laporan->tinggi_air }} cm</td>
                                    <td class="border p-2">
                                        <span class="px-2 py-1 rounded text-sm {{ $badge }}">{{ $laporan->status }}</span>
                                    </td>
                                    <td class="border p-2">{{ $laporan->created_at->format('d-m-Y H:i') }}</td>
                                    <td class="border p-2">
                                        <a href="{{ route('laporan.show', $laporan) }}" class="text-sky-600">Lihat</a> |
                                        <a href="{{ route('laporan.edit', $laporan) }}" class="text-yellow-600">Edit</a> |
                                        <form action="{{ route('laporan.destroy', $laporan) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600"
                                                    onclick="return confirm('Yakin ingin menghapus laporan ini?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="border p-2 text-center">Belum ada laporan banjir.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">{{ $laporans->links() }}</div>
            </div>
        </div>
    </div>
</x-app-layout>