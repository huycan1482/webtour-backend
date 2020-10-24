<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\ShoppingMail;
use App\User;
use Validator;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Contracts\Session\Session;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index () 
    {
        return view('admin.login.checkMail');
    }

    public function checkEmail(Request $request)
    {   
       
        $user = User::where('email', $request->input('email'))->first();
        if ($user) {
            $code = random_int(100000, 999999);
            session()->put('code_passForgot',$code);
            session()->put('mail_passForgot',$request->input('email'));
            session()->put('timeOut_passForgot', time()+900);
            Mail::to($request->input('email'))->send(new ShoppingMail($code, 'passForgot'));
            // dd(session()->get('token_passForgot'));
            return redirect('check_code');
            
        } else {
            return back()->with('message', 'Tài khoản email của bạn không tồn tại');
        }
    }

    public function checkCode() 
    {
        return view ('admin.login.checkCode');
    }

    public function resetPassword(Request $request) 
    {
        if (session()->get() < time()) {
            session()->forget('code_passForgot');
            session()->forget('mail_passForgot');
            session()->forget('timeOut_passForgot');
        }

        if (session()->get('code_passForgot') == $request->input('code')) {
            // dd('true',session()->get('code_passForgot'), session()->get('mail_passForgot'));
            return view('admin.login.newPass');
        }
        else {
            // return back();
            return back()->withInput()->with('message', 'Nhập sai mã xác thực yêu cầu nhập lại');
        }
    }

    public function newPassword(Request $request)
    {
        $errors = [];
        $pass = $request->input('password');
        $re_pass = $request->input('re_password');

        if (session()->get() < time()) {
            session()->forget('code_passForgot');
            session()->forget('mail_passForgot');
            session()->forget('timeOut_passForgot');
        }
        
        // dd($pass, $re_pass);
        // $validate =  FacadesValidator::make($request->all(),[
        //     'password'=>'required'
        // ]);
        // return back()->withErrors($validate);
        if ($request->input('email') ==  session()->get('mail_passForgot')) {
            $user = User::where('email', $request->input('email'))->first();
            // if ($user->id == $pass) {
            //     return view ('admin.login.newPass', [
            //         'errors' => 'Password mới phải khác PassWord cũ'
            //     ]);
            if (!$pass) {
                $errors [] = 'Yêu cầu không để trống Password'; 
            } if (!$re_pass) {
                $errors [] = 'Yêu cầu không để trống nhập lại Password'; 
            } if (preg_match('/\s/', $pass) == 1) {
                $errors [] = 'Yêu cầu không có khoảng trắng trong mật khẩu'; 
            } if ( strlen($pass) < 6 ) {
                $errors [] = 'Yêu cầu độ dài của mật khẩu phải hơn 6 kí tự';
            } if ( $pass != $re_pass ) {
                $errors [] = 'Nhập lại mật khẩu phải giống với mật khẩu mới';
            } if ($errors) {
                // dd($errors);
                return view('admin.login.newPass', [
                    'errors' => $errors,
                ]);
            } else {
                $user->password = bcrypt($request->input('password'));
                // dd(session('success_mess'));
                session()->forget('code_passForgot');
                session()->forget('mail_passForgot');
                // $user->save();
                session()->put('success_mess', 'Cập nhập mật khẩu thành công');
                return redirect('admin');
            }
            
        }  else {
            $errors [] = 'Email không khớp với email đặt lại mật khẩu';
            return view('admin.login.newPass', [
                'errors' => $errors,
            ]);
        }
        
    }

  
}
