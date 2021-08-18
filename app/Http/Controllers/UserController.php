<?php

namespace App\Http\Controllers;

use App\Models\User;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\FacadesHash;

class UserController extends Controller
{
    public function index()
    {
        $data['users']=User::where('role','USER')->get();
        // dd($data);
        return view('user.index',$data);
    }

    public function add()
    {
        return view('user.add');
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
        
        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'no_hp' => $request['no_hp'],
            'role' => 'USER',
            'alamat' => $request['alamat'],
            'umur' => $request['umur'],
        ]);
        return redirect()->route('user.index')->with('success', 'Sukses Membuat User!');   
    }

    public function edit($id)
    {
        $data['user']=User::find($id);
        // dd($data);
        return view('user.edit',$data);
    }

    public function delete($id)
    {
        User::find($id)->delete();
    }

    public function update($id,Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'no_hp' => ['required'],
            'alamat' => ['required'],
            'umur' => ['required'],
        ]);

        $user=new User();
        $user=User::find($id);
        $user->name=$request->name;
        $user->email=$request->email;
        $user->no_hp=$request->no_hp;
        $user->alamat=$request->alamat;
        $user->umur=$request->umur;
        $user->nrp=$request->nrp;
        $user->jabatan=$request->jabatan;
        $user->save();
        session()->flash('success','Berhasil Update Profile');
        return redirect()->back();
    }

    public function profile()
    {
        return view('user.profile');
    }

    public function profileUpdate(Request $request)
    {
        // dd($request);
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'no_hp' => ['required'],
            'alamat' => ['required'],
            'umur' => ['required'],
            'password_lama' => 'required',
            'password_baru' => 'required',
        ]);
        $hashedPassword = Auth::user()->password;
 
       if (Hash::check($request->password_lama , $hashedPassword )) {
 
         if (!Hash::check($request->password_baru , $hashedPassword)) {
 
              $users =User::find(Auth::user()->id);
              $users->password = bcrypt($request->password_baru);
              User::where( 'id' , Auth::user()->id)->update( array( 'password' =>  $users->password));
              $user=new User();
              $user=User::find(Auth::id());
              $user->name=$request->name;
              $user->email=$request->email;
              $user->no_hp=$request->no_hp;
              $user->alamat=$request->alamat;
              $user->umur=$request->umur;
              $user->save();
 
              session()->flash('success','Berhasil Update Profile');
              return redirect()->back();
        }
            else{
                session()->flash('error','Password Baru Tidak Boleh Sama Dengan Yang Lama!');
                return redirect()->back();
            }
        }
            else{
                session()->flash('error','Password Lama Tidak Sama ');
                return redirect()->back();
            }
    }
}
