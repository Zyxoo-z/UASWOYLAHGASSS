@extends('layout.layout')

@section('konten')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-warning text-white fw-bold">
                    <i class="bi bi-pencil-square me-2"></i> Edit Destinasi
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.update', $dest->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Destinasi</label>
                            <input type="text" name="nama_destinasi" class="form-control" value="{{ $dest->nama_destinasi }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Kategori</label>
                            <select name="category_id" class="form-select" required>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ $dest->category_id == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Deskripsi Singkat (Intro)</label>
                            <textarea name="deskripsi_singkat" class="form-control" rows="3" required>{{ $dest->deskripsi_singkat }}</textarea>
                            <div class="form-text">Muncul di kartu halaman depan.</div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Konten Artikel Lengkap (Blog)</label>
                            <textarea name="konten" class="form-control" rows="10" placeholder="Tulis cerita lengkap di sini...">{{ $dest->konten }}</textarea>
                            <div class="form-text">Gunakan tombol Enter untuk membuat paragraf baru.</div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Gambar Utama</label>
                            <div class="d-flex align-items-center mb-2">
                                <img src="{{ asset($dest->gambar) }}" alt="Current Image" class="img-thumbnail me-3" style="width: 120px; height: 80px; object-fit: cover;">
                                <div class="small text-muted">Gambar saat ini</div>
                            </div>
                            <input type="file" name="gambar" class="form-control">
                            <div class="form-text">Kosongkan jika tidak ingin mengubah gambar.</div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.index') }}" class="btn btn-secondary px-4">Batal</a>
                            <button type="submit" class="btn btn-primary px-4">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection