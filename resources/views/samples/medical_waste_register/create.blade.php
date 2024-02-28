@extends('layouts.cardBase')

@section('css')
<link href="{{mix("/css/jquery.magicsearch.min.css")}}" rel="stylesheet" />
@endsection


@section('card-header')
@section('card-header-classes', '')

<div class="text-center">
    <h3>Բժշկական թափոնի տեսակ</h3>
</div>
@endsection


@section('card-content')

<div class="container">
    <form class="ajax-submitable" action="{{ route('samples.patients.medical-waste-register.store', ['patient'=> $patient]) }}" method="POST">
        @csrf
        <ul class="list-group">
                    {{--<li class="list-group-item">
                        <div class="row">
                            <div class="col-md-4">
                                <strong>Հ/Հ</strong>
                            </div>
                            <ins class="ml-4"></ins>
                        </div>
                    </li>--}}
                    <li class="list-group-item">
                        <strong>Բաժանմունքի անվանումը՝</strong>
                        <div class="my-2">
                            <x-forms.magic-search class="magic-search ajax" value='' hidden-id="department_id"
                            hidden-name="department_id" data-catalog-name="departments" placeholder="ընտրել բաժանմունքը․․․" />
                        </div>
                    </li>
                    <li class="list-group-item">
                        <strong>Բժշկական թափոնի տեսակ</strong>
                        <div class="my-2">
                            <x-forms.text-field type="textarea" name="waste_type" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                            value="" label="" />
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="form-row align-items-center">
                            <div class="col-md-6">
                                <strong>Բժշկական թափոնի տարողության բացման ամսաթիվ</strong>
                            </div>
                            <div class="col-md-6">
                                <x-forms.text-field name="admission_date" validation-type="ajax" type="date"
                                value="" label="" />
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <strong>Վթարային իրավիճակների գրանցում</strong>
                        <div class="my-2">
                            <x-forms.text-field type="textarea" name="emergency_registration" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                            value="" label="" />
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="form-row align-items-center">
                            <div class="col-md-6">
                                <strong>Գրանցված վթարային իրավիճակի հաղորման ամսաթիվ</strong>
                            </div>
                            <div class="col-md-6">
                                <x-forms.text-field name="move_date" validation-type="ajax" type="date"
                                value="" label="" />
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="form-row align-items-center">
                            <div class="col-md-6">
                                <strong>Տեղաթոխման ամսաթիվ</strong>
                            </div>
                            <div class="col-md-6">
                                <x-forms.text-field name="date_of_registration" validation-type="ajax" type="date"
                                                    value="" label="" />
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <strong>Գրանցված վթարային իրավիճակի տեսակը/արտահոսք, ծակոցներ և այլն</strong>
                        <div class="my-2">
                            <x-forms.text-field type="textarea" name="type_emergency_situation" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                            value="" label="" />
                        </div>
                    </li>
                <li class="list-group-item">
                        <strong>Բժշկական թափոնի պատասխանատու</strong>
                    <x-forms.magic-search hidden-id="responsible_for_waste_doctor_id" hidden-name="responsible_for_waste_doctor_id"
                                          placeholder="Ընտրել բաժանմունքի վարիչին․․․" class="magic-search ajax my-2" data-list-name="users"
                                          value="" />
                        <strong>Բժշկական թափոնի հանձնող</strong>
                        <x-forms.magic-search hidden-id="waste_handler_doctor_id" hidden-name="waste_handler_doctor_id"
                        placeholder="Ընտրել բաժանմունքի վարիչին․․․" class="magic-search ajax my-2" data-list-name="users"
                        value="" />
                        <strong>Բժշկական թափոնի ընդունող</strong>
                        <x-forms.magic-search hidden-id="receiver_waste_doctor_id" hidden-name="receiver_waste_doctor_id"
                        placeholder="Ընտրել բաժանմունքի վարիչին․․․" class="magic-search ajax my-2" data-list-name="users"
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
