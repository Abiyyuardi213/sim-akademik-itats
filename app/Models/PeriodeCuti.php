<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PeriodeCuti extends Model
{
    protected $table = 'periode_cuti';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'nama_periode',
        'awal_cuti',
        'akhir_cuti',
        'bulan_her',
        'periode_status',
    ];

    protected static function booted()
    {
        static::creating(function ($periode) {
            if (!$periode->id) {
                $periode->id = (string) Str::uuid();
            }
        });
    }

    public static function createPeriode($data)
    {
        return self::create([
            'nama_periode' => $data['nama_periode'],
            'awal_cuti' => $data['awal_cuti'] ?? null,
            'akhir_cuti' => $data['akhir_cuti'] ?? null,
            'bulan_her' => $data['bulan_her'] ?? null,
            'periode_status' => $data['periode_status'] ?? true,
        ]);
    }

    public function updatePeriode($data)
    {
        $this->update([
            'nama_periode' => $data['nama_periode'],
            'awal_cuti' => $data['awal_cuti'] ?? $this->awal_cuti,
            'akhir_cuti' => $data['akhir_cuti'] ?? $this->akhir_cuti,
            'bulan_her' => $data['bulan_her'] ?? $this->bulan_her,
            'periode_status' => $data['periode_status'] ?? $this->periode_status,
        ]);
    }

    public function deletePeriode()
    {
        return $this->delete();
    }

    public function toggleStatus()
    {
        $this->periode_status = !$this->periode_status;
        $this->save();
    }
}
