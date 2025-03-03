@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold">Daftar Divisi</h1>
        <a href="{{ route('divisions.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Tambah Divisi
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-striped align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>#</th>
                        <th>Nama Divisi</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($divisions as $division)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $division->name }}</td>
                            <td class="text-center">
                                <a href="{{ route('divisions.edit', $division->id) }}" class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>

                                <form action="{{ route('divisions.destroy', $division->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus divisi ini?')">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>

                                <a href="{{ route('divisions.units', $division->id) }}" class="btn btn-info btn-sm">
                                    <i class="bi bi-eye"></i> Lihat Unit Karya
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
