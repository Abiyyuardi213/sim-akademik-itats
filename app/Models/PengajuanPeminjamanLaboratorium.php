<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class PengajuanPeminjamanLaboratorium extends Model
{
    protected $table = 'pengajuan_peminjaman_laboratorium';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'user_id',
        'laboratorium_id',
        'prodi_id',
        'tanggal_peminjaman',
        'tanggal_berakhir_peminjaman',
        'waktu_peminjaman',
        'waktu_berakhir_peminjaman',
        'keperluan_peminjaman',
        'status',
        'catatan_admin',
        'catatan_kaprodi',
    ];

    protected $casts = [
        'tanggal_peminjaman' => 'date',
        'tanggal_berakhir_peminjaman' => 'date',
    ];

    protected static function booted()
    {
        static::creating(function ($model) {
            if (!$model->id) {
                $model->id = (string) Str::uuid();
            }
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function laboratorium(): BelongsTo
    {
        return $this->belongsTo(Laboratorium::class, 'laboratorium_id');
    }

    public function prodi(): BelongsTo
    {
        return $this->belongsTo(Prodi::class, 'prodi_id');
    }
}
