<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $data['users']=User::where('role','ADMIN')->get();
        // dd($data);
        return view('admin.index',$data);
    }

    public function add()
    {
        return view('admin.add');
    }

    public function store(Request $request)
    {
        
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'no_hp' => ['required'],
            'alamat' => ['required'],
            'umur' => ['required'],
        ]);
        // dd($request);
        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'no_hp' => $request['no_hp'],
            'role' => 'ADMIN',
            'alamat' => $request['alamat'],
            'umur' => $request['umur'],
        ]);
        return redirect()->route('admin.index')->with('success', 'Sukses Membuat User!');   
    }
}
