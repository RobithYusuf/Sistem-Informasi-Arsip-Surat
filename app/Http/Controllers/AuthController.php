<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    protected function getDashboardUrl($roleName)
    {
        switch ($roleName) {
            case 'admin':
                return '/admin/dashboard';
            case 'arsiparis':
                return '/arsiparis/dashboard';
            case 'pimpinan':
                return '/pimpinan/dashboard';
            default:
                return '/test'; // URL default jika role tidak dikenali
        }
    }

    public function postLogin(Request $request)
    {

        $request->validate(
            [
                'username' => 'required',
                'password' => 'required',
            ],
            [
                'username.required' => 'Username wajib diisi',
                'password.required' => 'Password wajib diisi',
            ]
        );

        $user = User::where('username', $request->username)->first();

        // Jika username ditemukan
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $redirectUrl = $this->getDashboardUrl(auth()->user()->role->role);
            return redirect()->to($redirectUrl);
        }


        // Jika otentikasi gagal karena username, kembali ke halaman login dengan pesan kesalahan username
        return redirect()->back()->withErrors(['username' => 'Username tidak ditemukan!']);
    }


    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    public function showDashboard()
    {
        $role = auth()->user()->role;
        $menus = $role->menus; // Mengambil menu berdasarkan relasi yang telah Anda buat di model Role

        return view('dashboard', compact('menus'));
    }
}
