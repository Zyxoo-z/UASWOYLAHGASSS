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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');          // judul post
            $table->text('description');      // deskripsi post
            $table->string('gambar')->nullable(); // path/URL gambar (boleh kosong)
            $table->unsignedBigInteger('kategori_id'); // relasi ke kategori
            $table->timestamps();

            // foreign key ke tabel kategoris
            $table->foreign('kategori_id')
                  ->references('id')
                  ->on('kategoris')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};