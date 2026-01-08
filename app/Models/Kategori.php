<?php

namespace App\Models;
use App\Models\Post;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategoris'; // sesuaikan dengan nama tabel di migration

    protected $fillable = ['nama'];

    // Relasi: satu kategori punya banyak post
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}