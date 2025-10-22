<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>@yield('title','Notícias')</title>
    <!-- Bootstrap CDN para simplicidade -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Pequeno estilo para aproximar do wireframe */
        .card-news { min-height: 260px; }
        footer { background:#f1f1f1; padding:10px 0; text-align:center; position:fixed; left:0; right:0; bottom:0; }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">LOGO</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('noticias.create') }}">Cadastrar Notícias</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('noticias.index') }}">Exibir Notícias</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('categorias.index') }}">Categorias</a></li>
            </ul>
        </div>
    </div>
</nav>

<main class="py-4 container">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @yield('content')
</main>

<footer>DESENVOLVIDO POR JEAN GOUVEIA</footer>
</body>
</html>
