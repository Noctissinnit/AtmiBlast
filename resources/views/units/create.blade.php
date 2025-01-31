@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Unit Karya</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('units.store') }}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label for="nama_unit_karya">Nama Unit Karya</label>
            <input type="text" name="nama_unit_karya" class="form-control" required>
        </div>
        <div class="form-group mb-3">
            <label for="division_id">Pilih Divisi</label>
            <select name="division_id" class="form-control" required>
                <option value="">Pilih Divisi</option>
                @foreach($divisions as $division)
                    <option value="{{ $division->id }}">{{ $division->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection
