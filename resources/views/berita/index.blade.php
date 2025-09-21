<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Daftar Berita') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Tombol tambah berita -->
            <div class="mb-4">
                <a href="{{ route('berita.create') }}" 
                   class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                   + Tambah Berita
                </a>
            </div>

            <!-- List berita -->
            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">
                @forelse($beritas as $berita)
                    <div class="mb-6 border-b border-gray-200 dark:border-gray-700 pb-4">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">
                            {{ $berita->judul }}
                        </h3>
                        <p class="mt-2 text-gray-700 dark:text-gray-300">
                            {{ Str::limit($berita->isi, 150) }}
                        </p>
                        <a href="{{ route('berita.show', $berita) }}" 
                           class="text-blue-500 hover:underline mt-2 inline-block">
                           Baca selengkapnya →
                        </a>
                    </div>
                @empty
                    <p class="text-gray-500 dark:text-gray-400">Belum ada berita.</p>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $beritas->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
