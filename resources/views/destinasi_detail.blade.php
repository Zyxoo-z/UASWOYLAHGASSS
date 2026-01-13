@extends('layout.layout')

@section('konten')
<style>
    /* Membuat pembungkus konten agar terpusat di tengah */
    .detail-centered-wrapper {
        max-width: 900px; /* Lebar maksimal agar tidak terlalu lebar di layar besar */
        margin: 0 auto;   /* Membuat konten berada di tengah */
    }

    .detail-img-main {
        width: 100%;
        height: 500px;
        object-fit: cover;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }

    .breadcrumb-nav {
        font-size: 0.9rem;
        margin-bottom: 25px;
    }

    .title-text {
        font-family: 'Playfair Display', serif;
        font-size: 3.5rem;
        font-weight: 700;
        margin-top: 20px;
    }
</style>

<div class="container py-5">
    <div class="detail-centered-wrapper">
        
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <ol class="breadcrumb bg-transparent p-0">
                <li class="breadcrumb-item"><a href="/destinasi" class="text-decoration-none text-muted">Destinasi</a></li>
                <li class="breadcrumb-item active text-primary fw-bold">
                    {{ $dest->nama_destinasi ?? 'Detail Destinasi' }}
                </li>
            </ol>
        </nav>

        <img src="{{ asset($dest->gambar ?? 'images/default.jpg') }}" 
             class="detail-img-main mb-5" 
             alt="{{ $dest->nama_destinasi ?? 'Gambar' }}">

        <div class="mb-4">
            <span class="badge bg-primary px-3 py-2 rounded-pill mb-3">
                {{ $dest->category->nama_kategori ?? 'Kategori Umum' }}
            </span>
            <h1 class="title-text">{{ $dest->nama_destinasi ?? 'Nama Destinasi Tidak Ditemukan' }}</h1>
        </div>

        <div class="p-4 bg-light rounded border-start border-4 border-warning mb-4">
    <p class="mb-0 fst-italic text-secondary" style="font-size: 1.1rem;">
        "{{ $dest->deskripsi_singkat }}"
    </p>
</div>

<div class="d-flex align-items-center mb-4 text-muted small">
    <div class="me-3"><i class="bi bi-eye"></i> Dibaca {{ $dest->views }} kali</div>
    <div class="me-3"><i class="bi bi-calendar"></i> {{ $dest->created_at->format('d M Y') }}</div>
    <div><i class="bi bi-person"></i> Tim Redaksi</div>
</div>

<div class="article-body" style="line-height: 1.8; font-size: 1.1rem; text-align: justify; color: #333;">
    {!! nl2br(e($dest->konten ?? 'Belum ada artikel lengkap. Hubungi admin.')) !!}
</div>

        <div class="mt-5 pt-4 border-top text-center">
            <a href="/destinasi" class="btn btn-outline-secondary px-5 rounded-pill">
                Kembali ke Daftar Destinasi
            </a>
        </div>
    </div>
</div>
@endsection