<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login | Akademik WR 1</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('image/itats-1080.jpg') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/icheck-bootstrap@3.0.1/icheck-bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
    <style>
        .background-overlay {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 100vw;
            background: url('{{ asset('image/gedungA.jpg') }}') no-repeat center center fixed;
            background-size: cover;
            z-index: 0;
        }

        .background-overlay::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            background-color: rgba(0, 0, 0, 0.6); /* Ini yang membuatnya lebih gelap */
        }

        .login-box {
            position: relative;
            z-index: 1;
        }
    </style>
</head>
<body class="hold-transition login-page">

    {{-- Overlay background --}}
    <div class="background-overlay"></div>

    <div class="login-box">
        {{-- Card --}}
        <div class="card">
            <div class="card-body login-card-body">

                {{-- Logo di dalam card --}}
                <div class="text-center mb-3">
                    <a href="#">
                        <img src="{{ asset('image/itats-biru.png') }}" alt="Logo ITATS" style="height: 40px;">
                    </a>
                </div>

                <h4 class="login-box-msg text-warning">Login Admin WR 1</h4>
                <p class="text-center text-muted mb-4">Masuk untuk kelola manajemen lingkup WR 1</p>

                {{-- Flash error --}}
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                {{-- Validation error --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>{{ $errors->first() }}</strong>
                    </div>
                @endif

                {{-- Form login --}}
                <form action="{{ route('login') }}" method="POST">
                    @csrf

                    {{-- Username --}}
                    <div class="input-group mb-3">
                        <input type="text" name="username" class="form-control @error('username') is-invalid @enderror"
                               placeholder="Username" value="{{ old('username') }}" required autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        @error('username')
                            <div class="invalid-feedback d-block text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                               placeholder="Password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        @error('password')
                            <div class="invalid-feedback d-block text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Tombol login --}}
                    <div class="row">
                        <div class="col-8"></div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-warning btn-block text-dark">Masuk</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

    {{-- Script --}}
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
</body>
</html>
