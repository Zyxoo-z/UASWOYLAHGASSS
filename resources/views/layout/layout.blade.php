<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NusaTrip</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            /* Animasi halus saat seluruh halaman dimuat */
            animation: fadeInPage 0.6s ease-in-out;
        }
        
        @keyframes fadeInPage {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        main { flex: 1; }

        /* Navbar Styling */
        .nav-custom-link {
            position: relative;
            padding-bottom: 5px;
            margin: 0 10px;
            color: #555 !important;
            text-transform: uppercase;
            font-weight: 600;
            font-size: 13px;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        /* Garis bawah menggunakan pseudo-element untuk animasi lebih halus */
        .nav-custom-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 3px;
            bottom: 0;
            left: 0;
            background-color: #ffc107;
            transition: width 0.4s cubic-bezier(0.25, 1, 0.5, 1);
        }

        /* Hover effect */
        .nav-custom-link:hover::after {
            width: 100%;
        }

        /* Animasi khusus untuk Link yang sedang AKTIF */
        .nav-custom-link.active {
            color: #000 !important;
        }

        .nav-custom-link.active::after {
            width: 100%;
            /* Efek 'slide in' saat halaman baru terbuka */
            animation: slideInLine 0.6s ease-out;
        }

        @keyframes slideInLine {
            from { width: 0; }
            to { width: 100%; }
        }

        /* Search Input Styling */
        .search-input-hidden {
            width: 0;
            opacity: 0;
            padding: 0;
            border: none;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            background-color: #f8f9fa;
        }

        .search-input-hidden.show {
            width: 200px;
            opacity: 1;
            padding: 0.25rem 0.75rem;
            border: 1px solid #dee2e6;
            border-radius: 20px;
        }

        /* Footer Styling */
        .footer-dark {
            background-color: #1a1a1a;
            color: #ffffff;
        }

        .footer-link-plain {
            color: #adb5bd !important;
            text-decoration: none;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .footer-link-plain:hover {
            color: #ffc107 !important;
            padding-left: 5px; /* Efek gerak sedikit saat hover */
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg bg-white border-bottom py-2 sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand me-0" href="/">
            <img src="{{ asset('images/logo2.png') }}" alt="Logo" style="height: 60px; width: auto; object-fit: contain;">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navContent">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link nav-custom-link {{ request()->is('/') ? 'active' : '' }}" href="/">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-custom-link {{ request()->is('destinasi*') ? 'active' : '' }}" href="/destinasi">Destinasi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-custom-link {{ request()->is('about') ? 'active' : '' }}" href="/about">Tentang Kami</a>
                </li>
            </ul>

            <div class="d-flex align-items-center position-relative px-3">
                <input type="text" id="input-search-expand" class="form-control form-control-sm search-input-hidden" placeholder="Cari destinasi...">
                <button id="btn-search-toggle" class="btn border-0 p-0 ms-2 text-dark">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</nav>

<main>
    @yield('konten')
</main>

<footer class="footer-dark py-4 mt-auto">
    <div class="container-fluid">
        <ul class="nav justify-content-center border-bottom border-secondary pb-3 mb-3">
            <li class="nav-item"><a href="/" class="nav-link px-3 footer-link-plain">Beranda</a></li>
            <li class="nav-item"><a href="/destinasi" class="nav-link px-3 footer-link-plain">Destinasi</a></li>
            <li class="nav-item"><a href="/about" class="nav-link px-3 footer-link-plain">Tentang Kami</a></li>
        </ul>
        <p class="text-center text-secondary mb-0">© 2025 NusaTrip, Inc. All rights reserved.</p>
    </div>
</footer>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchBtn = document.getElementById('btn-search-toggle');
        const searchInput = document.getElementById('input-search-expand');
        
        searchBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            searchInput.classList.toggle('show');
            if (searchInput.classList.contains('show')) searchInput.focus();
        });

        document.addEventListener('click', function(event) {
            if (!event.target.closest('.navbar')) {
                searchInput.classList.remove('show');
            }
        });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>     