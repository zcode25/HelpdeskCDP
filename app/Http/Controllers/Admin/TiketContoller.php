<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tiket;
use App\Models\DetailTiket;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class TiketContoller extends Controller
{
    public function index() {
        return view('admin.tiket.index', [
            'tikets' => Tiket::all(),
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
            $detailTiket['keterangan'] = 'Tiket kamu diterima oleh Admin Helpdesk';
        } else {
            $detailTiket['ikon'] = 'x-circle';
            $detailTiket['keterangan'] = 'Tiket kamu ditolak oleh Admin Helpdesk';
        }
        
        DetailTiket::Create($detailTiket);

        return redirect('/admin/tiket')->with('success', 'Data tiket berhasil dibuat');
    }

    public function detailPenugasan(Tiket $tiket) {
        return view('admin.tiket.detailPenugasan', [
            'tiket'            => $tiket,
            'detailTikets'     => DetailTiket::where('tiket', $tiket->idTiket)->orderBy('created_at', 'desc')->get(),
            'teknisis'         => User::where('tipe', 'teknisi')->get()
        ]);
    }

    public function penugasan(Request $request, Tiket $tiket) {
        $validatedData = $request->validate([
            'status'            => 'required',
            'teknisi'            => 'required',
            'prioritas'            => 'required',
        ]);

        Tiket::where('idTiket', $tiket->idTiket)->update($validatedData);

        $detailTiket['idDetailTiket'] =  Str::uuid();
        $detailTiket['tiket'] =  $tiket->idTiket;
        $detailTiket['status'] = $validatedData['status'];
        $detailTiket['keteranganTambahan'] = $request->keteranganTambahan;

        $detailTiket['ikon'] = 'loader';
        $detailTiket['keterangan'] = 'Tiket kamu akan diproses oleh Pak '. $tiket->Teknisi->nama .', mohon untuk menunggu beberapa saat';

        
        DetailTiket::Create($detailTiket);

        return redirect('/admin/tiket')->with('success', 'Data tiket berhasil dibuat');
    }
}
