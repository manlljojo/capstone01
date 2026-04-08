@extends('layout')
@section('title','Home')
@section('content')
<h2>Edit Event</h2>

<form action="{{ route('events.update', $event->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Nama Event</label><br>
    <input type="text" name="nama_event" value="{{ $event->nama_event }}"><br><br>

    <label>Deskripsi</label><br>
    <textarea name="deskripsi">{{ $event->deskripsi }}</textarea><br><br>

    <label>Tanggal</label><br>
    <input type="date" name="tanggal" value="{{ $event->tanggal }}"><br><br>

    <label>Lokasi</label><br>
    <input type="text" name="lokasi" value="{{ $event->lokasi }}"><br><br>

    <button type="submit">Update</button>
</form>
@endsection