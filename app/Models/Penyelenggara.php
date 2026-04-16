<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Penyelenggara extends Authenticatable
{
    use Notifiable;

    protected $table = 'penyelenggaras';
    protected $primaryKey = 'id_penyelenggara';

    protected $fillable = [
        'nama_organisasi',
        'email',
        'password',
        'no_telp',
        'alamat',
    ];

    protected $hidden = [
        'password',
    ];
}
