<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Dashboard Fakultas Hukum UNS
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Kartu Statistik -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <!-- Total Mahasiswa -->
                <div class="bg-white dark:bg-gray-700 rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">
                        Komposisi Fakultas
                    </h3>
                    <div class="h-64">
                        <canvas id="pieChart"></canvas>
                    </div>
                    <div class="mt-4 text-center">
                        <p class="text-sm text-gray-600 dark:text-gray-300">
                            Total: {{ $totalMahasiswa + $totalDosen }} Orang
                        </p>
                    </div>
                </div>
                
                <div class="bg-white dark:bg-gray-700 rounded-lg shadow p-6 transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-purple-100 dark:bg-purple-800 text-purple-600 dark:text-purple-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-gray-500 dark:text-gray-300 text-sm font-medium">Total Mahasiswa</h3>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $totalMahasiswa }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Terdaftar di Fakultas</p>
                        </div>
                    </div>
                </div>

                <!-- Total Dosen -->
                <div class="bg-white dark:bg-gray-700 rounded-lg shadow p-6 transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-pink-100 dark:bg-pink-800 text-pink-600 dark:text-pink-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-gray-500 dark:text-gray-300 text-sm font-medium">Total Dosen</h3>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $totalDosen }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Pengajar aktif</p>
                        </div>
                    </div>
                </div>

                <!-- Saldo Keuangan -->
                <div class="bg-white dark:bg-gray-700 rounded-lg shadow p-6 transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-indigo-100 dark:bg-indigo-800 text-indigo-600 dark:text-indigo-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-gray-500 dark:text-gray-300 text-sm font-medium">Saldo Keuangan</h3>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">Rp {{ number_format($saldo, 0, ',', '.') }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Saldo terkini</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Grafik dan Tabel Ringkasan -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Grafik Mahasiswa per Angkatan -->
                <div class="bg-white dark:bg-gray-700 rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Distribusi Mahasiswa per Angkatan</h3>
                    <div class="h-64">
                        <canvas id="mahasiswaChart"></canvas>
                    </div>
                </div>

                <!-- Aktivitas Terbaru -->
                <div class="bg-white dark:bg-gray-700 rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Aktivitas Terkini</h3>
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-purple-100 dark:bg-purple-800 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-600 dark:text-purple-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-900 dark:text-white">Data mahasiswa baru ditambahkan</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400">2 menit yang lalu</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-pink-100 dark:bg-pink-800 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-pink-600 dark:text-pink-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-900 dark:text-white">Data dosen diperbarui</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400">1 jam yang lalu</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-indigo-100 dark:bg-indigo-800 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-600 dark:text-indigo-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-900 dark:text-white">Transaksi keuangan baru</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400">3 jam yang lalu</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            @can('admin-access')
            <div class="mt-6 bg-white dark:bg-gray-700 rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Aksi Cepat</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <a href="{{ route('mahasiswa.create') }}" class="flex flex-col items-center justify-center p-4 rounded-lg bg-purple-50 dark:bg-purple-900 hover:bg-purple-100 dark:hover:bg-purple-800 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-purple-600 dark:text-purple-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                        <span class="mt-2 text-sm font-medium text-gray-700 dark:text-gray-300">Tambah Mahasiswa</span>
                    </a>
                    <a href="{{ route('dosen.create') }}" class="flex flex-col items-center justify-center p-4 rounded-lg bg-pink-50 dark:bg-pink-900 hover:bg-pink-100 dark:hover:bg-pink-800 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-pink-600 dark:text-pink-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        <span class="mt-2 text-sm font-medium text-gray-700 dark:text-gray-300">Tambah Dosen</span>
                    </a>
                    <a href="{{ route('keuangan.create') }}" class="flex flex-col items-center justify-center p-4 rounded-lg bg-indigo-50 dark:bg-indigo-900 hover:bg-indigo-100 dark:hover:bg-indigo-800 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-600 dark:text-indigo-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="mt-2 text-sm font-medium text-gray-700 dark:text-gray-300">Catat Transaksi</span>
                    </a>
                    <a href="{{ route('keuangan.index') }}" class="flex flex-col items-center justify-center p-4 rounded-lg bg-green-50 dark:bg-green-900 hover:bg-green-100 dark:hover:bg-green-800 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600 dark:text-green-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2z" />
                        </svg>
                        <span class="mt-2 text-sm font-medium text-gray-700 dark:text-gray-300">Laporan Keuangan</span>
                    </a>
                </div>
            </div>
            @endcan
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Pie Chart
        const pieCtx = document.getElementById('pieChart').getContext('2d');
        new Chart(pieCtx, {
            type: 'pie',
            data: {
                labels: @json($pieData['labels']),
                datasets: [{
                    data: @json($pieData['data']),
                    backgroundColor: @json($pieData['colors']),
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const value = context.raw;
                                const percentage = Math.round((value / total) * 100);
                                return `${context.label}: ${value} (${percentage}%)`;
                            }
                        }
                    }
                }
            }
        });
    });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Grafik Mahasiswa
            const ctx = document.getElementById('mahasiswaChart').getContext('2d');
            const mahasiswaChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['2018', '2019', '2020', '2021', '2022', '2023'],
                    datasets: [{
                        label: 'Jumlah Mahasiswa',
                        data: [120, 150, 180, 200, 220, 250],
                        backgroundColor: 'rgba(124, 58, 237, 0.7)',
                        borderColor: 'rgba(124, 58, 237, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });
        });
    </script>
</x-app-layout>