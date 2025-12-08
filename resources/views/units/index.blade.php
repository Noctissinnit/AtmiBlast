@extends('layouts.app')

@section('content')
<div class="container">

    <div class="d-flex justify-content-between mb-3">
        <h3>Daftar Unit Karya</h3>
        <a href="{{ route('units.create') }}" class="btn btn-primary">+ Tambah Unit Karya</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Unit</th>
                <th>Institusi</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse($units as $key => $unit)
            <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $unit->nama_unit }}</td>
                <td>{{ $unit->institusi->nama_institusi ?? '-' }}</td>
                <td>
                    <form action="{{ route('units.destroy', $unit->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center">Belum ada unit karya</td>
            </tr>
            @endforelse
        </tbody>
    </table>

</div>
@endsection
