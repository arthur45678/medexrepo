@extends('layouts.cardBase')


@section('css')
<link href="{{mix("/css/jquery.magicsearch.min.css")}}" rel="stylesheet" />
@endsection


@section('card-header')
@section('card-header-classes', '')

<div class="text-center">
    <h3>Էնդոսկոպիկ և ուլտրաձայնային ախտորոշում </h3>
</div>
@endsection


@section('card-content')

<div class="container">
    <form class="ajax-submitable" action="{{route('samples.patients.ued.store', ['patient'=> $patient])}}" method="POST">
        @csrf
        <ul class="list-group">
            <li class="list-group-item">

                <x-forms.text-field type="textarea" name=""  validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                    value="" label="Հետազոտության տեսակ" /> 
            
                <li class="list-group-item">
                    <strong>
                        <span class="badge badge-light mr-1">1.</span>
                        Ազգանուն, անուն, հայրանուն
                    </strong>
                    <ins class="ml-4"></ins>
                </li>
                <!-- 2 -->
                <li class="list-group-item">
                    <strong>
                        <span class="badge badge-light mr-1">2.</span>
                        Ծննդյան թիվը՝
                    </strong>
                <ins class="ml-4"></ins>

                <hr>

                <div>
                    <x-forms.text-field type="textarea" name="" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․" 
                        value="" label="Նկարագիր" /> 
                </div>
                <div class="mt-4">
                    <x-forms.text-field type="textarea" name="" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="" label="Եզարակացություն" /> 
                </div>

                <div class="mt-4">
                        <x-forms.text-field type="textarea" name="" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                            value="" label="Խորհուրդ է տրվում" /> 
                </div>

                </li>

                <li class="list-group-item">
                    <div class="form-row align-items-center">
                        <div class="col-md-4">
                            <strong>Ընդունման ամսաթիվը և ժամը՝</strong>
                        </div>
                        <div class="col-md-8">
                            <x-forms.text-field name="" validation-type="ajax" type="datetime-local"
                                value="" label="" />
                        </div>
                    </div>
                    </li>

                    <li class="list-group-item">
                        <strong>Բուժող բժիշկ՝</strong>
                        <x-forms.magic-search hidden-id="ue_attending_doctor_id" hidden-name="attending_doctor_id"
                        placeholder="Ընտրել բուժող բժիշկին․․․" class="magic-search ajax my-2" data-list-name="users"
                        value="" />
                </li>
        
                @include('shared.forms.list_group_item_submit', ['btn_text'=>'Ուղարկել'])
            </li>
        </ul>
      
    </form>
</div>
@endsection

@section('javascript')
<script src="{{ mix('js/jquery.js') }}"></script>
<script src="{{ mix('js/all.magicsearch.js') }}"></script>

@endsection