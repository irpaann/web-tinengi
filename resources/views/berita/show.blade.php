<x-app-layout>
    <div class="max-w-4xl mx-auto py-6">

        {{-- Card Detail Berita --}}
        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
            <h1 class="text-2xl font-bold mb-4">{{ $beritum->judul }}</h1>

            {{-- Gambar --}}
            @if($beritum->gambar)
                <img src="{{ asset($beritum->gambar) }}" 
                     alt="{{ $beritum->judul }}" 
                     class="w-full h-80 object-cover rounded-lg mb-4">
            @endif

            {{-- Isi Berita --}}
            <p class="text-gray-700 dark:text-gray-300 leading-relaxed">
                {{ $beritum->isi }}
            </p>
        </div>

        {{-- Tombol Edit & Hapus --}}
        <div class="flex space-x-4 mt-6">
            <a href="{{ route('berita.edit', $beritum->id) }}"
               class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                Edit
            </a>
            <a href="{{ route('berita.index', $beritum->id) }}"
               class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                Kembali
            </a>

            <form action="{{ route('berita.destroy', $beritum->id) }}" method="POST"
                  onsubmit="return confirm('Yakin ingin menghapus berita ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                    Hapus
                </button>
            </form>
        </div>

    </div>
</x-app-layout>
