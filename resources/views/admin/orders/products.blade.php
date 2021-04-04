<div class="row">
    <div class="col-12">
        <div class="card card-outline">
            <div class="card-header">
                <h3 class="card-title mt-2">{{$title}}</h3>
            </div>
            <!-- /.card-header -->
            <div class="print-area">
                <div class="card-body table-responsive p-0">
                    @if($products->count() > 0)
                        <table class="table table-hover table-bordered">
                            <thead>
                            <tr>
                                <th>@lang('admin.name')</th>
                                <th>@lang('admin.quantity')</th>
                                <th>@lang('admin.price')</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $index=>$product)
                                <tr>
                                    <td>{{$product->name}}</td>
                                    <td>{{ $product->pivot->quantity }}</td>
                                    <td>{{number_format($product->pivot->quantity * $product->sale_price,2)}}</td>
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

                <div class="row">
                    <div class="col-md-12">
                            <h4 class="mr-2">@lang('admin.total'): <span class="total">0</span></h4>
                    </div>
                </div>
            </div>


            <!-- /.card-body -->
        </div>
        <div class="row">
            <div class="col-md-12">

                <button class="btn btn-primary print-btn btn-block mx-2"><i class="fa fa-print"></i> @lang('admin.print')</button>
            </div>
        </div>
{{--    {{$products->appends(request()->query())->links()}}--}}
    <!-- /.card -->
    </div>
</div>
