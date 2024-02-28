
    @extends('layouts.AdminCardBase')

@section('css')
    <link href="{{ mix('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('card-header')
    <h4>Բուժման տեսակ</h4>
@endsection

@section('card-content')
<div class="container">
    @if(session()->has('error'))
        <strong class="alert-danger">Խնդրումենք ճիշտ լրացրեք</strong>


    @endisset
    <form method="post" action="{{route('admin.dinisase-list.store')}}">
        @csrf
        <div class="form-group">
            <label for="name">Վերնագիր</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control">
        </div>
        <div class="form-group">
            <label for="chapter">chapter</label>
            <input type="text" name="chapter" id="chapter" value="{{ old('chapter') }}" class="form-control">
        </div>
        <div class="form-group">
            <label for="block">block</label>
            <input type="text" name="block" id="block" value="{{ old('block') }}" class="form-control">
        </div>
        <div class="form-group">
            <label for="code">code</label>
            <input type="text" name="code" id="code" value="{{ old('code') }}" placeholder="{{$dinisase->code}}" class="form-control">
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Ավելացնել</button>
        </div>
    </form>


</div>
@endsection

@section('javascript')
<script src="{{ mix('js/jquery.js') }}"></script>
<script src="{{ mix('js/all.magicsearch.js') }}"></script>
<script src="{{ mix('/js/components/Select.js') }}"></script>

@endsection
