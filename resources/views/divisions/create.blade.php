@extends('layouts.app')

@section('title', 'Tambah Divisi')

@section('content')
<h1>Tambah Divisi</h1>
<form action="{{ route('institusis.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Nama Divisi</label>
        <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror">
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>
@endsection
