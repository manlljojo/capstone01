@extends('layout')
@section('title', 'Edit Konser: ' . $event->nama_event)
@section('content')
<div class="row justify-content-center animate__animated animate__fadeIn">
    <div class="col-lg-8">
        <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="card-header bg-primary py-4 px-5">
                <h3 class="text-white fw-bold m-0"><i class="fa fa-pen-nib me-2"></i> Edit Detail Konser</h3>
            </div>
            <div class="card-body p-5">
                <form action="{{ route('events.update', $event->id_event) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row g-4">
                        <!-- Preview Image Section -->
                        <div class="col-12 mb-2">
                            <label class="form-label fw-bold text-muted small text-uppercase">Poster Konser Saat Ini</label>
                            <div class="position-relative banner-preview-container rounded-4 overflow-hidden shadow-sm" style="height: 250px; background: #f8f9fa;">
                                @if($event->banner)
                                    <img src="{{ (Str::startsWith($event->banner, ['http', 'https'])) ? $event->banner : asset('storage/banners/' . $event->banner) }}" 
                                         class="w-100 h-100" style="object-fit: cover;">
                                @else
                                    <div class="h-100 d-flex flex-column align-items-center justify-content-center text-muted">
                                        <i class="fa fa-image fa-3x mb-2 opacity-25"></i>
                                        <span>Belum ada poster</span>
                                    </div>
                                @endif
                                <div class="position-absolute bottom-0 start-0 w-100 p-3 bg-dark bg-opacity-50 text-white small">
                                    <i class="fa fa-info-circle me-1"></i> Gunakan form di bawah untuk mengganti poster
                                </div>
                            </div>
                        </div>

                        <!-- Nama Event -->
                        <div class="col-md-7">
                            <label class="form-label fw-bold small">NAMA KONSER</label>
                            <input type="text" name="nama_event" class="form-control rounded-pill px-4" value="{{ $event->nama_event }}" placeholder="Contoh: Konser Syahdu Jakarta" required>
                        </div>

                        <!-- Kategori -->
                        <div class="col-md-5">
                            <label class="form-label fw-bold small">KATEGORI</label>
                            <select name="kategori" class="form-select rounded-pill px-4" required>
                                <option value="Konser Musik" {{ $event->kategori == 'Konser Musik' ? 'selected' : '' }}>Konser Musik</option>
                                <option value="Festival" {{ $event->kategori == 'Festival' ? 'selected' : '' }}>Festival</option>
                                <option value="Intimate Session" {{ $event->kategori == 'Intimate Session' ? 'selected' : '' }}>Intimate Session</option>
                            </select>
                        </div>

                        <!-- Deskripsi -->
                        <div class="col-12">
                            <label class="form-label fw-bold small">DESKRIPSI EVENT</label>
                            <textarea name="deskripsi" class="form-control rounded-4 px-4 py-3" rows="4" placeholder="Jelaskan detail konser di sini..." required>{{ $event->deskripsi }}</textarea>
                        </div>

                        <!-- Tanggal & Lokasi -->
                        <div class="col-md-6">
                            <label class="form-label fw-bold small">TANGGAL KONSER</label>
                            <input type="date" name="tanggal_event" class="form-control rounded-pill px-4" value="{{ $event->tanggal_event }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small">LOKASI</label>
                            <input type="text" name="lokasi" class="form-control rounded-pill px-4" value="{{ $event->lokasi }}" placeholder="Nama Gedung / Kota" required>
                        </div>

                        <!-- Harga & Upload Image -->
                        <div class="col-md-6">
                            <label class="form-label fw-bold small">HARGA TIKET (RP)</label>
                            <div class="input-group">
                                <span class="input-group-text rounded-start-pill border-end-0 bg-light px-4">Rp</span>
                                <input type="number" name="harga" class="form-control rounded-end-pill border-start-0" value="{{ $event->harga }}" placeholder="0" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-primary">GANTI POSTER (OPSIONAL)</label>
                            <input type="file" name="banner" class="form-control rounded-pill px-4" accept="image/*">
                            <div class="form-text small">Format: JPG, PNG, JPEG. Maks: 2MB</div>
                        </div>

                        <!-- NEW: ORGANIZER SMART FEATURES -->
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-info"><i class="fa fa-video me-1"></i> PARTNER STREAMING</label>
                            <select name="partner_streaming" class="form-select rounded-pill px-4">
                                <option value="" {{ !$event->partner_streaming ? 'selected' : '' }}>-- Offline Event --</option>
                                <option value="YouTube" {{ $event->partner_streaming == 'YouTube' ? 'selected' : '' }}>YouTube Live</option>
                                <option value="Zoom" {{ $event->partner_streaming == 'Zoom' ? 'selected' : '' }}>Zoom Meeting</option>
                                <option value="Vimeo" {{ $event->partner_streaming == 'Vimeo' ? 'selected' : '' }}>Vimeo</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-info"><i class="fa fa-link me-1"></i> LINK STREAMING / MEETING</label>
                            <input type="text" name="streaming_link" class="form-control rounded-pill px-4" value="{{ $event->streaming_link }}" placeholder="https://youtube.com/live/...">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold small text-info"><i class="fa fa-tasks me-1"></i> RUNDOWN ACARA (PLANNING)</label>
                            <textarea name="rundown" class="form-control rounded-4 px-4 py-3" rows="3" placeholder="Contoh: 19:00 Open Gate, 20:00 Opening Act...">{{ $event->rundown }}</textarea>
                        </div>

                        <!-- Action Buttons -->
                        <div class="col-12 mt-4">
                            <hr class="mb-4">
                            <div class="d-flex gap-3">
                                <a href="/admin" class="btn btn-light rounded-pill px-5 fw-bold">Batal</a>
                                <button type="submit" class="btn btn-warning rounded-pill px-5 fw-bold shadow-sm">
                                    Simpan Perubahan <i class="fa fa-save ms-2"></i>
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