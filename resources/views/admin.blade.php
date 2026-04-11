@extends('layout')
@section('title','Admin Dashboard')
@section('content')
<div class="row animate__animated animate__fadeIn">
    <!-- Stat Item -->
    <div class="col-md-4 mb-4">
        <div class="card border-0 shadow-sm rounded-4 text-white p-4" style="background-color: #ff9800;">
            <h5 class="text-white mb-2"><i class="fa fa-calendar-check me-2"></i>Total Event Aktif</h5>
            <h2 class="fw-bold mb-0 text-white">{{ count($events) }} <span class="fs-6 fw-normal">Konser</span></h2>
        </div>
    </div>
    
    <!-- Table Item -->
    <div class="col-md-12">
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="card-header bg-white border-bottom-0 d-flex justify-content-between align-items-center py-4 px-4">
                <h4 class="fw-bold m-0 text-dark"><i class="fa fa-list me-2" style="color:#ff9800;"></i> Manajemen Konser</h4>
                <a href="{{ route('events.create') }}" class="btn text-dark fw-bold rounded-pill px-4 shadow-sm" style="background-color: #ff9800;">+ Tambah Event</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0 text-center">
                        <thead class="table-light text-muted">
                            <tr>
                                <th class="py-3 border-0">ID</th>
                                <th class="py-3 border-0">Banner</th>
                                <th class="py-3 border-0">Nama Konser</th>
                                <th class="py-3 border-0">Jadwal & Lokasi</th>
                                <th class="py-3 border-0 text-center">Aksi Pengelolaan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($events as $event)
                            <tr class="border-bottom">
                                <td class="fw-bold text-muted">#{{ $event->id }}</td>
                                <td>
                                    @if($event->banner)
                                        <img src="{{ (Str::startsWith($event->banner, ['http', 'https'])) ? $event->banner : asset('storage/banners/' . $event->banner) }}" 
                                             class="rounded shadow-sm" style="width: 80px; height: 50px; object-fit: cover;">
                                    @else
                                        <div class="bg-light rounded mx-auto d-flex align-items-center justify-content-center" style="width: 80px; height: 50px;"><i class="fa fa-image text-muted"></i></div>
                                    @endif
                                </td>
                                <td class="fw-bold text-start ps-4">{{ $event->nama_event }} <br> <span class="badge bg-secondary rounded-pill py-1 fw-normal">{{ $event->kategori }}</span></td>
                                <td class="text-muted small"><i class="fa fa-calendar-alt text-warning me-1"></i> {{ \Carbon\Carbon::parse($event->tanggal)->format('d M Y') }} <br> <i class="fa fa-map-marker-alt text-warning me-1"></i> {{ $event->lokasi }}</td>
                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('events.edit', $event->id) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3"><i class="fa fa-pen"></i> Edit</a>
                                        <form action="{{ route('events.destroy', $event->id) }}" method="POST" class="m-0">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3" onclick="return confirm('Yakin hapus konser ini?')"><i class="fa fa-trash"></i> Hapus</button>
                                        </form>
                                    </div>
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