<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Pengumuman extends Model
{
    protected $table = 'pengumuman';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'judul',
        'isi',
        'tanggal_dibuat',
        'tanggal_diperbarui',
        'status',
        'author_id',
    ];

    protected static function booted()
    {
        static::creating(function ($pengumuman) {
            if (!$pengumuman->id) {
                $pengumuman->id = (string) Str::uuid();
            }
        });
    }

    public static function createPengumuman($data)
    {
        return self::create([
            'judul' => $data['judul'],
            'isi' => $data['isi'],
            'tanggal_dibuat' => $data['tanggal_dibuat'],
            'tanggal_diperbarui' => $data['tanggal_diperbarui'],
            'status' => $data['status'],
            'author_id' => $data['author_id'],
        ]);
    }

    public function updatePengumuman($data)
    {
        return $this->update([
            'judul' => $data['judul'] ?? $this->judul,
            'isi' => $data['isi'] ?? $this->isi,
            'tanggal_dibuat' => $data['tanggal_dibuat'] ?? $this->tanggal_dibuat,
            'tanggal_diperbarui' => $data['tanggal_diperbarui'] ?? $this->tanggal_diperbarui,
            'status' => $data['status'] ?? $this->status,
            'author_id' => $data['author_id'] ?? $this->author_id,
        ]);
    }

    public function deletePengumuman()
    {
        return $this->delete();
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
