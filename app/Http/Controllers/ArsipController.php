<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Arsip;
use App\Models\Folder;
use App\Models\KlasifikasiArsip;
use App\Models\Lemari;
use App\Models\Rak;

class ArsipController extends Controller
{

    public function index()
    {
        // Di Controller Anda
        $arsipsMasuk = Arsip::where('status_arsip', 'masuk')->get();
        $arsipsKeluar = Arsip::where('status_arsip', 'keluar')->get();
        $arsips = Arsip::all();
        return view('admin.arsip.index', compact('arsips', 'arsipsMasuk', 'arsipsKeluar'));
    }

    public function create()
    {
        $klasifikasiArsips = KlasifikasiArsip::all();
        $lemaris = Lemari::all();
        $raks = Rak::all();
        $folders = Folder::all();
        return view('admin.arsip.create', compact('klasifikasiArsips', 'lemaris', 'raks', 'folders'));
    }

    public function store(Request $request)
    {
        // Validasi data yang masuk
        $request->validate([
            'nomor_berkas' => 'required|string',
            'uraian_berkas' => 'required|string',
            'jumlah' => 'required|integer',
            'keamanan_arsip' => 'required|string',
            'uraian_arsip' => 'required|string',
            'gambar' => 'required|image',
            'keterangan' => 'required|string',
            'tanggal' => 'required|date',
            'lemari_id' => 'required|integer',
            'rak_id' => 'required|integer',
            'folder_id' => 'required|integer',
            'klasifikasi_id' => 'required|integer',
            'users_id' => 'required|integer',
            'status_arsip' => 'required'
        ], [
            'nomor_berkas.required' => 'Nomor berkas harus diisi.',
            'uraian_berkas.required' => 'Uraian berkas harus diisi.',
            'jumlah.required' => 'Jumlah harus diisi.',
            'jumlah.integer' => 'Jumlah harus berupa angka.',
            'keamanan_arsip.required' => 'Keamanan arsip harus diisi.',
            'uraian_arsip.required' => 'Uraian arsip harus diisi.',
            'gambar.required' => 'Gambar harus diunggah.',
            'gambar.image' => 'Gambar harus berupa file gambar.',
            'keterangan.required' => 'Keterangan harus diisi.',
            'tanggal.required' => 'Tanggal harus diisi.',
            'tanggal.date' => 'Tanggal harus dalam format tanggal yang valid.',
            'lemari_id.required' => 'Lemari harus dipilih.',
            'lemari_id.integer' => 'Lemari harus berupa angka.',
            'rak_id.required' => 'Rak harus dipilih.',
            'rak_id.integer' => 'Rak harus berupa angka.',
            'folder_id.required' => 'Folder harus dipilih.',
            'folder_id.integer' => 'Folder harus berupa angka.',
            'klasifikasi_id.required' => 'Klasifikasi harus dipilih.',
            'klasifikasi_id.integer' => 'Klasifikasi harus berupa angka.',
            'users_id.required' => 'User bermaslaah.',
            'users_id.integer' => 'User bermasalah.',
            'status_arsip.required' => 'Status arsip harus dipilih.',
        ]);


        // Jika ada file gambar yang diupload
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/gambar', $filename);
        } else {
            $filename = null;
        }

        // Menyimpan data ke database
        $arsip = new Arsip;
        $arsip->nomor_berkas = $request->nomor_berkas;
        $arsip->uraian_berkas = $request->uraian_berkas;
        $arsip->jumlah = $request->jumlah;
        $arsip->keamanan_arsip = $request->keamanan_arsip;
        $arsip->uraian_arsip = $request->uraian_arsip;
        $arsip->gambar = $filename;
        $arsip->keterangan = $request->keterangan;
        $arsip->tanggal = $request->tanggal;
        $arsip->lemari_id = $request->lemari_id;
        $arsip->rak_id = $request->rak_id;
        $arsip->folder_id = $request->folder_id;
        $arsip->klasifikasi_id = $request->klasifikasi_id;
        $arsip->users_id = $request->users_id;
        $arsip->status_arsip = $request->status_arsip;
        $arsip->save();

        // Redirect ke halaman daftar arsip dengan pesan sukses
        return redirect()->route(getCurrentRoutePrefix() . '.arsip.index')->with('success', 'Arsip berhasil ditambahkan.');
    }


    public function show(string $id)
    {
        $arsip = Arsip::findOrFail($id);
        return view('admin.arsip.show', compact('arsip'));
    }


    public function edit(string $id)
    {

        $klasifikasiArsips = KlasifikasiArsip::all();
        $lemaris = Lemari::all();
        $raks = Rak::all();
        $folders = Folder::all();
        $arsip = Arsip::findOrFail($id);
        return view('admin.arsip.edit', compact('arsip', 'klasifikasiArsips', 'lemaris', 'raks', 'folders'));
    }

    public function update(Request $request, string $id)
    {
        $arsip = Arsip::findOrFail($id);

        $data = $request->validate([
            'users_id' => 'required|integer',
            'nomor_berkas' => 'required|string|max:255',
            'uraian_berkas' => 'required|string|max:255',
            'jumlah' => 'required|integer',
            'keamanan_arsip' => 'required|string|max:255',
            'uraian_arsip' => 'required|string|max:255',
            'gambar' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'keterangan' => 'required|string',
            'tanggal' => 'required|date',
            'status_arsip' => 'required|string|in:masuk,keluar',
            'lemari_id' => 'required|integer',
            'rak_id' => 'required|integer',
            'folder_id' => 'required|integer',
            'klasifikasi_id' => 'required|integer',
        ]);

        // Jika ada file gambar yang diupload
        if ($request->hasFile('gambar')) {
            // Anda bisa menambahkan logika untuk menghapus gambar lama di sini jika diperlukan

            $file = $request->file('gambar');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/gambar', $filename);
            $data['gambar'] = $filename; // Menyimpan nama file ke dalam array data
        }

        $arsip->update($data);

        return redirect()->route(getCurrentRoutePrefix() . '.arsip.index')->with('success', 'Arsip berhasil diperbarui!');
    }



    public function destroy(string $id)
    {
        $arsip = Arsip::findOrFail($id);
        $arsip->delete();

        return redirect()->route(getCurrentRoutePrefix() . '.arsip.index')->with('success', 'Arsip berhasil dihapus!');
    }
}
