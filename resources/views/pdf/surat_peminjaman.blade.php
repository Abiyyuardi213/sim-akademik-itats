<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }
        .kop {
            width: 100%;
            margin: 0;
            padding: 0;
            border-bottom: 2px solid #000;
        }
        .kop img {
            display: block;
            width: 100%;
            height: auto;
            margin: 0;
            padding: 0;
        }
        .content {
            margin: 0 30px;
        }
        .indent {
            text-indent: 40px;
            text-align: justify;
        }
        .table-info td {
            padding: 2px 8px;
            vertical-align: top;
        }
        .ttd {
            margin-top: 40px;
            text-align: right;
            margin-right: 30px;
        }
        .tembusan {
            margin-top: 50px;
            margin-left: 30px;
        }
    </style>
</head>
<body>
    <div class="kop">
        <img src="{{ public_path('image/header-itats.png') }}"
            alt="Header ITATS"
            style="width: 100%; height: auto;">
    </div>

    <div class="content">
        <table style="margin-bottom: 15px;">
            <tr>
                <td style="width: 60px;">No.</td>
                <td>: {{ $pengajuan->nomor_surat ?? '___ / ' . strtoupper($pengajuan->prodi->kode) . ' / ITATS / ' . now()->format('m') . ' / ' . now()->year }}</td>
            </tr>
            <tr>
                <td>Hal</td>
                <td>: <u>Permohonan Peminjaman Ruang</u></td>
            </tr>
        </table>

        <p>Kepada Yth.<br>
        Wakil Rektor Bidang Akademik<br>
        di - Tempat</p>

        <p class="indent">
            Dengan hormat,<br>
            Terkait dengan {{ $pengajuan->kegiatan }} untuk semester {{ $pengajuan->semester }}
            maka bersama dengan ini kami mengajukan peminjaman ruangan {{ $pengajuan->kelas->nama_kelas }},
            dengan jadwal di bawah ini :
        </p>

        <table class="table-info" style="margin-left: 40px; margin-top: 10px;">
            <tr>
                <td>Hari</td>
                <td>: {{ \Carbon\Carbon::parse($pengajuan->tanggal)->translatedFormat('l') }}</td>
            </tr>
            <tr>
                <td>Waktu</td>
                <td>: {{ \Carbon\Carbon::parse($pengajuan->tanggal)->translatedFormat('d F Y') }}</td>
            </tr>
            <tr>
                <td>Pukul</td>
                <td>: {{ $pengajuan->jam_mulai }} - {{ $pengajuan->jam_selesai }}</td>
            </tr>
            <tr>
                <td>Tempat</td>
                <td>: {{ $pengajuan->kelas->nama_kelas }}</td>
            </tr>
        </table>

        <p class="indent">
            Demikian permohonan kami, atas perhatian sebelum dan sesudahnya diucapkan terima kasih.
        </p>
    </div>

    <div class="ttd">
        <p>Surabaya, {{ now()->translatedFormat('d F Y') }}<br>
        Program Studi {{ $pengajuan->prodi->nama_prodi }}<br>
        Kepala,</p>
        <br><br><br>
        <p><b><u>{{ $pengajuan->prodi->nama_kaprodi }}</u></b><br>
        NIP. {{ $pengajuan->prodi->nip_kaprodi }}</p>
    </div>

    <div class="tembusan">
        <p><b>Tembusan:</b><br>
        1. Arsip</p>
    </div>
</body>
</html>
