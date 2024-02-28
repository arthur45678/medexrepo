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
    <form  action="{{route('samples.patients.planning-protocol.update',[$planing->id, $patent->id])}}" method="POST">
        @csrf
        @method('put')
        <input type="hidden" value="{{$patent->id}}" name="patient_id">
        <ul class="list-group">
        <li class="list-group-item">
                        <div class="form-row align-items-center">
                            <div class="col-md-4">
                                <strong>Ամսաթիվ</strong>
                            </div>
                            <div class="col-md-8">
                                <x-forms.text-field name="parent_date" validation-type="ajax" type="datetime-local"
                                value="{{\Illuminate\Support\Carbon::parse($planing->parent_date)->format('Y-m-d\TH:i')}}" label="" />
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
                                value="{{\Illuminate\Support\Carbon::parse($planing->date_treatment)->format('Y-m-d\TH:i')}}" label="" />
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row my-2">
                            <div class="col-md-4">
                                <strong>Բուժասարք</strong>
                            </div>
                            <div class="col-md-2">
                                <x-forms.checkbox-radio pos="align" id="wheelchair-radio1" value="Terabalt"  name="device" label="Terabalt" check="{{$planing->device=='Terabalt'}}"/>
                            </div>
                            <div class="col-md-2">
                                <x-forms.checkbox-radio pos="align" id="wheelchair-radio2" value="Elekta"  name="device" label="Elekta" check="{{$planing->device=='Elekta'}}"/>
                            </div>
                                <em class="error text-danger"></em>
                        </div>
                        <div>
                            <x-forms.text-field type="textarea" name="medical_device" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                            value="{{$planing->medical_device}}" label="" />
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row my-2">
                            <div class="col-md-4">
                                <strong>Portal imaging</strong>
                            </div>
                            <div class="col-md-2">
                                <x-forms.checkbox-radio pos="align" id="wheelchair-portal" value="yes" check="{{$planing->portal=='yes'}}" name="portal" label="այո"/>
                            </div>
                            <div class="col-md-2">
                                <x-forms.checkbox-radio pos="align" id="wheelchair-portal2" value="no" check="{{$planing->portal=='no'}}" name="portal" label="ոչ"/>
                            </div>
                                    <em class="error text-danger"></em>
                        </div>
                        <div>
                            <x-forms.text-field type="textarea" name="portal_imaging" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                            value="{{$planing->portal_imaging}}" label="" />
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row my-2">
                            <div class="col-md-4">
                                <strong>CT / MRI fusion</strong>
                            </div>
                            <div class="col-md-2">
                                <x-forms.checkbox-radio pos="align" id="wheelchair-fusion1" value="yes" check="{{$planing->fusion=='yes'}}" name="fusion" label="այո"/>
                            </div>
                            <div class="col-md-2">
                                <x-forms.checkbox-radio pos="align" id="wheelchair-fusion2" value="no" check="{{$planing->fusion=='no'}}" name="fusion" label="ոչ"/>
                            </div>
                                    <em class="error text-danger"></em>
                        </div>
                        <div>
                            <x-forms.text-field type="textarea" name="MRI_fusion" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                            value="{{$planing->MRI_fusion}}" label="" />
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row my-2">
                            <div class="col-md-4">
                                <strong>Կուրսը</strong>
                            </div>
                            <div class="col-md-2">
                                <x-forms.checkbox-radio pos="align" id="wheelchair-radical1" value="radical" name="course" check="{{$planing->course=='radical'}}" label="արմատական"/>
                            </div>
                            <div class="col-md-2">
                                <x-forms.checkbox-radio pos="align" id="wheelchair-adjuvant" value="adjuvant" name="course" check="{{$planing->course=='adjuvant'}}" label="ադյուվանտ"/>
                            </div>
                            <div class="col-md-2">
                                <x-forms.checkbox-radio pos="align" id="wheelchair-palliative" value="palliative" name="course" check="{{$planing->course=='palliative'}}" label="պալիատիվ"/>
                            </div>
                                    <em class="error text-danger"></em>
                        </div>
                        <div>
                            <x-forms.text-field type="textarea" name="course_info" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                            value="{{$planing->course_info}}" label="" />
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row my-2">
                            <div class="col-md-4">
                                <strong>Բաժնևորում</strong>
                            </div>
                            <div class="col-md-2">
                                <x-forms.checkbox-radio pos="align" id="wheelchair-standard" value="standard" name="section"  check="{{$planing->section=='standard'}}" label="ստանդարտ"/>
                            </div>
                            <div class="col-md-2">
                                <x-forms.checkbox-radio pos="align" id="wheelchair-multiplay" value="multiplay" name="section"  check="{{$planing->section=='multiplay'}}" label="մուլտ."/>
                            </div>
                            <div class="col-md-2">
                                <x-forms.checkbox-radio pos="align" id="wheelchair-escalation" value="escalation" name="section"  check="{{$planing->section=='escalation'}}" label="էսկալացիոն"/>
                            </div>
                                    <em class="error text-danger"></em>
                        </div>
                        <div>
                            <x-forms.text-field type="textarea" name="section_info" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                            value="{{$planing->section_info}}" label="" />
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div>
                            <x-forms.text-field type="textarea" name="MOD_info" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                                value="{{$planing->MOD_info}}" label="ՄՕԴ (Գր)" />
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div>
                            <x-forms.text-field type="textarea" name="GOD_info" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                                value="{{$planing->GOD_info}}" label="ԳՕԴ (Գր)" />
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row my-2">
                            <div class="col-md-3">
                                <strong>Boost</strong>
                            </div>
                            <div class="col-md-2">
                                <x-forms.checkbox-radio pos="align" id="wheelchair-boost-yes" value="yes" name="boost" check="{{$planing->boost=='yes'}}" label="այո"/>
                            </div>
                            <div class="col-md-2">
                                <x-forms.checkbox-radio pos="align" id="wheelchair-boost-no" value="no" name="boost" check="{{$planing->boost=='no'}}" label="ոչ"/>
                            </div>
                            <div class="col-md-2">
                                <x-forms.checkbox-radio pos="align" id="wheelchair-boost-together" value="together" check="{{$planing->boost=='together'}}" name="boost" label="միաժամանակ"/>
                            </div>
                            <div class="col-md-2">
                                <x-forms.checkbox-radio pos="align" id="wheelchair-boost-sequentially" value="sequentially" check="{{$planing->boost=='sequentially'}}" name="boost" label="հերթականությամբ"/>
                            </div>
                                    <em class="error text-danger"></em>

                        </div>
                        <div>
                            <x-forms.text-field type="textarea" name="boost_info" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                            value="{{$planing->boost_info}}" label="" />
                        </div>
                    </li>

                    <li class="list-group-item">
                            <div>
                            <x-forms.text-field type="textarea" name="risk_organs" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                                value="{{$planing->risk_organs}}" label="Ռիսկի օրգաններ" />
                        </div>
                    </li>
                    <li class="list-group-item">
                            <div>
                            <x-forms.text-field type="textarea" name="special_notes" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                                value="{{$planing->special_notes}}" label="Հատուկ նշումներ" />
                        </div>
                    </li>
                    <li class="list-group-item">
                        <strong>Կատարող ֆիզիկոս</strong>
                        <x-forms.magic-search hidden-id="r_attending_doctor_id" hidden-name="performing_physicist"
                        placeholder="Ընտրել բուժող բժիշկին․․․" class="magic-search ajax my-2" data-list-name="users"
                        value="{{$planing->performing_physicist}}" />
                        <strong>Բուժող բժիշկ</strong>
                        <x-forms.magic-search hidden-id="r_healer_doctor_id" hidden-name="healer_doctor"
                        placeholder="Ընտրել բաժանմունքի վարիչին․․․" class="magic-search ajax my-2" data-list-name="users"
                        value="{{$planing->healer_doctor}}" />
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
                            value="{{\Illuminate\Support\Carbon::parse($planing->date)->format('Y-m-d\TH:i')}}" label="" />
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
                    <table class="table" border="2">
                    <thead>
                    <tr>
                        <th>դեղամիջոցը</th>
                        <th>գրառման</th>
                        <th>ջնջել</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($planingdiagnostic as $planingdiagnostics)
                        <tr id="trashData{{$planingdiagnostics->id}}">
                            <td>{{$planingdiagnostics->medicine_name->name}}</td>
                            <td>{{$planingdiagnostics->diagnosis_comment}}</td>
                            <td>
                                <button class="btn btn-danger btn-sm clickTrash" type="button"
                                        onclick="clickTrash({{$planingdiagnostics->id}})">
                                    <x-svg icon="cui-trash"/>
                                </button>
                            </td>
                        </tr>
                    @endforeach


                    </tbody>
                    </table>
                    <strong>
                        <span class="badge badge-light mr-1"></span>
                        Ավելացնել Ախտորոշում
                    </strong>
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
                        value="{{$planing->section_step}}" label="Հետազոտվող հատվածը և քայլը (մմ)" />
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="row my-2">
                        <div class="col-md-4">
                            <strong>Հիվանդի դիրքը</strong>
                        </div>
                        <div class="col-md-2">
                            <x-forms.checkbox-radio pos="align" id="wheelchair-position-Supine" value="Supine" name="position" check="{{$planing->position=='Supine'}}" label="Մեջքին(Supine)"/>
                        </div>
                        <div class="col-md-2">
                            <x-forms.checkbox-radio pos="align" id="wheelchair-position-Prone" value="Prone" name="position" check="{{$planing->position=='Prone'}}" label="Փորին(Prone)"/>
                        </div>
                            <em class="error text-danger"></em>
                    </div>
                        <div>
                            <x-forms.text-field type="textarea" name="patient_position" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                            value="{{$planing->patient_position}}" label="" />
                        </div>
                </li>
                <li class="list-group-item">
                    <div class="row my-2">
                        <div class="col-md-4">
                            <strong>Կոնտրաստ </strong>
                        </div>
                        <div class="col-md-2">
                            <x-forms.checkbox-radio pos="align" id="wheelchair-contrast-without" value="without" name="contrast" check="{{$planing->contrast=='without'}}" label="առանց"/>
                        </div>
                        <div class="col-md-2">
                            <x-forms.checkbox-radio pos="align" id="wheelchair-contrast-n_e" value="n_e" name="contrast" check="{{$planing->contrast=='n_e'}}" label="ն/ե"/>
                        </div>
                        <div class="col-md-2">
                            <x-forms.checkbox-radio pos="align" id="wheelchair-contrast-per_os" value="per_os" name="contrast" check="{{$planing->contrast=='per_os'}}" label=" per os"/>
                        </div>
                        <div class="col-md-2">
                            <x-forms.checkbox-radio pos="align" id="wheelchair-contrast-per_rectum" value="per_rectum" name="contrast" check="{{$planing->contrast=='per_rectum'}}" label="per rectum"/>
                        </div>
                            <em class="error text-danger"></em>
                    </div>
                        <div>
                            <x-forms.text-field type="textarea" name="contrast_info" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                            value="{{$planing->contrast_info}}" label="" />
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
                            value="{{$planing->breast}}" label="" />
                        </div>
                </li>
                <li class="list-group-item text-center">
                   <strong>N1 (Med-Tec)</strong>
                </li>
                <li class="list-group-item">
                   <div>
                    <x-forms.text-field type="textarea" name="n1_height" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$planing->n1_height}}" label="Բարձրություն" />
                    </div>
                </li>
                <li class="list-group-item">
                   <div>
                    <x-forms.text-field type="textarea" name="n1_headache" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$planing->n1_headache}}" label="Գլխատակ" />
                    </div>
                </li><li class="list-group-item">
                    <div class="row my-2">
                        <div class="col-md-4 ">
                            <strong>Ձեռքեր</strong>
                        </div>
                        <div class="col-md-2">
                            <x-forms.checkbox-radio pos="align" id="wheelchair-hands-n1-right" value="right" check="{{$planing->n1_hand=='right'}}" name="n1_hand" label="աջ"/>
                        </div>
                        <div class="col-md-2">
                            <x-forms.checkbox-radio pos="align" id="wheelchair-hands-n1-left" value="left" check="{{$planing->n1_hand=='left'}}" name="n1_hand" label="ձախ"/>
                        </div>
                                <em class="error text-danger"></em>
                    </div>
                    <div>
                        <x-forms.text-field type="textarea" name="n1_hands" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$planing->n1_hands}}" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="text-center"><strong>N2(Q-flx)</strong>
                    </div>
                </li>
                <li class="list-group-item">
                   <div>
                    <x-forms.text-field type="textarea" name="corner" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$planing->corner}}" label="Անկյուն" />
                    </div>
                </li>
                <li class="list-group-item">
                   <div>
                    <x-forms.text-field type="textarea" name="n2_headache_info" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$planing->n2_headache_info}}" label="Գլխատակ" />
                    </div>
                </li><li class="list-group-item">
                    <div class="row my-2">
                        <div class="col-md-4">
                            <strong>Ձեռքեր</strong>
                        </div>
                        <div class="col-md-2">
                            <x-forms.checkbox-radio pos="align" id="wheelchair-n2_hand-right" value="right" name="n2_hand" check="{{$planing->n2_hand=='right'}}" label="աջ"/>
                        </div>
                        <div class="col-md-2">
                            <x-forms.checkbox-radio pos="align" id="wheelchair-n2_hand-left" value="left" name="n2_hand" check="{{$planing->n2_hand=='left'}}" label="ձախ"/>
                        </div>
                                <em class="error text-danger"></em>
                    </div>
                    <div>
                        <x-forms.text-field type="textarea" name="n2_headache_info" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$planing->n2_headache_info}}" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                   <div>
                    <x-forms.text-field type="textarea" name="arched_position" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$planing->arched_position}}" label="Կամար դիրքը" />
                    </div>
                </li>
                <li class="list-group-item">
                   <div>
                    <x-forms.text-field type="textarea" name="n2_height" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$planing->n2_height}}" label="Բարձրություն(H)" />
                    </div>
                </li>
                </li><li class="list-group-item">
                    <div class="row">
                        <div class="col-md-4">
                            <strong>Գլխատակ / подголовник</strong>
                        </div>
                        <div class="col-md-1">
                            <x-forms.checkbox-radio pos="align" id="wheelchair-n2_special_notes-n2_headache-a" value="a" name="n2_headache" check="{{$planing->n2_headache=='a'}}" label="A"/>
                        </div>
                        <div class="col-md-1">
                            <x-forms.checkbox-radio pos="align" id="wheelchair-n2_special_notes-n2_headache-b" value="b" name="n2_headache" check="{{$planing->n2_headache=='b'}}" label="B"/>
                        </div>
                        <div class="col-md-1">
                            <x-forms.checkbox-radio pos="align" id="wheelchair-n2_special_notes-n2_headache-c" value="c" name="n2_headache" check="{{$planing->n2_headache=='c'}}" label="C"/>
                        </div>
                        <div class="col-md-1">
                            <x-forms.checkbox-radio pos="align" id="wheelchair-n2_special_notes-n2_headache-d" value="d" name="n2_headache" check="{{$planing->n2_headache=='d'}}" label="D"/>
                        </div>
                        <div class="col-md-1">
                            <x-forms.checkbox-radio pos="align" id="wheelchair-n2_special_notes-n2_headache-e" value="e" name="n2_headache" check="{{$planing->n2_headache=='e'}}" label="E"/>
                        </div>
                        <div class="col-md-1">
                            <x-forms.checkbox-radio pos="align" id="wheelchair-n2_special_notes-n2_headache-f" value="f" name="n2_headache" check="{{$planing->n2_headache=='f'}}" label="F"/>
                        </div>
                                <em class="error text-danger"></em>
                    </div>
                </li>
                <li class="list-group-item">
                   <div>
                    <x-forms.text-field type="textarea" name="n2_special_notes" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$planing->n2_special_notes}}" label="Հատուկ նշումներ" />
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
                        value="{{$planing->belly_board}}" label="" />
                    </div>
                </li>
                </li><li class="list-group-item">
                    <div class="row my-2">
                        <div class="col-md-4">
                            <x-forms.checkbox-radio pos="align" id="wheelchair-board-Knee" value="Knee" name="board" check="{{$planing->board=='Knee'}}"  label="Ծունկ"/>
                                <em class="error text-danger"></em>
                        </div>
                        <div class="col-md-4">
                            <x-forms.checkbox-radio pos="align" id="wheelchair-board-Foot" value="Foot" name="board" check="{{$planing->board=='Foot'}}"  label="Ոտնաթաթ"/>
                                <em class="error text-danger"></em>
                        </div>
                    </div>
                        <div>
                            <x-forms.text-field type="textarea" name="board_info" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                            value="{{$planing->board_info}}" label="" />
                        </div>
                </li>
                </li><li class="list-group-item">
                    <div class="row my-2">
                        <div class="col-md-4">
                            <strong>Դիմակ</strong>
                        </div>
                        <div class="col-md-2">
                            <x-forms.checkbox-radio pos="align" id="wheelchair-mask-yes" value="yes" name="mask" check="{{$planing->mask=='yes'}}" label="այո"/>
                        </div>
                        <div class="col-md-2">
                            <x-forms.checkbox-radio pos="align" id="wheelchair-mask-no" value="no" name="mask" check="{{$planing->mask=='no'}}" label="ոչ"/>
                        </div>
                                <em class="error text-danger"></em>
                    </div>
                    <div>
                        <x-forms.text-field type="textarea" name="mask_info" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$planing->mask_info}}" label="" />
                    </div>
                </li>
                </li><li class="list-group-item">
                    <div class="row my-2">
                        <div class="col-md-4">
                            <strong>Նշումներ</strong>
                        </div>
                        <div class="col-md-2">
                            <x-forms.checkbox-radio pos="align" id="wheelchair-notes-tatoo" value="tatoo" name="notes" check="{{$planing->notes=='tatoo'}}" label="tatoo"/>
                        </div>
                        <div class="col-md-2">
                            <x-forms.checkbox-radio pos="align" id="wheelchair-notes-draw" value="draw" name="notes" check="{{$planing->notes=='draw'}}" label="draw"/>
                        </div>
                                <em class="error text-danger"></em>
                    </div>
                    <div>
                        <x-forms.text-field type="textarea" name="notes_info" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$planing->notes_info}}" label="" />
                    </div>
                </li>
                </li><li class="list-group-item">
                    <div class="row my-2">
                        <div class="col-md-4">
                            <strong>Սպիի նշումներ</strong>
                        </div>
                        <div class="col-md-2">
                            <x-forms.checkbox-radio pos="align" id="wheelchair-scar_notes-yes" value="yes" name="scar_notes"  check="{{$planing->scar_notes=='yes'}}" label="այո"/>
                        </div>
                        <div class="col-md-2">
                            <x-forms.checkbox-radio pos="align" id="wheelchair-scar_notes-no" value="no" name="scar_notes"  check="{{$planing->scar_notes=='no'}}" label="ոչ"/>
                        </div>
                                <em class="error text-danger"></em>
                    </div>
                    <div>
                        <x-forms.text-field type="textarea" name="scar_notes_info" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$planing->scar_notes_info}}" label="" />
                    </div>
                </li>
                </li><li class="list-group-item">
                    <div class="row my-2">
                        <div class="col-md-4">
                            <strong>Կրծքագեղձի նշում</strong>
                        </div>
                        <div class="col-md-2">
                            <x-forms.checkbox-radio pos="align" id="wheelchair-breast_notes-yes" value="yes" name="breast_notes"  check="{{$planing->breast_notes=='yes'}}" label="այո"/>
                        </div>
                        <div class="col-md-2">
                            <x-forms.checkbox-radio pos="align" id="wheelchair-breast_notes-no" value="no" name="breast_notes"  check="{{$planing->breast_notes=='no'}}" label="ոչ"/>
                        </div>
                                <em class="error text-danger"></em>
                    </div>
                    <div>
                        <x-forms.text-field type="textarea" name="breast_notes_info" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$planing->breast_notes_info}}" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                        <strong>Կատարող</strong>
                        <x-forms.magic-search hidden-id="performer" hidden-name="performer"
                        placeholder="Ընտրել բուժող բժիշկին․․․" class="magic-search ajax my-2" data-list-name="users"
                        value="{{$planing->performer}}" />
                        <strong>Բուժող բժիշկ</strong>
                        <x-forms.magic-search hidden-id="n2_healer_doctor" hidden-name="n2_healer_doctor"
                        placeholder="Ընտրել բաժանմունքի վարիչին․․․" class="magic-search ajax my-2" data-list-name="users"
                        value="{{$planing->n2_healer_doctor}}" />
                </li>
                @include('shared.forms.list_group_item_submit', ['btn_text'=>'Ուղարկել'])
        </ul>

    </form>
</div>
@endsection
<script>
    function clickTrash(data) {
        let _token   = $('meta[name="csrf-token"]').attr('content');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '{{url('samples/planning-protocoltrash/medication/')}}'+'/'+data,
            type:"get",
            success: function (data) {
                $('#trashData'+data).remove()
            }
        });
    }
</script>
@section('javascript')
<script src="{{ mix('js/jquery.js') }}"></script>
<script src="{{ mix('js/all.magicsearch.js') }}"></script>
<script>
    var repeatables = {{$repeatables}};
</script>

@endsection
