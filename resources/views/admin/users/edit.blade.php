@extends('layouts.AdminCardBase')

@php

@endphp

@section('css')
<link href="{{mix("/css/jquery.magicsearch.min.css")}}" rel="stylesheet" />
@endsection

@section('card-header')
@section('card-header-classes', 'text-center')
<h5>Խմբագրել անձնակազմին</h5>
<h3>Աշխատակից՝ <span>{{$user->f_name}} {{ $user->l_name }}</span></h3>
@endsection


@section('card-content')
<div class="container">
    <form method="post" action="{{ route('admin.users.update', [$user->id]) }}">
        @method('put')
        @csrf()
        <div class="form-group">
            <label for="f_name">Անուն</label>
            <x-forms.text-field type="text" name="f_name" value='{{old("f_name", $user->f_name)}}' />
        </div>

        <div class="form-group">
            <label for="l_name">Ազգանուն</label>
            <x-forms.text-field type="text" name="l_name" value='{{old("l_name", $user->l_name)}}' />
        </div>
        <div class="form-group">
            <label for="p_name">Հայրանուն</label>
            <x-forms.text-field type="text" name="p_name" value='{{old("p_name", $user->p_name)}}' />
        </div>


        <div class="form-group">
            <label for="username">Լոգին</label>
            <x-forms.text-field type="text" name="username" value='{{old("username", $user->username)}}' />
        </div>

        <div class="form-group">
            <label for="email">Էլ․ հասցե</label>
            <x-forms.text-field type="email" name="email" value='{{old("email", $user->email)}}' />
        </div>

        <div class="form-group">
            <label for="departments">Դեպարտամենտ:</label>
            <select name="department_id" id="departments"  class="form-control">
                @foreach($departments as $department)
                    @if($department->id == $user->department_id)
                        <option selected value="{{ $department->id }}">{{ $department->name }}</option>
                        @else
                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                    @endif
                @endforeach
            </select>
            @error('department_id')
                <em class="error text-danger">{{$message}}</em>
            @enderror
        </div>

        <div class="form-group">
            <label for="roles">Կոչում:</label>
            <x-forms.text-field type="text" name="position" value='{{old("position", $user->position)}}' />
        </div>

        <div class="form-group">
            <label for="roles">Պաշտոն (role):</label>
            <x-forms.magic-search class="magic-search ajax" data-list-name="users_roles"
            hiddenId='roles' hiddenName='roles' data-multiple="1"
            value='{{$userRoleString}}' placeholder='Ընտրել պաշտոնը․․․'/>
        </div>

        <div class="form-group">
            <label for="account_suspended">Հասանելի բաժիններ:</label>
            <x-forms.magic-search class="magic-search ajax" data-catalog-name="departments"
            hiddenId='connect_department_id' hiddenName='connect_department_ids' data-multiple="1"
            value='{{$department_connections_string}}' placeholder='Ընտրել հասանելի բաժինները․․․'/>
        </div>

        <div class="form-group">
            <label for="account_suspended">Դեակտիվացնել</label>
            <input id="account_suspended" type="checkbox" {{ $user->account_suspended == 1 ? 'checked' : '' }} name="account_suspended[]" value="">
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
