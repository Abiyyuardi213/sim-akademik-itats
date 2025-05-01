<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Legalisir extends Model
{
    protected $table = 'legalisir';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'tanggal',
        'no_legalisir',
        'nama',
        'npm',
        'jumlah_ijazah',
        'jumlah_transkip',
        'jumlah_lain',
        'jumlah_total',
    ];

    protected static function booted()
    {
        static::creating(function ($legalisir) {
            if (!$legalisir->id) {
                $legalisir->id = (string) Str::uuid();
            }
        });
    }

    public static function createLegalisir($data)
    {
        return self::create([
            'nama_periode' => $data['nama_periode'],
            'awal_cuti' => $data['awal_cuti'] ?? null,
            'akhir_cuti' => $data['akhir_cuti'] ?? null,
            'bulan_her' => $data['bulan_her'] ?? null,
            'periode_status' => $data['periode_status'] ?? true,
        ]);
    }
}
