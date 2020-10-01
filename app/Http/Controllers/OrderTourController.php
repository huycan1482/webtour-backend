<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderDetail;
use App\Position;
use App\Setting;
use App\Tour;
// use Illuminate\Contracts\Mail\Mailer;

use Illuminate\Http\Request;
// use App\Http\Controllers\Mail;
use App\Mail\ShoppingMail;
// use App\Mail;
use Illuminate\Support\Facades\Mail;


class OrderTourController extends Controller
{
 
    public function getOrder($slug, $id) 
    {
        $settings = Setting::first();

        $position = Position::where(['is_active' => 1])->get();

        $tour = Tour::findOrFail($id);

        session()->put('id', $id);

        return view ('shop.order', [
            'settings' => $settings,
            'check' => '',
            'position' => $position,
            'tour' => $tour,
        ]);
    }

    public function storeOrder(Request $request) 
    { 
        $settings = Setting::first();
        $request->validate ([
            'name' => 'required',
            'mail' => 'required|email',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'address' => 'required',
            'price' => 'required|integer|min:1',
            'visa_num' => 'integer|min:0',
            'price_5_11' => 'integer|min:0',
            'price_2_5' => 'integer|min:0',
            'price_1_2' => 'integer|min:0',
        ],[
            'name.required' => 'Yêu cầu không để trống',
            'mail.required' => 'Yêu cầu không để trống',
            'mail.email' => 'Không đúng định dạng mail',
            'phone.required' => 'Yêu cầu không để trống',
            'phone.regex' => 'Không đúng định dạng', 
            'address.required' => 'Yêu cầu không để trống',
            'price.required' => 'Yêu cầu không để để trống',
            'price.integer' => 'Không đúng định dạng số',
            'price.min' => 'Số lượng người lớn phải lớn hơn 1',
            'visa_num.integer' => 'Không đúng định dạng số',
            'visa_num.min' => 'Số lượng phải từ 0 trở lên',
            'price_5_11.integer' => 'Không đúng định dạng số',
            'price_5_11.min' => 'Số lượng phải từ 0 trở lên',
            'price_2_5.integer' => 'Không đúng định dạng số',
            'price_2_5.min' => 'Số lượng phải từ 0 trở lên',
            'price_1_2.integer' => 'Không đúng định dạng số',
            'price_1_2.min' => 'Số lượng phải từ 0 trở lên',
        ]);

        $price = $request->input('price');
        $price_5_11 = $request->input('price_5_11');
        $price_2_5 = $request->input('price_2_5');
        $price_1_2 = $request->input('price_1_2');

        $id = session()->get('id');

        $tour = Tour::find($id);

        if ($tour) {
            // $total = $tour->price;
            $total = $tour->price*$price +  $tour->price_5_11*$price_5_11 + $tour->price_2_5*$price_2_5 + $tour->price_1_2*$price_1_2 ;

            // $update_tour = new Tour();
       
            $order = new Order();
            $order->tour_id = $id;
            $order->user_name = $request->input('name');
            $order->user_mail = $request->input('mail');
            $order->user_phone = $request->input('phone');
            $order->user_address = $request->input('address');
            $order->user_note = $request->input('note');
            $order->price = $total;
            $order->visa_num = $request->input('visa_num');
            $order->adults_num = $request->input('price');
            $order->child_1_2 = $request->input('price_1_2');
            $order->child_2_5 = $request->input('price_2_5');
            $order->child_5_11 = $request->input('price_5_11');
            $order->start_date = $tour->start_date;
            $order->end_date = $tour->end_date;
            $order->code = 'DH-'.date('d').date('m').date('Y').'-'.time();
            $order->discount = 0;
            $order->coupon = 0;
            $order->order_status_id = 1;
            $tour->member_num += 1; 
        
            $order->save();
            $tour->save();

            $position = Position::where(['is_active' => 1])->get();

            $tour = Tour::findOrFail($id);
            
            Mail::to($order->user_mail)->send(new ShoppingMail($order, 'shopping'));

        }
        return view ('shop.order', [ 
            'settings' => $settings,
            'check' => 'finish',
            'position' => $position,
            'tour' => $tour,
            'code' => $order->code,
        ]);
    }

    // public function updateOrder() 
    // {
    //     $price = $_GET['price'];

    //     return response()->json([
    //         'status'  => true,
    //         'tour' => 'check',
    //         'data' => view('components.order')->render()
    //     ]);
    // }
}
