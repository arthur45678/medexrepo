@extends('layouts.cardBase')

@section('css')
<link href="{{mix("/css/jquery.magicsearch.min.css")}}" rel="stylesheet" />
@endsection


@section('card-header')
@section('card-header-classes', '')

<div class="text-center">
    <h3>ՈՒՌՈՒՑՔԱԲԱՆՈՒԹՅԱՆ ԱԶԳԱՅԻՆ ԿԵՆՏՐՈՆ/Национальный Центр Онкологии
Կլինիկական հետազոտություններ/Клиническая лаборатория</h3>
<div class="text-center"><h4>ՄԵԶԻ ԱՆԱԼԻԶ/АНАЛИЗ МОЧИ №<span></span></h4></div> 

</div>
@endsection


@section('card-content')

<div class="container">
    <form class="ajax-submitable" action="" method="POST">
        @csrf
        <ul class="list-group">
            <li class="list-group-item">
                <div class="text-center">
                    <h4>
                    Բժշկական քարտ №<span></span>
                    </h4>
                </div>
            </li>
                <li class="list-group-item">
                    <div class="form-row align-items-center">
                        <div class="col-md-4">
                            <strong>Ամսաթիվ</strong>
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
                            <strong>Բաժանմունք՝</strong>
                        </div>
                        <div class="col-md-8">
                            <input id="departments-search" class="form-control" placeholder="ընտրել բաժանմունքը" data-id="{{old('department_id')}}" style="max-width: 100%">
                            <x-forms.text-field id="department_id" type="hidden" name="department_id"  value="{{old('department_id')}}" label=""/>
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="form-row align-items-center">
                        <div class="col-md-6">
                            <strong>
                            Ազգանուն, անուն, հայրանուն
                            </strong>
                            <ins class="ml-4"></ins>
                        </div>
                        <div class="col-md-4">
                            <strong>
                                <span class="badge badge-light mr-1"></span>
                                Տարիք
                            </strong>
                            <ins class="ml-4">1999-02-11</ins>
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div>
                    <x-forms.text-field type="textarea" name="description_comment" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․" 
                        value="" label="Քանակ/количество" /> 
                    </div>
                </li>
                <li class="list-group-item list-group-item-info">
                <h4 class="text-center">ֆիզիկա-քիմիական հատկություններ/Физико-химическое свойства</h3>
                        <svg class="c-icon">
                    </svg>
                </h4>
                </li>
                <li class="list-group-item">
                   <div>
                    <x-forms.text-field type="textarea" name="description_comment" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․" 
                        value="" label="Գույն/цвет" /> 
                    </div>
                </li>
                <li class="list-group-item">
                   <div>
                    <x-forms.text-field type="textarea" name="description_comment" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․" 
                        value="" label="Թափանցիկություն/прозрачность" /> 
                    </div>
                </li>
                <li class="list-group-item">
                   <div>
                    <x-forms.text-field type="textarea" name="description_comment" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․" 
                        value="" label="Հարաբերական խտություն/относительная плотность" /> 
                    </div>
                </li>
                <li class="list-group-item">
                   <div>
                    <x-forms.text-field type="textarea" name="description_comment" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․" 
                        value="" label="Ռեակցիա/реакция" /> 
                    </div>
                </li>
                <li class="list-group-item">
                   <div>
                    <x-forms.text-field type="textarea" name="description_comment" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․" 
                        value="" label="Սպիտակուց/белок" /> 
                    </div>
                </li>
                <li class="list-group-item">
                   <div>
                    <x-forms.text-field type="textarea" name="description_comment" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․" 
                        value="" label="Գլյուկոզա/глюкоза" /> 
                    </div>
                </li>
                <li class="list-group-item">
                   <div>
                    <x-forms.text-field type="textarea" name="description_comment" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․" 
                        value="" label="Կետոնային մարմիններ/кетонские тела" /> 
                    </div>
                </li>
                <li class="list-group-item">
                   <div>
                    <x-forms.text-field type="textarea" name="description_comment" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․" 
                        value="" label="Արյան հանդեպ ռեակցիա/реакция на кровь" /> 
                    </div>
                </li>
                <li class="list-group-item">
                   <div>
                    <x-forms.text-field type="textarea" name="description_comment" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․" 
                        value="" label="Բիլիռուբին/билирубин" /> 
                    </div>
                </li>
                <li class="list-group-item">
                   <div>
                    <x-forms.text-field type="textarea" name="description_comment" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․" 
                        value="" label="Ուռոբիլինոիդներ/уробилиноиды" /> 
                    </div>
                </li>
                <li class="list-group-item">
                   <div>
                    <x-forms.text-field type="textarea" name="description_comment" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․" 
                        value="" label="Ինդիկան/индикан" /> 
                    </div>
                </li>
                <li class="list-group-item">
                   <div>
                    <x-forms.text-field type="textarea" name="description_comment" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․" 
                        value="" label=" ՍԻ միավորներ/Единицы СИ" /> 
                    </div>
                </li>
                <li class="list-group-item">
                   <div>
                    <x-forms.text-field type="textarea" name="description_comment" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․" 
                        value="" label="Փոփոխության ենթակա միավորներ/Единицы подлежащие замене" /> 
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
