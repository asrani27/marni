<?php

namespace App\Http\Controllers;

use App\Guru;
use App\Mapel;
use App\Nilai;
use App\Siswa;
use App\Periode;
use App\PKGsiswa;
use App\Pelanggan;
use App\Pemesanan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class LaporanController extends Controller
{
    public function pelunasan()
    {
        return view('superadmin.laporan.pelunasan');
    }
    public function pelanggan()
    {
        return view('superadmin.laporan.pelanggan');
    }
    public function pemesanan()
    {
        return view('superadmin.laporan.pemesanan');
    }

    public function pelanggancetak()
    {
        $data = Pelanggan::get();
        $pdf = PDF::loadView('superadmin.laporan.pdf_pelanggan', compact('data'))->setPaper('legal');
        return $pdf->stream();
    }
    public function pemesanancetak()
    {
        $data = Pemesanan::get();
        $pdf = PDF::loadView('superadmin.laporan.pdf_pemesanan', compact('data'))->setPaper('legal');
        return $pdf->stream();
    }
    public function pelunasancetak()
    {
        $data = Pemesanan::get();
        $pdf = PDF::loadView('superadmin.laporan.pdf_pelunasan', compact('data'))->setPaper('legal');
        return $pdf->stream();
    }
}
