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

        $events = $events->orderBy('tanggal_event', 'asc')->get();

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

        \DB::beginTransaction();
        try {
            $pemesanan = \App\Models\Pemesanan::create([
                'id_pengguna' => Auth::guard('pengguna')->id(),
                'nama_pemesan' => $request->nama,
                'nomor_hp' => $request->nomor_hp,
                'alamat' => $request->alamat,
                'tanggal_pemesanan' => now(),
                'total_harga' => $event->harga,
                'status_pemesanan' => 'Booking',
            ]);

            $tiket = $event->tikets()->first(); // Assumes at least one ticket category exists

            \App\Models\DetailPemesanan::create([
                'id_pemesanan' => $pemesanan->id_pemesanan,
                'id_tiket' => $tiket->id_tiket,
                'jumlah' => 1,
                'subtotal' => $event->harga,
            ]);

            \App\Models\Pembayaran::create([
                'id_pemesanan' => $pemesanan->id_pemesanan,
                'metode_pembayaran' => $request->metode_pembayaran,
                'status_bayar' => 'Belum Lunas',
            ]);

            // Kurangi Kuota (This field is on event for compatibility)
            $event->decrement('kuota');
            $tiket->decrement('stok');

            \DB::commit();
            return redirect('/bayar/' . $pemesanan->id_pemesanan);
        } catch (\Exception $e) {
            \DB::rollback();
            return back()->with('error', 'Pemesanan gagal: ' . $e->getMessage());
        }
    }

    public function bayar($id) {
        $peserta = \App\Models\Pemesanan::with(['detailPemesanans.tiket.event', 'pembayaran'])->findOrFail($id);
        return view('bayar', compact('peserta'));
    }

    public function riwayat() {
        $pesertas = \App\Models\Pemesanan::where('id_pengguna', Auth::guard('pengguna')->id())
            ->with(['detailPemesanans.tiket.event', 'pembayaran'])
            ->orderBy('created_at', 'desc')
            ->get();
        return view('riwayat', compact('pesertas'));
    }

    public function batal($id) {
        $peserta = \App\Models\Pemesanan::with('pembayaran')->where('id_pemesanan', $id)->where('id_pengguna', Auth::guard('pengguna')->id())->firstOrFail();

        if(($peserta->pembayaran->status_bayar ?? '') !== 'Belum Lunas') {
            return redirect()->back()->with('error', 'Hanya pesanan yang belum dibayar yang bisa dibatalkan.');
        }

        // Kembalikan Kuota
        foreach($peserta->detailPemesanans as $detail) {
            $tiket = $detail->tiket;
            if($tiket) {
                $tiket->increment('stok');
                $event = $tiket->event;
                if($event) $event->increment('kuota');
            }
        }

        // Delet dari Database (Hard Delete sesuai permintaan USER)
        $peserta->delete();

        return redirect()->back()->with('success', 'Pesanan berhasil dibatalkan dan dihapus.');
    }

    public function cetak($id) {
        $peserta = \App\Models\Pemesanan::with(['detailPemesanans.tiket.event', 'pembayaran', 'pengguna'])
            ->where('id_pemesanan', $id)
            ->where('id_pengguna', Auth::guard('pengguna')->id())
            ->firstOrFail();

        if(($peserta->pembayaran->status_bayar ?? '') !== 'Lunas') {
            return redirect('/riwayat')->with('error', 'Tiket hanya bisa dicetak jika sudah lunas.');
        }

        return view('cetak_tiket', compact('peserta'));
    }
}
