@extends('layouts.AdminCardBase')

@php

@endphp

@section('css')
<link href="{{mix("/css/jquery.magicsearch.min.css")}}" rel="stylesheet" />
@endsection

@section('card-header')

@section('card-header-classes', 'text-center')
<h5>Աշխատակից՝ <span>{{$user->f_name}} {{ $user->l_name }}</h5>

@endsection

@section('card-content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Աշխատակից՝ <span>{{$user->f_name}} {{ $user->l_name }} </h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('admin.roles.index') }}"> Բոլոր պաշտոնները</a>
            </div>
        </div>
    </div>


    <div>
        @method('put')
        @csrf()
        <div class="form-group">
            <label for="f_name">Անուն</label>
            <input disabled type="text" name="f_name" id="f_name" value="{{ $user->f_name }}" class="form-control">
        </div>

        <div class="form-group">
            <label for="l_name">Ազգանուն</label>
            <input disabled type="text" name="l_name" id="l_name" value="{{ $user->l_name }}" class="form-control">
        </div>
        <div class="form-group">
            <label for="p_name">Հայրանուն</label>
            <input disabled type="text" name="p_name" id="p_name" value="{{ $user->p_name }}" class="form-control">
        </div>


        <div class="form-group">
            <label for="username">Լոգին</label>
            <input disabled type="text" name="username" id="username" value="{{ $user->username }}" class="form-control">
        </div>

        <div class="form-group">
            <label for="email">Էլ․ հասցե</label>
            <input disabled type="email" name="email" id="email" value="{{ $user->email}}" class="form-control">
        </div>



        <div class="form-group">
            <label for="department">Դեպարտամենտ</label>
            <input disabled type="text" name="department" id="department" value="{{ $user->department->name ?? ' '}}" class="form-control">
        </div>

        <div class="form-group">
            <label for="departments">Պաշտոն</label>
            @if(!empty($user->getRoleNames()))
                @foreach($user->getRoleNames() as $v)
                    <h5 class="badge badge-success">{{ $v }}</h5>
                @endforeach
            @endif
        </div>

        <div class="form-group">
            <label for="">Հասանելի բաժիններ</label>
            @forelse ($user->department_connections as $department_connection)
                {{-- @dump($department_connection->department->name) --}}
                <input disabled type="text" value="{{$department_connection->department->name ?? ' '}}" name="department_connections" class="form-control"/>
            @empty
                <input disabled type="text" value="Տվյալ Օգտատիրոձը կցված բաժիններ չկան" name="no_department_connections" class="form-control"/>
            @endforelse
        </div>
    </div>
    <hr class="my-4">

@endsection

@section('javascript')
    <script src="{{ mix('js/jquery.js') }}"></script>
    <script src="{{ mix('js/all.magicsearch.js') }}"></script>
    <script src="{{ mix('/js/components/Select.js')}}"></script>
@endsection
