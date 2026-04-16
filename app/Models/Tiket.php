<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tiket extends Model
{
    protected $table = 'tikets';
    protected $primaryKey = 'id_tiket';

    protected $fillable = [
        'id_event',
        'kategori_tiket',
        'harga',
        'stok',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class, 'id_event');
    }

    public function detailPemesanans()
    {
        return $this->hasMany(DetailPemesanan::class, 'id_tiket');
    }
}
