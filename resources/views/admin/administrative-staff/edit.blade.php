@extends('layouts.AdminCardBase')

@php

@endphp

@section('css')
<link href="{{mix("/css/jquery.magicsearch.min.css")}}" rel="stylesheet" />
@endsection

@section('card-header')
@section('card-header-classes', 'text-center')
<h2>Վարչական անձնակազմ</h2>
@endsection

@section('card-content')
<div class="container">
    <form method="post" action="{{ route('admin.administrative-staff.update', [$title->id]) }}">
        @method('put')
        @csrf()
        <div class="list-group">
            <label for="name">Փոխել պաշտոնը</label>
            <input type="text" name="title" id="name" value="{{ $title->title }}" class="form-control" placeholder="Պաշտոն">
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Տալ համապատասխան սահմանափակումներ:</strong>
                <br/>
                @foreach($permission as $value)

                    <label for="{{ $value->id }}">{{ $value->name }}</label>
                        <input
                            type="checkbox"
                            name="permission[]"
                            value="{{ $value->id }}"
                                @if(in_array($value->name,$arr_checked)) checked="true" @else '' @endif
                        >
                    <br/>

                @endforeach
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Թարմացնել</button>
        </div>
    </form>
<hr class="my-4">


@endsection

@section('javascript')
<script src="{{ mix('js/jquery.js') }}"></script>
<script src="{{ mix('js/all.magicsearch.js') }}"></script>
<script src="{{ mix('/js/components/Select.js')}}"></script>


@endsection
