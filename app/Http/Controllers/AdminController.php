<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function index()
    {
        $eventsQuery = \App\Models\Event::query();
        $isPenyelenggara = Auth::guard('penyelenggara')->check();
        
        if ($isPenyelenggara) {
            $eventsQuery->where('id_penyelenggara', Auth::guard('penyelenggara')->id());
        }

        $events = $eventsQuery->get();
        
        // Smart Data for Organizer
        $totalSales = 0;
        $totalRevenue = 0;
        foreach($events as $event) {
            foreach($event->tikets as $tiket) {
                foreach($tiket->detailPemesanans as $detail) {
                    if(($detail->pemesanan->pembayaran->status_bayar ?? '') === 'Lunas') {
                        $totalSales += $detail->jumlah;
                        $totalRevenue += $detail->subtotal;
                    }
                }
            }
        }

        return view('admin', compact('events', 'totalSales', 'totalRevenue'));
    }
    public function signin(){
        return view('login');
    }
    public function login(Request $request){
        $credentials = $request->validate([
            'username' => 'required', // We'll look up by email in our case since ERD uses email
            'password' => 'required',
        ]);

        // Try Admin guard
        if(Auth::guard('admin')->attempt(['email' => $credentials['username'], 'password' => $credentials['password']])){
            $request->session()->regenerate();
            return redirect('/admin');
        }

        // Try Penyelenggara guard
        if(Auth::guard('penyelenggara')->attempt(['email' => $credentials['username'], 'password' => $credentials['password']])){
            $request->session()->regenerate();
            return redirect('/admin'); // Or penyelenggara dashboard
        }

        // Try Pengguna guard
        if(Auth::guard('pengguna')->attempt(['email' => $credentials['username'], 'password' => $credentials['password']])){
            $request->session()->regenerate();
            return redirect('/')->with('success', 'Berhasil login!');
        }

        return back()->with('error', 'Email atau Password salah!');
    }
    public function logout(Request $request){
        Auth::guard('admin')->logout();
        Auth::guard('penyelenggara')->logout();
        Auth::guard('pengguna')->logout();
 
        $request->session()->invalidate();
        $request->session()->regenerateToken();
 
        return redirect('/')->with('success', 'Berhasil logout!');
    }

    public function ubah($id){
        $peserta = \App\Models\Pemesanan::findOrFail($id);
        return view('edit', compact('peserta'));
    }
    public function ubahput(Request $request, $id){

        $peserta = \App\Models\Pemesanan::findOrFail($id);

        $peserta->status_pemesanan = $request->status;
        $peserta->save();
        return redirect('/admin');
    }
    public function delete($id){
        \App\Models\Pemesanan::findOrFail($id)->delete();
        return redirect()->back();
    }
    public function daftar(Request $request){
        $query = $request->input('search');
        $isPenyelenggara = Auth::guard('penyelenggara')->check();
        
        $peserta = \App\Models\Pemesanan::with(['pengguna', 'detailPemesanans.tiket.event', 'pembayaran'])
            ->orderBy('created_at', 'desc');

        if ($isPenyelenggara) {
            $penyelenggaraId = Auth::guard('penyelenggara')->id();
            $peserta->whereHas('detailPemesanans.tiket.event', function($q) use ($penyelenggaraId) {
                $q->where('id_penyelenggara', $penyelenggaraId);
            });
        }

        if($query) {
            $peserta->where(function($q) use ($query) {
                $q->whereHas('pengguna', function($sq) use ($query) {
                    $sq->where('nama', 'like', "%$query%");
                })->orWhere('id_pemesanan', 'like', "%$query%");
            });
        }

        $peserta = $peserta->get();
        return view('daftar', compact('peserta'));
    }

    public function toggleCheckin($id) {
        $peserta = \App\Models\Pemesanan::findOrFail($id);
        
        // Hanya bisa check-in jika sudah lunas
        if(($peserta->pembayaran->status_bayar ?? '') !== 'Lunas') {
            return redirect()->back()->with('error', 'Peserta belum melunasi pembayaran!');
        }

        $peserta->status_pemesanan = $peserta->status_pemesanan === 'Check-in' ? 'Booking' : 'Check-in';
        $peserta->save();
        return redirect()->back();
    }

    public function confirmPayment($id) {
        $pemesanan = \App\Models\Pemesanan::findOrFail($id);
        $pembayaran = $pemesanan->pembayaran;
        if($pembayaran) {
            $pembayaran->status_bayar = 'Lunas';
            $pembayaran->tanggal_bayar = now();
            $pembayaran->save();
        }
        return redirect()->back()->with('success', 'Pembayaran berhasil dikonfirmasi!');
    }

    public function checkinview(){
        return view('checkin');
    }
    public function checkin(Request $request){
        $tiketId = $request->input('tiket_id');
        $peserta = \App\Models\Pemesanan::find($tiketId);

    if ($peserta) {
        if ($peserta->status_pemesanan === 'Check-in') {  
            $request->session()->flash('error', 'Check-in Gagal, Karena sudah Terdaftar');          
            return redirect('admin');
        } else {
            $peserta->status_pemesanan = 'Check-in';
            $peserta->save();
            $request->session()->flash('success', 'Check-in berhasil dilakukan.');
            return redirect('/admin');
            
        }
    } else {
        return redirect('/admin')->with('error', 'ID Pemesanan tidak ditemukan!');
    }
    }
}
