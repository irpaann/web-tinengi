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

                    <a href="#" class="inline-block bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mb-4">
                        + Tambah Budaya
                    </a>

                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white">
                            <thead class="bg-gray-200">
                                <tr>
                                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Nama</th>
                                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Asal Daerah</th>
                                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-700">
                                @forelse ($budayas as $item)
                                    <tr class="border-b">
                                        <td class="text-left py-3 px-4">{{ $item->nama }}</td>
                                        <td class="text-left py-3 px-4">{{ $item->asal_daerah }}</td>
                                        <td class="text-left py-3 px-4">
                                            <a href="#" class="text-blue-500 hover:text-blue-800">Edit</a>
                                            <a href="#" class="text-red-500 hover:text-red-800 ml-4">Hapus</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center py-4">
                                            Data belum tersedia.
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