<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    // Menyimpan data baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'gambar'      => 'nullable|string',
            'kategori_id' => 'required|integer',
        ]);

        $post = Post::create($validated);

        return response()->json([
            'message' => 'Post berhasil dibuat',
            'data'    => $post->load('kategori') // tampilkan kategori juga
        ], 201);
    }

    // Menampilkan detail post berdasarkan id beserta kategori
    public function show($id)
    {
        $post = Post::with('kategori')->findOrFail($id);
        return response()->json($post);
    }

    // Update data post
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title'       => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'gambar'      => 'nullable|string',
            'kategori_id' => 'sometimes|required|integer',
        ]);

        $post = Post::findOrFail($id);
        $post->update($validated);

        return response()->json([
            'message' => 'Post berhasil diupdate',
            'data'    => $post->load('kategori')
        ]);
    }

    // Hapus data post
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return response()->json([
            'message' => 'Post berhasil dihapus'
        ]);
    }

    public function index()
{
    $posts = Post::with('kategori')->get();
    return view('posts', compact('posts'));
}

}
