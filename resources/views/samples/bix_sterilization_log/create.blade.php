@extends('layouts.cardBase')

@section('css')
<link href="{{mix("/css/jquery.magicsearch.min.css")}}" rel="stylesheet" />
@endsection


@section('card-header')
@section('card-header-classes', '')

<div class="text-center">
    <h3>Բիքսի մանրէազերծման գրանցամատյան</h3>
</div>
@endsection


@section('card-content')

<div class="container">
    <form class="ajax-submitable" action="{{ route('samples.patients.bix-sterilization-log.store', ['patient'=> $patient]) }}" method="POST">
        @csrf
        <ul class="list-group">
                <li class="list-group-item">
                    <div class="form-row align-items-center">
                        <div class="col-md-4">
                            <strong>Ամսաթիվ</strong>
                        </div>
                        <div class="col-md-8">
                            <x-forms.text-field name="bix_sterilisation_date" type="datetime-local"  validation-type="ajax" value="{{old('admission_date')}}" label=""/>
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="form-row align-items-center">
                        <div class="col-md-4">
                            <strong>Բիքսի ուղակման ժամանակ</strong>
                        </div>
                        <div class="col-md-8">
                            <x-forms.text-field type="datetime-local" name="bix_send_date" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                            value="" label="" type="date" />
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="form-row align-items-center">
                        <div class="col-md-4">
                            <strong>Բիքսի հավաքման տեսակ</strong>
                        </div>
                        <div class="col-md-8">
                            <x-forms.text-field type="text" name="bix_type" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                            value="" label="" />
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="form-row align-items-center">
                        <div class="col-md-4">
                            <strong>Բիքսի բերման ժամանակ</strong>
                        </div>
                        <div class="col-md-8">


                            <x-forms.text-field type="datetime-local" name="bix_surgery_date" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                            value="" label="" />
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="form-row align-items-center">
                        <div class="col-md-6">
                            <strong>Վիրահատական սեղանի պատրաստման ժամանակ</strong>
                        </div>
                        <div class="col-md-6">
                            <x-forms.text-field type="text" name="surgery_table_preparation" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                            value="" label="" />
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div>
                        <x-forms.text-field type="textarea" name="remarks" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="" label="Դիտողություններ" />
                    </div>
                </li>

                <li class="list-group-item">
                        <strong>Վիրահատական սեղանի բուժքույր</strong>
                        <x-forms.magic-search hidden-id="nurse_id" hidden-name="nurse_id"
                        placeholder="Ընտրել բւժքույրն․․․" class="magic-search ajax my-2" data-list-name="users"
                        value="" />
                        <strong>Գլխավոր բուժքույր</strong>
                        <x-forms.magic-search hidden-id="general_nurse_id" hidden-name="general_nurse_id"
                        placeholder="Ընտրել գլխավոր բւժքույր․․․" class="magic-search ajax my-2" data-list-name="users"
                        value="" />
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
