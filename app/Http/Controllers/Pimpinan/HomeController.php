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
        $status = Tiket::select( 'status', DB::raw('count(*) as total'))->groupBy('status')->orderBy('status', 'asc')->get();
        
        $label = [];
        $total = [];
        foreach($tikets as $tiket) {
            $label[] = $tiket->date;
            $total[] = $tiket->total;
        };

        $label2 = [];
        $total2 = [];
        foreach($status as $st) {
            $label2[] = $st->status;
            $total2[] = $st->total;
        };

        return view('pimpinan.home.index', [
            'label' => $label,
            'total' => $total,
            'label2' => $label2,
            'total2' => $total2,
        ]);

    }
}
