<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Prodi extends Model
{
    protected $table = 'prodi';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'nama_prodi',
        'prodi_description',
        'prodi_status',
    ];

    protected static function booted()
    {
        static::creating(function ($prodi) {
            if (!$prodi->id) {
                $prodi->id = (string) Str::uuid();
            }
        });
    }

    public static function createProdi($data)
    {
        return self::create([
            'nama_prodi' => $data['nama_prodi'],
            'prodi_description' => $data['prodi_description'] ?? null,
            'prodi_status' => $data['prodi_status'] ?? true,
        ]);
    }

    public function updateProdi($data)
    {
        $this->update([
            'nama_prodi' => $data['nama_prodi'],
            'prodi_description' => $data['prodi_description'] ?? $this->prodi_description,
            'prodi_status' => $data['prodi_status'] ?? $this->prodi_status,
        ]);
    }

    public function deleteProdi()
    {
        return $this->delete();
    }

    public function toggleStatus()
    {
        $this->prodi_status = !$this->prodi_status;
        $this->save();
    }
}
