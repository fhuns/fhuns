<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Edit Data Mahasiswa
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-700 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('mahasiswa.update', $mahasiswa->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-label for="nama" :value="__('Nama Lengkap')" />
                                <x-input 
                                name="nama" 
                                placeholder="Nama Lengkap"
                                description="Masukkan nama lengkap sesuai dokumen resmi" class="block mt-1 w-full" type="text" name="nama" :value="old('nama', $mahasiswa->nama)" required autofocus />
                                @error('nama')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <x-label for="nim" :value="__('NIM')" />
                                <x-input name="nim" 
                                placeholder="NIM"
                                description="Masukkan NIM sesuai dokumen resmi" class="block mt-1 w-full" type="text" name="nim" :value="old('nim', $mahasiswa->nim)" required />
                                @error('nim')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <x-label for="angkatan" :value="__('Angkatan')" />
                                <x-input name="angkatan" 
                                placeholder="Angkatan"
                                description="Masukkan angkatan sesuai dokumen resmi" class="block mt-1 w-full" type="number" name="angkatan" :value="old('angkatan', $mahasiswa->angkatan)" required />
                                @error('angkatan')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <x-label for="prodi" :value="__('Program Studi')" />
                                <x-input name="prodi" 
                                placeholder="Program Studi"
                                description="Masukkan Program Studi sesuai dokumen resmi" class="block mt-1 w-full" type="text" name="prodi" :value="old('prodi', $mahasiswa->prodi)" required />
                                @error('prodi')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('mahasiswa.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 transition-colors mr-2">
                                Batal
                            </a>
                            <x-button type="submit" variant="primary">
                                Perbarui Data
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>