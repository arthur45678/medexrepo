@extends('layouts.AdminCardBase')

@section('css')
    <link href="{{ mix('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{mix("/css/tail.select-default.css")}}" rel="stylesheet" />
@endsection

@section('card-header')
    <h4>
        Բուժական ձևանմուշ ID-{{$health_sample_list->id}}
    </h4>
@endsection

@section('card-content')
<div class="container">
    @if(session()->has('error'))
        <strong class="alert-danger">Խնդրում ենք լրացրեք ճիշտ</strong>
    @endisset
    <form method="post" action='{{route("admin.health-sample-lists.update", $health_sample_list->id)}}'>
        @csrf
        @method('PUT')

        <div class="form-group">
            <x-forms.text-field name="name" value="{{old('name', $health_sample_list->name)}}" type="text" label="Անվանում"/>
        </div>

        {{-- <div class="form-group">
            <label for="name"><strong>Կարգավիճակ</strong></label>
            <select name="status" class="form-control without-search">
                <option value="active" @if($health_sample_list->status === 'active') selected @endif>ակտիվ</option>
                <option value="inactive" @if($health_sample_list->status === 'inactive') selected @endif>պասիվ</option>
            </select>
            @error('status')
                <em class="error text-danger">{{$message}}</em>
            @enderror
        </div> --}}

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Փոփոխել</button>
        </div>
    </form>
</div>
@endsection

@section('javascript')
    <script src="{{ mix('js/jquery.js') }}"></script>
    <script src="{{ mix('js/all.magicsearch.js') }}"></script>
    <script src="{{mix('/js/select-pure.js')}}"></script>
@endsection
