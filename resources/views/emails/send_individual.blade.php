@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">📩 Kirim Email ke Karyawan</h4>
                </div>
                <div class="card-body">
                    <!-- Notifikasi sukses -->
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <!-- Notifikasi error -->
                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <form action="{{ route('email.sendIndividual') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Pilih Karyawan -->
                        <div class="mb-3">
                            <label for="employee_id" class="form-label">Karyawan:</label>
                            <select name="employee_id" id="employee_id" class="form-select @error('employee_id') is-invalid @enderror" required>
                                <option value="">Pilih Karyawan</option>
                                @foreach($employees as $employee)
                                    <option value="{{ $employee->id }}">{{ $employee->user->name ?? $employee->name ?? '' }}</option>
                                @endforeach
                            </select>
                            @error('employee_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Subjek Email -->
                        <div class="mb-3">
                            <label for="subject" class="form-label">Subjek:</label>
                            <input type="text" name="subject" id="subject" class="form-control @error('subject') is-invalid @enderror" required>
                            @error('subject')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Isi Email -->
                        <div class="mb-3">
                            <label for="message" class="form-label">Pesan:</label>
                            <textarea name="message" id="message" rows="5" class="form-control @error('message') is-invalid @enderror" required></textarea>
                            @error('message')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- @include('emails.select-email') --}}

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
