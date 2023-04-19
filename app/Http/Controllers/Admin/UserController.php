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
            'users' => User::all()
        ]);
    }

    public function create() {
        return view('admin.user.create', [
            'departemens' => Departemen::all()
        ]);
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'nik'              => 'required|max:5',
            'nama'              => 'required|max:50',
            'departemen'       => 'required',
            'email'             => 'required|email:dns|unique:users',
            'tel'             => 'required|max:15',
            'password'          => 'required|min:8|max:50',
        ]);

        $validatedData["password"] = Hash::make($validatedData["password"]);

        User::Create($validatedData);

        return redirect('/admin/user')->with('success', 'Data uploaded successfully');
    }

    public function edit(User $user) {
        return view('admin.user.edit', [
            'user'          => $user,
            'departemens'   => Departemen::all()
        ]);
    }

    public function update(Request $request, User $user) {
        $validatedData = $request->validate([
            'nik'              => 'required|max:5',
            'nama'              => 'required|max:50',
            'departemen'       => 'required',
            'email'             => 'required|email:dns',
            'tel'             => 'required|max:15',
        ]);

        if ($request->email == $user->email) {
            $validatedData['email'] = $request->email;
        }

        User::where('nik', $user->nik)->update($validatedData);

        return redirect('/admin/user')->with('success', 'Data berhasil diubah');
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
