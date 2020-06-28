<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function username(){
        return 'username';
    }

    public function authenticated($request , $user){
        // dd($user);
        switch ($user->role){
          case '1':
                return redirect("/home");
          case '2':
                return redirect("/koordb");
          case '3':
                return redirect("/dosendb");
          case '4':
                return redirect("/regis");
        }
      }


    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
