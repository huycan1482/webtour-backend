<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

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
        // if ( Cookie::get('member_me')) {
        //     $user = User::where('remember_token', Cookie::get('member_me'))->first();
        //     if ($user) {
        //         return redirect('admin');
        //     }
        // } else {
        //     return view('admin.login.index');
        // }

        // dd($this->middleware('guest')->except('logout'));

    }

    public function index()
    {
        return view('admin.login.index');
    }

    public function postLogin(Request $request)
    {
        // $test = Auth::guard('web');
        // dd($test()::driver());
        
        // session()->put('test', 'hello');
        if (Auth::attempt(['email'=>$request->email,'password'=>$request->password])) {
            
            // $remember = bin2hex(random_bytes(20));
            // $member_time = (3600 * 24 * 30); 
            $user = User::where('email', $request->input('email'))->first();
            // $user->remember_token = $remember;
            // $user->save();
            // Cookie::queue(Cookie::make('member_me', $remember, $member_time));
            
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
