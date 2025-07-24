<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PeminjamanRuangan extends Model
{
    protected $table = 'peminjaman_ruangan';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'tanggal_peminjaman',
        'tanggal_berakhir_peminjaman',
        'waktu_peminjaman',
        'waktu_berakhir_peminjaman',
        'kelas_id',
        'prodi_id',
        'keperluan_peminjaman',
    ];

    protected static function booted()
    {
        static::creating(function ($peminjaman) {
            if (!$peminjaman->id) {
                $peminjaman->id = (string) Str::uuid();
            }
        });
    }

    public static function createPeminjamanRuangan($data)
    {
        return self::create([
            'tanggal_peminjaman' => $data['tanggal_peminjaman'],
            'tanggal_berakhir_peminjaman' => $data['tanggal_berakhir_peminjaman'],
            'waktu_peminjaman' => $data['waktu_peminjaman'],
            'waktu_berakhir_peminjaman' => $data['waktu_berakhir_peminjaman'],
            'kelas_id' => $data['kelas_id'],
            'prodi_id' => $data['prodi_id'],
            'keperluan_peminjaman' => $data['keperluan_peminjaman'],
        ]);
    }

    public function updatePeminjamanRuangan($data)
    {
        return $this->update([
            'tanggal_peminjaman' => $data['tanggal_peminjaman'] ?? $this->tanggal_peminjaman,
            'tanggal_berakhir_peminjaman' => $data['tanggal_berakhir_peminjaman'] ?? $this->tanggal_berakhir_peminjaman,
            'waktu_peminjaman' => $data['waktu_peminjaman'] ?? $this->waktu_peminjaman,
            'waktu_berakhir_peminjaman' => $data['waktu_berakhir_peminjaman'] ?? $this->waktu_berakhir_peminjaman,
            'kelas_id' => $data['kelas_id'] ?? $this->kelas_id,
            'prodi_id' => $data['prodi_id'] ?? $this->prodi_id,
            'keperluan_peminjaman' => $data['keperluan_peminjaman'] ?? $this->keperluan_peminjaman,
        ]);
    }

    public function deletePeminjamanRuangan()
    {
        return $this->delete();
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi_id');
    }
}
