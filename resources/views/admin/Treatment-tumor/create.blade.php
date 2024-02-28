@extends('layouts.AdminCardBase')

@section('css')
    <link href="{{ mix('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('card-header')
    <h4>Ուռուցքի բուժման ցուցակ</h4>
@endsection

@section('card-content')
<div class="container">
    @if(session()->has('error'))
        <strong class="alert-danger">Խնդրումենք ճիշտ լրացրեք</strong>
    @endisset
    <form method="post" action="{{route('admin.tumor-treatment-list.store')}}">
        @csrf
        <div class="form-group">
            <label for="name">Անվանում</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control">
        </div>
        <div class="form-group">
            <label for="type">Տեսակ</label>
            <select name="type" id="" class="form-control">
                <option value="special_treatment">special_treatment</option>
                <option value="palliative">palliative</option>
                <option value="symptomatic">symptomatic</option>
            </select>
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
