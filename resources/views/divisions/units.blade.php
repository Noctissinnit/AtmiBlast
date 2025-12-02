@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Unit Karya dalam Divisi: {{ $institusi->name }}</h2>

    @if ($institusi->unit_karyas->isEmpty())
        <p>Tidak ada unit karya dalam divisi ini.</p>
    @else
        <ul class="list-group">
            @foreach ($institusi->unit_karyas as $unit)
                <li class="list-group-item">{{ $unit->nama_unit_karya }}</li>
            @endforeach
        </ul>
    @endif

    <a href="{{ route('institusis.index') }}" class="btn btn-secondary mt-3">Kembali ke Daftar Divisi</a>
</div>
@endsection
