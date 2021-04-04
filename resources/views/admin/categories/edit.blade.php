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
                            <li class="breadcrumb-item">@lang('admin.edit')</li>
                            <li class="breadcrumb-item"><a href="{{route('admin.categories.index')}}">@lang('admin.categories')</a></li>
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
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-default">
                            <div class="card-header">
                                <h3 class="card-title">{{$title}}</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" action="{{route('admin.categories.update',$category->id)}}" method="post">
                                {!! csrf_field() !!}
                                {!! method_field('put') !!}
                                <div class="card-body">

                                @foreach(config('translatable.locales') as $local)

                                    <div class="form-group">
                                        <label for="name">@lang('admin.'.$local.'.name')</label>
                                        <input type="text" class="form-control" id="name" placeholder="@lang('admin.name')" name="{{$local}}[name]" value="{{$category->translate($local)->name}}">
                                    </div>

                                @endforeach
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> @lang('admin.edit')</button>
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
