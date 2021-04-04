@extends('admin.home')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">@lang('admin.products')</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">@lang('admin.products')</li>
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
                    <div class="col-12">
                        <div class="card card-outline">
                            <div class="card-header">
                                <h3 class="card-title mt-2">{{$title}}<small> {{$products->total()}}</h3>
                                <form action="{{route('admin.products.index')}}" method="get">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <input type="text" name="search" class="form-control" placeholder="@lang('admin.search')" value="{{request()->search}}">
                                        </div>
                                        <div class="col-md-4">
                                            <select name="category_id" class="form-control">
                                                <option value="">@lang('admin.all categories')</option>
                                                @foreach($categories as $category)
                                                    <option value="{{$category->id}}" {{request()->category_id == $category->id?'selected':''}}>{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> @lang('admin.search')</button>
                                            @if(auth()->user()->hasPermission('create_products'))
                                                <a href="{{route('admin.products.create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('admin.add')</a>
                                            @else
                                                <a href="" class="btn btn-primary disabled"><i class="fa fa-plus"></i> @lang('admin.add')</a>
                                            @endif
                                        </div>

                                    </div>
                                </form>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                @if($products->count() > 0)
                                    <table class="table table-hover table-bordered">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>@lang('admin.image')</th>
                                            <th>@lang('admin.name')</th>
                                            <th>@lang('admin.description')</th>
                                            <th>@lang('admin.purchase_price')</th>
                                            <th>@lang('admin.sale_price')</th>
                                            <th>@lang('admin.stock')</th>
                                            <th>@lang('admin.profit percent') %</th>
                                            <th>@lang('admin.action')</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($products as $index=>$product)
                                            <tr>
                                                <td>{{$index + 1}}</td>
                                                <td><img src="{{$product->image_path}}" width="50px" height="50px" class="img-thumbnail"></td>
                                                <td>{{$product->name}}</td>
                                                <td>{!! $product->description !!}</td>
                                                <td>{{$product->purchase_price}}</td>
                                                <td>{{$product->sale_price}}</td>
                                                <td>{{$product->stock}}</td>
                                                <td>{{$product->profit_percent}} %</td>
                                                <td>
                                                    @if(auth()->user()->hasPermission('update_products'))
                                                        <a href="{{route('admin.products.edit',$product->id)}}" class="btn btn-primary"><i class="fa fa-edit"></i> @lang('admin.edit')</a>
                                                    @else
                                                        <a href="" class="btn btn-primary disabled"><i class="fa fa-plus"></i> @lang('admin.add')</a>
                                                    @endif
                                                    @if(auth()->user()->hasPermission('delete_products'))
                                                        <form action="{{route('admin.products.destroy',$product->id)}}" method="post" style="display: inline-block">
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
                        </div>
                    {{$products->appends(request()->query())->links()}}
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
