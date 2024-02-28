@extends('layouts.cardBase')


@section('css')
    <link href="{{mix("/css/jquery.magicsearch.min.css")}}" rel="stylesheet"/>
@endsection


@section('card-header')
@section('card-header-classes', '')

<div class="text-center">
    <h3>ԷՔՍՊՐԵՍ ԼԱԲՈՐԱՏՈՐԻԱՆԵՐՈՒՄ ԿԻՐԱՌՎՈՂ ԲԺՇԿԱԿԱՆ ՁԵՎ</h3>
</div>
@endsection


@section('card-content')

    <div class="container">
        <form action="{{route('samples.patients.express-pattern.store',$patient->id)}}" method="POST">
            @csrf
            <ul class="list-group">
                <li class="list-group-item ">
                    <div class="form-row">
                        <div class="col-md-6">
                            <strong>
                                Ազգանուն, անուն, հայրանուն
                            </strong>
                            <ins class="ml-4">{{$patient->full_name}}</ins>
                            <input type="hidden" name="patient_id" value="{{$patient->id}}">
                            <input type="hidden" name="user_id" value="{{auth()->id()}}">
                        </div>
                        <div class="col-md-6">
                            <strong>
                                Տարիք
                            </strong>
                            <ins class="ml-4">{{$patient->birth_date}}</ins>
                        </div>
                    </div>
                </li>

                <li class="list-group-item">
                    <strong>Բաժանմունք՝</strong>
                    <div class="my-2">
                        <x-forms.magic-search class="magic-search ajax" value='' hidden-id="diseasis_id"
                                              hidden-name="department_id" data-catalog-name="departments"
                                              placeholder="ընտրել բաժանմունքը․․․"/>
                    </div>
                </li>
                @isset($parent_id)
                    <input type="hidden" value="{{$parent_id}}" name="parent_id">
                @endisset
                <li class="list-group-item">
                    <div class="mt-2">
                        <x-forms.text-field type="number" name="hospital_room_number" validation-type="ajax"
                                            placeholder="լրացման ազատ դաշտ․․․"
                                            value="{{old('hospital_room_number')}}" label="Պալատ"/>
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>
                        Ուղեգրող բժշկի անուն, ազգանուն
                    </strong>
                    <x-forms.magic-search hidden-id="ue_attending_doctor_id" hidden-name="attending_doctor_id"
                                          placeholder="Ընտրել բուժող բժիշկին․․․" class="magic-search ajax my-2"
                                          data-list-name="users"
                                          value=""/>
                </li>
                <li class="list-group-item">
                    <strong>Հիվանդության պատմագրի № </strong>


                    {{-- <div class="col-md-8"> --}}

                    @isset($all_stationary_id)
                        <select name="historian" id="historian" class="form-control my-2">
                            @foreach ($all_stationary_id  as $key)
                                <option value="{{$key}}">{{$key}}</option>
                            @endforeach
                        </select>
                        {{-- </div> --}}
                    @endisset

                    @error('historian')
                    <em class="error text-danger">Դաշտը պարտադիր է։</em>
                    @enderror
                </li>
                <li class="list-group-item">
                    <div class="form-row align-items-center">
                        <div class="col-md-4">
                            <strong>Ամսաթիվ , Ժամ</strong>
                        </div>
                        <div class="col-md-8">
                            <x-forms.text-field name="dateTime" validation-type="ajax" type="datetime-local"
                                                value="{{old('dateTime')}}" label="" validation-type="ajax"
                                                placeholder="լրացման ազատ դաշտ․․․"/>
                            @error('dateTime')
                            <em class="error text-danger">Դաշտը պարտադիր է։</em>
                            @enderror
                        </div>

                    </div>
                </li>
                <li class="list-group-item list-group-item-info">
                    <h4 class="text-center">
                        Արյան կլինիկական հետազոտություն
                    </h4>
                </li>
                <li class="list-group-item">
                    <strong>Հեմոգլոբին</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="hemoglobin" validation-type="ajax"
                                            placeholder="լրացման ազատ դաշտ․․․"
                                            value="" label=""/>
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Էրիթրոցիտներ</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="erythrocytes" validation-type="ajax"
                                            placeholder="լրացման ազատ դաշտ․․․"
                                            value="" label=""/>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="leukocytes" validation-type="ajax"
                                            placeholder="լրացման ազատ դաշտ․․․"
                                            value="" label="Լեյկոցիտներ"/>
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Հեմատոկրիտ</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="hematocrit" validation-type="ajax"
                                            placeholder="լրացման ազատ դաշտ․․․"
                                            value="" label=""/>
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Էրիթրոցիտների նստեցման արագություն (ԷՆԱ)</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="ena" validation-type="ajax"
                                            placeholder="լրացման ազատ դաշտ․․․"
                                            value="" label=""/>
                    </div>
                </li>
                <li class="list-group-item list-group-item-info">
                    <h4 class="text-center">
                        Արյան կենսաքիմիական հետազոտություն
                    </h4>
                </li>
                <li class="list-group-item">
                    <strong>Գլյուկոզ</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="glucose" validation-type="ajax"
                                            placeholder="լրացման ազատ դաշտ․․․"
                                            value="" label=""/>
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Միզանյութ</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="urine" validation-type="ajax"
                                            placeholder="լրացման ազատ դաշտ․․․"
                                            value="" label=""/>
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Պրոթրոմբին</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="prothrombin" validation-type="ajax"
                                            placeholder="լրացման ազատ դաշտ․․․"
                                            value="" label=""/>
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Բիլիռուբին</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="bilirubin" validation-type="ajax"
                                            placeholder="լրացման ազատ դաշտ․․․"
                                            value="" label=""/>
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>ՈՒղղակի</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="just" validation-type="ajax"
                                            placeholder="լրացման ազատ դաշտ․․․"
                                            value="" label=""/>
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Անուղղակի</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="indirect" validation-type="ajax"
                                            placeholder="լրացման ազատ դաշտ․․․"
                                            value="" label=""/>
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Մակարդելիության ժամանակ</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="coagulation" validation-type="ajax"
                                            placeholder="լրացման ազատ դաշտ․․․"
                                            value="" label=""/>
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Ընդհանուր սպիտակուց</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="common_protein" validation-type="ajax"
                                            placeholder="լրացման ազատ դաշտ․․․"
                                            value="" label=""/>
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Դիաստազ</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="diastasis" validation-type="ajax"
                                            placeholder="լրացման ազատ դաշտ․․․"
                                            value="" label=""/>
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Ամիլազ</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="amylase" validation-type="ajax"
                                            placeholder="լրացման ազատ դաշտ․․․"
                                            value="" label=""/>
                    </div>
                </li>
                <li class="list-group-item list-group-item-info">
                    <h4 class="text-center">
                        Մեզի հետազոտություն
                    </h4>
                </li>
                <li class="list-group-item">
                    <strong>Գույն</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="color" validation-type="ajax"
                                            placeholder="լրացման ազատ դաշտ․․․"
                                            value="" label=""/>
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Տեսակարար կշիռ</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="specific_weight" validation-type="ajax"
                                            placeholder="լրացման ազատ դաշտ․․․"
                                            value="" label=""/>
                    </div>
                </li>
                </li>
                <li class="list-group-item">
                    <strong>Սպիտակուց</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="protein" validation-type="ajax"
                                            placeholder="լրացման ազատ դաշտ․․․"
                                            value="" label=""/>
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Կետոնային մարմիններ</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="ketone_bodies" validation-type="ajax"
                                            placeholder="լրացման ազատ դաշտ․․․"
                                            value="" label=""/>
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Նստվածք</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="sediment" validation-type="ajax"
                                            placeholder="լրացման ազատ դաշտ․․․"
                                            value="" label=""/>
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>էրիթրոցիտներ</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="urine_erythrocytes" validation-type="ajax"
                                            placeholder="լրացման ազատ դաշտ․․․"
                                            value="" label=""/>
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Լեյկոցիտներ</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="urine_leukocytes" validation-type="ajax"
                                            placeholder="լրացման ազատ դաշտ․․․"
                                            value="" label=""/>
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>էպիթել</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="urine_epithelium" validation-type="ajax"
                                            placeholder="լրացման ազատ դաշտ․․․"
                                            value="" label=""/>
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Գլանակներ</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="urine_rollers" validation-type="ajax"
                                            placeholder="լրացման ազատ դաշտ․․․"
                                            value="" label=""/>
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Բյուրեղներ</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="urine_crystals" validation-type="ajax"
                                            placeholder="լրացման ազատ դաշտ․․․"
                                            value="" label=""/>
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Միկրոօրգանիզմներ</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="urine_microorganisms" validation-type="ajax"
                                            placeholder="լրացման ազատ դաշտ․․․"
                                            value="" label=""/>
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>
                        Հետազոտությունը իրականացնող բժշկի անուն, ազգանուն
                    </strong>
                    <x-forms.magic-search hidden-id="attending_doctor_id" hidden-name="urine_doctor"
                                          placeholder="Ընտրել բուժող բժիշկին․․․" class="magic-search ajax my-2"
                                          data-list-name="users"
                    />
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
