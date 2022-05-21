<?php

namespace App\Http\Controllers;

use App\PKG;
use App\Nilai;
use App\Periode;
use App\PKGmapel;
use App\PKGsiswa;
use App\Predikat;
use Illuminate\Http\Request;

class PenilaianController extends Controller
{
    public function index()
    {
        $periode = Periode::get();
        return view('superadmin.penilaian.index', compact('periode'));
    }

    public function kelas($id_periode)
    {
        $kelas = PKG::where('periode_id', $id_periode)->get();
        return view('superadmin.penilaian.kelas', compact('kelas', 'id_periode'));
    }

    public function mapel($id_periode, $id_pkg)
    {
        $mapel = PKGmapel::where('periode_kelas_guru_id', $id_pkg)->get();
        return view('superadmin.penilaian.mapel', compact('mapel', 'id_periode', 'id_pkg'));
    }

    public function nilai($id_periode, $id_pkg, $id_mapel)
    {
        $data = PKGmapel::find($id_mapel);
        $siswa = PKGsiswa::where('periode_kelas_guru_id', $id_pkg)->get();
        $siswa->map(function ($item) use ($id_periode, $id_mapel) {
            $nilai_siswa = Nilai::where('periode_id', $id_periode)->where('mapel_id', $id_mapel)->where('siswa_id', $item->siswa_id)->first();
            $item->tugas = $nilai_siswa == null ? 0 : $nilai_siswa->tugas;
            $item->uts = $nilai_siswa == null ? 0 : $nilai_siswa->uts;
            $item->uas = $nilai_siswa == null ? 0 : $nilai_siswa->uas;
            $item->na = $nilai_siswa == null ? 0 : $nilai_siswa->na;
            $item->huruf = $nilai_siswa == null ? 0 : $nilai_siswa->huruf;
            return $item;
        });

        return view('superadmin.penilaian.nilai', compact('siswa', 'id_periode', 'id_pkg', 'data', 'id_mapel'));
    }

    public function updatenilai(Request $req, $id_periode, $id_pkg, $id_mapel)
    {
        $check = Nilai::where('periode_id', $id_periode)->where('mapel_id', $id_mapel)->where('siswa_id', $req->id_siswa)->first();
        $na = ($req->tugas + $req->uts + $req->uas) / 3;

        $huruf = Predikat::get()->map(function ($item) use ($na) {
            if ($na > $item->mulai && $na < $item->sampai) {
                $item->hasil = true;
            } else {
                $item->hasil = false;
            }
            return $item;
        })->where('hasil', true)->first();

        if ($check == null) {
            $update = new Nilai;
            $update->periode_id = $id_periode;
            $update->mapel_id = $id_mapel;
            $update->kelas_id = PKG::find($id_pkg) == null ? null : PKG::find($id_pkg)->kelas_id;
            $update->guru_id = PKG::find($id_pkg) == null ? null : PKG::find($id_pkg)->guru_id;
            $update->siswa_id = $req->id_siswa;
            $update->tugas = $req->tugas;
            $update->uts = $req->uts;
            $update->uas = $req->uas;
            $update->na = $na;
            $update->huruf = $huruf == null ? null : $huruf->predikat;
            $update->save();
        } else {
            $update = $check;
            $update->tugas = $req->tugas;
            $update->uts = $req->uts;
            $update->uas = $req->uas;
            $update->na = $na;
            $update->huruf = $huruf == null ? null : $huruf->predikat;
            $update->save();
        }

        toastr()->success('berhasil Di Update');
        return back();
    }
}
