<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Routing\Redirector;
use Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function username(){
        return 'username';
    }
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    protected function authenticated(Request $req){
        $username=$req->username;
        $data=DB::table('users')->where('username',$username)->first();
        $status=$data->status;        
        if($status=='Siswa'){
            $siswa=DB::table('siswa')->where('nis',$username)->get();
            Session::push('nis',$username);
            return redirect()->action('HomeController@aspirasisiswa',['username'=>$username]);
        }elseif ($status=='Guru') {
            $siswa=DB::table('guru')->where('nip',$username)->get();
            Session::push('nip',$username);
            return redirect()->action('HomeController@aspirasiguru',['username'=>$username]);
        }
    }
}
