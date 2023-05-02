<?php

namespace App\Http\Controllers\Karyawan;

use App\Models\Tiket;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DetailTiket;

class TiketController extends Controller
{
    public function index() {
        return view('karyawan.tiket.index', [
            'tikets' => Tiket::where('user', auth()->user()->nik)->orderBy('created_at', 'desc')->get(),
        ]);
    }

    public function create() {
        return view('karyawan.tiket.create');
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'noTiket'               => 'required',
            'permintaan'            => 'required',
            'uraianPermintaan'      => 'required',
        ]);

        $validatedData['idTiket'] = Str::uuid();
        $validatedData['user'] = auth()->user()->nik;
        $validatedData['status'] = 'Dikirim';


        Tiket::Create($validatedData);
        
        $detailTiket['idDetailTiket'] =  Str::uuid();
        $detailTiket['tiket'] =  $validatedData['idTiket'];
        $detailTiket['status'] = $validatedData['status'];
        $detailTiket['ikon'] = 'mail';
        $detailTiket['keterangan'] = 'Sdr. '. auth()->user()->nama. ' mengirim tiket (' . $request->noTiket . ').';
        
        DetailTiket::Create($detailTiket);

        return redirect('/karyawan/tiket')->with('success', 'Data tiket berhasil dibuat');
    }

    public function detail(Tiket $tiket) {
        // $test = DetailTiket::where('tiket', $tiket->idTiket)->get();
        
        // dd($test);

        return view('karyawan.tiket.detail', [
            'tiket'            => $tiket,
            'detailTikets'     => DetailTiket::where('tiket', $tiket->idTiket)->orderBy('created_at', 'desc')->get()
        ]);
    }

    public function detailValidasi(Tiket $tiket) {

        return view('karyawan.tiket.detailValidasi', [
            'tiket'            => $tiket,
            'detailTikets'     => DetailTiket::where('tiket', $tiket->idTiket)->orderBy('created_at', 'desc')->get()
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

        if ($detailTiket['status'] == "Selesai") {
            $detailTiket['ikon'] = 'check-circle';
            $detailTiket['keterangan'] = 'Sdr. '. auth()->user()->nama. ' menerima validasi dan tiket (' . $request->noTiket . ') selesai.';
        } else {
            $detailTiket['ikon'] = 'alert-circle';
            $detailTiket['keterangan'] = 'Sdr. '. auth()->user()->nama. ' komplain pada tiket (' . $request->noTiket . '), Mohon untuk dicek kembali oleh teknisi.';
        }
        
        DetailTiket::Create($detailTiket);

        return redirect('/karyawan/tiket')->with('success', 'Data tiket berhasil diperbaruhi');
    }


}
