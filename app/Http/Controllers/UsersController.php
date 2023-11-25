<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data dari form
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:6',
            'role_id' => 'required|integer' // Pastikan ini sesuai dengan tipe data role_id di database Anda
        ]);

        // Membuat user baru
        $user = new User();
        $user->nama = $validatedData['nama'];
        $user->username = $validatedData['username'];
        $user->password = bcrypt($validatedData['password']);
        $user->role_id = $validatedData['role_id'];; // Hash password

        // Menyimpan user
        $user->save();



        return redirect()->route(getCurrentRoutePrefix() . '.users.index')->with('success', 'Users berhasil dibuat.');
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
    public function edit($id)
    {
        $roles = Role::all();
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi data dari request
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $id,
            'password' => 'nullable|string|min:6', // nullable jika tidak ingin memaksa update password
            'role_id' => 'required|integer',
        ]);

        // Mencari user berdasarkan ID
        $user = User::findOrFail($id);

        // Update data user
        $user->nama = $validatedData['nama'];
        $user->username = $validatedData['username'];

        // Update password jika ada
        if (!empty($validatedData['password'])) {
            $user->password = bcrypt($validatedData['password']);
        }

        // Update role
        $user->role_id = $validatedData['role_id'];

        // Simpan perubahan
        $user->save();

        // Redirect kembali dengan pesan sukses
        return redirect()->route(getCurrentRoutePrefix() . '.users.index')->with('success', 'User berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route(getCurrentRoutePrefix() . '.disposisi.index')->with('success', 'Disposisi berhasil dihapus.');
    }
}
