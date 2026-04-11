@extends('layout')
@section('title','Riwayat Transaksi')
@section('content')
<div class="row justify-content-center mt-4">
    <div class="col-lg-10">
        <div class="card border-0 shadow-sm overflow-hidden" style="border-radius: 1.2rem;">
            <div class="card-header bg-white border-0 py-4 text-center pb-2">
                <h3 class="fw-bold m-0"><i class="fa fa-history me-2" style="color: #ff9800;"></i> Riwayat Pembelian Tiket</h3>
            </div>
            <div class="card-body p-0">
                @if($pesertas->isEmpty())
                    <div class="text-center py-5">
                        <i class="fa fa-box-open fa-3x text-muted mb-3 opacity-50"></i>
                        <h5 class="text-muted">Anda belum memiliki riwayat pembelian tiket.</h5>
                        <p><a href="/" class="btn text-dark fw-bold rounded-pill px-5 py-3 mt-4 shadow-sm" style="background-color: #ff9800;">Cari Tiket Sekarang</a></p>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="ps-4 py-3 border-0 text-muted small">INFO TIKET</th>
                                    <th class="py-3 border-0 text-muted small">DETAIL KONSER</th>
                                    <th class="py-3 border-0 text-muted small">TOTAL / METODE</th>
                                    <th class="py-3 border-0 text-muted small text-center">PEMBAYARAN</th>
                                    <th class="py-3 border-0 text-muted small text-center">CHECK-IN</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pesertas as $trx)
                                <tr>
                                    <td class="ps-4 border-bottom-0 py-3">
                                        <strong class="text-primary" style="font-size:1.1rem;">#{{ $trx->tiket_id }}</strong><br>
                                        <small class="text-muted"><i class="fa fa-user me-1"></i> {{ $trx->nama }}</small>
                                    </td>
                                    <td class="border-bottom-0 fw-bold">
                                        {{ $trx->event->nama_event ?? '-' }} <br>
                                        <small class="text-muted fw-normal"><i class="fa fa-map-marker-alt me-1 text-warning"></i> {{ $trx->event->lokasi ?? '-' }}</small>
                                    </td>
                                    <td class="border-bottom-0">
                                        <span class="fw-bold text-dark">Rp {{ number_format($trx->total_bayar, 0, ',', '.') }}</span> <br>
                                        <small class="badge bg-light text-muted border">{{ $trx->metode_pembayaran ?? '-' }}</small>
                                    </td>
                                    <td class="border-bottom-0 text-center">
                                        @if($trx->status_pembayaran == 'Pending')
                                            <span class="badge bg-danger rounded-pill px-3 py-2 mb-1">Menunggu</span> <br>
                                            <a href="/bayar/{{ $trx->id }}" class="small text-primary fw-bold text-decoration-none"><i class="fa fa-info-circle me-1"></i> Cara Bayar</a>
                                        @else
                                            <span class="badge bg-success rounded-pill px-3 py-2"><i class="fa fa-check-circle me-1"></i> Lunas</span>
                                        @endif
                                    </td>
                                    <td class="border-bottom-0 text-center">
                                        @if($trx->check_in == 'Belum')
                                            <span class="badge bg-light text-muted border rounded-pill px-3 py-2">Belum</span>
                                        @else
                                            <span class="badge bg-primary rounded-pill px-3 py-2 text-white"><i class="fa fa-walking me-1"></i> Masuk</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
