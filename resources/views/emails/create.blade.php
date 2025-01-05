@extends('layouts.app')

@section('title', 'Kirim Email')

@section('content')

<script>
    $(document).ready(function() {
        // Inisialisasi Select2
        $('#emails').select2({
            placeholder: "Pilih karyawan...",
            allowClear: true,
            theme: "bootstrap-5" // Pastikan ini kompatibel dengan AdminLTE
        });
    });
</script>

<h1>Kirim Email</h1>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<form action="{{ route('send-email.post') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="sender_name" class="form-label">Nama Pengirim</label>
        <input type="text" name="sender_name" id="sender_name" class="form-control @error('sender_name') is-invalid @enderror">
        @error('sender_name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    
    <div class="mb-3">
        <label for="sender_email" class="form-label">Alamat Email Pengirim</label>
        <input type="email" name="sender_email" id="sender_email" class="form-control @error('sender_email') is-invalid @enderror">
        @error('sender_email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    
    <div class="mb-3">
        <label for="subject" class="form-label">Subject</label>
        <input type="text" name="subject" id="subject" 
               class="form-control @error('subject') is-invalid @enderror"
               value="{{ old('subject') }}">
        @error('subject')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="body" class="form-label">Body</label>
        <textarea name="body" id="body" rows="4" 
                  class="form-control @error('body') is-invalid @enderror">{{ old('body') }}</textarea>
        @error('body')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="emails" class="form-label">Pilih Karyawan</label>
        <select name="emails[]" id="emails" 
                class="form-select select2 @error('emails') is-invalid @enderror" multiple>
            @foreach($divisions as $division)
                <optgroup label="{{ $division->name }}">
                    @foreach($division->employees as $employee)
                        <option value="{{ $employee->email }}" 
                                {{ collect(old('emails'))->contains($employee->email) ? 'selected' : '' }}>
                            {{ $employee->name }} ({{ $employee->email }})
                        </option>
                    @endforeach
                </optgroup>
            @endforeach
        </select>
        @error('emails')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    

    <div class="mb-3">
        <label for="pdf" class="form-label">Lampiran PDF (Opsional)</label>
        <input type="file" name="pdf" id="pdf" 
               class="form-control @error('pdf') is-invalid @enderror">
        @error('pdf')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    

    <button type="submit" class="btn btn-primary">Kirim</button>
</form>
@endsection
