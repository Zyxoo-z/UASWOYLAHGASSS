@extends('layout.layout')

@section('konten')
<div class="container py-5">
    <div class="d-flex align-items-center mb-4">
        <a href="/" class="btn btn-outline-secondary me-3 rounded-circle" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
            <i class="bi bi-arrow-left"></i>
        </a>
        <h2 class="fw-bold mb-0">Kategori: {{ $category->nama_kategori }}</h2>
    </div>
    <hr>
    
    <div class="row g-4">
        @forelse($destinations as $dest)
            <div class="col-6 col-md-3">
                <a href="{{ route('destinasi.show', $dest->id) }}" class="text-decoration-none text-dark">
                    <div class="card card-destinasi border-0 shadow-sm h-100" style="transition: transform 0.3s; cursor: pointer;">
                        <img src="{{ asset($dest->gambar) }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                        <div class="card-body p-3">
                            <h6 class="fw-bold">{{ $dest->nama_destinasi }}</h6>
                            <p class="text-muted small text-limit-2 mb-0">
                                {{ Str::limit($dest->deskripsi_singkat, 80) }}
                            </p>
                            <div class="mt-2 text-end text-muted" style="font-size: 0.75rem;">
                                <i class="bi bi-eye"></i> {{ $dest->views ?? 0 }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @empty
            <div class="col-12 py-5">
                <div class="text-center">
                    <img src="https://cdn-icons-png.flaticon.com/512/7486/7486744.png" alt="Empty" style="width: 100px; opacity: 0.5;" class="mb-3">
                    <p class="text-muted fs-5">Belum ada destinasi untuk kategori ini.</p>
                    <a href="/" class="btn btn-primary btn-sm px-4 rounded-pill">Kembali ke Beranda</a>
                </div>
            </div>
        @endforelse
    </div>
</div>

<style>
    /* Efek Hover biar kerasa bisa diklik */
    .card-destinasi:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
</style>
@endsection