<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PengajuanPeminjamanRuangan extends Model
{
    protected $table = 'pengajuan_peminjaman_ruangan';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'user_id',
        'kelas_id',
        'prodi_id',
        'tanggal_peminjaman',
        'tanggal_berakhir_peminjaman',
        'waktu_peminjaman',
        'waktu_berakhir_peminjaman',
        'keperluan_peminjaman',
        'status',
        'catatan_admin',    
    ];

    protected static function booted()
    {
        static::creating(function ($pengajuan) {
            if (!$pengajuan->id) {
                $pengajuan->id = (string) Str::uuid();
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
    }
}
