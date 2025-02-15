@extends('layouts.app')

@section('content')
<form action="{{ route('email.sendIndividual') }}" method="POST" enctype="multipart/form-data">
    @csrf

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif


    <div class="form-group">
        <label for="employee_id">Karyawan</label>
        <select name="employee_id" id="employee_id" class="form-control" required>
            <option value="">Pilih Karyawan</option>
            @foreach($employees as $employee)
                <option value="{{ $employee->id }}">{{ $employee->user->name ?? $employee->name ?? '' }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="subject">Subjek</label>
        <input type="text" name="subject" id="subject" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="message">Pesan</label>
        <textarea name="message" id="message" class="form-control" rows="5" required></textarea>
    </div>

    <div class="form-group">
        <label for="pdf">Lampirkan PDF (Opsional)</label>
        <input type="file" name="pdf" id="pdf" class="form-control" accept="application/pdf">
    </div>

    <button type="submit" class="btn btn-primary">Kirim Email</button>
</form>


@endsection
