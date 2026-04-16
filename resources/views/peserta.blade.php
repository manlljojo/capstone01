@extends('layout')
@section('title','Pesan Tiket')
@section('content')
<div class="row justify-content-center mt-4">
    <div class="col-lg-10">
        <div class="card bg-white shadow border-0 overflow-hidden" style="border-radius: 1.5rem;">
            @if($event->banner)
            <div style="width: 100%; height: 300px; overflow: hidden; position: relative;">
                <img src="{{ (Str::startsWith($event->banner, ['http://', 'https://'])) ? $event->banner : asset('storage/banners/' . $event->banner) }}" 
                     style="width: 100%; height: 100%; object-fit: cover; filter: brightness(0.7);">
                <div style="position: absolute; bottom: 30px; left: 30px;">
                    <h2 class="text-white fw-bold mb-1">{{ $event->nama_event }}</h2>
                    <p class="text-white-50 mb-0">
                        <i class="fa fa-map-marker-alt me-2 text-rose"></i>{{ $event->lokasi }} 
                        <span class="mx-2">|</span>
                        <i class="fa fa-calendar-alt me-2 text-rose"></i>{{ \Carbon\Carbon::parse($event->tanggal_event)->format('d F Y') }}
                    </p>
                </div>
            </div>
            @endif

            <div class="card-body p-5">
                <div class="row">
                    <div class="col-lg-7 border-end pe-lg-5">
                        <h4 class="fw-bold mb-4">Informasi Registrasi</h4>
                        <form action="/tiket/{{ $event->id_event }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label text-muted fw-bold small">NAMA LENGKAP</label>
                                <input class="form-control rounded-pill px-4" style="border: 2px solid #eee; height: 50px;" type="text" placeholder="Sesuai KTP..." name="nama" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-muted fw-bold small">ALAMAT DOMISILI</label>
                                <input class="form-control rounded-pill px-4" style="border: 2px solid #eee; height: 50px;" type="text" placeholder="Kota tempat tinggal..." name="alamat" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label text-muted fw-bold small">NOMOR HP (WHATSAPP)</label>
                                <input class="form-control rounded-pill px-4" style="border: 2px solid #eee; height: 50px;" type="text" placeholder="08xxxxxxx" name="nomor_hp" required>
                            </div>

                            <div class="mb-4">
                                <label class="form-label text-muted fw-bold small">PILIH METODE PEMBAYARAN</label>
                                <div class="row g-2">
                                     <div class="col-6">
                                         <input type="radio" class="btn-check" name="metode_pembayaran" id="p_bca" value="BCA" checked autocomplete="off">
                                         <label class="btn btn-outline-primary w-100 rounded-4 py-3 border-2" for="p_bca">
                                             <i class="fa fa-university d-block mb-1"></i> BCA
                                         </label>
                                     </div>
                                     <div class="col-6">
                                         <input type="radio" class="btn-check" name="metode_pembayaran" id="p_qris" value="QRIS" autocomplete="off">
                                         <label class="btn btn-outline-primary w-100 rounded-4 py-3 border-2" for="p_qris">
                                             <i class="fa fa-qrcode d-block mb-1"></i> QRIS
                                         </label>
                                     </div>
                                </div>
                            </div>
                            
                            <input type="hidden" name="total_bayar" value="{{ $event->harga }}">
                             <button type="submit" class="btn w-100 rounded-pill py-3 fw-bold text-dark border-0 shadow" style="background-color: var(--accent); font-size: 1.1rem;">
                                 Proses ke Pembayaran <i class="fa fa-arrow-right ms-2"></i>
                             </button>
                        </form>
                    </div>

                    <div class="col-lg-5 ps-lg-5 mt-5 mt-lg-0">
                        <h4 class="fw-bold mb-4">Ringkasan Tiket</h4>
                        <div class="bg-light p-4 rounded-4 position-relative">
                            <div class="mb-3 border-bottom pb-3">
                                <p class="text-muted small mb-1">JENIS TIKET</p>
                                <h6 class="fw-bold mb-0">Tiket Reguler - {{ $event->lokasi }}</h6>
                            </div>
                            <div class="mb-4">
                                <p class="text-muted small mb-1">HARGA SATUAN</p>
                                <h3 class="fw-bold text-primary mb-0">Rp {{ number_format($event->harga, 0, ',', '.') }}</h3>
                                <p class="text-muted small mb-0 mt-1">*Sudah termasuk pajak & biaya layanan</p>
                            </div>
                            
                            <div class="alert alert-warning border-0 small mb-0 rounded-3">
                                <i class="fa fa-info-circle me-1"></i> Tiket akan dikirimkan ke nomor WhatsApp setelah pembayaran dikonfirmasi Admin.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection