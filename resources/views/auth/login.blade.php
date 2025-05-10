<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akademik WR 1 - Login</title>
    <link rel="icon" type="image/png" href="{{ asset('image/itats-1080.jpg') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        body {
            position: relative;
            min-height: 100vh;
            margin: 0;
            background: url('{{ asset('image/gedungA.jpg') }}') center/cover no-repeat;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 15px;
            font-family: 'Segoe UI', sans-serif;
        }

        body::before {
            content: "";
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background-color: rgba(0, 0, 0, 0.55);
            z-index: 0;
        }

        .login-box {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 400px;
        }

        .login-card {
            padding: 30px 25px;
            border-radius: 16px;
            background-color: rgba(255, 255, 255, 0.97);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.3);
            animation: fadeIn 0.6s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .login-logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .login-logo img {
            width: 170px;
        }

        .input-group-text {
            background-color: #f0f0f0;
        }

        .btn-primary {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .btn-primary:hover {
            background-color: #003f8a;
            border-color: #003f8a;
        }

        .text-small {
            font-size: 0.85rem;
        }

        .alert-danger {
            font-size: 0.875rem;
        }

        @media (max-width: 576px) {
            .login-logo img {
                width: 80px;
            }
        }
    </style>
</head>
<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-card">
            <div class="login-logo">
                <img src="{{ asset('image/itats-biru.png') }}" alt="Logo">
            </div>
            <h4 class="text-center font-weight-bold mb-3">Login Admin WR 1</h4>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="username" placeholder="Username" required autofocus>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <i class="fas fa-user"></i>
                        </div>
                    </div>
                </div>

                <div class="input-group mb-3">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                    <div class="input-group-append">
                        <div class="input-group-text" onclick="togglePassword()" style="cursor: pointer;">
                            <i id="eyeIcon" class="fas fa-eye"></i>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-block" id="loginBtn">
                    <span id="loginSpinner" class="spinner-border spinner-border-sm mr-2 d-none" role="status" aria-hidden="true"></span>
                    <span id="loginText">Masuk</span>
                </button>

                <div class="text-center mt-3 text-small">
                    {{-- <a href="{{ route('password.request') }}">Lupa password?</a> <br> --}}
                    {{-- <a href="{{ route('home') }}">← Kembali ke Beranda</a> --}}
                </div>
            </form>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordField = document.getElementById("password");
            const eyeIcon = document.getElementById("eyeIcon");

            if (passwordField.type === "password") {
                passwordField.type = "text";
                eyeIcon.classList.replace("fa-eye", "fa-eye-slash");
            } else {
                passwordField.type = "password";
                eyeIcon.classList.replace("fa-eye-slash", "fa-eye");
            }
        }

        document.querySelector("form").addEventListener("submit", function () {
            const loginBtn = document.getElementById("loginBtn");
            const spinner = document.getElementById("loginSpinner");
            const loginText = document.getElementById("loginText");

            loginBtn.disabled = true;
            spinner.classList.remove("d-none");
            loginText.textContent = "Loading...";
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
    {{-- <script src="{{ asset('resources/js/ToastScript.js') }}"></script> --}}
</body>
</html>
