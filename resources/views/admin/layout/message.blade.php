@if(session()->has('success'))
    @push('js')
        <script>
            new Noty({
                type:'success',
                layout:'topRight',
                text:'{{session('success')}}',
                timeout:2000,
                killer:true,
            }).show();
        </script>
    @endpush
@endif


@if(session()->has('error'))
    <div class="alert alert-danger">
        <h4>{{session('error')}}</h4>
    </div>
@endif


@if($errors->all())
    <div class="alert alert-danger">
        @foreach($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    </div>
@endif
