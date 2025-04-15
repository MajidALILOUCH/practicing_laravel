<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ISMO - Mon Blog - @yield('title')</title>
    <!-- Intégration de Bootstrap (exemple) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="/">Mon Mini Blog</a>
            <div class="navbar-nav">
                <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="/">Articles</a>
                <a class="nav-link {{ Request::is('about') ? 'active' : '' }}" href="/about">À propos</a>
            </div>
        </div>
    </nav>

    <!-- Contenu principal -->
    <div class="container mt-4">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="mt-5 bg-light py-3 text-center">
        <p>© 2025 Mon Blog Laravel. Tous droits réservés.</p>
    </footer>
</body>

</html>
