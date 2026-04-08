@extends('layout')
@section('title','Pesan Tiket')
@section('content')
<h2>Pesan Tiket Anda di Sini</h2>
<form class="" action="tiket" method="post">
    @csrf
    <input class="form-control" type="text" placeholder="Nama" name="nama"><br>
    <input class="form-control" type="text" placeholder="Alamat" name="alamat"><br>
    <input class="form-control" type="text" placeholder="Nomor Hp" name="nomor_hp"><br>
    <button type="submit" class="btn btn-primary">Pesan</button>
</form>
@endsection