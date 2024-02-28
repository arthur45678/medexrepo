@extends('layouts.cardBase')

@section('css')
<link href="{{mix("/css/jquery.magicsearch.min.css")}}" rel="stylesheet" />
@endsection


@section('card-header')
@section('card-header-classes', '')

<div class="text-center">
    <h3>ՊԵՏՈՒԹՅԱՆ ԿՈՂՄԻՑ ԵՐԱՇԽԱՎՈՐՎԱԾ ԱՆՎՃԱՐ ԲԺՇԿԱԿԱՆ ՕԳՆՈՒԹՅԱՆ ԵՎ ՍՊԱՍԱՐԿՄԱՆ ՇՐՋԱՆԱԿՆԵՐՈՒՄ ԲԺՇԿԱԿԱՆ ՕԳՆՈՒԹՅՈՒՆ ԵՎ ՍՊԱՍԱՐԿՄՈՒՄ ՍՏԱՑՈՂ ՔԱՂԱՔԱՑՈՒՆ ՏՐՎՈՂ ԻՐԱԶԵԿՄԱՆ ԹԵՐԹԻԿ</h3>
</div>
@endsection


@section('card-content')

<div class="container">
    <form class="ajax-submitable" action="{{route('samples.patients.awareness-sheet.store', ['patient'=> $patient, 'as'=> $as])}}" method="POST">
        @csrf
        <ul class="list-group">
                <li class="list-group-item">
                        <div class="form-row align-items-center">
                        <div class="col-md-2">
                            <strong>Ամսաթիվ</strong>
                        </div>
                        <div class="col-md-10">
                            <x-forms.text-field name="first_date" validation-type="ajax" type="datetime"
                            value="{{$as->first_date}}" label="" />
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="text-center">
                        <h4>ԻՐԱԶԵԿՈՒՄ Է</h4>
                    </div>
                    <strong>
                    <span class="badge badge-light mr-1"></span>
                       Քաղաքացի
                    </strong>
                    <ins class="ml-4">{{$patient->full_name}}</ins>
                    <span class="badge badge-light mr-1"></span>
                       -ին ներքոհիշյալի մասին
                    </strong>
                </li>
                <li class="list-group-item">
                    <div class="my-2">
                        <strong>Իրազեկվել եմ ստանալ պետության կողմից երաշխավորված բժշկական օգնություն և սպասարկում</strong>
                    </div>
                    <div class="col-mt-2">
                        <x-forms.checkbox-radio pos="align" id="radio1" value="{{$as->accept}}" name="accept" label="համաձայն եմ"/>
                        <x-forms.checkbox-radio pos="align" id="radio2" value="{{$as->accept}}" name="accept" label="հրաժարվում եմ"/>
                        @error('by_wheelchair')
                            <em class="error text-danger">{{$message}}</em>
                        @enderror
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="my-2">
                        <strong>Բժշկական օգնություն և սպասարկում ստացող անձի կամ նրա օրինական ներկայացուցչի</strong>
                    </div>
                    <div class="form-row align-items-center">
                        <div class="col-md-4">
                            <strong>Ազգանուն, անուն, հայրանուն</strong>
                        </div>
                        <div class="col-md-8">
                            <x-forms.text-field type="text" name="service_recipient" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․" 
                            value="{{$as->service_recipient}}" label="" /> 
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="form-row align-items-center">
                        <div class="col-md-2">
                            <strong>Ամսաթիվ</strong>
                        </div>
                        <div class="col-md-10">
                            <x-forms.text-field name="second_date" validation-type="ajax" type="datetime"
                            value="{{$as->second_date}}" label="" />
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                        <strong>ՈՒԱԿ ՓԲԸ -ի ընդունարանի վարիչ</strong>
                        <x-forms.magic-search hidden-id="as_department_head_id" hidden-name="department_head_id"
                        placeholder="Ընտրել բուժող բժիշկին․․․" class="magic-search ajax my-2" data-list-name="users"
                        value="{{$as->department_head_id}}" />
                </li>
                <li class="list-group-item">
                        <strong>Տնօրեն</strong>
                        <x-forms.magic-search hidden-id="as_director_id" hidden-name="director_id"
                        placeholder="Ընտրել բուժող բժիշկին․․․" class="magic-search ajax my-2" data-list-name="users"
                        value="{{$as->director_id}}" />
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