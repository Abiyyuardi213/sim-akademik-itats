<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MahasiswaCuti;
use App\Models\PeriodeCuti;
use App\Models\Prodi;
use League\Csv\Writer;
use League\Csv\Reader;
use Illuminate\Support\Facades\Response;

class MahasiswaCutiController extends Controller
{
    public function index()
    {
        $mahasiswas = MahasiswaCuti::orderBy('created_at', 'asc')->with('prodi')->get();
        return view('mahasiswa-cuti.mahasiswaList', compact('mahasiswas'));
    }

    public function create()
    {
        $prodis = Prodi::all();
        $periodes = PeriodeCuti::all();
        return view('mahasiswa-cuti.create', compact('prodis', 'periodes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_mahasiswa' => 'required|string|max:255',
            'npm' => 'required|string|max:255|unique:mahasiswa_cuti,npm',
            'prodi_id' => 'required|exists:prodi,id',
            'periode_id' => 'required|exists:periode_cuti,id',
            'nomor_cuti' => 'required|string|max:255|unique:mahasiswa_cuti,nomor_cuti',
            'keterangan' => 'nullable|string|max:255',
            'surat_status' => 'required|boolean',
        ]);

        $data = $request->all();

        MahasiswaCuti::createMahasiswaCuti($data);

        return redirect()->route('mahasiswa-cuti.index')->with('success', 'Data mahasiswa cuti berhasil ditambahkan');
    }

    public function edit($id)
    {
        $mahasiswa = MahasiswaCuti::findOrFail($id);
        $prodis = Prodi::all();
        $periodes = PeriodeCuti::all();
        return view('mahasiswa-cuti.edit', compact('mahasiswa', 'prodis', 'periodes'));
    }

    public function update(Request $request, $id)
    {
        $mahasiswa = MahasiswaCuti::findOrFail($id);

        $request->validate([
            'nama_mahasiswa' => 'required|string|max:255',
            'npm' => 'required|string|max:255|unique:mahasiswa_cuti,npm,' . $mahasiswa->id,
            'prodi_id' => 'required|exists:prodi,id',
            'periode_id' => 'required|exists:periode_cuti,id',
            'nomor_cuti' => 'required|string|max:255|unique:mahasiswa_cuti,nomor_cuti,' . $mahasiswa->id,
            'keterangan' => 'nullable|string|max:255',
            'surat_status' => 'required|boolean',
        ]);

        $data = $request->all();
        $mahasiswa->updateMahasiswaCuti($data);

        return redirect()->route('mahasiswa-cuti.index')->with('success', 'Data mahasiswa cuti berhasil diubah');
    }

    public function show($id)
    {
        $mahasiswa = MahasiswaCuti::with(['prodi', 'periode'])->findOrFail($id);
        return view('mahasiswa-cuti.show', compact('mahasiswa'));
    }

    public function destroy($id)
    {
        $mahasiswa = MahasiswaCuti::findOrFail($id);
        $mahasiswa->deleteMahasiswaCuti();

        return redirect()->route('mahasiswa-cuti.index')->with('success', 'Data mahasiswa cuti berhasil di hapus');
    }

    public function exportCsv()
    {
        $mahasiswas = MahasiswaCuti::with('periode')->get();

        return response()->streamDownload(function () use ($mahasiswas) {
            $stream = fopen('php://output', 'w');

            fputcsv($stream, ['ID', 'NAMA_MAHASISWA', 'NPM', 'PRODI_ID', 'PERIODE_ID', 'NOMOR_CUTI', 'KETERANGAN'], ';');

            foreach ($mahasiswas as $mhs) {
                fputcsv($stream, [
                    $mhs->id,
                    $mhs->nama_mahasiswa,
                    $mhs->npm,
                    $mhs->prodi?->id ?? '-',
                    $mhs->periode?->id ?? '-',
                    $mhs->nomor_cuti,
                    $mhs->keterangan,
                ], ';');
            }

            fclose($stream);
        }, 'mahasiswa_cuti.csv', [
            'Content-Type' => 'text/csv',
            'Cache-Control' => 'no-store, no-cache',
        ]);
    }

    public function importCsv(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt',
        ]);

        $file = $request->file('csv_file');

        $csv = Reader::createFromPath($file->getRealPath(), 'r');
        $csv->setDelimiter(';');
        $csv->setHeaderOffset(0);

        $records = $csv->getRecords();

        // Ambil semua data prodi dan periode
        $prodis = Prodi::pluck('nama_prodi', 'id')->toArray();
        $periodes = PeriodeCuti::pluck('nama_periode', 'id')->toArray();

        $data = [];
        foreach ($records as $record) {
            $prodi_id = $record['PRODI_ID'] ?? null;
            $periode_id = $record['PERIODE_ID'] ?? null;

            $data[] = [
                'nama_mahasiswa' => $record['NAMA_MAHASISWA'] ?? '',
                'npm' => $record['NPM'] ?? '',
                'prodi_id' => $prodi_id,
                'prodi_nama' => $prodis[$prodi_id] ?? 'Tidak ditemukan',
                'periode_id' => $periode_id,
                'periode_nama' => $periodes[$periode_id] ?? 'Tidak ditemukan',
                'nomor_cuti' => $record['NOMOR_CUTI'] ?? '',
                'keterangan' => $record['KETERANGAN'] ?? null,
                'surat_status' => 0,
            ];
        }

        return view('mahasiswa-cuti.showDataUpload', ['data' => $data]);
    }

    public function importConfirm(Request $request)
    {
        $decoded = unserialize(base64_decode($request->input('data')));

        foreach ($decoded as $item) {
            MahasiswaCuti::create([
                'nama_mahasiswa' => $item['nama_mahasiswa'],
                'npm' => $item['npm'],
                'prodi_id' => $item['prodi_id'],
                'periode_id' => $item['periode_id'],
                'nomor_cuti' => $item['nomor_cuti'],
                'keterangan' => $item['keterangan'] ?? null,
                'surat_status' => 0,
            ]);
        }

        return redirect()->route('mahasiswa-cuti.index')->with('success', 'Data berhasil diimpor!');
    }
}
