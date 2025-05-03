<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Legalisir;
use League\Csv\Reader;
use League\Csv\Writer;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Throwable;
use Carbon\Carbon;

class LegalisirController extends Controller
{
    public function index()
    {
        $legalisirs = Legalisir::orderBy('created_at', 'asc')->get();
        return view('legalisir.index', compact('legalisirs'));
    }

    public function create()
    {
        return view('legalisir.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'no_legalisir' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'npm' => 'required|string|max:255',
            'jumlah_ijazah' => 'nullable|string|max:255',
            'jumlah_transkip' => 'nullable|string|max:255',
            'jumlah_lain' => 'nullable|string|max:255',
            'jumlah_total' => 'nullable|string|max:255',
        ]);

        Legalisir::createLegalisir($request->all());

        return redirect()->route('legalisir.index')->with('success', 'Data legalisir berhasil ditambahkan.');
    }

    public function show(Legalisir $legalisir)
    {
        return view('legalisir.show', compact('legalisir'));
    }

    public function edit(Legalisir $legalisir)
    {
        return view('legalisir.edit', compact('legalisir'));
    }

    public function update(Request $request, Legalisir $legalisir)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'no_legalisir' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'npm' => 'required|string|max:255',
            'jumlah_ijazah' => 'nullable|string|max:255',
            'jumlah_transkip' => 'nullable|string|max:255',
            'jumlah_lain' => 'nullable|string|max:255',
            'jumlah_total' => 'nullable|string|max:255',
        ]);

        $legalisir->updateLegalisir($request->all());

        return redirect()->route('legalisir.index')->with('success', 'Data legalisir berhasil diperbarui.');
    }

    public function destroy(Legalisir $legalisir)
    {
        $legalisir->deleteLegalisir();

        return redirect()->route('legalisir.index')->with('success', 'Data legalisir berhasil dihapus.');
    }

    public function exportCsv()
    {
        $legalisirs = Legalisir::all();

        return response()->streamDownload(function () use ($legalisirs) {
            $stream = fopen('php://output', 'w');
            // Header
            fputcsv($stream, [
                'tanggal', 'no_legalisir', 'nama', 'npm',
                'jumlah_ijazah', 'jumlah_transkip', 'jumlah_lain', 'jumlah_total'
            ], ';');

            foreach ($legalisirs as $row) {
                fputcsv($stream, [
                    $row->tanggal,
                    $row->no_legalisir,
                    $row->nama,
                    $row->npm,
                    $row->jumlah_ijazah,
                    $row->jumlah_transkip,
                    $row->jumlah_lain,
                    $row->jumlah_total,
                ], ';');
            }

            fclose($stream);
        }, 'data_legalisir.csv', [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="data_legalisir.csv"',
        ]);
    }

    public function importCsv(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt',
        ]);

        try {
            $csv = Reader::createFromPath($request->file('csv_file')->getRealPath(), 'r');
            $csv->setDelimiter(';');
            $csv->setHeaderOffset(0);

            $records = $csv->getRecords();

            $data = [];
            $failed = [];

            foreach ($records as $index => $record) {
                // Konversi format tanggal dari d/m/Y ke Y-m-d
                try {
                    $record['tanggal'] = Carbon::createFromFormat('d/m/Y', $record['tanggal'])->format('Y-m-d');
                } catch (\Exception $e) {
                    $failed[] = $index + 1;
                    continue;
                }

                $validator = Validator::make($record, [
                    'tanggal' => 'required|date',
                    'no_legalisir' => 'required|string|max:255',
                    'nama' => 'required|string|max:255',
                    'npm' => 'required|string|max:255',
                    'jumlah_ijazah' => 'nullable|integer',
                    'jumlah_transkip' => 'nullable|integer',
                    'jumlah_lain' => 'nullable|integer',
                    'jumlah_total' => 'nullable|integer',
                ]);

                if ($validator->fails()) {
                    $failed[] = $index + 1;
                    continue;
                }

                $data[] = $record;
            }

            if (!empty($failed)) {
                return redirect()->back()->with('error', 'Baris gagal divalidasi: ' . implode(', ', $failed));
            }

            return view('legalisir.showDataUpload', compact('data'));

        } catch (Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengimpor file.');
        }
    }

    public function importConfirm(Request $request)
    {
        $decoded = unserialize(base64_decode($request->input('data')));

        foreach ($decoded as $item) {
            Legalisir::create([
                'tanggal' => $item['tanggal'],
                'no_legalisir' => $item['no_legalisir'],
                'nama' => $item['nama'],
                'npm' => $item['npm'],
                'jumlah_ijazah' => $item['jumlah_ijazah'] ?? null,
                'jumlah_transkip' => $item['jumlah_transkip'] ?? null,
                'jumlah_lain' => $item['jumlah_lain'] ?? null,
                'jumlah_total' => $item['jumlah_total'],
            ]);
        }

        return redirect()->route('legalisir.index')->with('success', 'Data berhasil diimport!');
    }
}
