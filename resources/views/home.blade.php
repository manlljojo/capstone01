@extends('layout')
@section('title','Home')
@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 p-6">
    @foreach ($events as $event)
        <a href="{{ route('events.show', $event->id) }}">
            <div class="border rounded-lg shadow hover:shadow-lg transition overflow-hidden">

                {{-- Banner --}}
                @if($event->banner)
                    <img src="{{ asset('storage/banners/' . $event->banner) }}"
                         class="w-full h-40 object-cover">
                @else
                    <div class="w-full h-40 bg-gray-300 flex items-center justify-center">
                        No Image
                    </div>
                @endif

                {{-- Content --}}
                <div class="p-4">
                    <h3 class="font-bold text-lg">
                        {{ $event->nama_event }}
                    </h3>

                    <p class="text-sm text-gray-600">
                        📅 {{ $event->tanggal }}
                    </p>

                    <p class="text-sm text-gray-600">
                        📍 {{ $event->lokasi }}
                    </p>
                </div>

            </div>
        </a>
    @endforeach
</div>
@endsection