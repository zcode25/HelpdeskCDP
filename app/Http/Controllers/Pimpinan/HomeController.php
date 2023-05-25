<?php

namespace App\Http\Controllers\Pimpinan;

use App\Http\Controllers\Controller;
use App\Models\Tiket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index() {

        $tikets = Tiket::select( DB::raw("DATE_FORMAT(created_at,'%d') AS date"), DB::raw('count(*) as total'))->whereMonth('created_at', date('m'))->groupBy('date')->orderBy('date', 'asc')->get();

        $label = [];
        $total = [];
        foreach($tikets as $tiket) {
            $label[] = $tiket->date;
            $total[] = $tiket->total;
        };

        return view('pimpinan.home.index', [
            'label' => $label,
            'total' => $total,
        ]);

    }
}
