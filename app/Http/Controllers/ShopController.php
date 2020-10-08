<?php

namespace App\Http\Controllers;

use App\Category;
use App\Contact;
use App\Image;
use App\Setting;
use App\Tour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use PhpParser\Node\Expr\AssignOp\Concat;

class ShopController extends GeneralController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index () {

        $list = [];
        $hot = [];
        $country = [];
        $foreign = [];

        foreach( $this->categories as $key => $item ) { //$categories la lấy theo key
            if ( ( $item->position == 1 && $item->is_hot == 1 ) && ( count($hot) < 8 )) {
                $hot[] = $item;
            } else if( $item->position == 2 && $item->is_hot == 1 ) {
                if ( $item->parent_id == 1 && count($country) < 6 ) {
                    $country[] = $item; 
                    // lay tour trong nước
                } else if ( $item->parent_id == 2 && count($foreign) <6 ) {
                    $foreign[] = $item;
                }
            } 
        }

        // dd(count($hot));

        $check = "index";

        // dd($this->settings->attributes);
        
        return view('shop.home', [
            'setting' => $this->settings,
            'hot' => $hot,
            'country' => $country,
            'foreign' => $foreign,
            'list' => $list,
            'check' => $check
        ]);
    }

    public function getListCategories () {

        $country = [];
        $foreign = [];

        foreach ( $this->categories as $key => $item ) {
            if ( $item->position != 0 ) {
                if ( $item->parent_id == 1 && count($country) < 12 ) {
                    $country[] = $item;
                } else if ( $item->parent_id == 2 && count($foreign) < 12 ) {
                    $foreign[] = $item;
                } 
            }
        }

        $check = "tour";

        return view ('shop.list-categories', [
            'country' => $country,
            'foreign' => $foreign,
            'check' => $check,
        ]);
    }

    public function searchTour (Request $request) 
    {
        $keyword = $request->input('tim-kiem');
    
        $slug = Str::slug($keyword);
    
        $cate = DB::table('categories')->where([['slug', 'like', '%' . $slug . '%'], ['is_active', '=', 1] ])->get();

        // $cate = Category::where([['slug', 'like', '%' . $slug . '%']])->get();

        // $cate = DB::table('tours')
        //         ->join('categories', 'category_id', '=', 'categories.id')
        //         ->select('tours.*')
        //         ->where('slug', 'like', "%". $slug. "%")->get();

        // dd($cate);

        $cate_id = [];
        foreach ($cate as $item) {
            $cate_id [] = $item->id;
        }
        
        // $list = [];

        $query = Tour::where([['is_active', '=' , 1],
                            ['start_date', '>' , date('Y-m-d') ]])->whereIn('category_id', $cate_id)->whereColumn('member_num', '<', "total_num");

        $total = count($query->get()); 

        $list = $query->paginate(5);

        return view ('shop.search', [
            'setting' => $this->settings,
            'list' => $list,
            'total' => $total,
            'slug' => $slug,
            'check' => 'tour',
            'total_page' => $list->lastPage(),
        ]);
        
    }

    public function getListTour(Request $request, $slug) 
    {

        $cate = Category::where(['slug' => $slug])->first();

        $query = Tour::where([['category_id' , '=' , $cate->id],
                            ['is_active', '=' , 1],
                            ['start_date', '>' , date('Y-m-d') ]])->whereColumn('member_num', '<', "total_num");
        // $query = Tour::where([['is_active', '=' , 1],
        //                     ['start_date', '>' , date('Y-m-d') ]]);
        // dd($sort_date, $sort_price);
        $total = count($query->get());

        $list = $query->paginate(5);

        // dd($list->lastPage());

        return view ('shop.tour', [
            'setting' => $this->settings,
            'list' => $list,
            'total' => $total,
            'cate' => $cate->name,
            'check' => 'tour',
            'total_page' => $list->lastPage(),
        ]);
    }

    public function getTourDetail ($slug, $id) 
    {
        $images = Image::where([['is_active', '=', 1],
                                ['tour_id', '=', $id],
                                'position' => 1])->orderBy('id', 'desc')->get();
        
        $tour = Tour::findOrFail($id);
        // dd($images);
        return view ('shop.tour-detail', [
            'setting' => $this->settings,
            'check' => 'tour',
            'tour' => $tour,
            'transports' => $this->transports,
            'positions' => $this->positions,
            'images' => $images
        ]);
    }

    public function sortTours (Request $request)
    {

        $sort_date = $request->query('sort_date');
        $sort_price = $request->query('sort_price');
        $sort_time = $request->query('sort_time');
        $position = $request->query('position');
        $price = $request->query('price');
        
        $query = Tour::where([['is_active', '=' , 1],
                            ['start_date', '>' , date('Y-m-d') ]])->whereColumn('member_num', '<', "total_num");


        if (!empty($position)) {
            if ($position == 'ha-noi') {
                $query->where('starting_position_id', '=', 1);
            }

            if ($position == 'hcm') {
                $query->where('starting_position_id', '=', 2);
            }
        }

        if (!empty($price)) {
            $arr_price = explode('-', $price);

            if ($arr_price) {
                $min_val = (int)$arr_price[0];
                $max_val = (int)$arr_price[1];

                if ($min_val > 0) {
                    $query->where('price', '>=', $min_val);
                }

                if ($max_val > 0) {
                    $query->where('price', '<=', $max_val);
                }
            }
        }

        if ( !empty($sort_date) ) {
            if ($sort_date == 'tang-dan') {
                $query->orderBy('start_date', 'ASC');
            }
            if ($sort_date == 'giam-dan') {
                $query->orderBy('start_date', 'DESC');
            }
        }

        if ( !empty($sort_price) ) {
            if ($sort_price == 'tang-dan') {
                $query->orderBy('price', 'ASC');
            }
            if ($sort_price == 'giam-dan') {
                $query->orderBy('price', 'DESC');
            }
        }

        if ( !empty($sort_time) ) {
            if ($sort_time == 'tang-dan') {
                $query->orderBy('days', 'ASC');
            }
            if ($sort_time == 'giam-dan') {
                $query->orderBy('days', 'DESC');
            }
        }

        $list = $query->paginate(5);

        $total = $list->count();

        $dataResp = [
            'setting' => $this->settings,
            'status' => true,
            'list' => $list,
            'data' => $list->items(),
        ];

        return response()->json($dataResp, 200);
    }

    public function contact() 
    {
        $setting = Setting::first();
        return view('shop.contact', [
            'setting' => $setting,
            'check' => 'contact',
        ]);
    }

    public function getContact(Request $request) 
    {
        // dd($request->input('content'));

        $request->validate([
            'name' => 'required|max:30',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'email' => 'required|email',
            'content' => 'required'
        ],[
            'name.required' => 'Yêu cầu không bỏ trống',
            'name.max' => 'Tên quá dài',
            'phone.required' => 'Yêu cầu không để trống',
            'phone.regex' => 'Yêu cầu nhập đúng định dạng',
            'email.required' => 'Yêu cầu không để trống',
            'email.email' => 'Yêu cầu nhập đúng định dạng',
            'content.required' => 'Yêu cầu không để trống',
            // 'content.min' => 'Yêu cầu độ dài hơn 10 kí tự',
        ]);
        
        $contact = new Contact();
        $contact->name = $request->input('name');
        $contact->phone = $request->input('phone');
        $contact->email = $request->input('email');
        $contact->content = $request->input('content'); 
        $contact->status = 1;
        // $contact->save();
        return view('shop.contact', [
            'setting' => $this->settings,
            'check' => 'contact',
            'finish' => 'true',
        ]);
    }


}