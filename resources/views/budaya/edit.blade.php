<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{-- Mengubah judul halaman --}}
            {{ isset($budaya) ? __('Edit Budaya') : __('Tambah Budaya') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                <form method="POST" 
                      {{-- Mengubah action route ke budaya.update dan budaya.store --}}
                      action="{{ isset($budaya) ? route('budaya.update', $budaya->id) : route('budaya.store') }}" 
                      enctype="multipart/form-data">
                    
                    @csrf
                    {{-- Menggunakan variabel $budaya untuk Cek --}}
                    @if(isset($budaya))
                        @method('PUT')
                    @endif

                    <div>
                        <x-input-label for="nama" :value="__('Nama Budaya')" />
                        <x-text-input id="nama" 
                                      class="block mt-1 w-full" 
                                      type="text" 
                                      name="nama" 
                                      {{-- Mengganti field dari judul ke nama --}}
                                      :value="old('nama', $budaya->nama ?? '')" 
                                      required autofocus />
                        <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="deskripsi" :value="__('Deskripsi')" />
                        {{-- Mengganti field dari isi ke deskripsi --}}
                        <textarea id="deskripsi" 
                                  name="deskripsi" 
                                  class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                  rows="6"
                                  required>{{ old('deskripsi', $budaya->deskripsi ?? '') }}</textarea>
                        <x-input-error :messages="$errors->get('deskripsi')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="kategori" :value="__('Kategori')" />

                        {{-- Mengganti text-input dengan tag select --}}
                        <select id="kategori" 
                                name="kategori"
                                class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                required>

                            <option value="" disabled selected>-- Pilih Kategori --</option>
                            
                            {{-- Logika @if untuk menentukan pilihan yang aktif saat edit/validasi error --}}
                            <option value="tarian" @if(old('kategori', $budaya->kategori ?? '') == 'tarian') selected @endif>Tarian</option>
                            <option value="makanan" @if(old('kategori', $budaya->kategori ?? '') == 'makanan') selected @endif>Makanan</option>
                            <option value="upacara adat" @if(old('kategori', $budaya->kategori ?? '') == 'upacara adat') selected @endif>Upacara Adat</option>
                            <option value="wisata budaya" @if(old('kategori', $budaya->kategori ?? '') == 'wisata budaya') selected @endif>Wisata Budaya</option>
                            
                        </select>

                        <x-input-error :messages="$errors->get('kategori')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="gambar" :value="__('Gambar')" />
                        <input id="gambar" type="file" name="gambar" class="block mt-1 w-full text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">Kosongkan jika tidak ingin mengubah gambar.</p>

                        {{-- Menampilkan gambar lama jika ada, dengan path yang benar --}}
                        @if(isset($budaya) && $budaya->gambar)
                            <div class="mt-4">
                                <p class="mb-2 text-sm font-medium text-gray-900 dark:text-white">Gambar Saat Ini:</p>
                                <img src="{{ asset('img/budaya/' . $budaya->gambar) }}" alt="Gambar Lama" class="w-40 h-auto rounded-lg shadow-md">
                            </div>
                        @endif

                        <x-input-error :messages="$errors->get('gambar')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-6">
                        <a href="{{ route('budaya.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            Batal
                        </a>
                        <x-primary-button class="ms-4">
                            {{ isset($budaya) ? __('Update') : __('Simpan') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>