@extends('layout.layout')
@section('konten')



<style>
    /* CSS Khusus untuk menyesuaikan tampilan gambar referensi */
    .hero-container {
        position: relative;
        height: 230px; /* Tinggi banner sesuai gambar */
        overflow: hidden;
    }

    .hero-img {
        height: 100%;
        object-fit: cover;
        filter: brightness(85%); /* Sedikit gelap agar teks putih menonjol */
    }

    .carousel-caption {
        top: 50% !important;
        bottom: auto !important;
        transform: translateY(-50%);
        text-align: center;
    }

    .breadcrumb-style {
        font-size: 0.75rem;
        letter-spacing: 1px;
        margin-bottom: 0;
        font-family: 'Arial', sans-serif;
        font-weight: 300;
        opacity: 0.9;
    }

    .title-destinasi {
        font-family: 'Playfair Display', 'Times New Roman', serif; /* Font bergaya klasik */
        font-size: 3.5rem;
        font-weight: 400;
        margin-top: -5px;
    }

    /* Garis bawah tipis seperti di gambar */
    .title-underline {
        width: 150px;
        height: 1px;
        background-color: rgba(255, 255, 255, 0.5);
        margin: 10px auto;
    }

    .carousel-indicators [data-bs-target] {
        width: 30px;
        height: 3px;
    }
</style>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <div class="hero-container">
                <img src="{{ asset('images/4.jpg') }}" class="d-block w-100 hero-img" alt="Slide 1">
                <div class="carousel-caption">
                    <p class="breadcrumb-style text-uppercase">NusaTrip > Destinasi</p>
                    <h1 class="title-destinasi">Destinasi</h1>
                    <div class="title-underline"></div>
                </div>
            </div>
        </div>
@endsection