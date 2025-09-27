<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ isset($beritum) ? __('Edit Berita') : __('Tambah Berita') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                <form method="POST" 
                      action="{{ isset($beritum) ? route('berita.update', $beritum->id) : route('berita.store') }}" 
                      enctype="multipart/form-data">
                    
                    @csrf
                    @if(isset($beritum))
                        @method('PUT')
                    @endif

                    <!-- Judul -->
                    <div>
                        <x-input-label for="judul" :value="__('Judul')" />
                        <x-text-input id="judul" 
                                      class="block mt-1 w-full" 
                                      type="text" 
                                      name="judul" 
                                      value="{{ old('judul', $beritum->judul ?? '') }}" 
                                      required />
                        <x-input-error :messages="$errors->get('judul')" class="mt-2" />
                    </div>

                    <!-- Isi -->
                    <div class="mt-4">
                        <x-input-label for="isi" :value="__('Isi Berita')" />
                        <textarea id="isi" 
                                  name="isi" 
                                  class="block mt-1 w-full rounded-md border-gray-300 shadow-sm">{{ old('isi', $beritum->isi ?? '') }}</textarea>
                        <x-input-error :messages="$errors->get('isi')" class="mt-2" />
                    </div>

                    <!-- Gambar -->
                    <div class="mt-4">
                        <x-input-label for="gambar" :value="__('Gambar')" />
                        <input id="gambar" type="file" name="gambar" class="block mt-1 w-full">

                        @if(isset($beritum) && $beritum->gambar)
                            <img src="{{ asset($beritum->gambar) }}" alt="Gambar Lama" class="w-32 mt-2">
                        @endif

                        <x-input-error :messages="$errors->get('gambar')" class="mt-2" />
                    </div>

                    <!-- Tombol -->
                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button>
                            {{ isset($beritum) ? __('Update') : __('Simpan') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
