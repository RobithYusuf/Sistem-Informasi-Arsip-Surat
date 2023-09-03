<?php

namespace App\Http\Controllers;

use App\Models\DaftarArsip;
use Illuminate\Http\Request;

class DaftarArsipController extends Controller
{

    public function index()
    {
        $daftararsips = DaftarArsip::all();
        return view('admin.daftar_arsip.index', compact('daftararsips'));
    }

    public function create()
    {
        return view('admin.daftar_arsip.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'nama_daftar' => 'required',
        ]);

        DaftarArsip::create($request->all());
        return redirect()->route(getCurrentRoutePrefix() . '.daftar-arsip.index')->with('success', 'Daftar Arsip berhasil ditambahkan');
    }

    public function show(string $id)
    {
        $daftar_arsip = DaftarArsip::find($id);
        return view('admin.daftar_arsip.show', compact('daftar_arsip'));
    }

    public function edit(DaftarArsip $daftar_arsip)
    {
        return view('admin.daftar_arsip.edit', compact('daftar_arsip'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_daftar' => 'required',
        ]);

        $daftar_arsip = DaftarArsip::find($id);
        $daftar_arsip->update($request->all());

        return redirect()->route(getCurrentRoutePrefix() . '.daftar-arsip.index')->with('success', 'Daftar Arsip berhasil diperbarui');
    }

    public function destroy(string $id)
    {
        $daftar_arsip = DaftarArsip::find($id);
        $daftar_arsip->delete();

        return redirect()->route(getCurrentRoutePrefix() . '.daftar-arsip.index')->with('success', 'Daftar Arsip berhasil dihapus');
    }
}
