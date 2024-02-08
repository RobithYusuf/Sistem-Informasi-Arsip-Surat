<?php

namespace App\Http\Controllers;

use App\Models\Rak;
use App\Models\User;
use App\Models\Arsip;
use App\Models\Folder;
use App\Models\Lemari;
use App\Models\Disposisi;
use Illuminate\Http\Request;
use App\Models\KlasifikasiArsip;

class LaporanController extends Controller
{

    public function index(Request $request)
    {

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $jenisArsip = $request->input('jenis_arsip');

        $arsipsMasuk = Arsip::where('jenis_arsip', 'masuk')
            ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                $query->whereBetween('tanggal_arsip', [$startDate, $endDate]);
            })
            ->get();

        $arsipsKeluar = Arsip::where('jenis_arsip', 'keluar')
            ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                $query->whereBetween('tanggal_arsip', [$startDate, $endDate]);
            })
            ->get();

        // Filter Disposisi
        $disposisis = Disposisi::with('users')
            ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                $query->whereBetween('tanggal_disposisi', [$startDate, $endDate]);
            })
            ->get();
        $users = User::whereIn('role_id', [3, 4])->get();
        return view('admin.laporan.index', compact('arsipsMasuk', 'arsipsKeluar', 'disposisis', 'users'));
    }

    public function cetak(Request $request)
    {

        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'jenis_arsip' => ['nullable', 'in:masuk,keluar'],
        ], [
            'start_date.required' => 'Cetak PDF, Tanggal awal harus diisi.',
            'start_date.date' => 'Cetak PDF, Tanggal awal harus berupa tanggal.',

            'end_date.required' => 'Cetak PDF, Tanggal akhir harus diisi.',
            'end_date.date' => 'Cetak PDF, Tanggal akhir harus berupa tanggal.',
            'end_date.after_or_equal' => 'Cetak PDF, Tanggal akhir harus setelah atau sama dengan tanggal awal.',

            'jenis_arsip.in' => 'Cetak PDF, Jenis arsip harus berupa "masuk" atau "keluar" jika diisi.',
        ]);


        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $jenisArsip = $request->input('jenis_arsip');

        // Mengambil data arsip yang statusnya bukan disposisi dan memenuhi filter tanggal serta jenis
        $arsips = Arsip::with(['klasifikasi', 'lemari', 'rak', 'folder', 'users'])
        ->where('status_arsip', '!=', 'disposisi')
        ->when($jenisArsip, function ($query) use ($jenisArsip) {
            return $query->where('jenis_arsip', $jenisArsip);
        })
        ->whereBetween('tanggal_arsip', [$startDate, $endDate])
        ->get();

    // Mengambil data disposisi yang statusnya diterima dan terkait dengan arsip yang sesuai filter
    $disposisis = Disposisi::with(['arsip' => function ($query) use ($startDate, $endDate, $jenisArsip) {
        $query->whereBetween('tanggal_arsip', [$startDate, $endDate])
            ->when($jenisArsip, function ($query) use ($jenisArsip) {
                return $query->where('jenis_arsip', $jenisArsip);
            });
    }, 'users' => function ($query) {
        $query->where('status', 'diterima');
    }])
    ->whereHas('arsip', function ($query) use ($startDate, $endDate, $jenisArsip) {
        $query->whereBetween('tanggal_arsip', [$startDate, $endDate])
            ->when($jenisArsip, function ($query) use ($jenisArsip) {
                return $query->where('jenis_arsip', $jenisArsip);
            });
    })
    ->get();

    // Menghitung total baris
    $totalArsipRows = $arsips->count();

    // Menghitung total baris untuk disposisi yang telah diterima
    // Di sini kita menghitung setiap disposisi sebagai satu baris, terlepas dari jumlah 'users' yang diterima
    $totalDisposisiRows = $disposisis->count();

    // Jumlah total baris adalah penjumlahan dari arsip dan disposisi yang diterima
    $totalRows = $totalArsipRows + $totalDisposisiRows;

        $data = [
            'arsips' => $arsips,
            'disposisis' => $disposisis,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'totalRows' => $totalRows,
            'jenisArsip' => $request->jenis_arsip,
        ];


        // Buat PDF
        $pdf = app('dompdf.wrapper');
        $pdf->setPaper('F4', 'landscape');
        $pdf->loadView('admin.laporan.cetakarsip', $data);

        return $pdf->stream('Laporan Arsip.pdf');
    }


    public function getLaporanArsip(Request $request)
    {
        $userId = $request->input('user_id');
        $tanggalAwal = $request->input('tanggal_awal');
        $tanggalAkhir = $request->input('tanggal_akhir');

        // Asumsikan Anda memiliki relasi 'arsips' di model User
        $user = User::with(['arsips' => function ($query) use ($tanggalAwal, $tanggalAkhir) {
            $query->whereBetween('tanggal_arsip', [$tanggalAwal, $tanggalAkhir]);
        }])->find($userId);

        if (!$user) {
            return response()->json(['error' => 'User tidak ditemukan'], 404);
        }

        // Hitung jumlahMasuk, jumlahKeluar, dan total
        $jumlahMasuk = $user->arsips->where('jenis_arsip', 'masuk')->count();
        $jumlahKeluar = $user->arsips->where('jenis_arsip', 'keluar')->count();
        $total = $user->arsips->count();

        return response()->json([

            'jumlahMasuk' => $jumlahMasuk,
            'jumlahKeluar' => $jumlahKeluar,
            'total' => $total
        ]);
    }
}
