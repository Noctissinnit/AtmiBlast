@extends('layouts.app')

@section('title', 'Kirim Email')

@section('content')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function () {
        let selectedEmailsFromDivisions = []; // Array untuk menyimpan email yang dipilih melalui checkbox

        // Inisialisasi Select2
        $('#emails').select2({
            placeholder: "Pilih karyawan...",
            allowClear: true,
            theme: "bootstrap-5",
            width: 'resolve'
        });

        // Ketika checkbox divisi diubah
        $('.division-checkbox').change(function () {
            let emails = $(this).data('emails'); // Ambil email karyawan dari data attribute
            let isChecked = $(this).is(':checked');

            if (isChecked) {
                // Tambahkan email dari divisi ke array
                selectedEmailsFromDivisions = [...new Set([...selectedEmailsFromDivisions, ...emails])];
            } else {
                // Hapus email dari divisi yang tidak dipilih
                selectedEmailsFromDivisions = selectedEmailsFromDivisions.filter(email => !emails.includes(email));
            }

            // Perbarui input hidden untuk menyimpan email dari divisi
            $('#emails-from-divisions').val(JSON.stringify(selectedEmailsFromDivisions));

            // Tidak menampilkan email dari checkbox divisi di field Select2
            $('#emails').find('option').each(function () {
                if (selectedEmailsFromDivisions.includes($(this).val())) {
                    $(this).prop('disabled', isChecked); // Disable opsi
                } else {
                    $(this).prop('disabled', false); // Aktifkan kembali jika tidak dipilih
                }
            });

            $('#emails').select2(); // Refresh elemen Select2
        });
    });
</script>


<div class="card mt-3">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Kirim Email</h5>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('send-email.post') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-3">
                <!-- Nama Pengirim -->
                <div class="col-md-6">
                    <label for="sender_name" class="form-label">Nama Pengirim</label>
                    <input type="text" name="sender_name" id="sender_name" 
                           class="form-control @error('sender_name') is-invalid @enderror" placeholder="Nama Pengirim">
                    @error('sender_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <!-- Email Pengirim -->
                {{-- <div class="col-md-6">
                    <label for="sender_email" class="form-label">Email Pengirim</label>
                    <input type="email" name="sender_email" id="sender_email" 
                           class="form-control @error('sender_email') is-invalid @enderror" placeholder="Email Pengirim">
                    @error('sender_email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div> --}}

                <!-- Subject -->
                <div class="col-md-12">
                    <label for="subject" class="form-label">Subject</label>
                    <input type="text" name="subject" id="subject" 
                           class="form-control @error('subject') is-invalid @enderror" placeholder="Judul Email" 
                           value="{{ old('subject') }}">
                    @error('subject')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Body -->
                <div class="col-md-12">
                    <label for="body" class="form-label">Body</label>
                    <textarea name="body" id="body" rows="3" 
                              class="form-control @error('body') is-invalid @enderror" 
                              placeholder="Isi pesan">{{ old('body') }}</textarea>
                    @error('body')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <!-- Divisi Selection -->
                    <div class="col-md-6">
                        <label for="divisions" class="form-label fw-bold">Pilih Divisi</label>
                        <div class="form-control p-3">
                            @foreach($divisions as $division)
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input division-checkbox" 
                                           id="division_{{ $division->id }}" 
                                           data-emails='@json($division->employees->pluck("email"))'>
                                    <label for="division_{{ $division->id }}" class="form-check-label">
                                        {{ $division->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                
                    <!-- Karyawan Individu -->
                    <div class="col-md-6">
                        <label for="emails" class="form-label fw-bold">Pilih Karyawan</label>
                        <select name="emails[]" id="emails" 
                                class="form-select select2 @error('emails') is-invalid @enderror" 
                                multiple style="width: 100%;" data-placeholder="Cari karyawan...">
                            @foreach($divisions as $division)
                                <optgroup label="{{ $division->name }}" class="fw-semibold text-primary">
                                    @foreach($division->employees as $employee)
                                        <option value="{{ $employee->email }}" 
                                                {{ collect(old('emails'))->contains($employee->email) ? 'selected' : '' }}>
                                            {{ $employee->user->name ?? $employee->name ?? '' }} ({{ $employee->user->email ?? $employee->email ?? '' }})
                                        </option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                        @error('emails')
                            <div class="invalid-feedback mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Input hidden untuk menyimpan email dari divisi yang dipilih -->
                <input type="hidden" name="emails_from_divisions" id="emails-from-divisions">

                <!-- Upload Lampiran PDF -->
                <div class="col-md-12">
                    <label for="pdf" class="form-label">Lampiran PDF</label>
                    <input type="file" name="pdf" id="pdf" 
                           class="form-control @error('pdf') is-invalid @enderror">
                    @error('pdf')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mt-3 text-end">
                <button type="submit" class="btn btn-primary">Kirim</button>
            </div>
        </form>
    </div>
</div>

@endsection
