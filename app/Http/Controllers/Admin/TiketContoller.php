<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tiket;
use App\Models\DetailTiket;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use DateTime;

class TiketContoller extends Controller
{
    public function index() {
        return view('admin.tiket.index', [
            'tikets'    => Tiket::orderBy('created_at', 'desc')->get(),
            'dikirim'   => Tiket::where('status', 'Dikirim')->count(),
            'ditahan'   => Tiket::where('status', 'Ditahan')->count(),
            'ditolak'   => Tiket::where('status', 'Ditolak')->count(),
            'berlangsung'   => Tiket::whereNot('status', 'Ditolak')->whereNot('status', 'Selesai')->count(),
            'selesai'   => Tiket::where('status', 'Selesai')->count(),
            'komplain'   => Tiket::where('status', 'komplain')->count(),
        ]);
    }

    public function detail(Tiket $tiket) {
        return view('admin.tiket.detail', [
            'tiket'             => $tiket,
            'detailTikets'      => DetailTiket::where('tiket', $tiket->idTiket)->orderBy('created_at', 'desc')->get()
        ]);
    }

    public function detailKonfirmasi(Tiket $tiket) {
        return view('admin.tiket.detailKonfirmasi', [
            'tiket'             => $tiket,
            'detailTikets'      => DetailTiket::where('tiket', $tiket->idTiket)->orderBy('created_at', 'desc')->get()
        ]);
    }

    public function detailKonfirmasiKomplain(Tiket $tiket) {
        return view('admin.tiket.detailKonfirmasiKomplain', [
            'tiket'             => $tiket,
            'detailTikets'      => DetailTiket::where('tiket', $tiket->idTiket)->orderBy('created_at', 'desc')->get()
        ]);
    }

    public function konfirmasi(Request $request, Tiket $tiket) {
        $validatedData = $request->validate([
            'status'            => 'required',
        ]);


        Tiket::where('idTiket', $tiket->idTiket)->update($validatedData);

        $detailTiket['idDetailTiket'] =  Str::uuid();
        $detailTiket['tiket'] =  $tiket->idTiket;
        $detailTiket['status'] = $validatedData['status'];
        $detailTiket['keteranganTambahan'] = $request->keteranganTambahan;

        if ($detailTiket['status'] == "Diterima") {
            $detailTiket['ikon'] = 'check-circle';
            $detailTiket['keterangan'] = 'Sdr. '. auth()->user()->nama. ' menerima tiket (' . $request->noTiket . ').';
        } elseif ($detailTiket['status'] == "Ditahan") {
            $detailTiket['ikon'] = 'loader';
            $detailTiket['keterangan'] = 'Sdr. '. auth()->user()->nama. ' menahan tiket (' . $request->noTiket . ').';
        } else {
            $detailTiket['ikon'] = 'x-circle';
            $detailTiket['keterangan'] = 'Sdr. '. auth()->user()->nama. ' menolak tiket (' . $request->noTiket . ').';
        }
        
        DetailTiket::Create($detailTiket);

        return redirect('/admin/tiket')->with('success', 'Data tiket berhasil diperbaruhi');
    }

    public function konfirmasiKomplain(Request $request, Tiket $tiket) {
        $validatedData = $request->validate([
            'status'            => 'required',
        ]);


        Tiket::where('idTiket', $tiket->idTiket)->update($validatedData);

        $detailTiket['idDetailTiket'] =  Str::uuid();
        $detailTiket['tiket'] =  $tiket->idTiket;
        $detailTiket['status'] = $validatedData['status'];
        $detailTiket['keteranganTambahan'] = $request->keteranganTambahan;

        if ($detailTiket['status'] == "Komplain Diterima") {
            $detailTiket['ikon'] = 'check-circle';
            $detailTiket['keterangan'] = 'Sdr. '. auth()->user()->nama. ' menerima komplain tiket (' . $request->noTiket . ').';
        } elseif ($detailTiket['status'] == "Komplain Ditahan") {
            $detailTiket['ikon'] = 'loader';
            $detailTiket['keterangan'] = 'Sdr. '. auth()->user()->nama. ' menahan komplain tiket (' . $request->noTiket . ').';
        } else {
            $detailTiket['ikon'] = 'x-circle';
            $detailTiket['keterangan'] = 'Sdr. '. auth()->user()->nama. ' menolak komplain tiket (' . $request->noTiket . ').';
        }
        
        DetailTiket::Create($detailTiket);

        return redirect('/admin/tiket')->with('success', 'Data tiket berhasil diperbaruhi');
    }

    public function detailPenugasan(Tiket $tiket) {
        return view('admin.tiket.detailPenugasan', [
            'tiket'            => $tiket,
            'detailTikets'     => DetailTiket::where('tiket', $tiket->idTiket)->orderBy('created_at', 'desc')->get(),
            'teknisis'         => User::where('tipe', 'teknisi')->get()
        ]);
    }

    public function detailPenugasanKomplain(Tiket $tiket) {
        return view('admin.tiket.detailPenugasanKomplain', [
            'tiket'            => $tiket,
            'detailTikets'     => DetailTiket::where('tiket', $tiket->idTiket)->orderBy('created_at', 'desc')->get(),
            'teknisis'         => User::where('tipe', 'teknisi')->get()
        ]);
    }

    public function penugasan(Request $request, Tiket $tiket) {
        $validatedData = $request->validate([
            'status'            => 'required',
            'teknisi'           => 'required',
            'prioritas'         => 'required',
            'ekspetasiSelesai'  => 'required',
        ]);

        Tiket::where('idTiket', $tiket->idTiket)->update($validatedData);

        $detailTiket['idDetailTiket'] =  Str::uuid();
        $detailTiket['tiket'] =  $tiket->idTiket;
        $detailTiket['status'] = $validatedData['status'];
        $detailTiket['keteranganTambahan'] = $request->keteranganTambahan;

        $detailTiket['ikon'] = 'briefcase';
        $detailTiket['keterangan'] = 'Sdr. '. auth()->user()->nama. ' menugaskan teknisi untuk mengerjakan tiket (' . $request->noTiket . ').';

        
        DetailTiket::Create($detailTiket);

        return redirect('/admin/tiket')->with('success', 'Data tiket berhasil diperbaruhi');
    }


    public function penugasanKomplain(Request $request, Tiket $tiket) {
        $validatedData = $request->validate([
            'status'            => 'required',
        ]);

        Tiket::where('idTiket', $tiket->idTiket)->update($validatedData);

        $detailTiket['idDetailTiket'] =  Str::uuid();
        $detailTiket['tiket'] =  $tiket->idTiket;
        $detailTiket['status'] = $validatedData['status'];
        $detailTiket['keteranganTambahan'] = $request->keteranganTambahan;

        $detailTiket['ikon'] = 'briefcase';
        $detailTiket['keterangan'] = 'Sdr. '. auth()->user()->nama. ' menugaskan teknisi untuk mengerjakan komplain pada tiket (' . $request->noTiket . ').';

        
        DetailTiket::Create($detailTiket);

        return redirect('/admin/tiket')->with('success', 'Data tiket berhasil diperbaruhi');
    }
}
