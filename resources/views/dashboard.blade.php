<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Beranda') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="{ activeImage: '/images/foto1.jpg' }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-2 gap-8">
            
            <!-- Bagian Kiri: Foto -->
            <div>
                <!-- Foto Utama -->
                <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
                    <img :src="activeImage" alt="Foto Utama" 
                         class="w-full h-96 object-cover transition duration-300" />
                </div>

                <!-- Thumbnail -->
                <div class="flex space-x-4 mt-6 justify-center">
                    <template x-for="(img, index) in ['/images/foto1.jpg','/images/foto2.jpg','/images/foto3.jpg']" :key="index">
                        <img :src="img" 
                             class="w-24 h-24 object-cover rounded-lg cursor-pointer border-2"
                             :class="{'border-blue-500': activeImage === img, 'border-transparent': activeImage !== img}"
                             @click="activeImage = img" />
                    </template>
                </div>
            </div>

            <!-- Bagian Kanan: Paragraf -->
            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
                <h3 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-4">
                    Tentang Desa Tinengi
                </h3>
                <p class="text-gray-700 dark:text-gray-300 mb-3">
                    Desa Tinengi adalah salah satu desa dengan kekayaan budaya dan alam yang melimpah. 
                    Dengan masyarakat yang ramah serta tradisi yang masih terjaga, desa ini menjadi contoh 
                    bagaimana kearifan lokal tetap lestari di tengah perkembangan zaman.
                </p>
                <p class="text-gray-700 dark:text-gray-300 mb-3">
                    Berbagai kegiatan adat, seni, dan kebudayaan masih aktif dijalankan. Selain itu, 
                    panorama alam yang indah membuat Tinengi menjadi destinasi potensial bagi wisatawan 
                    yang ingin merasakan suasana pedesaan yang asri.
                </p>
                <p class="text-gray-700 dark:text-gray-300">
                    Kami terus berkomitmen mengembangkan potensi desa, baik dari sisi budaya, ekonomi, 
                    maupun pariwisata, dengan tetap menjaga nilai-nilai luhur yang diwariskan leluhur kami.
                </p>
            </div>

        </div>
    </div>
</x-app-layout>
