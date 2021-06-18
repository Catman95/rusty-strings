<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function get_by_user(){
        $id = session()->get('user')->id;
        $orders = Order::where('user_id', $id)->get();
        return view('pages.account', ['orders' => $orders]);
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
        $items = $request->input('items');
        $address = $request->input('address');
        $total = $request->input('total');

        $order = Order::create([
           'user_id' => session()->get('user')->id,
            'address' => $address['street_and_no'],
            'zip_code' => $address['zip_code'],
            'city' => $address['city'],
            'phone' => $address['phone']
        ]);

        $order_id = $order->id;

        $model = new Order();
        $model->insert_items($items, $order_id);

        return response()->json(['status' => 'success']);
    }

    public function checkout_list(Request $request){
        $cart = $request->input('cart');
        $items = [];
        $ids = [];
        foreach ($cart as $item){
            $items[$item['id']] = $item['quantity'];
            array_push($ids, $item['id']);
        }
        $products = Product::whereIn('id', $ids)->get();
        foreach ($products as $product){
            $product->quantity = $items[$product->id];
            $product->total = $product->quantity * $product->price;
        }
        return response()->json($products);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $order = Order::where('id', $id)->first();
            $model = new Order();
            $order->items = $model->get_items($id);
            $order->user = User::find($order->user_id);
            $orderTotal = 0;
            foreach ($order->items as $item){
                $orderTotal += $item->quantity * $item->price_then;
            }
            $order->total = $orderTotal;
            return view('pages.order', ['order' => $order]);
        }catch (\Exception $e){
            dd($e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
