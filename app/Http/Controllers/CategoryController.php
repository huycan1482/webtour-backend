<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $categories = Category::all();
        $data = Category::latest()->paginate(10);
        $categories = Category::where('parent_id', 0)->get();
        
        // dd($data->onEachSide(1), $data->links());

        // dd($data->links());
        // dd($data->items());

        // dd($categories);
        return view('admin.category.index', [
            'data' => $data,
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Category::all();

        return view('admin.category.create', [
            'data' => $data
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
        // dd($request->all());
        //validate dữ liệu gửi từ form
        // $request->validate([
        //     'name' => 'required|unique:categories|max:255',
        //     'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp',
        //     'parent_id' => 'required|integer'
        // ], [
        //     'name.required' => 'Tên không được để trống',
        //     'name.unique' => 'Tên bị trùng',
        //     'image.image' => 'Ảnh không đúng định dạng',
        //     'image.mines' => 'Ảnh không đúng định dạng',
        //     'image.required' => 'Ảnh không được để trống',
        //     'parent_id.required' => 'Yêu cầu không được để trống',
        //     'parent_id.integer' => 'Không đúng định dạng'
        // ]);
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:categories|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'parent_id' => 'required|integer|exists:categories,id',
            'position' => 'integer|boolean', 
            'is_active' => 'integer|boolean',
        ], [
            'name.required' => 'Tên không được để trống',
            'name.unique' => 'Tên bị trùng',
            'image.required' => 'Ảnh không được để trống',
            'image.image' => 'Ảnh không đúng định dạng',
            'image.mimes' => 'Ảnh phải có đuôi jpeg,png,jpg,gif,svg,webp',
            'parent_id.required' => 'Yêu cầu không được để trống',
            'parent_id.integer' => 'Không đúng định dạng',
            'parent_id.exists' => 'Dữ liệu không tồn tại',
            'is_active.integer' => 'Sai kiểu dữ liệu',
            'is_active.boolean' => 'Yêu cầu dữ liệu là dạng boolean',
            'position.integer' => 'Sai kiểu dữ liệu',
            'position.boolean' => 'Yêu cầu dữ liệu là dạng boolean',
        ]); 

        $errs = $validator->errors();

        if ($validator->fails()) {
            
            return response()->json(['error'=>$errs]);
        }
            

        //luu vào csdl
        $category = new Category;
        $category->name = $request->input('name');
        $category->slug = Str::slug($request->input('name'));
        $category->parent_id = $request->input('parent_id');

        if ($request->hasFile('image')) {
            // get file
            $file = $request->file('image');
            // get ten
            $filename = time().'_'.$file->getClientOriginalName();
            // duong dan upload
            $path_upload = 'uploads/category/';
            // upload file
            $request->file('image')->move($path_upload,$filename);

            $category->image = $path_upload.$filename;
        }

        $is_hot ="0";
        if ($request->has('is_hot')) {
            $is_hot = $request->input('is_hot');
        }
        $category->is_hot = (int)$is_hot;

        $is_active = "0";
        if ($request->has('is_active')) {//kiem tra is_active co ton tai khong?
            $is_active = $request->input('is_active');
        }
        $category->is_active = (int)$is_active;

        $category->position = $request->input('position');
        $category->user_id = Auth::user()->id;
        // dd($category);  
        // $category->save();
        
        return response()->json(['success'=>'Thêm bản ghi mới thành công']);
        
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
        $data = Category::all();
        $category = Category::findOrFail($id);
        // :: la ham static

        return view('admin.category.edit', [
            'data' => $data,
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
        // dd($request->all());
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255|unique:categories,name,'.$id,
            // 'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10000',
            'new_image' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'parent_id' => 'required|integer|exists:categories,parent_id'
        ], [
            'name.required' => 'Tên không được để trống',
            'name.unique' => 'Tên bị trùng',
            'new_image.image' => 'Ảnh không đúng định dạng',
            // 'image.required' => 'Ảnh không được để trống',
            'parent_id.required' => 'Yêu cầu không được để trống',
            'parent_id.integer' => 'Không đúng định dạng',
            'parent_id.exists' => 'Dữ liệu không tồn tại',
        ]);

        $errs = $validator->errors();

        if ($validator->fails()) {
            return response()->json(['error'=>$errs]);
        }

        //luu vào csdl
        $category = Category::findOrFail($id);
        $category->name = $request->input('name');
        $category->slug = Str::slug($request->input('name'));
        $category->parent_id = $request->input('parent_id');

        if ($request->hasFile('new_image')) {
            // xóa file cũ
            @unlink(public_path($category->image));
            // get file mới
            $file = $request->file('new_image');
            // get tên
            $filename = time().'_'.$file->getClientOriginalName();
            // duong dan upload
            $path_upload = 'uploads/category/';
            // upload file
            $request->file('new_image')->move($path_upload,$filename);

            $category->image = $path_upload.$filename;
        }

        $is_hot = 0;
        if ($request->has('is_hot')) {//kiem tra is_active co ton tai khong?
            $is_hot = $request->input('is_hot');
        }
        $category->is_hot = $is_hot;

        $is_active = 0;
        if ($request->has('is_active')) {//kiem tra is_active co ton tai khong?
            $is_active = $request->input('is_active');    
        }
        $category->is_active = $is_active;
        
        $category->position = $request->input('position');
        $category->user_id = Auth::user()->id;
        // dd($category);
        // $category->save();

        // chuyen dieu huong trang
        // return redirect()->route('admin.category.index');
        return response()->json(['success'=>'Sửa bản ghi thành công']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        // Can kiem tra xem co sa pham thuoc danh muc nay hay khong
        Category::destroy($id);

        $dataResp = [
            'status' => true
        ];

        return response()->json($dataResp, 200);
    }

}
