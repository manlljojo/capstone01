@extends('layout')
@section('title','Home')
@section('content')
<h2>Halaman Login Admin</h2>
<form class="" action="login" method="post">
    @csrf
    <br>
    <div class="form-group">
    <input class="form-control" type="text" placeholder="Username" name="username"><br>
    <input class="form-control" type="password" placeholder="Password" name="password"><br>
    </div>
    <button type="submit" class="btn btn-primary">Login</button>
</form>
@endsection