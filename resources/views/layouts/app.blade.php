<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'AtmiBlast')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/css/select2.min.css" integrity="sha512-ihmiCY5JkxzN3Vwy7djzdm8GSRRa5i66/I6l6QDHaSDxmjqXz8kFqW+ICc23XDbAZH7t9FQw8xs/GzQfztwXIw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<!-- Tambahkan JS Select2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/js/select2.min.js" integrity="sha512-nMNlpuaDPrql/nwbXIkUek8DdCLJmC/jdSrtTA3QoBnkSUqWr0YF2IwA7EfwJpC7cxsgH9QQxyVg/k9kFVQF4A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">AtmiBlast</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    @auth
                        <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('logout') }}">Logout</a></li>
                    @else
                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-4">
        @yield('content')
    </div>
    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
