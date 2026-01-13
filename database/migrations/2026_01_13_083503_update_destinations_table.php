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
    Schema::table('destinations', function (Blueprint $table) {
        // Kolom untuk artikel panjang (biar kayak blog/majalah)
        $table->longText('konten')->nullable()->after('deskripsi_singkat');
        // Kolom untuk menghitung jumlah pengunjung (biar fitur Trending jalan)
        $table->integer('views')->default(0)->after('gambar');
    });
}

public function down(): void
{
    Schema::table('destinations', function (Blueprint $table) {
        $table->dropColumn(['konten', 'views']);
    });
}
};
