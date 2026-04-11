@extends('layout')
@section('title', request('intent') == 'order' ? 'Lanjutkan Pemesanan' : 'Login Admin')
@section('content')
<div class="row justify-content-center mt-5 mb-5 animate__animated animate__fadeIn">
    <div class="col-lg-5">
        <div class="card p-5 shadow border-0" style="border-radius: 1.5rem; background: rgba(255,255,255,0.95); backdrop-filter: blur(10px);">
            <div class="text-center mb-4">
                @if(request('intent') == 'order')
                    <i class="fa fa-ticket-alt fa-3x mb-3 text-primary animate__animated animate__pulse animate__infinite"></i>
                    <h3 class="fw-bold">Login Sebagai?</h3>
                    <p class="text-muted text-uppercase small fw-bold">Masuk Akun Reservasi Tiket</p>
                    
                    <div class="alert alert-warning border-0 shadow-sm rounded-4 animate__animated animate__shakeX mt-3">
                        <i class="fa fa-info-circle me-2"></i> <strong>Akses Terbatas:</strong><br>
                        Silakan login terlebih dahulu agar sistem dapat mengenali data pemesanan Anda secara otomatis.
                    </div>
                @else
                    <i class="fa fa-user-lock fa-3x mb-3 text-primary"></i>
                    <h3 class="fw-bold">Login Sebagai?</h3>
                    <p class="text-muted text-uppercase small fw-bold">Dashboard Pengelola Sistem</p>
                @endif
            </div>

            <form action="login" method="post">
                @csrf
                <div class="mb-3">
                    <label class="form-label text-muted fw-bold small">USERNAME</label>
                    <input class="form-control rounded-pill px-4" style="border: 2px solid #eee; height: 50px;" type="text" placeholder="Masukkan ID..." name="username" required>
                </div>
                <div class="mb-4">
                    <label class="form-label text-muted fw-bold small">PASSWORD</label>
                    <input class="form-control rounded-pill px-4" style="border: 2px solid #eee; height: 50px;" type="password" placeholder="********" name="password" required>
                </div>
                <button type="submit" class="btn w-100 rounded-pill py-3 fw-bold text-dark border-0 shadow-sm" style="background-color: #ff9800;">
                    {{ request('intent') == 'order' ? 'Lanjutkan Pemesanan' : 'Masuk ke Dashboard' }} 
                    <i class="fa {{ request('intent') == 'order' ? 'fa-arrow-right' : 'fa-sign-in-alt' }} ms-2"></i>
                </button>
            </form>
        </div>
    </div>
</div>
@endsection