@extends('admin.home')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">@lang('admin.categories')</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">@lang('admin.categories')</li>
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
                                <h3 class="card-title mt-2">{{$title}}<small> {{$categories->total()}}</h3>
                                <form action="{{route('admin.categories.index')}}" method="get">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <input type="text" name="search" class="form-control" placeholder="@lang('admin.search')" value="{{request()->search}}">
                                        </div>
                                        <div class="col-md-4">
                                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> @lang('admin.search')</button>
                                            @if(auth()->user()->hasPermission('create_categories'))
                                                <a href="{{route('admin.categories.create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('admin.add')</a>
                                            @else
                                                <a href="" class="btn btn-primary disabled"><i class="fa fa-plus"></i> @lang('admin.add')</a>
                                            @endif
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                @if($categories->count() > 0)
                                    <table class="table table-hover table-bordered">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>@lang('admin.name')</th>
                                            <th>@lang('admin.product_count')</th>
                                            <th>@lang('admin.related_product')</th>
                                            <th>@lang('admin.action')</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($categories as $index=>$category)
                                            <tr>
                                                <td>{{$index + 1}}</td>
                                                <td>{{$category->name}}</td>
                                                <td>{{$category->product->count()}}</td>
                                                <td><a href="{{route('admin.products.index',['category_id'=>$category->id])}}" class="btn btn-primary">@lang('admin.related_product')</a></td>
                                                <td>
                                                    @if(auth()->user()->hasPermission('update_categories'))
                                                        <a href="{{route('admin.categories.edit',$category->id)}}" class="btn btn-primary"><i class="fa fa-edit"></i> @lang('admin.edit')</a>
                                                    @else
                                                        <a href="" class="btn btn-primary disabled"><i class="fa fa-plus"></i> @lang('admin.add')</a>
                                                    @endif
                                                    @if(auth()->user()->hasPermission('delete_categories'))
                                                        <form action="{{route('admin.categories.destroy',$category->id)}}" method="post" style="display: inline-block">
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
                    {{$categories->appends(request()->query())->links()}}
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
