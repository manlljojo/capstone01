@extends('layout')
@section('title','Instruksi Pembayaran')
@section('content')
<div class="row justify-content-center mt-5 animate__animated animate__fadeIn">
    <div class="col-lg-6 col-md-8">
        <div class="card p-5 shadow border-0 text-center" style="border-radius: 1.5rem; background: rgba(255,255,255,0.95);">
            <div class="mb-4">
                <i class="fa fa-money-check-alt fa-3x mb-3" style="color: #ff9800;"></i>
                <h3 class="fw-bold">Instruksi Pembayaran</h3>
                <p class="text-muted">Selesaikan pembayaran Anda untuk memverifikasi tiket.</p>
            </div>

            <div class="alert alert-warning rounded-4 border-0 mb-4 p-4">
                <h6 class="fw-bold mb-1">TOTAL YANG HARUS DIBAYAR:</h6>
                <h2 class="fw-bold text-dark m-0">Rp {{ number_format($peserta->total_harga, 0, ',', '.') }}</h2>
            </div>

            <div class="card border-2 rounded-4 p-4 mb-4" style="border-style: dashed !important; border-color: #ff9800 !important; background-color: #fff9f0;">
                @if($peserta->pembayaran->metode_pembayaran == 'BCA')
                    <h5 class="fw-bold mb-3"><i class="fa fa-university me-2"></i> Transfer Bank BCA</h5>
                    <p class="text-muted mb-1">Nomor Rekening Tujuan:</p>
                    <h3 class="fw-bold text-primary">123-456-7890</h3>
                    <p class="small text-muted mb-0">Atas Nama: <strong>PT. KONSER PAYUNG TEDUH</strong></p>
                @else
                    <h5 class="fw-bold mb-3"><i class="fa fa-qrcode me-2"></i> Scan QRIS</h5>
                    <div class="mb-3">
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=Payment-For-Ticket-{{ $peserta->id_pemesanan }}" alt="QRIS Dummy" class="img-fluid rounded shadow-sm border p-2 bg-white">
                    </div>
                    <p class="small text-muted mb-0">Scan QR di atas menggunakan aplikasi mobile banking atau e-wallet Anda.</p>
                @endif
            </div>

            <div class="bg-light p-3 rounded-4 text-start mb-4">
                <p class="small mb-1 text-muted"><strong>CATATAN:</strong></p>
                <ol class="small text-muted mb-0 ps-3">
                    <li>Gunakan nominal yang sesuai sampai digit terakhir.</li>
                    <li>Setelah transfer, status Anda akan diverifikasi oleh Admin dalam 1x24 jam.</li>
                    <li>Pemesanan ID Anda: <strong>#{{ $peserta->id_pemesanan }}</strong> (Tunjukkan saat konfirmasi).</li>
                </ol>
            </div>

            <a href="/riwayat" class="btn w-100 rounded-pill py-3 fw-bold text-dark border-0 shadow" style="background-color: #ff9800;">
                Lihat Status Riwayat Pesanan <i class="fa fa-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</div>
@endsection
