<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';

protected $fillable = ['title','description','gambar','kategori_id'];
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
    
}