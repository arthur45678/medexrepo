@extends('layouts.AdminCardBase')

@php

@endphp

@section('css')
<link href="{{mix("/css/jquery.magicsearch.min.css")}}" rel="stylesheet" />
@endsection

@section('card-header')
@section('card-header-classes', 'text-center')
<h2>Հիվանդության ելքեր</h2>
@endsection

@section('card-content')
<div class="container">
    <form method="post" action="{{ route('admin.exit-lists.update', [$item->id]) }}">
        @method('put')
        @csrf()
        <div class="form-group">
            <div class="row">
                <div class="col-12">
                    <label for="name">Փոխել տեսակը</label>
                    <input type="text" name="name" id="name" value="{{ $item->name }}" class="form-control" placeholder="Տեսակը">
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
