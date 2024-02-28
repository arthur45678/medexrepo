@extends('layouts.AdminCardBase')

@section('css')
    <link href="{{ mix('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('card-header')
    <h4>Ծառայություն</h4>
@endsection

@section('card-content')
<div class="container">
    @if(session()->has('error'))
        <strong class="alert-danger">Խնդրումենք ճիշտ լրացրեք</strong>
    @endisset
    <form method="post" action="{{route('admin.service-list.store')}}">
        @csrf
        <div class="form-group">
            <label for="name">Վերնագիր</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control">
        </div>
        <div class="form-group">
            <label for="name">Գումար</label>
            <input type="text" name="price" id="price" value="{{ old('price') }}" class="form-control">
        </div>
            <input  name="code" type="hidden" id="code" value="{{ rand(100,1000000) }}" class="form-control">
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
