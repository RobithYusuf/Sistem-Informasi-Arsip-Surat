<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Arsip;
use App\Models\Disposisi;
use Illuminate\Http\Request;

class DisposisiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $arsips = Arsip::where('status_arsip', 'disposisi')
        ->whereDoesntHave('disposisi', function ($query) {
            $query->where('status_disposisi', '!=', 'berhalangan');
        })->get();

    $jumlahDisposisi = $arsips->count();
        $disposisis = Disposisi::with('users')->get();
        return view('admin.disposisi.index', compact('disposisis','jumlahDisposisi'));
    }

    /**
     * Show the form for creating a new resource.
     */


    public function create()
    {
        // Ambil arsip yang bisa didisposisikan
        $arsips = Arsip::where('status_arsip', 'disposisi')
            ->whereDoesntHave('disposisi', function ($query) {
                $query->where('status_disposisi', '!=', 'berhalangan');
            })->get();

        if ($arsips->isEmpty()) {
            return redirect()->route(getCurrentRoutePrefix() . '.disposisi.index')->with('info', 'Tidak ada Arsip yang perlu disposisikan.');
        }
        $users = User::where('role_id', '4')->get();
        return view('admin.disposisi.create', compact('arsips', 'users'));
    }


    /**
     * Store a newly created resource in storage.
     */


    public function store(Request $request)
    {
        // Validasi data yang masuk
        $validatedData = $request->validate([
            // validasi lainnya...
            'arsip_id' => 'required|exists:arsip,id_arsip',
            'hal' => 'required|string|max:255',
            'tanggal_disposisi' => 'required|date',
            'kepada_baru.*' => 'required|integer|exists:users,id',
            'isi' => 'required|string',
            'catatan' => 'nullable|string',
        ]);

        // Membuat disposisi baru
        $disposisi = new Disposisi();
        $disposisi->fill($validatedData);
        $disposisi->save();

        // Menyimpan relasi many-to-many dengan users
        $disposisi->users()->attach($request->kepada_baru);

        return redirect()->route(getCurrentRoutePrefix() . '.disposisi.index')->with('success', 'Disposisi berhasil ditambahkan.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_disposisi)
    {
        $disposisi = Disposisi::findOrFail($id_disposisi);
        $users = User::all();
        $selectedUsers = $disposisi->users->pluck('id')->toArray();
        return view('admin.disposisi.edit', compact('disposisi','selectedUsers','users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_disposisi)
    {
        $disposisi = Disposisi::findOrFail($id_disposisi);
        $disposisi->delete();
        return redirect()->route(getCurrentRoutePrefix() . '.disposisi.index')->with('success', 'Disposisi berhasil dihapus.');
    }
}
