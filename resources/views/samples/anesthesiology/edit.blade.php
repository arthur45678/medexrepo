@extends('layouts.cardBase')

@php

use App\Enums\Samples\SampleDiagnosesEnum;
use App\Enums\Samples\SampleTreatmentsEnum;
@endphp

@section('css')
<link href="{{mix("/css/jquery.magicsearch.min.css")}}" rel="stylesheet" />
@endsection


@section('card-header')
@section('card-header-classes', '')


<div class="text-center">
    <h3>ԱՆԵՍԹԵԶԻՈԼՈԳԻ ՆԱԽԱՎԻՐԱՀԱՏԱԿԱՆ ԶՆՆՈՒՄ</h3>
</div>
@endsection


@section('card-content')
<div class="container">
    <form class="ajax-submitable" action="{{route('samples.patients.ape.update', ['patient'=> $patient, $apse->id])}}" method="POST">
        @csrf
        @method('put')
        <div class="container">
            <ul class="list-group">
                <li class="list-group-item">
                    <div class="form-row align-items-center text-center">
                        <div class="col-md-4">
                            <strong>Ընդունման ամսաթիվը և ժամը՝</strong>
                        </div>
                        <div class="col-md-8">
                            <x-forms.text-field name="date" type="date" value="{{\Illuminate\Support\Carbon::parse($apse->date)->format('Y-m-d')}}" label=""/>
                        </div>
                    </div>
                    <hr>

                    <ol class="list-group">
                        <li class="list-group-item">
                            <strong>
                                <span class="badge badge-light mr-1">1.</span>
                                Ազգանուն, անուն, հայրանուն
                            </strong>
                            <ins class="ml-4">{{$patient->all_names}}</ins>
                        </li>
                        <li class="list-group-item">
                            <strong>
                                <span class="badge badge-light mr-1">1.</span>
                                Հ․Պ․ N`
                            </strong>
                            <ins class="ml-4">{{$lates_stationary->id ?? ' '}}</ins>
                        </li>
                        <li class="list-group-item">
                            <strong>
                                <span class="badge badge-light mr-1">3.</span>
                                Տարիք՝
                            </strong>
                            <ins class="ml-4">{{$patient->age}}</ins>
                        </li>
                        <li class="list-group-item">
                            <strong>
                                <span class="badge badge-light mr-1">2.</span>
                                Սեռը՝
                            </strong>
                            @if($patient->is_male==0)
                                <ins class="ml-4">Իգական</ins>
                            @else
                                <ins class="ml-4">Արական</ins>
                            @endif
                        </li>
                    </ol>

                    <li class="list-group-item">
                        <strong>Մարմնի կառուցվածքը՝</strong>
                            <x-forms.text-field type="textarea" name="body_structure" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                value="{{$apse->body_structure}}" label="" />

                        <hr class="hr-dashed">

                        <strong>Քաշը՝</strong>
                            <x-forms.text-field type="textarea" name="weight" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                value="{{$apse->weight}}" label="" />

                        <hr class="hr-dashed">
                    <strong>
                        Ախտորոշումը
                    </strong>
                    <table class="table" border="2">
                        <thead>
                        <tr>
                            <th>Ախտորոշում</th>
                            <th>գրառման</th>
                            <th>ջնջել</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($anestologia_a as $diagnos_exits)
                            <tr id="trashData{{$diagnos_exits->id}}">
                                <td>{{$diagnos_exits->disease_name->name ?? ' '}}</td>
                                <td>{{$diagnos_exits->surgeries_comment}}</td>
                                <td>
                                    <button class="btn btn-danger btn-sm clickTrash" type="button"
                                            onclick="clickTrash({{$diagnos_exits->id}})">
                                        <x-svg icon="cui-trash"/>
                                    </button>
                                </td>
                            </tr>
                        @endforeach


                        </tbody>
                    </table>

                        <strong >Ավելացնել նոր Ախտորոշումը՝</strong>
                    <x-forms.add-reduce-button type="add" data-row=".first-diagnosis-row_a" data-limit="{{$repeatables}}"/>
                    <x-forms.add-reduce-button type="reduce" data-row=".first-diagnosis-row_a"/>
                    <x-forms.hidden-counter class="first-diagnosis-rows" name="first_diagnosis_length_a"/>

                    @for ($i = 0; $i < $repeatables; $i++)
                        <div class="container first-diagnosis-row_a {{$i>0 ? 'd-none' : ''}}">
                            <div class="my-2">
                                <x-forms.magic-search class="magic-search ajax"
                                                      hidden-id="first_diagnosis_id_a{{ $i }}" hidden-name="first_diagnosis_a[]"  validationType="ajax" data-catalog-name="diseases"
                                                      placeholder="Ընտրել ախտորոշումը․․․"/>
                            </div>
                            <x-forms.text-field type="textarea" name="first_diagnosis_comment_a[]"  validationType="ajax" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                                value="" label="" />

                        </div>
                    @endfor

                        <hr class="hr-dashed">

                        <strong>Գանգատները՝</strong>
                            <x-forms.text-field type="textarea" name="complaints" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                value="{{$apse->complaints}}" label="" />

                    </li>

                </li>
            </ul>

            <hr>

            <ul class="list-group">
                <li class="list-group-item list-group-item-info">
                    <h4 class="text-center">
                        Նախատեսված վիրահատություն
                    </h4>
                </li>

                <li class="list-group-item">

                    <strong>Վիրահատությունների ցանկ</strong>
                    <x-forms.text-field name="surgery_datetime" validation-type="ajax" type="datetime-local"
                                        value="{{\Illuminate\Support\Carbon::parse($apse->surgery_datetime)->format('Y-m-d\TH:i')}}" label="" />

                    <div class="my-2">
                        <x-forms.magic-search class="magic-search ajax" value='{{$apse->surgery_id}}' hidden-id="surgery_id"
                            hidden-name="surgery_id" data-catalog-name="surgeries" placeholder="ընտրել վիրահատությունը․․․" />
                    </div>
                    <x-forms.text-field type="textarea" name="surgeries_comment" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                        value="{{$apse->surgeries_comment}}" label="" />
                        <hr class="hr-dashed">
                        <div class="row">
                            <div class="col-md-5">
                                <strong>
                                    <span class="badge badge-light mr-1"></span>
                                    վիրահատության տիպը՝
                                </strong>
                            </div>
                            <div class="col-md-7">
                                <x-forms.checkbox-radio pos="align" id="radio1" value="urgent" value="urgent"
                                    old-default="" name="surgery_type" check="{{$apse->surgery_type=='urgent'}}"
                                    label="անհետաձգելի" />
                                <x-forms.checkbox-radio pos="align" id="radio2"
                                                        value="programmed"
                                    old-default="" name="surgery_type"
                                    label="ծրագրավորված" check="{{$apse->surgery_type=='programmed'}}" />
                            </div>
                        </div>
                </li>

                <li class="list-group-item">
                        <strong>Վիրահատող բժիշկ՝</strong>
                        <x-forms.magic-search hidden-id="ape_attending_doctor_id" hidden-name="attending_doctor_id"
                        placeholder="Ընտրել բուժող բժիշկին․․․" class="magic-search ajax my-2" data-list-name="users"
                        value="{{$apse->attending_doctor_id}}" />
                </li>

            </ul>

            <hr>

            <ul class="list-group">
                <li class="list-group-item">
                    <h5 class="text-center">Գիտակցությունը՝</h5>
                    <x-forms.text-field type="textarea" name="consciousness" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                        value="{{$apse->consciousness}}" label="" />
                </li>

                <li class="list-group-item">
                    <h5 class="text-center">Մաշկը և տես. լորձաթաղ.՝</h5>
                    <x-forms.text-field type="textarea" name="the_skin" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                        value="{{$apse->the_skin}}" label="" />
                </li>

                <li class="list-group-item">
                    <h5 class="text-center">Սիրտանոթային համակարգ՝ ԱՃ՝</h5>
                    <x-forms.text-field type="textarea" name="cardiovascular_system" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                        value="{{$apse->cardiovascular_system}}" label="" />
                </li>

                <li class="list-group-item">
                    <h5 class="text-center">Սրտի կծկ. հաճախ.՝ զ/ր</h5>
                    <x-forms.text-field type="textarea" name="heart_contraction" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                        value="{{$apse->heart_contraction}}" label="" />
                </li>

                <li class="list-group-item">
                    <h5 class="text-center">Աուսկուլտացիա՝ </h5>
                    <x-forms.text-field type="textarea" name="auscultation" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                        value="{{$apse->auscultation}}" label="" />
                </li>

                <li class="list-group-item">
                    <h5 class="text-center">էՍԳ՝, երակներ՝</h5>
                    <x-forms.text-field type="textarea" name="veins" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                        value="{{$apse->veins}}" label="" />
                </li>

                <li class="list-group-item">
                    <h5 class="text-center">Շնչական համակարգ՝, շնչ. հաճ.՝</h5>
                    <x-forms.text-field type="textarea" name="respiratory_system" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                        value="{{$apse->respiratory_system}}" label="" />
                </li>

                <li class="list-group-item">
                    <h5 class="text-center">Բերանի խոռոչ՝ </h5>
                    <x-forms.text-field type="textarea" name="oral" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                        value="{{$apse->oral}}" label="" />
                </li>

                @php

                    $mallampati_array = ['I','II','III','IV'];

                @endphp
                <li class="list-group-item">
                    <h5>Mallampati` </h5>
                    <select name="mallampati" id="">
                    @foreach($mallampati_array as $key => $item)
                        <option {{$apse->mallampati == ($key+1) ? 'selected' : '' }} value="{{$key+1}}">{{$item}}</option>
                    @endforeach
                    </select>

                </li>

                <li class="list-group-item">
                    <h5 class="text-center">Այլ օրգան համակարգեր՝ </h5>
                    <x-forms.text-field type="textarea" name="other_organ_systems" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                        value="{{$apse->other_organ_systems}}" label="" />
                </li>

                <li class="list-group-item">
                    <strong>
                        Ուղեկցող հիվանդություններ
                    </strong>
                    <table class="table" border="2">
                        <thead>
                        <tr>
                            <th>Ախտորոշում</th>
                            <th>գրառման</th>
                            <th>ջնջել</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($anestologia_b as $diagnos_exits_b)
                            <tr id="trashData{{$diagnos_exits_b->id}}">
                                <td>{{$diagnos_exits_b->disease_name->name}}</td>
                                <td>{{$diagnos_exits_b->surgeries_comment}}</td>
                                <td>
                                    <button class="btn btn-danger btn-sm clickTrash" type="button"
                                            onclick="clickTrash({{$diagnos_exits_b->id}})">
                                        <x-svg icon="cui-trash"/>
                                    </button>
                                </td>
                            </tr>
                        @endforeach


                        </tbody>
                    </table>
                    <strong>Ավելացնել նոր ուղեկցող հիվանդություններ՝</strong>
                    <x-forms.add-reduce-button type="add" data-row=".diagnosis-row" data-limit="{{$repeatables}}"/>
                    <x-forms.add-reduce-button type="reduce" data-row=".diagnosis-row"/>
                    <x-forms.hidden-counter class="diagnosis-rows" name="diagnosis_length"/>

                    @for ($i = 0; $i < $repeatables; $i++)
                        <div class="container diagnosis-row {{$i>0 ? 'd-none' : ''}}">
                            <div class="my-2">
                                <x-forms.magic-search class="magic-search ajax" value=''
                                                      hidden-id="disease_b{{ $i }}" hidden-name="diagnosis_b[]" validationType="ajax"  data-catalog-name="diseases"
                                                      placeholder="Ընտրել ախտորոշումը․․․"/>
                            </div>
                            <x-forms.text-field type="textarea" name="diagnosis_comment_b[]" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                                value="" label="" />

                        </div>
                    @endfor

                    <hr class="hr-dashed">

                    <strong>Ներկայումս ստացող բուժում՝</strong>

                    <table class="table" border="2">
                        <thead>
                        <tr>
                            <th>Ախտորոշում</th>
                            <th>գրառման</th>
                            <th>ջնջել</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($anestologia_c as $diagnos_exits_c)
                            <tr id="trashData{{$diagnos_exits_c->id}}">
                                <td>{{$diagnos_exits_c->treatment_name->name ?? ' '}}</td>
                                <td>{{$diagnos_exits_c->surgeries_comment}}</td>
                                <td>
                                <button class="btn btn-danger btn-sm clickTrash" type="button"
                                            onclick="clickTrash({{$diagnos_exits_c->id}})">
                                        <x-svg icon="cui-trash"/>
                                </button>
                                </td>
                            </tr>
                        @endforeach


                        </tbody>
                    </table>
                    <strong>Ավելացնել նոր ներկայումս ստացող բուժում՝</strong>
                    <x-forms.add-reduce-button type="add" data-row=".treatment-row" data-limit="{{$repeatables}}"/>
                    <x-forms.add-reduce-button type="reduce" data-row=".treatment-row"/>
                    <x-forms.hidden-counter class="treatment-rows" name="treatment_length"/>

                    @for ($i = 0; $i < $repeatables; $i++)
                        <div class="container treatment-row {{$i>0 ? 'd-none' : ''}}">
                            <div class="my-2">
                                <x-forms.magic-search class="magic-search ajax" value=''
                                                      hidden-id="treatment_id_c{{ $i }}" hidden-name="treatment_c[]"  validationType="ajax" data-catalog-name="treatments"
                                                      placeholder="Ընտրել ախտորոշումը․․․"/>
                            </div>
                            <x-forms.text-field type="textarea" name="treatment_comment_c[]"  validationType="ajax" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                                value="" label="" />

                        </div>
                    @endfor


                    <hr class="hr-dashed">

                    <strong>Լաբորատոր հետազոտություններ`</strong>
                    <x-forms.text-field type="textarea" name="laboratory_tests" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                        value="{{$apse->laboratory_tests}}" label="" />
                </li>

            </ul>

            <hr>

            <ul class="list-group">
                <li class="list-group-item list-group-item-info">
                    <h4 class="text-center">Անամնեզ</h4>
                </li>

                <li class="list-group-item">
                    <strong>Ալերգիկ՝</strong>
                    <x-forms.text-field type="textarea" name="allergic" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                        value="{{$apse->allergic}}" label="" />

                    <hr class="hr-dashed">

                    <strong>Վիրաբուժական՝ </strong>
                    <x-forms.text-field type="textarea" name="surgical" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                        value={{$apse->surgical}}"" label="" />

                    <hr class="hr-dashed">

                    <strong> Կրած հիվանդություններ՝ </strong>
                    <table class="table" border="2">
                        <thead>
                        <tr>
                            <th>Ախտորոշում</th>
                            <th>գրառման</th>
                            <th>ջնջել</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($anestologia_d as $diagnos_exits_d)
                            <tr id="trashData{{$diagnos_exits_d->id}}">
                                <td>{{$diagnos_exits_d->disease_name->name ?? ' '}}</td>
                                <td>{{$diagnos_exits_d->surgeries_comment}}</td>
                                <td>
                                    <button class="btn btn-danger btn-sm clickTrash" type="button"
                                            onclick="clickTrash({{$diagnos_exits_d->id}})">
                                        <x-svg icon="cui-trash"/>
                                    </button>
                                </td>
                            </tr>
                        @endforeach


                        </tbody>
                    </table>
                    <x-forms.add-reduce-button type="add" data-row=".suffering-diseases-row" data-limit="{{$repeatables}}"/>
                    <x-forms.add-reduce-button type="reduce" data-row=".suffering-diseases-row"/>
                    <x-forms.hidden-counter class="suffering-diseases-rows" name="suffering_diseases_length"/>

                    @for ($i = 0; $i < $repeatables; $i++)
                        <div class="container suffering-diseases-row {{$i>0 ? 'd-none' : ''}}">
                            <div class="my-2">
                                <x-forms.magic-search class="magic-search ajax" value=''
                                                      hidden-id="suffering_diseases_id_d{{ $i }}" hidden-name="suffering_diseases_d[]" validationType="ajax" data-catalog-name="diseases"
                                                      placeholder="Ընտրել ախտորոշումը․․․"/>
                            </div>
                            <x-forms.text-field type="textarea" name="suffering_diseases_comment_d[]" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                                value="" label="" />

                        </div>
                    @endfor

                    <hr class="hr-dashed">

                    <strong>Վնասակար հիվանդությունները՝  </strong>
                    <table class="table" border="2">
                        <thead>
                        <tr>
                            <th>Ախտորոշում</th>
                            <th>գրառման</th>
                            <th>ջնջել</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($anestologia_e as $diagnos_exits_e)
                            <tr id="trashData{{$diagnos_exits_e->id}}">
                                <td>{{$diagnos_exits_e->disease_name->name ?? ' '}}</td>
                                <td>{{$diagnos_exits_e->surgeries_comment}}</td>
                                <td>
                                    <button class="btn btn-danger btn-sm clickTrash" type="button"
                                            onclick="clickTrash({{$diagnos_exits_e->id}})">
                                        <x-svg icon="cui-trash"/>
                                    </button>
                                </td>
                            </tr>
                        @endforeach


                        </tbody>
                    </table>
                    <x-forms.add-reduce-button type="add" data-row=".harmful-diseases-row" data-limit="{{$repeatables}}"/>
                    <x-forms.add-reduce-button type="reduce" data-row=".harmful-diseases-row"/>
                    <x-forms.hidden-counter class="harmful-diseases-rows" name="harmful_diseases_length"/>

                    @for ($i = 0; $i < $repeatables; $i++)
                        <div class="container harmful-diseases-row {{$i>0 ? 'd-none' : ''}}">
                            <div class="my-2">
                                <x-forms.magic-search class="magic-search ajax" value=''
                                                      hidden-id="harmful_diseases_id_e{{ $i }}" hidden-name="harmful_diseases_id_e[]" validationType="ajax" data-catalog-name="diseases"
                                                      placeholder="Ընտրել ախտորոշումը․․․"/>
                            </div>
                            <x-forms.text-field type="textarea" name="harmful_diseases_comment_e[]" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                                value="" label="" />

                        </div>
                    @endfor

                    <hr class="hr-dashed">

                    <strong>Հատուկ նշումներ՝ </strong>
                    <x-forms.text-field type="textarea" name="special_notes" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                        value="{{$apse->special_notes}}" label="" />

                    <hr class="hr-dashed">
<?php                  $asa_array = ['I','II','III','IV','V','E']; ?>
                    <strong>Հիվանդի վիճակը ըստ ASA` </strong>
                    <div class="my-8">

                       <select name="ASA" id="">
                           @foreach($asa_array as $k=>$asa)

                               <option {{$apse->ASA == ($k+1) ? 'selected' : '' }} value="{{$k+1}}">{{$asa}}</option>

                           @endforeach
                       </select>
                    </div>

                    <hr class="hr-dashed">

                    <strong>Անզգայացման մեթոդը՝ </strong>
                    <div class="my-2">
                        <x-forms.magic-search class="magic-search ajax" value='{{$apse->anesthesia_id}}' hidden-id="anesthesia_id"
                            hidden-name="anesthesia_id" data-catalog-name="anesthesias" placeholder="ընտրել վիրահատությունը․․․" />
                    </div>
                </li>

                <li class="list-group-item">
                    <strong>Հիվանդ/խնամակալ/ ազգական՝ </strong>
                    <x-forms.text-field type="textarea" name="patient_guardian_relative" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                        value="{{$apse->patient_guardian_relative}}" label="" />

                </li>

                <li class="list-group-item">
                    <div class="form-row align-items-center">
                            <strong>Բուժող բժիշկ՝</strong>
                            <x-forms.magic-search hidden-id="apse_attending_doctor_id" hidden-name="attending_doctor_id"
                            placeholder="Ընտրել բուժող բժիշկին․․․" class="magic-search ajax my-2" data-list-name="users"
                            value="{{$apse->attending_doctor_id}}" />
                    </div>
                </li>

                <li class="list-group-item list-group-item-secondary">
                    <button type="submit" class="btn btn-primary">Ուղարկել</button>
                </li>

            </ul>
        </div>
    </form>
</div>
@endsection

@section('javascript')
<script src="{{ mix('js/jquery.js') }}"></script>
<script src="{{ mix('js/all.magicsearch.js') }}"></script>
<script>
    function clickTrash(data) {
        let _token   = $('meta[name="csrf-token"]').attr('content');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '{{url('samples/trash/anesthesiologist/')}}'+'/'+data,
            type:"get",
            success: function (data) {
                $('#trashData'+data).remove()
            }
        });
    }
</script>

@endsection
