@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">📦 Daftar Unit Karya</h3>
        <a href="{{ route('units.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah Unit Karya
        </a>
    </div>

    <!-- Alerts -->
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <!-- Table Card -->
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Nama Unit Karya</th>
                        <th>Institusi</th>
                        <th class="text-center" style="width: 150px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($units as $index => $unit)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $unit->nama_unit }}</td>
                            <td>{{ $unit->institusi->nama_institusi ?? '-' }}</td>

                            <td class="text-center">
                                <a href="{{ route('units.edit', $unit->id) }}" class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil-square"></i>
                                </a>

                                <form action="{{ route('units.destroy', $unit->id) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('Yakin ingin menghapus unit karya ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-3">
                                <i class="bi bi-inbox"></i> Belum ada unit karya.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
