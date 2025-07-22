<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Manajemen Keuangan Fakultas Hukum UNS
        </h2>
    </x-slot>

    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 mb-6">
        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">
            Perkembangan Keuangan per Tahun
        </h3>
        <div class="chart-container">
            <canvas id="lineChart"></canvas>
        </div>
    </div>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Ringkasan Keuangan -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                        <div class="bg-green-50 dark:bg-green-900 rounded-lg p-4">
                            <h3 class="text-sm font-medium text-green-800 dark:text-green-200">Total Pemasukan</h3>
                            <p class="text-2xl font-bold text-green-600 dark:text-green-300">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</p>
                        </div>
                        <div class="bg-red-50 dark:bg-red-900 rounded-lg p-4">
                            <h3 class="text-sm font-medium text-red-800 dark:text-red-200">Total Pengeluaran</h3>
                            <p class="text-2xl font-bold text-red-600 dark:text-red-300">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</p>
                        </div>
                        <div class="bg-blue-50 dark:bg-blue-900 rounded-lg p-4">
                            <h3 class="text-sm font-medium text-blue-800 dark:text-blue-200">Saldo Akhir</h3>
                            <p class="text-2xl font-bold text-blue-600 dark:text-blue-300">Rp {{ number_format($saldo, 0, ',', '.') }}</p>
                        </div>
                    </div>

                    @can('admin-access')
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Catatan Transaksi</h3>
                        <a href="{{ route('keuangan.create') }}" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md transition-colors flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                            </svg>
                            Tambah Transaksi
                        </a>
                    </div>
                    @endcan


                    <!-- Keuangan Table -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Tanggal
                                        <form action="{{ route('keuangan.index') }}" method="GET" class="inline">
                                            <input type="hidden" name="jenis" value="{{ request('jenis') }}">
                                            <input type="hidden" name="search" value="{{ request('search') }}">
                                            <select name="tahun" onchange="this.form.submit()" 
                                                    class="text-xs font-medium bg-transparent border-none focus:ring-0 focus:border-transparent p-0 text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                                <option value="">Semua Tahun</option>
                                                @foreach($tahunList as $tahun)
                                                    <option value="{{ $tahun }}" {{ request('tahun') == $tahun ? 'selected' : '' }}>
                                                        {{ $tahun }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </form>
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Keterangan
                                        <!-- Search Box -->
                                        <form action="{{ route('keuangan.index') }}" method="GET" class="mt-1">
                                            <input type="hidden" name="tahun" value="{{ request('tahun') }}">
                                            <input type="hidden" name="jenis" value="{{ request('jenis') }}">
                                            <input type="text" name="search" value="{{ request('search') }}" 
                                                placeholder="Cari keterangan"
                                                class="w-full text-xs rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200">
                                            <button type="submit" class="hidden">Submit</button>
                                        </form>
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Jenis
                                        <form action="{{ route('keuangan.index') }}" method="GET" class="inline">
                                            <input type="hidden" name="tahun" value="{{ request('tahun') }}">
                                            <input type="hidden" name="search" value="{{ request('search') }}">
                                            <select name="jenis" onchange="this.form.submit()" 
                                                    class="text-xs font-medium bg-transparent border-none focus:ring-0 focus:border-transparent p-0 text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                                <option value="">Semua Jenis</option>
                                                <option value="pemasukan" {{ request('jenis') == 'pemasukan' ? 'selected' : '' }}>Pemasukan</option>
                                                <option value="pengeluaran" {{ request('jenis') == 'pengeluaran' ? 'selected' : '' }}>Pengeluaran</option>
                                            </select>
                                        </form>
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Jumlah</th>
                                    @can('admin-access')
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Aksi</th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-600">
                                @foreach($keuangans as $keuangan)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-200">{{ date('d/m/Y', strtotime($keuangan->tanggal)) }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-200">{{ $keuangan->keterangan }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            {{ $keuangan->jenis === 'pemasukan' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' }}">
                                            {{ ucfirst($keuangan->jenis) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-200">Rp {{ number_format($keuangan->jumlah, 0, ',', '.') }}</td>
                                    @can('admin-access')
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('keuangan.edit', $keuangan->id) }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-300">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                                </svg>
                                            </a>
                                            <form action="{{ route('keuangan.destroy', $keuangan->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-300">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                    @endcan
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $keuangans->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
    /* Style untuk dropdown filter di header */
        thead select {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            background: transparent;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 0px center;
            background-size: 1em;
            padding-right: 1.5em;
            cursor: pointer;
            outline: none;
        }
        
        .dark thead select {
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23e5e7eb' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
        }
        
        /* Hover effect */
        thead select:hover {
            color: #3b82f6;
        }
        .dark thead select:hover {
            color: #93c5fd;
        }
        
        /* Style untuk input search di header */
        thead input[type="text"] {
            background-color: transparent;
            border: none;
            border-bottom: 1px solid #d1d5db;
            padding: 0.25rem 0;
            width: 100%;
        }
        .dark thead input[type="text"] {
            border-bottom-color: #4b5563;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('lineChart');
            
            const tahunData = @json($chartData->pluck('tahun'));
            const pemasukanData = @json($chartData->pluck('pemasukan'));
            const pengeluaranData = @json($chartData->pluck('pengeluaran'));
            
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: tahunData,
                    datasets: [
                        {
                            label: 'Pemasukan',
                            data: pemasukanData,
                            borderColor: '#10B981',
                            backgroundColor: 'rgba(16, 185, 129, 0.1)',
                            borderWidth: 2,
                            tension: 0.3,
                            fill: true
                        },
                        {
                            label: 'Pengeluaran',
                            data: pengeluaranData,
                            borderColor: '#EF4444',
                            backgroundColor: 'rgba(239, 68, 68, 0.1)',
                            borderWidth: 2,
                            tension: 0.3,
                            fill: true
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top',
                            labels: {
                                color: window.matchMedia('(prefers-color-scheme: dark)').matches ? '#e5e7eb' : '#374151'
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return context.dataset.label + ': Rp ' + context.raw.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return 'Rp ' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                                },
                                color: window.matchMedia('(prefers-color-scheme: dark)').matches ? '#e5e7eb' : '#374151'
                            },
                            grid: {
                                color: window.matchMedia('(prefers-color-scheme: dark)').matches ? 'rgba(229, 231, 235, 0.1)' : 'rgba(0, 0, 0, 0.1)'
                            }
                        },
                        x: {
                            ticks: {
                                color: window.matchMedia('(prefers-color-scheme: dark)').matches ? '#e5e7eb' : '#374151'
                            },
                            grid: {
                                color: window.matchMedia('(prefers-color-scheme: dark)').matches ? 'rgba(229, 231, 235, 0.1)' : 'rgba(0, 0, 0, 0.1)'
                            }
                        }
                    }
                }
            });
        });
    </script>
</x-app-layout>