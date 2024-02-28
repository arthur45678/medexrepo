@extends('layouts.AdminCardBase')

@section('css')
    <link href="{{ mix('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{mix("/css/tail.select-default.css")}}" rel="stylesheet" />
@endsection

@section('card-header')
    <h4>Ստեղծել պալատ</h4>
@endsection

@section('card-content')
<div class="container">
    @if(session()->has('error'))
        <strong class="alert-danger">Խնդրում ենք լրացրեք ճիշտ</strong>
    @endisset
    <form method="post" action="{{route('admin.chamber-lists.store')}}">
        @csrf
        <div class="form-group">
            <x-forms.text-field name="number" value="{{old('number', 777)}}" type="number" label="Համար"/>
        </div>

        <div class="form-group">
            <label for="name"><strong>Բաժին</strong></label>
            <select name="department_id" class="form-control with-search">
                @forelse ($departments as $department)
                    <option value="{{$department->id}}" @if(old('department_id') == $department->id) selected @endif>
                        {{$department->name}}
                    </option>
                @empty
                @endforelse
            </select>
            @error('department_id')
                <em class="error text-danger">{{$message}}</em>
            @enderror
        </div>

        <div class="form-group">
            <label for="name"><strong>Կարգավիճակ</strong></label>
            <select name="status" class="form-control without-search">
                <option value="active" @if(old('status') == 'active') selected @endif>ակտիվ</option>
                <option value="inactive" @if(old('status') == 'inactive') selected @endif>պասիվ</option>
            </select>
            @error('status')
                <em class="error text-danger">{{$message}}</em>
            @enderror
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Ավելացնել</button>
        </div>
    </form>
</div>
@endsection

@section('javascript')
    <script src="{{ mix('js/jquery.js') }}"></script>
    <script src="{{ mix('js/all.magicsearch.js') }}"></script>
    <script src="{{mix('/js/select-pure.js')}}"></script>
@endsection
