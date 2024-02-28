@extends('layouts.AdminCardBase')

@section('css')
    <link href="{{mix("/css/jquery.magicsearch.min.css")}}" rel="stylesheet" />
@endsection

@section('card-header')
@section('card-header-classes', '')
<div class="text-center">
    <h3>Նոր Պաշտոն</h3>
    <h5>Ընտրել սահմանափակումներ</h5>
</div>
@endsection


@section('card-content')
<div class="container">
    <form action="{{ route('admin.roles.store') }}" method="POST">
    @csrf
        <div class="list-group">
            <label for="name">Նոր Պաշտոն</label>
            <input type="text" name="name" id="name" value="" class="form-control" placeholder="Պաշտոն">
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Տալ համապատասխան սահմանափակումներ:</strong>
                <br/>
                @foreach($permission as $value)
                    <label for="{{ $value->id }}">{{ $value->name }}</label>
                    <input type="checkbox" name="permission[]" value="{{ $value->id }}">
                    <br/>
                @endforeach
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Ստեղծել</button>
        </div>
    <hr class="my-4">
</form>
</div>
@endsection

@section('javascript')
    <script src="{{ mix('js/jquery.js') }}"></script>
    <script src="{{ mix('js/all.magicsearch.js') }}"></script>
    <script src="{{ mix('/js/components/Select.js') }}"></script>
@endsection
