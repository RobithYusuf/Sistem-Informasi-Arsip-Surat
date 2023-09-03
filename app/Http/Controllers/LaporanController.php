<?php

namespace App\Http\Controllers;

use App\Models\Rak;
use App\Models\Arsip;
use App\Models\Folder;
use App\Models\Lemari;
use Illuminate\Http\Request;
use App\Models\KlasifikasiArsip;

class LaporanController extends Controller
{
    public function index()
    {
        // Di Controller Anda
        $arsipsMasuk = Arsip::where('status_arsip', 'masuk')->get();
        $arsipsKeluar = Arsip::where('status_arsip', 'keluar')->get();
        $arsips = Arsip::all();
        return view('admin.laporan.index', compact('arsips', 'arsipsMasuk', 'arsipsKeluar'));
    }

    public function cetak(Request $request)
    {

        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status_arsip' => 'nullable|in:masuk,keluar'
        ], [
            'start_date.required' => 'Waktu Mulai harus diisi.',
            'end_date.required' => 'Waktu Selesai harus diisi.',
            'end_date.date' => 'Waktu Selesai harus dalam format tanggal yang valid.',
            'end_date.after_or_equal' => 'Waktu Selesai harus setelah atau sama dengan Waktu Mulai.',
            'status_arsip.in' => 'Status Arsip harus berupa "masuk" atau "keluar".'
        ]);

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $status = $request->input('status_arsip');
        // Ambil data berdasarkan filter tanggal dan status
        $query = Arsip::whereBetween('tanggal', [$startDate, $endDate]);

        if ($status) {
            $query->where('status_arsip', $status);
        }

        $data = $query->get();

        // Hitung jumlah baris
        $totalRows = $data->count();

        // Buat PDF menggunakan DOM PDF
        $pdf = app('dompdf.wrapper');
        $pdf->setPaper('A4', 'portrait');
        $pdf = $pdf->loadView('admin.laporan.cetakarsip', compact('data', 'startDate', 'endDate', 'totalRows', 'status'));

        return $pdf->download('laporan Arsip.pdf');
    }
}
