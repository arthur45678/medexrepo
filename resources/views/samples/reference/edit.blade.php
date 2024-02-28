@extends('layouts.cardBase')

@section('css')
<link href="{{mix("/css/jquery.magicsearch.min.css")}}" rel="stylesheet" />
@endsection


@section('card-header')
@section('card-header-classes', '')

<div class="text-center">
    <h3> ՏԵՂԵԿԱՆՔ</h3>
    <strong>
       <span class="badge badge-light mr-1"></span>
       No
    </strong>
    <ins class="ml-1">2</ins>
</div>
@endsection


@section('card-content')

<div class="container">
    <form class="ajax-submitable" action="{{route('samples.patients.reference.update', ['patient'=> $patient, 'reference' => $ref] )}}" method="POST">
        @csrf
        <ul class="list-group">
                <li class="list-group-item">
                    <div class="form-row align-items-center">
                    <div class="col-md-2">
                            <strong>Ամսաթիվ</strong>
                        </div>
                        <div class="col-md-10">
                            <x-forms.text-field name="date" validation-type="ajax" type="datetime"
                            value="{{$ref->date }}" label="" />
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>
                    <span class="badge badge-light mr-1"></span>
                        Ազգանուն, անուն, հայրանուն
                    </strong>
                    <ins class="ml-4">{{$patient->full_name}}</ins>
                </li>
                <li class="list-group-item">
                    <strong>Որ նա գտնվել է բուժման Ուռուցքաբանության ազգային կենտրոին ստացիոնարում</strong>
                    <div class="form-row align-items-center">
                        <div class="col-md-5 my-2">
                            <x-forms.text-field name="from_date" validation-type="ajax" type="date"
                            value="{{$ref->from_date}}" label="" />
                        </div>
                        <strong class="col-md-2 text-center">մինչև</strong>
                        <div class="col-md-5">
                                <x-forms.text-field name="to_date" validation-type="ajax" type="date"
                                value="{{$ref->to_date }}" label="" />
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Վերջնական ախտորոշում</strong>
                    <div class="my-2">
                    <x-forms.text-field type="textarea" name="reference_diagnosis" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                    value="{{$ref->reference_diagnosis }}" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Ստացած բուժում</strong>
                    <div class="my-2">
                    <x-forms.text-field type="textarea" name="treatment" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                    value="{{$ref->treatment }}" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Հիվանդի վիճակը դուրս գրման պահին և բժշկի խորհուրդները</strong>
                    <div class="my-2">
                    <x-forms.text-field type="textarea" name="doctor_advice" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                    value="{{$ref->doctor_advice }}" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Բուժող բժիշկ՝</strong>
                    <x-forms.magic-search hidden-id="r_attending_doctor_id" hidden-name="attending_doctor_id"
                    placeholder="Ընտրել բուժող բժիշկին․․․" class="magic-search ajax my-2" data-list-name="users"
                    value="{{$ref->attending_doctor->full_name}}" />
                    <strong>Բաժանմունքի վարիչ</strong>
                    <x-forms.magic-search hidden-id="r_department_head_id" hidden-name="department_head_id"
                    placeholder="Ընտրել բաժանմունքի վարիչին․․․" class="magic-search ajax my-2" data-list-name="users"
                    value="{{$ref->department_head->full_name}}" />
                    <strong>Գլխավոր բժիշկ</strong>
                    <x-forms.magic-search hidden-id="r_chief_doctor_id" hidden-name="chief_doctor_id"
                    placeholder="Ընտրել գլխավոր բժիշկին․․․" class="magic-search ajax my-2" data-list-name="users"
                    value="{{$ref->chief_doctor->full_name}}" />
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