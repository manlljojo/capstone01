@extends('layout')
@section('title','Home')
@section('content')
    <div class="p-6">
        <h2 class="text-xl mb-4">Tambah Event</h2>

        <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label>Nama Event</label>
                <input type="text" name="nama_event" class="border w-full p-2">
            </div>

            <div class="mb-3">
                <label>Banner</label>
                <input type="file" name="banner" class="border w-full p-2">
            </div>

            <div class="mb-3">
                <label>Kategori</label>
                <input type="text" name="kategori" class="border w-full p-2">
            </div>

            <div class="mb-3">
                <label>Deskripsi</label>
                <textarea name="deskripsi" class="border w-full p-2"></textarea>
            </div>

            <div class="mb-3">
                <label>Tanggal</label>
                <input type="date" name="tanggal" class="border w-full p-2">
            </div>

            <div class="mb-3">
                <label>Lokasi</label>
                <input type="text" name="lokasi" class="border w-full p-2">
            </div>

            <button class="bg-blue-500 text-white px-4 py-2 rounded">
                Simpan
            </button>
        </form>
    </div>
@endsection