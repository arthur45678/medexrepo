@extends('layouts.cardBase')

@section('css')
<link href="{{mix("/css/jquery.magicsearch.min.css")}}" rel="stylesheet" />
<link href="{{mix("/css/tail.select-default.css")}}" rel="stylesheet" />
@endsection


@section('card-header')
@section('card-header-classes', '')


<div class="text-center">
    <h5>Ստացիոնար հիվանդի</h5>
    <h3>Բժշկական քարտ № <span>{{$current_number}}</span></h3>
</div>
@endsection


@section('card-content')
<div class="container">
    <form action="{{route('patients.stationary.store', ["patient" => $patient])}}" method="POST">
    @csrf
    <input type="hidden" name="number" value="{{$current_number}}">
    <button type="button" class="btn btn-lg btn-primary" style="position: fixed; bottom:20px; right:20px; z-index: 10">
        <x-svg icon="cui-file" />
    </button>

    <div class="container bg-light text-center"><!-- histography start -->
        <div class="card">
            <div class="card-body">

                <ul class="list-group">
                    <li class="list-group-item">
                        <div class="form-row align-items-center">
                            <div class="col-md-4">
                                <strong>
                                    Սոցիալական խումբ՝
                                </strong>
                            </div>
                            <div class="col-md-8">
                                <x-forms.magic-search class="magic-search ajax my-2" data-catalog-name="social_packages"
                                hidden-id="social_package_id" hidden-name="social_package_id" autocomplete="off"
                                placeholder="Ընտրել սոցիալական խումբը․․․" />
                            </div>
                        </div>
                    </li>
                </ul>
                <hr class="hr-dashed">

                <h5>Հիվանդության պատմագիր № {{$current_number}}</h5>
                <hr class="hr-dashed">
                <ul class="list-group">
                    <li class="list-group-item">
                        <strong>
                            Հիմնական հիվանդության ախտորոշումը՝ <small>գրվում է դուրս գրումից հետո</small>
                        </strong>
                        <div class="container">
                            <div class="col-md-12 my-2">
                                <x-forms.magic-search class="diagnoses-search" value='{{old("primary_disease_diagnosis_id")}}'
                                hidden-id="primary_disease_diagnosis_id" hidden-name="primary_disease_diagnosis_id"
                                placeholder="Ընտրել ախտորոշումը․․․"/>
                                {{-- <div class="react-select-container" data-name="primary_disease_diagnosis_id" data-old-value="{{old('primary_disease_diagnosis_id')}}"></div> --}}
                            </div>
                            <div class="col-md-12 my-2">
                                <textarea name="primary_disease_diagnosis_comment" class="form-control" placeholder="ազատ գրառման դաշտ․․․">{{old('primary_disease_diagnosis_comment')}}</textarea>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="container">
                            <div class="align-items-center">
                                <div class="col-md-12">
                                    <strong>Փուլը՝</strong>
                                    <select name="stage" class="form-control with-search">
                                        <option value="">Ընտրել փուլը․․․</option>
                                        @foreach ($stage_list as $item)
                                            <option value="{{$item['name']}}"
                                            @if (old('stage')===$item['name'])
                                                selected='selected'
                                            @endif
                                            >{{$item['name']}}</option>
                                        @endforeach
                                    </select>
                                    @error('stage')
                                        <em class="error text-danger">{{$message}}</em>
                                    @enderror
                                </div>
                                {{-- <div class="col-md-12">
                                    <strong>TNM</strong>
                                    <em>T - (0,1,2,3,4)</em>
                                    <em>N - (0,1,2,3,x)</em>
                                    <em>M - (0,1,x)</em>
                                    <x-forms.text-field name="tnm" class="mr-1" maxlength="3" label="" />
                                </div> --}}
                            </div>

                            <div class="form-row mt-2 px-3">
                                <div class="col-md-4">
                                    <x-forms.select label="T" select-name='T' :options='$tCollectionJson'
                                    validation-type='session' />
                                </div>
                                <div class="col-md-4">
                                    <x-forms.select label="N" select-name='N' :options='$nCollectionJson'
                                    validation-type='session' />
                                </div>
                                <div class="col-md-4">
                                    <x-forms.select label="M" select-name='M' :options='$mCollectionJson'
                                    validation-type='session' />
                                </div>
                            </div>

                            <div class="form-row mt-2 px-3">
                                <div class="col-md-4">
                                    <x-forms.select label="Grade" select-name='Grade' :options='$gradeCollectionJson'
                                    validation-type='session' />
                                </div>
                                <div class="col-md-4">
                                    <x-forms.select label="L" select-name='L' :options='$lCollectionJson'
                                    validation-type='session' />
                                </div>
                                <div class="col-md-4">
                                    <x-forms.select label="V" select-name='V' :options='$vCollectionJson'
                                    validation-type='session' />
                                </div>
                            </div>

                            <div class="form-row mt-2 px-3">
                                <div class="col-md-4">
                                    <x-forms.select label="Ուռուցքի դասակարգում" select-name='pycmr' :options='$pycmrCollectionJson'
                                    validation-type='session' />
                                </div>
                            </div>

                        </div>
                    </li>

                    <li class="list-group-item">
                        <div class="form-row align-items-center justify-content-center">
                            <div class="col-md-3">
                                <strong>Արյան խումբ՝</strong>
                            </div>
                            <div class="col-md-3">
                                @if ($patient->blood_group) <em>{{$patient->blood_group}}</em>
                                @else <em>--/--</em> @endif
                            </div>
                        </div>
                        <div class="form-row align-items-center justify-content-center">
                            <div class="col-md-3">
                                <strong>Rh-գործոն՝</strong>
                            </div>
                            <div class="col-md-3">
                                @if ($patient->rh_factor_sign) <em class="h5">{{$patient->rh_factor_sign}}</em>
                                @else <em>--/--</em> @endif
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="form-row align-items-center justify-content-center">
                            <div class="col-md-3">
                                <strong>Բուժող բժիշկ՝</strong>
                            </div>
                            <div class="col-md-3">
                                <em>_____________</em>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div><!-- histography end -->
    <hr>

    <ul class="list-group">
        <li class="list-group-item">
            <div class="form-row align-items-center">
                <div class="col-md-4">
                    <strong>Ընդունման ամսաթիվը և ժամը՝<span class="text-danger">*</span></strong>
                </div>
                <div class="col-md-8">
                    <x-forms.text-field name="admission_date" type="datetime-local" value="{{old('admission_date')}}" label=""/>
                </div>
            </div>
            <hr class="hr-dashed">
            <div class="form-row align-items-center">
                <div class="col-md-4">
                    <strong>Դուրս գրման ամսաթիվը և ժամը՝</strong>
                </div>
                <div class="col-md-8">
                    <x-forms.text-field name="discharge_date" type="datetime-local" value="{{old('discharge_date')}}" label=""/>
                </div>
            </div>
        </li>
        <li class="list-group-item">
            <div class="form-row align-items-center">
                <div class="col-md-4">
                    <strong>Հասակը՝</strong>
                </div>
                <div class="col-md-8">
                    <div class="input-group align-items-center">
                        <x-forms.text-field  max="250" type="number"  class="col-4" name="height" id="height" value="{{old('height')}}" min="1" label=""/>
                        <label class="ml-2" for="height"><strong>սմ․</strong></label>
                    </div>
                </div>
            </div>
            <hr class="hr-dashed">
            <div class="form-row align-items-center">
                <div class="col-md-4">
                    <strong>Քաշը՝</strong>
                </div>
                <div class="col-md-8">
                    <div class="input-group align-items-center">
                        <x-forms.text-field max="300" type="number" class="col-4" name="weight" id="weight" value="{{old('weight')}}" min="1" label=""/>
                        <label class="ml-2" for="weight"><strong>կգ․</strong></label>
                    </div>
                </div>
            </div>
        </li>
        <li class="list-group-item">
            <div class="form-row align-items-center">
                <div class="col-md-4">
                    <strong>Բաժանմունք՝</strong>
                </div>
                <div class="col-md-8">
                    <input id="departments-search" class="form-control" placeholder="ընտրել բաժանմունքը" data-id="{{old('department_id')}}" style="max-width: 100%" autocomplete="off">
                    <x-forms.text-field id="department_id" type="hidden" name="department_id"  value="{{old('department_id')}}" label=""/>
                </div>
            </div>
            <hr class="hr-dashed">
            <div class="form-row align-items-center">
                <div class="col-md-6">
                    <strong>հիվանդասենյակ՝</strong>
                    <input id="rooms-search" class="form-control" placeholder="ընտրել հիվանդասենյակը" data-id="{{old('chamber_id')}}" style="max-width: 100%" autocomplete="off">
                    <x-forms.text-field id="chamber_id" type="hidden" name="chamber_id"  value="{{old('chamber_id')}}" label=""/>
                </div>
                <div class="col-md-6">
                    <strong>հիվանդասենյակի տիպը՝</strong>
                    <select class="form-control" name="is_paid"><!--վճարովի-անվճար -->
                        <option value="0" {{old('is_paid') === "0" ? 'selected' : ''}}>անվճար</option>
                        <option value="1" {{old('is_paid') === "1" ? 'selected' : ''}}>վճարովի</option>
                    </select>
                    @error('is_paid')
                        <em class="error text-danger">{{$message}}</em>
                    @enderror
                </div>
            </div>
            <hr class="hr-dashed">
            <div class="form-row align-items-center">
                <div class="col-md-6">
                    <strong>Մահճակալ՝</strong>
                    <input id="beds-search" class="form-control" placeholder="ընտրել մահճակալը․․․" data-id="{{old('bed_id')}}" style="max-width: 100%" autocomplete="off">
                    <x-forms.text-field id="bed_id" type="hidden" name="bed_id"  value="{{old('bed_id')}}" label=""/>
                </div>
                <div class="col-md-6">
                    <strong>օրերի քանակ՝</strong>
                    <x-forms.text-field max="365" type="number" name="days_qty"  value="{{old('days_qty')}}" min="0" label=""/>
                </div>
            </div>
        </li>
        <li class="list-group-item">
            <div class="row">
                <div class="col-md-4">
                    <strong>Տեղափոխման ձևը՝</strong>
                </div>
                <div class="col-md-8">
                    <x-forms.checkbox-radio pos="align" id="wheelchair-radio1" value="1" name="by_wheelchair" label="հիվանդասայլակով"/>
                    <x-forms.checkbox-radio pos="align" id="wheelchair-radio2" value="0" name="by_wheelchair" label="կարող է քայլել"/>
                    @error('by_wheelchair')
                        <em class="error text-danger">{{$message}}</em>
                    @enderror
                </div>
            </div>
        </li>
        <li class="list-group-item">
            <strong>Դեղանյութերի կողմնակի ազդեցությունը (անտանելիությունը)՝</strong>
            <x-forms.add-reduce-button type="add" data-row=".side-effect-medicine-row"/>
            <x-forms.add-reduce-button type="reduce" data-row=".side-effect-medicine-row"/>
            <x-forms.hidden-counter class="side-effect-medicine-rows" name="side_effect_medicine_length"/>

            @for ($i = 0; $i < $repeatables; $i++)
                <div class="container side-effect-medicine-row {{$i < old('side_effect_medicine_length', 1) ?' ':'d-none'}}">
                    <div class="col-md-12 my-2">
                        <input class="medicines-search form-control" data-hidden="#side_effect_medicine_{{$i}}" data-id='{{old("side_effect_medicine_id.$i")}}' style="min-width: 100%" placeholder="ընտրել դեղամիջոցը․․․">
                        <x-forms.text-field type="hidden" id="side_effect_medicine_{{$i}}" name="side_effect_medicine_id[]"  value='{{old("side_effect_medicine_id.$i")}}' label=""/>
                    </div>
                    <div class="col-md-12 my-2">
                        <textarea name="side_effect_medicine_comment[]" class="form-control" placeholder="ազատ գրառման դաշտ․․․">{{old("side_effect_medicine_comment.$i")}}</textarea>
                    </div>
                </div>
            @endfor
        </li>
    </ul>

    <hr class="my-4">

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
                <span class="badge badge-light mr-1">2.</span>
                Սեռը՝
            </strong>
            <ins class="ml-4">{{$patient->sex}}</ins>
        </li>
        <li class="list-group-item">
            <strong>
                <span class="badge badge-light mr-1">3.</span>
                Տարիք՝
            </strong>
            <ins class="ml-4"> ծննդյան թիվ՝ {{$patient->birth_date_reversed}}</ins>
            <div class="input-group my-2">
                <div class="input-group-prepend">
                    <select class="custom-select" id="age_type" name="age_type">
                        @foreach ($age_type_enums as $age_type)
                            <option value="{{$age_type}}" {{old('age_type') === $age_type?'selected':''}}>
                                {{__("enums.stationary_age_type_enum.$age_type")}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <x-forms.text-field type="number" class="col-md-2" name="age"  value="{{old('age')}}" min="1" max="200" label=""/>
            </div>
            @error('age_type')
                <div><em class="error text-danger">{{$message}}</em></div>
            @enderror
            <em class="ml-2">*լրիվ տարիք, մինչև 1 տ․ երեխաների մոտ՝ ամիսներ, մինչև 1 ամս. երեխաների մոտ՝ օրեր:</em>
        </li>

        <li class="list-group-item">
            <strong>
                <span class="badge badge-light mr-1">4.</span>
                Մշտական բնակավայրը՝ քաղաք, գյուղ
            </strong>
            <ins class="ml-4">{{$patient->residence_region}}, {{$patient->town_village}}, {{$patient->street_house}}:</ins>
            <hr class="hr-dashed">
            <strong>
                <span class="badge badge-light mr-1">4.1</span>
                Հեռախոսահամար՝
            </strong>
            <ins class="ml-4">{{$patient->c_phone}}, {{$patient->m_phone}}:</ins>
        </li>

        <li class="list-group-item">
            <div class="form-row align-items-center">
                <div class="col-md-6">
                    <strong>
                        <span class="badge badge-light mr-1">5.</span>
                        Աշխատավայրը՝
                    </strong>
                    @if (!$patient->workplace)
                        <ins class="ml-4 d-block">{{$patient->workplace}}</ins>
                    @else
                        <x-forms.text-field type="text" class="mt-1" name="workplace" value="{{old('workplace')}}" label=""/>
                    @endif
                </div>
                <div class="col-md-6">
                    <strong>
                        <span class="badge badge-light mr-1">5.1</span>
                        Մասնագիտությունը կամ պաշտոնը՝
                    </strong>
                    @if (!$patient->profession)
                        <ins class="ml-4 d-block">{{$patient->profession}}</ins>
                    @else
                        <x-forms.text-field type="text" class="mt-1" name="profession" value="{{old('profession')}}" label=""/>
                    @endif
                </div>
            </div>
        </li>

        <li class="list-group-item">
            <div class="row">
                <div class="col-md-4">
                    <strong>
                        <span class="badge badge-light mr-1">6.</span>
                        Ում կողմից է ուղարկված հիվանդը՝
                    </strong>
                </div>
                <div class="col-md-8">
                    <input id="clinics-search" class="form-control" placeholder="Ընտրել համապատասխան հիվանդանոցը" data-id="{{old('from_clinic_id')}}">
                    <x-forms.text-field type="hidden" id="from_clinic_id" name="from_clinic_id" value="{{old('from_clinic_id')}}" label="" />
                </div>
            </div>
        </li>

        <li class="list-group-item">
            <div class="row">
                <div class="col-md-7">
                    <strong>
                        <span class="badge badge-light mr-1">7.</span>
                        Ստացիոնար է տեղափոխվել անհետաձգելի ցուցումներով՝
                    </strong>
                </div>
                <div class="col-md-3">
                    <x-forms.checkbox-radio pos="align" id="urgent-radio1" value="1" name="is_urgent" label="Այո"/>
                    <x-forms.checkbox-radio pos="align" id="urgent-radio2" value="0" name="is_urgent" label="Ոչ"/>
                    @error('is_urgent')
                    <em class="error text-danger">{{$message}}</em>
                    @enderror
                </div>
            </div>

            <hr class="hr-dashed">
            <div class="row">
                <div class="col-md-7">
                    <strong>
                        <span class="badge badge-light mr-1">7.1</span>
                        Հիվանդության սկզբից՝
                    </strong>
                </div>
                <div class="col-md-3">
                    <x-forms.checkbox-radio pos="align" id="fds-radio1" value="1" name="from_disease_start" label="Այո"/>
                    <x-forms.checkbox-radio pos="align" id="fds-radio2" value="0" name="from_disease_start" label="Ոչ"/>
                    @error('from_disease_start')
                    <em class="error text-danger">{{$message}}</em>
                    @enderror
                </div>
            </div>

            <hr class="hr-dashed">
            <div class="form-row align-items-center">
                <strong>
                    <span class="badge badge-light mx-1">7.2</span>
                    Վնասվածք ստանալուց
                </strong>
                <x-forms.text-field type="number" class="col-sm-2 ml-2" name="hours_later" value="{{old('hours_later')}}" min="1" max="1000" label=""/>
                <strong class="ml-2">ժամ անց,</strong>
            </div>



            <hr class="hr-dashed">
            <div class="row">
                <div class="col-md-7">
                    <strong>
                        <span class="badge badge-light mr-1">7.3</span>
                        Հոսպիտալացվել է պլանային կարգով՝
                    </strong>
                </div>
                <div class="col-md-3">
                    <x-forms.checkbox-radio pos="align" id="planned-radio1" value="1" name="is_planned" label="Այո"/>
                    <x-forms.checkbox-radio pos="align" id="planned-radio2" value="0" name="is_planned" label="Ոչ"/>
                    @error('is_planned')
                    <em class="error text-danger">{{$message}}</em>
                    @enderror
                </div>
            </div>
        </li>
        <li class="list-group-item">
            <strong>
                <span class="badge badge-light mr-1">8.</span>
                Ուղեգրող հաստատության ախտորոշումը՝
            </strong>
            <x-forms.add-reduce-button type="add" data-row=".referring-row"/>
            <x-forms.add-reduce-button type="reduce" data-row=".referring-row"/>
            <x-forms.hidden-counter class="referring-rows" name="referring_diagnosis_length"/>

            @for ($i = 0; $i < $repeatables; $i++)
            <div class="container referring-row {{$i<old('referring_diagnosis_length', 1) ?' ':'d-none'}}">
                <div class="col-md-12 my-2">
                    <x-forms.magic-search class="diagnoses-search" value='{{old("referring_diagnosis.$i")}}'
                    hidden-id="referring_diagnosis_{{$i}}" hidden-name="referring_diagnosis[]"
                    placeholder="Ընտրել ախտորոշումը․․․"/>
                </div>
                <div class="col-md-12 my-2">
                    <textarea name="referring_diagnosis_comment[]" class="form-control" placeholder="ազատ գրառման դաշտ․․․">{{old("referring_diagnosis_comment.$i")}}</textarea>
                </div>
            </div>
            @endfor
        </li>
        <li class="list-group-item">
            <strong>
                <span class="badge badge-light mr-1">9.</span>
                Ախտորոշումն ընդունվելիս՝
            </strong>
            <x-forms.add-reduce-button type="add" data-row=".admission-row"/>
            <x-forms.add-reduce-button type="reduce" data-row=".admission-row"/>
            <x-forms.hidden-counter class="admission-rows" name="admission_diagnosis_length"/>

            @for ($i = 0; $i < $repeatables; $i++)
                <div class="container admission-row {{$i<old('admission_diagnosis_length', 1)?' ':'d-none'}}">
                    <div class="col-md-12 my-2">
                        <x-forms.magic-search class="diagnoses-search" value='{{old("admission_diagnosis.$i")}}'
                        hidden-id="admission_diagnosis_{{$i}}" hidden-name="admission_diagnosis[]"
                        placeholder="Ընտրել ախտորոշումը․․․"/>
                    </div>
                    <div class="col-md-12 my-2">
                        <textarea name="admission_diagnosis_comment[]" class="form-control" placeholder="ազատ գրառման դաշտ․․․">{{old("admission_diagnosis_comment.$i")}}</textarea>
                    </div>
                </div>
            @endfor
        </li>

        <li class="list-group-item">
            <button type="submit" class="btn btn-primary">Բացել քարտը</button>
        </li>
    </ol>

</form>
</div>
@endsection

@section('javascript')
<script src="{{ mix('js/jquery.js') }}"></script>
<script src="{{ mix('js/all.magicsearch.js') }}"></script>
<script src="{{ mix('/js/components/Select.js') }}"></script>
<script src="{{mix('/js/select-pure.js')}}"></script>
<script>
    var repeatables = {{$repeatables}};
    var departments = {!! json_encode($departments) !!};
    var chambers = {!! json_encode($chambers) !!};
    var beds = {!! json_encode($beds) !!};
    var diseases = {!! json_encode($diseases) !!}
    var medicines = {!! json_encode($medicines) !!}

    $(document).ready(function() {

        $('.diagnoses-search').magicsearch(
            window.medexMagicSearch.assignConfigs({
                dataSource: diseases, // "/catalogs/diseases.json",
                fields: ["name", "code"],
                id: "id",
                format: "%code% %name%",
                success: function($input, data) {
                    const hidden_input_id = $input.data('hidden');
                    $(hidden_input_id).val($input.attr("data-id"));
                }
            })
        );

        $(".medicines-search").magicsearch(
            window.medexMagicSearch.assignConfigs({
                dataSource: medicines, // "/catalogs/medicines.json",
                fields: ["name", "code"],
                id: "id",
                format: "%code% %name%",
                success: function($input, data) {
                    const hidden_id = $input.data("hidden");
                    $(hidden_id).val($input.attr("data-id"));
                }
            })
        );

        $('#clinics-search').magicsearch(
            window.medexMagicSearch.assignConfigs({
                dataSource: '/catalogs/clinics.json',
                type:'ajax',
                success: function($input, data) {
                    var repeatable_id = $input.data('repeatable');
                    $('#from_clinic_id').val($input.attr('data-id'));
                }
            })
        );

        // [{id:0, number:'a. Նախ ընտրեք բաժինը և սենյակը', chamber_id: 0, is_occupied:false}],
        $('#beds-search').magicsearch(
            window.medexMagicSearch.assignConfigs({
                dataSource: beds,
                fields: ['number'],
                id:'id',
                format:'%number%',
                success: function($input, data) {
                    $('#bed_id').val($input.attr('data-id'));
                },
                disableRule: function(data) {
                    return  (data.is_occupied === "true") ? true : false;
                },
            })
        );

        // [{id:0, number:'a. Նախ ընտրեք բաժինը', department_id: 0}],
        $('#rooms-search').magicsearch(
            window.medexMagicSearch.assignConfigs({
                dataSource: chambers,
                fields: ['number'],
                id:'id',
                format:'%number%',
                success: function($input, data) {
                    $('#chamber_id').val($input.attr('data-id'));
                    var filtered_beds = beds.filter(bed => bed.chamber_id == $input.attr('data-id')); // && !bed.is_occupied
                    $('#beds-search').trigger('update', {dataSource: filtered_beds});
                },
                afterDelete: function($input, data) {
                    $('#beds-search').trigger('update',{dataSource: beds});
                },
            })
        );

        $('#departments-search').magicsearch(
            window.medexMagicSearch.assignConfigs({
                // dataSource: '/catalogs/departments.json',
                // type:'ajax',
                dataSource: departments,
                fields: ['id','name'],
                id:'id',
                format:'%id% - %name%',
                success: function($input, data) {
                    // JSON.stringify(data)  $input.attr('data-id')
                    $('#department_id').val($input.attr('data-id'));
                    var filtered_chambers = chambers.filter(chamber => chamber.department_id == $input.attr('data-id'));
                    $('#rooms-search').trigger('update',{dataSource: filtered_chambers});
                },
                afterDelete: function($input, data) {
                    $('#rooms-search').trigger('update',{dataSource: chambers});
                },
            })
        );
    });

</script>
@endsection
