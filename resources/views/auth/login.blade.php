<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEJ3QkR7zFJ8L3TpU5a1V0g1vK0pFqJ58Lh9XQJxeiDBjF+dV7K7vP2ePNTvK" crossorigin="anonymous">
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
</head>

<body>
    
    <div class="container">
        <div class="login-container">
            <!-- Exibir mensagens de sucesso -->
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Exibir mensagens de erro -->
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <img src="{{ asset('images/logo-branco.png') }}" alt="Logo" class="logo">
            <h3>Login</h3>
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <!-- Email Input -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password Input -->
                <div class="mb-3">
                    <label for="password" class="form-label">Senha</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                    @error('password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Login Button -->
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-custom btn-lg">Entrar</button>
                </div>
            </form>
            <div class="text-center mt-3">
                <p><a href="{{ route('register') }}">Cadastre-se</a></p>
            </div>

            <!-- Footer -->
            <div class="footer">
                <p>© 2021 Seu Site</p>
            </div>
        </div>
    </div>

    <!-- Optional Bootstrap JS (for features like dropdowns, tooltips) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
