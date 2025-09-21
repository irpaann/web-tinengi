<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('budayas', function (Blueprint $table) {
            $table->id();
            $table->string('nama'); // Kolom untuk nama budaya
            $table->text('deskripsi'); // Kolom untuk deskripsi
            $table->string('asal_daerah'); // Kolom untuk asal daerah
            $table->string('gambar')->nullable();
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('budayas');
    }
};
