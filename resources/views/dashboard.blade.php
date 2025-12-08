@extends('layouts.app')

@section('head')
<style>
    /* Modern Minimalist Styling */
    .hero-section {
        background: #f8f9fa;
        border-bottom: 1px solid #e9ecef;
    }

    .dashboard-card {
        border-radius: 18px;
        padding: 32px 20px;
        transition: 0.2s ease;
        border: none;
        background: #ffffff;
    }

    .dashboard-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 18px rgba(0, 0, 0, 0.06);
    }

    .dashboard-icon {
        font-size: 42px;
        margin-bottom: 12px;
        opacity: 0.9;
    }

    footer {
        background: #fafafa;
        border-top: 1px solid #eaeaea;
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

<!-- Hero Section -->
<header class="hero-section py-5 text-center">
    <div class="container">
        <h1 class="display-5 fw-bold">Selamat Datang di <span class="text-primary">AtmiBlast</span></h1>
        <p class="text-muted mt-2">Kelola pengiriman email dengan mudah, cepat, dan efisien.</p>
    </div>
</header>

<div class="container mt-5">
    <div class="row justify-content-center">

        <!-- Main Content -->
        <div class="col-md-10">

            <div class="text-center mb-4">
                <h2 class="fw-bold">📊 Dashboard</h2>
                <p class="text-muted">Ringkasan data penting sistem Anda</p>
            </div>

            <div class="row g-4">
                <!-- Total Divisi -->
                <div class="col-md-4">
                    <div class="dashboard-card shadow-sm text-center">
                        <i class="bi bi-diagram-3 dashboard-icon text-primary"></i>
                        <h5 class="fw-semibold">Total Divisi</h5>
                        <h2 class="fw-bold mt-2 text-primary">{{ $divisionsCount ?? 0 }}</h2>
                    </div>
                </div>

                <!-- Total Karyawan -->
                <div class="col-md-4">
                    <div class="dashboard-card shadow-sm text-center">
                        <i class="bi bi-people-fill dashboard-icon text-success"></i>
                        <h5 class="fw-semibold">Total Karyawan</h5>
                        <h2 class="fw-bold mt-2 text-success">{{ $employeesCount ?? 0 }}</h2>
                    </div>
                </div>

                <!-- Total Unit Karya -->
                <div class="col-md-4">
                    <div class="dashboard-card shadow-sm text-center">
                        <i class="bi bi-box-seam dashboard-icon text-warning"></i>
                        <h5 class="fw-semibold">Total Unit Karya</h5>
                        <h2 class="fw-bold mt-2 text-warning">{{ $unitsCount ?? 0 }}</h2>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Footer -->
<footer class="text-center py-3 mt-5">
    <div class="container">
        <small class="text-muted">&copy; 2025 AtmiBlast. All Rights Reserved.</small>
    </div>
</footer>

@endsection
