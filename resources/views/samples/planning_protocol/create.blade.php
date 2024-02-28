@extends('layouts.cardBase')

@section('css')
<link href="{{mix("/css/jquery.magicsearch.min.css")}}" rel="stylesheet" />
@endsection


@section('card-header')
@section('card-header-classes', '')

<div class="text-center">
    <h3>ՊԼԱՆԱՎՈՐՄԱՆ ՈՒՂԵԳԻՐ</h3>
</div>
@endsection


@section('card-content')

<div class="container">
    <form  action="{{route('samples.patients.planning-protocol.store',$patent->id)}}" method="POST">
        @csrf
        <input type="hidden" value="{{$patent->id}}" name="patient_id">
        <input type="hidden" value="{{auth()->id()}}" name="user_id">
        <ul class="list-group">
        <li class="list-group-item">
                        <div class="form-row align-items-center">
                            <div class="col-md-4">
                                <strong>Ամսաթիվ</strong>
                            </div>
                            <div class="col-md-8">
                                <x-forms.text-field name="parent_date" validation-type="ajax" type="datetime-local"
                                value="" label="" />
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="form-row align-items-center">
                            <div class="col-md-4">
                                <strong>Բուժման նախատեսվող սկիզբ</strong>
                            </div>
                            <div class="col-md-8">
                                <x-forms.text-field name="date_treatment" validation-type="ajax" type="datetime-local"
                                value="" label="" />
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row my-2">
                            <div class="col-md-4">
                                <strong>Բուժասարք</strong>
                            </div>
                            <div class="col-md-2">
                                <x-forms.checkbox-radio pos="align" id="wheelchair-radio1" value="Terabalt" name="device" label="Terabalt"/>
                            </div>
                            <div class="col-md-2">
                                <x-forms.checkbox-radio pos="align" id="wheelchair-radio2" value="Elekta" name="device" label="Elekta"/>
                            </div>
                                <em class="error text-danger"></em>
                        </div>
                        <div>
                            <x-forms.text-field type="textarea" name="medical_device" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                            value="" label="" />
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row my-2">
                            <div class="col-md-4">
                                <strong>Portal imaging</strong>
                            </div>
                            <div class="col-md-2">
                                <x-forms.checkbox-radio pos="align" id="wheelchair-portal" value="yes" name="portal" label="այո"/>
                            </div>
                            <div class="col-md-2">
                                <x-forms.checkbox-radio pos="align" id="wheelchair-portal2" value="no" name="portal" label="ոչ"/>
                            </div>
                                    <em class="error text-danger"></em>
                        </div>
                        <div>
                            <x-forms.text-field type="textarea" name="portal_imaging" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                            value="" label="" />
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row my-2">
                            <div class="col-md-4">
                                <strong>CT / MRI fusion</strong>
                            </div>
                            <div class="col-md-2">
                                <x-forms.checkbox-radio pos="align" id="wheelchair-fusion1" value="yes" name="fusion" label="այո"/>
                            </div>
                            <div class="col-md-2">
                                <x-forms.checkbox-radio pos="align" id="wheelchair-fusion2" value="no" name="fusion" label="ոչ"/>
                            </div>
                                    <em class="error text-danger"></em>
                        </div>
                        <div>
                            <x-forms.text-field type="textarea" name="MRI_fusion" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                            value="" label="" />
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row my-2">
                            <div class="col-md-4">
                                <strong>Կուրսը</strong>
                            </div>
                            <div class="col-md-2">
                                <x-forms.checkbox-radio pos="align" id="wheelchair-radical1" value="radical" name="course" label="արմատական"/>
                            </div>
                            <div class="col-md-2">
                                <x-forms.checkbox-radio pos="align" id="wheelchair-adjuvant" value="adjuvant" name="course" label="ադյուվանտ"/>
                            </div>
                            <div class="col-md-2">
                                <x-forms.checkbox-radio pos="align" id="wheelchair-palliative" value="palliative" name="course" label="պալիատիվ"/>
                            </div>
                                    <em class="error text-danger"></em>
                        </div>
                        <div>
                            <x-forms.text-field type="textarea" name="course_info" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                            value="" label="" />
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row my-2">
                            <div class="col-md-4">
                                <strong>Բաժնևորում</strong>
                            </div>
                            <div class="col-md-2">
                                <x-forms.checkbox-radio pos="align" id="wheelchair-standard" value="standard" name="section" label="ստանդարտ"/>
                            </div>
                            <div class="col-md-2">
                                <x-forms.checkbox-radio pos="align" id="wheelchair-multiplay" value="multiplay" name="section" label="մուլտ."/>
                            </div>
                            <div class="col-md-2">
                                <x-forms.checkbox-radio pos="align" id="wheelchair-escalation" value="escalation" name="section" label="էսկալացիոն"/>
                            </div>
                                    <em class="error text-danger"></em>
                        </div>
                        <div>
                            <x-forms.text-field type="textarea" name="section_info" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                            value="" label="" />
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div>
                            <x-forms.text-field type="textarea" name="MOD_info" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                                value="" label="ՄՕԴ (Գր)" />
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div>
                            <x-forms.text-field type="textarea" name="GOD_info" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                                value="" label="ԳՕԴ (Գր)" />
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row my-2">
                            <div class="col-md-3">
                                <strong>Boost</strong>
                            </div>
                            <div class="col-md-2">
                                <x-forms.checkbox-radio pos="align" id="wheelchair-boost-yes" value="yes" name="boost" label="այո"/>
                            </div>
                            <div class="col-md-2">
                                <x-forms.checkbox-radio pos="align" id="wheelchair-boost-no" value="no" name="boost" label="ոչ"/>
                            </div>
                            <div class="col-md-2">
                                <x-forms.checkbox-radio pos="align" id="wheelchair-boost-together" value="together" name="boost" label="միաժամանակ"/>
                            </div>
                            <div class="col-md-2">
                                <x-forms.checkbox-radio pos="align" id="wheelchair-boost-sequentially" value="sequentially" name="boost" label="հերթականությամբ"/>
                            </div>
                                    <em class="error text-danger"></em>

                        </div>
                        <div>
                            <x-forms.text-field type="textarea" name="boost_info" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                            value="" label="" />
                        </div>
                    </li>

                    <li class="list-group-item">
                            <div>
                            <x-forms.text-field type="textarea" name="risk_organs" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                                value="" label="Ռիսկի օրգաններ" />
                        </div>
                    </li>
                    <li class="list-group-item">
                            <div>
                            <x-forms.text-field type="textarea" name="special_notes" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                                value="" label="Հատուկ նշումներ" />
                        </div>
                    </li>
                    <li class="list-group-item">
                        <strong>Կատարող ֆիզիկոս</strong>
                        <x-forms.magic-search hidden-id="r_attending_doctor_id" hidden-name="performing_physicist"
                        placeholder="Ընտրել բուժող բժիշկին․․․" class="magic-search ajax my-2" data-list-name="users"
                        value="" />
                        <strong>Բուժող բժիշկ</strong>
                        <x-forms.magic-search hidden-id="r_healer_doctor_id" hidden-name="healer_doctor"
                        placeholder="Ընտրել բաժանմունքի վարիչին․․․" class="magic-search ajax my-2" data-list-name="users"
                        value="" />
                    </li>
                    <li class="list-group-item">
                        <div class="text-center">
                            <h3>ՀՇ ՊԼԱՆԱՎՈՐՄԱՆ-ԱՐՁԱՆԱԳՐՈՒԹՅՈՒՆ</h3>
                        </div>
                    </li>
                <li class="list-group-item list-group-item-info">
                    <h4 class="text-center">
                        Լրացնում է ճառագայթային ուռուցքաբանը
                    </h4>
                </li>
                <li class="list-group-item">
                    <div class="form-row align-items-center">
                        <div class="col-md-4">
                            <strong>Ամսաթիվ</strong>
                        </div>
                        <div class="col-md-8">
                            <x-forms.text-field name="date" validation-type="ajax" type="datetime-local"
                            value="" label="" />
                        </div>
                    </div>
                    <li class="list-group-item">
                        <div class="form-row align-items-center">
                            <div class="col-md-6">
                                <strong>
                                Ազգանուն, անուն, հայրանուն
                                </strong>
                                <ins class="ml-4">ոողսսղսղսղսղսղ</ins>
                            </div>
                        </div>
                     </li>
                <li class="list-group-item">
                    <div class="form-row align-items-center">
                        <div class="col-md-4">
                            <strong>
                            Հ/պ
                            </strong>
                            <ins class="ml-4">{{$patent->residence_region}}</ins>
                        </div>
                        <div class="col-md-4">
                            <strong>
                             <span class="badge badge-light mr-1"></span>
                             Ա/ք
                            </strong>
                            <ins class="ml-4">{{$patent->town_village}}</ins>

                        </div>
                        <div class="col-md-4">
                            <strong>
                             <span class="badge badge-light mr-1"></span>
                             ID
                            </strong>
                            <ins class="ml-4">{{$patent->passport}}</ins>
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <strong> Ախտորոշում</strong>
                    <x-forms.add-reduce-button type="add" data-row=".admission-row"/>
                    <x-forms.add-reduce-button type="reduce" data-row=".admission-row"/>
                    <x-forms.hidden-counter class="admission-rows" name="admission_diagnosis_length"/>
                    @for($i = 0; $i < $repeatables; $i++)
                        <div class="admission-row {{ $i < old('admission_diagnosis_length', 1) ? ' ' : 'd-none' }}">
                    <div class="my-2">
                        <x-forms.magic-search class="magic-search ajax" value='{{ old("diseasis_id.$i") }}' hidden-id="diseasis_id{{ $i }}"
                         hidden-name="disease_id[]" data-catalog-name="diseases" placeholder="ընտրել հիվանդությունը․․․" />
                    </div>
                    <x-forms.text-field type="textarea" name="diagnosis_comment[]" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                    value="" label="" />
                        </div>
                        @endfor
                </li>
                <li class="list-group-item">
                    <div>
                    <x-forms.text-field type="textarea" name="section_step" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="" label="Հետազոտվող հատվածը և քայլը (մմ)" />
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="row my-2">
                        <div class="col-md-4">
                            <strong>Հիվանդի դիրքը</strong>
                        </div>
                        <div class="col-md-2">
                            <x-forms.checkbox-radio pos="align" id="wheelchair-position-Supine" value="Supine" name="position" label="Մեջքին(Supine)"/>
                        </div>
                        <div class="col-md-2">
                            <x-forms.checkbox-radio pos="align" id="wheelchair-position-Prone" value="Prone" name="position" label="Փորին(Prone)"/>
                        </div>
                            <em class="error text-danger"></em>
                    </div>
                        <div>
                            <x-forms.text-field type="textarea" name="patient_position" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                            value="" label="" />
                        </div>
                </li>
                <li class="list-group-item">
                    <div class="row my-2">
                        <div class="col-md-4">
                            <strong>Կոնտրաստ </strong>
                        </div>
                        <div class="col-md-2">
                            <x-forms.checkbox-radio pos="align" id="wheelchair-contrast-without" value="without" name="contrast" label="առանց"/>
                        </div>
                        <div class="col-md-2">
                            <x-forms.checkbox-radio pos="align" id="wheelchair-contrast-n_e" value="n_e" name="contrast" label="ն/ե"/>
                        </div>
                        <div class="col-md-2">
                            <x-forms.checkbox-radio pos="align" id="wheelchair-contrast-per_os" value="per_os" name="contrast" label=" per os"/>
                        </div>
                        <div class="col-md-2">
                            <x-forms.checkbox-radio pos="align" id="wheelchair-contrast-per_rectum" value="per_rectum" name="contrast" label="per rectum"/>
                        </div>
                            <em class="error text-danger"></em>
                    </div>
                        <div>
                            <x-forms.text-field type="textarea" name="contrast_info" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                            value="" label="" />
                        </div>
                </li>

                <li class="list-group-item list-group-item-info">
                    <h4 class="text-center">
                        Լրացնում է ճառագայթային  տեխնիկը
                    </h4>
                </li>
                </li><li class="list-group-item">
                    <div class="row my-2">
                        <div class="col-md-3">
                            <strong>Breast board №<span>1</span></strong>
                        </div>
                    </div>
                         <div>
                            <x-forms.text-field type="textarea" name="breast" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                            value="" label="" />
                        </div>
                </li>
                <li class="list-group-item text-center">
                   <strong>N1 (Med-Tec)</strong>
                </li>
                <li class="list-group-item">
                   <div>
                    <x-forms.text-field type="textarea" name="n1_height" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="" label="Բարձրություն" />
                    </div>
                </li>
                <li class="list-group-item">
                   <div>
                    <x-forms.text-field type="textarea" name="n1_headache" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="" label="Գլխատակ" />
                    </div>
                </li><li class="list-group-item">
                    <div class="row my-2">
                        <div class="col-md-4 ">
                            <strong>Ձեռքեր</strong>
                        </div>
                        <div class="col-md-2">
                            <x-forms.checkbox-radio pos="align" id="wheelchair-hands-n1-right" value="right" name="n1_hand" label="աջ"/>
                        </div>
                        <div class="col-md-2">
                            <x-forms.checkbox-radio pos="align" id="wheelchair-hands-n1-left" value="left" name="n1_hand" label="ձախ"/>
                        </div>
                                <em class="error text-danger"></em>
                    </div>
                    <div>
                        <x-forms.text-field type="textarea" name="n1_hands" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="text-center"><strong>N2(Q-flx)</strong>
                    </div>
                </li>
                <li class="list-group-item">
                   <div>
                    <x-forms.text-field type="textarea" name="corner" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="" label="Անկյուն" />
                    </div>
                </li>
                <li class="list-group-item">
                   <div>
                    <x-forms.text-field type="textarea" name="n2_headache_info" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="" label="Գլխատակ" />
                    </div>
                </li><li class="list-group-item">
                    <div class="row my-2">
                        <div class="col-md-4">
                            <strong>Ձեռքեր</strong>
                        </div>
                        <div class="col-md-2">
                            <x-forms.checkbox-radio pos="align" id="wheelchair-n2_hand-right" value="right" name="n2_hand" label="աջ"/>
                        </div>
                        <div class="col-md-2">
                            <x-forms.checkbox-radio pos="align" id="wheelchair-n2_hand-left" value="left" name="n2_hand" label="ձախ"/>
                        </div>
                                <em class="error text-danger"></em>
                    </div>
                    <div>
                        <x-forms.text-field type="textarea" name="n2_headache_info" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                   <div>
                    <x-forms.text-field type="textarea" name="arched_position" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="" label="Կամար դիրքը" />
                    </div>
                </li>
                <li class="list-group-item">
                   <div>
                    <x-forms.text-field type="textarea" name="n2_height" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="" label="Բարձրություն(H)" />
                    </div>
                </li>
                </li><li class="list-group-item">
                    <div class="row">
                        <div class="col-md-4">
                            <strong>Գլխատակ / подголовник</strong>
                        </div>
                        <div class="col-md-1">
                            <x-forms.checkbox-radio pos="align" id="wheelchair-n2_special_notes-n2_headache-a" value="a" name="n2_headache" label="A"/>
                        </div>
                        <div class="col-md-1">
                            <x-forms.checkbox-radio pos="align" id="wheelchair-n2_special_notes-n2_headache-b" value="b" name="n2_headache" label="B"/>
                        </div>
                        <div class="col-md-1">
                            <x-forms.checkbox-radio pos="align" id="wheelchair-n2_special_notes-n2_headache-c" value="c" name="n2_headache" label="C"/>
                        </div>
                        <div class="col-md-1">
                            <x-forms.checkbox-radio pos="align" id="wheelchair-n2_special_notes-n2_headache-d" value="d" name="n2_headache" label="D"/>
                        </div>
                        <div class="col-md-1">
                            <x-forms.checkbox-radio pos="align" id="wheelchair-n2_special_notes-n2_headache-e" value="e" name="n2_headache" label="E"/>
                        </div>
                        <div class="col-md-1">
                            <x-forms.checkbox-radio pos="align" id="wheelchair-n2_special_notes-n2_headache-f" value="f" name="n2_headache" label="F"/>
                        </div>
                                <em class="error text-danger"></em>
                    </div>
                </li>
                <li class="list-group-item">
                   <div>
                    <x-forms.text-field type="textarea" name="n2_special_notes" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="" label="Հատուկ նշումներ" />
                    </div>
                </li>
                </li><li class="list-group-item">
                    <div class="row my-2">
                        <div class="col-md-2">
                            <strong>Belly board</strong>
                        </div>
                    </div>
                    <div>
                        <x-forms.text-field type="textarea" name="belly_board" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="" label="" />
                    </div>
                </li>
                </li><li class="list-group-item">
                    <div class="row my-2">
                        <div class="col-md-4">
                            <x-forms.checkbox-radio pos="align" id="wheelchair-board-Knee" value="Knee" name="board" label="Ծունկ"/>
                                <em class="error text-danger"></em>
                        </div>
                        <div class="col-md-4">
                            <x-forms.checkbox-radio pos="align" id="wheelchair-board-Foot" value="Foot" name="board" label="Ոտնաթաթ"/>
                                <em class="error text-danger"></em>
                        </div>
                    </div>
                        <div>
                            <x-forms.text-field type="textarea" name="board_info" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                            value="" label="" />
                        </div>
                </li>
                </li><li class="list-group-item">
                    <div class="row my-2">
                        <div class="col-md-4">
                            <strong>Դիմակ</strong>
                        </div>
                        <div class="col-md-2">
                            <x-forms.checkbox-radio pos="align" id="wheelchair-mask-yes" value="yes" name="mask" label="այո"/>
                        </div>
                        <div class="col-md-2">
                            <x-forms.checkbox-radio pos="align" id="wheelchair-mask-no" value="no" name="mask" label="ոչ"/>
                        </div>
                                <em class="error text-danger"></em>
                    </div>
                    <div>
                        <x-forms.text-field type="textarea" name="mask_info" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="" label="" />
                    </div>
                </li>
                </li><li class="list-group-item">
                    <div class="row my-2">
                        <div class="col-md-4">
                            <strong>Նշումներ</strong>
                        </div>
                        <div class="col-md-2">
                            <x-forms.checkbox-radio pos="align" id="wheelchair-notes-tatoo" value="tatoo" name="notes" label="tatoo"/>
                        </div>
                        <div class="col-md-2">
                            <x-forms.checkbox-radio pos="align" id="wheelchair-notes-draw" value="draw" name="notes" label="draw"/>
                        </div>
                                <em class="error text-danger"></em>
                    </div>
                    <div>
                        <x-forms.text-field type="textarea" name="notes_info" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="" label="" />
                    </div>
                </li>
                </li><li class="list-group-item">
                    <div class="row my-2">
                        <div class="col-md-4">
                            <strong>Սպիի նշումներ</strong>
                        </div>
                        <div class="col-md-2">
                            <x-forms.checkbox-radio pos="align" id="wheelchair-scar_notes-yes" value="yes" name="scar_notes" label="այո"/>
                        </div>
                        <div class="col-md-2">
                            <x-forms.checkbox-radio pos="align" id="wheelchair-scar_notes-no" value="no" name="scar_notes" label="ոչ"/>
                        </div>
                                <em class="error text-danger"></em>
                    </div>
                    <div>
                        <x-forms.text-field type="textarea" name="scar_notes_info" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="" label="" />
                    </div>
                </li>
                </li><li class="list-group-item">
                    <div class="row my-2">
                        <div class="col-md-4">
                            <strong>Կրծքագեղձի նշում</strong>
                        </div>
                        <div class="col-md-2">
                            <x-forms.checkbox-radio pos="align" id="wheelchair-breast_notes-yes" value="yes" name="breast_notes" label="այո"/>
                        </div>
                        <div class="col-md-2">
                            <x-forms.checkbox-radio pos="align" id="wheelchair-breast_notes-no" value="no" name="breast_notes" label="ոչ"/>
                        </div>
                                <em class="error text-danger"></em>
                    </div>
                    <div>
                        <x-forms.text-field type="textarea" name="breast_notes_info" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                        <strong>Կատարող</strong>
                        <x-forms.magic-search hidden-id="performer" hidden-name="performer"
                        placeholder="Ընտրել բուժող բժիշկին․․․" class="magic-search ajax my-2" data-list-name="users"
                        value="" />
                        <strong>Բուժող բժիշկ</strong>
                        <x-forms.magic-search hidden-id="n2_healer_doctor" hidden-name="n2_healer_doctor"
                        placeholder="Ընտրել բաժանմունքի վարիչին․․․" class="magic-search ajax my-2" data-list-name="users"
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
<script>
    var repeatables = {{$repeatables}};
</script>
@endsection
