@extends('layout')
@section('title','Admin')
@section('content')
<div class="row justify-content-center mt-5 mb-5 animate__animated animate__fadeIn">
    <div class="col-lg-6">
        <div class="card p-5 shadow border-0" style="border-radius: 1.5rem; background: rgba(255,255,255,0.95);">
            <div class="text-center mb-4">
                <i class="fa fa-user-edit fa-3x mb-3 text-primary"></i>
                <h3 class="fw-bold">Edit Penonton</h3>
                <p class="text-muted small">Update data registrasi tiket #{{$peserta->tiket_id}}</p>
            </div>

            <form action="/edit/{{$peserta->id}}" method="post">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label text-muted fw-bold small">NAMA BARU</label>
                    <input class="form-control rounded-pill px-4" style="border: 2px solid #eee; height: 45px;" type="text" name="nama" value="{{$peserta->nama}}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label text-muted fw-bold small">ALAMAT BARU</label>
                    <input class="form-control rounded-pill px-4" style="border: 2px solid #eee; height: 45px;" type="text" name="alamat" value="{{$peserta->alamat}}" required>
                </div>
                <div class="mb-4">
                    <label class="form-label text-muted fw-bold small">KONTAK (HP)</label>
                    <input class="form-control rounded-pill px-4" style="border: 2px solid #eee; height: 45px;" type="text" name="nomor_hp" value="{{$peserta->nomor_hp}}" required>
                </div>
                <button type="submit" class="btn w-100 rounded-pill py-3 fw-bold text-dark border-0 shadow-sm" style="background-color: #ff9800;">
                    Simpan Perubahan <i class="fa fa-save ms-2"></i>
                </button>
            </form>
        </div>
    </div>
</div>
@endsection