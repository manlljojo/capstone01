@extends('layout')
@section('title', 'Tambah Konser Baru')
@section('content')
<div class="row justify-content-center animate__animated animate__fadeIn">
    <div class="col-lg-8">
        <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="card-header bg-primary py-4 px-5">
                <h3 class="text-white fw-bold m-0"><i class="fa fa-plus-circle me-2"></i> Rencanakan Konser Baru</h3>
                <p class="text-white mb-0 small opacity-75">Lengkapi detail untuk meluncurkan event baru Anda.</p>
            </div>
            <div class="card-body p-5">
                <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row g-4">
                        <!-- Nama Event -->
                        <div class="col-md-7">
                            <label class="form-label fw-bold small">NAMA KONSER</label>
                            <input type="text" name="nama_event" class="form-control rounded-pill px-4" placeholder="Contoh: Konser Syahdu Jakarta" required>
                        </div>

                        <!-- Kategori -->
                        <div class="col-md-5">
                            <label class="form-label fw-bold small">KATEGORI</label>
                            <select name="kategori" class="form-select rounded-pill px-4" required>
                                <option value="Konser Musik">Konser Musik</option>
                                <option value="Festival">Festival</option>
                                <option value="Intimate Session">Intimate Session</option>
                            </select>
                        </div>

                        <!-- Deskripsi -->
                        <div class="col-12">
                            <label class="form-label fw-bold small">DESKRIPSI EVENT</label>
                            <textarea name="deskripsi" class="form-control rounded-4 px-4 py-3" rows="4" placeholder="Jelaskan detail konser di sini..." required></textarea>
                        </div>

                        <!-- Tanggal & Lokasi -->
                        <div class="col-md-6">
                            <label class="form-label fw-bold small">TANGGAL KONSER</label>
                            <input type="date" name="tanggal_event" class="form-control rounded-pill px-4" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small">LOKASI</label>
                            <input type="text" name="lokasi" class="form-control rounded-pill px-4" placeholder="Nama Gedung / Kota" required>
                        </div>

                        <!-- Harga & Upload Image -->
                        <div class="col-md-6">
                            <label class="form-label fw-bold small">HARGA TIKET (RP)</label>
                            <div class="input-group">
                                <span class="input-group-text rounded-start-pill border-end-0 bg-light px-4">Rp</span>
                                <input type="number" name="harga" class="form-control rounded-end-pill border-start-0" placeholder="0" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-primary">POSTER KONSER</label>
                            <input type="file" name="banner" class="form-control rounded-pill px-4" accept="image/*">
                        </div>

                        <!-- NEW: ORGANIZER SMART FEATURES -->
                        <div class="col-md-6 border-top pt-4">
                            <label class="form-label fw-bold small text-info"><i class="fa fa-video me-1"></i> PARTNER STREAMING</label>
                            <select name="partner_streaming" class="form-select rounded-pill px-4">
                                <option value="" selected>-- Offline Event --</option>
                                <option value="YouTube">YouTube Live</option>
                                <option value="Zoom">Zoom Meeting</option>
                                <option value="Vimeo">Vimeo</option>
                            </select>
                        </div>
                        <div class="col-md-6 border-top pt-4">
                            <label class="form-label fw-bold small text-info"><i class="fa fa-link me-1"></i> LINK STREAMING / MEETING</label>
                            <input type="text" name="streaming_link" class="form-control rounded-pill px-4" placeholder="https://youtube.com/live/...">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold small text-info"><i class="fa fa-tasks me-1"></i> RUNDOWN ACARA (PLANNING)</label>
                            <textarea name="rundown" class="form-control rounded-4 px-4 py-3" rows="3" placeholder="Contoh: 19:00 Open Gate, 20:00 Opening Act..."></textarea>
                        </div>

                        <!-- Action Buttons -->
                        <div class="col-12 mt-4">
                            <hr class="mb-4">
                            <div class="d-flex gap-3">
                                <a href="/admin" class="btn btn-light rounded-pill px-5 fw-bold">Batal</a>
                                <button type="submit" class="btn btn-primary rounded-pill px-5 fw-bold shadow-sm">
                                    Publikasikan Konser <i class="fa fa-paper-plane ms-2"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection