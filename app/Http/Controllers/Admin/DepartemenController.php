<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Departemen;
use Illuminate\Http\Request;

class DepartemenController extends Controller
{
    public function index() {
        return view('admin.departemen.index', [
            'departemens'  => Departemen::all()
        ]);
    }
}
