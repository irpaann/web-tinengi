<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Upload Foto Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    @if (session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('galeri.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div>
                            <x-input-label for="image" :value="__('Pilih File Gambar (Max: 2MB)')" />
                            <input id="image" type="file" name="image" class="block mt-1 w-full text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50" required>
                            <x-input-error :messages="$errors->get('image')" class="mt-2" />
                        </div>
                        
                        <div class="flex items-center justify-end mt-4">
                             <a href="{{ route('galeri.index') }}" class="text-sm text-gray-600 hover:text-gray-900 rounded-md">
                                Batal
                            </a>
                            <x-primary-button class="ms-4">
                                {{ __('Upload') }}
                            </x-primary-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>