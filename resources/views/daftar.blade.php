@extends('layout')
@section('title','Laporan Peserta')
@section('content')
<div class="row animate__animated animate__fadeInUp">
    <div class="col-md-12">
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="card-header bg-white border-bottom-0 py-4 px-4 d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="fw-bold m-0 text-dark"><i class="fa fa-users me-2" style="color:var(--primary);"></i> Laporan Peserta</h4>
                    <p class="text-muted small m-0 mt-1">Gunakan tombol verifikasi untuk check-in peserta secara real-time.</p>
                </div>
                <!-- Search Form -->
                <form action="/daftar" method="GET" class="d-flex gap-2">
                    <input type="text" name="search" class="form-control form-control-sm rounded-pill px-3" placeholder="Nama atau ID Tiket..." value="{{ request('search') }}" style="width: 250px;">
                    <button type="submit" class="btn btn-sm btn-primary rounded-pill px-3">Cari</button>
                    @if(request('search'))
                        <a href="/daftar" class="btn btn-sm btn-outline-secondary rounded-pill px-3">Reset</a>
                    @endif
                </form>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0 text-center">
                        <thead class="table-light text-muted">
                            <tr>
                                <th class="py-3 border-0 text-start ps-4">Informasi Penonton</th>
                                <th class="py-3 border-0">Total / Metode</th>
                                <th class="py-3 border-0">Status Pembayaran</th>
                                <th class="py-3 border-0">Aksi Gerbang</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($peserta as $data)
                            <tr class="border-bottom {{ $data->check_in === 'Sudah' ? 'bg-light' : '' }}">
                                <td class="text-start ps-4">
                                    <span class="fw-bold d-block">{{ $data->nama }}</span>
                                    <small class="text-muted"><i class="fa fa-ticket-alt text-warning me-1"></i>{{ $data->event->nama_event ?? '-' }} (#{{ $data->tiket_id }})</small>
                                </td>
                                <td>
                                    <span class="fw-bold">Rp {{ number_format($data->total_bayar, 0, ',', '.') }}</span> <br>
                                    <span class="badge bg-light text-muted border small">{{ $data->metode_pembayaran }}</span>
                                </td>
                                <td>
                                    @if($data->status_pembayaran == 'Pending')
                                        <form action="/admin/confirm-payment/{{ $data->id }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3 shadow-sm fw-bold">Konfirmasi Lunas</button>
                                        </form>
                                    @else
                                        <span class="badge bg-success rounded-pill px-3 py-2"><i class="fa fa-check-circle me-1"></i> LUNAS</span>
                                    @endif
                                </td>
                                <td>
                                    <form action="/admin/checkin/{{ $data->id }}" method="POST" class="m-0">
                                        @csrf
                                        @if($data->status_pembayaran == 'Lunas')
                                            @if($data->check_in == 'Belum')
                                                <button type="submit" class="btn btn-sm btn-success rounded-pill px-3 shadow-sm fw-bold"><i class="fa fa-sign-in-alt me-1"></i> Verifikasi Masuk</button>
                                            @else
                                                <button type="submit" class="btn btn-sm btn-secondary rounded-pill px-3 fw-bold"><i class="fa fa-undo me-1"></i> Batalkan</button>
                                            @endif
                                        @else
                                            <button type="button" class="btn btn-sm btn-light rounded-pill px-3 text-muted border" disabled title="Harus Lunas Dulu">
                                                <i class="fa fa-lock me-1"></i> Locked
                                            </button>
                                        @endif
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
@endsection