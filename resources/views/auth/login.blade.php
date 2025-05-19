<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akademik WR 1 - Login</title>
    <link rel="icon" type="image/png" href="{{ asset('image/itats-1080.jpg') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            padding: 0;
        }

        .bg-image {
            background-size: cover;
            background-position: center;
        }

        .card-custom {
            backdrop-filter: blur(5px);
            background-color: rgba(0, 0, 0, 0.6);
            color: white;
            max-width: 400px;
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.8);
        }

        .card-custom .form-control {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .card-custom .form-control::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        .card-custom .form-control:focus {
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
        }

        .invalid-feedback {
            font-size: 0.875rem;
        }
    </style>
</head>
<body>

    {{-- Background --}}
    <div class="bg-image d-flex align-items-center justify-content-center min-vh-100"
         style="background-image: url('{{ asset('image/gedungA.jpg') }}');">

        {{-- Form Card --}}
        <div class="card card-custom w-100">
            <div class="card-body p-4">

                {{-- Logo --}}
                <div class="text-center mb-3">
                    <img src="{{ asset('image/itats-biru.png') }}" alt="Logo ITATS" class="img-fluid" style="max-height: 40px;">
                </div>

                {{-- Judul --}}
                <h4 class="text-center text-warning mb-3">Login Admin WR 1</h4>
                <p class="text-center text-light mb-4">Masuk untuk kelola manajemen lingkup WR 1</p>

                {{-- Error flash --}}
                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                {{-- Form --}}
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="username" class="form-label text-white">Username</label>
                        <input type="text"
                               class="form-control @error('username') is-invalid @enderror"
                               id="username"
                               name="username"
                               required
                               autofocus
                               placeholder="Masukkan username"
                               value="{{ old('username') }}">
                        @error('username')
                            <div class="invalid-feedback d-block text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label text-white">Password</label>
                        <input type="password"
                               class="form-control @error('password') is-invalid @enderror"
                               id="password"
                               name="password"
                               required
                               placeholder="Masukkan password">
                        @error('password')
                            <div class="invalid-feedback d-block text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-warning text-dark">Masuk</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Bootstrap JS --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            @if (session('success') || session('error'))
                $('#toastNotification').toast({
                    delay: 3000,
                    autohide: true
                }).toast('show');
            @endif
        });
    </script>
</body>
</html>
