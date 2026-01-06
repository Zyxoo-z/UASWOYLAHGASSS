@extends('layout.layout')

@section('konten')

<style>
    /* 1. Mengatur dimensi dan redup gambar */
    .carousel-item {
        height: 700px; 
        min-height: 300px;
        background: #000;
        overflow: hidden;
    }

    .hero-img {
        height: 100%;
        object-fit: cover;
        filter: brightness(60%); /* Efek redup */
        /* Efek Zoom Halus saat slide aktif */
        transition: transform 3s ease; 
    }

    .carousel-item.active .hero-img {
        transform: scale(1.1); /* Gambar sedikit membesar saat aktif */
    }

    /* 2. Animasi Teks Caption */
    .carousel-caption {
        bottom: 10%;
        z-index: 10;
    }

    .carousel-caption h5 {
        font-size: 3rem;
        font-weight: 700;
        text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.8);
        /* Animasi Muncul dari Bawah */
        animation: fadeInUp 1s both;
    }

    .carousel-caption p {
        font-size: 1.2rem;
        text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.8);
        /* Animasi Muncul dengan delay agar lebih halus */
        animation: fadeInUp 1s both 0.3s;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    } 

    

    /* ===== KATEGORI ===== */
.kategori-img {
    width: 90px;
    height: 90px;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.kategori-item:hover .kategori-img {
    transform: scale(1.08);
}

.kategori-title {
    font-size: 14px;
    font-weight: 500;
    margin-top: 10px;
}

</style>

<div id="carouselExampleCaptions" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">
    
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"></button>
    </div>

    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="{{ asset('images/rinjani.jpg') }}" class="d-block w-100 hero-img" alt="Gunung Rinjani">
            <div class="carousel-caption d-none d-md-block">
                <h5>Gunung Rinjani</h5>
                <p>Jelajahi keindahan atap Pulau Lombok yang memukau.</p>
            </div>
        </div>

        <div class="carousel-item">
            <img src="{{ asset('images/bukit-merese.jpg') }}" class="d-block w-100 hero-img" alt="Bukit Merese">
            <div class="carousel-caption d-none d-md-block">
                <h5>Bukit Merese</h5>
                <p>Menikmati hamparan laut biru dari ketinggian bukit.</p>
            </div>
        </div>

        <div class="carousel-item">
            <img src="{{ asset('images/gili.jpg') }}" class="d-block w-100 hero-img" alt="Gili Trawangan">
            <div class="carousel-caption d-none d-md-block">
                <h5>Gili Trawangan</h5>
                <p>Ketenangan pulau tanpa kendaraan bermotor.</p>
            </div>
        </div>
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

</div> <!-- penutup carousel -->

<!-- ===== KATEGORI ===== -->
<section class="py-5">
    <div class="container text-center">

        <h5 class="fw-semibold mb-4">Kategori</h5>

        <div class="row justify-content-center g-4">

            <div class="col-6 col-md-3 kategori-item">
                <img src="{{ asset('images/3.jpg') }}"
                     class="rounded-circle kategori-img shadow-sm"
                     alt="Gunung">
                <p class="kategori-title">Gunung</p>
            </div>

            <div class="col-6 col-md-3 kategori-item">
                <img src="{{ asset('images/4.jpg') }}"
                     class="rounded-circle kategori-img shadow-sm"
                     alt="Pantai">
                <p class="kategori-title">Pantai</p>
            </div>

            <div class="col-6 col-md-3 kategori-item">
                <img src="{{ asset('images/gili.jpg') }}"
                     class="rounded-circle kategori-img shadow-sm"
                     alt="Air Terjun">
                <p class="kategori-title">Air Terjun</p>
            </div>

            <div class="col-6 col-md-3 kategori-item">
                <img src="{{ asset('images/idealis.jpg') }}"
                     class="rounded-circle kategori-img shadow-sm"
                     alt="Tempat Adat">
                <p class="kategori-title">Tempat Adat</p>
            </div>

        </div>
    </div>
</section>
<!-- ===== END KATEGORI ===== -->
@endsection