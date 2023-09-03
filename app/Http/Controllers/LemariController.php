<?php

namespace App\Http\Controllers;

use App\Models\Lemari;
use Illuminate\Http\Request;

class LemariController extends Controller
{
    public function index()
    {
        $lemaris = Lemari::all();
        return view('admin.lemari.index', compact('lemaris'));
    }

    public function create()
    {
        return view('admin.lemari.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'lemari' => 'required',
        ]);

        Lemari::create($request->all());
        return redirect()->route(getCurrentRoutePrefix() . '.data-lemari.index')->with('success', 'Lemari berhasil ditambahkan');
    }

    public function show(string $id)
    {
        $lemari = Lemari::find($id);
        return view('admin.lemari.show', compact('lemari'));
    }

     public function edit(Lemari $data_lemari)
    {
        return view('admin.lemari.edit', compact('data_lemari'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'lemari' => 'required',
        ]);

        $lemari = Lemari::find($id);
        $lemari->update($request->all());

        return redirect()->route(getCurrentRoutePrefix() . '.data-lemari.index')->with('success', 'Lemari berhasil diperbarui');
    }

    public function destroy(string $id)
    {
        $lemari = Lemari::find($id);
        $lemari->delete();

        return redirect()->route(getCurrentRoutePrefix() . '.data-lemari.index')->with('success', 'Lemari berhasil dihapus');
    }
}
