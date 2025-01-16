@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
@if (session('notification'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('notification') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<style>
    .list-group a {
        text-decoration: none; /* Menghilangkan underline */
    }

    .list-group a:hover {
        text-decoration: none; /* Menghilangkan underline saat hover */
    }
</style>

<div class="row">
    <div class="col-md-3">
        <ul class="list-group">
            <li class="list-group-item"><a href="{{ route('divisions.index') }}">Divisi</a></li>
            <li class="list-group-item"><a href="{{ route('employees.index') }}">Karyawan</a></li>
            <li class="list-group-item"><a href="{{ url('send-email') }}">Kirim Email</a></li>
        </ul>
    </div>
    <div class="col-md-9">
        <h1>Selamat datang di Dashboard</h1>
        <p>Gunakan menu di sisi kiri untuk navigasi.</p>
    </div>
</div>
@endsection
