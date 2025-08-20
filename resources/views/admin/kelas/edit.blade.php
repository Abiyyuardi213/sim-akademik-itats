<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Data Kelas</title>
    <link rel="icon" type="image/png" href="{{ asset('image/itats-1080.jpg') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css"/>
    <style>
        #preview-img {
            max-width: 100%;
            max-height: 300px;
            display: block;
            margin-top: 10px;
            border: 1px solid #ccc;
        }
    </style>
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
                            <h1 class="m-0">Ubah Data Ruang Kelas</h1>
                        </div>
                    </div>
                </div>
            </div>

            <section class="content">
                <div class="container-fluid">
                    <div class="card card-warning">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-edit"></i> Form Ubah Data Ruang Kelas</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.kelas.update', $kelas->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <!-- Kolom Kiri -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="gedung_id">Gedung</label>
                                            <select name="gedung_id" id="gedung_id" class="form-control @error('gedung_id') is-invalid @enderror">
                                                <option value="">-- Pilih Gedung --</option>
                                                @foreach($gedungs as $gedung)
                                                    <option value="{{ $gedung->id }}" {{ old('gedung_id', $kelas->gedung_id) == $gedung->id ? 'selected' : '' }}>
                                                        {{ $gedung->nama_gedung }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('gedung_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="nama_kelas">Nama Ruang Kelas</label>
                                            <input type="text" class="form-control @error('nama_kelas') is-invalid @enderror" name="nama_kelas" value="{{ old('nama_kelas', $kelas->nama_kelas) }}" required>
                                            @error('nama_kelas')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="keterangan">Keterangan</label>
                                            <textarea class="form-control @error('keterangan') is-invalid @enderror" name="keterangan">{{ old('keterangan', $kelas->keterangan) }}</textarea>
                                            @error('keterangan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Kolom Kanan -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="kapasitas_mahasiswa">Kapasitas Ruang Kelas</label>
                                            <input type="number" class="form-control @error('kapasitas_mahasiswa') is-invalid @enderror" name="kapasitas_mahasiswa" value="{{ old('kapasitas_mahasiswa', $kelas->kapasitas_mahasiswa) }}" required>
                                            @error('kapasitas_mahasiswa')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="kelas_status">Status</label>
                                            <select class="form-control @error('kelas_status') is-invalid @enderror" name="kelas_status">
                                                <option value="1" {{ old('kelas_status', $kelas->kelas_status) == 1 ? 'selected' : '' }}>Siap Digunakan</option>
                                                <option value="0" {{ old('kelas_status', $kelas->kelas_status) == 0 ? 'selected' : '' }}>Maintenance</option>
                                            </select>
                                            @error('kelas_status')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="gambar">Unggah / Ubah Gambar Kelas (opsional)</label>
                                            <input type="file" class="form-control @error('gambar') is-invalid @enderror" id="gambar" name="gambar" accept="image/*">
                                            @error('gambar')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror

                                            <!-- Preview Gambar (menampilkan gambar lama jika ada) -->
                                            <img id="preview-img" src="{{ $kelas->gambar ? asset('storage/'.$kelas->gambar) : '#' }}" alt="Preview Gambar" style="{{ $kelas->gambar ? '' : 'display:none;' }}">
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan Perubahan</button>
                                <a href="{{ route('admin.kelas.index') }}" class="btn btn-secondary">Batal</a>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
    <script>
        $(document).ready(function () {
            $('[data-widget="treeview"]').Treeview('init');
        });

        let cropper;
        const gambarInput = document.getElementById('gambar');
        const previewImg = document.getElementById('preview-img');

        window.addEventListener('DOMContentLoaded', () => {
            if (previewImg.src && previewImg.style.display !== 'none') {
                cropper = new Cropper(previewImg, {
                    aspectRatio: 16 / 9,
                    viewMode: 1,
                    movable: true,
                    zoomable: true,
                    rotatable: true,
                    scalable: true,
                });
            }
        });

        gambarInput.addEventListener('change', function(e) {
            const files = e.target.files;
            if (files && files.length > 0) {
                const file = files[0];
                const reader = new FileReader();
                reader.onload = function(event) {
                    previewImg.src = event.target.result;
                    previewImg.style.display = 'block';

                    if (cropper) cropper.destroy();

                    cropper = new Cropper(previewImg, {
                        aspectRatio: 16 / 9,
                        viewMode: 1,
                        movable: true,
                        zoomable: true,
                        rotatable: true,
                        scalable: true,
                    });
                }
                reader.readAsDataURL(file);
            }
        });

        const form = document.querySelector('form');
        form.addEventListener('submit', function(e) {
            if (cropper) {
                e.preventDefault();
                cropper.getCroppedCanvas().toBlob((blob) => {
                    const fileInput = new File([blob], gambarInput.files[0].name, { type: 'image/png' });
                    const dataTransfer = new DataTransfer();
                    dataTransfer.items.add(fileInput);
                    gambarInput.files = dataTransfer.files;

                    form.submit();
                }, 'image/png', 0.9);
            }
        });
    </script>
</body>
</html>
