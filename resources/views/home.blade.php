@extends('layout')
@section('title','Home')
@section('content')
<style>
    .card-modern {
        border: none;
        border-radius: 1.5rem;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        background: rgba(255, 255, 255, 1);
        overflow: hidden;
    }
    .card-modern:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(81, 45, 168, 0.2);
    }
    .text-orange { color: var(--accent) !important; }
    .text-rose { color: var(--secondary) !important; }
    
    .search-wrapper {
        background: white;
        border-radius: 50px;
        padding: 5px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        display: flex;
        align-items: center;
        max-width: 700px;
        margin: -40px auto 40px auto;
        position: relative;
        z-index: 10;
    }
    .search-wrapper input {
        border: none;
        padding: 15px 25px;
        border-radius: 50px;
        flex-grow: 1;
        outline: none;
    }
    .search-wrapper button {
        background: var(--primary);
        color: white;
        border: none;
        padding: 12px 30px;
        border-radius: 50px;
        font-weight: bold;
        transition: 0.3s;
    }
    .search-wrapper button:hover {
        background: var(--secondary);
    }
    
    .artist-chip {
        display: inline-block;
        padding: 8px 20px;
        border-radius: 50px;
        background: white;
        border: 1px solid #eee;
        color: #666;
        margin: 5px;
        cursor: pointer;
        transition: 0.3s;
        text-decoration: none;
        font-size: 0.9rem;
    }
    .artist-chip:hover, .artist-chip.active {
        background: var(--primary);
        color: white;
        border-color: var(--primary);
    }

    .restriction-pill {
        font-size: 0.75rem;
        background: #f8f9fa;
        color: #666;
        padding: 4px 12px;
        border-radius: 50px;
        margin-right: 5px;
        margin-bottom: 5px;
        display: inline-block;
    }
    
    .share-btn {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.8rem;
        transition: 0.3s;
        text-decoration: none;
    }
    .share-wa { background: #25d366; color: white; }
    .share-tw { background: #1da1f2; color: white; }
    .share-fb { background: #3b5998; color: white; }
    .share-btn:hover { transform: scale(1.1); color: white; }

    .sold-out-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.6);
        color: white;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        z-index: 5;
        backdrop-filter: blur(2px);
    }
</style>

@if(Auth::check() && Auth::user()->role == 'peserta')
<div id="jadwalGrid" class="container-xxl py-5" style="background-color: #f6f4f9;">
    <div class="container py-5 px-lg-5">
        
        <!-- Search & Filter Wrapper -->
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <form action="/" method="GET" class="search-wrapper">
                    <i class="fa fa-search ms-4 text-muted"></i>
                    <input type="text" name="search" placeholder="Cari artis, lokasi, atau nama konser..." value="{{ request('search') }}">
                    <button type="submit">Cari Jadwal</button>
                </form>
                
                <div class="text-center mb-5">
                    <span class="text-muted small fw-bold text-uppercase d-block mb-2">Filter Artis Populer:</span>
                    <a href="/" class="artist-chip {{ !request('artist') ? 'active' : '' }}">Semua</a>
                    <a href="/?artist=Juicy Luicy" class="artist-chip {{ request('artist') == 'Juicy Luicy' ? 'active' : '' }}">Juicy Luicy</a>
                    <a href="/?artist=Hindia" class="artist-chip {{ request('artist') == 'Hindia' ? 'active' : '' }}">Hindia</a>
                    <a href="/?artist=Tulus" class="artist-chip {{ request('artist') == 'Tulus' ? 'active' : '' }}">Tulus</a>
                    <a href="/?artist=Bernadya" class="artist-chip {{ request('artist') == 'Bernadya' ? 'active' : '' }}">Bernadya</a>
                    <a href="/?artist=Dewa 19" class="artist-chip {{ request('artist') == 'Dewa 19' ? 'active' : '' }}">Dewa 19</a>
                    <a href="/?artist=Slank" class="artist-chip {{ request('artist') == 'Slank' ? 'active' : '' }}">Slank</a>
                </div>
            </div>
        </div>

        <div class="text-center mb-5 mt-3">
            <h2 class="fw-bold mb-3">Jadwal Konser Terpopuler</h2>
            <p class="text-muted mx-auto" style="max-width: 600px;">Temukan pengalaman musik tak terlupakan bersama deretan artis papan atas Indonesia. Amankan tiketmu sekarang!</p>
        </div>

        @if(session('error'))
            <div class="alert alert-danger rounded-pill text-center mb-4">
                {{ session('error') }}
            </div>
        @endif

        <div class="row g-4 justify-content-center">
            @forelse($events as $event)
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="card card-modern h-100 position-relative">
                        
                        @if($event->kuota <= 0)
                            <div class="sold-out-overlay">
                                <i class="fa fa-times-circle fa-3x mb-2"></i>
                                <h4 class="fw-bold">SOLD OUT</h4>
                            </div>
                        @endif

                        {{-- Banner --}}
                        <div class="position-relative">
                            @if($event->banner)
                                <img src="{{ (Str::startsWith($event->banner, ['http://', 'https://'])) ? $event->banner : asset('storage/banners/' . $event->banner) }}"
                                     class="card-img-top" style="height: 220px; object-fit: cover;">
                            @else
                                <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 220px;">
                                    <i class="fa fa-music fa-3x text-muted opacity-50"></i>
                                </div>
                            @endif
                            <div class="position-absolute top-0 end-0 p-2">
                                <span class="badge {{ $event->kuota > 20 ? 'bg-success' : 'bg-danger' }} rounded-pill shadow">
                                    Sisa {{ $event->kuota }} Tiket
                                </span>
                            </div>
                        </div>
                        
                        <div class="card-body p-4 d-flex flex-column">
                            <div class="d-flex align-items-center mb-3">
                                <span class="badge bg-primary px-3 py-2 rounded-pill shadow-sm">
                                    <i class="fa fa-calendar-alt me-1"></i> {{ \Carbon\Carbon::parse($event->tanggal)->format('d M Y') }}
                                </span>
                                <span class="ms-auto text-orange fw-bold">Rp {{ number_format($event->harga, 0, ',', '.') }}</span>
                            </div>
                            <h5 class="fw-bold mb-2">{{ $event->nama_event }}</h5>
                            <p class="text-muted small mb-3">
                                <i class="fa fa-map-marker-alt me-1 text-primary"></i> {{ $event->lokasi }}
                            </p>
                            
                            <!-- Concert Restrictions Mini Info -->
                            <div class="mb-3">
                                <span class="restriction-pill"><i class="fa fa-clock me-1"></i> {{ $event->durasi ?? '2.5 Jam' }}</span>
                                <span class="restriction-pill"><i class="fa fa-users me-1"></i> Kap. {{ $event->kapasitas ?? 'N/A' }}</span>
                                <a href="javascript:void(0)" class="small text-primary text-decoration-none fw-bold" data-bs-toggle="modal" data-bs-target="#modal-{{ $event->id }}">
                                    Detail Aturan <i class="fa fa-chevron-right ms-1"></i>
                                </a>
                            </div>

                            @if($event->kuota > 0)
                                <a href="/tiket/{{ $event->id }}" class="btn btn-primary w-100 rounded-pill py-2 fw-bold mb-3">
                                    Pesan Tiket <i class="fa fa-ticket-alt ms-2"></i>
                                </a>
                            @else
                                <button class="btn btn-secondary w-100 rounded-pill py-2 fw-bold mb-3" disabled>Tiket Habis</button>
                            @endif

                            <div class="mt-auto pt-3 border-top d-flex align-items-center">
                                <span class="text-muted small me-3">Bagikan:</span>
                                <a href="https://wa.me/?text=Ayo nonton {{ $event->nama_event }} di {{ $event->lokasi }}! Pesan tiketnya di Konser Kita." target="_blank" class="share-btn share-wa me-2"><i class="fab fa-whatsapp"></i></a>
                                <a href="https://twitter.com/intent/tweet?text=Cek konser seru {{ $event->nama_event }}!" target="_blank" class="share-btn share-tw me-2"><i class="fab fa-twitter"></i></a>
                                <a href="https://facebook.com/sharer/sharer.php?u={{ url()->current() }}" target="_blank" class="share-btn share-fb"><i class="fab fa-facebook-f"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Detail Pembatasan -->
                <div class="modal fade" id="modal-{{ $event->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content border-0 shadow-lg" style="border-radius: 1.5rem;">
                            <div class="modal-header border-0 pb-0">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body p-4 pt-0">
                                <div class="text-center mb-4">
                                    <div class="bg-light rounded-circle p-3 d-inline-block mb-3">
                                        <i class="fa fa-shield-alt fa-2x text-primary"></i>
                                    </div>
                                    <h4 class="fw-bold">Aturan Pelaksanaan</h4>
                                    <p class="text-muted">{{ $event->nama_event }}</p>
                                </div>
                                
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex align-items-center py-3 border-0 bg-light rounded-4 mb-2">
                                        <i class="fa fa-users text-primary me-3 fa-lg"></i>
                                        <div>
                                            <span class="d-block fw-bold">Kapasitas Penonton</span>
                                            <span class="text-muted small">Dibatasi maksimal {{ $event->kapasitas }} orang (70% Kapasitas Normal)</span>
                                        </div>
                                    </li>
                                    <li class="list-group-item d-flex align-items-center py-3 border-0 bg-light rounded-4 mb-2">
                                        <i class="fa fa-clock text-primary me-3 fa-lg"></i>
                                        <div>
                                            <span class="d-block fw-bold">Waktu & Durasi</span>
                                            <span class="text-muted small">Penyelenggaraan {{ $event->jam_operasional }} (Durasi ~{{ $event->durasi }})</span>
                                        </div>
                                    </li>
                                    <li class="list-group-item d-flex align-items-center py-3 border-0 bg-light rounded-4 mb-2">
                                        <i class="fa fa-file-contract text-primary me-3 fa-lg"></i>
                                        <div>
                                            <span class="d-block fw-bold">Faktor Pembatas</span>
                                            <span class="text-muted small">{{ $event->faktor_pembatas }}</span>
                                        </div>
                                    </li>
                                </ul>
                                
                                <div class="alert alert-warning mt-4 rounded-4 border-0">
                                    <small><i class="fa fa-info-circle me-1"></i> Harap datang 1 jam sebelum acara dimulai untuk proses check-in keamanan.</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <img src="https://cdni.iconscout.com/illustration/premium/thumb/no-search-found-not-found-illustration-download-in-svg-png-gif-formats--document-not-found-result-not-found-empty-states-pack-user-interface-illustrations-5211059.png" style="width: 200px;" class="mb-3 opacity-50">
                    <h5 class="text-muted">Maaf, konser yang Anda cari tidak ditemukan.</h5>
                    <a href="/" class="btn btn-primary rounded-pill px-4 mt-2">Lihat Semua Konser</a>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endif

<div id="about-section" class="container-xxl py-5 bg-light" style="margin-top: 50px; border-top: 1px solid #eee;">
    <div class="container px-lg-5">
        <div class="row g-5 align-items-center">
            <div class="col-lg-12 text-center wow fadeInUp" data-wow-delay="0.1s">
                <div class="section-title justify-content-center mb-4">
                    <span class="bg-primary"></span>
                    <h5 class="fw-bold text-primary px-3 m-0">Tentang Kami</h5>
                    <span class="bg-primary"></span>
                </div>
                
                <h2 class="mb-5 display-6 fw-bold">Pengalaman Konser Terbaik <br> Dalam Genggaman Anda</h2>
                
                <div class="card-modern mx-auto p-5 col-lg-9 shadow-lg border-0" style="background: white; border-radius: 2rem; position: relative; z-index: 1;">
                    <div class="row align-items-center">
                        <div class="col-lg-12">
                            <p class="lead text-muted mb-4" style="line-height: 1.8; font-size: 1.1rem;">
                                <strong class="text-primary">Konser Kita</strong> hadir sebagai jembatan emosional antara Anda dan musisi favorit. Kami bukan sekadar platform tiket; kami adalah bagian dari perjalanan Anda menuju malam-malam penuh kenangan dan harmoni. Berkomitmen menghadirkan akses yang mudah, aman, dan terpercaya bagi setiap pecinta musik di seluruh penjuru Indonesia.
                            </p>
                            
                            <hr class="my-4 opacity-25">
                            
                            <h6 class="text-uppercase small fw-bold text-muted mb-4 tracking-widest">Dikembangkan Dengan Dedikasi Oleh:</h6>
                            <div class="row justify-content-center g-3">
                                <div class="col-md-5">
                                    <div class="p-3 border-0 rounded-pill shadow-sm bg-light d-flex align-items-center justify-content-center">
                                        <div class="bg-primary rounded-circle p-2 me-3" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                            <i class="fa fa-user text-white"></i>
                                        </div>
                                        <span class="fw-bold text-dark">Reyner Cornelius</span>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="p-3 border-0 rounded-pill shadow-sm bg-light d-flex align-items-center justify-content-center">
                                        <div class="bg-primary rounded-circle p-2 me-3" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                            <i class="fa fa-user text-white"></i>
                                        </div>
                                        <span class="fw-bold text-dark">Jonathan Simanulang</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mt-5 pt-2">
                                <p class="mb-0 fw-bold text-muted">
                                    <i class="fa fa-graduation-cap me-2 text-warning"></i> 
                                    Mahasiswa Universitas Kristen Maranatha
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection