<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Kelas extends Model
{
    protected $table = 'kelas';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'gedung_id',
        'nama_kelas',
        'kapasitas_mahasiswa',
        'keterangan',
        'kelas_status',
    ];

    protected static function booted()
    {
        static::creating(function ($kelas) {
            if (!$kelas->id) {
                $kelas->id = (string) Str::uuid();
            }
        });
    }

    public static function createKelas($data)
    {
        return self::create([
            'gedung_id' => $data['gedung_id'],
            'nama_kelas' => $data['nama_kelas'],
            'kapasitas_mahasiswa' => $data['kapasitas_mahasiswa'],
            'keterangan' => $data['keterangan'] ?? '',
            'kelas_status' => $data['kelas_status'] ?? true,
        ]);
    }

    public function updateKelas($data)
    {
        $this->update([
            'gedung_id' => $data['gedung_id'] ?? $this->gedung_id,
            'nama_kelas' => $data['nama_kelas'] ?? $this->nama_kelas,
            'kapasitas_mahasiswa' => $data['kapasitas_mahasiswa'] ?? $this->kapasitas_mahasiswa,
            'keterangan' => array_key_exists('keterangan', $data) ? $data['keterangan'] : $this->keterangan,
            'kelas_status' => $data['kelas_status'] ?? $this->kelas_status,
        ]);
    }

    public function deleteKelas()
    {
        return $this->delete();
    }

    public function gedung()
    {
        return $this->belongsTo(Gedung::class, 'gedung_id');
    }

    public function toggleStatus()
    {
        $this->kelas_status = !$this->kelas_status;
        $this->save();
    }
}
