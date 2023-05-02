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

    public function create() {
        return view('admin.departemen.create');
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'kodeDepartemen'   => 'required',
            'namaDepartemen'   => 'required|max:50',
        ]);

        Departemen::create($validatedData);

        return redirect('/admin/departemen')->with('success', 'Data Departemen berhasil ditambahkan');
    }

    public function edit(Departemen $departemen) {
        return view('admin.departemen.edit', [
            'departemen'    => $departemen
        ]);
    }

    public function update(Request $request, Departemen $departemen) {
        $validatedData = $request->validate([
            'kodeDepartemen'   => 'required',
            'namaDepartemen'   => 'required|max:50',
        ]);

        Departemen::where('kodeDepartemen', $departemen->kodeDepartemen)->update($validatedData);

        return redirect('/admin/departemen')->with('success', 'Data Departemen berhasil diubah');
    }

    public function destroy(Departemen $departemen) {
        try{
            Departemen::where('kodeDepartemen', $departemen->kodeDepartemen)->delete();
        } catch (\Illuminate\Database\QueryException){
            return back()->with([
                'error' => 'Data cannot be deleted, because the data is still needed!',
            ]);
        }

        return redirect('/admin/departemen')->with('success', 'Data Departemen berhasil dihapus');
    }
}
