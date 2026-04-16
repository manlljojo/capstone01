<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $table = 'events';
    protected $primaryKey = 'id_event';

    protected $fillable = [
        'id_penyelenggara',
        'id_admin',
        'nama_event',
        'deskripsi',
        'tanggal_event',
        'lokasi',
        'status_event',
        'banner',
        'kategori',
        'kuota',
        'kapasitas',
        'jam_operasional',
        'durasi',
        'faktor_pembatas',
        'streaming_link',
        'rundown',
        'partner_streaming',
    ];

    public function penyelenggara()
    {
        return $this->belongsTo(Penyelenggara::class, 'id_penyelenggara');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'id_admin');
    }

    public function tikets()
    {
        return $this->hasMany(Tiket::class, 'id_event');
    }
}
