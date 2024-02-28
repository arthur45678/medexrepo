@extends('layouts.AdminCardBase')

@section('css')
    <link href="{{ mix('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{mix("/css/tail.select-default.css")}}" rel="stylesheet" />
@endsection

@section('card-header')
    <h4>
        Մահճակալ №-{{$bed->number}}
        <small><em>/ id-{{$bed->id}}</em></small>
    </h4>
@endsection

@section('card-content')
<div class="container">
    @if(session()->has('error'))
        <strong class="alert-danger">Խնդրում ենք լրացրեք ճիշտ</strong>
    @endisset
    <form method="post" action='{{route("admin.bed-lists.update", $bed->id)}}'>
        @csrf
        @method('PUT')

        <div class="form-group">
            <x-forms.text-field name="number" value="{{old('number', $bed->number)}}" type="number" label="Համար"/>
        </div>

        <div class="form-group">
            <label for="name"><strong>Զբաղված է</strong></label>
            <select name="is_occupied" class="form-control without-search">
                <option value="1" @if($bed->is_occupied == '1') selected @endif>այո</option>
                <option value="0" @if($bed->is_occupied == '0') selected @endif>ոչ</option>
            </select>
            @error('is_occupied')
                <em class="error text-danger">{{$message}}</em>
            @enderror
        </div>

        <div class="form-group">
            <label for="name"><strong>Կարգավիճակ</strong></label>
            <select name="status" class="form-control without-search">
                <option value="active" @if($bed->status === 'active') selected @endif>ակտիվ</option>
                <option value="inactive" @if($bed->status === 'inactive') selected @endif>պասիվ</option>
            </select>
            @error('status')
                <em class="error text-danger">{{$message}}</em>
            @enderror
        </div>

        <div class="form-group">
            <label for="name"><strong>Պալատի համար - բաժին</strong></label>
            <select name="chamber_id" class="form-control with-search">
                @forelse ($chambers as $chamber)
                    <option value="{{$chamber->id}}" @if($bed->chamber_id == $chamber->id) selected @endif>
                        {{$chamber->number}} - {{$chamber->department->name}}
                    </option>
                @empty
                @endforelse
            </select>
            @error('chamber_id')
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
