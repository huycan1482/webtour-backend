<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function __construct()
    {
        // dd('hi');
        // dd($this->middleware('guest')->except('logout'));
    }

    public function index()
    {
        return view('admin.login.index');
    }

    public function postLogin(Request $request)
    {
        dd(Auth::guard('api'));
        if (Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
            return redirect('admin');
        } else {
            // return redirect('login');
            return redirect('login')->with('message', 'Nhập sai tài khoản hoặc mật khẩu');
        }

    }

    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }
}
