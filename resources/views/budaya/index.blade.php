<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Budaya') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <a href="{{ route('budaya.create') }}" class="inline-block bg-blue-600 hover:bg-blue-500 text-white font-bold py-2 px-4 rounded mb-4">
                        + Tambah Budaya
                    </a>
                    
                    {{-- Kode dropdown Anda sudah benar dan tidak perlu diubah --}}
                    <x-dropdown align="left" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div>Filter Kategori</div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.08 1.04l-4.25 4.25a.75.75 0 01-1.08 0L5.21 8.27a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                             <x-dropdown-link :href="route('budaya.index')">
                                {{ __('Semua') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('budaya.index', ['kategori' => 'tarian'])">
                                {{ __('Tarian') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('budaya.index', ['kategori' => 'makanan'])">
                                {{ __('Makanan') }}
                            </x-dropdown-link>
                             <x-dropdown-link :href="route('budaya.index', ['kategori' => 'upacara'])">
                                {{ __('Upacara') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('budaya.index', ['kategori' => 'wisata'])">
                                {{ __('Wisata') }}
                            </x-dropdown-link>
                        </x-slot>
                    </x-dropdown>

                    <div class="overflow-x-auto mt-4">
                        <table class="min-w-full bg-white">
                            <thead class="bg-gray-200">
                                <tr>
                                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Nama</th>
                                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Kategori</th>
                                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-700">
                                @forelse ($budayas as $item)
                                    <tr class="border-b">
                                        <td class="text-left py-3 px-4">
                                            {{-- DIUBAH: Nama menjadi link ke halaman detail --}}
                                            <a href="{{ route('budaya.show', $item->id) }}" class="font-bold text-blue-500 hover:underline">
                                                {{ $item->nama }}
                                            </a>
                                        </td>
                                        <td class="text-left py-3 px-4">{{ $item->kategori }}</td>
                                        <td class="text-left py-3 px-4 flex items-center">
                                            {{-- DIUBAH: Link Edit dan Hapus yang benar --}}
                                            <a href="{{ route('budaya.edit', $item->id) }}" class="text-yellow-500 hover:text-yellow-800">Edit</a>
                                            <form action="{{ route('budaya.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');" class="inline-block ml-4">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:text-red-800">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center py-4">
                                            Data belum tersedia atau tidak ditemukan.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>