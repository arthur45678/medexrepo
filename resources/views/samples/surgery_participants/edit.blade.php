@extends('layouts.cardBase')


@section('css')
<link href="{{mix("/css/jquery.magicsearch.min.css")}}" rel="stylesheet" />
@endsection


@section('card-header')
@section('card-header-classes', '')

<div class="text-center">
    <h3>Վիրահատության մասնակիցներ</h3>
</div>
@endsection


@section('card-content')

<div class="container">
    @csrf
    @method('put')
    <form class="ajax-submitable" action="{{ route('samples.patients.surgery-participants.update', ['patient'=> $patient,  $post->id]) }}" method="POST">
        @csrf
        <ul class="list-group">
                <li class="list-group-item">
                    <strong>
                        Դեպքի համար №
                    </strong>
                    <ins class="ml-4"></ins>
                </li>
                <li class="list-group-item">
                    <strong>
                        Ազգանուն, անուն, հայրանուն {{ $patient->getAllNamesAttribute() }}
                    </strong>
                    <ins class="ml-4"></ins>
                </li>
                <li class="list-group-item">
                    <strong>
                    Ծառայություն
                    </strong>
                    <x-forms.magic-search value="{{ $post->treatment_id }}"  hidden-name="treatment_id" hidden-id="treatment_id"
                                            placeholder="Ընտրել ծառայությունը․․․" class="magic-search ajax my-2" data-catalog-name="treatments" />
                    <ins class="ml-4"></ins>
                </li>
                <li class="list-group-item">
                    <strong>
                    Ստորաբաժանում
                    </strong>

                    <x-forms.magic-search class="magic-search ajax"  value="{{ $post->department_id }}"  hidden-id="department_id" validationType="ajax"
                                          hidden-name="department_id" data-catalog-name="departments" placeholder="ընտրել բաժանմունքը․․․" />
                    <ins class="ml-4"></ins>
                </li>
                <li class="list-group-item">
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="coverage" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{ $post->coverage }}" label="Ծածկույթ" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>
                    Վճարվում է
                    </strong>
                    <ins class="ml-4"></ins>
                </li>
                <li class="list-group-item">
                        <strong>Բժիշկ՝</strong>
                        <x-forms.magic-search hidden-id="attending_doctor_id" hidden-name="attending_doctor_id"
                        placeholder="Ընտրել բուժող բժիշկին․․․" class="magic-search ajax my-2" data-list-name="users"
                        value="{{ $post->attending_doctor_id }}" />
                        <strong>Ռեանիմատոլոգ՝</strong>
                        <x-forms.magic-search hidden-id="reanimatolog_doctor_id" hidden-name="reanimatolog_doctor_id"
                        placeholder="Ընտրել բուժող բժիշկին․․․" class="magic-search ajax my-2" data-list-name="users"
                        value="{{ $post->reanimatolog_doctor_id }}" />
                        <strong>Անեսթեզ բ/ք՝</strong>
                        <x-forms.magic-search hidden-id="anastesiology_nurse_id" hidden-name="anastesiology_nurse_id"
                        placeholder="Ընտրել բուժող բժիշկին․․․" class="magic-search ajax my-2" data-list-name="users"
                        value="{{ $post->anastesiology_nurse_id }}" />

                        <strong>Վիրահատարան մայրապետ՝</strong>
                        <x-forms.magic-search hidden-id="medical_orderly_id" hidden-name="medical_orderly_id"
                        placeholder="Ընտրել բուժող բժիշկին․․․" class="magic-search ajax my-2" data-list-name="users"
                        value="{{ $post->medical_orderly_id }}" />
                        <strong>Վիրահատարանի բ/ք՝</strong>
                        <x-forms.magic-search hidden-id="surgery_nurse_id" hidden-name="surgery_nurse_id"
                        placeholder="Ընտրել բուժող բժիշկին․․․" class="magic-search ajax my-2" data-list-name="users"
                        value="{{ $post->attending_doctor_id }}" />
                        <strong>Ասիստենտ՝</strong>
                        <x-forms.magic-search hidden-id="assistant_doctor_id" hidden-name="assistant_doctor_id"
                        placeholder="Ընտրել բուժող բժիշկին․․․" class="magic-search ajax my-2" data-list-name="users"
                        value="{{ $post->assistant_doctor_id }}" />
                        <strong>Անեսթեզիոլոգ՝</strong>
                        <x-forms.magic-search hidden-id="anesthesiologist_doctor_id" hidden-name="anesthesiologist_doctor_id"
                        placeholder="Ընտրել բուժող բժիշկին․․․" class="magic-search ajax my-2" data-list-name="users"
                        value="{{ $post->anesthesiologist_doctor_id }}" />
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
