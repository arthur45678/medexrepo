@extends('layouts.AdminCardBase')

@php

@endphp

@section('css')
<link href="{{mix("/css/jquery.magicsearch.min.css")}}" rel="stylesheet" />
@endsection

@section('card-header')
@section('card-header-classes', 'text-center')
<h5>Խմբագրել պաշտոնը</h5>
<h3>Պաշտոնը <span>{{$role->name}}</span></h3>
@endsection

@section('card-content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Պաշտոն</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('admin.roles.index') }}"> Բոլոր պաշտոնները</a>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                {{ $role->name }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Status:</strong>
                {{ $role->status == 1 ? 'Ակտիվ է' : 'Ակտիվ չե' }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Permissions:</strong>
                @if(!empty($rolePermissions))
                    @foreach($rolePermissions as $v)
                        <h3 class="badge badge-success">{{ $v->name }},</h3>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
<hr class="my-4">


<hr class="my-4">


@endsection

@section('javascript')
<script src="{{ mix('js/jquery.js') }}"></script>
<script src="{{ mix('js/all.magicsearch.js') }}"></script>
<script src="{{ mix('/js/components/Select.js')}}"></script>


@endsection
