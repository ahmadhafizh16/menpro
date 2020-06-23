<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class AdminLoginController extends Controller
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
    protected $guard = 'admin';

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
        // dd("A");
        return 'nid';
    }

    public function showLoginForm()
    {
        return view('auth.adminLogin');
    }

    public function guard()
    {
        return auth()->guard('admin');
    }

    public function login(Request $request)
    {
        if (auth()->guard('admin')->attempt(['nid' => $request->nid, 'password' => $request->password ])) {
            // dd(auth()->guard("admin"));
            return redirect("/home");
        }


        return back()->withErrors(['nid' => 'NID atau PIN salah.']);
    }
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
