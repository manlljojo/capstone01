<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use Illuminate\Support\Str;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\Auth;

class PesertaController extends Controller
{
    public function index()
    {
        $events = \App\Models\Event::all();
        return view('home', compact('events'));
    }

    public function tiket($id){
        $event = \App\Models\Event::findOrFail($id);
        return view('peserta', compact('event'));
    }

    public function kirim(Request $request, $id){
        $event = \App\Models\Event::findOrFail($id);
        $peserta = new Peserta;
        $peserta->user_id = Auth::id();
        $peserta->event_id = $id;
        $peserta->nama = $request->nama;
        $peserta->alamat = $request->alamat;
        $peserta->nomor_hp = $request->nomor_hp;
        $peserta->metode_pembayaran = $request->metode_pembayaran;
        $peserta->total_bayar = $event->harga;
        $peserta->status_pembayaran = 'Pending';
        $peserta->tiket_id = random_int(1000000000, 9999999999);
        $peserta->check_in = 'Belum';
        $peserta->save();
        
        return redirect('/bayar/' . $peserta->id);
    }

    public function bayar($id) {
        $peserta = Peserta::with('event')->findOrFail($id);
        return view('bayar', compact('peserta'));
    }

    public function riwayat() {
        $pesertas = Peserta::where('user_id', Auth::id())->with('event')->orderBy('created_at', 'desc')->get();
        return view('riwayat', compact('pesertas'));
    }

}
