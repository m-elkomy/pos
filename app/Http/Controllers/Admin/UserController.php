<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
class UserController extends Controller
{
    public function __construct(){
        $this->middleware(['permission:read_users'])->only('index');
        $this->middleware(['permission:create_users'])->only('create');
        $this->middleware(['permission:update_users'])->only('edit');
        $this->middleware(['permission:delete_users'])->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::whereRoleIs('admin')->where(function ($q) use($request){
            return $q->when($request->search,function($query) use($request){
                return $query->where('name','like','%'.$request->search.'%')->orWhere('email','like','%'.$request->search.'%');
            });
        })->latest()->paginate(5);
        return view('admin.users.index',['title'=>trans('admin.users'),'users'=>$users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create',['title'=>trans('admin.create')]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required|unique:users,email',
            'image'=>'image',
            'password'=>'required|confirmed',
            'permissions'=>'required|min:1',
        ]);
        $request_data = $request->except(['password','password_confirmation','permissions','image']);

        $request_data['password']=bcrypt($request->password);

        if($request->image){
            Image::make($request->image)->resize(300,null,function ($constraints){
                $constraints->aspectRatio();
            })->save(public_path('uploads/user_images/'.$request->image->hashName()));

            $request_data['image'] = $request->image->hashName();
        }
        $user = User::create($request_data);

        $user->attachRole('admin');
        $user->syncPermissions($request->permissions);
        session()->flash('success',trans('admin.Record Added'));
        return redirect(route('admin.users.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.users.edit',['title'=>trans('admin.edit'),'user'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required|unique:users,email,'.$user->id,
            'image'=>'image',
            'permissions'=>'required|min:1',
        ]);


        $request_data = $request->except(['permissions','image']);

        if($request->image){
            if($user->image != 'default.png'){
                unlink(public_path('uploads/user_images/'.$user->image));
            }
            Image::make($request->image)->resize(300,null,function ($constraints){
                $constraints->aspectRatio();
            })->save(public_path('uploads/user_images/'.$request->image->hashName()));

            $request_data['image'] = $request->image->hashName();
        }

        if($request->has('password')){
            $request_data['password'] = bcrypt($request->password);
        }


        $user->update($request_data);

        $user->syncPermissions($request->permissions);
        session()->flash('success',trans('admin.Record Updated'));
        return redirect(route('admin.users.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if($user->image != 'default.png'){
            unlink(public_path('uploads/user_images/'.$user->image));
        }
        $user->delete();
        session()->flash('success',trans('admin.Record Deleted'));
        return redirect(route('admin.users.index'));
    }
}
