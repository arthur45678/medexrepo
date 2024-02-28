@extends('layouts.cardBase')

@section('css')
    <link href="{{mix("/css/jquery.magicsearch.min.css")}}" rel="stylesheet" />
@endsection


@section('card-header')
@section('card-header-classes', '')

<div class="text-center">
    <h3>ՄԱՆՐԷԱԲԱՆԱԿԱՆ ԼԱԲՈՐԱՏՈՐԻԱ</h3>
</div>
@endsection


@section('card-content')
    <div class="container">

        <form class="ajax-submitable" action="{{ route('samples.patients.microbiology_examination_form_2.update', ['patient'=> $patient,  $post->id]) }}" method="POST">
            @method('put')
            @csrf
                <ul>

                    <li class="list-group-item">
                        <div class="form-row align-items-center">
                            <div class="col-md-12">
                                <strong>ԲԺՇԿԱԿԱՆ ՁԵՎ N 2</strong>

                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="form-row align-items-center">
                            <div class="col-md-12">
                                <strong>ԲԺՇԿԱԿԱՆ ԿԱԶՄԱԿԵՐՊՈՒԹՅԱՆ ԱՆՎԱՆՈՒՄ ԿԱՄ ԱՆՀԱՏ ՁԵՌՆԱՐԿԱՏԻՐՈՋ ԱՆՈՒՆ, ԱԶԳԱՆՈՒՆ</strong>
                                <div class="my-2">
                                    <x-forms.text-field type="textarea" name="medical_company_name" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                                        value="{{ $post->medical_company_name }}" label="" />
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="list-group-item">
                        <div class="form-row align-items-center">
                            <div class="row">

                                <div class="col-md-6">
                                    <strong>կենսանյութը վերցնելու օր, ամիս, տարի</strong>
                                    <div class="float-right">

                                        <x-forms.text-field name="examination_date" validation-type="ajax" type="date"
                                                            value="{{ $post->examination_date }}" label="" />
                                    </div>
                                </div>


                            </div><!--row-->

                        </div>
                    </li>
                    <li class="list-group-item ">
                        <div class="form-row">
                            <div class="col-md-6">
                                <strong>
                                    Ազգանուն, անուն, հայրանուն
                                </strong>
                                <ins class="ml-4">{{ $patient->getAllNamesAttribute() }}</ins>
                            </div>
                            <div class="col-md-6">
                                <strong>
                                    Տարիք
                                </strong>
                                <ins class="ml-4"><span>{{ $patient->getAgeAttribute() }}
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <strong>Բաժանմունք՝</strong>
                        <div class="my-2">
                            <x-forms.magic-search class="magic-search ajax" value="{{ $post->department_id }}" hidden-id="department_id" validationType="ajax"
                                                  hidden-name="department_id" data-catalog-name="departments" placeholder="ընտրել բաժանմունքը․․․" />
                            <em class="error text-danger" data-input="department_id"></em>
                        </div>
                    </li>


                    <li class="list-group-item">
                        <div class="mt-2">
                            <x-forms.text-field type="textarea"  name="room" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                                                value="{{ $post->room }}" label="Պալատ" />
                        </div>
                    </li>

                    <li class="list-group-item">
                        <strong>Ուղեգրող բժիշկ</strong>
                        <x-forms.magic-search hidden-id="referred_doctor_id" hidden-name="referred_doctor_id"
                                              placeholder="Ընտրել բուժող բժիշկին․․․" class="magic-search ajax my-2" data-list-name="users"
                                              value="{{ $post->referred_doctor_id }}" />
                    </li>


                    <li class="list-group-item">
                        <div class="form-row align-items-center">
                            <div class="col-md-7">
                                <strong>Ամբուլատոր բժշկական քարտի/հիվանդության պատմագրի №</strong>
                                <ins class="ml-4">940462</ins>
                                <input type="hidden" name="card_number" value="{{ $post->card_number }}">
                            </div>
                        </div>
                    </li>


                    <li class="list-group-item">
                        <div class="form-row align-items-center">
                            <div class="col-md-12">
                                <strong>Ստերիլություն</strong>
                                <div class="my-2">
                                    <x-forms.text-field type="textarea" name="sterilisation" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                                        value="{{ $post->sterilisation }}" label="" />
                                </div>
                            </div>
                        </div>
                    </li>


                    <li class="list-group-item">
                        <div class="form-row align-items-center">

                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <strong>
                                        Տիֆ պարատիֆային
                                    </strong>
                                    <ins class="ml-4"></ins>
                                </div>
                                <div class="col-md-6">
                                    <strong>
                                        խմբի հարուցիչներ
                                    </strong>
                                    <ins class="ml-4"></ins>
                                </div>
                                <div class="my-2">
                                    <x-forms.text-field type="textarea" name="tif_infection_info" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                                        value="{{ $post->tif_infection_info }}" label="" />
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="list-group-item">
                        <strong>Հետազոտությունը իրականացնող բժշկի անուն, ազգանուն</strong>
                        <x-forms.magic-search hidden-id="attending_doctor_id" hidden-name="attending_doctor_id"
                                              placeholder="Ընտրել բուժող բժիշկին․․․" class="magic-search ajax my-2" data-list-name="users"
                                              value="{{ $post->attending_doctor_id }}" />
                    </li>

                    <div class="col-md-12">
                        <strong>Արյան բակտերիոլոգիական հետազոտության պատասխանի տրման օր, ամիս, տարի </strong>
                        <div class="my-2">
                            <x-forms.text-field name="test_response_date" validation-type="ajax" type="date"
                                                value="{{ $post->test_response_date }}" label="" />

                        </div>
                    </div>

                @include('shared.forms.list_group_item_submit', ['btn_text'=>'Ուղարկել'])
                </ul>
        </form>
    </div>
@endsection
@section('javascript')
    <script src="{{ mix('js/jquery.js') }}"></script>
    <script src="{{ mix('js/all.magicsearch.js') }}"></script>

@endsection
