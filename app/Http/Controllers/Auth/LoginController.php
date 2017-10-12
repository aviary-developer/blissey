<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Bitacora;

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

    //use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = '/pacientes';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('guest')->except('logout');
    // }

    public function login()
    {
      if(Auth::check())
      {
        return redirect('/');
      }
      return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        if (Auth::attempt(['name' => $request['name'], 'password' => $request['password'], 'estado' => true])) {
            Bitacora::bitacora('login','users','usuarios',Auth::user()->id);
            return redirect('/');
        }
        return redirect('login');
    }

    public function logout()
    {
      if(Auth::check()){
        Bitacora::bitacora('logout','users','usuarios',Auth::user()->id);
      }
      Auth::logout();
      return redirect('login');
    }
}
