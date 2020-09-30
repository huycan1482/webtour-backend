<?php

namespace App\Http\Controllers;

use App\Tour;
use App\User;
use Dotenv\Validator;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $data = User::latest()->paginate(10);
        
        return view('admin.user.index', [
            'data' => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|min:8',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg,webp',
        ], [
            'name.required' => 'Yêu cầu không bỏ trống',
            'email.required' => 'Yêu cầu không bỏ trống',
            'email.unique' => 'Email bị trùng',
            'password.required' => 'Yêu cầu không bỏ trống',
            'password.min' => 'Yêu cầu dài hơn 8 kí tự',
            'avatar.image' => 'Ảnh không đúng định dạng',
        ]);

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));

        if ($request->hasFile('avatar')) {
            // get file
            $file = $request->file('avatar');
            // get ten
            $filename = time().'_'.$file->getClientOriginalName();
            // duong dan upload
            $path_upload = 'uploads/user/';
            // upload file
            $request->file('avatar')->move($path_upload,$filename);

            $user->avatar = $path_upload.$filename;
        }

        $is_active = "0";
        if ($request->has('is_active')) { //kiem tra is_active co ton tai khong?
            $is_active = $request->input('is_active');
        }

        $user->save();

        return redirect()->route('admin.user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $user = User::all();
        $user = User::findOrFail($id);
        // :: la ham static

        return view('admin.user.edit', [
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->validate(['password'=>'present']));
        $request->validate([
            'email' => 'unique:users,email,'.$id,
            'password' => 'nullable|size:8',
            // 're_password' => ,
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg,webp',
        ], [
            'email.unique' => 'Email bị trùng',
            'password.size' => 'Yêu cầu dài hơn 8 kí tự',
            'avatar.image' => 'Ảnh không đúng định dạng',
        ]);


        $user = User::findOrFail($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        if ($request->input('password')) {
            $user->password = bcrypt($request->input('password'));
        }
        if ($request->hasFile('new_avatar')) {
            // xóa file cũ
            @unlink(public_path($user->avatar));
            // get file mới
            $file = $request->file('new_avatar');
            // get tên
            $filename = time().'_'.$file->getClientOriginalName();
            // duong dan upload
            $path_upload = 'uploads/user/';
            // upload file
            $request->file('new_avatar')->move($path_upload,$filename);

            $user->avatar = $path_upload.$filename;
        }

        $is_active = "0";
        if ($request->has('is_active')) { //kiem tra is_active co ton tai khong?
            $is_active = $request->input('is_active');
        }
        $user->is_active = $is_active;

        // dd($user);
        $user->save();
        
        return redirect()->route('admin.user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Tour::destroy($id);
        $dataResp = [
            'status' => true
        ];

        return response()->json($dataResp, 200);
    }
}
