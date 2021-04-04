@extends('admin.home')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">@lang('admin.users')</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">@lang('admin.create')</li>
                            <li class="breadcrumb-item"><a href="{{route('admin.users.index')}}">@lang('admin.users')</a></li>
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
                                <h3 class="card-title">{{$title}}</small></h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" action="{{route('admin.users.store')}}" method="post" enctype="multipart/form-data">
                                {!! csrf_field() !!}
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">@lang('admin.name')</label>
                                        <input type="text" class="form-control" id="name" placeholder="@lang('admin.name')" name="name" value="{{old('name')}}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="email">@lang('admin.email')</label>
                                        <input type="email" class="form-control" id="email" placeholder="@lang('admin.email')" name="email" value="{{old('email')}}" required>
                                    </div>


                                    <div class="form-group">
                                        <label for="image">@lang('admin.image')</label>
                                        <input type="file" class="form-control image" id="image" placeholder="@lang('admin.image')" name="image" >
                                    </div>

                                    <div class="form-group">
                                        <img src="{{asset('uploads/user_images/default.png')}}" class="img-thumbnail image-preview" width="100px" height="100px">
                                    </div>


                                    <div class="form-group">
                                        <label for="password">@lang('admin.password')</label>
                                        <input type="password" class="form-control" id="password" placeholder="@lang('admin.password')" name="password" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="password_confirmation">@lang('admin.password_confirmation')</label>
                                        <input type="password" class="form-control" id="password_confirmation" placeholder="@lang('admin.password_confirmation')" name="password_confirmation" required>
                                    </div>

                                    <div class="form-group">
                                        @php
                                            $models = ['users','categories','products','clients','orders'];
                                            $maps = ['create','read','update','delete'];
                                        @endphp
                                        <label for="permissions">@lang('admin.permissions')</label>
                                        <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                                            @foreach($models as $index=>$model)
                                                <li class="nav-item">
                                                    <a class="nav-link {{$index == 0 ? 'active': ''}}" id="custom-content-below-home-tab" data-toggle="pill" href="#{{$model}}" role="tab" aria-controls="custom-content-below-home" aria-selected="true">@lang('admin.'.$model)</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                        <div class="tab-content" id="custom-content-below-tabContent">
                                           @foreach($models as $index=>$model)
                                                <div class="tab-pane fade show {{$index == 0 ? 'active':''}}" id="{{$model}}" role="tabpanel" aria-labelledby="custom-content-below-home-tab">
                                                    @foreach($maps as $index=>$map)
                                                        <label><input type="checkbox" name="permissions[]" value="{{$map. '_' .$model}}"> @lang('admin.'.$map) </label>
                                                    @endforeach
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('admin.add')</button>
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

    @push('js')
        <script>
            $('.image').change(function() {
            if (this.files && this.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
            $('.image-preview').attr('src', e.target.result);
            }

            reader.readAsDataURL(this.files[0]); // convert to base64 string
            }
            });
        </script>
    @endpush
@endsection
