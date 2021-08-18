<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PenyidikController extends Controller
{
    public function index()
    {
        $data['users']=User::where('role','PENYIDIK')->get();
        // dd($data);
        return view('penyidik.index',$data);
    }

    public function add()
    {
        return view('penyidik.add');
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
            'nrp' => ['required'],
            'jabatan' => ['required'],
        ]);
        // dd($request);
        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'no_hp' => $request['no_hp'],
            'role' => 'PENYIDIK',
            'alamat' => $request['alamat'],
            'umur' => $request['umur'],
            'nrp' => $request['nrp'],
            'jabatan' => $request['jabatan'],
        ]);
        return redirect()->route('penyidik.index')->with('success', 'Sukses Membuat User!');   
    }
}
