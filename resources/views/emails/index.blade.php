@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg p-4">
        <h2 class="mb-4 text-center">Tambah Email Pengirim</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('email.store') }}" class="needs-validation" novalidate>
            @csrf

            <div class="mb-3">
                <label class="form-label">SMTP Email:</label>
                <input type="email" name="email" class="form-control" placeholder="name@example.com" value="{{ old('email_pengirim', $config['email_pengirim'] ?? '') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">SMTP Password:</label>
                <input type="password" name="password" class="form-control" placeholder="(Opsional)" value="{{ old('smtp_pass', $config['smtp_pass'] ?? '') }}" required>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
