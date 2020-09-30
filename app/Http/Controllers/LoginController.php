<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('admin.login.index');
    }
    public function postLogin(Request $request)
    {
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
