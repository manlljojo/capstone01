<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Laman | Admin</title>
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
        <div class="container-xxl position-relative p-0">
            <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
                <a href="" class="navbar-brand p-0">
                    <h1 class="m-0">Ujikom Tiket</h1>
                    <!-- <img src="img/logo.png" alt="Logo"> -->
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav mx-auto py-0">
                        @if(Auth::check())
                        <a href="/admin" class="nav-item nav-link">Halaman Admin</a>
                        <a href="/daftar" class="nav-item nav-link">Laporan Daftar Penonton</a>
                        <a href="/logout" class="nav-item nav-link">Logout</a>
                        @else
                        <a href="/" class="nav-item nav-link">Home</a>
                        <a href="/tiket#down" class="nav-item nav-link">Tiket</a>
                        <a href="/login#down" class="nav-item nav-link">Login</a>
                        @endif
                        </div>
                    </div>
                </div>
            </nav>
            <div class="container-xxl bg-primary hero-header">
                <div class="container px-lg-5">
                    <div class="row g-5 align-items-end">
                        <div class="col-lg-6 text-center text-lg-start">    
                        </div>
                        <div class="p-6">

        {{-- Notifikasi --}}
        @if(session('success'))
            <div class="mb-4 text-green-600">
                {{ session('success') }}
            </div>
        @endif

        {{-- Tombol Tambah --}}
        <a href="{{ route('events.create') }}">
            <button class="">
                + Tambah Event
            </button>
        </a>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="table">
                <thead class="">
                    <tr>
                        <th class="p-2">ID</th>
                        <th class="p-2">Banner</th>
                        <th class="p-2">Nama Event</th>
                        <th class="p-2">Kategori</th>
                        <th class="p-2">Tanggal</th>
                        <th class="p-2">Lokasi</th>
                        <th class="p-2">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($events as $event)
                    <tr class="text-center border-t">
                        <td class="p-2">{{ $event->id }}</td>

                        <td class="p-2">
                            @if($event->banner)
                                <img src="{{ asset('storage/banners/' . $event->banner) }}" 
                                     class="w-20 h-14 object-cover mx-auto">
                            @else
                                -
                            @endif
                        </td>

                        <td class="p-2">{{ $event->nama_event }}</td>
                        <td class="p-2">{{ $event->kategori }}</td>
                        <td class="p-2">{{ $event->tanggal }}</td>
                        <td class="p-2">{{ $event->lokasi }}</td>

                        <td class="p-2">
                            <a href="{{ route('events.edit', $event->id) }}">
                                <button class="bg-yellow-400 px-2 py-1 rounded">Edit</button>
                            </a>

                            <form action="{{ route('events.destroy', $event->id) }}" 
                                  method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button class="bg-red-500 text-white px-2 py-1 rounded"
                                        onclick="return confirm('Yakin hapus?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Navbar & Hero End -->
        <div class="container-xxl py-5">
            <div class="container py-5 px-lg-5" id="down">
            <h2>List Peserta</h2><br>


            </div>
        </div>

        <div class="container-fluid bg-primary text-light footer wow fadeIn" data-wow-delay="0.1s">
            <div class="container px-lg-5">
                <div class="copyright">
                    <div class="row">
                        <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                            &copy; <a class="border-bottom" href="#">JMT Training</a>, All Right Reserved. 
							
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