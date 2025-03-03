@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">📧 Kirim Email ke Unit Karya</h4>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('email.sendUnit') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Pilih Divisi -->
                        <div class="mb-3">
                            <label for="division_id" class="form-label">Divisi:</label>
                            <select name="division_id" id="division_id" class="form-select @error('division_id') is-invalid @enderror" required>
                                <option value="">Pilih Divisi</option>
                                @foreach ($divisions as $division)
                                    <option value="{{ $division->id }}">{{ $division->name }}</option>
                                @endforeach
                            </select>
                            @error('division_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Pilih Unit Karya (Akan diperbarui berdasarkan divisi yang dipilih) -->
                        <div class="mb-3">
                            <label for="unit_id" class="form-label">Unit Karya:</label>
                            <select name="unit_id" id="unit_id" class="form-select @error('unit_id') is-invalid @enderror" required>
                                <option value="">Pilih Unit Karya</option>
                                @foreach ($divisions as $division)
                                    @foreach ($division->unit_karyas as $unit)
                                        <option value="{{ $unit->id }}" data-division="{{ $division->id }}">{{ $unit->nama_unit_karya }}</option>
                                    @endforeach
                                @endforeach
                            </select>
                            @error('unit_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Subjek Email -->
                        <div class="mb-3">
                            <label for="subject" class="form-label">Subjek:</label>
                            <input type="text" name="subject" class="form-control @error('subject') is-invalid @enderror" required>
                            @error('subject')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Isi Email -->
                        <div class="mb-3">
                            <label for="message" class="form-label">Pesan:</label>
                            <textarea name="message" rows="5" class="form-control @error('message') is-invalid @enderror" required></textarea>
                            @error('message')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- @include('emails.select-multiple-emails') --}}

                        <!-- File PDF (Opsional) -->
                        <div class="mb-3">
                            <label for="pdf" class="form-label">Lampirkan File PDF:</label>
                            <input type="file" name="pdf" class="form-control @error('pdf') is-invalid @enderror" accept="application/pdf">
                            @error('pdf')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-send"></i> Kirim Email
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script untuk update dropdown Unit Karya sesuai dengan Divisi yang dipilih -->
<script>
    document.getElementById('division_id').addEventListener('change', function () {
        let divisionId = this.value;
        let unitSelect = document.getElementById('unit_id');
        unitSelect.innerHTML = '<option value="">Pilih Unit Karya</option>';

        document.querySelectorAll('#unit_id option[data-division]').forEach(option => {
            if (option.getAttribute('data-division') === divisionId) {
                unitSelect.appendChild(option.cloneNode(true));
            }
        });
    });
</script>

@endsection
