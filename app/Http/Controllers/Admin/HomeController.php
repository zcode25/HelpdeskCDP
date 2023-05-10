<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Tiket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index() {

        $tikets = Tiket::select(DB::raw("DATE_FORMAT(created_at,'%d') AS date"), DB::raw('count(*) as total'))->whereMonth('created_at', date('m'))->groupBy('date')->orderBy('date', 'asc')->get();
        
        $label = [];
        $total = [];
        foreach($tikets as $tiket) {
            $label[] = $tiket->date;
            $total[] = $tiket->total;
        };
        
        
        return view('admin.home.index', [
            'label' => $label,
            'total' => $total,
            'dikirim'   => Tiket::where('status', 'Dikirim')->count(),
        ]);

    }
}
