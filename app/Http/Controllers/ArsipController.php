<?php

namespace App\Http\Controllers;

use App\Models\Rak;
use App\Models\User;
use App\Models\Arsip;
use App\Models\Folder;
use App\Models\Lemari;
use Illuminate\Http\Request;
use App\Models\KlasifikasiArsip;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;

class ArsipController extends Controller
{

    public function index()
    {
        if (auth()->user()->hasRole('user')) { // Ambil semua arsip beserta relasi users dan data pivot
            $userId = auth()->id(); // Mendapatkan ID user yang sedang login
            // Ambil arsip yang memiliki relasi dengan user yang sedang login
            $arsips = Arsip::whereHas('users', function ($query) use ($userId) {
                $query->where('users.id', $userId);
            })->with('users')->get();
        } else {
            $arsips = Arsip::with('users')->get();
        }
        // Jika Anda ingin memisahkan berdasarkan jenis arsip (masuk/keluar), Anda bisa melakukan:
        $arsipsMasuk = $arsips->where('jenis_arsip', 'masuk');
        $arsipsKeluar = $arsips->where('jenis_arsip', 'keluar');

        return view('admin.arsip.index', compact('arsips', 'arsipsMasuk', 'arsipsKeluar'));
    }

    public function create(Request $request)
    {
        $jenis_arsip = $request->query('jenis_arsip');
        if (auth()->user()->hasRole('direktur')) {
            return redirect()->route(getCurrentRoutePrefix() . '.arsip.index')->with('error', 'Anda tidak memiliki izin untuk melakukan aksi ini.');
        }
        $klasifikasiArsips = KlasifikasiArsip::all();
        $lemaris = Lemari::all();
        $raks = Rak::all();
        $folders = Folder::all();
        $users = User::whereIn('role_id', [3, 4])->get();
        return view('admin.arsip.create', compact('jenis_arsip', 'klasifikasiArsips', 'lemaris', 'raks', 'folders', 'users'));
    }

    public function store(Request $request)
    {
        $jenisArsip = $request->input('jenis_arsip');
        // Atur validasi berdasarkan jenis arsip
        $rules = [
            'nomor_surat' => 'required|string|max:50',
            'hal' => 'required|string|max:255',
            'jumlah' => 'required|integer',
            'sifat' => 'required|in:rahasia,biasa,segera,sangat segera',
            'jenis_arsip' => 'required|in:masuk,keluar',
            'keamanan_arsip' => 'required|in:asli,fotocopy',
            'lampiran' => 'sometimes|file|mimes:jpeg,png,jpg,pdf,docx|max:2048',
            'keterangan' => 'nullable|string|max:255',
            'tanggal_arsip' => 'required|date',
            'status_arsip' => 'required|in:diproses,selesai,palsu,meragukan,disposisi',
            'klasifikasi_id' => 'required|exists:klasifikasi_arsip,id_klasifikasi_arsip',
            'lemari_id' => 'required|exists:lemari,id_lemari',
            'rak_id' => 'required|exists:rak,id_rak',
            'folder_id' => 'required|exists:folder,id_folder',
        ];

        if ($jenisArsip === 'keluar') {
            $rules['kepada'] = 'required|string|max:50';
            $rules['dari'] = 'required|array';
            $rules['dari.*'] = 'required|integer|exists:users,id';
        } else {
            $rules['dari'] = 'required|string|max:50';
            $rules['kepada'] = 'required|array';
            $rules['kepada.*'] = 'required|integer|exists:users,id';
        }

        // Lakukan validasi
        $validatedData = $request->validate($rules);

        // Jika ada file lampiran yang diupload
        $filename = null;
        if ($request->hasFile('lampiran')) {
            $file = $request->file('lampiran');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/lampiran', $filename);
        }

        // Menyimpan data ke database
        $arsip = new Arsip($validatedData);
        $arsip->lampiran = $filename;
        $arsip->jenis_arsip = $validatedData['jenis_arsip'];
        $arsip->keamanan_arsip = $validatedData['keamanan_arsip'];
        $arsip->status_arsip = $validatedData['status_arsip'];
        $arsip->klasifikasi_id = $validatedData['klasifikasi_id'];
        $arsip->lemari_id = $validatedData['lemari_id'];
        $arsip->rak_id = $validatedData['rak_id'];
        $arsip->folder_id = $validatedData['folder_id'];
        $arsip->tanggal_arsip = $validatedData['tanggal_arsip'];
        $arsip->keterangan = $validatedData['keterangan'];

        if ($jenisArsip === 'keluar') {
            $arsip->dari = $request->input('kepada');
            $arsip->save();
            $arsip->users()->attach($request->input('dari'));
        } else {
            $arsip->dari = $validatedData['dari'];
            $arsip->save();
            $arsip->users()->attach($request->input('kepada'));
        }

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
        $users = User::whereIn('role_id', [3, 4])->get();
        $selectedUsers = $arsip->users->pluck('id')->toArray();
        return view('admin.arsip.edit', compact('arsip', 'klasifikasiArsips', 'lemaris', 'raks', 'folders', 'users', 'selectedUsers'));
    }

    public function update(Request $request, $id) // $id bertipe data sesuai dengan tipe id di database
    {
        $arsip = Arsip::findOrFail($id);

        $data = $request->validate([
            'nomor_surat' => 'required|string|max:50',
            'hal' => 'required|string|max:255',
            'jumlah' => 'required|integer',
            'dari' => 'required|string|max:50',
            'kepada' => 'required|array',
            'kepada.*' => 'exists:users,id', // Pastikan setiap elemen di array ada di tabel users
            'sifat' => 'required|in:rahasia,biasa,segera,sangat segera',
            'jenis_arsip' => 'required|in:masuk,keluar',
            'keamanan_arsip' => 'required|in:asli,fotocopy',
            'lampiran' => 'sometimes|file|mimes:jpeg,png,jpg,pdf,docx|max:2048',
            'keterangan' => 'nullable|string|max:255',
            'tanggal_arsip' => 'required|date',
            'status_arsip' => 'required|in:diproses,selesai,palsu,meragukan,disposisi',
            'users_id' => 'required|exists:users,id',
            'klasifikasi_id' => 'required|exists:klasifikasi_arsip,id_klasifikasi_arsip',
            'lemari_id' => 'required|exists:lemari,id_lemari',
            'rak_id' => 'required|exists:rak,id_rak',
            'folder_id' => 'required|exists:folder,id_folder',
        ], [
            // Custom error messages
            'nomor_surat.required' => 'Nomor surat wajib diisi.',
            'nomor_surat.string' => 'Nomor surat harus berupa teks.',
            'nomor_surat.max' => 'Nomor surat tidak boleh lebih dari 50 karakter.',

            'hal.required' => 'Kolom hal harus diisi.',
            'hal.string' => 'Kolom hal harus berupa teks.',
            'hal.max' => 'Kolom hal tidak boleh lebih dari 255 karakter.',

            'jumlah.required' => 'Jumlah wajib diisi.',
            'jumlah.integer' => 'Jumlah harus berupa angka.',

            'dari.required' => 'Field Dari wajib diisi.',
            'dari.string' => 'Field Dari harus berupa teks.',
            'dari.max' => 'Field Dari tidak boleh lebih dari 50 karakter.',

            'kepada.required' => 'Field Kepada wajib diisi.',
            'kepada.array' => 'Field Kepada harus berupa array.',

            'sifat.required' => 'Sifat wajib diisi.',
            'sifat.in' => 'Sifat harus salah satu dari: rahasia, biasa, segera, sangat segera.',

            'jenis_arsip.required' => 'Jenis Arsip wajib diisi.',
            'jenis_arsip.in' => 'Jenis Arsip harus salah satu dari: masuk, keluar.',

            'keamanan_arsip.required' => 'Keamanan Arsip wajib diisi.',
            'keamanan_arsip.in' => 'Keamanan Arsip harus salah satu dari: asli, fotocopy.',

            'lampiran.required' => 'Lampiran wajib diisi.',

            'keterangan.string' => 'Keterangan harus berupa teks.',
            'keterangan.max' => 'Keterangan tidak boleh lebih dari 255 karakter.',

            'tanggal_arsip.required' => 'Tanggal Arsip wajib diisi.',
            'tanggal_arsip.date' => 'Format tanggal tidak valid.',

            'status_arsip.required' => 'Status Arsip wajib diisi.',
            'status_arsip.in' => 'Status Arsip harus salah satu dari: diproses, selesai, palsu, meragukan, disposisi.',

            'users_id.required' => 'User ID wajib diisi.',
            'users_id.exists' => 'User ID tidak valid.',

            'klasifikasi_id.required' => 'Klasifikasi ID wajib diisi.',
            'klasifikasi_id.exists' => 'Klasifikasi ID tidak valid.',

            'lemari_id.required' => 'Lemari ID wajib diisi.',
            'lemari_id.exists' => 'Lemari ID tidak valid.',

            'rak_id.required' => 'Rak ID wajib diisi.',
            'rak_id.exists' => 'Rak ID tidak valid.',

            'folder_id.required' => 'Folder ID wajib diisi.',
            'folder_id.exists' => 'Folder ID tidak valid.',
        ]);


        // Jika ada file lampiran yang diupload
        if ($request->hasFile('lampiran')) {
            // Hapus lampiran lama jika ada
            if ($arsip->lampiran) {
                Storage::delete('public/lampiran/' . $arsip->lampiran);
            }

            $file = $request->file('lampiran');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/lampiran', $filename);
            $data['lampiran'] = $filename; // Menyimpan nama file ke dalam array data
        }

        $arsip->update($data);
        // Update relasi kepada, asumsikan relasi many-to-many
        $arsip->users()->sync($request->kepada);

        return redirect()->route(getCurrentRoutePrefix() . '.arsip.index')->with('success', 'Arsip berhasil diperbarui!');
    }


    public function destroy($id)
    {

        try {
            if (auth()->user()->hasRole('direktur')) {
                return redirect()->route(getCurrentRoutePrefix() . '.disposisi.index')->with('error', 'Anda tidak memiliki izin untuk melakukan aksi ini.');
            }
            $arsip = Arsip::findOrFail($id);
            $arsip->users()->detach();
            $arsip->delete();

            return redirect()->route(getCurrentRoutePrefix() . '.arsip.index')->with('success', 'Arsip berhasil dihapus.');
        } catch (QueryException $e) {
            // Cek kode error SQL
            if ($e->getCode() == 23000) { // Kode untuk constraint violation
                return redirect()->route(getCurrentRoutePrefix() . '.arsip.index')->with('error', 'Arsip tidak dapat dihapus karena telah disposisikan.');
            }

            // Handle kesalahan lainnya
            return redirect()->route(getCurrentRoutePrefix() . '.arsip.index')->with('error', 'Terjadi kesalahan saat menghapus arsip.');
        }
    }


    public function acceptArsip($id)
    {
        $arsip = Arsip::findOrFail($id);
        $userId = auth()->id();

        // Cek status sebelumnya
        $existingStatus = $arsip->users()->where('user_id', $userId)->first();
        if ($existingStatus && $existingStatus->pivot->status !== 'perlu konfirmasi') {
            return redirect()->route(getCurrentRoutePrefix() . '.arsip.index')->with('error', 'Anda sudah mengonfirmasi status arsip ini sebelumnya.');
        }

        // Update status di tabel pivot arsip
        $arsip->users()->updateExistingPivot($userId, ['status' => 'diterima']);
        return redirect()->route(getCurrentRoutePrefix() . '.arsip.index')->with('success', 'Status arsip berhasil diubah menjadi diterima.');
    }

    public function declineArsip(Request $request, $id)
    {
        $arsip = Arsip::findOrFail($id);
        $userId = auth()->user()->id;
        $keteranganDisposisi = $request->input('keterangan_disposisi');

        // Cek status sebelumnya
        $existingStatus = $arsip->users()->where('user_id', $userId)->first();
        if ($existingStatus && $existingStatus->pivot->status !== 'perlu konfirmasi') {
            return redirect()->route(getCurrentRoutePrefix() . '.arsip.index')
                ->with('error', 'Anda sudah mengonfirmasi status arsip ini sebelumnya, hanya bisa 1x perubahan!');
        }

        // Update status dan keterangan disposisi di tabel pivot
        $arsip->users()->updateExistingPivot($userId, [
            'status' => 'disposisi',
            'disposisi_keterangan' => $keteranganDisposisi // Menyimpan keterangan
        ]);
        $arsip->update(['status_arsip' => 'disposisi']);

        return redirect()->route(getCurrentRoutePrefix() . '.arsip.index')
            ->with('success', 'Status arsip berhasil diubah menjadi disposisi dengan keterangan.');
    }

    
}
