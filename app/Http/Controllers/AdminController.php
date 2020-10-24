<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use App\Order;
use App\Product;
use App\Tour;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class AdminController extends Controller
{
    public function index()
    {
        $numCate = Category::count();
        $numTour = Tour::count();
        $numOrder = Order::count();
        $numUser = User::count();

        $data = [
            'numCate' => $numCate,
            'numTour' => $numTour,
            'numOrder' => $numOrder,
            'numUser' => $numUser, 
        ];

        $enable_tour = count(Tour::where([['is_active', '=',  1], ['start_date', '>' , date('Y-m-d') ]] )->whereColumn('member_num', '<', "total_num")->get());
        $outdate_tour = count(Tour::where([['is_active', '=',  1], ['start_date', '<=' , date('Y-m-d') ]])->get());
        $outnumber_tour = count(Tour::where([['is_active', '=',  1]])->whereColumn('member_num', '>=', "total_num")->get());

        for ( $i = 1; $i < 13; $i++) {
            $country [] = count(DB::table('categories')->join('tours', 'tours.category_id', '=', 'categories.id')
            ->join('orders', 'orders.tour_id', '=', 'tours.id')
            ->where([['categories.parent_id', '=', 1]])
            ->whereMonth('orders.created_at', $i)
            ->whereYear('orders.created_at', getdate()['year']) 
            ->get()); 
        }

        for ( $i = 1; $i < 13; $i++) {
            $foreign [] = count(DB::table('categories')->join('tours', 'tours.category_id', '=', 'categories.id')
            ->join('orders', 'orders.tour_id', '=', 'tours.id')
            ->where([['categories.parent_id', '=', 2]])
            ->whereYear('orders.created_at', getdate()['year']) 
            ->whereMonth('orders.created_at', $i)
            ->get()); 
        }

        // dd((getdate()['year']));
       
        $min_year = DB::select('select min(year(created_at)) as year from orders');

        $max_year = DB::select('select max(year(created_at)) as year from orders');

        $test2 = '';

        $j = 0;
        for ($i = $min_year[0]->year; $i <= $max_year[0]->year; $i++) {
            $total [] = DB::table('orders')->whereYear('created_at', $i)->sum('price');
            $test2 .= "['".$i."',".$total[$j].'],';
            $j++;
        }

        
        // dd($test2, $total[2]);

        // dd($max_year[0]->year, $min_year[0]->year);

        $test = '';

        for ( $i=0; $i<12; $i++ ) {
            $test .= "['T".($i+1)."',". $country[$i].','. $foreign[$i].'],';
        }

        // dd($test);
        
        // $january = count(DB::table('categories')->join('tours', 'tours.category_id', '=', 'categories.id')
        //     ->join('orders', 'orders.tour_id', '=', 'tours.id')
        //     ->where([['categories.parent_id', '=', 1]])
        //     ->whereMonth('orders.created_at', 1)
        //     ->get());

    
        return view('admin.dashboard', $data, [
            'enable_tour' => $enable_tour, 
            'outdate_tour' => $outdate_tour,
            'outnumber_tour' => $outnumber_tour,
            'test' => $test,
            'test2' => $test2,
        ]); 
         
    }

    public function searchCategory(Request $request) {
        $keyword = $request->query('search_name');
        $slug = Str::slug($keyword);
        $data = DB::table('categories')->where([['slug', 'like', '%' . $slug . '%']])->latest()->paginate(10);
        $categories = Category::where('parent_id', 0)->get();
        return view('admin.category.index', [
            'data' => $data,
            'categories' => $categories
        ]);
    }

    public function searchTour(Request $request) 
    {
        $keyword = $request->query('search_name');
        $slug = Str::slug($keyword);
        $data = DB::table('tours')->where([['slug', 'like', '%' . $slug . '%']]);
        $categories = Category::where([['is_active', '=',  1], ['parent_id', '=', '0']])->orderBy('name', 'desc')->get();

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

        $data = $query->latest()->paginate(10);

        return view('admin.tour.index', [
            'data' => $data,
            'categories' => $categories,
            'location' => $location,
            'number' => $number,
            'time' => $time,
            'status' => $status,
        ]);
    }


}
