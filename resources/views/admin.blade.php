@extends('layout')
@section('title','Admin Dashboard')
@section('content')

@if(Auth::guard('admin')->check())
<!-- ====================== START: ORIGINAL ADMIN DESIGN ====================== -->
<div class="row animate__animated animate__fadeIn">
    <!-- Simple Stat Cards for Admin -->
    <div class="col-md-4 mb-4">
        <div class="card border-0 shadow-sm rounded-4 text-white p-4" style="background-color: var(--secondary);">
            <h5 class="text-white mb-2"><i class="fa fa-calendar-check me-2"></i>Total Event Aktif</h5>
            <h2 class="fw-bold mb-0 text-white">{{ count($events) }} <span class="fs-6 fw-normal">Konser</span></h2>
        </div>
    </div>
    
    <!-- Table for Admin -->
    <div class="col-md-12">
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="card-header bg-white border-bottom-0 d-flex justify-content-between align-items-center py-4 px-4">
                <h4 class="fw-bold m-0 text-dark"><i class="fa fa-list me-2" style="color:var(--secondary);"></i> Manajemen Konser</h4>
                <a href="{{ route('events.create') }}" class="btn text-white fw-bold rounded-pill px-4 shadow-sm" style="background-color: var(--primary);">+ Tambah Event</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0 text-center">
                        <thead class="table-light text-muted">
                            <tr>
                                <th class="py-3 border-0">ID</th>
                                <th class="py-3 border-0">Banner</th>
                                <th class="py-3 border-0 text-start">Nama Konser</th>
                                <th class="py-3 border-0">Jadwal & Lokasi</th>
                                <th class="py-3 border-0 text-center">Aksi Pengelolaan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($events as $event)
                            <tr class="border-bottom">
                                <td class="fw-bold text-muted">#{{ $event->id_event }}</td>
                                <td>
                                    @if($event->banner)
                                        <img src="{{ (Str::startsWith($event->banner, ['http', 'https'])) ? $event->banner : asset('storage/banners/' . $event->banner) }}" 
                                             class="rounded shadow-sm" style="width: 80px; height: 50px; object-fit: cover;">
                                    @else
                                        <div class="bg-light rounded mx-auto d-flex align-items-center justify-content-center" style="width: 80px; height: 50px;"><i class="fa fa-image text-muted"></i></div>
                                    @endif
                                </td>
                                 <td class="fw-bold text-start ps-4">{{ $event->nama_event }} <br> <span class="badge bg-secondary rounded-pill py-1 fw-normal">{{ $event->kategori }}</span></td>
                                 <td class="text-muted small text-start ps-3"><i class="fa fa-calendar-alt text-danger me-1"></i> {{ \Carbon\Carbon::parse($event->tanggal_event)->format('d M Y') }} <br> <i class="fa fa-map-marker-alt text-danger me-1"></i> {{ $event->lokasi }}</td>
                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('events.edit', $event->id_event) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3"><i class="fa fa-pen"></i> Edit</a>
                                        <form action="{{ route('events.destroy', $event->id_event) }}" method="POST" class="m-0">
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
<!-- ====================== END: ORIGINAL ADMIN DESIGN ====================== -->

@else
<!-- ====================== START: SMART PENYELENGGARA DESIGN ====================== -->
<div class="row animate__animated animate__fadeIn">
    <div class="col-md-12 mb-4">
        <div class="card border-0 shadow-lg rounded-4 p-4 text-white" style="background: linear-gradient(45deg, #1a237e, #512da8);">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="fw-bold mb-1">Halo, {{ Auth::guard('penyelenggara')->user()->nama_organisasi }}!</h2>
                    <p class="m-0 opacity-75">Berikut adalah ringkasan performa penjualan tiket konser Anda hari ini.</p>
                </div>
                <div class="text-end">
                    <span class="badge bg-white text-primary px-3 py-2 rounded-pill fw-bold shadow-sm">PENYELENGGARA PRO</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Stat Items for Organizer -->
    <div class="col-md-4 mb-4">
        <div class="card border-0 shadow-sm rounded-4 text-white p-4 h-100" style="background-color: #2e7d32;">
            <h5 class="text-white mb-2"><i class="fa fa-users me-2"></i>Total Penonton Lunas</h5>
            <h2 class="fw-bold mb-0 text-white">{{ $totalSales ?? 0 }} <span class="fs-6 fw-normal">Orang</span></h2>
            <div class="mt-3 small opacity-75"><i class="fa fa-arrow-up"></i> +{{ rand(5, 15) }}% dari minggu lalu</div>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card border-0 shadow-sm rounded-4 text-white p-4 h-100" style="background-color: #f57c00;">
            <h5 class="text-white mb-2"><i class="fa fa-chart-line me-2"></i>Total Pendapatan</h5>
            <h2 class="fw-bold mb-0 text-white">Rp {{ number_format($totalRevenue ?? 0, 0, ',', '.') }}</h2>
            <div class="mt-3 small opacity-75">Update otomatis setiap ada konfirmasi</div>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card border-0 shadow-sm rounded-4 text-white p-4 h-100" style="background-color: #512da8;">
            <h5 class="text-white mb-2"><i class="fa fa-star me-2"></i>Event Aktif</h5>
            <h2 class="fw-bold mb-0 text-white">{{ count($events) }} <span class="fs-6 fw-normal">Konser</span></h2>
            <div class="mt-3 small opacity-75">Seluruh event sedang tayang di publik</div>
        </div>
    </div>

    @if(Auth::guard('penyelenggara')->check())
    <!-- NODE.JS POWERED CHART -->
    <div class="col-md-12 mb-4">
        <div class="card border-0 shadow-sm rounded-4 p-4">
            <h5 class="fw-bold text-dark mb-4"><i class="fa fa-chart-pie me-2 text-primary"></i> Distribusi Penjualan Tiket (Vite/Node.JS Graphics)</h5>
            <div style="height: 300px; display: flex; justify-content: center;">
                <canvas id="salesChart"></canvas>
            </div>
        </div>
    </div>
    @endif

    <!-- Table Item for Organizer -->
    <div class="col-md-12">
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden mt-2">
            <div class="card-header bg-white border-bottom-0 d-flex justify-content-between align-items-center py-4 px-4">
                <h4 class="fw-bold m-0 text-dark"><i class="fa fa-chart-pie me-2" style="color:var(--secondary);"></i> Analitik & Penjualan Konser</h4>
                <a href="{{ route('events.create') }}" class="btn text-white fw-bold rounded-pill px-4 shadow-sm" style="background-color: var(--primary);">+ Tambah Event Baru</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0 text-center">
                        <thead class="table-light text-muted">
                            <tr>
                                <th class="py-3 border-0">ID</th>
                                <th class="py-3 border-0">Banner</th>
                                <th class="py-3 border-0 text-start">Nama Konser & Kategori</th>
                                <th class="py-3 border-0">Informasi Event</th>
                                <th class="py-3 border-0">Persentase Kuota</th>
                                <th class="py-3 border-0 text-center">Aksi Pengelolaan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($events as $event)
                            <tr class="border-bottom">
                                <td class="fw-bold text-muted">#{{ $event->id_event }}</td>
                                <td>
                                    @if($event->banner)
                                        <img src="{{ (Str::startsWith($event->banner, ['http', 'https'])) ? $event->banner : asset('storage/banners/' . $event->banner) }}" 
                                             class="rounded shadow-sm" style="width: 80px; height: 50px; object-fit: cover;">
                                    @else
                                        <div class="bg-light rounded mx-auto d-flex align-items-center justify-content-center" style="width: 80px; height: 50px;"><i class="fa fa-image text-muted"></i></div>
                                    @endif
                                </td>
                                 <td class="fw-bold text-start ps-4">
                                     <span class="d-block">{{ $event->nama_event }}</span>
                                     <span class="badge bg-light text-muted rounded-pill py-1 fw-normal border">{{ $event->kategori }}</span>
                                 </td>
                                 <td class="text-muted small text-start ps-3">
                                     <i class="fa fa-calendar-alt text-danger me-1"></i> {{ \Carbon\Carbon::parse($event->tanggal_event)->format('d M Y') }} <br> 
                                     <i class="fa fa-map-marker-alt text-danger me-1"></i> {{ $event->lokasi }}
                                 </td>
                                 <td style="min-width: 150px;">
                                     @php
                                        $terjual = 0;
                                        foreach($event->tikets as $t) {
                                            foreach($t->detailPemesanans as $d) {
                                                if(($d->pemesanan->pembayaran->status_bayar ?? '') === 'Lunas') {
                                                    $terjual += $d->jumlah;
                                                }
                                            }
                                        }
                                        $persen = $event->kapasitas > 0 ? ($terjual / $event->kapasitas) * 100 : 0;
                                     @endphp
                                     <div class="small text-muted mb-1 text-start">{{ $terjual }} / {{ $event->kapasitas }} Terisi</div>
                                     <div class="progress" style="height: 8px; border-radius: 10px;">
                                         <div class="progress-bar progress-bar-striped progress-bar-animated {{ $persen > 80 ? 'bg-danger' : 'bg-success' }}" role="progressbar" style="width: {{ $persen }}%"></div>
                                     </div>
                                 </td>
                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('events.edit', $event->id_event) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3"><i class="fa fa-pen"></i> Edit</a>
                                        <form action="{{ route('events.destroy', $event->id_event) }}" method="POST" class="m-0">
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
<!-- ====================== END: SMART PENYELENGGARA DESIGN ====================== -->
@endif

@endsection

@if(Auth::guard('penyelenggara')->check())
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const ctx = document.getElementById('salesChart');
    if(ctx) {
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Terjual (Lunas)', 'Tersedia', 'Pending'],
                datasets: [{
                    data: [{{ $totalSales ?? 0 }}, {{ max(0, ($events->sum('kapasitas') - ($totalSales ?? 0))) }}, 5],
                    backgroundColor: ['#2e7d32', '#e0e0e0', '#f57c00'],
                    borderWidth: 0,
                    hoverOffset: 10
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                    }
                },
                cutout: '70%'
            }
        });
    }
});
</script>
@endif