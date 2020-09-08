<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\RoleUser;
use App\Role;
use App\Prodi;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|string|email|max:255|unique:users',
            'name' => 'required|string|max:255',
            'nim' => 'required|string|max:255',            
            'telepon' => 'required|numeric',
            'password' => 'required|string|min:6|confirmed',
            
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $prodi = Prodi::whereNama($data['ps'])->firstOrfail();
        $user =  User::create([
            'email' => $data['email'],
            'name' => $data['name'],
            'nim' => $data['nim'],
            'prodi' => 'Mahasiswa',
            'ps_id' => $prodi->id,
            'telepon' => $data['telepon'],
            'password' => bcrypt($data['password']),
        ]);

        $rolemhs = Role::find(6);
        $user->attachRole($rolemhs);

        return $user;
    }
}
