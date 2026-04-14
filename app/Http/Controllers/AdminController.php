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
    $events = \App\Models\Event::all();
    return view('admin', compact('events'));
}
    public function signin(){
        return view('login');
    }
    public function login(Request $request){
        $validasi = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        if(Auth::attempt($validasi)){
            if(Auth::user()->role === 'admin') {
                return redirect('/admin');
            } else {
                return redirect('/');
            }
        }
        else{
            return redirect('/login');
        }
    }
    public function logout(Request $request){
        Auth::logout();
 
    $request->session()->invalidate();
 
    $request->session()->regenerateToken();
 
    return redirect('/');
    }

    public function ubah($id){
        $peserta = Peserta::findOrFail($id);
        return view('edit', compact('peserta'));
    }
    public function ubahput(Request $request, $id){

        $peserta = Peserta::findOrFail($id);

        $peserta->nama = $request->nama;
        $peserta->alamat = $request->alamat;
        $peserta->nomor_hp = $request->nomor_hp;
    
        $peserta->save();
        return redirect('/admin');
    }
    public function delete($id){
        Peserta::findOrFail($id)->delete();
        return redirect()->back();
    }
    public function daftar(Request $request){
        $query = $request->input('search');
        
        $peserta = Peserta::with('event')->orderBy('created_at', 'desc');

        if($query) {
            $peserta->where(function($q) use ($query) {
                $q->where('nama', 'like', "%$query%")
                  ->orWhere('tiket_id', 'like', "%$query%");
            });
        }

        $peserta = $peserta->get();
        return view('daftar', compact('peserta'));
    }

    public function toggleCheckin($id) {
        $peserta = Peserta::findOrFail($id);
        
        // Hanya bisa check-in jika sudah lunas
        if($peserta->status_pembayaran !== 'Lunas') {
            return redirect()->back()->with('error', 'Peserta belum melunasi pembayaran!');
        }

        $peserta->check_in = $peserta->check_in === 'Belum' ? 'Sudah' : 'Belum';
        $peserta->save();
        return redirect()->back();
    }

    public function confirmPayment($id) {
        $peserta = Peserta::findOrFail($id);
        $peserta->status_pembayaran = 'Lunas';
        $peserta->save();
        return redirect()->back()->with('success', 'Pembayaran berhasil dikonfirmasi!');
    }

    public function checkinview(){
        return view('checkin');
    }
    public function checkin(Request $request){
        $tiketId = $request->input('tiket_id');
        $peserta = Peserta::where('tiket_id', $tiketId)->first();

    if ($peserta) {
        if ($peserta->check_in === 'Sudah') {  
            $request->session()->flash('error', 'Check-in Gagal, Karena sudah Terdaftar');          
            return redirect('admin');
        } else {
            $peserta->check_in = 'Sudah';
            $peserta->save();
            $request->session()->flash('success', 'Check-in berhasil dilakukan.');
            return redirect('/admin');
            
        }
    } else {
        return redirect('/admin')->with('error', 'Tiket ID tidak ditemukan!');
    }
    }
}
