@extends('layouts.AdminCardBase')

@section('css')
    <link href="{{ mix('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{mix("/css/tail.select-default.css")}}" rel="stylesheet" />
@endsection

@section('card-header')
    <h4>
        Բուժման տեսակ ID-{{$treatment->id}}
    </h4>
@endsection

@section('card-content')
<div class="container">

    @include('shared.info-box')

    <form method="post" action='{{route("admin.treatment-list.update", $treatment->id)}}'>
        @csrf
        @method('PUT')

        <div class="form-group">
            <x-forms.text-field name="name" value="{{old('name', $treatment->name)}}" type="text" label="Անվանում"/>
        </div>

        <div class="form-group">
            <label for="name"><strong>Կարգավիճակ</strong></label>
            <select name="status" class="form-control without-search">
                <option value="active" @if($treatment->status === 'active') selected @endif>ակտիվ</option>
                <option value="inactive" @if($treatment->status === 'inactive') selected @endif>պասիվ</option>
            </select>
            @error('status')
                <em class="error text-danger">{{$message}}</em>
            @enderror
        </div>

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
