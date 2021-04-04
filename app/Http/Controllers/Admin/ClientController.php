<?php

namespace App\Http\Controllers\Admin;

use App\Client;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $clients = Client::when($request->search,function($q) use($request){
            return $q->where('name','like','%'.$request->search.'%')->orWhere('address','like','%'.$request->search.'%')
                ->orWhere('phone','like','%'.$request->search.'%');
        })->latest()->paginate(5);
        return view('admin.clients.index',['title'=>trans('admin.clients'),'clients'=>$clients]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.clients.create',['title'=>trans('admin.create')]);
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
            'phone'=>'required|array|min:1',
            'phone.0'=>'required',
            'address'=>'required',
        ]);

        $request_data = $request->all();
        $request_data['phone'] = array_filter($request->phone);
        Client::create($request_data);
        session()->flash('success',trans('admin.Record Added'));
        return redirect(route('admin.clients.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        return view('admin.clients.edit',['title'=>trans('admin.edit'),'client'=>$client]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        $request->validate([
            'name'=>'required',
            'phone'=>'required|array|min:1',
            'phone.0'=>'required',
            'address'=>'required',
        ]);

        $request_data = $request->all();
        $request_data['phone'] = array_filter($request->phone);
        $client->update($request_data);
        session()->flash('success',trans('admin.Record Updated'));
        return redirect(route('admin.clients.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $client->delete();
        session()->flash('success',trans('admin.Record Deleted'));
        return redirect(route('admin.clients.index'));
    }
}
