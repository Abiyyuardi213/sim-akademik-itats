<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // Gunakan Authenticatable dari Laravel
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Pengguna extends Authenticatable // Extends Authenticatable
{
    protected $table = 'pengguna';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'nama_pengguna',
        'username',
        'email',
        'no_telepon',
        'password',
        'profile_picture',
        'role_id',
    ];

    protected static function booted()
    {
        static::creating(function ($pengguna) {
            if (!$pengguna->id) {
                $pengguna->id = (string) Str::uuid();
            }
        });
    }

    public static function createPengguna($data)
    {
        return self::create([
            'nama_pengguna' => $data['nama_pengguna'],
            'username' => $data['username'],
            'email' => $data['email'],
            'no_telepon' => $data['no_telepon'],
            'password' => bcrypt($data['password']),
            'profile_picture' => $data['profile_picture'] ?? null,
            'role_id' => $data['role_id'],
        ]);
    }

    public function updatePengguna($data)
    {
        return $this->update([
            'nama_pengguna'   => $data['nama_pengguna'] ?? $this->nama_pengguna,
            'username'        => $data['username'] ?? $this->username,
            'email'           => $data['email'] ?? $this->email,
            'no_telepon'      => $data['no_telepon'] ?? $this->no_telepon,
            'profile_picture' => $data['profile_picture'] ?? $this->profile_picture,
            'role_id'         => $data['role_id'] ?? $this->role_id,
        ]);
    }

    public function deletePengguna()
    {
        return $this->delete();
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function getAuthIdentifierName()
    {
        return 'username';
    }
}
