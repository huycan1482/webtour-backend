<?php

namespace App\Http\Controllers;

use App\Category;
use App\Image;
use App\Tour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = Image::latest()->paginate(10);
        $tour = Tour::where(['is_active' => 1])->orderBy('id', 'desc')->get();
        $category = Category::where(['is_active' => 1])->orderBy('id', 'desc')->get();

        return view('admin.image.index', [
            'data' => $images,
            'tour' => $tour,
            'category' => $category
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tour = Tour::where(['is_active' => 1])->orderBy('id', 'desc')->get();
        $category = Category::where(['is_active' => 1])->orderBy('id', 'desc')->get();

        return view('admin.image.create', [
            'tour' => $tour,
            'category' => $category
        ]);
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
            // 'name' => 'required|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'tour_id' => 'integer',
            'category_id' => 'integer'
        ],[
            // 'name.required' => 'Yêu cầu không để trống',
            'image.required' => 'Yêu cầu không để trống',
            'tour_id.integer' => 'Sai định dạng số',
            'category_id.integer' => 'Sai định dạng số'
        ]);

        $image = new Image();
        $image->name  = $request->input('name');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time().'_'.$file->getClientOriginalExtension();
            $path_upload = 'uploads/image/';
            $file->move($path_upload, $filename);
            $image->image = $path_upload.$filename;
        }

        $image->tour_id = $request->input('tour_id');
        $image->category_id = $request->input('category_id');
        $image->position = $request->input('position');

        $is_active = 0;
        if ($request->has('is_active')) {
            $is_active = $request->input('is_active');  
        } 
        $image->is_active = $is_active;
        // dd($image);
        $image->user_id = Auth::user()->id;
        $image->save();

        
        
        return redirect()->route('admin.image.index');
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
        $image = Image::findOrFail($id);
        $tour = Tour::where(['is_active' => 1])->orderBy('id', 'desc')->get();
        $category = Category::where(['is_active' => 1])->orderBy('id', 'desc')->get();

        return view('admin.image.edit', [
            // 'categories' => $categories,
            'image' => $image,
            'tour' => $tour,
            'category' => $category
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
            // 'name' => 'required|max:255',
            // 'new_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'tour_id' => 'integer',
            'category_id' => 'integer'
        ],[
            // 'name.required' => 'Yêu cầu không để trống',
            // 'new_image.required' => 'Yêu cầu không để trống',
            'tour_id.integer' => 'Sai định dạng số',
            'category_id.integer' => 'Sai định dạng số'
        ]);

        $image = Image::findOrFail($id);
        $image->name  = $request->input('name');

        if ($request->hasFile('new_image')) {
            // xoa link file cu
            @unlink(public_path($image->image));
            // get file
            $file = $request->file('new_image');
            // get ten
            $filename = time().'_'.$file->getClientOriginalName();
            // duong dan upload
            $path_upload = 'uploads/image/';
            // upload file
            $request->file('new_image')->move($path_upload,$filename);

            $image->image = $path_upload.$filename;
        }

        $image->tour_id = $request->input('tour_id');
        $image->category_id = $request->input('category_id');
        $image->position = $request->input('position');

        $is_active = 0;
        if ($request->has('is_active')) {
            $is_active = $request->input('is_active');          
        }
        $image->is_active = $is_active;
        $image->user_id = Auth::user()->id;
        $image->save();

        // dd($image);
        
        return redirect()->route('admin.image.index');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Image::destroy($id);

        $dataResp = [
            'status' => true
        ];
        return response()->json($dataResp, 200);
    }
}
