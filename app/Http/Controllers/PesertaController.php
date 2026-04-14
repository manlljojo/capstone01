<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use App\Models\Event;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesertaController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');
        $artist = $request->input('artist');

        $events = Event::query();

        if ($query) {
            $events->where(function($q) use ($query) {
                $q->where('nama_event', 'like', "%$query%")
                  ->orWhere('lokasi', 'like', "%$query%");
            });
        }

        if ($artist) {
            $events->where('nama_event', 'like', "%$artist%");
        }

        $events = $events->orderBy('tanggal', 'asc')->get();

        return view('home', compact('events'));
    }

    public function tiket($id){
        $event = Event::findOrFail($id);
        
        if($event->kuota <= 0) {
            return redirect('/')->with('error', 'Maaf, tiket untuk konser ini sudah habis terjual!');
        }

        return view('peserta', compact('event'));
    }

    public function kirim(Request $request, $id){
        $event = Event::findOrFail($id);

        if($event->kuota <= 0) {
            return redirect('/')->with('error', 'Maaf, tiket sudah habis terjual!');
        }

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

        // Kurangi Kuota
        $event->decrement('kuota');
        
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

    public function batal($id) {
        $peserta = Peserta::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        if($peserta->status_pembayaran !== 'Pending') {
            return redirect()->back()->with('error', 'Hanya pesanan pending yang bisa dibatalkan.');
        }

        // Kembalikan Kuota
        $event = Event::find($peserta->event_id);
        if($event) {
            $event->increment('kuota');
        }

        // Delet dari Database (Hard Delete sesuai permintaan USER)
        $peserta->delete();

        return redirect()->back()->with('success', 'Pesanan berhasil dibatalkan dan dihapus.');
    }

    public function cetak($id) {
        $peserta = Peserta::with('event')->where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        if($peserta->status_pembayaran !== 'Lunas') {
            return redirect('/riwayat')->with('error', 'Tiket hanya bisa dicetak jika sudah lunas.');
        }

        return view('cetak_tiket', compact('peserta'));
    }
}
