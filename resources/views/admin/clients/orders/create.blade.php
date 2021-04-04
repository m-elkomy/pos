@extends('admin.home')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">@lang('admin.clients')</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">@lang('admin.add order')</li>
                            <li class="breadcrumb-item"><a href="{{route('admin.clients.index')}}">@lang('admin.clients')</a></li>
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
                                <h3 class="card-title">@lang('admin.categories')</small></h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <div class="card-body">
                                    @foreach($categories as $category)
                                    <div class="card card-info collapsed-card">
                                        <div class="card-header">
                                            <h3 class="card-title">{{$category->name}}</h3>

                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                                                </button>
                                            </div>
                                            <!-- /.card-tools -->
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body">
                                            @if($category->product->count() > 0)
                                                <table class="table table-hover table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th>@lang('admin.name')</th>
                                                        <th>@lang('admin.sale_price')</th>
                                                        <th>@lang('admin.stock')</th>
                                                        <th>@lang('admin.action')</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($category->product as $product)
                                                        <tr>
                                                            <td>{{$product->name}}</td>
                                                            <td>{{number_format($product->sale_price,2)}}</td>
                                                            <td>{{$product->stock}}</td>
                                                            <td>
                                                                <a href=""
                                                                   id="product-{{$product->id}}"
                                                                   data-name="{{$product->name}}"
                                                                   data-id="{{$product->id}}"
                                                                   data-price="{{$product->sale_price}}"
                                                                   class="btn btn-success add-product-btn"><i class="fa fa-plus"></i> </a>
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
                                    @endforeach
                            </div>
                        </div>
                        <!-- /.card -->

                    </div>

                    <div class="col-md-6">
                        <!-- general form elements -->
                        <div class="card card-default">
                            <div class="card-header">
                                <h3 class="card-title">{{$title}}</small></h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" action="{{route('admin.clients.order.store',$client->id)}}" method="post">
                                {!! csrf_field() !!}
                            <div class="card-body">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <td>@lang('admin.product')</td>
                                            <td>@lang('admin.quantity')</td>
                                            <td>@lang('admin.price')</td>
                                            <td>@lang('admin.delete')</td>
                                        </tr>
                                    </thead>
                                    <tbody class="order-list">

                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-md-12">

                                        <h4>@lang('admin.total'): <span class="total">0</span></h4>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary btn-block disabled" id="add-order-form-btn" style="color:white"><i class="fa fa-plus"></i> @lang('admin.add order')</button>
                                    </div>
                                </div>
                            </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>

                    </div>




            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
