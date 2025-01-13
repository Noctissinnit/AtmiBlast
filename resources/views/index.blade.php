<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Homepage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="#">AtmiBlast</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            {{-- <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#features">Features</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                </ul>
            </div> --}}
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="bg-light text-center py-5">
        <div class="container">
            <h1 class="display-4 fw-bold">Welcome to Our Website</h1>
            <p class="lead text-muted">Modern design. Minimal effort. Maximum impact.</p>
            <a href="{{ route('login') }}" class="btn btn-primary btn-lg mt-3">Mulai</a>
        </div>
    </header>

    <!-- Features Section -->
    {{-- <section id="features" class="py-5">
        <div class="container text-center">
            <h2 class="fw-bold mb-4">Features</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="icon mb-3">
                                <i class="bi bi-speedometer2 fs-1 text-primary"></i>
                            </div>
                            <h5 class="card-title">Fast Performance</h5>
                            <p class="card-text">Experience blazing fast speed with our platform.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="icon mb-3">
                                <i class="bi bi-shield-lock fs-1 text-primary"></i>
                            </div>
                            <h5 class="card-title">Secure</h5>
                            <p class="card-text">We ensure top-notch security for your data.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="icon mb-3">
                                <i class="bi bi-ui-checks fs-1 text-primary"></i>
                            </div>
                            <h5 class="card-title">User-Friendly</h5>
                            <p class="card-text">Our platform is designed for ease of use.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    <!-- About Section -->
    {{-- <section id="about" class="py-5 bg-light">
        <div class="container text-center">
            <h2 class="fw-bold mb-4">About Us</h2>
            <p class="lead text-muted">We are a team of passionate individuals committed to delivering the best web experiences.</p>
            <a href="#contact" class="btn btn-outline-primary mt-3">Get in Touch</a>
        </div>
    </section> --}}

    <!-- Footer -->
    {{-- <footer class="bg-dark text-white py-4">
        <div class="container text-center">
            <p class="mb-0">&copy; 2025 YourBrand. All Rights Reserved.</p>
        </div>
    </footer> --}}

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
