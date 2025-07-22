<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Tambah Transaksi Keuangan
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-700 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('keuangan.store') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 gap-6">
                            <div>
                                <x-label for="keterangan" :value="__('Keterangan')" />
                                <x-input name="keterangan" 
                                placeholder="Keterangan"
                                description="Masukkan Keterangan" class="block mt-1 w-full" type="text" name="keterangan" :value="old('keterangan')" required autofocus />
                                @error('keterangan')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <x-label for="jenis" :value="__('Jenis Transaksi')" />
                                    <select id="jenis" name="jenis" class="block mt-1 w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-600 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm" required>
                                        <option value="">Pilih Jenis</option>
                                        <option value="pemasukan" {{ old('jenis') == 'pemasukan' ? 'selected' : '' }}>Pemasukan</option>
                                        <option value="pengeluaran" {{ old('jenis') == 'pengeluaran' ? 'selected' : '' }}>Pengeluaran</option>
                                    </select>
                                    @error('jenis')
                                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <x-label for="jumlah" :value="__('Jumlah (Rp)')" />
                                    <x-input name="jumlah" 
                                    placeholder="Nominal Uang"
                                    description="Masukkan Nominal Uang" class="block mt-1 w-full" type="number" name="jumlah" :value="old('jumlah')" required />
                                    @error('jumlah')
                                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div>
                                <x-label for="tanggal" :value="__('Tanggal Transaksi')" />
                                <x-input name="tanggal" 
                                placeholder="Tanggal"
                                description="Sesuaikan Tanggal" class="block mt-1 w-full" type="date" name="tanggal" :value="old('tanggal', date('Y-m-d'))" required />
                                @error('tanggal')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('keuangan.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 mr-2">
                                Batal
                            </a>
                            <x-button type="submit" variant="primary">
                                Simpan Data
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>