@extends('layout')
@section('title','Daftar')
@section('content')
<table class="table">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Nomor HP</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($peserta as $data)
        <tr class="{{$data->check_in === 'Sudah' ? 'table-success' : ''}}">
            <td>{{ $data->nama }}</td>
            <td>{{ $data->alamat }}</td>
            <td>{{ $data->nomor_hp }}</td>
            <td>{{ $data->check_in }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection