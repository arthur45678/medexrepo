
@extends('layouts.AdminCardBase')

@section('css')
    <link href="{{ mix('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('card-header')
    <div class="card-header-actions">
        <h4>Դեղորայքի անուներ</h4>
    </div>

@endsection

@section('card-content')
    <div class="container">
        @if(session()->has('error'))
            <strong class="alert-danger">Խնդրումենք ճիշտ լրացրեք</strong>
        @endisset
        <form method="post" action="{{route('admin.medicine-lists.store')}}">
            @csrf
            <div class="form-group">
                <label for="code">code</label>
                <input type="text" name="code" id="code" class="form-control">
            </div>
            <div class="form-group">
                <label for="name">name</label>
                <input type="text" name="name" id="name" class="form-control">
            </div>
            <div class="form-group">
                <label for="unit">unit</label>
                <input type="text" name="unit" id="unit" class="form-control">
            </div>
            <div class="form-group">
                <label for="warehouse">warehouse</label>
                <input type="text" name="warehouse" id="warehouse" class="form-control">
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
