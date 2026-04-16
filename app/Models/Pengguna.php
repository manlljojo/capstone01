<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Pengguna extends Authenticatable
{
    use Notifiable;

    protected $table = 'penggunas';
    protected $primaryKey = 'id_pengguna';

    protected $fillable = [
        'id_admin',
        'nama',
        'email',
        'password',
        'no_telp',
        'tanggal_daftar',
    ];

    protected $hidden = [
        'password',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'id_admin');
    }
}
