<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pengguna - Sistem Peminjaman Ruangan</title>
    <link rel="icon" type="image/png" href="{{ asset('image/itats-1080.jpg') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Source Sans Pro', sans-serif !important;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
        }
        .hero-section {
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
            color: white;
            padding: 80px 0;
        }
        .profile-sidebar {
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
            color: white;
            padding: 40px 30px;
            text-align: center;
            border-radius: 20px;
        }
        .profile-picture {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
            border: 4px solid rgba(255,255,255,0.3);
            margin-bottom: 20px;
        }
        .form-label {
            font-weight: 600;
            margin-bottom: 8px;
        }
        .form-control {
            border-radius: 10px;
            padding: 10px 14px;
        }
        .btn-primary {
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
            border: none;
            border-radius: 10px;
            padding: 12px 28px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #0056b3 0%, #004494 100%);
            transform: scale(1.05);
            box-shadow: 0 6px 15px rgba(0, 91, 187, 0.4);
        }
    </style>
</head>
<body>
    @include('include.navbarUser')

    <section class="hero-section text-center">
        <div class="container">
            <h1 class="fw-bold">Profil Pengguna</h1>
            <p class="lead">Kelola informasi akun Anda dengan mudah</p>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center g-4">
                <!-- Sidebar -->
                <div class="col-lg-4">
                    <div class="profile-sidebar">
                        <img src="{{ $user->profile_picture ? asset('uploads/profile/'.$user->profile_picture) : asset('image/default.png') }}"
                             alt="Foto Profil" class="profile-picture">
                        <h4 class="fw-bold">{{ $user->name }}</h4>
                        <p class="opacity-75 mb-2">{{ $user->role->nama_role ?? 'User' }}</p>
                        <p class="mb-1"><i class="fas fa-envelope me-2"></i>{{ $user->email }}</p>
                        <p><i class="fas fa-phone me-2"></i>{{ $user->no_telepon ?? 'Belum diisi' }}</p>
                    </div>
                </div>

                <!-- Form -->
                <div class="col-lg-8">
                    <h3 class="fw-bold mb-3">Edit Profil</h3>
                    <form action="{{ route('users.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                       class="form-control @error('name') is-invalid @enderror">
                                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Username</label>
                                <input type="text" name="username" value="{{ old('username', $user->username) }}"
                                       class="form-control @error('username') is-invalid @enderror">
                                @error('username') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                       class="form-control @error('email') is-invalid @enderror">
                                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">No. Telepon</label>
                                <input type="text" name="no_telepon" value="{{ old('no_telepon', $user->no_telepon) }}"
                                       class="form-control @error('no_telepon') is-invalid @enderror">
                                @error('no_telepon') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password Baru</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                            <small class="text-muted">Kosongkan jika tidak ingin mengubah password</small>
                            @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Foto Profil</label>
                            <input type="file" name="profile_picture" class="form-control @error('profile_picture') is-invalid @enderror">
                            <small class="text-muted">Format: JPG, PNG. Maksimal 2MB</small>
                            @error('profile_picture') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i> Simpan Perubahan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    @include('include.footerUser')
    @include('services.LogoutModalUser')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
