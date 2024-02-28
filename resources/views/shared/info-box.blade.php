{{-- https://www.itsolutionstuff.com/post/laravel-form-validation-request-class-exampleexample.html --}}
<div class="row clearfix">
    <br>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        @if(Session::has('fail'))
            <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ Session::get('fail') }}</strong>
            </div>
            @php
                Session::forget('fail');
            @endphp
        @endif

        @if(Session::has('warning'))
            <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ Session::get('warning') }}</strong>
            </div>
            @php
                Session::forget('warning');
            @endphp
        @endif

        @if(Session::has('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ Session::get('success') }}</strong>
            </div>
            @php
                Session::forget('success');
            @endphp
        @endif
        @if(count($errors) > 0)
            <div class="alert alert-danger alert-block">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        {{-- @if ($errors->any())
            <div class="col-md-12">
                <ul style="list-style:none; padding:0">
                    @foreach ($errors->all() as $error)
                        <li>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{ $error }}!</strong>
                                <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif --}}
    </div>
</div>{{--row clearfix--}}





