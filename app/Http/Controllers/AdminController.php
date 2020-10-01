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
        //chi dinh lai ten bang protected $table = 'role';
        // $numberOrder = Order::count();
        // $numberArticle = Article::count();
        // $numberProduct = Product::count();
        // $numberUser = User::count();

        // $data = [
        //     'numOrder' => $numberOrder,
        //     'numArticle' => $numberArticle,
        //     'numProduct' => $numberProduct,
        //     'numUser' => $numberUser
        // ];

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
        return view('admin.dashboard', $data); //ten view, du lieu truyen sang view neu co

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
