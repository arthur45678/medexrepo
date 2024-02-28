@extends('layouts.cardBase')

@section('css')
<link href="{{mix("/css/jquery.magicsearch.min.css")}}" rel="stylesheet" />
@endsection


@section('card-header')
@section('card-header-classes', '')

<div class="text-center">
    <h3>Հյուսվածքաբանական (բջջաբանական) հետազոտություն</h3>
</div>
@endsection


@section('card-content')

<div class="container">
    <form class="ajax-submitable" action="{{ route('samples.patients.histological-examination.store', ['patient'=> $patient]) }}" method="POST">
        @csrf
        <ul class="list-group">
                <li class="list-group-item">
                    <div class="form-row">
                        <div class="col-md-2">
                            <strong>Ամսաթիվ</strong>
                        </div>
                        <div class="col-md-10">
                            <x-forms.text-field name="admission_date" validation-type="ajax" type="date"
                            value="" label="" />
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Բաժանմունք՝</strong>
                    <div class="my-2">
                        <x-forms.magic-search class="magic-search ajax" value='' hidden-id="department_id"
                        hidden-name="departments" data-catalog-name="departments" placeholder="ընտրել բաժանմունքը․․․" />
                    </div>
                </li>


                <li class="list-group-item">
                        <strong>Ստացիոնար հիվանդի քարտ  № </strong>
                            <select name="stationare_number" id="stationare_id" class="form-control my-2">
                                @foreach($patient->stationaries()->get() as $item)
                                    <option value="{{ $item->number }}">{{ $item->number }}</option>
                                @endforeach
                            </select>
                </li>
                <li class="list-group-item">

                    <strong>Ամբուլատոր հիվանդի քարտ № </strong>
                        <select name="payment_type" id="ambulator_number" class="form-control my-2">
                                    <option value="{{ $patient->ambulator->number }}"></option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
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


            <li class="list-group-item">
                <strong>
                    <span class="badge badge-light mr-1">8.</span>
                    Կլնիկական ախտորոշումը`
                </strong>
                <x-forms.add-reduce-button type="add" data-row=".referring-row"/>
                <x-forms.add-reduce-button type="reduce" data-row=".referring-row"/>
                <x-forms.hidden-counter class="referring-rows" name="clinical_diagnosis_length"/>

                @for ($i = 0; $i < $repeatables; $i++)
                    <div class="container referring-row {{$i<old('clinical_diagnosis_length', 1) ?' ':'d-none'}}">
                        <div class="col-md-12 my-2">

                            <x-forms.magic-search  hidden-name="clinical_diagnosis[]"
                                                   hidden-id="clinical_diagnosis_{{$i}}"
                                                   placeholder="Ընտրել ախտորոշումը․․․"
                                                   class="magic-search ajax"
                                                   data-catalog-name="diseases" value='{{old("clinical_diagnosis.$i")}}'

                            />
                        </div>
                        <div class="col-md-12 my-2">
                            <textarea name="clinical_diagnosis_comment[]" class="form-control" placeholder="ազատ գրառման դաշտ․․․">{{old("clinical_diagnosis_comment.$i")}}</textarea>
                        </div>
                    </div>
                @endfor
            </li>


                <li class="list-group-item">
                    <div class="row">
                        <div class="col-md-4">
                            <strong>Բիոպսիա՝</strong>
                        </div>
                        <div class="col-md-8">
                            <x-forms.checkbox-radio pos="align" id="wheelchair-radio1" value="առաջնային" name="biopsy" label="առաջնային"/>
                            <x-forms.checkbox-radio pos="align" id="wheelchair-radio2" value="երկրորդական" name="biopsy" label="երկրորդական"/>
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
                        value="" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Կրկնակի բիոպսիայի ժամանակ նշել նախորդի ամսաթիվը</strong>
                        <div class="my-2">
                            <x-forms.text-field name="biopsy_dubble_date" validation-type="ajax" type="date"
                            value="" label="" />
                        </div>
                </li>
                <li class="list-group-item">
                    <strong>
                        Վիրահատության անվանումը
                    </strong>
                        <div class="my-2">
                            <x-forms.magic-search class="magic-search ajax" data-catalog-name="surgeries" value='{{old("surgery_id")}}' hidden-id="surgery_id"
                                hidden-name="surgery_id" placeholder="ընտրել վիրահատությունը․․․" />
                        </div>
                </li>
                <li class="list-group-item">
                    <strong>
                        Վիրահատության ամսաթիվը
                    </strong>
                        <div class="my-2">
                            <x-forms.text-field name="surgery_date" validation-type="ajax" type="date"
                            value="" label="" />
                        </div>
                </li>
                <li class="list-group-item">
                    <strong>Նյութի քանակը</strong>
                    <div class="my-2">
                    <x-forms.text-field type="textarea" name="substance_quantity" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                    value="" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Նմուշի քանակը</strong>
                    <div class="my-2">
                    <x-forms.text-field type="textarea" name="sample_quantity" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                    value="" label="" />
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
                            value="" label="" />
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Ախտորոշիչ բիոպսիա</strong>
                    <div class="my-2">
                    <x-forms.text-field type="textarea" name="biopsy_diagnostic" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                    value="" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Շտապ բիոպսիա</strong>
                    <div class="my-2">
                    <x-forms.text-field type="textarea" name="biopsy_fast" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                    value="" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Վիրահատական նյութ</strong>
                    <div class="my-2">
                    <x-forms.text-field type="textarea" name="surgery_material" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                    value="" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Ներկման եղանակաը</strong>
                    <div class="my-2">
                    <x-forms.text-field type="textarea" name="painting_method" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                    value="" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Մակրո և միկրո նկարագրություն</strong>
                    <div class="my-2">
                    <x-forms.text-field type="textarea" name="macro_and_micro_description" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                    value="" label="" />
                    </div>
                </li>



            <li class="list-group-item">
                <strong>
                    <span class="badge badge-light mr-1">8.</span>
                    Հյուսվածքաբանական եզրակացություն (ախտորոշում)՝
                </strong>
                <x-forms.add-reduce-button type="add" data-row=".histology_summary-row"/>
                <x-forms.add-reduce-button type="reduce" data-row=".histology_summary-row"/>
                <x-forms.hidden-counter class="histology_summary-rows" name="histology_summary_diagnosis_length"/>

                @for ($i = 0; $i < $repeatables; $i++)
                    <div class="container histology_summary-row {{$i<old('histology_summary_diagnosis_length', 1) ?' ':'d-none'}}">
                        <div class="col-md-12 my-2">

                            <x-forms.magic-search  hidden-name="histology_summary_diagnosis[]"
                                                   hidden-id="histology_summary_diagnosis_{{$i}}"
                                                   placeholder="Ընտրել ախտորոշումը․․․"
                                                   class="magic-search ajax"
                                                   data-catalog-name="diseases" value='{{old("histology_summary_diagnosis.$i")}}'

                            />
                        </div>
                        <div class="col-md-12 my-2">
                            <textarea name="histology_summary_diagnosis_comment[]" class="form-control" placeholder="ազատ գրառման դաշտ․․․">{{old("histology_summary_diagnosis_comment.$i")}}</textarea>
                        </div>
                    </div>
                @endfor
            </li>

                <li class="list-group-item">
                    <div class="form-row">
                        <div class="col-md-3">
                            <strong>Հետազոտման Ամսաթիվ</strong>
                        </div>
                        <div class="col-md-9">
                            <x-forms.text-field name="diagnosis_date" validation-type="ajax" type="date"
                            value="" label="" />
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                        <strong>Բուժող բժիշկ՝</strong>
                        <x-forms.magic-search hidden-id="attending_doctor_id" hidden-name="attending_doctor_id"
                        placeholder="Ընտրել բուժող բժիշկին․․․" class="magic-search ajax my-2" data-list-name="users"
                        value="" />
                        <strong>Պաթոլոգ՝</strong>
                        <x-forms.magic-search hidden-id="pathologist_doctor_id" hidden-name="pathologist_doctor_id"
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

<script>
    var repeatables = {{$repeatables}};
    $(document).ready(function () {

    });
</script>

@endsection
