<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Kaprodi extends Authenticatable
{
    use Notifiable;

    protected $table = 'kaprodis';

    protected $fillable = [
        'username',
        'password',
        'prodi_id',
    ];

    protected $hidden = [
        'password',
    ];

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi_id');
    }
}
