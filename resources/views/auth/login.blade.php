
@extends('layouts.authBase')

@section("css")
    <link rel="stylesheet" href="{{ asset('css/login.css') }}" />
@endsection

@section('content')
@php

@endphp
<div class="container">
    <div class="login-page-message">
        @include('shared.info-box')
    </div>

    <div></div>
    <div class="login-back-img"></div>
    <div class="row justify-content-center">
        <div class="top-logo2"><img src="assets/img/backs/fanarjyan-logo.png" alt=""  class="logo-img2"></div>
        <div class="col-md-5">
            <div class="card-group">
                <div class="card p-4">
                    <div class="card-body">
                        <div class="logo-img"></div>
                        <!-- <p class="text-muted text-center">{{__('Login to system')}}</p> -->
                        <form method="POST" action="{{ route('login') }}" id="login-form" novalidate>
                            @csrf
                            <div class="input-group mb-3">
                                <x-forms.input-icon position="prepend" icon="cil-user" />
                                <input class="form-control" type="text" placeholder="{{ __('Username') }}"
                                    name="username" value="{{ old('username') }}" required autofocus
                                    id="validationCustom01">
                                @error('username')
                                <x-forms.feedback type="invalid" :message="$message" />
                                @enderror
                            </div>
                            <div class="input-group mb-4">
                                <x-forms.input-icon position="prepend" icon="cil-lock-locked" />
                                <input class="form-control" type="password" placeholder="{{ __('Password') }}"
                                    name="password" required id="validationCustom02" value="password">
                                @error('password')
                                <x-forms.feedback type="invalid" :message="$message" />
                                @enderror
                            </div>
                            <div class="row d-flex justify-content-center">
                                <div class="mx-2">
                                    <button class="btn btn-primary px-4 col-md-12" type="submit">{{ __('Login') }}</button>

                                </div>
                                <div class="mx-2">
                                    <button class="btn btn-warning px-4 col-md-12" type="reset">{{ __('Reset') }}</button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="mini-title2">&copy;Webex Technologis llc</div>


@endsection

@section('javascript')
<script>
    (function() {
    'use strict';
    window.addEventListener('load', function() {
        let loginForm = document.getElementById('login-form');
        loginForm.addEventListener('submit', function(event) {
            if(loginForm.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
            }
            loginForm.classList.add('was-validated');
        }, false);
    }, false);
  })();
</script>
@endsection
