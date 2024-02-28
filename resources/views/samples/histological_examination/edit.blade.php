@extends('layouts.cardBase')

@section('css')
<link href="{{mix("/css/jquery.magicsearch.min.css")}}" rel="stylesheet" />
@endsection


@php


    $sm_histological_clinical_diagnosis = $user->sample_diagnoses_groupped[\App\Enums\Samples\SampleDiagnosesEnum::histological_clinical_diagnosis()->getValue()] ?? false;
    $sm_histological_summary_diagnosis = $user->sample_diagnoses_groupped[\App\Enums\Samples\SampleDiagnosesEnum::histological_summary_diagnosis()->getValue()] ?? false;

@endphp

@section('card-header')
@section('card-header-classes', '')

<div class="text-center">
    <h3>Հյուսվածքաբանական (բջջաբանական) հետազոտություն</h3>
</div>
@endsection


@section('card-content')

<div class="container">
    <form class="ajax-submitable" action="{{ route('samples.patients.histological-examination.update', ['patient'=> $patient, $post->id]) }}" method="POST">
        @csrf
        @method('put')

        <ul class="list-group">
                <li class="list-group-item">
                    <div class="form-row">
                        <div class="col-md-2">
                            <strong>Ամսաթիվ</strong>
                        </div>
                        <div class="col-md-10">
                            <x-forms.text-field name="admission_date" validation-type="ajax" type="date"
                            value="{{ $post->admission_date }}" label="" />
                        </div>
                    </div>
                </li>


                <li class="list-group-item">
                    <strong>Բաժանմունք՝</strong>
                    <div class="my-2">
                        <x-forms.magic-search class="magic-search ajax" value='{{ $post->department_id }}' hidden-id="department_id"
                        hidden-name="departments" data-catalog-name="departments" placeholder="ընտրել բաժանմունքը․․․" />
                    </div>
                </li>


                <li class="list-group-item">
                        <strong>Ստացիոնար հիվանդի քարտ  № </strong>
                            <select name="stationare_number" id="stationare_id" class="form-control my-2">
                                @foreach($patient->stationaries()->get() as $item)
                                    @if($post->stationare_number == $item->stationare_number)
                                        <option selected value="{{ $item->number }}">{{ $item->number }}</option>
                                    @else
                                        <option value="{{ $item->number }}">{{ $item->number }}</option>
                                    @endif

                                @endforeach
                            </select>
                </li>
                <li class="list-group-item">

                    <strong>Ամբուլատոր հիվանդի քարտ № </strong>
                        <select name="payment_type" id="ambulator_number" class="form-control my-2">
                                    <option value="{{ $patient->ambulator->number }}"></option>

                        </select>
                </li>
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-md-5">
                            <strong>Հիվանդի անուն,ազգանուն,հայրանուն</strong>
                        </div>
                        <ins class="ml-4">{{ $patient->getAllNamesAttribute() }}</ins>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-md-4">
                            <strong>Սեռ՝</strong>
                        </div>
                        <ins class="ml-4">{{ $patient->getSexAttribute() }}</ins>
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>
                        Տարիք
                    </strong>
                    <ins class="ml-4">{{ $patient->getAgeAttribute() }}</ins>
                </li>


            /*Test*/
            <li class="list-group-item">

                @if ($sm_histological_clinical_diagnosis)
                    <div class="collapse admission-diagnoses-collapse">
                        <strong>
                            <span class="badge badge-light mr-1">9.</span>
                            Կլնիկական ախտորոշումը`
                        </strong>
                        <x-forms.prev-posts-link href='{{route("patients.stationary.show", ["patient" => $patient,  $post->id])."#admission_diagnoses"}}' size='md' />

                    <button class="btn btn-primary float-right" type="button" data-toggle="collapse" data-target=".admission-diagnoses-collapse">
                        <x-svg icon="cui-pencil" />
                    </button>


                    @each('samples.histological_examination.includes.clinical_diagnosis', $sm_histological_clinical_diagnosis, 'item')
                </div>
                @endif

                <div class="collapse show admission-diagnoses-collapse">
                    <strong>
                        <span class="badge badge-light mr-1">9.</span>
                        Կլնիկական ախտորոշումը`
                    </strong>
                    <x-forms.prev-posts-link href='{{route("samples.patients.histological-examination.show", ["patient" => $patient,  $post->id])."#stationary_diagnosis_admission"}}' size='md' />

                    <x-forms.add-reduce-button type="add" data-row=".admission-row" />
                    <x-forms.add-reduce-button type="reduce" data-row=".admission-row" />
                    <x-forms.hidden-counter class="admission-rows" name="clinical_diagnosis_length" />

                    @if ($sm_histological_clinical_diagnosis)
                        <button class="btn btn-primary float-right" type="button" data-toggle="collapse" data-target=".admission-diagnoses-collapse">
                            <x-svg icon="cui-pencil" />
                        </button>
                    @endif

                    @for ($i = 0; $i < $repeatables; $i++)
                        <div class="container admission-row {{$i<old('clinical_diagnosis_length', 1)?' ':'d-none'}}">
                            <div class="col-md-12 my-2">
                                <x-forms.magic-search class="magic-search ajax" data-catalog-name="diseases" value='{{old("clinical_diagnosis.$i")}}'
                                    hidden-id="clinical_diagnosis_{{$i}}" hidden-name="clinical_diagnosis[]"
                                    placeholder="Ընտրել ախտորոշումը․․․" />
                            </div>
                            <div class="col-md-12 my-2">
                                <textarea name="clinical_diagnosis_comment[]" class="form-control"
                                    placeholder="ազատ գրառման դաշտ․․․">{{old("clinical_diagnosis_comment.$i")}}</textarea>
                            </div>
                        </div>
                    @endfor
                </div>
            </li>
            /*Testend*/


            @for ($j = 0; $j < $repeatables; $j++)
                <div class="referral-wrap-row {{$j < old("referral_wrap_length", 1) ?' ':'d-none'}}">

                    <li class="list-group-item">

                        <strong>
                            Կլնիկական ախտորոշումը`
                        </strong>

                        {{-- data-limit="{{$data_limit}}" --}}
                        <x-forms.prev-posts-link href='' size='md' />

                        <x-forms.add-reduce-button type="add" data-row=".service-wrap-ttt-{{$j}}-row" data-limit="{{$data_limit}}"/>
                        <x-forms.add-reduce-button type="reduce" data-row=".service-wrap-ttt-{{$j}}-row" />
                        <x-forms.hidden-counter class="service-wrap-ttt-{{$j}}-rows" name="service_wrap_length[]" />

                        @for ($i = 0; $i < $data_limit; $i++)
                            <div class="container service-wrap-ttt-{{$j}}-row {{$i < old("service_wrap_length.$j", 1) ?' ':'d-none'}}">
                                <strong>№ {{$i+1}} - Կլնիկական ախտորոշում</strong>

                                <x-forms.magic-search  hidden-name="clinical_diagnosis_id[{{$j}}][]"
                                                       hidden-id="clinical_diagnosis_id_{{$j}}_{{$i}}"
                                                       placeholder="Ընտրել ախտորոշումը․․․"
                                                       class="magic-search ajax"
                                                       data-catalog-name="diseases" value=''

                                />


                                <x-forms.text-field name="comment[{{$j}}][]" placeholder="լրացուցիչ տեղեկություն" type="textarea" />
                            </div>
                        @endfor

                    </li>
                    <hr class="hr-dashed">
                </div>
            @endfor

                <li class="list-group-item">
                    <div class="row">
                        <div class="col-md-4">
                            <strong>Բիոպսիա՝</strong>
                        </div>
                        <div class="col-md-8">
                            <x-forms.checkbox-radio pos="align" id="wheelchair-radio1" value="առաջնային" name="biopsy" label="առաջնային" {{ $post->biopsy == "առաջնային" ? "checked" : ""}}/>
                            <x-forms.checkbox-radio pos="align" id="wheelchair-radio2" value="երկրորդական" name="biopsy" label="երկրորդական" {{ $post->biopsy == "երկրորդական" ? "checked" : ""}}/>
                            @error('by_wheelchair')
                                <em class="error text-danger"></em>
                            @enderror
                        </div>
                    </div>
                </li>

                <li class="list-group-item">
                    <strong>Կրկնակի բիոպսիայի ժամանակ նշել նախորդի համարը №</strong>
                    <div class="my-2">
                        <x-forms.text-field type="textarea" min="0" name="biopsy_dubble" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                        value="{{ $post->biopsy_dubble }}" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Կրկնակի բիոպսիայի ժամանակ նշել նախորդի ամսաթիվը</strong>
                        <div class="my-2">
                            <x-forms.text-field name="biopsy_dubble_date" validation-type="ajax" type="date"
                            value="{{ $post->biopsy_dubble_date }}" label="" />
                        </div>
                </li>
                <li class="list-group-item">
                    <strong>
                        Վիրահատության անվանումը
                    </strong>
                        <div class="my-2">
                            <x-forms.magic-search class="magic-search ajax" data-catalog-name="surgeries" value='{{ $post->surgery_id }}' hidden-id="surgery_id"
                                hidden-name="surgery_id" placeholder="ընտրել վիրահատությունը․․․" />
                        </div>
                </li>
                <li class="list-group-item">
                    <strong>
                        Վիրահատության ամսաթիվը
                    </strong>
                        <div class="my-2">
                            <x-forms.text-field name="surgery_date" validation-type="ajax" type="date"
                            value="{{ $post->surgery_date }}" label="" />
                        </div>
                </li>
                <li class="list-group-item">
                    <strong>Նյութի քանակը</strong>
                    <div class="my-2">
                    <x-forms.text-field type="textarea" name="substance_quantity" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                    value="{{ $post->substance_quantity }}" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Նմուշի քանակը</strong>
                    <div class="my-2">
                    <x-forms.text-field type="textarea" name="sample_quantity" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                    value="{{ $post->sample_quantity }}" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="form-row align-items-center">
                            <strong>ՀՅՈՒՍՎԱԾՔԱԲԱՆԱԿԱՆ ՀԵՏԱԶՈՏՈՒԹՅՈՒՆ № </strong>
                            <ins class="ml-4">1</ins>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="form-row">
                        <div class="col-md-2">
                            <strong>Ամսաթիվ</strong>
                        </div>
                        <div class="col-md-10">
                            <x-forms.text-field name="examination_date" validation-type="ajax" type="date"
                            value="{{ $post->examination_date }}" label="" />
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Ախտորոշիչ բիոպսիա</strong>
                    <div class="my-2">
                    <x-forms.text-field type="textarea" name="biopsy_diagnostic" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                    value="{{ $post->biopsy_diagnostic }}" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Շտապ բիոպսիա</strong>
                    <div class="my-2">
                    <x-forms.text-field type="textarea" name="biopsy_fast" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                    value="{{ $post->biopsy_fast }}" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Վիրահատական նյութ</strong>
                    <div class="my-2">
                    <x-forms.text-field type="textarea" name="surgery_material" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                    value="{{ $post->surgery_material }}" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Ներկման եղանակաը</strong>
                    <div class="my-2">
                    <x-forms.text-field type="textarea" name="painting_method" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                    value="{{ $post->painting_method }}" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Մակրո և միկրո նկարագրություն</strong>
                    <div class="my-2">
                    <x-forms.text-field type="textarea" name="macro_and_micro_description" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                    value="{{ $post->macro_and_micro_description }}" label="" />
                    </div>
                </li>


            @for ($j = 0; $j < $repeatables; $j++)
                <div class="referral-wrap-row {{$j < old("referral_wrap_length", 1) ?' ':'d-none'}}">

                    <li class="list-group-item">

                        <strong>
                            Հյուսվածքաբանական եզրակացություն (ախտորոշում)՝
                        </strong>

                        {{-- data-limit="{{$data_limit}}" --}}
                        <x-forms.prev-posts-link href='' size='md' />

                        <x-forms.add-reduce-button type="add" data-row=".histologyc-wrap-{{$j}}-row" data-limit="{{$data_limit}}"/>
                        <x-forms.add-reduce-button type="reduce" data-row=".histologyc-wrap-{{$j}}-row" />
                        <x-forms.hidden-counter class="histologyc-wrap-{{$j}}-rows" name="service_wrap_length[]" />

                        <button class="btn btn-primary float-right" type="button" data-toggle="collapse" data-target=".referring-institutuion-diagnosis">
                            <x-svg icon="cui-pencil" />
                        </button>

                        @for ($i = 0; $i < $data_limit; $i++)
                            <div class="container histologyc-wrap-{{$j}}-row {{$i < old("service_wrap_length.$j", 1) ?' ':'d-none'}}">
                                <strong>№ {{$i+1}} - Հյուսվածքաբանական եզրակացություն (ախտորոշում)՝</strong>

                                <x-forms.magic-search  hidden-name="histology_diagnosis_id[{{$j}}][]"
                                                       hidden-id="histology_diagnosis_id_{{$j}}_{{$i}}"
                                                       placeholder="Ընտրել ախտորոշումը․․․"
                                                       class="magic-search ajax"
                                                       data-catalog-name="diseases" value=''

                                />


                                <x-forms.text-field name="comment[{{$j}}][]" placeholder="լրացուցիչ տեղեկություն" type="textarea" />
                            </div>
                        @endfor

                    </li>
                    <hr class="hr-dashed">
                </div>
            @endfor

                <li class="list-group-item">
                    <div class="form-row">
                        <div class="col-md-3">
                            <strong>Հետազոտման Ամսաթիվ</strong>
                        </div>
                        <div class="col-md-9">
                            <x-forms.text-field name="diagnosis_date" validation-type="ajax" type="date"
                            value="{{ $post->diagnosis_date }}" label="" />
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                        <strong>Բուժող բժիշկ՝</strong>
                        <x-forms.magic-search hidden-id="attending_doctor_id" hidden-name="attending_doctor_id"
                        placeholder="Ընտրել բուժող բժիշկին․․․" class="magic-search ajax my-2" data-list-name="users"
                        value="{{ $post->attending_doctor_id }}" />
                        <strong>Պաթոլոգ՝</strong>
                        <x-forms.magic-search hidden-id="pathologist_doctor_id" hidden-name="pathologist_doctor_id"
                        placeholder="Ընտրել բուժող բժիշկին․․․" class="magic-search ajax my-2" data-list-name="users"
                        value="{{ $post->pathologist_doctor_id }}" />
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
