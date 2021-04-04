<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Category::when($request->search,function ($q) use($request){
            return $q->whereTranslationLike('name','%'.$request->search.'%');
        })->latest()->paginate(5);
        return view('admin.categories.index',['title'=>trans('admin.categories'),'categories'=>$categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create',['title'=>trans('admin.create')]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [];
        foreach (config('translatable.locales') as $local){
            $rules+=[$local.'.name'=>['required',Rule::unique('category_translations','name')]];
        }
        $request->validate($rules);

        Category::create($request->all());
        session()->flash('success',trans('admin.Record Added'));
        return redirect(route('admin.categories.index'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit',['title'=>trans('admin.edit'),'category'=>$category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $rules = [];
        foreach (config('translatable.locales') as $local){
            $rules+=[$local.'.name'=>['required',Rule::unique('category_translations','name')->ignore('category_id','category_id')]];
        }
        $request->validate($rules);

        $category->update($request->all());
        session()->flash('success',trans('admin.Record Updated'));
        return redirect(route('admin.categories.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        session()->flash('success',trans('admin.Record Deleted'));
        return redirect(route('admin.categories.index'));
    }
}
