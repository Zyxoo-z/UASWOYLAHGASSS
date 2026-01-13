@extends('layout.layout')

@section('konten')
<div class="container py-5">
    <h2 class="fw-bold mb-4">Destinasi: {{ $category->nama_kategori }}</h2>
    <hr>
    
    <div class="row g-4">
        @forelse($destinations as $dest)
            <div class="col-6 col-md-3">
                <div class="card card-destinasi border-0 shadow-sm">
                    <img src="{{ asset($dest->gambar) }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                    <div class="card-body p-3">
                        <h6 class="fw-bold">{{ $dest->nama_destinasi }}</h6>
                        <p class="text-muted small text-limit-2">{{ $dest->deskripsi_singkat }}</p>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <p class="text-muted text-center">Belum ada destinasi untuk kategori ini.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection