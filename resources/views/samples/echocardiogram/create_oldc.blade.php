@extends('layouts.cardBase')

@section('css')
<link href="{{mix("/css/jquery.magicsearch.min.css")}}" rel="stylesheet" />
@endsection


@section('card-header')
@section('card-header-classes', '')

<div class="text-center">
    <h3>Էխոկարդիոգրաֆիա</h3>
</div>
@endsection


@section('card-content')

<div class="container">


    <form class="ajax-submitable" action="{{ route('samples.patients.echocardiogram.store', ['patient'=> $patient]) }}" method="POST">
        @csrf
        <ul class="list-group">
                <li class="list-group-item">
                    <strong>
                    <span class="badge badge-light mr-1"></span>
                        Ազգանուն, անուն, հայրանուն {{ $patient->getAllNamesAttribute() }}
                    </strong>
                    <ins class="ml-4"></ins>
                </li>
                <li class="list-group-item">
                    <div class="form-row align-items-center">

                        <div class="col-md-2">
                            <strong>Տարիք</strong>
                        </div>
                        <div class="col-md-4">
                            <x-forms.text-field name="patient_age" validation-type="ajax" type="date"
                                                value="" label="" />
                        </div>

                        <div class="col-md-2">
                            <strong>Ամսաթիվ</strong>
                        </div>
                        <div class="col-md-4">
                            <x-forms.text-field name="admission_date" validation-type="ajax" type="date"
                            value="" label="" />
                        </div>
                    </div>
                </li>

                <li class="list-group-item">
                    <div class="text-center">
                        <h4>Ձախ փորոք</h4>
                    </div>
                    <strong>ՁՓ դիաստոլիկ չափս (սմ)(КДР)-Նորմա 4,5-5(սմ)</strong>
                    <div class="my-2">
                    <x-forms.text-field type="textarea" name="diastolic_size_KDR" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                    value="" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>ՁՓ սիստոլիկ չափս (սմ)(КСР)-Նորմա 3-4.5սմ</strong>
                    <div class="my-2">
                    <x-forms.text-field type="textarea" name="diastolic_size_KCR" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                    value="" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>ՁՓ դիաստոլիկ ծավալ (մլ)(КДО)-Նորմա 55-160մլ</strong>
                    <div class="my-2">
                    <x-forms.text-field type="textarea" name="diastolic_size_KDO" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                    value="" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>ՁՓ սիստոլիկ ծավալ (մլ)(КСО)-Նորմա 19-85մլ</strong>
                    <div class="my-2">
                    <x-forms.text-field type="textarea" name="diastolic_size_KCO" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                    value="" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Հետին պատ (սմ)-Նորմա 0.7-1.1սմ</strong>
                    <div class="my-2">
                    <x-forms.text-field type="textarea" name="back_wall" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                    value="" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Միջփորոքային միջնապատ (սմ)-Նորմա 0,7-1.1սմ</strong>
                    <div class="my-2">
                    <x-forms.text-field type="textarea" name="interventricular_septum" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                    value="" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Արտամղման ֆրակցիա(%)(EF) (սմ)-Նորմա &#8805;55%</strong>
                    <div class="my-2">
                    <x-forms.text-field type="textarea" name="extraction_fraction" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                    value="" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="text-center">
                        <h4>Աջ փորոք</h4>
                    </div>
                    <strong>ԱՓ դիաստոլիկ չափս (սմ) (КДР)-Նորմա &#8804;3.5(սմ)</strong>
                    <div class="my-2">
                    <x-forms.text-field type="textarea" name="AP_diastolic_size" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                    value="" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>ԱՓ պատ (սմ)-Նորմա &#8804;0.5</strong>
                    <div class="my-2">
                    <x-forms.text-field type="textarea" name="AP_wall_norma" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                    value="" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Աորտաի արմատի տրամագիծ (սմ)-Նորմա &#8805;2.0-3.7(սմ)</strong>
                    <div class="my-2">
                    <x-forms.text-field type="textarea" name="aortic_roo_diameter" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                    value="" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Ձախ նախասրտի տրամագիծ (սմ)-Նորմա 3.0-4.0(սմ)</strong>
                    <div class="my-2">
                    <x-forms.text-field type="textarea" name="left_atrium_diameter" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                    value="" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Ձախ նախասրտի փոքր չափս (սմ)-Նորմա &#8804;4.4(սմ)</strong>
                    <div class="my-2">
                    <x-forms.text-field type="textarea" name="small_size_of_the_left_atrium" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                    value="" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Ստորին սիներակի չափս (սմ)-Նորմա &#8804;2.1(սմ)</strong>
                    <div class="my-2">
                    <x-forms.text-field type="textarea" name="the_size_of_the_lower_window" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                    value="" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Ստորին սիներակի կոլապս (%))-Նորմա &#8805;50%</strong>
                    <div class="my-2">
                    <x-forms.text-field type="textarea" name="collapse_of_the_lower_eyelid" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                    value="" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="decision" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="" label="Եզրակացություն" />
                    </div>
                </li>
                <li class="list-group-item">
                        <strong>Բուժող բժիշկ՝</strong>
                    <x-forms.magic-search hidden-id="ue_attending_doctor_id" hidden-name="attending_doctor_id"
                                          placeholder="Ընտրել բուժող բժիշկին․․․" class="magic-search ajax my-2" data-list-name="users"
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
