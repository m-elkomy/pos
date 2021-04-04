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
                            <li class="breadcrumb-item">@lang('admin.edit')</li>
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
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-default">
                            <div class="card-header">
                                <h3 class="card-title">{{$title}}</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" action="{{route('admin.clients.update',$client->id)}}" method="post">
                                {!! csrf_field() !!}
                                {!! method_field('put') !!}
                                <div class="card-body">

                                    <div class="form-group">
                                        <label for="name">@lang('admin.name')</label>
                                        <input type="text" name="name" class="form-control" id="name" value="{{$client->name}}">
                                    </div>

                                    @for($i=0;$i<2;$i++)
                                        <div class="form-group">
                                            <label for="phone">@lang('admin.phone')</label>
                                            <input type="text" name="phone[]" class="form-control" id="phone" value="{{$client->phone[$i] ?? ''}}">
                                        </div>
                                    @endfor

                                    <div class="form-group">
                                        <label for="address">@lang('admin.address')</label>
                                        <textarea name="address" class="form-control" id="address">{{$client->address}}</textarea>
                                    </div>

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
