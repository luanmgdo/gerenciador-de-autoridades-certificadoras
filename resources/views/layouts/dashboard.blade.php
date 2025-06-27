<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="/">GestãoOnline</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link" href="{{ route('ac.index') }}">AC</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('ac_n2.index') }}">AC N2</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('ar.index') }}">AR</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('json.import') }}">Upload Arquivo</a></li>
      </ul>
      <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
            <!-- Nome do Usuário Logado -->
            <li class="nav-item">
              <span class="navbar-text text-white">Olá, {{ Auth::user()->name }}</span>
            </li>
            <!-- Botão de Logout -->
            <li class="nav-item">
              <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="btn btn-outline-light ms-2">Logout</button>
              </form>
            </li>
          </ul>
    </div>
  </div>
</nav>
<div class="container mt-4">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @yield('content')
</div>

@stack('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>