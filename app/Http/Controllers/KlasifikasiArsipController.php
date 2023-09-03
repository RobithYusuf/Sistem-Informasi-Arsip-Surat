<?php

namespace App\Http\Controllers;

use App\Models\DaftarArsip;
use Illuminate\Http\Request;
use App\Models\KlasifikasiArsip;

class KlasifikasiArsipController extends Controller
{

    public function index()
    {
        $klasifikasiArsips = KlasifikasiArsip::all();
        return view('admin.klasifikasi_arsip.index', compact('klasifikasiArsips'));
    }

    public function create()
    {
        $daftarArsips = DaftarArsip::all();
        return view('admin.klasifikasi_arsip.create', compact('daftarArsips'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_klasifikasi' => 'required|string|max:50',
            'nama_klasifikasi' => 'required|string|max:25',
            'daftar_arsip_id' => 'required|integer|exists:daftar_arsip,id_daftar_arsip',
        ]);

        KlasifikasiArsip::create($request->all());
        return redirect()->route(getCurrentRoutePrefix() . '.klasifikasi-arsip.index')->with('success', 'Klasifikasi Arsip berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        $klasifikasiArsip = KlasifikasiArsip::findOrFail($id);

        return view('admin.klasifikasi_arsip.show', compact('klasifikasiArsip'));
    }
    public function edit(string $id)
    {
        $klasifikasiArsip = KlasifikasiArsip::findOrFail($id);
        $arsips = DaftarArsip::all();
        $selectedArsipId = $klasifikasiArsip->daftar_arsip_id;  // Pastikan ini adalah nama kolom yang benar
        return view('admin.klasifikasi_arsip.edit', compact('klasifikasiArsip', 'arsips', 'selectedArsipId'));
    }



    public function update(Request $request, string $id)
    {

        $request->validate([
            'nomor_klasifikasi' => 'required|string|max:50',
            'nama_klasifikasi' => 'required|string|max:25',
            'daftar_arsip_id' => 'required|integer|exists:daftar_arsip,id_daftar_arsip',
        ]);

        $klasifikasiArsip = KlasifikasiArsip::findOrFail($id);
        $klasifikasiArsip->update($request->all());

        return redirect()->route(getCurrentRoutePrefix() . '.klasifikasi-arsip.index')->with('success', 'Klasifikasi Arsip berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $klasifikasiArsip = KlasifikasiArsip::findOrFail($id);
        $klasifikasiArsip->delete();

        return redirect()->route(getCurrentRoutePrefix() . '.klasifikasi-arsip.index')->with('success', 'Klasifikasi Arsip berhasil dihapus.');
    }
}
