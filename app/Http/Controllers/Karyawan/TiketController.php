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
        $detailTiket['keterangan'] = 'Tiket kamu sedang dikirim ke Admin Helpdesk';
        
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
}
