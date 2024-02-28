@extends('layouts.cardBase')

@section('css')
<link href="{{mix("/css/jquery.magicsearch.min.css")}}" rel="stylesheet" />
@endsection


@section('card-header')
@section('card-header-classes', '')

<div class="text-center">
    <h3>ԼԱՄՊԻ ՇԱՀԱԳՈՐԾՄԱՆ ՌԵԺԻՄ</h3>
</div>
@endsection


@section('card-content')

<div class="container">
    <form  action="{{route('samples.patients.lamp-operation-mode.update',[$lamp->id,$lamp->patient_id])}}" method="POST">
        @csrf
        @method('put')
        <ul class="list-group">
            <input type="hidden" name="user_id" value="{{auth()->id()}}">
                    <li class="list-group-item">
                        <div class="form-row align-items-center">
                            <div class="col-md-2">
                                <strong>Ամսաթիվ</strong>
                            </div>
                            <div class="col-md-10">
                                <x-forms.text-field name="date" validation-type="ajax" type="datetime-local"
                                value="{{\Illuminate\Support\Carbon::parse($lamp->date)->format('Y-m-d\TH:i')}}" label="" />
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <strong>Անվանում</strong>
                        <div class="my-2">
                            <x-forms.text-field type="textarea" name="title" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                            value="{{$lamp->title}}" label="" />
                        </div>
                    </li>
                    <li class="list-group-item">
                        <strong>Բակ․լամպի ռեժիմ</strong>
                        <div class="my-2">
                            <x-forms.text-field type="textarea" name="regime" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                            value="{{$lamp->regime}}" label="" />
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="form-row align-items-center">
                            <div class="col-md-4">
                                <strong>Բակ․լամպի բացման սկիզբ</strong>
                            </div>
                            <div class="col-md-8">
                                <x-forms.text-field name="opening_start" validation-type="ajax" type="datetime-local"
                                value="{{\Illuminate\Support\Carbon::parse($lamp->opening_start)->format('Y-m-d\TH:i')}}" label="" />
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="form-row align-items-center">
                            <div class="col-md-4">
                                <strong>Բակ․լամպի անջատում</strong>
                            </div>
                            <div class="col-md-8">
                                <x-forms.text-field name="opening_end" validation-type="ajax" type="datetime-local"
                                value="{{\Illuminate\Support\Carbon::parse($lamp->opening_end)->format('Y-m-d\TH:i')}}" label="" />
                            </div>
                        </div>
                    </li>
{{--                    <li class="list-group-item">--}}
{{--                        <strong>Բավ․լամպի ռեժիմ</strong>--}}
{{--                        <div class="my-2">--}}
{{--                            <x-forms.text-field type="textarea" name="regime_description" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"--}}
{{--                            value="{{$lamp->regime_description}}" label="" />--}}
{{--                        </div>--}}
{{--                    </li>--}}
                <li class="list-group-item">
                        <strong>Պատասխանատուլ բուժքույր</strong>
                        <x-forms.magic-search hidden-id="r_attending_doctor_id" hidden-name="responsible_nurse"
                        placeholder="Ընտրել բուժող բժիշկին․․․" class="magic-search ajax my-2" data-list-name="users"
                        value="{{$lamp->responsible_nurse}}" />
                </li>
                @include('shared.forms.list_group_item_submit', ['btn_text'=>'Ուղարկել'])
        </ul>

    </form>
</div>
@endsection

@section('javascript')
<script src="{{ mix('js/jquery.js') }}"></script>
<script src="{{ mix('js/all.magicsearch.js') }}"></script>

@endsection
