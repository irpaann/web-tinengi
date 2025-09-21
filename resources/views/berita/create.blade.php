<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">Tambah Berita</h2>
    </x-slot>

    <div class="p-6">
        <form action="{{ route('berita.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Judul -->
            <div class="mb-4">
                <x-input-label for="judul" :value="__('Judul')" />
                <x-text-input id="judul" name="judul" type="text" class="mt-1 block w-full" required />
            </div>

            <!-- Isi -->
            <div class="mb-4">
                <x-input-label for="isi" :value="__('Isi')" />
                <textarea id="isi" name="isi" class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-700"></textarea>
            </div>

            <!-- Upload Gambar -->
            <div class="mb-4">
                <x-input-label for="gambar" :value="__('Gambar')" />
                <input id="gambar" name="gambar" type="file" class="mt-1 block w-full" accept="image/*" />
            </div>

            <x-primary-button>
                Simpan
            </x-primary-button>
        </form>
    </div>
</x-app-layout>
