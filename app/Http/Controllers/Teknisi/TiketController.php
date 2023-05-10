<?php

namespace App\Http\Controllers\Teknisi;

use App\Models\User;
use App\Models\Tiket;
use App\Models\DetailTiket;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;

class TiketController extends Controller
{
    public function index() {
        return view('teknisi.tiket.index', [
            'tikets' => Tiket::where('teknisi', auth()->user()->nik)->orderBy('created_at', 'desc')->get(),
        ]);
    }

    public function detail(Tiket $tiket) {
        return view('teknisi.tiket.detail', [
            'tiket'             => $tiket,
            'detailTikets'      => DetailTiket::where('tiket', $tiket->idTiket)->orderBy('created_at', 'desc')->get()
        ]);
    }

    public function detailPenugasan(Tiket $tiket) {
        return view('teknisi.tiket.detailPenugasan', [
            'tiket'            => $tiket,
            'detailTikets'     => DetailTiket::where('tiket', $tiket->idTiket)->orderBy('created_at', 'desc')->get(),
            'teknisis'         => User::where('tipe', 'teknisi')->get()
        ]);
    }

    public function penugasan(Request $request, Tiket $tiket) {
        $validatedData = $request->validate([
            'status'            => 'required',
        ]);


        Tiket::where('idTiket', $tiket->idTiket)->update($validatedData);

        $detailTiket['idDetailTiket'] =  Str::uuid();
        $detailTiket['tiket'] =  $tiket->idTiket;
        $detailTiket['status'] = $validatedData['status'];
        $detailTiket['keteranganTambahan'] = $request->keteranganTambahan;

        $detailTiket['ikon'] = 'navigation';
        $detailTiket['keterangan'] = 'Sdr. '. auth()->user()->nama. ' mengerjakan tiket (' . $request->noTiket . ').';
        
        DetailTiket::Create($detailTiket);

        return redirect('/teknisi/tiket')->with('success', 'Data tiket berhasil diperbaruhi');
    }

    public function suratPenugasan(Tiket $tiket) {
	    $data = [
	            'tiket' => $tiket
	    ];

        $pdf = Pdf::loadView('teknisi.tiket.suratPenugasan', $data);
        return $pdf->stream('suratPenugasan.pdf');
    }

    public function detailValidasi(Tiket $tiket) {
        return view('teknisi.tiket.detailValidasi', [
            'tiket'            => $tiket,
            'detailTikets'     => DetailTiket::where('tiket', $tiket->idTiket)->orderBy('created_at', 'desc')->get(),
            'teknisis'         => User::where('tipe', 'teknisi')->get()
        ]);
    }

    public function validasi(Request $request, Tiket $tiket) {
        $validatedData = $request->validate([
            'status'            => 'required',
        ]);


        Tiket::where('idTiket', $tiket->idTiket)->update($validatedData);

        $detailTiket['idDetailTiket'] =  Str::uuid();
        $detailTiket['tiket'] =  $tiket->idTiket;
        $detailTiket['status'] = $validatedData['status'];
        $detailTiket['keteranganTambahan'] = $request->keteranganTambahan;

        $detailTiket['ikon'] = 'zap';
        $detailTiket['keterangan'] = 'Sdr. '. auth()->user()->nama. ' telah mengerjakan tiket (' . $request->noTiket . '), Mohon untuk divalidasi oleh user.';
        
        DetailTiket::Create($detailTiket);

        return redirect('/teknisi/tiket')->with('success', 'Data tiket berhasil diperbaruhi');
    }
}
