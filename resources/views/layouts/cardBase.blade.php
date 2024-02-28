@extends('layouts.base')

@section('content')

<div class="container-fluid">
    <div class="fade-in">
        <div class="row">
            <div class="@yield('card-class', 'col-12')">
                <div class="card">
                    <div class="card-header @yield('card-header-classes', 'd-flex align-items-center justify-content-between')">
                        @yield('card-header')
                    </div>
                    <div class="card-body">
                        @include('shared.info-box')

                        @yield('card-content')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
