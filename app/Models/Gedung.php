<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Gedung extends Model
{
    protected $table = 'gedung';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'nama_gedung',
        'gedung_description',
        'gedung_status',
    ];

    protected static function booted()
    {
        static::creating(function ($gedung) {
            if (!$gedung->id) {
                $gedung->id = (string) Str::uuid();
            }
        });
    }

    public static function createGedung($data)
    {
        return self::create([
            'nama_gedung' => $data['nama_gedung'],
            'gedung_description' => $data['gedung_description'] ?? null,
            'gedung_status' => $data['gedung_status'] ?? true,
        ]);
    }

    public function updateGedung($data)
    {
        $this->update([
            'nama_gedung' => $data['nama_gedung'],
            'gedung_description' => $data['gedung_description'] ?? $this->gedung_description,
            'gedung_status' => $data['gedung_status'] ?? $this->gedung_status,
        ]);
    }

    public function deleteGedung()
    {
        return $this->delete();
    }

    public function toggleStatus()
    {
        $this->gedung_status = !$this->gedung_status;
        $this->save();
    }

    /*
    |--------------------------------------------------------------------------
    | Relasi
    |--------------------------------------------------------------------------
    */

    public function kelas()
    {
        return $this->hasMany(Kelas::class, 'gedung_id');
    }

    public function support()
    {
        return $this->hasMany(Support::class, 'gedung_id');
    }

    public function laboratorium()
    {
        return $this->hasMany(Laboratorium::class, 'gedung_id');
    }
}
