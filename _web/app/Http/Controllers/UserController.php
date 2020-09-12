<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Validator;
use App\User;
use App\RoleUser;
use App\Prodi;
use DB;

class UserController extends Controller
{
    public function __construct()
    {        
        $this->middleware('role:admin'); 
    }

    public function staff_list()
    {    	
    	$staff_list = DB::table('users')
            ->join('role_user', 'users.id', '=', 'role_user.user_id')            
            ->select('users.*', 'role_user.role_id')->where('role_user.role_id', '<=', '5')
            ->get();    	

        return view('users.staff_list', compact('staff_list'));
    }

    public function mahasiswa_list()
    {
    	$mhs_list = DB::table('users')
            ->join('role_user', 'users.id', '=', 'role_user.user_id')           
            ->join('prodi', 'prodi.id', '=', 'users.ps_id')             
            ->select('users.*', 'role_user.role_id', 'prodi.nama')->where('role_user.role_id', '>', '5')
            ->get(); 
                    
        return view('users.mahasiswa_list', compact('mhs_list'));
    }

    public function edit($id){
        $user = User::whereId($id)->firstOrFail(); 
        $prodi_list = Prodi::get();

        return view('users.edit', compact('user', 'prodi_list'));
    }

    public function update(Request $request, $id){
        $user = User::whereId($id)->firstOrFail(); 
        $input = $request->all();        

        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255|unique:users,email,' .$user->id,            
            'telepon' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()->route('user_edit', $id)
                        ->withErrors($validator)
                        ->withInput();
        }
    

        if ($request['password'] == '') {
            $input['password'] = $user->password;            
        }else{
            if ($request['password'] == $request['password_confirmation']) {
                $input['password'] = bcrypt($request['password']);    
            }else{
                return redirect()->route('user_edit', $id)->with('gagal_konfirm', 'Konfirmasi password tidak sesuai');
            }
            
        }        
        
        $user->update($input);

        if ($user->id < 6) {
            return redirect()->route('staff_list')->with('sukses', 'Data berhasil diperbaharui.');
        }else{
            return redirect()->route('mahasiswa_list')->with('sukses', 'Data berhasil diperbaharui.');
        }
        
    }

    public function delete($id)
    {
        $user = User::whereId($id)->firstOrFail();
        $nama = $user->name;

        $user->delete();

        return redirect()->route('mahasiswa_list')->with('sukses', 'Data berhasil dihapus.');
    }
    
}
