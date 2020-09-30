<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderDetail;
use App\OrderStatus;
use App\Tour;
use App\Transport;
use Illuminate\Http\Request;

use App\Mail;
use App\Mail\ShoppingMail;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Order::latest()->paginate(10);

        return view ('admin.order.index', [
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
        $order = Order::findOrFail($id);
        $status = OrderStatus::all(); 
        $tour = Tour::all();
        $transport = Transport::all();
        return view ('admin.order.edit', [
            'order' => $order,
            'order_status' => $status,
            'tour' => $tour,
            'transport' => $transport,
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
        $order = Order::findOrFail($id);
        $order->order_status_id = $request->input('order_status_id');
        $order->user_note = $request->input('user_note');

        $order->save();
        
        return redirect()->back()->with('msg', 'Cập nhật đơn hàng thành công');
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
