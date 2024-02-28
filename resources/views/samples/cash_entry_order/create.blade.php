@extends('layouts.cardBase')

@section('css')
<link href="{{mix("/css/jquery.magicsearch.min.css")}}" rel="stylesheet" />
@endsection


@section('card-header')
@section('card-header-classes', '')

<div class="text-center">
    <h3>Դրամարկղային Մուտքի Օրդեր</h3>
    <h3>ԱՄԲՈՒԼԱՏՈՐ №<span></span> </h3>
</div>
@endsection


@section('card-content')

<div class="container">
    <form class="ajax-submitable" action="" method="POST">
        @csrf
        <ul class="list-group">
                <li class="list-group-item">
                    <strong>
                     Փաստաթղթի համարը № 
                    </strong>
                    <ins class="ml-4"></ins>
                </li>
                <li class="list-group-item">
                        <div class="form-row align-items-center">
                        <div class="col-md-3">
                            <strong>Կազմման Ամսաթիվ</strong>
                        </div>
                        <div class="col-md-9">
                            <x-forms.text-field name="admission_date" validation-type="ajax" type="datetime-local"
                            value="" label="" />
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="form-row align-items-center">
                        <div class="col-md-4">
                            <strong>Թղթակցող հաշիվը(ենթահաշիվը)</strong>
                        </div>
                        <div class="col-md-8">
                            <x-forms.text-field type="text" name="description_comment" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․" 
                            value="" label="" /> 
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="form-row align-items-center">
                        <div class="col-md-4">
                            <strong>Վերլուծական հաշվառման ծածկագիր</strong>
                        </div>
                        <div class="col-md-8">
                            <x-forms.text-field type="text" name="description_comment" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․" 
                            value="" label="" /> 
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="form-row align-items-center">
                        <div class="col-md-4">
                            <strong>Գումարը</strong>
                        </div>
                        <div class="col-md-8">
                            <x-forms.text-field type="text" name="description_comment" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․" 
                            value="" label="" /> 
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="form-row align-items-center">
                        <div class="col-md-4">
                            <strong>Նպատակային նշանակության ծածկագիր</strong>
                        </div>
                        <div class="col-md-8">
                            <x-forms.text-field type="text" name="description_comment" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․" 
                            value="" label="" /> 
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="form-row align-items-center">
                        <div class="col-md-4">
                            <strong>Ստացված է</strong>
                        </div>
                        <div class="col-md-8">
                            <x-forms.text-field type="text" name="description_comment" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․" 
                            value="" label="" />
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="erythrocytes" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="" label="Ստացման հիմքը և նպատակը" />
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="form-row align-items-center">
                        <div class="col-md-4">
                            <strong>Գումարը (տառերով)</strong>
                        </div>
                        <div class="col-md-8">
                            <x-forms.text-field type="text" name="description_comment" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․" 
                            value="" label="" /> 
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="erythrocytes" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="" label="Կցվում են " />
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="form-row align-items-center">
                        <div class="col-md-4">
                            <strong>Ստացա (բառերով)</strong>
                        </div>
                        <div class="col-md-8">
                            <x-forms.text-field type="text" name="description_comment" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․" 
                            value="" label="" /> 
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="form-row align-items-center">
                        <div class="col-md-2">
                            <strong>Ամսաթիվ</strong>
                        </div>
                        <div class="col-md-10">
                            <x-forms.text-field name="admission_date" validation-type="ajax" type="datetime-local"
                            value="" label="" />
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="erythrocytes" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="" label="Ըստ ստացողի անձը հաստատող փաստաթղթի անվանումը" />
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="erythrocytes" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="" label="Համարը,ամսաթիվ և հանձման վայրը" />
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="form-row align-items-center">
                        <div class="col-md-4">
                            <strong>Վճարող</strong>
                        </div>
                        <div class="col-md-8">
                            <x-forms.text-field type="text" name="description_comment" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․" 
                            value="" label="" /> 
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                        <strong>Ղեկավար</strong>
                        <x-forms.magic-search hidden-id="ue_attending_doctor_id" hidden-name="attending_doctor_id"
                        placeholder="Ընտրել բուժող բժիշկին․․․" class="magic-search ajax my-2" data-list-name="users"
                        value="" />
                </li>
                <li class="list-group-item">
                        <strong>Գլխավոր հաշվապահ</strong>
                        <x-forms.magic-search hidden-id="ue_attending_doctor_id" hidden-name="attending_doctor_id"
                        placeholder="Ընտրել բուժող բժիշկին․․․" class="magic-search ajax my-2" data-list-name="users"
                        value="" />
                </li>
                <li class="list-group-item">
                        <strong>Գանձապահ</strong>
                        <x-forms.magic-search hidden-id="ue_attending_doctor_id" hidden-name="attending_doctor_id"
                        placeholder="Ընտրել բուժող բժիշկին․․․" class="magic-search ajax my-2" data-list-name="users"
                        value="" />
                </li>
                <li class="list-group-item list-group-item-info">
                    <h4 class="text-center my-2">
                        Դրամարկղային Մուտքի Օրդեր
                    </h4>
                </li>
                <li class="list-group-item">
                    <strong>
                        ԱՄԲՈՒԼԱՏՈՐ №<span></span>
                    </strong>
                </li>
                <li class="list-group-item">
                    <strong>
                        Անդորագիր №<span></span>
                    </strong>
                </li>
                <li class="list-group-item">
                        <div class="form-row align-items-center">
                        <div class="col-md-3">
                            <strong>Ամսաթիվ</strong>
                        </div>
                        <div class="col-md-9">
                            <x-forms.text-field name="admission_date" validation-type="ajax" type="datetime-local"
                            value="" label="" />
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="form-row align-items-center">
                        <div class="col-md-4">
                            <strong>Ստացված է</strong>
                        </div>
                        <div class="col-md-8">
                            <x-forms.text-field type="text" name="description_comment" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․" 
                            value="" label="" />
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="erythrocytes" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="" label="Ստացման հիմքը և նպատակը" />
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="form-row align-items-center">
                        <div class="col-md-4">
                            <strong>Գումարը (թվերով)</strong>
                        </div>
                        <div class="col-md-8">
                            <x-forms.text-field type="text" name="description_comment" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․" 
                            value="" label="" /> 
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="form-row align-items-center">
                        <div class="col-md-4">
                            <strong>Գումարը (տառերով)</strong>
                        </div>
                        <div class="col-md-8">
                            <x-forms.text-field type="text" name="description_comment" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․" 
                            value="" label="" /> 
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                        <strong>Գլխավոր հաշվապահ</strong>
                        <x-forms.magic-search hidden-id="ue_attending_doctor_id" hidden-name="attending_doctor_id"
                        placeholder="Ընտրել բուժող բժիշկին․․․" class="magic-search ajax my-2" data-list-name="users"
                        value="" />
                </li>
                <li class="list-group-item">
                        <strong>Գանձապահ</strong>
                        <x-forms.magic-search hidden-id="ue_attending_doctor_id" hidden-name="attending_doctor_id"
                        placeholder="Ընտրել բուժող բժիշկին․․․" class="magic-search ajax my-2" data-list-name="users"
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