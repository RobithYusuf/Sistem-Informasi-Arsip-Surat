<?php

namespace App\Http\Controllers;

use App\Models\Rak;
use Illuminate\Http\Request;

class RakController extends Controller
{

    public function index()
    {
        $raks = Rak::all();
        return view('admin.rak.index', compact('raks'));
    }

    public function create()
    {

        return view('admin.rak.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'rak' => 'required|integer'
        ]);

        Rak::create([
            'rak' => $request->rak
        ]);

        return redirect()->route(getCurrentRoutePrefix() . '.data-rak.index')->with('success', 'Rak berhasil ditambahkan.');
    }

    public function edit(Rak $data_rak)
    {
        return view('admin.rak.edit', compact('data_rak'));
    }
    public function update(Request $request, Rak $data_rak)
    {
        $request->validate([
            'rak' => 'required|integer'
        ]);

        $data_rak->update([
            'rak' => $request->rak
        ]);

        return redirect()->route(getCurrentRoutePrefix() . '.data-rak.index')->with('success', 'Rak berhasil diperbarui.');
    }

    public function destroy(Rak $data_rak)
    {
        $data_rak->delete();
        return redirect()->route(getCurrentRoutePrefix() . '.data-rak.index')->with('success', 'Rak berhasil dihapus.');
    }
}
