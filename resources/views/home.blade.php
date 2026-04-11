@extends('layout')
@section('title','Home')
@section('content')
<style>
    .card-modern {
        border: none;
        border-radius: 1rem;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        overflow: hidden;
    }
    .card-modern:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 40px rgba(255, 152, 0, 0.2);
    }
    .text-orange { color: #ff9800 !important; }
</style>



@if(Auth::check() && Auth::user()->role == 'peserta')
<div id="jadwalGrid" class="container-xxl py-5" style="background-color: #f6f4f9;">
    <div class="container py-5 px-lg-5">
        <div class="text-center mb-5 mt-3">
            <h2 class="fw-bold mb-3">Jadwal Konser Terdekat</h2>
            <p class="text-muted mx-auto" style="max-width: 600px;">Berikut adalah jadwal tur resmi Payung Teduh. Pastikan Anda memesan tiket sebelum kehabisan!</p>
        </div>
        <div class="row g-4 justify-content-center">
            @foreach($events as $event)
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="card card-modern h-100">
                        {{-- Banner --}}
                        @if($event->banner)
                            <img src="{{ (Str::startsWith($event->banner, ['http://', 'https://'])) ? $event->banner : asset('storage/banners/' . $event->banner) }}"
                                 class="card-img-top" style="height: 220px; object-fit: cover;">
                        @else
                            <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 220px;">
                                <i class="fa fa-music fa-3x text-muted opacity-50"></i>
                            </div>
                        @endif
                        
                        <div class="card-body p-4">
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
                            <p class="card-text text-muted mb-4" style="font-size: 0.9rem;">
                                {{ Str::limit($event->deskripsi, 80) }}
                            </p>
                            <a href="/tiket/{{ $event->id }}" class="btn btn-outline-primary w-100 rounded-pill py-2 fw-bold">
                                Pesan Tiket <i class="fa fa-ticket-alt ms-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
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
                    <h5 class="fw-bold text-primary px-3">Tentang Aplikasi</h5>
                    <span class="bg-primary"></span>
                </div>
                <h2 class="mb-4">E-Ticketing Portal: Konser Payung Teduh</h2>
                <div class="card-modern mx-auto p-5 col-lg-8" style="background: white; border-bottom: 5px solid #ff9800;">
                    <p class="mb-4 text-muted" style="line-height: 1.8;">
                        Aplikasi sistem pemesanan tiket online ini dikembangkan sebagai bentuk inovasi digital untuk memudahkan penggemar musik dalam mengakses tiket konser secara cepat dan aman. Proyek ini dibangun dengan dedikasi penuh oleh:
                    </p>
                    <div class="row justify-content-center">
                        <div class="col-md-5 mb-3">
                            <div class="p-3 border rounded-pill shadow-sm bg-white">
                                <i class="fa fa-user-graduate text-primary me-2"></i>
                                <span class="fw-bold">Reyner Cornelius</span>
                            </div>
                        </div>
                        <div class="col-md-5 mb-3">
                            <div class="p-3 border rounded-pill shadow-sm bg-white">
                                <i class="fa fa-user-graduate text-primary me-2"></i>
                                <span class="fw-bold">Jonathan Simanulang</span>
                            </div>
                        </div>
                    </div>
                    <p class="mt-4 fw-bold text-dark">
                        <i class="fa fa-university me-2 text-warning"></i> Mahasiswa Universitas Kristen Maranatha
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection