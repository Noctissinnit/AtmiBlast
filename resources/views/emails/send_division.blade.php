@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">📩 Kirim Email ke Divisi</h4>
                </div>
                <div class="card-body">
                    <!-- Notifikasi sukses -->
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('email.sendDivision') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Pilih Divisi -->
                        <div class="mb-3">
                            <label for="division_id" class="form-label">Pilih Divisi:</label>
                            <select name="division_id" id="division_id" class="form-select @error('division_id') is-invalid @enderror">
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
                        <div class="mb-3">
                            <label for="subject" class="form-label">Subjek:</label>
                            <input type="text" name="subject" id="subject" class="form-control @error('subject') is-invalid @enderror" value="{{ old('subject') }}" required>
                            @error('subject')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Isi Email -->
                        <div class="mb-3">
                            <label for="message" class="form-label">Pesan:</label>
                            <textarea name="message" id="message" rows="5" class="form-control @error('message') is-invalid @enderror" required>{{ old('message') }}</textarea>
                            @error('message')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        @include('emails.select-multiple-emails')

                        <!-- File PDF (Opsional) -->
                        <div class="mb-3">
                            <label for="pdf" class="form-label">Lampirkan File PDF:</label>
                            <input type="file" name="pdf" id="pdf" class="form-control @error('pdf') is-invalid @enderror" accept="application/pdf">
                            @error('pdf')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-envelope"></i> Kirim Email
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
