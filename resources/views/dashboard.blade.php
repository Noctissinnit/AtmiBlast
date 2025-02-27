@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
@if (session('notification'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('notification') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<style>
    .list-group a {
        text-decoration: none; /* Menghilangkan underline */
    }

    .list-group a:hover {
        text-decoration: none; /* Menghilangkan underline saat hover */
        background-color: #f8f9fa; /* Warna latar belakang saat hover */
    }

    .dashboard-header {
        margin-bottom: 20px;
    }

    .sidebar {
        background-color: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .sidebar .list-group-item {
        border: none;
        padding-left: 20px;
    }

    .sidebar .list-group-item:first-child {
        font-weight: bold;
        background-color: #e9ecef;
    }

    .content-section {
        padding: 20px;
        border-radius: 8px;
        background-color: #ffffff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
</style>

<script>
       function checkQueueStatus() {
        $.get('/queue-status', function (data) {
            if (data.jobs > 0) {
                $('#queue-loading').show(); // Tampilkan loading jika masih ada antrian
            } else {
                $('#queue-loading').hide(); // Sembunyikan jika queue sudah kosong
            }
        });
    }

    // Jalankan fungsi saat halaman dimuat dan refresh setiap 5 detik
    $(document).ready(function () {
        checkQueueStatus();
        setInterval(checkQueueStatus, 5000);
    });
</script>

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif



<div class="row">
    <div class="col-md-3 sidebar">
        <ul class="list-group">
            <li class="list-group-item"><a href="{{ route('divisions.index') }}">Divisi</a></li>
            <li class="list-group-item"><a href="{{ route('employees.index') }}">Karyawan</a></li>
            <li class="list-group-item"><a href="{{ route('units.create') }}">Tambah Unit Karya</a></li>
            <li class="list-group-item">
                <strong>Kirim Email</strong>
                <div class="dropdown">
                    <button class="btn btn-link dropdown-toggle" type="button" id="emailDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        Pilih Opsi
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="emailDropdown">
                        <li><a class="dropdown-item" href="{{ route('email.individual') }}">Ke Individu</a></li>
                        <li><a class="dropdown-item" href="{{ route('email.division') }}">Ke Divisi</a></li>
                        <li><a class="dropdown-item" href="{{ route('email.unit') }}">Ke Unit Karya</a></li>
                    </ul>
                </div>
            </li>
         
        </ul>
    </div>

    <div class="col-md-9 content-section">
        <div class="dashboard-header">
            <h1>Selamat datang di Dashboard</h1>
            <p>Gunakan menu di sisi kiri untuk navigasi.</p>
        </div>
        <div class="alert alert-info" role="alert">
            Pastikan Anda memilih divisi dan unit karya dengan benar saat menambahkan karyawan atau unit karya.
        </div>
    </div>
</div>

<div id="queue-loading" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg flex flex-col items-center space-y-4">
        <div class="animate-spin rounded-full h-16 w-16 border-t-4 border-blue-500 border-solid"></div>
        <p class="text-lg font-semibold text-gray-700">📩 Sedang mengirim email...</p>
        <p class="text-sm text-gray-500">Mohon tunggu sebentar hingga proses selesai</p>
    </div>
</div>

@endsection
