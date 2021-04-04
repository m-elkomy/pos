@extends('admin.home')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">@lang('admin.orders')</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">@lang('admin.orders')</li>
                            <li class="breadcrumb-item active"><a href="{{route('admin.index')}}">@lang('admin.dashboard')</a></li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                @include('admin.layout.message')



                <div class="row">
                    <!-- left column -->
                    <div class="col-md-6">
                        <!-- general form elements -->
                        <div class="card card-default">
                            <div class="card-header">
                                <h3 class="card-title">@lang('admin.orders')</h3>
                                <form action="{{route('admin.orders.index')}}" method="get">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <input type="text" name="search" class="form-control" placeholder="@lang('admin.search')" value="{{request()->search}}">
                                        </div>
                                        <div class="col-md-4">
                                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> @lang('admin.search')</button>
                                        </div>

                                    </div>
                                </form>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <div class="card-body">
                                        <div class="card-body">
                                            @if($orders->count() > 0)
                                                <table class="table table-hover table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th>@lang('admin.client_name')</th>
                                                        <th>@lang('admin.price')</th>
                                                        <th>@lang('admin.created_at')</th>
                                                        <th>@lang('admin.products')</th>
                                                        <th>@lang('admin.action')</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($orders as $index=>$order)
                                                        <tr>
                                                            <td>{{$order->client->name}}</td>
                                                            <td>{{number_format($order->total_price,2)}}</td>
                                                            <td>
                                                                {{$order->created_at->toFormattedDateString()}}
                                                            </td>
                                                            <td>
                                                                <button class="btn btn-primary order-products"
                                                                data-url="{{route('admin.orders.products',$order->id)}}" data-method="get"><i class="fa fa-list"></i> @lang('admin.show products')</button>
                                                            </td>
                                                            <td>
                                                                @if(auth()->user()->hasPermission('update_orders'))
                                                                    <a href="{{route('admin.clients.order.edit',['client'=>$order->client->id,'order'=>$order->id])}}" class="btn btn-primary"><i class="fa fa-edit"></i> @lang('admin.edit')</a>
                                                                @else
                                                                    <a href="" class="btn btn-primary disabled"><i class="fa fa-plus"></i> @lang('admin.add')</a>
                                                                @endif
                                                                @if(auth()->user()->hasPermission('delete_orders'))
                                                                    <form action="{{route('admin.orders.destroy',$order->id)}}" method="post" style="display: inline-block">
                                                                        {!! csrf_field() !!}
                                                                        {!! method_field('delete') !!}
                                                                        <button type="submit" class="btn btn-danger delete"><i class="fa fa-trash"></i> @lang('admin.delete')</button>
                                                                    </form>
                                                                @else
                                                                    <button class="btn btn-danger disabled"><i class="fa fa-trash"></i> @lang('admin.delete')</button>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            @else
                                                <div class="col-md-12 mt-5 mb-5">
                                                    <h4 class="text-center alert alert-info">{{trans('admin.no_data_found')}}</h4>
                                                </div>
                                            @endif

                                        </div>
                                        <!-- /.card-body -->
                                        <!-- /.card -->
                            </div>
                        </div>
                        <!-- /.card -->

                    </div>

                    <div class="col-md-6">
                        <!-- general form elements -->
                        <div class="card card-default">
                            <div class="card-header">
                                <h3 class="card-title">@lang('admin.show products')</small></h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <div class="card-body">
                                <div id="order-product-list">

                                </div>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>

                </div>


            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    @push('js')
    <script>
        $('.delete').click(function(e){
            var that = $(this);
            e.preventDefault();
            var n = new Noty({
                text:"@lang('admin.confirm_delete')",
                type:"warning",
                killer:true,
                buttons:[
                    Noty.button("@lang('admin.yes')",'btn btn-success mr-2',function (){
                        that.closest('form').submit()
                    }),
                    Noty.button("@lang('admin.no')",'btn btn-primary mr-2',function(){
                        n.close()
                    })
                ]
            }).show()
        });
    </script>
    @endpush
@endsection
