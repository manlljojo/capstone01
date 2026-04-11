<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'event_id', 'nama', 'alamat', 'nomor_hp', 'tiket_id', 'check_in', 'metode_pembayaran', 'status_pembayaran', 'total_bayar'];

    protected $table = 'peserta';

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function event() {
        return $this->belongsTo(Event::class);
    }
}
