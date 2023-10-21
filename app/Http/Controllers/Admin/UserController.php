<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Departemen;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    
    public function index() {
        return view('admin.user.index', [
            'users' => User::orderBy('nama', 'ASC')->get()
        ]);
    }

    public function create() {
        
        $tipes = [
            [
                "tipe" => "karyawan"
            ],
            [
                "tipe" => "admin"
            ],
            [
                "tipe" => "teknisi"
            ],
            [
                "tipe" => "pimpinan"
            ],
        ];
        return view('admin.user.create', [
            'departemens'   => Departemen::all(),
            'tipes'         => $tipes   
        ]);
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'nik'              => 'required|max:9',
            'nama'              => 'required|max:50',
            'departemen'       => 'required',
            'email'             => 'required|email|unique:users',
            'tel'             => 'required|max:15',
            'tipe'       => 'required',
            'password'          => 'required|min:8|max:50',
        ]);

        $validatedData["password"] = Hash::make($validatedData["password"]);

        User::Create($validatedData);

        return redirect('/admin/user')->with('success', 'Data uploaded successfully');
    }

    public function edit(User $user) {
        $tipes = [
            [
                "tipe" => "karyawan"
            ],
            [
                "tipe" => "admin"
            ],
            [
                "tipe" => "teknisi"
            ],
            [
                "tipe" => "pimpinan"
            ],
        ];
        return view('admin.user.edit', [
            'user'          => $user,
            'departemens'   => Departemen::all(),
            'tipes'         => $tipes
        ]);
    }

    public function update(Request $request, User $user) {
        $validatedData = $request->validate([
            'nik'              => 'required|max:9',
            'nama'              => 'required|max:50',
            'departemen'       => 'required',
            'email'             => 'required|email',
            'tel'             => 'required|max:15',
            'tipe'       => 'required',
        ]);

        if ($request->email == $user->email) {
            $validatedData['email'] = $request->email;
        }

        User::where('nik', $user->nik)->update($validatedData);

        return redirect('/admin/user')->with('success', 'Data berhasil diubah');
    }

    public function updatePassword(Request $request, User $user) {
        $validatedData = $request->validate([
            'password'          => 'required|min:8|max:50',
        ]);

        $validatedData["password"] = Hash::make($validatedData["password"]);

        User::where('nik', $user->nik)->update($validatedData);

        return redirect('/admin/user')->with('success', 'Data Password berhasil diubah');
    }

    public function destroy(User $user) {
        try{
            User::where('nik', $user->nik)->delete();
        } catch (\Illuminate\Database\QueryException){
            return back()->with([
                'error' => 'Data cannot be deleted, because the data is still needed!',
            ]);
        }

        return redirect('/admin/user')->with('success', 'Data user berhasil dihapus');
    }
}
