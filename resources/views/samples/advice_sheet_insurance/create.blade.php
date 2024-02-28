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
    <form {{--class="ajax-submitable"--}} action="{{ route('samples.patients.advice-sheet-insurance.store', ['patient'=> $patient]) }}" method="POST">
        @csrf
        <ul class="list-group">
                <li class="list-group-item">
                    <div class="form-row align-items-center">
                        <div class="col-md-4">
                            <strong>Ամսաթիվ</strong>
                        </div>
                        <div class="col-md-8">
                            <x-forms.text-field name="admission_date" type="date"  validation-type="ajax" value="" label=""/>
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
                        value="" label="Գանգատներ" />
                    </div>
                </li>
                <li class="list-group-item">
                    <div>
                        <x-forms.text-field type="textarea" name="research_done" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="" label="Կատարված հետազոտություն" />
                    </div>
                </li>

                <li class="list-group-item">
                <strong>Ախտորոշում</strong>
                <x-forms.add-reduce-button type="add" data-row=".sample_diagnoses-row"/>
                <x-forms.add-reduce-button type="reduce" data-row=".sample_diagnoses-row"/>
                <x-forms.hidden-counter class="sample_diagnoses-rows" name="sample_diagnoses_length"/>

                @for ($i = 0; $i < $repeatables; $i++)
                    <div class="container sample_diagnoses-row {{$i<old('sample_diagnoses_length', 1) ?' ':'d-none'}}">
                        <div class="col-md-12 my-2">
                            <div class="my-2">
                                <x-forms.magic-search
                                    class="magic-search ajax"
                                    value='{{old("sample_diagnoses.$i")}}'
                                    hidden-id="sample_diagnoses_{{$i}}"

                                    hidden-name="sample_diagnoses[]"
                                    data-catalog-name="diseases"
                                    placeholder="Ընտրել ախտորոշումը․․"
                                />
                            </div>

                        </div>
                        <div class="col-md-12 my-2">
                            <textarea name="sample_diagnoses_comment[]" class="form-control" placeholder="ազատ գրառման դաշտ․․․">{{old("sample_diagnoses_comment.$i")}}</textarea>
                        </div>
                    </div>
                @endfor
            </li>

                <li class="list-group-item">
                    <div>
                        <x-forms.text-field hidden-id="advice_inshurans_sheet_doctors_{{$i}}" type="textarea" name="advice_inshurans_sheet_doctors[]"
                                            validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{old("advice_inshurans_sheet_doctors.$i")}}" label="Վիրահատության ցուցումներ" />
                    </div>
                </li>
                <li class="list-group-item">
                    <div>
                        <x-forms.text-field type="textarea" name="volume_of_surgery" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="" label="Վիրահատության ծավալ" />
                    </div>
                </li>

            <li class="list-group-item">
                <strong>Բաժանմունք/Բժիշկ</strong>
                <x-forms.add-reduce-button type="add" data-row=".advice_inshurans_sheet_doctors-row"/>
                <x-forms.add-reduce-button type="reduce" data-row=".advice_inshurans_sheet_doctors-row"/>
                <x-forms.hidden-counter class="advice_inshurans_sheet_doctors-rows" name="advice_inshurans_sheet_doctors_length"/>

                @for ($i = 0; $i < $repeatables; $i++)
                    <div class="container advice_inshurans_sheet_doctors-row {{$i<old('advice_inshurans_sheet_doctors_length', 1) ?' ':'d-none'}}">
                        <div class="col-md-12 my-2">
                            <div class="my-2">
                                <x-forms.magic-search hidden-id="advice_inshurans_sheet_doctor_id_{{$i}}" hidden-name="adv[attending_doctor_id][]"
                                                      placeholder="Ընտրել․" class="magic-search ajax my-2" data-list-name="users"
                                                      value="" />
                            </div>

                        </div>
                        <div class="col-md-12 my-2">
                            <textarea name="adv[doctors_comment][]" class="form-control" placeholder="ազատ գրառման դաշտ․․․">{{old("advice_inshurans_sheet_doctors_comment.$i")}}</textarea>
                        </div>
                    </div>
                @endfor
            </li>


                <li class="list-group-item">
                        <strong>Տնօրեն</strong>
                        <x-forms.magic-search hidden-id="department_head_id" hidden-name="department_head_id"
                        placeholder="Ընտրել․" class="magic-search ajax my-2" data-list-name="users"
                        value="" />
                </li>

            <li class="list-group-item">
                <strong>Բուժող բժիշկ</strong>
                <x-forms.magic-search hidden-id="attending_doctor_id" hidden-name="attending_doctor_id"
                                      placeholder="Ընտրել․" class="magic-search ajax my-2" data-list-name="users"
                                      value="{{auth()->id()}}" />
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
