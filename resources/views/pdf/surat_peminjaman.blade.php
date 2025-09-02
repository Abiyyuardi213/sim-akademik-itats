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
            font-size: 16px;
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
            text-align: right; /* blok tetap di kanan */
            page-break-inside: avoid;
        }
        .ttd .inner {
            display: inline-block;
            text-align: left; /* isi rata kiri */
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
        .tab1, .tab2 {
            display: block;
            margin: 0;
            line-height: 1.2;
        }
        .tab1 { margin-left: 30px; }
        .tab2 { margin-left: 60px; }
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
                <td style="width: 60px;">Nomor</td>
                <td>
                    : <strong>
                        {{ $pengajuan->nomor_surat
                            ?? '___ / '
                            . strtoupper($pengajuan->prodi->alias_prodi)
                            . ' / ITATS / ' . $bulanSekarang
                            . ' / ' . now()->year }}
                    </strong>
                </td>
            </tr>
            <tr>
                <td>Lampiran</td>
                <td>
                    : <strong>
                        -
                    </strong>
                </td>
            </tr>
            <tr>
                <td>Perihal</td>
                <td>
                    : <strong>
                        Permohonan Peminjaman Ruangan
                    </strong>
                </td>
            </tr>
        </table>

        <p>
            @if ($pengajuan->kelas->nama_kelas === 'A-303 SMART CLASSROOM')
                <span class="tab1">Kepada Yth.</span>
                <span class="tab2"><b>Pimpinan YPTS</b></span>
                <span class="tab2"><b>Melalui Ka Bag Sarana dan Prasarana ITATS SBY</b></span>
                <span class="tab1">di - Tempat</span>
            @else
                <span class="tab1">Kepada Yth.</span><br>
                <span class="tab2">
                    Wakil Rektor Bidang Akademik
                </span><br>
                <span class="tab1">di - Tempat</span>
            @endif
        </p>

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
                <td>: {{ \Carbon\Carbon::parse($pengajuan->waktu_peminjaman)->format('H:i') }} -
                    {{ \Carbon\Carbon::parse($pengajuan->waktu_berakhir_peminjaman)->format('H:i') }}</td>
            </tr>
            <tr>
                <td>Tempat</td>
                <td>: {{ $pengajuan->kelas->nama_kelas }}</td>
            </tr>
        </table>

        <p class="indent">
            Demikian surat permohonan kami buat. Atas perhatiannya, kami sampaikan terima kasih.
        </p>
    </div>

    <div class="ttd">
        <div class="inner">
            <p>
                Surabaya, {{ now()->translatedFormat('d F Y') }}<br>
                Program Studi {{ $pengajuan->prodi->nama_prodi }}<br>
                <b>Kepala,</b>
            </p>
            <br><br><br>
            <p>
                <b><u>{{ $pengajuan->prodi->nama_kaprodi }}</u></b><br>
                NIP. {{ $pengajuan->prodi->nip_kaprodi }}
            </p>
        </div>
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
