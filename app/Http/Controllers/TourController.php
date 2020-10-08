<?php

namespace App\Http\Controllers;

use App\Category;
use App\Image;
use App\Position;
use App\Tour;
use App\Role;
use App\Transport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TourController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cates = [];
        $location = $request->query('diem-den');
        $number = $request->query('tinh-trang-cho');
        $time = $request->query('thoi-gian');
        $status = $request->query('trang-thai');

        $query = Tour::latest();
        
        $categories = Category::where([['is_active', '=',  1], ['parent_id', '!=', '0']])->orderBy('name', 'asc')->get();
    
        if ( $location ) {
            foreach ( $categories as $index ) {
                if ( $location == $index->slug ) {
                    $cates [] = $index->id; 
                }
            }
            $query->whereIn('category_id', $cates);
        }

        if ( $number ) {
            if ( $number == 'het-cho' ) {
                $query->whereColumn('member_num', '=', 'total_num');
            } else {
                $query->whereColumn('member_num', '<', "total_num");
            }
        }
       
        if ( $time ) {
            if ( $time == 'khong-kha-dung' ) {
                $query->where('start_date', '<=' , date("Y-m-d"));
            } else {
                $query->where('start_date', '>' , date("Y-m-d"));
            }
        }
        
        if ( $status ) {
            if ( $status == 'hien-thi' ) {
                $query->where('is_active', 1);
            } else {
                $query->where('is_active', 0);
            }
        }
        $total_tour = Tour::count();
        $enable_tour = count(Tour::where([['is_active', '=',  1], ['start_date', '>' , date('Y-m-d') ]] )->whereColumn('member_num', '<', "total_num")->get());
        $outdate_tour = count(Tour::where([['is_active', '=',  1], ['start_date', '<=' , date('Y-m-d') ]])->get());
        $outnumber_tour = count(Tour::where([['is_active', '=',  1]])->whereColumn('member_num', '>=', "total_num")->get());
        // dd($outdate_tour);
        $data = $query->paginate(10);
        return view ('admin.tour.index', [
            'data' => $data,
            'categories' => $categories,
            'location' => $location,
            'number' => $number,
            'time' => $time,
            'status' => $status,
            'total_tour' => $total_tour,
            'enable_tour' => $enable_tour,
            'outdate_tour' => $outdate_tour,
            'outnumber_tour' => $outnumber_tour,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('is_active', 1)->orderBy('position', 'desc')->get();

        $transports = Transport::where('is_active', 1)->get();
        $positions = Position::where('is_active', 1)->get();

        return view ('admin.tour.create', [
            'categories' => $categories,
            'transports' => $transports,
            'positions' => $positions
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
        // dd($request->input('start_date'));

        // $cate [] = Category::where('is_active', 1)->get();
        // dd($request->is_hot);
        $request->validate ([
            // 'name' => 'required|max:255|min:10|unique:tours',
            // 'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            // 'category_id' => 'required|integer|exists:categories,id', 
            // 'transport_id' => 'required|integer|exists:transports,id', 
            // 'starting_position' => 'required|integer|exists:positions,id', 
            // 'total_num' => 'required|integer|min:2|max:45',
            // 'member_num'=> 'required|integer|min:0|after_or_equal:total_num', 
            'price' => 'required|integer|min:0|max:1000000000',
            // 'schedule' => 'required|min:100',
            // 'note' => 'required|min:100',
            'price_1_2' => 'nullable|integer|min:0|max:price',
            'price_2_5' => 'nullable|integer|min:0|max:price',
            'price_5_11' => 'nullable|integer|min:0|max:price', 
            'price_1_2' => 'nullable|integer|min:0|max:price',  
            // 'visa_price' => 'nullable|integer|min:0|max:1000000000', 
            // 'discount' => 'nullable|integer|min:0|after_or_equal:price',
            // 'start_date' => 'required|date',
            // 'end_date' => 'required|date|after:start_date',
            // 'position' => 'integer|max:1|min:0', 
            // 'is_active' => 'integer|max:1|min:0',
        ],[
            'name.required' => 'Yêu cầu không để trống',
            'name.unique' => 'Tên bị trùng',
            'name.min' => 'Tên phải có độ dài trên 10 kí tự',
            'name.max' => 'Tên phải có độ dài dưới 255 kí tự',
            'image.required' => 'Yêu cầu không để trống', 
            'image.img' => 'Sai định dạng ảnh',
            'category_id.required' => 'Yêu cầu không để trống', 
            'category_id.integer' => 'Sai định dạng số' ,
            'category_id.exists' => 'Dữ liệu không phù hợp',
            'transport_id.required' => 'Yêu cầu không để trống', 
            'transport_id.exists' => 'Dữ liệu không phù hợp',
            'transport_id.integer' => 'Sai định dạng số' ,
            'starting_position.required' => 'Yêu cầu không để trống',
            'starting_position.exists' => 'Dữ liệu không hợp lệ', 
            'starting_position.integer' => 'Sai định dạng số' , 
            'total_num.required' => 'Yêu cầu không để trống',
            'total_num.integer' => 'Sai đúng định dạng số',
            'total_num.min' => 'Số lượng ít nhất là 2 người',
            'total_num.max' => 'Số lượng nhiều nhất là 45 người', 
            'member_num.required' => 'Yêu cầu không để trống', 
            'member_num.integer' => 'Sai đúng định dạng số',
            'member_num.min' => 'Số lượng nhỏ nhất là 0',
            'member_num.after_or_equal' => 'Số lượng phải nhỏ hơn hoặc bằng số lượng người của Tour',
            'price.required' => 'Yêu cầu không để trống', 
            'price.integer' => 'Sai định dạng số',
            'price.min' => 'Giá trị nhỏ nhất là 0',
            'price.max' => 'Giá trị lớn nhất là 1000000000',
            'schedule.required' => 'Yêu cầu không để trống',
            'schedule.min' => 'Yêu cầu độ dài ít nhất 100 kí tự', 
            'note.required' => 'Yêu cầu không để trống',
            'note.min' => 'Yêu cầ độ dài ít nhất 100 kí tự',
            'start_date.required' => 'Yêu cầu không để trống',
            'end_date.required' => 'Yêu cầu không để trống',
            'price_1_2.integer' => 'Sai định dạng số' ,
            'price_1_2.min' => 'Giá trị nhỏ nhất là 0',
            'price_1_2.after' => 'Giá trị phải nhỏ hơn giá của Tour',
            'price_2_5.integer' => 'Sai định dạng số' ,
            'price_2_5.min' => 'Giá trị nhỏ nhất là 0',
            'price_2_5.after' => 'GIá trị phải nhỏ hơn giá của Tour',
            'price_5_11.integer' => 'Sai định dạng số' ,
            'price_5_11.min' => 'Giá trị nhỏ nhất là 0',
            'price_5_11.after' => 'Giá trị phải nhỏ hơn giá của Tour',
            'visa_price.integer' => 'Sai định dạng số' ,
            'visa_price.min' => 'Giá trị nhỏ nhất là 0',
            'visa_price.max' => 'Giá trị lớn nhất là 1000000000',
            'discount.integer' => 'Sai định dạng số' ,
            'discount.min' => 'Giá trị nhỏ nhất là 0',
            'discount.after_or_equal' => 'Giá trị phải nhỏ hơn hoặc bằng giá của Tour',
            'start_date.date' => 'Sai định dạng ngày tháng',
            'end_date.date' => 'Sai định dạng ngày tháng',
            'end_date.after' => 'Ngày kết thúc phải sau ngày khởi hành',
            'is_active.integer' => 'Sai kiểu dữ liệu',
            'is_active.min' => 'Dữ liệu không được bé hơn 0',
            'is_active.max' => 'Dữ liệu không được lớn hơn 1',
            'position.integer' => 'Sai kiểu dữ liệu',
            'position.min' => 'Dữ liệu không được bé hơn 0',
            'position.max' => 'Dữ liệu không được lớn hơn 1',
        ]);

        $tour = new Tour();

        $tour->name = $request->input('name');
        $tour->slug = Str::slug($tour->name, '-');
        $tour->category_id = $request->input('category_id');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time().'_'.$file->getClientOriginalExtension();
            $path_upload = 'uploads/tour/';
            $file->move($path_upload, $filename);
            $tour->image = $path_upload.$filename;
        }

        $tour->start_date = date('Y-m-d', strtotime($request->input('start_date')));
        $tour->end_date = date('Y-m-d', strtotime($request->input('end_date')));

        $tour->days = abs(strtotime($tour->start_date) - strtotime($tour->end_date))/(60*60*24);

        $tour->schedule = $request->input('schedule');
        $tour->note = $request->input('note');
        $tour->transport_id = $request->input('transport_id');
        $tour->starting_position_id = $request->input('starting_position');
        $tour->total_num = $request->input('total_num');
        $tour->member_num = $request->input('member_num');
        $tour->price = $request->input('price');
        $tour->price_1_2 = $request->input('price_1_2');
        $tour->price_2_5 = $request->input('price_2_5');
        $tour->price_5_11 = $request->input('price_5_11');
        $tour->visa_price = $request->input('visa_price');
        $tour->discount = $request->input('discount');
        $tour->position = $request->input('position');

        $is_active = 0;
        if ($request->has('is_active')) {
            $is_active = $request->input('is_active');
            $tour->is_active = (int)($is_active);
        }

        $is_hot = 0;
        if ($request->has('is_hot')) {
            $is_hot = $request->input('is_hot');
            $tour->is_hot = (int)($is_hot);
        }
        $tour->user_id = Auth::user()->id;
        
        dd($tour);
        $tour->save();
        
        return redirect()->route('admin.tour.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    { 
        $tour = Tour::findOrFail($id);

        $categories = Category::where('is_active', 1)->orderBy('position', 'desc')->get();

        $transports = Transport::where('is_active', 1)->get();
        $positions = Position::where('is_active', 1)->get();
        $images = Image::where([['is_active', 1], ['tour_id', $id]])->get();

        // dd($images);
        return view ('admin.tour.edit', [
            'categories' => $categories,
            'transports' => $transports,
            'positions' => $positions,
            'tour' => $tour,
            'images' => $images,
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
        
        $request->validate ([
            'name' => 'max:255|min:10|unique:tours,name,'.$id,
            'new_image' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'category_id' => 'required|integer|exists:categories,id', 
            'transport_id' => 'required|integer|exists:transports,id', 
            'starting_position' => 'required|integer|exists:positions,id', 
            'total_num' => 'required|integer|min:2|max:45',
            'member_num'=> 'required|integer|min:0|after_or_equal:total_num', 
            'price' => 'required|integer|min:0|max:1000000000',
            'schedule' => 'required|min:100',
            'note' => 'required|min:100',
            'price_2_5' => 'nullable|integer|min:0|after:price',
            'price_5_11' => 'nullable|integer|min:0|after:price', 
            'price_1_2' => 'nullable|integer|min:0|after:price',  
            'visa_price' => 'nullable|integer|min:0|max:1000000000', 
            'discount' => 'nullable|integer|min:0|after_or_equal:price',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'position' => 'integer|max:1|min:0',
            'is_active' => 'integer|max:1|min:0',
        ],[          
            'name.required' => 'Yêu cầu không để trống',
            'name.unique' => 'Tên bị trùng',
            'name.min' => 'Tên phải có độ dài trên 10 kí tự',
            'name.max' => 'Tên phải có độ dài dưới 255 kí tự',
            'name.unique' => 'Tên bị trùng',
            'new_image.required' => 'Yêu cầu không để trống', 
            'new_image.img' => 'Sai định dạng ảnh',
            'category_id.required' => 'Yêu cầu không để trống', 
            'category_id.integer' => 'Sai định dạng số' ,
            'category_id.exists' => 'Dữ liệu không phù hợp',
            'transport_id.required' => 'Yêu cầu không để trống', 
            'transport_id.exists' => 'Dữ liệu không phù hợp',
            'transport_id.integer' => 'Sai định dạng số' ,
            'starting_position.required' => 'Yêu cầu không để trống',
            'starting_position.exists' => 'Dữ liệu không hợp lệ', 
            'starting_position.integer' => 'Sai định dạng số' , 
            'total_num.required' => 'Yêu cầu không để trống',
            'total_num.integer' => 'Sai đúng định dạng số',
            'total_num.min' => 'Số lượng ít nhất là 2 người',
            'total_num.max' => 'Số lượng nhiều nhất là 45 người', 
            'member_num.required' => 'Yêu cầu không để trống', 
            'member_num.integer' => 'Sai đúng định dạng số',
            'member_num.min' => 'Số lượng nhỏ nhất là 0',
            'member_num.after_or_equal' => 'Số lượng phải nhỏ hơn hoặc bằng số lượng người của Tour',
            'price.required' => 'Yêu cầu không để trống', 
            'price.integer' => 'Sai định dạng số',
            'price.min' => 'Giá trị nhỏ nhất là 0',
            'price.max' => 'Giá trị lớn nhất là 1000000000',
            'schedule.required' => 'Yêu cầu không để trống',
            'schedule.min' => 'Yêu cầu độ dài ít nhất 100 kí tự', 
            'note.required' => 'Yêu cầu không để trống',
            'note.min' => 'Yêu cầ độ dài ít nhất 100 kí tự',
            'start_date.required' => 'Yêu cầu không để trống',
            'end_date.required' => 'Yêu cầu không để trống',
            'price_1_2.integer' => 'Sai định dạng số' ,
            'price_1_2.min' => 'Giá trị nhỏ nhất là 0',
            'price_1_2.after' => 'Giá trị phải nhỏ hơn giá của Tour',
            'price_2_5.integer' => 'Sai định dạng số' ,
            'price_2_5.min' => 'Giá trị nhỏ nhất là 0',
            'price_2_5.after' => 'GIá trị phải nhỏ hơn giá của Tour',
            'price_5_11.integer' => 'Sai định dạng số' ,
            'price_5_11.min' => 'Giá trị nhỏ nhất là 0',
            'price_5_11.after' => 'Giá trị phải nhỏ hơn giá của Tour',
            'visa_price.integer' => 'Sai định dạng số' ,
            'visa_price.min' => 'Giá trị nhỏ nhất là 0',
            'visa_price.max' => 'Giá trị lớn nhất là 1000000000',
            'discount.integer' => 'Sai định dạng số' ,
            'discount.min' => 'Giá trị nhỏ nhất là 0',
            'discount.after_or_equal' => 'Giá trị phải nhỏ hơn hoặc bằng giá của Tour',
            'start_date.date' => 'Sai định dạng ngày tháng',
            'end_date.date' => 'Sai định dạng ngày tháng',
            'end_date.after' => 'Ngày kết thúc phải sau ngày khởi hành',
            'is_active.integer' => 'Sai kiểu dữ liệu',
            'is_active.min' => 'Dữ liệu không được bé hơn 0',
            'is_active.max' => 'Dữ liệu không được lớn hơn 1',
            'position.integer' => 'Sai kiểu dữ liệu',
            'position.min' => 'Dữ liệu không được bé hơn 0',
            'position.max' => 'Dữ liệu không được lớn hơn 1',
        ]);

        $tour = Tour::findOrFail($id);
        $tour->name = $request->input('name');
        $tour->slug = Str::slug($tour->name, '-');
        $tour->category_id = $request->input('category_id');

        if ($request->hasFile('new_image')) {
            // xoa link file cu
            @unlink(public_path($tour->image));
            // get file
            $file = $request->file('new_image');
            // get ten
            $filename = time().'_'.$file->getClientOriginalName();
            // duong dan upload
            $path_upload = 'uploads/tour/';
            // upload file
            $request->file('new_image')->move($path_upload,$filename);

            $tour->image = $path_upload.$filename;
        }

        $tour->start_date = date('Y-m-d', strtotime($request->input('start_date')));
        $tour->end_date = date('Y-m-d', strtotime($request->input('end_date')));

        $tour->days = abs(strtotime($tour->start_date) - strtotime($tour->end_date))/(60*60*24);

        $tour->schedule = $request->input('schedule');
        $tour->note = $request->input('note');
        $tour->transport_id = $request->input('transport_id');
        $tour->starting_position_id = $request->input('starting_position');
        $tour->total_num = $request->input('total_num');
        $tour->member_num = $request->input('member_num');
        $tour->price_1_2 = $request->input('price_1_2');
        $tour->price_2_5 = $request->input('price_2_5');
        $tour->price_5_11 = $request->input('price_5_11');
        $tour->visa_price = $request->input('visa_price');
        $tour->discount = $request->input('discount');
        $tour->position = $request->input('position');

        $is_active = 0;
        $is_hot = 0;

        if ($request->has('is_active')) {
            $is_active = $request->input('is_active');   
        }
        $tour->is_active = json_decode($is_active);
        
        if ($request->has('is_hot')) {
            $is_hot = $request->input('is_hot');
            
        }
        $tour->is_hot = json_decode($is_hot);
        $tour->user_id = Auth::user()->id;
        // dd($tour);
        $tour->save();
        
        return redirect()->route('admin.tour.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
          // gọi tới hàm destroy của laravel để xóa 1 object
        Tour::destroy($id);

        $dataResp = [
            'status' => true
        ];
        return response()->json($dataResp, 200);
    }
}