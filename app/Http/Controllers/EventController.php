<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

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
        'tanggal' => 'required|date',
        'lokasi' => 'required',
    ]);

    $data = $request->only([
        'nama_event',
        'kategori',
        'deskripsi',
        'tanggal',
        'lokasi'
    ]);

    if ($request->hasFile('banner')) {
        $file = $request->file('banner');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/banners', $filename);
        $data['banner'] = $filename;
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
            'banner' => 'required',
            'deskripsi' => 'required',
            'tanggal' => 'required|date',
            'lokasi' => 'required',
        ]);

        $event = \App\Models\Event::findOrFail($id);
        $event->update($request->all());

        return redirect('/admin')->with('success', 'Event berhasil diupdate!');
    }

    public function destroy($id)
    {
        $event = \App\Models\Event::findOrFail($id);
        $event->delete();

        return redirect('/admin')->with('success', 'Event berhasil dihapus!');
    }


}
