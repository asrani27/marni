<?php

namespace App\Http\Controllers;

use App\PKG;
use App\Guru;
use App\Kelas;
use App\Mapel;
use App\Paket;
use App\Siswa;
use App\Periode;
use App\PKGmapel;
use App\PKGsiswa;
use App\Predikat;
use App\Keranjang;
use App\Pelanggan;
use App\Pemesanan;
use App\PemesananDetail;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class SuperadminController extends Controller
{
    public function beranda()
    {
        $t = Pemesanan::get()->count();
        $p = Paket::get()->count();
        $bl = Pemesanan::where('sisa', '!=', 0)->get()->count();
        return view('superadmin.beranda', compact('t', 'p', 'bl'));
    }

    public function paket()
    {
        $data = Paket::orderBy('id', 'DESC')->get();
        return view('superadmin.paket.index', compact('data'));
    }
    public function paketcreate()
    {
        return view('superadmin.paket.create');
    }
    public function paketstore(Request $req)
    {
        $attr = $req->all();

        $check = Paket::where('nama', $req->nama)->first();
        if ($check == null) {
            Paket::create($attr);
            toastr()->success('Berhasil disimpan');
            return redirect('/paket');
        } else {
            toastr()->error('Sudah Ada');
            return back();
        }
    }
    public function paketedit($id)
    {
        $data = Paket::find($id);
        return view('superadmin.paket.edit', compact('data'));
    }
    public function paketupdate(Request $req, $id)
    {
        $attr = $req->all();
        $check = Paket::where('nama', $req->nama)->first();
        if ($check == null) {
            //simpan
            Paket::find($id)->update($attr);
            toastr()->success('Berhasil disimpan');
            return redirect('/paket');
        } else {
            if ($id == $check->id) {
                Paket::find($id)->update($attr);
                toastr()->success('Berhasil diupdate');
                return redirect('/paket');
            } else {
                toastr()->error('Sudah ada');
                return back();
            }
        }
    }
    public function paketdelete($id)
    {
        Paket::find($id)->delete();
        toastr()->success('Berhasil dihapus');
        return back();
    }


    public function pelanggan()
    {
        $data = Pelanggan::orderBy('id', 'DESC')->get();
        return view('superadmin.pelanggan.index', compact('data'));
    }
    public function pelanggancreate()
    {
        return view('superadmin.pelanggan.create');
    }
    public function pelangganstore(Request $req)
    {
        $attr = $req->all();

        $check = Pelanggan::where('nik', $req->nik)->first();
        if ($check == null) {
            Pelanggan::create($attr);
            toastr()->success('Berhasil disimpan');
            return redirect('/pelanggan');
        } else {
            toastr()->error('Sudah Ada');
            return back();
        }
    }
    public function pelangganedit($id)
    {
        $data = Pelanggan::find($id);
        return view('superadmin.pelanggan.edit', compact('data'));
    }
    public function pelangganupdate(Request $req, $id)
    {
        $attr = $req->all();
        $check = Pelanggan::where('nik', $req->nik)->first();
        if ($check == null) {
            //simpan
            Pelanggan::find($id)->update($attr);
            toastr()->success('Berhasil disimpan');
            return redirect('/pelanggan');
        } else {
            if ($id == $check->id) {
                Pelanggan::find($id)->update($attr);
                toastr()->success('Berhasil diupdate');
                return redirect('/pelanggan');
            } else {
                toastr()->error('Sudah ada');
                return back();
            }
        }
    }
    public function pelanggandelete($id)
    {
        Pelanggan::find($id)->delete();
        toastr()->success('Berhasil dihapus');
        return back();
    }

    public function pemesanan()
    {
        $data = Pemesanan::orderBy('id', 'DESC')->get();
        return view('superadmin.pemesanan.index', compact('data'));
    }

    public function pelunasan()
    {
        $data = Pemesanan::orderBy('id', 'DESC')->get();
        return view('superadmin.pelunasan.index', compact('data'));
    }
    public function pemesanancreate()
    {
        $pelanggan = Pelanggan::all();
        $paket = Paket::all();
        $check = Pemesanan::all();
        $keranjang = Keranjang::all();
        if (count($check) == 0) {
            $kode = '0001';
        } else {
            $number = count($check) + 1;
            if (strlen($number) == 1) {
                $kode = '000' . $number;
            } elseif (strlen($number) == 2) {
                $kode = '00' . $number;
            } elseif (strlen($number) == 3) {
                $kode = '0' . $number;
            } elseif (strlen($number) == 4) {
                $kode = $number;
            }
        }
        // $keranjang = Keranjang::where('type', 'penjualan')->get()->map(function ($item) {
        //     $item->subtotal = $item->jumlah * $item->barang->harga_jual;
        //     return $item;
        // });
        return view('superadmin.pemesanan.create', compact('kode', 'pelanggan', 'paket', 'keranjang'));
    }

    public function pelunasanbayar($id)
    {
        $pelanggan = Pelanggan::all();
        $data = Pemesanan::find($id);

        return view('superadmin.pelunasan.create', compact('data', 'pelanggan'));
    }

    public function simpanpelunasanbayar(Request $req, $id)
    {
        $data = Pemesanan::find($id);

        Pemesanan::find($id)->update([
            'sisa' => 0,
            'bayar_sisa' => $data->sisa,
        ]);
        toastr()->success('Bayar Pelunasan Berhasil');
        return redirect('/pelunasan');
    }
    public function pemesananstore(Request $req)
    {
        if ($req->button == 'keranjang') {
            if ($req->paket_id == null) {
                toastr()->error('Pilih Paket');
                $req->flash();
                return back();
            }
            $s = new Keranjang;
            $s->paket_id = $req->paket_id;
            $s->harga = Paket::find($req->paket_id)->harga;
            $s->save();
            $req->flash();
            return back();
        } else {
            if ($req->pelanggan_id == null) {
                toastr()->error('Pilih Pelanggan');
                $req->flash();
                return back();
            }

            if ($req->dp == null || $req->dp == 0) {
                toastr()->error('DP/uang muka harus di isi');
                $req->flash();
                return back();
            }

            $keranjang = Keranjang::get();

            if ($keranjang->count() == 0) {
                toastr()->error('keranjang Pesanan Kosong');
                $req->flash();
                return back();
            }

            if ($req->dp > $req->total) {
                toastr()->error('DP tidak bisa lebih dari total');
                $req->flash();
                return back();
            }


            $n = new Pemesanan;
            $n->pelanggan_id = $req->pelanggan_id;
            $n->tgl_pemesanan = $req->tgl_pemesanan;
            $n->tgl_acara = $req->tgl_pemesanan;
            $n->tgl_pelunasan = $req->tgl_pelunasan;
            $n->total = $req->total;
            $n->nota = $req->nota;
            $n->dp = $req->dp;
            $n->sisa = $req->total - $req->dp;
            $n->save();

            foreach ($keranjang as $item) {
                $pd = new PemesananDetail;
                $pd->pemesanan_id = $n->id;
                $pd->paket_id = $item->paket_id;
                $pd->harga = $item->harga;
                $pd->save();

                $item->delete();
            }
        }
        toastr()->success('Transaksi Berhasil disimpan');
        return redirect('/pemesanan');
    }

    public function pemesananbatal()
    {
        $keranjang = Keranjang::get();
        foreach ($keranjang as $item) {
            $item->delete();
        }
        toastr()->success('Pesananan Di batalkan');
        return back();
    }

    public function pemesanandelete($id)
    {
        Pemesanan::find($id)->delete();
        toastr()->success('Berhasil dihapus');
        return back();
    }
    public function keranjangdelete($id)
    {
        Keranjang::find($id)->delete();
        toastr()->success('Berhasil dihapus');
        return back();
    }

    public function pemesananprint($id)
    {
        $data = Pemesanan::find($id);
        $pdf = PDF::loadView('superadmin.pemesanan.nota', compact('data'))->setPaper('legal');
        return $pdf->stream();
    }

    public function pelunasanprint($id)
    {
        $data = Pemesanan::find($id);
        $pdf = PDF::loadView('superadmin.pelunasan.nota', compact('data'))->setPaper('legal');
        return $pdf->stream();
    }
    // public function laporan()
    // {
    //     return view('superadmin.laporan.index');
    // }

    // public function cetakHakim()
    // {
    //     $data = Hakim::get();
    //     $pdf = PDF::loadView('superadmin.laporan.pdf_hakim', compact('data'))->setPaper('legal');
    //     return $pdf->stream();
    // }
    // public function cetakJaksa()
    // {
    //     $data = Jaksa::get();
    //     $pdf = PDF::loadView('superadmin.laporan.pdf_jaksa', compact('data'))->setPaper('legal');
    //     return $pdf->stream();
    // }
    // public function cetakPanitera()
    // {
    //     $data = Panitera::get();
    //     $pdf = PDF::loadView('superadmin.laporan.pdf_panitera', compact('data'))->setPaper('legal');
    //     return $pdf->stream();
    // }
    // public function cetakDataPidana()
    // {
    //     $data = Perkara::where('jenis_perkara', 1)->get();
    //     $pdf = PDF::loadView('superadmin.laporan.pidana', compact('data'))->setPaper('legal');
    //     return $pdf->stream();
    // }
    // public function cetakDataPerdata()
    // {
    //     $data = Perkara::where('jenis_perkara', 2)->get();
    //     $pdf = PDF::loadView('superadmin.laporan.perdata', compact('data'))->setPaper('legal');
    //     return $pdf->stream();
    // }
    // public function cetakDataTipikor()
    // {
    //     $data = Perkara::where('jenis_perkara', 3)->get();
    //     $pdf = PDF::loadView('superadmin.laporan.tipikor', compact('data'))->setPaper('legal');
    //     return $pdf->stream();
    // }
    // public function cetakDataPhi()
    // {
    //     $data = Perkara::where('jenis_perkara', 4)->get();
    //     $pdf = PDF::loadView('superadmin.laporan.phi', compact('data'))->setPaper('legal');
    //     return $pdf->stream();
    // }


    // public function cetaksidangPidana()
    // {
    //     $data = Sidang::where('jenis_perkara', 1)->get();
    //     $pdf = PDF::loadView('superadmin.laporan.sidang_pidana', compact('data'))->setPaper('legal');
    //     return $pdf->stream();
    // }
    // public function cetaksidangPerdata()
    // {
    //     $data = Sidang::where('jenis_perkara', 2)->get();
    //     $pdf = PDF::loadView('superadmin.laporan.sidang_perdata', compact('data'))->setPaper('legal');
    //     return $pdf->stream();
    // }
    // public function cetaksidangTipikor()
    // {
    //     $data = Sidang::where('jenis_perkara', 3)->get();
    //     $pdf = PDF::loadView('superadmin.laporan.sidang_tipikor', compact('data'))->setPaper('legal');
    //     return $pdf->stream();
    // }
    // public function cetaksidangPhi()
    // {
    //     $data = Sidang::where('jenis_perkara', 4)->get();
    //     $pdf = PDF::loadView('superadmin.laporan.sidang_phi', compact('data'))->setPaper('legal');
    //     return $pdf->stream();
    // }
}
