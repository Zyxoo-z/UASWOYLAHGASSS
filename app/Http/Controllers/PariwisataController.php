<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PariwisataController extends Controller
{
    public function index(): View {
        $categories = Category::all(); 
        
        // REVISI: Mengambil destinasi berdasarkan VIEWS terbanyak (Trending)
        // Ambil 8 destinasi terpopuler untuk ditampilkan di Home
        $destinations = Destination::orderBy('views', 'desc')->take(8)->get(); 
        
        return view('welcome', compact('categories', 'destinations'));
    }

    public function store(Request $request) {
        $request->validate([
            'nama_destinasi' => 'required',
            'gambar' => 'required|image|mimes:jpg,png,jpeg',
        ]);
    
        $path = $request->file('gambar')->store('images', 'public');
    
        Destination::create([
            'nama_destinasi' => $request->nama_destinasi,
            'category_id' => $request->category_id,
            'deskripsi_singkat' => $request->deskripsi_singkat,
            'konten' => $request->konten, // REVISI: Simpan artikel panjang
            'gambar' => $path,
        ]);
    
        return back()->with('success', 'Destinasi berhasil ditambah!');
    }

    public function categoryShow($id) {
        $category = Category::findOrFail($id);
        $destinations = Destination::where('category_id', $id)->get();
        return view('category_detail', compact('category', 'destinations'));
    }

    public function adminIndex() {
        $destinations = Destination::with('category')->get(); 
        return view('admin_dashboard', compact('destinations'));
    }

    public function edit($id) {
        $dest = Destination::findOrFail($id);
        $categories = Category::all();
        return view('edit_destinasi', compact('dest', 'categories'));
    }

    public function update(Request $request, $id) {
        $dest = Destination::findOrFail($id);
        
        $request->validate([
            'nama_destinasi' => 'required',
            'category_id' => 'required',
        ]);

        $dest->nama_destinasi = $request->nama_destinasi;
        $dest->category_id = $request->category_id;
        $dest->deskripsi_singkat = $request->deskripsi_singkat;
        $dest->konten = $request->konten; // REVISI: Update artikel panjang juga

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('images', 'public');
            $dest->gambar = $path;
        }

        $dest->save();
        return redirect()->route('admin.index')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy($id) {
        $dest = Destination::findOrFail($id);
        $dest->delete();
        return back()->with('success', 'Data berhasil dihapus!');
    }

    /** * Fungsi allDestinations dengan Logika Search
     */
    public function allDestinations(Request $request)
    {
        // Ambil input keyword dari name="search" di form layout
        $search = $request->input('search');

        // Query dengan filter jika ada search
        $destinations = Destination::with('category')
            ->when($search, function ($query) use ($search) {
                return $query->where('nama_destinasi', 'like', '%' . $search . '%')
                             ->orWhere('deskripsi_singkat', 'like', '%' . $search . '%');
            })
            ->paginate(9)
            ->withQueryString(); // Menjaga parameter search tetap ada saat pindah halaman pagination
        
        return view('destinasi', compact('destinations'));
    }

    public function show($id)
    {
        $dest = Destination::with('category')->findOrFail($id);
        
        // REVISI: Tambah +1 views setiap kali halaman dibuka
        $dest->increment('views'); 

        return view('destinasi_detail', compact('dest'));
    }
}