@extends('layouts.app')

@section('title', 'Edit Divisi')

@section('content')
<h1>Edit Divisi</h1>
<form action="{{ route('divisions.update', $division) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="name" class="form-label">Nama Divisi</label>
        <input type="text" id="name" name="name" value="{{ $division->name }}" class="form-control @error('name') is-invalid @enderror">
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>
@endsection
