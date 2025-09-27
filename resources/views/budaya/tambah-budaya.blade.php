<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">Tambah Berita</h2>
    </x-slot>

    <div class="p-6">
        <form action="{{ route('budaya.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Kategori -->
            <div class="mb-4">
                <x-input-label for="kategori" :value="__('Kategori')" />
                <select name="kategori" id="kategori" 
                        class="mt-1 block w-full border-gray-300 dark:border-gray-700 rounded-md shadow-sm">
                    <option value="">-- Pilih Kategori --</option>
                    <option value="tarian">Tarian</option>
                    <option value="makanan">Makanan</option>
                    <option value="upacara">Upacara</option>
                    <option value="wisata">Wisata</option>
                </select>
            </div>

            <!-- Nama Kebudayaan -->
            <div class="mb-4">
                <x-input-label for="nama" :value="__('Nama Kebudayaan')" />
                <x-text-input id="nama" name="nama" type="text" class="mt-1 block w-full" required />
            </div>

            <!-- Isi -->
            <div class="mb-4">
                <x-input-label for="deskripsi" :value="__('Deskripsi')" />
                <textarea id="deskripsi" name="deskripsi" class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-700"></textarea>
            </div>

            <!-- Upload Gambar -->
            <div class="mb-4">
                <x-input-label for="gambar" :value="__('Gambar')" />
                <input id="gambar" name="gambar" type="file" class="mt-1 block w-full" accept="image/*" />
            </div>

            <x-primary-button >
                Simpan
            </x-primary-button>
            <x-danger-button type="button" 
                onclick="window.location='{{ route('budaya.index') }}'">
                Kembali
            </x-danger-button>


        </form>
    </div>
</x-app-layout>
