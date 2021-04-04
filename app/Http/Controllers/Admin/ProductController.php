<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = Product::when($request->search,function($q) use($request){
            return $q->whereTranslationLike('name','%'.$request->search.'%')->orWhere('description','%'.$request->search.'%');
        })->when($request->category_id,function($query) use($request){
            return $query->where('category_id',$request->category_id);
        })->latest()->paginate(5);
        $categories = Category::all();
        return view('admin.products.index',['title'=>trans('admin.products'),'products'=>$products,'categories'=>$categories]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return  view('admin.products.create',['title'=>trans('admin.create'),'categories'=>$categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'category_id'=>'required'
        ];
        foreach (config('translatable.locales') as $local){
            $rules+=[$local.'.name'=>'required|unique:product_translations,name'];
            $rules+=[$local.'.description'=>'required'];
        }
        $rules+=[
            'purchase_price'=>'required',
            'sale_price'=>'required',
            'stock'=>'required',
        ];
        $request->validate($rules);

        $request_data = $request->all();


        if($request->image){
            Image::make($request->image)->resize(300,null,function ($constraints){
                $constraints->aspectRatio();
            })->save(public_path('uploads/product_images/'.$request->image->hashName()));

            $request_data['image'] = $request->image->hashName();
        }
        Product::create($request_data);
        session()->flash('success',trans('admin.Record Added'));
        return redirect(route('admin.products.index'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit',['title'=>trans('admin.edit'),'product'=>$product,'categories'=>$categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $rules = [
            'category_id'=>'required'
        ];
        foreach (config('translatable.locales') as $local){
            $rules+=[$local.'.name'=>['required',Rule::unique('product_translations','name')->ignore($product->id,'product_id')]];
            $rules+=[$local.'.description'=>'required'];
        }
        $rules+=[
            'purchase_price'=>'required',
            'sale_price'=>'required',
            'stock'=>'required',
        ];
        $request->validate($rules);

        $request_data = $request->all();


        if($request->image){
            if($product->image !='default.png'){
                unlink(public_path('uploads/product_images/'.$product->image));
            }

            Image::make($request->image)->resize(300,null,function ($constraints){
                $constraints->aspectRatio();
            })->save(public_path('uploads/product_images/'.$request->image->hashName()));

            $request_data['image'] = $request->image->hashName();
        }

        $product->update($request_data);
        session()->flash('success',trans('admin.Record Updated'));
        return redirect(route('admin.products.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if($product->image != 'default.png'){
            unlink(public_path('uploads/product_images/'.$product->image));
        }
        $product->delete();
        session()->flash('success',trans('admin.Record Deleted'));
        return redirect(route('admin.products.index'));
    }
}
