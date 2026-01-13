@extends('layout.layout')

@section('konten')
<style>
    .admin-header {
        background: linear-gradient(135deg, #0d6efd 0%, #0043a8 100%);
        color: white;
        padding: 40px 0;
        margin-bottom: 30px;
    }
    .table img {
        width: 100px;
        height: 60px;
        object-fit: cover;
        border-radius: 5px;
    }
    .action-btn {
        width: 35px;
        height: 35px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 5px;
        transition: 0.3s;
    }
</style>

<div class="admin-header shadow-sm">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="fw-bold mb-0">Panel Administrator</h2>
                <p class="mb-0 opacity-75">Kelola data destinasi NusaTrip Anda di sini.</p>
            </div>
            <button class="btn btn-light fw-bold px-4" data-bs-toggle="modal" data-bs-target="#modalTambahDestinasi">
                <i class="bi bi-plus-lg"></i> Tambah Data
            </button>
        </div>
    </div>
</div>

<div class="container pb-5">
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">Gambar</th>
                            <th>Nama Destinasi</th>
                            <th>Kategori</th>
                            <th>Deskripsi Singkat</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($destinations as $dest)
                        <tr>
                            <td class="ps-4">
                                <img src="{{ asset($dest->gambar) }}" alt="{{ $dest->nama_destinasi }}">
                            </td>
                            <td><span class="fw-bold">{{ $dest->nama_destinasi }}</span></td>
                            <td><span class="badge bg-info text-dark">{{ $dest->category->nama_kategori ?? 'Tanpa Kategori' }}</span></td>
                            <td>
                                <small class="text-muted d-block" style="max-width: 300px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                    {{ $dest->deskripsi_singkat }}
                                </small>
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('admin.edit', $dest->id) }}" class="btn btn-warning btn-sm action-btn" title="Edit">
                                        <i class="bi bi-pencil-square text-white"></i>
                                    </a>
                                    
                                    <form action="{{ route('admin.destroy', $dest->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus destinasi ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm action-btn" title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                Belum ada data destinasi. Klik tombol <strong>Tambah Data</strong> untuk memulai.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="mb-3">
    <label class="form-label fw-bold">Isi Artikel Lengkap (Blog)</label>
    <textarea name="konten" class="form-control" rows="8" placeholder="Tulis pengalaman perjalanan lengkap di sini..."></textarea>
</div>

<div class="modal fade" id="modalTambahDestinasi" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title fw-bold">Tambah Destinasi Baru</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('destinasi.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Destinasi</label>
                        <input type="text" name="nama_destinasi" class="form-control" placeholder="Contoh: Gili Terawangan" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Kategori</label>
                        <select name="category_id" class="form-select" required>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Deskripsi Singkat</label>
                        <textarea name="deskripsi_singkat" class="form-control" rows="3" placeholder="Ceritakan sedikit tentang tempat ini..." required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Upload Gambar</label>
                        <input type="file" name="gambar" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary px-4">Simpan Destinasi</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 