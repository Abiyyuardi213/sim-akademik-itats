<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Support extends Model
{
    protected $table = 'support';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'gedung_id',
        'nama_ruangan',
        'kapasitas',
        'keterangan',
        'ruangan_status',
    ];

    protected static function booted()
    {
        static::creating(function ($model) {
            if (!$model->id) {
                $model->id = (string) Str::uuid();
            }
        });
    }

    public static function createSupport($data)
    {
        return self::create([
            'gedung_id' => $data['gedung_id'],
            'nama_ruangan' => $data['nama_ruangan'],
            'kapasitas' => $data['kapasitas'],
            'keterangan' => $data['keterangan'] ?? '',
            'ruangan_status' => $data['ruangan_status'] ?? true,
        ]);
    }

    public function updateSupport($data)
    {
        $this->update([
            'gedung_id' => $data['gedung_id'] ?? $this->gedung_id,
            'nama_ruangan' => $data['nama_ruangan'] ?? $this->nama_ruangan,
            'kapasitas' => $data['kapasitas'] ?? $this->kapasitas,
            'keterangan' => array_key_exists('keterangan', $data) ? $data['keterangan'] : $this->keterangan,
            'ruangan_status' => $data['ruangan_status'] ?? $this->ruangan_status,
        ]);
    }

    public function deleteSupport()
    {
        return $this->delete();
    }

    public function gedung()
    {
        return $this->belongsTo(Gedung::class, 'gedung_id');
    }

    public function toggleStatus()
    {
        $this->ruangan_status = !$this->ruangan_status;
        $this->save();
    }
}
