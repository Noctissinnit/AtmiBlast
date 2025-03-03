@extends('layouts.app')

@section('title', 'Dashboard')

@section('head')
<style>
    /* Styling Sidebar */
    .sidebar {
        background-color: #343a40;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(65, 0, 0, 0.1);
    }

    .sidebar .list-group-item {
        border: none;
        color: white;
        background: transparent;
        transition: background 0.3s ease-in-out;
    }

    .sidebar .list-group-item:hover {
        background-color: rgba(255, 255, 255, 0.2);
    }

    .sidebar a {
        color: white;
        text-decoration: none;
        font-weight: 500;
    }

    /* Dashboard Content */
    .content-section {
        padding: 20px;
        border-radius: 8px;
        background-color: #ffffff;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        animation: fadeIn 0.5s ease-in-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Queue Loading Overlay */
    #queue-loading {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        align-items: center;
        justify-content: center;
    }

    .loading-box {
        background: white;
        padding: 20px;
        border-radius: 10px;
        text-align: center;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }
</style>

<script>
    function checkQueueStatus() {
        $.get('/queue-status', function (data) {
            if (data.jobs > 0) {
                $('#queue-loading').fadeIn();
            } else {
                $('#queue-loading').fadeOut();
            }
        });
    }

    $(document).ready(function () {
        checkQueueStatus();
        setInterval(checkQueueStatus, 5000);
    });
</script>
@endsection

@section('content')
@if (session('notification'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('notification') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="row">
    <!-- Sidebar -->
    <div class="col-md-3 sidebar">
        <ul class="list-group">
            <li class="list-group-item">
                <i class="bi bi-building"></i> <a href="{{ route('divisions.index') }}"> Divisi</a>
            </li>
            <li class="list-group-item">
                <i class="bi bi-people"></i> <a href="{{ route('employees.index') }}"> Karyawan</a>
            </li>
            <li class="list-group-item">
                <i class="bi bi-plus-circle"></i> <a href="{{ route('units.create') }}"> Tambah Unit Karya</a>
            </li>
            <li class="list-group-item">
                <i class="bi bi-envelope"></i> <a href="{{ route('setemail') }}"> Set Email Pengirim</a>
            </li>
            <li class="list-group-item">
                <strong><i class="bi bi-send"></i> Kirim Email</strong>
                <div class="dropdown">
                    <button class="btn btn-light dropdown-toggle w-100 mt-2" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Pilih Opsi
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('email.individual') }}"><i class="bi bi-person"></i> Ke Individu</a></li>
                        <li><a class="dropdown-item" href="{{ route('email.division') }}"><i class="bi bi-diagram-3"></i> Ke Divisi</a></li>
                        <li><a class="dropdown-item" href="{{ route('email.unit') }}"><i class="bi bi-box"></i> Ke Unit Karya</a></li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>

    <!-- Content Section -->
    <div class="col-md-9 content-section">
        <div class="dashboard-header text-center">
            <h1 class="mb-3">📊 Dashboard</h1>
            <p class="text-muted">Gunakan menu di sisi kiri untuk navigasi.</p>
        </div>

        <div class="alert alert-info d-flex align-items-center" role="alert">
            <i class="bi bi-info-circle me-2"></i>
            <span>Pastikan Anda memilih divisi dan unit karya dengan benar saat menambahkan karyawan atau unit karya.</span>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="card text-center shadow">
                    <div class="card-body">
                        <h5 class="card-title">📌 Total Divisi</h5>
                        <h3 class="text-primary">{{ $divisionsCount ?? 0 }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center shadow">
                    <div class="card-body">
                        <h5 class="card-title">👨‍💼 Total Karyawan</h5>
                        <h3 class="text-success">{{ $employeesCount ?? 0 }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center shadow">
                    <div class="card-body">
                        <h5 class="card-title">📦 Total Unit Karya</h5>
                        <h3 class="text-warning">{{ $unitsCount ?? 0 }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Queue Loading Indicator -->
{{-- <div id="queue-loading" class="d-flex">
    <div class="loading-box">
        <div class="spinner-border text-primary" role="status"></div>
        <p class="mt-2">📩 Sedang mengirim email...</p>
        <small class="text-muted">Mohon tunggu sebentar...</small>
    </div>
</div> --}}
@endsection
