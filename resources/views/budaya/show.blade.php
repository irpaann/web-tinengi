<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{-- Menampilkan nama budaya sebagai judul halaman --}}
            {{ $budaya->nama }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <a href="{{ route('budaya.index') }}" class="inline-block bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 rounded mb-4">
                        &larr; Kembali ke Daftar
                    </a>

                    <div class="mb-4">
                        <img src="{{ asset('img/budaya/' . $budaya->gambar) }}" alt="{{ $budaya->nama }}" class="w-full h-auto max-w-lg mx-auto rounded-lg shadow-md">
                    </div>

                    <h3 class="text-2xl font-bold mb-2">{{ $budaya->nama }}</h3>
                    <p class="text-sm text-gray-600 mb-4">
                        <strong>Kategori:</strong> <span class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded">{{ $budaya->kategori }}</span>
                    </p>

                    <div class="prose max-w-none">
                        {!! nl2br(e($budaya->deskripsi)) !!}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>