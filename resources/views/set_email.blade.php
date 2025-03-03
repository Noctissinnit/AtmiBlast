@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg p-4">
        <h2 class="mb-4 text-center">Pengaturan Email Pengirim</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ url('/settings/email') }}" class="needs-validation" novalidate>
            @csrf

            <div class="mb-3">
                <label class="form-label">Email Pengirim:</label>
                <input type="email" name="email_pengirim" class="form-control" value="{{ old('email_pengirim', $config['email_pengirim'] ?? '') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Nama Pengirim:</label>
                <input type="text" name="nama_pengirim" class="form-control" value="{{ old('nama_pengirim', $config['nama_pengirim'] ?? '') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">SMTP Host:</label>
                <input type="text" name="smtp_host" class="form-control" value="{{ old('smtp_host', $config['smtp_host'] ?? '') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">SMTP Port:</label>
                <input type="number" name="smtp_port" class="form-control" value="{{ old('smtp_port', $config['smtp_port'] ?? '') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">SMTP User:</label>
                <input type="text" name="smtp_user" class="form-control" value="{{ old('smtp_user', $config['smtp_user'] ?? '') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">SMTP Password:</label>
                <input type="password" name="smtp_pass" class="form-control" value="{{ old('smtp_pass', $config['smtp_pass'] ?? '') }}" required>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
