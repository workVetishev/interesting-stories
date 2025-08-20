<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Интересные истории</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { padding-top: 70px; }
        .story-card { transition: transform 0.2s; }
        .story-card:hover { transform: translateY(-2px); }
    </style>
</head>
<body>
<!-- Навигация -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">Интересные истории</a>

        <div class="navbar-nav ms-auto">
            @guest
                <a class="nav-link" href="{{ route('login') }}">Войти</a>
                <a class="nav-link" href="{{ route('register.form') }}">Регистрация</a>
            @else
                <a class="nav-link" href="{{ route('stories.createForm') }}">Добавить историю</a>
                <span class="nav-link">Привет, <strong>{{ auth()->user()->name }}</strong>!</span>
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-light btn-sm">Выход</button>
                </form>
            @endguest
        </div>
    </div>
</nav>

<!-- Основное содержимое -->
<div class="container">
    @if (session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger mt-3">
            {{ session('error') }}
        </div>
    @endif

    @yield('content')
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
