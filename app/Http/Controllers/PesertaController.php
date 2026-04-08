<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use Illuminate\Support\Str;
use Illuminate\Http\Request;


class PesertaController extends Controller
{
    public function index()
{
    $events = \App\Models\Event::all();
    return view('home', compact('events'));
}

    public function tiket(){
        return view('peserta');
    }

    public function kirim(Request $request){
    
        $peserta = new Peserta;
        $peserta->nama = $request->nama;
        $peserta->alamat = $request->alamat;
        $peserta->nomor_hp = $request->nomor_hp;
        $peserta->tiket_id = random_int(1000000000, 9999999999);
        $peserta->check_in = 'Belum';
        $peserta->save();
        $request->session()->flash('success', 'Sudah Masuk');
        return redirect('/');
    }

}
