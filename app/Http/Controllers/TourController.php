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
        $request->validate ([
            'name' => 'required|max:255|min:10',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'category_id' => 'required|integer', 
            'transport_id' => 'required|integer', 
            'starting_position' => 'required|integer', 
            'total_num' => 'required|integer',
            'member_num'=> 'required|integer', 
            'price' => 'required|integer',
            'schedule' => 'required',
            'note' => 'required',
            'price_2_5' => 'integer',
            'price_5_11' => 'integer', 
            'price_1_2' => 'integer',  
            'visa_price' => 'integer', 

            'discount' => 'integer',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date'
        ],[
            'name.required' => 'Yêu cầu không để trống',
            'image.required' => 'Yêu cầu không để trống', 
            'category_id.required' => 'Yêu cầu không để trống', 
            'transport_id.required' => 'Yêu cầu không để trống', 
            'starting_position.required' => 'Yêu cầu không để trống',  
            'total_num.required' => 'Yêu cầu không để trống', 
            'member_num.required' => 'Yêu cầu không để trống', 
            'price.required' => 'Yêu cầu không để trống', 
            'schedule.required' => 'Yêu cầu không để trống', 
            'note.required' => 'Yêu cầu không để trống',
            'start_date.required' => 'Yêu cầu không để trống',
            'end_date.required' => 'Yêu cầu không để trống',

            'name.min' => 'Tên phải có độ dài trên 10 kí tự',
            'name.max' => 'Tên phải có độ dài dưới 255 kí tự',
            'image.img' => 'Sai định dạng ảnh',

            'category_id.integer' => 'Sai định dạng số' ,
            'transport_id.integer' => 'Sai định dạng số' ,
            'starting_position.integer' => 'Sai định dạng số' ,
            'member_num.integer' => 'Sai định dạng số' ,
            'total_num.integer' => 'Sai định dạng số',
            'price_1_2.integer' => 'Sai định dạng số' ,
            'price_2_5.integer' => 'Sai định dạng số' ,
            'price_5_11.integer' => 'Sai định dạng số' ,
            'visa_price.integer' => 'Sai định dạng số' ,
            'children_price.integer' => 'Sai định dạng số',
            'discount.integer' => 'Sai định dạng số' ,

            'start_date.date' => 'Sai định dạng ngày tháng',
            'end_date.date' => 'Sai định dạng ngày tháng',
            'end_date.after' => 'Ngày kết thúc phải sau ngày khởi hành'
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
            $tour->is_active = $is_active;
        }

        $is_hot = 0;
        if ($request->has('is_hot')) {
            $is_hot = $request->input('is_hot');
            $tour->is_hot = $is_hot;
        }
        $tour->user_id = Auth::user()->id;
        // dd($tour);
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
            'name' => 'max:255|min:10',
            'new_image' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'category_id' => 'integer', 
            'transport_id' => 'integer', 
            'starting_position' => 'integer', 
            'member_num'=> 'integer', 
            'price_1_2' => 'integer' ,
            'price_2_5' => 'integer' ,
            'price_5_11' => 'integer' ,
            'visa_price' => 'integer' ,
            'discount' => 'integer'
        ],[
            'name.min' => 'Tên phải có độ dài trên 10 kí tự',
            'name.max' => 'Tên phải có độ dài dưới 255 kí tự',
            'new_image.img' => 'Sai định dạng ảnh',

            'category_id.integer' => 'Sai định dạng số' ,
            'transport_id.integer' => 'Sai định dạng số' ,
            'starting_position.integer' => 'Sai định dạng số' ,
            'member_num.integer' => 'Sai định dạng số' ,
            'price.integer' => 'Sai định dạng số' ,
            'price_1_2.integer' => 'Sai định dạng số' ,
            'price_2_5.integer' => 'Sai định dạng số' ,
            'price_5_11.integer' => 'Sai định dạng số' ,
            'visa_price.integer' => 'Sai định dạng số' ,
            'discount.integer' => 'Sai định dạng số' 
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
        $tour->is_active = $is_active;
        
        if ($request->has('is_hot')) {
            $is_hot = $request->input('is_hot');
            
        }
        $tour->is_hot = $is_hot;
        $tour->user_id = Auth::user()->id;
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