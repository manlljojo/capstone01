@extends('layout')
@section('title','Riwayat Transaksi')
@section('content')
<div class="row justify-content-center mt-4 mb-5">
    <div class="col-lg-11">
        
        @if(session('success'))
            <div class="alert alert-success rounded-pill px-4 shadow-sm mb-4 animate__animated animate__fadeInDown">
                <i class="fa fa-check-circle me-2"></i> {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger rounded-pill px-4 shadow-sm mb-4 animate__animated animate__fadeInDown">
                <i class="fa fa-exclamation-circle me-2"></i> {{ session('error') }}
            </div>
        @endif

        <div class="card border-0 shadow-sm overflow-hidden" style="border-radius: 1.5rem;">
            <div class="card-header bg-white border-0 py-4 text-center pb-2">
                <h3 class="fw-bold m-0"><i class="fa fa-history me-2" style="color: var(--primary);"></i> Riwayat Pembelian Tiket</h3>
                <p class="text-muted small">Kelola pesanan dan cetak tiket elektronik Anda di sini.</p>
            </div>
            <div class="card-body p-0">
                @if($pesertas->isEmpty())
                    <div class="text-center py-5">
                        <img src="https://cdni.iconscout.com/illustration/premium/thumb/empty-cart-illustration-download-in-svg-png-gif-formats--shopping-ecommerce-pack-illustrations-3336581.png" style="width: 250px;" class="mb-4 opacity-50">
                        <h5 class="text-muted">Anda belum memiliki riwayat pembelian tiket.</h5>
                        <p><a href="/#jadwalGrid" class="btn btn-primary fw-bold rounded-pill px-5 py-3 mt-4 shadow-sm">Cari Konser Seru</a></p>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="ps-4 py-3 border-0 text-muted small">ID TIKET</th>
                                    <th class="py-3 border-0 text-muted small">NAMA KONSER</th>
                                    <th class="py-3 border-0 text-muted small text-center">STATUS BAYAR</th>
                                    <th class="py-3 border-0 text-muted small text-center">OPSI / AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pesertas as $trx)
                                <tr class="border-bottom">
                                    <td class="ps-4 py-4">
                                        <div class="d-flex align-items-center">
                                            <div class="bg-light rounded-3 p-3 text-center me-3" style="min-width: 60px;">
                                                <i class="fa fa-ticket-alt text-primary fa-lg"></i>
                                            </div>
                                            <div>
                                                <strong class="text-dark d-block">#{{ $trx->id_pemesanan }}</strong>
                                                <small class="text-muted">{{ $trx->created_at->format('d M Y, H:i') }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @php
                                            $firstEvent = $trx->detailPemesanans->first()->tiket->event ?? null;
                                        @endphp
                                        <span class="fw-bold text-dark d-block text-truncate" style="max-width: 250px;">{{ $firstEvent->nama_event ?? '-' }}</span>
                                        <small class="text-muted"><i class="fa fa-map-marker-alt me-1 text-danger"></i> {{ $firstEvent->lokasi ?? '-' }}</small>
                                    </td>
                                    <td class="text-center">
                                        @if(($trx->pembayaran->status_bayar ?? '') !== 'Lunas')
                                            <span class="badge bg-warning rounded-pill px-3 py-2 text-dark"><i class="fa fa-clock me-1"></i> Menunggu</span>
                                        @else
                                            <span class="badge bg-success rounded-pill px-3 py-2 text-white"><i class="fa fa-check-circle me-1"></i> Lunas</span>
                                        @endif
                                    </td>
                                    <td class="text-center px-4">
                                        @if(($trx->pembayaran->status_bayar ?? '') !== 'Lunas')
                                            <div class="d-flex justify-content-center gap-2">
                                                <a href="/bayar/{{ $trx->id_pemesanan }}" class="btn btn-sm btn-primary rounded-pill px-3">
                                                    Bayar <i class="fa fa-chevron-right ms-1"></i>
                                                </a>
                                                <form action="{{ route('peserta.batal', $trx->id_pemesanan) }}" method="POST" class="m-0 d-inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3" onclick="return confirm('Apakah Anda yakin ingin membatalkan pesanan ini? Pesanan akan dihapus permanen.')">
                                                        <i class="fa fa-trash"></i> Batal
                                                    </button>
                                                </form>
                                            </div>
                                        @else
                                            <div class="d-flex justify-content-center gap-2">
                                                <a href="/cetak-tiket/{{ $trx->id_pemesanan }}" target="_blank" class="btn btn-sm btn-success rounded-pill px-4">
                                                    <i class="fa fa-print me-1"></i> Cetak Tiket
                                                </a>
                                                @php
                                                    $event = $trx->detailPemesanans->first()->tiket->event ?? null;
                                                @endphp
                                                @if($event && $event->streaming_link)
                                                    <a href="{{ $event->streaming_link }}" target="_blank" class="btn btn-sm btn-info text-white rounded-pill px-4">
                                                        <i class="fa fa-video me-1"></i> Tonton Konser
                                                    </a>
                                                @endif
                                                @if($trx->status_pemesanan == 'Check-in')
                                                    <span class="badge bg-primary rounded-pill px-3 py-2"><i class="fa fa-walking me-1"></i> Sudah Masuk</span>
                                                @endif
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
            <div class="card-footer bg-light border-0 py-3 text-center">
                <p class="mb-0 text-muted small">Menemukan Kendala? <a href="#" class="text-primary fw-bold text-decoration-none">Hubungi Support</a></p>
            </div>
        </div>
    </div>
</div>
@endsection
