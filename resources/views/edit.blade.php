@extends('layout')
@section('title','Admin')
@section('content')
<h2>Edit Data Peserta</h2><br>
<form class="" action="/edit/{{$peserta->id}}" method="post">
    @csrf
    @method('PUT')
    <input class="form-control" type="text" placeholder="Nama" name="nama" value="{{$peserta->nama}}"><br>
    <input class="form-control" type="text" placeholder="Alamat" name="alamat" value="{{$peserta->alamat}}"><br>
    <input class="form-control" type="text" placeholder="Nomor Hp" name="nomor_hp"value="{{$peserta->nomor_hp}}"><br>
    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection