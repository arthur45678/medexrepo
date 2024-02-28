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
    <form class="ajax-submitable" action="{{route('samples.patients.microscopy.store', ['patient'=> $patient, 'mic'=> $mic])}}" method="POST">
        @csrf
        <ul class="list-group">
                <li class="list-group-item">
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="flat" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$mic->flat}}" label="Տափակ/Плоский" /> 
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="transient" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$mic->transient}}" label="Անցողային/Переходный" /> 
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="renal" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$mic->renal}}" label="Երիկամային/Почечный" /> 
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="leukocytes" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$mic->leukocytes}}" label="Լեյկոցիտներ/Лейкоциты" /> 
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="erythrocytes" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$mic->erythrocytes}}" label="Էրիտրոցիտներ/Эритроциты" />
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="resume" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$mic->resume}}" label="Անփոփոխ/Неизмененные" />
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="changed" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$mic->changed}}" label="Փոփոխված/Измененные" />
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="cylinders" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$mic->cylinders}}" label="Ցիլինդրներ/Цилиндры" /> 
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="hyaline" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$mic->hyaline}}" label="Հիալինային/Гиалиновые" /> 
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="candle" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$mic->candle}}" label="Մոմաձև/Восковидные" />
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="granular" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$mic->granular}}" label="Հատիկավոր/Зернистые" />
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="epithelial" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$mic->epithelial}}" label="Էպիթելային/Епителиалные" />
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="leukocyte" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$mic->leukocyte}}" label="Լեյկոցիտար/Лейкоцитарные" />
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="erythrocyte" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value={{$mic->erythrocyte}}"" label="Էրիթրոցիտար/Еритроцитарные" />
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="pigment" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$mic->pigment}}" label="Պիգմենտային/Пигментные" />
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="mucus" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$mic->mucus}}" label="Լորձ/Слизь" />
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="salt" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$mic->salt}}" label="Աղ/Соль" />
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="bacteria" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$mic->bacteria}}" label="Բակտերիաներ/Бактерии" />
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="form-row align-items-center">
                        <div class="col-md-6">
                            <strong>Անալիզի պատասխանի ամսաթիվ/Дата выдачи анализа</strong>
                        </div>
                        <div class="col-md-6">
                            <x-forms.text-field name="analisis_date" validation-type="ajax" type="datetime"
                            value="{{$mic->analisis_date}}" label="" />
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>
                    <span class="badge badge-light mr-1"></span>
                        Ազգանուն, անուն, հայրանուն
                    </strong>
                    <ins class="ml-4"></ins>
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