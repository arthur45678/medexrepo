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
    <form method="post" action="{{ route('admin.roles.update', [$role->id]) }}">
        @method('put')
        @csrf()
        <div class="form-group">
            <label for="name">{{ $role->name }}</label>
            <input type="text" name="name" id="name" value="{{ $role->name }}" class="form-control" placeholder="Name">
        </div>


        <div class="form-group">
            <label for="status">Ստատուս</label>
            <select name="status" id="status" class="form-control">
                <option {{ $role->status == 1 ? 'selected' : '' }} value="1">Ակտիվ է</option>
                <option {{ $role->status == 0 ? 'selected' : '' }} value="0">Ակտիվ չե</option>
            </select>
        </div>


        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Permission:</strong>
                <br/>
                @foreach($permission as $value)
                    <label for="{{ $value->id }}">{{ $value->name }}</label>
                    <input type="checkbox" {{ in_array($value->id, $rolePermissions) ? 'checked' : '' }} name="permission[]" value="{{ $value->id }}">
                    <br/>
                @endforeach

            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Թարմացնել</button>
        </div>
    </form>
<hr class="my-4">


<hr class="my-4">


@endsection

@section('javascript')
<script src="{{ mix('js/jquery.js') }}"></script>
<script src="{{ mix('js/all.magicsearch.js') }}"></script>
<script src="{{ mix('/js/components/Select.js')}}"></script>


@endsection
