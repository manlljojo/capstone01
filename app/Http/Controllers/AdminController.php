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
            return redirect('/admin');
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
        $peserta=Peserta::find($id);
        return view('edit', compact('peserta'));
    }
    public function ubahput(Request $request, $id){

        $peserta = Peserta::find($id);

        $peserta->nama = $request->nama;
        $peserta->alamat = $request->alamat;
        $peserta->nomor_hp = $request->nomor_hp;
    
        // Simpan perubahan ke database
        $peserta->save();
        return redirect('/admin');
    }
    public function delete($id){
        Peserta::find($id)->delete();
        return back();
    }
    public function daftar(){
        $peserta = Peserta::all();
        return view('daftar', compact('peserta'));
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
            return redirect('admin');
            
        }
    } else {
        return redirect('admin');
    }
    }
}
