<<<<<<< HEAD
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Tambah Data Dosen
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-700 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('dosen.store') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-label for="nama" :value="__('Nama Lengkap')" />
                                <x-input name="nama" 
                                placeholder="Nama Lengkap"
                                description="Masukkan Nama Lengkap sesuai dokumen resmi" class="block mt-1 w-full" type="text" name="nama" :value="old('nama')" required autofocus />
                                @error('nama')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <x-label for="nidn" :value="__('NIDN')" />
                                <x-input name="nidn" 
                                placeholder="NIDN"
                                description="Masukkan NIDN sesuai dokumen resmi" class="block mt-1 w-full" type="text" name="nidn" :value="old('nidn')" required />
                                @error('nidn')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="md:col-span-2">
                                <x-label for="jabatan" :value="__('Jabatan')" />
                                <x-input name="jabatan" 
                                placeholder="Jabatan"
                                description="Masukkan Jabatan sesuai dokumen resmi" class="block mt-1 w-full" type="text" name="jabatan" :value="old('jabatan')" required />
                                @error('jabatan')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                        <a href="{{ route('dosen.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 mr-2">
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
=======
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Tambah Data Dosen
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-700 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('dosen.store') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-label for="nama" :value="__('Nama Lengkap')" />
                                <x-input name="nama" 
                                placeholder="Nama Lengkap"
                                description="Masukkan Nama Lengkap sesuai dokumen resmi" class="block mt-1 w-full" type="text" name="nama" :value="old('nama')" required autofocus />
                                @error('nama')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <x-label for="nidn" :value="__('NIDN')" />
                                <x-input name="nidn" 
                                placeholder="NIDN"
                                description="Masukkan NIDN sesuai dokumen resmi" class="block mt-1 w-full" type="text" name="nidn" :value="old('nidn')" required />
                                @error('nidn')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="md:col-span-2">
                                <x-label for="jabatan" :value="__('Jabatan')" />
                                <x-input name="jabatan" 
                                placeholder="Jabatan"
                                description="Masukkan Jabatan sesuai dokumen resmi" class="block mt-1 w-full" type="text" name="jabatan" :value="old('jabatan')" required />
                                @error('jabatan')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                        <a href="{{ route('dosen.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 mr-2">
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
>>>>>>> 73e07dd84717740e5df42ff0c7114498e363b799
</x-app-layout>