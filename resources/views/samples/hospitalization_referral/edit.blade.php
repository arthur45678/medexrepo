@extends('layouts.cardBase')

@section('css')
<link href="{{mix("/css/jquery.magicsearch.min.css")}}" rel="stylesheet" />
@endsection


@section('card-header')
@section('card-header-classes', '')

<div class="text-center">
    <h3>ՀՈՍՊԻՏԱԼԱՑՄԱՆ ՈՒՂԵԳԻՐ</h3>
    <h4>НАПРАВЛЕНИЕ НА ГОСПИТАЛИЗАЦИЮ</h4>
</div>
@endsection


@section('card-content')

<div class="container">
    <form class="ajax-submitable dont-reset" action="{{route('samples.patients.hospitalization-referral.store', ['patient'=> $patient, 'hr'=> $hr])}}" method="POST">
        @csrf
        <ul class="list-group">
                <li class="list-group-item">
                    <div class="form-row align-items-center">
                    <div class="col-md-2">
                            <strong>Ամսաթիվ</strong>
                        </div>
                        <div class="col-md-10">
                            <x-forms.text-field name="referral_date" validation-type="ajax" type="datetime"
                            value="{{$hr->referral_date }}" label="" />
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="form-row align-items-center">
                        <div class="col-md-7">
                            <strong>
                                <span class="badge badge-light mr-1"></span>
                                Ազգանուն, անուն, հայրանուն
                            </strong>
                        <ins class="ml-4">{{$patient->full_name}}</ins>
                        </div>
                        <div class="col-md-4">
                            <strong>
                                <span class="badge badge-light mr-1"></span>
                                Տարիք
                            </strong>
                            <ins class="ml-4">{{$patient->age}}</ins>
                        </div>
                    </div>
                </li>
                
                <li class="list-group-item">
                    <strong>Ախտորոշում/Диагноз</strong>
                    <div class="my-2">
                    <x-forms.text-field type="textarea" name="diagnosis" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                    value="{{$hr->diagnosis }}" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Բուժ. Միջոցառում/Мероприятие</strong>
                    <div class="my-2">
                    <x-forms.text-field type="textarea" name="medical_measure" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                    value="{{$hr->medical_measure }}" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-md-4">
                            <strong>Ընդունվեց՝/Поступление՝</strong>
                        </div>
                        <div class="col-md-8">
                            <x-forms.checkbox-radio pos="align" id="radio1" value="{{$hr->accept == 0 ? 'checked' : ''}}" name="accept" label="առաջնային/первичное"/>
                            <x-forms.checkbox-radio pos="align" id="radio2" value="{{$hr->accept == 1 ? 'checked' : ''}}" name="accept" label="կրկնակի/втроичное"/>
                            
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                        <strong>Բուժող բժիշկ՝</strong>
                        <x-forms.magic-search hidden-id="hr_attending_doctor_id" hidden-name="attending_doctor_id"
                        placeholder="Ընտրել բուժող բժիշկին․․․" class="magic-search ajax my-2" data-list-name="users"
                        value="{{$hr->attending_doctor->full_name}}" />
                        <strong>Բաժանմունքի վարիչ</strong>
                        <x-forms.magic-search hidden-id="hr_department_head_id" hidden-name="department_head_id"
                        placeholder="Ընտրել բաժանմունքի վարիչին․․․" class="magic-search ajax my-2" data-list-name="users"
                        value="{{$hr->department_head}}" />
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