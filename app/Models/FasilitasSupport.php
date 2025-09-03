<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class FasilitasSupport extends Model
{
    protected $table = 'fasilitas_support';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'gedung_id',
        'nama_fasilitas',
        'kapasitas',
        'keterangan',
        'gambar',
        'fasilitas_status',
    ];

    protected static function booted()
    {
        static::creating(function ($fasilitas) {
            if (!$fasilitas->id) {
                $fasilitas->id = (string) Str::uuid();
            }
        });
    }

    public static function createFasilitas($data)
    {
        return self::create([
            'gedung_id' => $data['gedung_id'],
            'nama_fasilitas' => $data['nama_fasilitas'],
            'kapasitas' => $data['kapasitas'],
            'keterangan' => $data['keterangan'] ?? '',
            'gambar' => $data['gambar'] ?? null,
            'fasilitas_status' => $data['fasilitas_status'] ?? true,
        ]);
    }

    public function updateFasilitas($data)
    {
        $this->update([
            'gedung_id' => $data['gedung_id'] ?? $this->gedung_id,
            'nama_fasilitas' => $data['nama_fasilitas'] ?? $this->nama_fasilitas,
            'kapasitas' => $data['kapasitas'] ?? $this->kapasitas,
            'keterangan' => array_key_exists('keterangan', $data) ? $data['keterangan'] : $this->keterangan,
            'gambar' => $data['gambar'] ?? $this->gambar,
            'fasilitas_status' => $data['fasilitas_status'] ?? $this->fasilitas_status,
        ]);
    }

    public function deleteFasilitas()
    {
        return $this->delete();
    }

    public function gedung()
    {
        return $this->belongsTo(Gedung::class, 'gedung_id');
    }

    public function toggleStatus()
    {
        $this->fasilitas_status = !$this->fasilitas_status;
        $this->save();
    }
}
