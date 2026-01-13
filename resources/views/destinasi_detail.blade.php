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

<div class="mt-5">
    <hr>
    
    <div class="d-flex align-items-center mb-5">
        <form action="{{ route('destinasi.like', $dest->id) }}" method="POST">
            @csrf
            @auth
                @if($dest->isLikedBy(auth()->user()))
                    <button type="submit" class="btn btn-danger btn-lg rounded-pill px-4 shadow-sm">
                        <i class="bi bi-heart-fill me-2"></i> Disukai
                    </button>
                @else
                    <button type="submit" class="btn btn-outline-danger btn-lg rounded-pill px-4 shadow-sm">
                        <i class="bi bi-heart me-2"></i> Suka
                    </button>
                @endif
            @else
                <a href="{{ route('login') }}" class="btn btn-outline-danger btn-lg rounded-pill px-4 shadow-sm">
                    <i class="bi bi-heart me-2"></i> Suka
                </a>
            @endauth
        </form>
        
        <div class="ms-4">
            <h4 class="mb-0 fw-bold">{{ $dest->likes->count() }}</h4>
            <span class="text-muted small">Orang menyukai ini</span>
        </div>
    </div>

    <h4 class="fw-bold mb-4">Komentar ({{ $dest->comments->count() }})</h4>

    <div class="card bg-light border-0 p-4 mb-4 rounded-3">
        @auth
            <form action="{{ route('destinasi.comment', $dest->id) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-bold">Tulis pendapatmu:</label>
                    <textarea name="body" class="form-control" rows="3" placeholder="Bagaimana menurutmu tempat ini?" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary px-4 rounded-pill">
                    <i class="bi bi-send-fill me-2"></i> Kirim Komentar
                </button>
            </form>
        @else
            <div class="text-center py-3">
                <p class="mb-3 text-muted">Silakan login untuk ikut berdiskusi.</p>
                <a href="{{ route('login') }}" class="btn btn-dark px-4 rounded-pill">Login untuk Komentar</a>
            </div>
        @endauth
    </div>

    <div class="comment-list">
        @forelse($dest->comments as $comment)
            <div class="d-flex mb-4 border-bottom pb-3">
                <div class="flex-shrink-0">
                    <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center fw-bold" 
                         style="width: 50px; height: 50px; font-size: 1.2rem;">
                        {{ substr($comment->user->name, 0, 1) }}
                    </div>
                </div>
                <div class="ms-3 w-100">
                    <div class="d-flex justify-content-between">
                        <h6 class="fw-bold mb-0">{{ $comment->user->name }}</h6>
                        <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                    </div>
                    @if($comment->user->role == 'admin')
                        <span class="badge bg-warning text-dark my-1" style="font-size: 0.7rem;">Admin</span>
                    @endif
                    
                    <p class="mt-2 mb-0 text-dark">{{ $comment->body }}</p>
                </div>
            </div>
        @empty
            <p class="text-muted text-center py-4">Belum ada komentar. Jadilah yang pertama!</p>
        @endforelse
    </div>
</div>

        <div class="mt-5 pt-4 border-top text-center">
            <a href="/destinasi" class="btn btn-outline-secondary px-5 rounded-pill">
                Kembali ke Daftar Destinasi
            </a>
        </div>
    </div>
</div>
@endsection