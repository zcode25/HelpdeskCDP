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
}
