<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Laboratorium extends Model
{
    protected $table = 'laboratorium';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'gedung_id',
        'nama_laboratorium',
        'kapasitas',
        'keterangan',
        'gambar',
        'status',
    ];

    protected static function booted()
    {
        static::creating(function ($model) {
            if (!$model->id) {
                $model->id = (string) Str::uuid();
            }
        });
    }

    public static function createLaboratorium($data)
    {
        return self::create([
            'gedung_id' => $data['gedung_id'],
            'nama_laboratorium' => $data['nama_laboratorium'],
            'kapasitas' => $data['kapasitas'],
            'keterangan' => $data['keterangan'] ?? '',
            'gambar' => $data['gambar'] ?? null,
            'status' => $data['status'] ?? true,
        ]);
    }

    public function updateLaboratorium($data)
    {
        $this->update([
            'gedung_id' => $data['gedung_id'] ?? $this->gedung_id,
            'nama_laboratorium' => $data['nama_laboratorium'] ?? $this->nama_laboratorium,
            'kapasitas' => $data['kapasitas'] ?? $this->kapasitas,
            'keterangan' => array_key_exists('keterangan', $data) ? $data['keterangan'] : $this->keterangan,
            'gambar' => $data['gambar'] ?? $this->gambar,
            'status' => $data['status'] ?? $this->status,
        ]);
    }

    public function deleteLaboratorium()
    {
        return $this->delete();
    }

    public function gedung()
    {
        return $this->belongsTo(Gedung::class, 'gedung_id');
    }

    public function toggleStatus()
    {
        $this->status = !$this->status;
        $this->save();
    }
}
