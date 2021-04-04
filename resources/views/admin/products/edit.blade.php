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
                            <li class="breadcrumb-item">@lang('admin.edit')</li>
                            <li class="breadcrumb-item"><a href="{{route('admin.products.index')}}">@lang('admin.products')</a></li>
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
                            <form role="form" action="{{route('admin.products.update',$product->id)}}" method="post" enctype="multipart/form-data">
                                {!! csrf_field() !!}
                                {!! method_field('put') !!}
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="category_id">@lang('admin.categories')</label>
                                        <select name="category_id" class="form-control">
                                            <option value="">@lang('admin.all categories')</option>
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}" {{$product->category_id == $category->id?'selected':''}}>{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    @foreach(config('translatable.locales') as $local)

                                        <div class="form-group">
                                            <label for="name">@lang('admin.'.$local.'.name')</label>
                                            <input type="text" class="form-control" id="name" placeholder="@lang('admin.name')" name="{{$local}}[name]" value="{{$product->name}}">
                                        </div>

                                        <div class="form-group">
                                            <label for="description">@lang('admin.'.$local.'.description')</label>
                                            <textarea class="form-control ckeditor" id="description" name="{{$local}}[description]">{{$product->description}}</textarea>
                                        </div>

                                    @endforeach

                                    <div class="form-group">
                                        <label for="image">@lang('admin.image')</label>
                                        <input type="file" class="form-control image" id="image" placeholder="@lang('admin.image')" name="image" >
                                    </div>

                                    <div class="form-group">
                                        <img src="{{$product->image_path}}" class="img-thumbnail image-preview" width="100px" height="100px">
                                    </div>

                                    <div class="form-group">
                                        <label for="purchase_price">@lang('admin.purchase_price')</label>
                                        <input type="number" class="form-control" id="purchase_price" step="0.01" placeholder="@lang('admin.purchase_price')" name="purchase_price" value="{{$product->purchase_price}}">
                                    </div>

                                    <div class="form-group">
                                        <label for="sale_price">@lang('admin.sale_price')</label>
                                        <input type="number" class="form-control" id="sale_price" placeholder="@lang('admin.sale_price')" step="0.01" name="sale_price" value="{{$product->sale_price}}" >
                                    </div>

                                    <div class="form-group">
                                        <label for="stock">@lang('admin.stock')</label>
                                        <input type="number" class="form-control" id="stock" placeholder="@lang('admin.stock')"  name="stock" value="{{$product->stock}}" >
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
    @push('js')
        <script>
            CKEDITOR.config.language="{{app()->getLocale()}}"
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
