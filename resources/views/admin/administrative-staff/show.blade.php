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
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('admin.administrative-staff.index') }}"> Բոլոր պաշտոնները</a>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                @foreach($posts as $value)
                    <h4>{{ $value->title }}</h4>
                @endforeach
                    @foreach($posts as $value)
                        @foreach($value->departments as $value)
                            <div class="col-3">
                                {{ $value->name }}
                            </div>
                        @endforeach
                    @endforeach
            </div>
        </div>
    </div>
</div>
<hr class="my-4">

@endsection

@section('javascript')
<script src="{{ mix('js/jquery.js') }}"></script>
<script src="{{ mix('js/all.magicsearch.js') }}"></script>
<script src="{{ mix('/js/components/Select.js')}}"></script>


@endsection
