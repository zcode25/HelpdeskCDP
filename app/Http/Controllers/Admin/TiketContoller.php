<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DetailTiket;
use App\Models\Tiket;
use Illuminate\Http\Request;

class TiketContoller extends Controller
{
    public function index() {
        return view('admin.tiket.index', [
            'tikets' => Tiket::all(),
        ]);
    }

    public function konfirmasi(Tiket $tiket) {
        return $tiket;
    }
}
