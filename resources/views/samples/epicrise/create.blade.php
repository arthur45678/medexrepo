@extends('layouts.cardBase')

@section('css')
<link href="{{mix("/css/jquery.magicsearch.min.css")}}" rel="stylesheet" />
@endsection


@section('card-header')
@section('card-header-classes', '')

<div class="text-center">
    <h3>Էպիկրիզ</h3>
</div>
@endsection


@section('card-content')

<div class="container">
    <form class="ajax-submitable" action="" method="POST">
        @csrf
        <ul class="list-group">
                <li class="list-group-item">
                    <strong>
                    <span class="badge badge-light mr-1"></span>
                        Ազգանուն, անուն, հայրանուն
                    </strong>
                    <ins class="ml-4"></ins>
                </li>
                <li class="list-group-item">
                    <strong>
                        <span class="badge badge-light mr-1"></span>
                        Տարիք
                    </strong>
                    <ins class="ml-4"></ins>
                <hr>
                <div>
                    <x-forms.text-field type="textarea" name="description_comment" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․" 
                    value="" label="Մասնագիտություն" /> 
                </div>
                <li class="list-group-item">
                    <div class="form-row align-items-center">
                        <div class="col-md-4">
                            <strong>Ընդունման ամսաթիվ</strong>
                        </div>
                        <div class="col-md-8">
                            <x-forms.text-field name="admission_date" validation-type="ajax" type="datetime-local"
                            value="" label="" />
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="form-row align-items-center">
                        <div class="col-md-4">
                            <strong>Դուրսգրման ամսաթիվ</strong>
                        </div>
                        <div class="col-md-8">
                            <x-forms.text-field name="admission_date" validation-type="ajax" type="datetime-local"
                            value="" label="" />
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Անցկացրել է օր</strong>
                    <div class="my-2">
                         <x-forms.text-field type="number" min="1" name=""  name="" validation-type="ajax" placeholder=""
                        value="" label="" />
                    </div>
                    <x-forms.text-field type="textarea" name="lymph_node" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                    value="" label="" />
                </li>
                <li class="list-group-item">
                    <strong>Տեղափոխություն հիվանդանոցի ներսում</strong>
                    <div class="my-2">
                        <x-forms.text-field type="datetime-local" name="recommended_comment" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="" label="" /> 
                    </div>
                    <x-forms.text-field type="textarea" name="lymph_node" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                    value="" label="" />
                </li>
                <li class="list-group-item">
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="recommended_comment" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="" label="Ուղարկված հաստատության ախտորոշում" /> 
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="recommended_comment" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="" label="Վերջնական ախտորոշում" /> 
                    </div>
                </li>
                    <li class="list-group-item">
                        <strong>Ուղղեկցող հիվանդություններ</strong>
                        <x-forms.add-reduce-button type="add" data-row=".admission-row"/>
                        <x-forms.add-reduce-button type="reduce" data-row=".admission-row"/>
                        <x-forms.hidden-counter class="admission-rows" name="admission_diagnosis_length"/>
                        <div class="my-2">
                            <x-forms.magic-search class="magic-search ajax" value='' hidden-id="diseasis_id" 
                            hidden-name="diseases" data-catalog-name="diseases" placeholder="ընտրել հիվանդությունը․․․" />
                        </div>
                        <x-forms.text-field type="textarea" name="lymph_node" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                        value="" label="" />
                    </li>
                <li class="list-group-item">
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="" label="Վիճակը ընդունման պահին" /> 
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="mt-2">
                        <div class="form-group">
                            <label><strong>Լրացուցիչ տվյալներ</strong></label> 
                                <x-forms.text-field type="textarea" name="" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                                value="" label="" />
                        </div> 
                        <div class="form-group">
                            <label><strong>Կից փաստաթղթեր</strong></label>
                            <input type="file" name="attachments[]" value="" class="form-control" multiple="multiple">
                            <em class="error text-danger" data-input="attachments[]"></em>
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="" label="Կատարված բուժում․ վիրահատական" /> 
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="" label="Բիոհորմոնոթերապիա" />
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="" label="Քիմիոթերապիա" />
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="" label="Ճառագայթային բուժում" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Դուս է գրվում</strong>
                    <div class="my-2">
                        <x-forms.magic-search class="magic-search ajax" value='' hidden-id="diseasis_id" 
                         hidden-name="diseases" data-catalog-name="diseases" placeholder="ընտրել հիվանդությունը․․․" />
                    </div>
                    <x-forms.text-field type="textarea" name="lymph_node" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                    value="" label="" />
                </li>
                <li class="list-group-item">
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="" label="Խորհուրդներ" /> 
                    </div>
                </li>
                <li class="list-group-item">
                        <strong>Բուժող բժիշկ՝</strong>
                        <x-forms.magic-search hidden-id="ue_attending_doctor_id" hidden-name="attending_doctor_id"
                        placeholder="Ընտրել բուժող բժիշկին․․․" class="magic-search ajax my-2" data-list-name="users"
                        value="" />
                        <strong>Բաժանմունքի վարիչ</strong>
                        <x-forms.magic-search hidden-id="ue_attending_doctor_id" hidden-name="attending_doctor_id"
                        placeholder="Ընտրել բաժանմունքի վարիչին․․․" class="magic-search ajax my-2" data-list-name="users"
                        value="" />
                        <strong>Գլխավոր բժիշկ</strong>
                        <x-forms.magic-search hidden-id="ue_attending_doctor_id" hidden-name="attending_doctor_id"
                        placeholder="Ընտրել գլխավոր բժիշկին․․․" class="magic-search ajax my-2" data-list-name="users"
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