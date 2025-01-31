@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Unit Karya dalam Divisi: {{ $division->name }}</h2>

    @if ($division->unit_karyas->isEmpty())
        <p>Tidak ada unit karya dalam divisi ini.</p>
    @else
        <ul class="list-group">
            @foreach ($division->unit_karyas as $unit)
                <li class="list-group-item">{{ $unit->nama_unit_karya }}</li>
            @endforeach
        </ul>
    @endif

    <a href="{{ route('divisions.index') }}" class="btn btn-secondary mt-3">Kembali ke Daftar Divisi</a>
</div>
@endsection
