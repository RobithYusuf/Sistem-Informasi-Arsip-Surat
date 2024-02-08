<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Arsip;
use App\Models\Disposisi;
use Illuminate\Http\Request;

class DisposisiController extends Controller
{

    public function getUsersForArsip($arsipId)
    {
        try {
            // Dapatkan pengguna yang telah dipilih melalui relasi arsips dan disposisis
            $selectedUsers = User::whereHas('arsips', function ($query) use ($arsipId) {
                $query->where('arsip_id', $arsipId);
            })
                ->orWhereHas('disposisis', function ($query) use ($arsipId) {
                    $query->where('arsip_id', $arsipId);
                })
                ->get();

            // Dapatkan semua pengguna dengan role_id = 4 yang belum terpilih
            $remainingUsers = User::whereIn('role_id', [3, 4])
                ->whereDoesntHave('arsips', function ($query) use ($arsipId) {
                    $query->where('arsip_id', $arsipId);
                })
                ->whereDoesntHave('disposisis', function ($query) use ($arsipId) {
                    $query->where('arsip_id', $arsipId);
                })
                ->get();

            return response()->json(['remainingUsers' => $remainingUsers, 'selectedUsers' => $selectedUsers]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Inisialisasi jumlah dengan nilai default
        $jumlahPerluKonfirmasi = 0;
        $jumlahDiterima = 0;
        $jumlahDisposisi = 0;

        $arsips = Arsip::where('status_arsip', 'disposisi')
            ->whereDoesntHave('disposisi.users', function ($query) {
                // Menyaring arsip yang tidak memiliki disposisi dengan status 'disposisi'
                $query->where('status', '!=', 'disposisi');
            })->get();

        $jumlahDisposisi = $arsips->count();
        $userId = auth()->id();

        if (auth()->user()->hasRole('user')) {
            $userId = auth()->id();

            $jumlahPerluKonfirmasi = Disposisi::whereHas('users', function ($query) use ($userId) {
                $query->where('users.id', $userId)->where('disposisi_user.status', 'perlu konfirmasi');
            })->count();

            $jumlahDiterima = Disposisi::whereHas('users', function ($query) use ($userId) {
                $query->where('users.id', $userId)->where('disposisi_user.status', 'diterima');
            })->count();

            $jumlahDisposisi = Disposisi::whereHas('users', function ($query) use ($userId) {
                $query->where('users.id', $userId)->where('disposisi_user.status', 'disposisi');
            })->count();

            $disposisis = Disposisi::whereHas('users', function ($query) use ($userId) {
                $query->where('users.id', $userId);
            })->with(['users' => function ($query) use ($userId) {
                $query->where('users.id', $userId);
            }])->get();
        } else {
            $disposisis = Disposisi::with('users')->get();
        }

        return view('admin.disposisi.index', compact('disposisis', 'jumlahDisposisi', 'jumlahPerluKonfirmasi', 'jumlahDiterima', 'jumlahDisposisi'));
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        if (auth()->user()->hasRole('user')) {
            return redirect()->route(getCurrentRoutePrefix() . '.disposisi.index')->with('error', 'Anda tidak memiliki izin untuk melakukan aksi ini.');
        }
        // Ambil arsip yang bisa didisposisikan
        $arsips = Arsip::where('status_arsip', 'disposisi')
            ->whereDoesntHave('disposisi.users', function ($query) {
                // Menyaring arsip yang tidak memiliki disposisi dengan status 'disposisi'
                $query->where('status', '!=', 'disposisi');
            })->get();

        if ($arsips->isEmpty()) {
            return redirect()->route(getCurrentRoutePrefix() . '.disposisi.index')->with('info', 'Tidak ada Arsip yang perlu disposisikan.');
        }
        $users = User::whereIn('role_id', [3, 4])->get();
        return view('admin.disposisi.create', compact('arsips', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    
    public function store(Request $request)
    {
        if (auth()->user()->hasRole('user')) {
            return redirect()->route(getCurrentRoutePrefix() . '.disposisi.index')->with('error', 'Anda tidak memiliki izin untuk melakukan aksi ini.');
        }

        // Validasi data yang masuk
        $validatedData = $request->validate([
            'arsip_id' => 'required|exists:arsip,id_arsip',

            'tanggal_disposisi' => 'required|date',
            'kepada_baru' => 'required|array|min:1',
            'kepada_baru.*' => 'required|integer|exists:users,id',
            'isi' => 'required|string',
            'catatan' => 'nullable|string',
        ], [
            'arsip_id.required' => 'Arsip harus dipilih.',
            'arsip_id.exists' => 'Arsip tidak valid atau tidak ditemukan.',

            'tanggal_disposisi.required' => 'Tanggal disposisi harus diisi.',
            'tanggal_disposisi.date' => 'Format tanggal disposisi tidak valid.',
            'kepada_baru.required' => 'Penerima harus dipilih.',
            'kepada_baru.array' => 'Data penerima tidak valid.',
            'kepada_baru.min' => 'Setidaknya satu penerima harus dipilih.',
            'kepada_baru.*.required' => 'Penerima harus dipilih.',
            'kepada_baru.*.integer' => 'Penerima tidak valid.',
            'kepada_baru.*.exists' => 'Penerima tidak ditemukan atau tidak valid.',
            'isi.required' => 'Isi disposisi harus diisi.',
            'isi.string' => 'Isi disposisi harus berupa teks.',
            'catatan.string' => 'Catatan harus berupa teks.'
        ]);


        // Membuat disposisi baru
        $disposisi = new Disposisi($validatedData);
        $disposisi->save();

        // Menyimpan relasi many-to-many dengan users dan status default
        $syncData = array_fill_keys($request->kepada_baru, ['status' => 'perlu konfirmasi']);
        $disposisi->users()->sync($syncData);

        return redirect()->route(getCurrentRoutePrefix() . '.disposisi.index')->with('success', 'Disposisi berhasil ditambahkan.');
    }



    /**
     * Display the specified resource.
     */
    // public function show(string $id)
    // {

    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_disposisi)
    {

        $disposisi = Disposisi::findOrFail($id_disposisi);
        $users = User::whereIn('role_id', [3, 4])->get();
        $selectedUsers = $disposisi->users->pluck('id')->toArray();
        return view('admin.disposisi.edit', compact('disposisi', 'selectedUsers', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $disposisi = Disposisi::findOrFail($id);

        $data = $request->validate([

            'tanggal_disposisi' => 'required|date',
            'kepada_baru' => 'required|array',
            'kepada_baru.*' => 'exists:users,id', // Pastikan ada di tabel users
            'isi' => 'required|string|max:255',
            'catatan' => 'nullable|string',
        ]);

        $disposisi->update([

            'tanggal_disposisi' => $data['tanggal_disposisi'],
            'isi' => $data['isi'],
            'catatan' => $data['catatan'],
        ]);

        $syncData = [];
        foreach ($request->input('kepada_baru') as $userId) {
            $syncData[$userId] = ['status' => $request->input('status_' . $userId)]; // status_1, status_2, dst.
        }

        $disposisi->users()->sync($syncData);

        return redirect()->route(getCurrentRoutePrefix() . '.disposisi.index')->with('success', 'Disposisi berhasil diperbarui.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_disposisi)
    {
        // Cek apakah pengguna memiliki role 'user'
        if (auth()->user()->hasRole('user')) {
            return redirect()->route(getCurrentRoutePrefix() . '.disposisi.index')->with('error', 'Anda tidak memiliki izin untuk melakukan aksi ini.');
        }

        $disposisi = Disposisi::findOrFail($id_disposisi);
        $disposisi->users()->detach();
        $disposisi->delete();
        return redirect()->route(getCurrentRoutePrefix() . '.disposisi.index')->with('success', 'Disposisi berhasil dihapus.');
    }

    public function accept($id)
    {
        $disposisi = Disposisi::findOrFail($id);
        $userId = auth()->id();

        // Cek apakah sudah ada status
        $existingStatus = $disposisi->users()->where('user_id', $userId)->first();
        if ($existingStatus && $existingStatus->pivot->status !== 'perlu konfirmasi') {
            return redirect()->route(getCurrentRoutePrefix() . '.disposisi.index')->with('error', 'Anda sudah mengonfirmasi status sebelumnya.');
        }

        // Update status di tabel pivot
        $disposisi->users()->updateExistingPivot($userId, ['status' => 'diterima']);
        return redirect()->route(getCurrentRoutePrefix() . '.disposisi.index')->with('success', 'Status berhasil diubah menjadi diterima.');
    }


    public function decline(Request $request, $id)
    {
        $disposisi = Disposisi::findOrFail($id);
        $userId = auth()->id();

        $existingStatus = $disposisi->users()->where('user_id', $userId)->first();
        if ($existingStatus && $existingStatus->pivot->status !== 'perlu konfirmasi') {
            return redirect()->route(getCurrentRoutePrefix() . '.disposisi.index')
                ->with('error', 'Anda sudah mengonfirmasi status sebelumnya, hanya bisa 1x perubahan!');
        }

        $keteranganDisposisi = $request->input('keterangan_disposisi');
        $disposisi->users()->updateExistingPivot($userId, [
            'status' => 'disposisi',
            'disposisi_keterangan' => $keteranganDisposisi
        ]);

        return redirect()->route(getCurrentRoutePrefix() . '.disposisi.index')
            ->with('success', 'Status berhasil diubah menjadi disposisi dengan keterangan.');
    }
}
