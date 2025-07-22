<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Daftar Dosen Fakultas Hukum UNS
        </h2>
    </x-slot>

    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 mb-6">
        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">
            Perkembangan Jumlah Dosen per Tahun
        </h3>
        <div class="chart-container">
            <canvas id="lineChart"></canvas>
        </div>
    </div>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @can('admin-access')
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Data Dosen</h3>
                        <a href="{{ route('dosen.create') }}" class="px-4 py-2 bg-pink-600 hover:bg-pink-700 text-white rounded-md transition-colors flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                            </svg>
                            Tambah Data
                        </a>
                    </div>
                    @endcan

                    <!-- Search Box -->
                    <div class="mb-6 bg-white dark:bg-gray-800 p-4 rounded-lg shadow">
                        <form action="{{ route('dosen.index') }}" method="GET" class="flex items-center">
                            <input type="text" name="search" value="{{ request('search') }}" 
                                   placeholder="Cari nama, NIDN, atau jabatan"
                                   class="w-full rounded-l-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200">
                            <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-r-md transition-colors">
                                Cari
                            </button>
                            @if(request()->has('search') || request()->has('prodi'))
                            <a href="{{ route('dosen.index') }}" class="ml-2 px-4 py-2 bg-gray-200 hover:bg-gray-300 dark:bg-gray-600 dark:hover:bg-gray-500 text-gray-800 dark:text-gray-200 rounded-md transition-colors">
                                Reset
                            </a>
                            @endif
                        </form>
                    </div>

                    <!-- Dosen Table with Header Filters -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">No</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">NIDN</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Nama</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Jabatan</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        <form action="{{ route('dosen.index') }}" method="GET" class="inline">
                                            <input type="hidden" name="search" value="{{ request('search') }}">
                                            <select name="prodi" onchange="this.form.submit()" 
                                                    class="text-xs font-medium bg-transparent border-none focus:ring-0 focus:border-transparent p-0 text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                                <option value="">Program Studi</option>
                                                @foreach($prodiList as $prodi)
                                                    <option value="{{ $prodi }}" {{ request('prodi') == $prodi ? 'selected' : '' }}>{{ $prodi }}</option>
                                                @endforeach
                                            </select>
                                        </form>
                                    </th>
                                    @can('admin-access')
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Aksi</th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-600">
                                @foreach($dosens as $key => $dosen)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-200">{{ ($dosens->currentPage() - 1) * $dosens->perPage() + $loop->iteration }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-200">{{ $dosen->nidn }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-200">{{ $dosen->nama }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-200">{{ $dosen->jabatan }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-200">{{ $dosen->prodi }}</td>
                                    @can('admin-access')
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('dosen.edit', $dosen->id) }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-300">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                                </svg>
                                            </a>
                                            <form action="{{ route('dosen.destroy', $dosen->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
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
                        {{ $dosens->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .chart-container {
            position: relative;
            height: 400px;
            width: 100%;
        }
        
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
        
        /* Dark mode */
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
    </style>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('lineChart');
            
            const tahunData = @json($chartData->pluck('tahun'));
            const totalData = @json($chartData->pluck('total'));
            
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: tahunData,
                    datasets: [{
                        label: 'Jumlah Dosen',
                        data: totalData,
                        borderColor: '#3B82F6',
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        borderWidth: 2,
                        tension: 0.3,
                        fill: true
                    }]
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
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0,
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