@extends('layouts.cardBase')

@section('css')
<link href="{{mix("/css/jquery.magicsearch.min.css")}}" rel="stylesheet" />
@endsection


@section('card-header')
@section('card-header-classes', '')

<div class="text-center">
    <h3>Խորհրդատվական ապահովագրական թերթիկ</h3>

</div>
@endsection


@section('card-content')

<div class="container">
    <form class="ajax-submitable" action="{{ route('samples.patients.advice-sheet-insurance.update', ['patient'=> $patient,  $post->id]) }}" method="POST">
        @csrf
        @method('put')
        <ul class="list-group">
                <li class="list-group-item">
                    <div class="form-row align-items-center">
                        <div class="col-md-4">
                            <strong>Ամսաթիվ</strong>
                        </div>
                        <div class="col-md-8">
                            <x-forms.text-field name="admission_date" type="date"  validation-type="ajax" value="{{ $post->admission_date }}" label=""/>
                        </div>
                    </div>
                </li>
                <li class="list-group-item ">
                    <div class="form-row">
                        <div class="col-md-6">
                            <strong>
                                Ազգանուն, անուն, հայրանուն {{ $patient->getAllNamesAttribute() }}
                            </strong>
                            <ins class="ml-4"></ins>
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div>
                        <x-forms.text-field type="textarea" name="complaints" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{ $post->complaints }}" label="Գանգատներ" />
                    </div>
                </li>
                <li class="list-group-item">
                    <div>
                        <x-forms.text-field type="textarea" name="research_done" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{ $post->research_done }}" label="Կատարված հետազոտություն" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong> Ախտորոշում</strong>
                    <x-forms.add-reduce-button type="add" data-row=".admission-row"/>
                    <x-forms.add-reduce-button type="reduce" data-row=".admission-row"/>
                    <x-forms.hidden-counter class="admission-rows" name="admission_diagnosis_length"/>
                        <div class="admission-row">
                    <div class="my-2">
                        <x-forms.magic-search class="magic-search ajax" value='' hidden-id=""
                         hidden-name="disease_id[]" data-catalog-name="diseases" placeholder="ընտրել հիվանդությունը․․․" />
                    </div>
                    <x-forms.text-field type="textarea" name="diagnosis_comment[]" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                    value="" label="" />
                        </div>
                </li>
                <li class="list-group-item">
                    <div>
                        <x-forms.text-field type="textarea" name="Indications_for_surgery" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{ $post->Indications_for_surgery }}" label="Վիրահատության ցուցումներ" />
                    </div>
                </li>
                <li class="list-group-item">
                    <div>
                        <x-forms.text-field type="textarea" name="volume_of_surgery" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{ $post->volume_of_surgery }}" label="Վիրահատության ծավալ" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Բաժանմունք/Բժիշկ</strong>
                    <x-forms.add-reduce-button type="add" data-row=".admission-row"/>
                    <x-forms.add-reduce-button type="reduce" data-row=".admission-row"/>
                    <x-forms.hidden-counter class="admission-rows" name="admission_diagnosis_length"/>
                        <div class="admission-row">
                            <div class="my-2">
                                <x-forms.magic-search class="magic-search ajax" value='' hidden-id=""
                                hidden-name="department_id" data-catalog-name="departments" placeholder="ընտրել բաժանմունքը․․․" />
                            </div>
                            <x-forms.magic-search hidden-id="nurse_id" hidden-name="nurse_id"
                            placeholder="Ընտրել  բժշկին․․․" class="magic-search ajax my-2" data-list-name="users"
                            value="" />
                            <x-forms.text-field type="textarea" name="diagnosis_comment[]" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                            value="" label="" />
                        </div>
                </li>
                <li class="list-group-item">
                        <strong>Տնօրեն</strong>
                        <x-forms.magic-search hidden-id="department_head_id" hidden-name="department_head_id"
                        placeholder="Ընտրել  բաժանմունքի վարչին․․․" class="magic-search ajax my-2" data-list-name="users"
                        value="{{ $post->department_head_id }}" />
                </li>

                <li class="list-group-item">
                    <strong>Բուժող բժիշկ</strong>
                    <x-forms.magic-search hidden-id="attending_doctor_id" hidden-name="attending_doctor_id"
                                          placeholder="Բուժող բժիշկ․" class="magic-search ajax my-2" data-list-name="users"
                                          value="{{ $post->attending_doctor_id }}" />
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
