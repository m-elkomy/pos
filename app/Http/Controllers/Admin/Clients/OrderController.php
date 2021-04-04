<?php

namespace App\Http\Controllers\Admin\Clients;

use App\Category;
use App\Client;
use App\Http\Controllers\Controller;
use App\Order;
use App\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Client $client)
    {
        $categories = Category::with('product')->get();
        return view('admin.clients.orders.create',['title'=>trans('admin.order create'),'client'=>$client,'categories'=>$categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Client $client)
    {

        $request->validate([
            'products'=>'required|array',
            'quantities'=>'required|array',
        ]);
        $total_price = 0;
        $order = $client->orders()->create([]);
        foreach ($request->products as $index=>$product){
            $pro = Product::FindOrFail($product);
            $total_price += $pro->sale_price * $pro['quantity'];

            $order->products()->attach($product,['quantity'=>$request->quantities[$index]]);

            $pro->update([
                'stock'=>$pro->stock - $request->quantities[$index],
            ]);
        }
        $order->update(['total_price'=>$total_price]);
        session()->flash('success',trans('admin.Record Added'));
        return redirect(route('admin.orders.index'));

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client,Order $order)
    {
        $categories = Category::with('product')->get();

        return view('admin.clients.orders.edit',['title'=>trans('admin.edit'),'client'=>$client,'order'=>$order,'categories'=>$categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Client $client, Order $order)
    {
        $request->validate([
        'products'=>'required|array',
        ]);

        $this->detach_order($order);


        $this->attach_order($request,$client);

        session()->flash('success',trans('admin.Record Added'));
        return redirect(route('admin.orders.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order,Client $client)
    {
        //
    }

    public function attach_order($request,$client){
        $total_price = 0;

        $order = $client->orders()->create([]);


        $order->products()->attach($request->products);

        foreach ($request->products as $index=>$product){

            $pro = Product::FindOrFail($index);

            $total_price += $pro->sale_price * $product['quantity'];

            $pro->update([
                'stock'=>$pro->stock - $product['quantity'],
            ]);
        }
        $order->update(['total_price'=>$total_price]);
    }


    private function detach_order($order){
        foreach ($order->products as $product){
            $product->update([
                'stock'=>$product->stock + $product->pivot->quantity
            ]);
        }
        $order->delete();
    }
}
