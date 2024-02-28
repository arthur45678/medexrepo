@extends('layouts.AdminCardBase')

@php

@endphp

@section('css')
<link href="{{mix("/css/jquery.magicsearch.min.css")}}" rel="stylesheet" />
@endsection

@section('card-header')
@section('card-header-classes', 'text-center')
<h4>Աշխատանքային հատկանիշներ</h4>
@endsection

@section('card-content')
<div class="container">
    <form method="post" action="{{ route('admin.age-lists.update', [$item->id]) }}">
        @method('put')
        @csrf()

        <div class="form-group">
            <div class="col-12">
                    <label for="age_from">Տարիքը սկսած</label>
                    <input type="text" name="age_from" id="age_from" class="form-control" value="{{$item->age_from}}">
            </div>
            <div class="col-12">
                    <label for="age_to">Տարիքը մինչև</label>
                    <input type="text" name="age_to" id="age_to" class="form-control" value="{{$item->age_to}}">

            </div>
            <div class="col-12">
                    <label for="age_code">Տարիքի կոդը</label>
                    <input type="text" name="age_code" id="age_code" class="form-control" value="{{$item->age_code}}">
            </div>
                <div class="col-12">
                    <label for="name">Փոխել կարգավիճակ</label>
                    <select name="status" class="form-control">
                        <option value="active" @if($item->status=="active") selected @else '' @endif>ակտիվ</option>
                        <option value="inactive" @if($item->status == "inactive") selected @else '' @endif>պասիվ</option>
                    </select>
                </div>
            </div>
            </div>
        <strong></strong>
        <div class="form-group mt-2">
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
