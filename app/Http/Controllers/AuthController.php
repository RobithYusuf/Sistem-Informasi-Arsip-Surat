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
            case 'direktur':
                return '/direktur/dashboard';
            case 'user':
                return '/user/dashboard';
            default:
                return '/home'; // URL default jika role tidak dikenali
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

        // Jika username tidak ditemukan
        if (!$user) {
            return redirect()->back()->withErrors(['username' => 'Username tidak ditemukan!']);
        }

        // Jika username ditemukan, tetapi password salah
        if (!Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            return redirect()->back()->withErrors(['password' => 'Password salah!']);
        }

        // Jika otentikasi berhasil
        $redirectUrl = $this->getDashboardUrl(auth()->user()->role->role);
        return redirect()->to($redirectUrl);
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
