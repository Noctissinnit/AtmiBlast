@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Kirim Email ke Divisi</h2>

        <!-- Menampilkan notifikasi sukses -->
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('email.sendDivision') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Pilih Divisi -->
            <div class="form-group">
                <label for="division_id">Pilih Divisi:</label>
                <select name="division_id" id="division_id" class="form-control @error('division_id') is-invalid @enderror">
                    <option value="">Pilih Divisi</option>
                    @foreach($divisions as $division)
                        <option value="{{ $division->id }}" {{ old('division_id') == $division->id ? 'selected' : '' }}>
                            {{ $division->name }}
                        </option>
                    @endforeach
                </select>
                @error('division_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Subjek Email -->
            <div class="form-group">
                <label for="subject">Subjek:</label>
                <input type="text" name="subject" id="subject" class="form-control @error('subject') is-invalid @enderror" value="{{ old('subject') }}" required>
                @error('subject')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Isi Email -->
            <div class="form-group">
                <label for="message">Pesan:</label>
                <textarea name="message" id="message" rows="5" class="form-control @error('message') is-invalid @enderror" required>{{ old('message') }}</textarea>
                @error('message')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            {{-- @include('emails.select-multiple-emails') --}}

            <!-- File PDF (Opsional) -->
            <div class="form-group">
                <label for="pdf">Lampirkan File PDF:</label>
                <input type="file" name="pdf" id="pdf" class="form-control @error('pdf') is-invalid @enderror" accept="application/pdf">
                @error('pdf')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Kirim Email</button>
        </form>
    </div>
@endsection
