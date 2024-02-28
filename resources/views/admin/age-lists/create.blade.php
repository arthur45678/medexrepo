
    @extends('layouts.AdminCardBase')

@section('css')
    <link href="{{ mix('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('card-header')
<h4>Աշխատանքային հատկանիշներ</h4>
@endsection

@section('card-content')
<div class="container">
    @if(session()->has('error'))
        <strong class="alert-danger">Խնդրում ենք ճիշտ լրացրեք</strong>
    @endisset
    <form method="post" action="{{route('admin.age-lists.store')}}">
        @csrf

        <div class="form-group">
            <label for="age_from">Տարիքը սկսած</label>
            <input type="text" name="age_from" id="age_from" class="form-control">
        </div>
        <div class="form-group">
            <label for="age_to">Տարիքը մինչև</label>
            <input type="text" name="age_to" id="age_to" class="form-control">
        </div>
        <div class="form-group">
            <label for="age_code">Տարիքի կոդը</label>
            <input type="text" name="age_code" id="age_code" class="form-control">
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
