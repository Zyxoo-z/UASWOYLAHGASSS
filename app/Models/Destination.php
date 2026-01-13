<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    // REVISI PENTING: Tambahkan 'konten' dan 'views' agar bisa disimpan
    protected $fillable = [
        'category_id', 
        'nama_destinasi', 
        'deskripsi_singkat', 
        'gambar',
        'konten', // <--- Wajib ada biar artikel tersimpan
        'views'   // <--- Wajib ada biar bisa di-reset kalau perlu
    ];

    // Relasi ke Category
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    // Relasi ke Komentar
    public function comments()
    {
        return $this->hasMany(Comment::class)->latest(); // Urutkan dari yg terbaru
    }

    // Relasi ke Likes
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    // Cek apakah user yg login sudah like destinasi ini?
    public function isLikedBy($user)
    {
        if (!$user) return false;
        // Cek apakah di daftar likes ada ID user ini
        return $this->likes->where('user_id', $user->id)->count() > 0;
    }
}