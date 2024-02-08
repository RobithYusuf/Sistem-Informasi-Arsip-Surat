<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Role;
use App\Models\User;

use App\Models\Arsip;
use App\Models\Disposisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function admin()
    {
        $totalUsers = User::count();
        $totalUsersWithUserRole = User::whereHas('role', function ($query) {
            $query->where('role', 'user'); // Pastikan 'role' adalah nama kolom yang tepat di tabel roles
        })->count();
        return view('admin.dashboard.admin', [
            'totalUsers' => $totalUsers,
            'totalUsersWithUserRole' => $totalUsersWithUserRole,
        ]);
    }

    public function arsiparis()
    {
        $totalArsip = Arsip::count();
        $arsipMasuk = Arsip::where('jenis_arsip', 'masuk')->count();
        $arsipKeluar = Arsip::where('jenis_arsip', 'keluar')->count();
        $disposisiAll = Disposisi::count();

        $today = Carbon::today();
        $arsipAllHariIni = Arsip::whereDate('tanggal_arsip', $today)
            ->count();
        $currentMonth = Carbon::now()->month;
        $arsipAllBulanIni = Arsip::whereMonth('tanggal_arsip', $currentMonth)
            ->count();

        $currentYear = Carbon::now()->year;
        $arsipAllTahunIni = Arsip::whereYear('tanggal_arsip', $currentYear)
            ->count();


        $arsipMasukHariIni = Arsip::where('jenis_arsip', 'masuk')
            ->whereDate('tanggal_arsip', $today)
            ->count();
        $currentMonth = Carbon::now()->month;
        $arsipMasukBulanIni = Arsip::where('jenis_arsip', 'masuk')
            ->whereMonth('tanggal_arsip', $currentMonth)
            ->count();

        $currentYear = Carbon::now()->year;
        $arsipMasukTahunIni = Arsip::where('jenis_arsip', 'masuk')
            ->whereYear('tanggal_arsip', $currentYear)
            ->count();


        $arsipKeluarHariIni = Arsip::where('jenis_arsip', 'keluar')
            ->whereDate('tanggal_arsip', $today)
            ->count();
        $currentMonth = Carbon::now()->month;
        $arsipKeluarBulanIni = Arsip::where('jenis_arsip', 'keluar')
            ->whereMonth('tanggal_arsip', $currentMonth)
            ->count();

        $currentYear = Carbon::now()->year;
        $arsipKeluarTahunIni = Arsip::where('jenis_arsip', 'keluar')
            ->whereYear('tanggal_arsip', $currentYear)
            ->count();


        return view('arsiparis.dashboard.arsiparis', [
            'disposisiAll' => $disposisiAll,
            'totalArsip' => $totalArsip,
            'arsipMasuk' => $arsipMasuk,
            'arsipKeluar' => $arsipKeluar,
            'arsipAllHariIni' => $arsipAllHariIni,
            'arsipAllBulanIni' => $arsipAllBulanIni,
            'arsipAllTahunIni' => $arsipAllTahunIni,
            'arsipMasukHariIni' => $arsipMasukHariIni,
            'arsipMasukBulanIni' => $arsipMasukBulanIni,
            'arsipMasukTahunIni' => $arsipMasukTahunIni,
            'arsipKeluarHariIni' => $arsipKeluarHariIni,
            'arsipKeluarBulanIni' => $arsipKeluarBulanIni,
            'arsipKeluarTahunIni' => $arsipKeluarTahunIni,
        ]);
    }

    public function direktur()
    {
        $totalArsip = Arsip::count();
        $arsipMasuk = Arsip::where('jenis_arsip', 'masuk')->count();
        $arsipKeluar = Arsip::where('jenis_arsip', 'keluar')->count();

        $today = Carbon::today();
        $arsipAllHariIni = Arsip::whereDate('tanggal_arsip', $today)
            ->count();
        $currentMonth = Carbon::now()->month;
        $arsipAllBulanIni = Arsip::whereMonth('tanggal_arsip', $currentMonth)
            ->count();

        $currentYear = Carbon::now()->year;
        $arsipAllTahunIni = Arsip::whereYear('tanggal_arsip', $currentYear)
            ->count();


        $arsipMasukHariIni = Arsip::where('jenis_arsip', 'masuk')
            ->whereDate('tanggal_arsip', $today)
            ->count();
        $currentMonth = Carbon::now()->month;
        $arsipMasukBulanIni = Arsip::where('jenis_arsip', 'masuk')
            ->whereMonth('tanggal_arsip', $currentMonth)
            ->count();

        $currentYear = Carbon::now()->year;
        $arsipMasukTahunIni = Arsip::where('jenis_arsip', 'masuk')
            ->whereYear('tanggal_arsip', $currentYear)
            ->count();


        $arsipKeluarHariIni = Arsip::where('jenis_arsip', 'keluar')
            ->whereDate('tanggal_arsip', $today)
            ->count();
        $currentMonth = Carbon::now()->month;
        $arsipKeluarBulanIni = Arsip::where('jenis_arsip', 'keluar')
            ->whereMonth('tanggal_arsip', $currentMonth)
            ->count();

        $currentYear = Carbon::now()->year;
        $arsipKeluarTahunIni = Arsip::where('jenis_arsip', 'keluar')
            ->whereYear('tanggal_arsip', $currentYear)
            ->count();


        return view('direktur.dashboard.direktur', [
            'totalArsip' => $totalArsip,
            'arsipMasuk' => $arsipMasuk,
            'arsipKeluar' => $arsipKeluar,
            'arsipAllHariIni' => $arsipAllHariIni,
            'arsipAllBulanIni' => $arsipAllBulanIni,
            'arsipAllTahunIni' => $arsipAllTahunIni,
            'arsipMasukHariIni' => $arsipMasukHariIni,
            'arsipMasukBulanIni' => $arsipMasukBulanIni,
            'arsipMasukTahunIni' => $arsipMasukTahunIni,
            'arsipKeluarHariIni' => $arsipKeluarHariIni,
            'arsipKeluarBulanIni' => $arsipKeluarBulanIni,
            'arsipKeluarTahunIni' => $arsipKeluarTahunIni,
        ]);
    }

    public function user()
    {
        $userId = Auth::id();

        // Menggunakan relasi belongsToMany
        $totalArsip = Arsip::whereHas('users', function ($query) use ($userId) {
            $query->where('users.id', $userId);
        })->count();

        // Hitung jumlah disposisi yang terkait dengan pengguna yang login
        $totalDisposisi = Disposisi::whereHas('users', function ($query) use ($userId) {
            $query->where('users.id', $userId);
        })->count();

        return view('user.dashboard.user', compact('totalArsip', 'totalDisposisi'));
    }
}
