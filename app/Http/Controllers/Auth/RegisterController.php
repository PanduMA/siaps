<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\DB;

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
    protected $redirectTo = '/login';

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
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'status' => 'required|string',
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
        $username=$data['username'];
        $status=$data['status'];
        if($status=='Siswa'){
            DB::table('siswa')->insert(['nis'=>$username,'status'=>$status]);
        }elseif ($status=='Guru') {
            $kategori=$data['radio'];
            DB::table('guru')->insert(['nip'=>$username,'status'=>$status,'kategori'=>$kategori]);
        }
        return User::create([
            'username' => $data['username'],
            'password' => bcrypt($data['password']),
            'status' => $data['status'],
        ]);
    }
    public function register(Request $request){
        $this->validator( $request->all() )->validate();
        event(new Registered($user = $this->create( $request->all() )));
        return redirect($this->redirectPath())->with('msg','Terima Kasih Telah Mendaftar, Silahkan Login Kembali');
    }
}
