<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <style>
        @page {
            margin: 0cm; /* hilangkan margin default dompdf */
        }
        body {
            margin: 0;
            padding: 0;
            font-family: "Times New Roman", Times, serif;
            font-size: 15px;
            line-height: 1.5;
        }
        .kop {
            width: 100%;
            margin: 0;
            padding: 0;
            page-break-inside: avoid;
        }
        .kop img {
            display: block;
            width: 100%;
            height: auto;
            margin: 0;
            padding: 0;
        }

        .content {
            margin-left: 2.5cm;
            margin-right: 2.5cm;
            page-break-inside: avoid;
        }
        .indent {
            text-indent: 30px;
            text-align: justify;
        }
        .table-info td {
            padding: 2px 8px;
            vertical-align: top;
        }
        .ttd {
            margin-left: 2.5cm;
            margin-right: 2.5cm;
            margin-top: 30px;
            text-align: right;
            page-break-inside: avoid;
        }
        .tembusan {
            margin-left: 2.5cm;
            margin-right: 2.5cm;
            margin-top: 20px;
            page-break-inside: avoid;
        }
        ol {
            padding-left: 20px;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="kop">
        @php
        $path = public_path('image/header-itats.png');
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        @endphp
        <img src="{{ $base64 }}" alt="Header ITATS" style="width:100%; display:block; margin:0; padding:0;">
    </div>
    <div class="content">
        <table style="margin-bottom: 15px;">
            @php
                $bulanRomawi = [
                    1 => 'I',
                    2 => 'II',
                    3 => 'III',
                    4 => 'IV',
                    5 => 'V',
                    6 => 'VI',
                    7 => 'VII',
                    8 => 'VIII',
                    9 => 'IX',
                    10 => 'X',
                    11 => 'XI',
                    12 => 'XII',
                ];
                $bulanSekarang = $bulanRomawi[now()->format('n')];
            @endphp

            <tr>
                <td style="width: 60px;">No.</td>
                <td>
                    : {{ $pengajuan->nomor_surat
                        ?? '___ / '
                        . strtoupper($pengajuan->prodi->alias_prodi)
                        . ' / ITATS / ' . $bulanSekarang
                        . ' / ' . now()->year }}
                </td>
            </tr>
            <tr>
                <td>Lampiran</td>
                <td>: -</td>
            </tr>
            <tr>
                <td>Hal</td>
                <td>: Permohonan Peminjaman Ruang</td>
            </tr>
        </table>

        <p>Kepada Yth.<br>
        Wakil Rektor Bidang Akademik<br>
        di - Tempat</p>

        <p class="indent">
            Dengan hormat,<br>
            Sehubungan dengan diadakannya kegiatan {{ $pengajuan->keperluan_peminjaman }} oleh Divisi/Prodi
            {{ $pengajuan->prodi->nama_prodi }} maka bersama dengan ini kami mengajukan peminjaman ruangan
            {{ $pengajuan->kelas->nama_kelas }}. Adapun informasi dari kegiatan tersebut yakni sebagai berikut:
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
        <p><b>Tembusan:</b></p>
        <ol>
            <li>Arsip</li>
            <li>Security</li>
        </ol>
    </div>
</body>
</html>
