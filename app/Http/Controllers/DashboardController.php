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
        $arsipAllHariIni = Arsip::whereDate('tanggal', $today)
            ->count();
        $currentMonth = Carbon::now()->month;
        $arsipAllBulanIni = Arsip::whereMonth('tanggal', $currentMonth)
            ->count();

        $currentYear = Carbon::now()->year;
        $arsipAllTahunIni = Arsip::whereYear('tanggal', $currentYear)
            ->count();


        $arsipMasukHariIni = Arsip::where('status_arsip', 'masuk')
            ->whereDate('tanggal', $today)
            ->count();
        $currentMonth = Carbon::now()->month;
        $arsipMasukBulanIni = Arsip::where('status_arsip', 'masuk')
            ->whereMonth('tanggal', $currentMonth)
            ->count();

        $currentYear = Carbon::now()->year;
        $arsipMasukTahunIni = Arsip::where('status_arsip', 'masuk')
            ->whereYear('tanggal', $currentYear)
            ->count();


        $arsipKeluarHariIni = Arsip::where('status_arsip', 'keluar')
            ->whereDate('tanggal', $today)
            ->count();
        $currentMonth = Carbon::now()->month;
        $arsipKeluarBulanIni = Arsip::where('status_arsip', 'keluar')
            ->whereMonth('tanggal', $currentMonth)
            ->count();

        $currentYear = Carbon::now()->year;
        $arsipKeluarTahunIni = Arsip::where('status_arsip', 'keluar')
            ->whereYear('tanggal', $currentYear)
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
        $arsipAllHariIni = Arsip::whereDate('tanggal', $today)
            ->count();
        $currentMonth = Carbon::now()->month;
        $arsipAllBulanIni = Arsip::whereMonth('tanggal', $currentMonth)
            ->count();

        $currentYear = Carbon::now()->year;
        $arsipAllTahunIni = Arsip::whereYear('tanggal', $currentYear)
            ->count();


        $arsipMasukHariIni = Arsip::where('status_arsip', 'masuk')
            ->whereDate('tanggal', $today)
            ->count();
        $currentMonth = Carbon::now()->month;
        $arsipMasukBulanIni = Arsip::where('status_arsip', 'masuk')
            ->whereMonth('tanggal', $currentMonth)
            ->count();

        $currentYear = Carbon::now()->year;
        $arsipMasukTahunIni = Arsip::where('status_arsip', 'masuk')
            ->whereYear('tanggal', $currentYear)
            ->count();


        $arsipKeluarHariIni = Arsip::where('status_arsip', 'keluar')
            ->whereDate('tanggal', $today)
            ->count();
        $currentMonth = Carbon::now()->month;
        $arsipKeluarBulanIni = Arsip::where('status_arsip', 'keluar')
            ->whereMonth('tanggal', $currentMonth)
            ->count();

        $currentYear = Carbon::now()->year;
        $arsipKeluarTahunIni = Arsip::where('status_arsip', 'keluar')
            ->whereYear('tanggal', $currentYear)
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

    public function pimpinan()
    {
        $totalArsip = Arsip::count();
        $arsipMasuk = Arsip::where('status_arsip', 'masuk')->count();
        $arsipKeluar = Arsip::where('status_arsip', 'keluar')->count();

        $today = Carbon::today();
        $arsipAllHariIni = Arsip::whereDate('tanggal', $today)
            ->count();
        $currentMonth = Carbon::now()->month;
        $arsipAllBulanIni = Arsip::whereMonth('tanggal', $currentMonth)
            ->count();

        $currentYear = Carbon::now()->year;
        $arsipAllTahunIni = Arsip::whereYear('tanggal', $currentYear)
            ->count();


        $arsipMasukHariIni = Arsip::where('status_arsip', 'masuk')
            ->whereDate('tanggal', $today)
            ->count();
        $currentMonth = Carbon::now()->month;
        $arsipMasukBulanIni = Arsip::where('status_arsip', 'masuk')
            ->whereMonth('tanggal', $currentMonth)
            ->count();

        $currentYear = Carbon::now()->year;
        $arsipMasukTahunIni = Arsip::where('status_arsip', 'masuk')
            ->whereYear('tanggal', $currentYear)
            ->count();


        $arsipKeluarHariIni = Arsip::where('status_arsip', 'keluar')
            ->whereDate('tanggal', $today)
            ->count();
        $currentMonth = Carbon::now()->month;
        $arsipKeluarBulanIni = Arsip::where('status_arsip', 'keluar')
            ->whereMonth('tanggal', $currentMonth)
            ->count();

        $currentYear = Carbon::now()->year;
        $arsipKeluarTahunIni = Arsip::where('status_arsip', 'keluar')
            ->whereYear('tanggal', $currentYear)
            ->count();


        return view('pimpinan.dashboard.pimpinan', [
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
}
