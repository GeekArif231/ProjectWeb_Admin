<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Admin') }}
        </h2>
    </x-slot>
@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                
                <!-- Melihat Daftar Gedung -->
                <div class="bg-white border rounded-lg p-4 shadow-lg">
                    <a href="{{ route('gedung.index') }}" class="text-lg font-semibold text-gray-800 hover:text-blue-600">
                        Melihat Daftar Gedung
                    </a>
                    <p class="text-gray-500 mt-2">Lihat semua gedung yang tersedia beserta detailnya.</p>
                </div>

                <!-- Mencari Gedung -->
                <div class="bg-white border rounded-lg p-4 shadow-lg">
                    <a href="{{ '#' }}" class="text-lg font-semibold text-gray-800 hover:text-blue-600">
                        Mencari Gedung
                    </a>
                    <p class="text-gray-500 mt-2">Cari gedung berdasarkan nama atau filter.</p>
                </div>

                <!-- Melihat Ketersediaan Gedung -->
                <div class="bg-white border rounded-lg p-4 shadow-lg">
                    <a href="{{ '#' }}" class="text-lg font-semibold text-gray-800 hover:text-blue-600">
                        Melihat Ketersediaan Gedung
                    </a>
                    <p class="text-gray-500 mt-2">Periksa ketersediaan gedung menggunakan kalender.</p>
                </div>

                <!-- Membatalkan Jadwal Penyewaan -->
                <div class="bg-white border rounded-lg p-4 shadow-lg">
                    <a href="{{'#'}}" class="text-lg font-semibold text-gray-800 hover:text-blue-600">
                        Membatalkan Jadwal Penyewaan
                    </a>
                    <p class="text-gray-500 mt-2">Batalkan penyewaan yang belum atau sudah dikonfirmasi.</p>
                </div>

                <!-- Menambah Data Gedung -->
                <div class="bg-white border rounded-lg p-4 shadow-lg">
                    <a href="{{ route('gedungs.create') }}" class="text-lg font-semibold text-gray-800 hover:text-blue-600">
                        Menambah Data Gedung
                    </a>
                    <p class="text-gray-500 mt-2">Tambahkan gedung baru ke dalam sistem.</p>
                </div>

                <!-- Mengedit Data Gedung -->
                <div class="bg-white border rounded-lg p-4 shadow-lg">
                        @foreach ($gedungs as $gedung)
                        @endforeach
                        <a href="{{ route('gedungs.edit', $gedung->id) }}" class="text-lg font-semibold text-gray-800 hover:text-blue-600">
                            Mengedit Data Gedung
                        </a>
                        <p class="text-gray-500 mt-2">Edit informasi gedung yang sudah ada.</p>
                    </div>

                <!-- Konfirmasi Jadwal Penyewaan -->
                <div class="bg-white border rounded-lg p-4 shadow-lg">
                    <a href="{{'#' }}" class="text-lg font-semibold text-gray-800 hover:text-blue-600">
                        Konfirmasi Jadwal Penyewaan
                    </a>
                    <p class="text-gray-500 mt-2">Konfirmasi atau tolak penyewaan yang diajukan customer.</p>
                </div>

                <!-- Melihat Riwayat Penyewaan -->
                <div class="bg-white border rounded-lg p-4 shadow-lg">
                    <a href="{{ route('riwayat.index') }}" class="text-lg font-semibold text-gray-800 hover:text-blue-600">
                        Melihat Riwayat Penyewaan
                    </a>
                    <p class="text-gray-500 mt-2">Lihat riwayat penyewaan yang telah dilakukan.</p>
                </div>
            </div>
        </div>
    </div>
    @endsection
</x-app-layout>
