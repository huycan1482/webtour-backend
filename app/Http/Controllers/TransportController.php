<?php

namespace App\Http\Controllers;

use App\Transport;
use Illuminate\Http\Request;

class TransportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transport = Transport::latest()->paginate(10);
        return view('admin.transport.index', [
            'data' => $transport
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.transport.create');
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
            'name' => 'required|max:200',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'brand_id' => 'integer',
        ],[
            'name.required' => 'Nhập đủ thông tin',
            'image.required' => 'Yêu cầu không để trống',
            'image.image' => 'Sai định dạng của ảnh',
            'name.max' => 'Độ dài tên ít hơn 200',
            'brand_id.integer' => 'Sai định dạng số'
        ]);

        $transport = new Transport();
        $transport->name = $request->input('name');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time().'_'.$file->getClientOriginalExtension();
            $path_upload = 'uploads/transport/';
            $file->move($path_upload, $filename);
            $transport->image = $path_upload.$filename;
        }

        $transport->brand_id = $request->input('brand_id');

        $is_active = 0;
        if ($request->has('is_active')) {
            $is_active = $request->input('is_active');
            $transport->is_active = $is_active;
        }

        $transport->save();

        return redirect()->route('admin.transport.index');
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
        $transport = Transport::findOrFail($id);

        return view('admin.transport.edit', [
            // 'categories' => $categories,
            'transport' => $transport
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
        $request->validate([
            'name' => 'required|max:200',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'brand_id' => 'integer',
        ],[
            'name.required' => 'Nhập đủ thông tin',
            // 'image.required' => 'Yêu cầu không để trống',
            'image.image' => 'Sai định dạng của ảnh',
            'name.max' => 'Độ dài tên ít hơn 200',
            'brand_id.integer' => 'Sai định dạng số'
        ]);

        $transport = Transport::findOrFail($id);
        $transport->name = $request->input('name');

        if ($request->hasFile('new_image')) {
            // xoa link file cu
            @unlink(public_path($transport->image));
            // get file
            $file = $request->file('new_image');
            // get ten
            $filename = time().'_'.$file->getClientOriginalName();
            // duong dan upload
            $path_upload = 'uploads/image/';
            // upload file
            $request->file('new_image')->move($path_upload,$filename);

            $transport->image = $path_upload.$filename;
        }

        $transport->brand_id = $request->input('brand_id');

        $is_active = 0;
        if ($request->has('is_active')) {
            $is_active = $request->input('is_active'); 
        }
        $transport->is_active = $is_active;

        $transport->save();

        return redirect()->route('admin.transport.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Transport::destroy($id);

        $dataResp = [
            'status' => true
        ];
        return response()->json($dataResp, 200);
    }
}
