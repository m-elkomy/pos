<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request){
        $orders = Order::whereHas('client',function($q) use($request){
            return $q->where('name','like','%'.$request->search.'%');
        })->latest()->paginate(5);

        return view('admin.orders.index',['title'=>trans('admin.orders'),'orders'=>$orders]);
    }
    public function products(Order $order){
        $products = $order->products()->get();
        return view('admin.orders.products',['title'=>trans('admin.show products'),'order'=>$order,'products'=>$products]);
    }

    public function destroy(Order $order){
        foreach ($order->products as $product){
            $product->update([
                    'stock'=>$product->stock + $product->pivot->quantity
            ]);
        }
        $order->delete();
        session()->flash('success',trans('admin.Record Deleted'));
        return redirect(route('admin.orders.index'));
    }
}
