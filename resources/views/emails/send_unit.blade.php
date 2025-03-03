@extends('layouts.app')

@section('content')
<form action="{{ route('email.sendUnit') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="division_id">Divisi</label>
        <select name="division_id" class="form-control" required>
            @foreach ($divisions as $division)
                <option value="{{ $division->id }}">{{ $division->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="unit_id">Unit Karya</label>
        <select name="unit_id" class="form-control" required>
            @foreach ($divisions as $division)
                @if ($division->unit_karyas->isNotEmpty())
                    @foreach ($division->unit_karyas as $unit)
                        <option value="{{ $unit->id }}">{{ $unit->nama_unit_karya }}</option>
                    @endforeach
                @endif
            @endforeach
        </select>
        
    </div>
    <div class="form-group">
        <label for="subject">Subjek</label>
        <input type="text" name="subject" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="message">Pesan</label>
        <textarea name="message" class="form-control" rows="5" required></textarea>
    </div>
    {{-- @include('emails.select-multiple-emails') --}}
    <div class="form-group">
        <label for="pdf">Lampiran (PDF)</label>
        <input type="file" name="pdf" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Kirim Email</button>
</form>


@endsection
