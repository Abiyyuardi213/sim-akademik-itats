<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Legalisir extends Model
{
    protected $table = 'legalisir';
    protected $primaryKey = 'id';
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

    protected $casts = [
        'tanggal' => 'date',
        'id' => 'string',
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
            'tanggal' => $data['tanggal'],
            'no_legalisir' => $data['no_legalisir'],
            'nama' => $data['nama'],
            'npm' => $data['npm'],
            'jumlah_ijazah' => $data['jumlah_ijazah'] ?? null,
            'jumlah_transkip' => $data['jumlah_transkip'] ?? null,
            'jumlah_lain' => $data['jumlah_lain'] ?? null,
            'jumlah_total' => $data['jumlah_total'] ?? 0,
        ]);
    }

    public function updateLegalisir($data)
    {
        $this->update([
            'tanggal' => $data['tanggal'],
            'no_legalisir' => $data['no_legalisir'] ?? $this->no_legalisir,
            'nama' => $data['nama'] ?? $this->nama,
            'npm' => $data['npm'] ?? $this->npm,
            'jumlah_ijazah' => $data['jumlah_ijazah'] ?? $this->jumlah_ijazah,
            'jumlah_transkip' => $data['jumlah_transkip'] ?? $this->jumlah_transkip,
            'jumlah_lain' => $data['jumlah_lain'] ?? $this->jumlah_lain,
            'jumlah_total' => $data['jumlah_total'] ?? $this->jumlah_total,
        ]);
    }

    public function deleteLegalisir()
    {
        return $this->delete();
    }
}
