@extends('layouts.cardBase')

@section('css')
<link href="{{mix("/css/jquery.magicsearch.min.css")}}" rel="stylesheet" />
@endsection


@section('card-header')
@section('card-header-classes', '')


<div class="text-center">
    <h3>Էնդոսկոպիկ ուլտրաձայնային հետազոտություն</h3>
</div>
@endsection


@section('card-content')

<div class="container">
    <form class="ajax-submitable dont-reset" action="{{route('samples.patients.uex.update', ['patient'=> $patient, 'uex'=> $uex])}}" method="POST">
        @csrf
        @method("PATCH")
        <ul class="list-group">
            <li class="list-group-item">

                <x-forms.text-field type="textarea" name="research_type"  validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                    value="{{$uex->research_type}}" label="Հետազոտության տեսակ" /> 
            
                <li class="list-group-item">
                    <strong>
                        <span class="badge badge-light mr-1">1.</span>
                        Ազգանուն, անուն, հայրանուն
                    </strong>
                    <ins class="ml-4">{{$patient->all_names}}</ins>
                </li>
                <!-- 2 -->
                <li class="list-group-item">
                    <strong>
                        <span class="badge badge-light mr-1">2.</span>
                        Ծննդյան թիվը՝
                    </strong>
                <ins class="ml-4">{{$patient->birth_date}}</ins>

                <hr>

                <div>
                    <x-forms.text-field type="textarea" name="description_comment" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․" 
                        value="{{$uex->description_comment}}" label="Նկարագիր" /> 
                </div>
                <div class="mt-4">
                    <x-forms.text-field type="textarea" name="conclusion_comment" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$uex->conclusion_comment}}" label="Եզարակացություն" /> 
                </div>

                <div class="mt-4">
                        <x-forms.text-field type="textarea" name="recommended_comment" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                            value="{{$uex->recommended_comment}}" label="Խորհուրդ է տրվում" /> 
                </div>

                </li>

                <li class="list-group-item">
                    <div class="form-row align-items-center">
                        <div class="col-md-4">
                            <strong>Ընդունման ամսաթիվը և ժամը՝</strong>
                        </div>
                        <div class="col-md-8">
                            <x-forms.text-field name="admission_date" validation-type="ajax" type="datetime-local"
                                value="{{$uex->getFormattedDate('date', true)}}" label="" />
                        </div>
                    </div>
                    </li>

                    <li class="list-group-item">
                    {{-- <div class="col-md-12"> --}}
                        <strong>Բուժող բժիշկ՝</strong>
                        <x-forms.magic-search hidden-id="ue_attending_doctor_id" hidden-name="attending_doctor_id"
                        placeholder="Ընտրել բուժող բժիշկին․․․" class="magic-search ajax my-2" data-list-name="users"
                        value="{{$uex->attending_doctor_id}}" />
                    {{-- </div> --}}
                </li>

        
                @include('shared.forms.list_group_item_submit')
            </li>
        </ul>
      
    </form>
</div>
@endsection

@section('javascript')
<script src="{{ mix('js/jquery.js') }}"></script>
<script src="{{ mix('js/all.magicsearch.js') }}"></script>

@endsection
