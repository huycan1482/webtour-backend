<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Setting::first();
        // dd($data);
        return view('admin.setting.edit', [
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
        //
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
        //
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
        $request->validate([
            'name' => 'required',
            'company' => 'required',
            'new_image' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'address' => 'required',
            'address2' => 'required',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'hotline' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'tax' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
            'facebook' => 'required',
            'email' => 'required|email',

        ], [
            'name.required' => 'Yêu cầu không để trống',
            'company.required' => 'Tên không được để trống',
            'new_image.image' => 'Ảnh không đúng định dạng',
            'address.required' => 'Yêu cầu không để trống',
            'address2.required' => 'Yêu cầu không để trống',
            'phone.required' => 'Yêu cầu không để trống',
            'phone.regex' => 'Không đúng định dạng',
            'hotline.required' => 'Yêu cầu không để trống',
            'hotline.regex' => 'Không đúng định dạng',
            'tax.required' => 'Yêu cầu không để trống',
            'facebook.required' => 'Yêu cầu không để trống',
            'email.required' => 'yêu cầu không để trống',
        ]);


        //luu vào csdl
        $setting = Setting::findOrFail($id);
        $setting->name = $request->input('name');
        $setting->company = $request->input('company');

        if ($request->hasFile('new_image')) {
            // xóa file cũ
            @unlink(public_path($setting->image));
            // get file mới
            $file = $request->file('new_image');
            // get tên
            $filename = time().'_'.$file->getClientOriginalName();
            // duong dan upload
            $path_upload = 'uploads/setting/';
            // upload file
            $request->file('new_image')->move($path_upload,$filename);

            $setting->image = $path_upload.$filename;
        }

        $setting->address = $request->input('address');
        $setting->address2 = $request->input('address2');
        $setting->phone = $request->input('phone');
        $setting->hotline = $request->input('hotline');
        $setting->tax = $request->input('tax');
        $setting->facebook = $request->input('facebook');
        $setting->email = $request->input('email');
        $setting->introduce = $request->input('introduce');

        $setting->save();

        // chuyen dieu huong trang
        return redirect()->back()->with('msg', 'Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
