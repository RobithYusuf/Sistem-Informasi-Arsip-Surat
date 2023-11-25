<?php

namespace App\Http\Controllers;

use App\Models\Arsip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;

class DashboardController extends Controller
{
    public function admin()
    {
        $totalArsip = Arsip::count();
        $arsipMasuk = Arsip::where('status_arsip', 'masuk')->count();
        $arsipKeluar = Arsip::where('status_arsip', 'keluar')->count();

        $today = Carbon::today();
        $arsipAllHariIni = Arsip::whereDate('tanggal_arsip', $today)
            ->count();
        $currentMonth = Carbon::now()->month;
        $arsipAllBulanIni = Arsip::whereMonth('tanggal_arsip', $currentMonth)
            ->count();

        $currentYear = Carbon::now()->year;
        $arsipAllTahunIni = Arsip::whereYear('tanggal_arsip', $currentYear)
            ->count();


        $arsipMasukHariIni = Arsip::where('status_arsip', 'masuk')
            ->whereDate('tanggal_arsip', $today)
            ->count();
        $currentMonth = Carbon::now()->month;
        $arsipMasukBulanIni = Arsip::where('status_arsip', 'masuk')
            ->whereMonth('tanggal_arsip', $currentMonth)
            ->count();

        $currentYear = Carbon::now()->year;
        $arsipMasukTahunIni = Arsip::where('status_arsip', 'masuk')
            ->whereYear('tanggal_arsip', $currentYear)
            ->count();


        $arsipKeluarHariIni = Arsip::where('status_arsip', 'keluar')
            ->whereDate('tanggal_arsip', $today)
            ->count();
        $currentMonth = Carbon::now()->month;
        $arsipKeluarBulanIni = Arsip::where('status_arsip', 'keluar')
            ->whereMonth('tanggal_arsip', $currentMonth)
            ->count();

        $currentYear = Carbon::now()->year;
        $arsipKeluarTahunIni = Arsip::where('status_arsip', 'keluar')
            ->whereYear('tanggal_arsip', $currentYear)
            ->count();


        return view('admin.dashboard.admin', [
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

    public function arsiparis()
    {
        $totalArsip = Arsip::count();
        $arsipMasuk = Arsip::where('status_arsip', 'masuk')->count();
        $arsipKeluar = Arsip::where('status_arsip', 'keluar')->count();

        $today = Carbon::today();
        $arsipAllHariIni = Arsip::whereDate('tanggal_arsip', $today)
            ->count();
        $currentMonth = Carbon::now()->month;
        $arsipAllBulanIni = Arsip::whereMonth('tanggal_arsip', $currentMonth)
            ->count();

        $currentYear = Carbon::now()->year;
        $arsipAllTahunIni = Arsip::whereYear('tanggal_arsip', $currentYear)
            ->count();


        $arsipMasukHariIni = Arsip::where('status_arsip', 'masuk')
            ->whereDate('tanggal_arsip', $today)
            ->count();
        $currentMonth = Carbon::now()->month;
        $arsipMasukBulanIni = Arsip::where('status_arsip', 'masuk')
            ->whereMonth('tanggal_arsip', $currentMonth)
            ->count();

        $currentYear = Carbon::now()->year;
        $arsipMasukTahunIni = Arsip::where('status_arsip', 'masuk')
            ->whereYear('tanggal_arsip', $currentYear)
            ->count();


        $arsipKeluarHariIni = Arsip::where('status_arsip', 'keluar')
            ->whereDate('tanggal_arsip', $today)
            ->count();
        $currentMonth = Carbon::now()->month;
        $arsipKeluarBulanIni = Arsip::where('status_arsip', 'keluar')
            ->whereMonth('tanggal_arsip', $currentMonth)
            ->count();

        $currentYear = Carbon::now()->year;
        $arsipKeluarTahunIni = Arsip::where('status_arsip', 'keluar')
            ->whereYear('tanggal_arsip', $currentYear)
            ->count();


        return view('arsiparis.dashboard.arsiparis', [
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
        $arsipMasuk = Arsip::where('status_arsip', 'masuk')->count();
        $arsipKeluar = Arsip::where('status_arsip', 'keluar')->count();

        $today = Carbon::today();
        $arsipAllHariIni = Arsip::whereDate('tanggal_arsip', $today)
            ->count();
        $currentMonth = Carbon::now()->month;
        $arsipAllBulanIni = Arsip::whereMonth('tanggal_arsip', $currentMonth)
            ->count();

        $currentYear = Carbon::now()->year;
        $arsipAllTahunIni = Arsip::whereYear('tanggal_arsip', $currentYear)
            ->count();


        $arsipMasukHariIni = Arsip::where('status_arsip', 'masuk')
            ->whereDate('tanggal_arsip', $today)
            ->count();
        $currentMonth = Carbon::now()->month;
        $arsipMasukBulanIni = Arsip::where('status_arsip', 'masuk')
            ->whereMonth('tanggal_arsip', $currentMonth)
            ->count();

        $currentYear = Carbon::now()->year;
        $arsipMasukTahunIni = Arsip::where('status_arsip', 'masuk')
            ->whereYear('tanggal_arsip', $currentYear)
            ->count();


        $arsipKeluarHariIni = Arsip::where('status_arsip', 'keluar')
            ->whereDate('tanggal_arsip', $today)
            ->count();
        $currentMonth = Carbon::now()->month;
        $arsipKeluarBulanIni = Arsip::where('status_arsip', 'keluar')
            ->whereMonth('tanggal_arsip', $currentMonth)
            ->count();

        $currentYear = Carbon::now()->year;
        $arsipKeluarTahunIni = Arsip::where('status_arsip', 'keluar')
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
        return view('user.dashboard.user');
    }
}
