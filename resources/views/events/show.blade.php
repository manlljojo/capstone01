@extends('layout')
@section('title','Home')
@section('content')
    <div class="p-6 max-w-3xl mx-auto">

        {{-- Banner --}}
        @if($event->banner)
            <img src="{{ asset('storage/banners/' . $event->banner) }}"
                 class="w-full h-64 object-cover rounded mb-4">
        @endif

        {{-- Judul --}}
        <h1 class="text-2xl font-bold mb-2">
            {{ $event->nama_event }}
        </h1>

        {{-- Info --}}
        <p class="text-gray-600 mb-2">📅 {{ $event->tanggal }}</p>
        <p class="text-gray-600 mb-2">📍 {{ $event->lokasi }}</p>
        <p class="text-gray-600 mb-4">🏷️ {{ $event->kategori }}</p>

        {{-- Deskripsi --}}
        <p class="text-gray-800">
            {{ $event->deskripsi }}
        </p>

        <a href="/" class="text-blue-500 mt-4 inline-block">
            ← Kembali
        </a>
    </div>
@endsection