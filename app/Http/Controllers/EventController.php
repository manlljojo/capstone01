<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = \App\Models\Event::all();
        return view('events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'nama_event' => 'required',
        'kategori' => 'required',
        'deskripsi' => 'required',
        'tanggal_event' => 'required|date',
        'lokasi' => 'required',
    ]);

    $data = $request->only([
        'nama_event',
        'kategori',
        'deskripsi',
        'tanggal_event',
        'lokasi',
        'harga',
        'streaming_link',
        'rundown',
        'partner_streaming'
    ]);

    if ($request->hasFile('banner')) {
        $file = $request->file('banner');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/banners', $filename);
        $data['banner'] = $filename;
    }
    
    if (Auth::guard('penyelenggara')->check()) {
        $data['id_penyelenggara'] = Auth::guard('penyelenggara')->id();
    } elseif (Auth::guard('admin')->check()) {
        $data['id_admin'] = Auth::guard('admin')->id();
    }
    
    \App\Models\Event::create($data);
    return redirect('/admin')->with('success', 'Event berhasil ditambahkan!');
}

    /**
     * Display the specified resource.
     */
        public function show($id)
{
    $event = \App\Models\Event::findOrFail($id);
    return view('events.show', compact('event'));
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $event = \App\Models\Event::findOrFail($id);
        return view('events.edit', compact('event'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_event' => 'required',
            'kategori' => 'required',
            'deskripsi' => 'required',
            'tanggal_event' => 'required|date',
            'lokasi' => 'required',
            'harga' => 'required|numeric',
            'banner' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $event = \App\Models\Event::findOrFail($id);
        
        $data = $request->only([
            'nama_event',
            'kategori',
            'deskripsi',
            'tanggal_event',
            'lokasi',
            'harga',
            'streaming_link',
            'rundown',
            'partner_streaming'
        ]);

        if ($request->hasFile('banner')) {
            // Hapus file lama jika itu file lokal (opsional, tapi disarankan untuk menghemat storage)
            // if ($event->banner && !Str::startsWith($event->banner, ['http', 'https'])) {
            //     \Storage::delete('public/banners/' . $event->banner);
            // }

            $file = $request->file('banner');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/banners', $filename);
            $data['banner'] = $filename;
        }

        $event->update($data);

        return redirect('/admin')->with('success', 'Event berhasil diupdate!');
    }

    public function destroy($id)
    {
        $event = \App\Models\Event::findOrFail($id);
        $event->delete();

        return redirect('/admin')->with('success', 'Event berhasil dihapus!');
    }


}
