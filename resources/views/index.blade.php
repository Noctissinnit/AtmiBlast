<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AtmiBlast - Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }

        .hero-section {
            background: #f8f9fa;
            padding: 80px 0;
            text-align: center;
        }

        .hero-section h1 {
            font-weight: bold;
        }

        .feature-icon {
            font-size: 3rem;
            color: #007bff;
        }

        .feature-box {
            transition: transform 0.3s ease-in-out;
        }

        .feature-box:hover {
            transform: translateY(-5px);
        }

        .footer {
            background: #f8f9fa;
            padding: 20px 0;
            text-align: center;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">AtmiBlast</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#features">Fitur</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">Tentang Kami</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Kontak</a></li>
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="btn btn-primary ms-3">Masuk</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="hero-section">
        <div class="container">
            <h1 class="display-4">Kelola Email dengan Mudah dan Cepat</h1>
            <p class="lead text-muted">AtmiBlast membantu Anda mengirim email ke karyawan dengan efisien.</p>
            <a href="{{ route('login') }}" class="btn btn-primary btn-lg mt-3">Mulai Sekarang</a>
        </div>
    </header>

    <!-- Features Section -->
    <section id="features" class="py-5">
        <div class="container text-center">
            <h2 class="fw-bold mb-4">Fitur Utama</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="feature-box p-4 shadow rounded bg-white">
                        <i class="bi bi-envelope feature-icon"></i>
                        <h5 class="mt-3">Pengiriman Email Massal</h5>
                        <p class="text-muted">Kirim email ke banyak karyawan dengan sekali klik.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-box p-4 shadow rounded bg-white">
                        <i class="bi bi-ui-checks feature-icon"></i>
                        <h5 class="mt-3">Mudah Digunakan</h5>
                        <p class="text-muted">Antarmuka yang intuitif dan simpel untuk semua pengguna.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-box p-4 shadow rounded bg-white">
                        <i class="bi bi-lock feature-icon"></i>
                        <h5 class="mt-3">Keamanan Terjamin</h5>
                        <p class="text-muted">Data Anda aman dengan enkripsi tingkat tinggi.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    {{-- <section id="about" class="py-5 bg-light">
        <div class="container text-center">
            <h2 class="fw-bold mb-4">Tentang Kami</h2>
            <p class="lead text-muted">AtmiBlast adalah platform pengelolaan email yang dibuat untuk mempermudah komunikasi dalam perusahaan.</p>
        </div>
    </section> --}}

    {{-- <!-- Contact Section -->
    <section id="contact" class="py-5">
        <div class="container text-center">
            <h2 class="fw-bold mb-4">Hubungi Kami</h2>
            <p class="text-muted">Jika Anda memiliki pertanyaan, silakan hubungi kami melalui email di <strong>support@atmiblast.com</strong>.</p>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p class="mb-0">&copy; 2025 AtmiBlast. Semua Hak Dilindungi.</p>
        </div>
    </footer> --}}

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
