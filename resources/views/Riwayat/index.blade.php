<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Riwayat Penyewaan') }}
        </h2>
    </x-slot>

    @section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-xl font-semibold mb-6">Riwayat Penyewaan Gedung</h3>

                    <table class="min-w-full table-auto border-collapse border border-gray-200">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 border">No</th>
                                <th class="px-4 py-2 border">Nama Gedung</th>
                                <th class="px-4 py-2 border">Nama Penyewa</th>
                                <th class="px-4 py-2 border">Total Harga Sewa</th>
                                <th class="px-4 py-2 border">Status Penyewaan</th>
                                <th class="px-4 py-2 border">Tanggal Penyewaan</th>
                                <th class="px-4 py-2 border">Tanggal Selesai</th>
                                <th class="px-4 py-2 border">Detail Acara</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($riwayats as $index => $riwayat)
                            <tr>
                                <td class="px-4 py-2 border text-center">{{ $index + 1 }}</td>
                                
                                <!-- Memastikan gedung ada atau tidak -->
                                <td class="px-4 py-2 border">
                                    @if($riwayat->penyewaan->gedung)
                                        @if($riwayat->penyewaan->gedung->trashed())
                                            <span class="text-yellow-500">Gedung (Dihapus): {{ $riwayat->penyewaan->gedung->nama_gedung }}</span>
                                        @else
                                            {{ $riwayat->penyewaan->gedung->nama_gedung }}
                                        @endif
                                    @else
                                        <span class="text-red-500">Gedung tidak tersedia</span>
                                    @endif
                                </td>                                
                                
                                <!-- Memastikan user ada atau tidak -->
                                <td class="px-4 py-2 border">
                                    @if($riwayat->penyewaan->user)
                                        {{ $riwayat->penyewaan->user->nama }}
                                    @else
                                        <span class="text-red-500">Pengguna tidak ditemukan</span>
                                    @endif
                                </td>

                                <td class="px-4 py-2 border">Rp {{ number_format($riwayat->total_harga_sewa, 0, ',', '.') }}</td>

                                <td class="px-4 py-2 border text-center">
                                    @if ($riwayat->penyewaan->confirmed_status === 'confirmed')
                                        <span class="text-green-600 font-semibold">Terverifikasi</span>
                                    @elseif ($riwayat->penyewaan->confirmed_status === 'rejected')
                                        <span class="text-red-600 font-semibold">Dibatalkan</span>
                                    @else
                                        <span class="text-gray-500">Menunggu Konfirmasi</span>
                                    @endif
                                </td>

                                <td class="px-4 py-2 border">{{ $riwayat->penyewaan->tanggal_mulai }}</td>
                                <td class="px-4 py-2 border">{{ $riwayat->penyewaan->tanggal_selesai }}</td>

                                <!-- Memastikan detail acara tidak null -->
                                <td class="px-4 py-2 border text-center">
                                    @if($riwayat->penyewaan->detail_acara)
                                        {{ $riwayat->penyewaan->detail_acara }}
                                    @else
                                        <span class="text-gray-500">Detail acara tidak tersedia</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-gray-500 py-4">
                                    Tidak ada data riwayat penyewaan yang tersedia.
                                </td>
                            </tr>
                        @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endsection
</x-app-layout>
