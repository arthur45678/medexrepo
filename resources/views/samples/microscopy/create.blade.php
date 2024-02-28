@extends('layouts.cardBase')

@section('css')
<link href="{{mix("/css/jquery.magicsearch.min.css")}}" rel="stylesheet" />
@endsection


@section('card-header')
@section('card-header-classes', '')

<div class="text-center">
    <h3>Մանրադիտություն/Микроскопия</h3>
</div>
@endsection


@section('card-content')

<div class="container">
    <form class="ajax-submitable" action="{{route('samples.patients.microscopy.store', ['patient'=> $patient])}}" method="POST">
        @csrf
        <ul class="list-group">
                <li class="list-group-item">
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="flat" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="" label="Տափակ/Плоский" /> 
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="transient" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="" label="Անցողային/Переходный" /> 
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="renal" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="" label="Երիկամային/Почечный" /> 
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="leukocytes" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="" label="Լեյկոցիտներ/Лейкоциты" /> 
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="erythrocytes" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="" label="Էրիտրոցիտներ/Эритроциты" />
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="resume" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="" label="Անփոփոխ/Неизмененные" />
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="changed" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="" label="Փոփոխված/Измененные" />
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="cylinders" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="" label="Ցիլինդրներ/Цилиндры" /> 
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="hyaline" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="" label="Հիալինային/Гиалиновые" /> 
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="candle" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="" label="Մոմաձև/Восковидные" />
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="granular" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="" label="Հատիկավոր/Зернистые" />
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="epithelial" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="" label="Էպիթելային/Епителиалные" />
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="leukocyte" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="" label="Լեյկոցիտար/Лейкоцитарные" />
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="erythrocyte" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="" label="Էրիթրոցիտար/Еритроцитарные" />
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="pigment" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="" label="Պիգմենտային/Пигментные" />
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="mucus" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="" label="Լորձ/Слизь" />
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="salt" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="" label="Աղ/Соль" />
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="bacteria" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="" label="Բակտերիաներ/Бактерии" />
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="form-row align-items-center">
                        <div class="col-md-6">
                            <strong>Անալիզի պատասխանի ամսաթիվ/Дата выдачи анализа</strong>
                        </div>
                        <div class="col-md-6">
                            <x-forms.text-field name="analisis_date" validation-type="ajax" type="datetime-local"
                            value="" label="" />
                        </div>
                    </div>
                </li>
                <li>
                    <div class="col-md-12 my-2">
                                <em class="ml-2 text-info">* Տվյալ կետը լարցնողը ավտոմատ կերպով ֆիքսվում է իբրև վիրահատող։</em>
                                <input class="doctors-search form-control" data-hidden="#surgeon_id" placeholder="վիրահատել է․․․">
                                    <x-forms.text-field type="hidden" id="surgeon_id" name="surgeon_id"  value="" label=""/> 
                    </div>
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