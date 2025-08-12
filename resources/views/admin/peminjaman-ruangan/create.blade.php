<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Peminjaman Ruangan</title>
    <link rel="icon" type="image/png" href="{{ asset('image/itats-1080.jpg') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        @include('include.navbarSistem')
        @include('include.sidebar')

        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Tambah Data Peminjaman Ruangan</h1>
                        </div>
                    </div>
                </div>
            </div>

            <section class="content">
                <div class="container-fluid">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-plus-circle"></i> Form Tambah Data Peminjaman Ruangan</h3>
                        </div>
                        <div class="card-body">
                            @if(session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif
                            <form action="{{ route('admin.peminjaman-ruangan.store') }}" method="POST">
                                @csrf

                                <div class="row">
                                    <!-- Kolom Kiri -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tanggal_peminjaman">Tanggal Peminjaman Ruangan</label>
                                            <input type="date" class="form-control @error('tanggal_peminjaman') is-invalid @enderror" name="tanggal_peminjaman" value="{{ old('tanggal_peminjaman') }}" required>
                                            @error('tanggal_peminjaman')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="tanggal_berakhir_peminjaman">Tanggal Berakhir Peminjaman Ruangan</label>
                                            <input type="date" class="form-control @error('tanggal_berakhir_peminjaman') is-invalid @enderror" name="tanggal_berakhir_peminjaman" value="{{ old('tanggal_berakhir_peminjaman') }}" required>
                                            @error('tanggal_berakhir_peminjaman')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="kelas_id">Ruang Kelas</label>
                                            <select name="kelas_id" id="kelas_id" class="form-control @error('kelas_id') is-invalid @enderror" required>
                                                <option value="">-- Pilih Ruangan --</option>
                                                @foreach($kelass as $kelas)
                                                    <option value="{{ $kelas->id }}" {{ old('kelas_id') == $kelas->id ? 'selected' : '' }}>
                                                        {{ $kelas->nama_kelas }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('kelas_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="prodi_id">Program Studi</label>
                                            <select name="prodi_id" id="prodi_id" class="form-control @error('prodi_id') is-invalid @enderror" required>
                                                <option value="">-- Pilih Program Studi --</option>
                                                @foreach($prodis as $prodi)
                                                    <option value="{{ $prodi->id }}" {{ old('prodi_id', optional($peminjaman ?? null)) == $prodi->id ? 'selected' : '' }}>
                                                        {{ $prodi->kode_prodi ?? '--' }} | {{ strtoupper($prodi->nama_prodi) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('prodi_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Kolom Kanan -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="keperluan_peminjaman">Keperluan Peminjaman</label>
                                            <textarea class="form-control @error('keperluan_peminjaman') is-invalid @enderror" name="keperluan_peminjaman" required>{{ old('keperluan_peminjaman') }}</textarea>
                                            @error('keperluan_peminjaman')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="waktu_peminjaman">Waktu Peminjaman</label>
                                            <input type="time" class="form-control @error('waktu_peminjaman') is-invalid @enderror" name="waktu_peminjaman" value="{{ old('waktu_peminjaman') }}" required>
                                            @error('waktu_peminjaman')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="waktu_berakhir_peminjaman">Waktu Berakhir Peminjaman</label>
                                            <input type="time" class="form-control @error('waktu_berakhir_peminjaman') is-invalid @enderror" name="waktu_berakhir_peminjaman" value="{{ old('waktu_berakhir_peminjaman') }}" required>
                                            @error('waktu_berakhir_peminjaman')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                                <a href="{{ route('admin.peminjaman-ruangan.index') }}" class="btn btn-secondary">Batal</a>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        @include('include.footerSistem')
    </div>

    @include('services.LogoutModal')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
</body>
</html>
