<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Data Cuti</title>
    <link rel="icon" href="{{ asset('assets/itats-icon.jpg') }}">
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
                            <h1 class="m-0">Ubah Data Cuti Mahasiswa</h1>
                        </div>
                    </div>
                </div>
            </div>

            <section class="content">
                <div class="container-fluid">
                    <div class="card card-warning">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-edit"></i> Form Ubah Data Cuti</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('mahasiswa-cuti.update', $mahasiswa->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <!-- Kolom Kiri -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nomor_surat">No. Surat Cuti</label>
                                            <input type="text" class="form-control" name="nomor_cuti" value="{{ old('nomor_cuti', $mahasiswa->nomor_cuti) }}" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="nama_mahasiswa">Nama Mahasiswa</label>
                                            <input type="text" class="form-control" name="nama_mahasiswa" value="{{ old('nama_mahasiswa', $mahasiswa->nama_mahasiswa) }}" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="npm">NPM</label>
                                            <input type="text" class="form-control" name="npm" value="{{ old('npm', $mahasiswa->npm) }}" required>
                                        </div>
                                    </div>

                                    <!-- Kolom Kanan -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="prodi_id">Asal Program Studi</label>
                                            <select name="prodi_id" class="form-control" required>
                                                <option value="">-- Pilih Program Studi --</option>
                                                @foreach($prodis as $prodi)
                                                    <option value="{{ $prodi->id }}" {{ old('prodi_id', $mahasiswa->prodi_id) == $prodi->id ? 'selected' : '' }}>
                                                        {{ $prodi->nama_prodi }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="periode_id">Periode Cuti</label>
                                            <select name="periode_id" class="form-control" required>
                                                <option value="">-- Pilih Periode --</option>
                                                @foreach($periodes as $periode)
                                                    <option value="{{ $periode->id }}" {{ old('periode_id', $mahasiswa->periode_id) == $periode->id ? 'selected' : '' }}>
                                                        {{ $periode->nama_periode }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>


                                        <div class="form-group">
                                            <label for="surat_status">Status Cuti Mahasiswa</label>
                                            <select name="surat_status" class="form-control" required>
                                                <option value="">-- Pilih Status --</option>
                                                <option value="1" {{ old('surat_status', $mahasiswa->surat_status) == 1 ? 'selected' : '' }}>Aktif</option>
                                                <option value="0" {{ old('surat_status', $mahasiswa->surat_status) == 0 ? 'selected' : '' }}>Tidak Aktif</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="keterangan">Keterangan</label>
                                    <textarea name="keterangan" class="form-control @error('keterangan') is-invalid @enderror" rows="3" placeholder="Contoh: Mahasiswa mengajukan cuti karena alasan kesehatan atau keluarga.">{{ old('keterangan', $mahasiswa->keterangan) }}</textarea>
                                    @error('keterangan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Tombol Simpan -->
                                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan Perubahan</button>
                                <a href="{{ route('mahasiswa-cuti.index') }}" class="btn btn-secondary">Batal</a>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        @include('include.footerSistem')
    </div>

    @include('services.logoutModal')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
    <script>
        $(document).ready(function () {
            $('[data-widget="treeview"]').Treeview('init');
        });
    </script>
</body>
</html>
