<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class MahasiswaCuti extends Model
{
    protected $table = 'mahasiswa_cuti';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'nama_mahasiswa',
        'npm',
        'prodi_id',
        'periode_id',
        'nomor_cuti',
        'keterangan',
        'surat_status',
    ];

    protected static function booted()
    {
        static::creating(function ($mahasiswa) {
            if (!$mahasiswa->id) {
                $mahasiswa->id = (string) Str::uuid();
            }
        });
    }

    public static function createMahasiswaCuti($data)
    {
        return self::create([
            'nama_mahasiswa' => $data['nama_mahasiswa'],
            'npm' => $data['npm'],
            'prodi_id' => $data['prodi_id'],
            'periode_id' => $data['periode_id'],
            'nomor_cuti' => $data['nomor_cuti'],
            'keterangan' => $data['keterangan'],
            'surat_status' => $data['surat_status'],
        ]);
    }

    public function updateMahasiswaCuti($data)
    {
        return $this->update([
            'nama_mahasiswa' => $data['nama_mahasiswa'] ?? $this->nama_mahasiswa,
            'npm' => $data['npm'] ?? $this->npm,
            'prodi_id' => $data['prodi_id'] ?? $this->prodi_id,
            'periode_id' => $data['periode_id'] ?? $this->periode_id,
            'nomor_cuti' => $data['nomor_cuti'] ?? $this->nomor_cuti,
            'keterangan' => $data['keterangan'] ?? $this->keterangan,
            'surat_status' => $data['surat_status'] ?? $this->surat_status,
        ]);
    }

    public function deleteMahasiswaCuti()
    {
        return $this->delete();
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi_id');
    }

    public function periode()
{
    return $this->belongsTo(PeriodeCuti::class, 'periode_id');
}
}
