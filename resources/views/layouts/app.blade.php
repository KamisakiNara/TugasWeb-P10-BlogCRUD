<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Blog') | Tugas Rutin 10</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f7f7fa;
        }
        .navbar-brand {
            font-weight: 700;
        }
        footer {
            padding: 1.5rem 0;
            text-align: center;
            color: #6c757d;
            font-size: 0.875rem;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ route('posts.index') }}">Blog CRUD</a>
        <div class="navbar-nav ms-auto">
            <a class="nav-link" href="{{ route('posts.index') }}">Semua Post</a>
            <a class="nav-link" href="{{ route('posts.create') }}">Tambah Post</a>
            <a class="nav-link" href="{{ route('posts.trash') }}">Sampah</a>
        </div>
    </div>
</nav>

<main class="container py-4">
    @yield('content')
</main>

<footer>
    Tugas Rutin 10 - Pemrograman Web - Blog CRUD Laravel
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>