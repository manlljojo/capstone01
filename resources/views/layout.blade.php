<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Laman | @yield('title')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500&family=Jost:wght@500;600;700&display=swap" rel="stylesheet"> 

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{asset('lib/animate/animate.min.css')}}" rel="stylesheet">
    <link href="{{asset('lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{asset('lib/lightbox/css/lightbox.min.css')}}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    <style>
        :root {
            --primary: #512da8; /* Smoother deep purple */
            --secondary: #673ab7;
            --accent: #ff9800; /* Original Orange/Amber */
            --dark: #1a1a2e;
            --glass: rgba(255, 255, 255, 0.1);
        }
        
        body {
            font-family: 'Jost', sans-serif;
            scroll-behavior: smooth;
        }

        @if(Request::is('/'))
        .hero-header { margin-bottom: 0 !important; }
        .footer { margin-top: 0 !important; }
        @endif
        
        .bg-primary { background-color: var(--primary) !important; }
        .text-primary { color: var(--primary) !important; }
        .btn-primary { 
            background-color: var(--primary); 
            border-color: var(--primary); 
            color: white;
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        }
        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(81, 45, 168, 0.3);
        }
        
        .btn-outline-primary { 
            color: var(--primary); 
            border-color: var(--primary); 
            transition: all 0.3s ease;
        }
        .btn-outline-primary:hover { 
            background-color: var(--primary); 
            color: white; 
            transform: scale(1.05);
        }
        
        .navbar {
            backdrop-filter: blur(15px);
            background: rgba(26, 26, 46, 0.8) !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }
        
        .hero-header { 
            background: radial-gradient(circle at top right, #673ab7, #512da8) !important;
            padding-bottom: 12rem !important;
            position: relative;
            overflow: hidden;
        }
        
        .hero-header::after {
            content: "";
            position: absolute;
            bottom: -50px;
            left: 0;
            width: 100%;
            height: 100px;
            background: var(--light);
            transform: skewY(-2deg);
        }
    </style>
</head>

<body>
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-grow text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Navbar & Hero Start -->
        <div class="container-xxl position-relative p-0" style="background-color: var(--primary);">
            <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
                <a href="/" class="navbar-brand p-0">
                    <h1 class="m-0 text-white"><i class="fa fa-microphone-alt me-3"></i>Konser Kita</h1>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0">
                        @if(Auth::check())
                            @if(Auth::user()->role == 'admin')
                                <a href="/admin" class="nav-item nav-link">Halaman Admin</a>
                                <a href="/daftar" class="nav-item nav-link">Laporan Penonton</a>
                            @else
                                <a href="/" class="nav-item nav-link">Home</a>
                                <a href="/riwayat" class="nav-item nav-link">Tiket Saya</a>
                            @endif
                            <a href="#about-section" class="nav-item nav-link">Tentang</a>
                            <a href="/logout" class="nav-item nav-link text-danger">Logout</a>
                        @else
                            <a href="/" class="nav-item nav-link">Home</a>
                            <a href="#about-section" class="nav-item nav-link">Tentang</a>
                            <a href="" class="nav-item nav-link">Bantuan</a>
                            <a href="/login#down" class="nav-item nav-link">Login</a>
                        @endif
                    </div>
                </div>
            </nav>

            @if(Request::is('/'))
            <div class="container-xxl bg-primary hero-header" style="padding: 10rem 0 5rem 0; margin-bottom: 0;">
                <div class="container px-lg-5">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show rounded-4" role="alert">
                            <i class="fa fa-check-circle me-2"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="row g-5 align-items-end">
                        <div class="col-lg-6 text-center text-lg-start">
                            @if(Auth::check())
                                @if(Auth::user()->role == 'admin')
                                    <h1 class="text-white mb-4 animated slideInDown">Selamat Datang di Pusat Kendali</h1>
                                    <p class="text-white pb-3 animated slideInDown">Kelola distribusi, harga, dan validasi tiket konser dalam satu panel terpadu dengan mudah.</p>
                                 @else
                                     <h1 class="text-white mb-4 animated slideInDown">Selamat Datang Kembali</h1>
                                     <p class="text-white pb-3 animated slideInDown">Senang melihat Anda kembali. Mari siapkan diri Anda untuk malam penuh kenangan bersama artis favorit Anda.</p>
                                     <a href="#jadwalGrid" id="btnPesanTiket" class="btn py-sm-3 px-sm-5 rounded-pill me-3 animated slideInLeft shadow" style="background-color: var(--accent); color: #000; font-weight: 700;">Jelajahi Konser</a>
                                 @endif
                            @else
                                 @if(request('intent') == 'order')
                                     <h1 class="text-white mb-4 animated headShake">Langkah Sedikit Lagi!</h1>
                                     <p class="text-white pb-3 animated fadeIn">Untuk memproses pesanan tiket konser, silakan masuk ke akun Anda terlebih dahulu agar data tiket tersimpan dengan aman.</p>
                                     <a href="/login?intent=order" class="btn py-sm-3 px-sm-5 rounded-pill me-3 animated slideInLeft shadow" style="background-color: var(--accent); color: #000; font-weight: 700;">Masuk untuk Melanjutkan</a>
                                 @else
                                     <h1 class="text-white mb-4 animated slideInDown">Selamat Datang di Konser Kita</h1>
                                     <p class="text-white pb-3 animated slideInDown">Temukan tiket konser dari musisi-musisi terbaik tanah air. Mulai langkah Anda untuk menyaksikan pertunjukan favorit secara langsung.</p>
                                     <a href="/login?intent=order" class="btn py-sm-3 px-sm-5 rounded-pill me-3 animated slideInLeft shadow" style="background-color: var(--accent); color: #000; font-weight: 700;">Cari Jadwal Konser</a>
                                 @endif
                            @endif
                        </div>
                        <div class="col-lg-6 text-center text-lg-start">
                            <img class="img-fluid animated zoomIn" style="width: 75%; height: 75%;" src="{{asset('img/ticket.png')}}" alt="">
                        </div>
                    </div>
                </div>
            </div>
            @else
                {{-- Spacer for pages without hero to prevent navbar overlap --}}
                <div style="height: 100px;"></div>
            @endif
        </div>
        <!-- Navbar & Hero End -->
        @if(Request::is('/'))
            <div id="down">
                @yield('content')
            </div>
        @else
            <div class="container-xxl py-5">
                <div class="container py-5 px-lg-5" id="down">
                    @yield('content')
                </div>
            </div>
        @endif

        <div class="container-fluid bg-primary text-light footer wow fadeIn" data-wow-delay="0.1s">
            <div class="container px-lg-5">
                <div class="copyright">
                    <div class="row">
                        <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                            &copy; <a class="border-bottom" href="#">Portal Pemesanan Tiket</a>, All Right Reserved. 
							
							<!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
							Template Designed By <a class="border-bottom" href="https://htmlcodex.com">HTML Codex</a>
                        </div>
                        <div class="col-md-6 text-center text-md-end">
                            <div class="footer-menu">
                                <a href="">Home</a>
                                <a href="">Cookies</a>
                                <a href="">Help</a>
                                <a href="">FQAs</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-secondary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('lib/wow/wow.min.js')}}"></script>
    <script src="{{asset('lib/easing/easing.min.js')}}"></script>
    <script src="{{asset('lib/waypoints/waypoints.min.js')}}"></script>
    <script src="{{asset('lib/counterup/counterup.min.js')}}"></script>
    <script src="{{asset('lib/owlcarousel/owl.carousel.min.js')}}"></script>
    <script src="{{asset('lib/isotope/isotope.pkgd.min.js')}}"></script>
    <script src="{{asset('lib/lightbox/js/lightbox.min.js')}}"></script>

    <!-- Template Javascript -->
    <script src="{{asset('js/main.js')}}"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        var btn = document.getElementById('btnPesanTiket');
        if(btn) {
            btn.addEventListener('click', function(e) {
                var grid = document.getElementById('jadwalGrid');
                if(grid) {
                    // Jika grid tersembunyi, tampilkan dulu (untuk guests yang mungkin dialihkan tapi tetap di home)
                    if(grid.classList.contains('d-none')) {
                        grid.classList.remove('d-none');
                        grid.style.opacity = 0;
                        setTimeout(function(){ 
                            grid.style.transition = "opacity 0.8s ease-in-out"; 
                            grid.style.opacity = 1; 
                        }, 50);
                    }
                    grid.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });
        }
    });

    function redirectToEdit(id) {
        window.location.href = "/edit/" + id;
    }
    function submitDeleteForm(id) {
        event.preventDefault();
        document.getElementById('deleteForm' + id).submit();
        }
</script>
</body>

</html>