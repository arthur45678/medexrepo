@extends('layouts.cardBase')

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
    <form  action="{{route('samples.patients.ape.store', ['patient'=> $patient])}}" class="ajax-submitable" method="POST">
        @csrf
        <div class="container">
            <input type="hidden" name="patient_id" value="{{$patient->id}}">
            <input type="hidden" name="user_id" value="{{auth()->id()}}">
            <ul class="list-group">
                <li class="list-group-item">
                    <div class="form-row align-items-center text-center">
                        <div class="col-md-4">
                            <strong>Ընդունման ամսաթիվը և ժամը՝</strong>
                        </div>

                        <div class="col-md-8">
                            <x-forms.text-field name="date" type="date" value="" validationType="ajax" label=""/>
                            <em class="error text-danger" data-input="date"></em>
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
                            <x-forms.text-field type="textarea" name="body_structure"  validationType="ajax" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                value="" label="" />

                        <hr class="hr-dashed">

                        <strong>Քաշը՝</strong>
                            <x-forms.text-field type="textarea" name="weight"  validationType="ajax" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                value="" label="" />

                        <hr class="hr-dashed">

                        <strong >Ախտորոշումը՝</strong>
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
                            <x-forms.text-field type="textarea" name="complaints"  validationType="ajax" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                value="" label="" />

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
                    <input name="surgery_datetime" type="datetime-local" class="mt-2" />

                    <div class="my-2">
                        <x-forms.magic-search class="magic-search ajax" value='' hidden-id="surgery_id"
                            hidden-name="surgery_id" data-catalog-name="surgeries"  validationType="ajax" placeholder="ընտրել վիրահատությունը․․․" />
                    </div>
                    <x-forms.text-field type="textarea" name="surgeries_comment" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                        value="" label="" />
                        <hr class="hr-dashed">
                        <div class="row">
                            <div class="col-md-5">
                                <strong>
                                    <span class="badge badge-light mr-1"></span>
                                    վիրահատության տիպը՝
                                </strong>
                            </div>
                            <div class="col-md-7">
                                <x-forms.checkbox-radio pos="align" id="radio1" value="urgent"
                                    old-default="" name="surgery_type"
                                    label="անհետաձգելի" />
                                <x-forms.checkbox-radio pos="align" id="radio2" value="programmed"
                                    old-default="" name="surgery_type"
                                    label="ծրագրավորված" />
                            </div>
                        </div>
                </li>

                <li class="list-group-item">
                        <strong>Վիրահատող բժիշկ՝</strong>
                        <x-forms.magic-search hidden-id="ape_attending_doctor_id"  validationType="ajax" hidden-name="attending_doctor_id"
                        placeholder="Ընտրել բուժող բժիշկին․․․" class="magic-search ajax my-2" data-list-name="users"
                        value="" />
                </li>

            </ul>

            <hr>

            <ul class="list-group">
                <li class="list-group-item">
                    <h5 class="text-center">Գիտակցությունը՝</h5>
                    <x-forms.text-field type="textarea" name="consciousness"  validationType="ajax" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                        value="" label="" />
                </li>

                <li class="list-group-item">
                    <h5 class="text-center">Մաշկը և տես. լորձաթաղ.՝</h5>
                    <x-forms.text-field type="textarea" name="the_skin"  validationType="ajax" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                        value="" label="" />
                </li>

                <li class="list-group-item">
                    <h5 class="text-center">Սիրտանոթային համակարգ՝ ԱՃ՝</h5>
                    <x-forms.text-field type="textarea" name="cardiovascular_system"  validationType="ajax" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                        value="" label="" />
                </li>

                <li class="list-group-item">
                    <h5 class="text-center">Սրտի կծկ. հաճախ.՝ զ/ր</h5>
                    <x-forms.text-field type="textarea" name="heart_contraction"  validationType="ajax" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                        value="" label="" />
                </li>

                <li class="list-group-item">
                    <h5 class="text-center">Աուսկուլտացիա՝ </h5>
                    <x-forms.text-field type="textarea" name="auscultation"  validationType="ajax" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                        value="" label="" />
                </li>

                <li class="list-group-item">
                    <h5 class="text-center">էՍԳ՝, երակներ՝</h5>
                    <x-forms.text-field type="textarea" name="veins"  validationType="ajax" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                        value="" label="" />
                </li>

                <li class="list-group-item">
                    <h5 class="text-center">Շնչական համակարգ՝, շնչ. հաճ.՝</h5>
                    <x-forms.text-field type="textarea" name="respiratory_system"  validationType="ajax" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                        value="" label="" />
                </li>

                <li class="list-group-item">
                    <h5 class="text-center">Բերանի խոռոչ՝ </h5>
                    <x-forms.text-field type="textarea" name="oral"  validationType="ajax" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                        value="" label="" />
                </li>

                <li class="list-group-item">
                    <h5>Mallampati` </h5>
                    <select name="mallampati" id="">
                        <option value=1>I</option>
                        <option value=2>II</option>
                        <option value=3>III</option>
                        <option value=4>IV</option>
                    </select>

                </li>

                <li class="list-group-item">
                    <h5 class="text-center">Այլ օրգան համակարգեր՝ </h5>
                    <x-forms.text-field type="textarea" name="other_organ_systems"  validationType="ajax" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                        value="" label="" />
                </li>

                <li class="list-group-item">
                    <strong> Ուղեկցող հիվանդություններ՝</strong>
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
                    <x-forms.text-field type="textarea" name="laboratory_tests"  validationType="ajax" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                        value="" label="" />
                </li>

            </ul>

            <hr>

            <ul class="list-group">
                <li class="list-group-item list-group-item-info">
                    <h4 class="text-center">Անամնեզ</h4>
                </li>

                <li class="list-group-item">
                    <strong>Ալերգիկ՝</strong>
                    <x-forms.text-field type="textarea" name="allergic" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                        value="" label="" />

                    <hr class="hr-dashed">

                    <strong>Վիրաբուժական՝ </strong>
                    <x-forms.text-field type="textarea" name="surgical" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                        value="" label="" />

                    <hr class="hr-dashed">

                    <strong> Կրած հիվանդություններ՝ </strong>
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
                    <x-forms.text-field type="textarea" name="special_notes" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                        value="" label="" />

                    <hr class="hr-dashed">

                    <strong>Հիվանդի վիճակը ըստ ASA` </strong>
                    <div class="my-8">

                       <select name="ASA" id="">
                           <option value=1>I</option>
                           <option value=2>II</option>
                           <option value=3>III</option>
                           <option value=4>IV</option>
                           <option value=5>V</option>
                           <option value=6>E</option>
                       </select>
                    </div>

                    <hr class="hr-dashed">

                    <strong>Անզգայացման մեթոդը՝ </strong>
                    <div class="my-2">
                        <x-forms.magic-search class="magic-search ajax" value='' hidden-id="anesthesia_id"
                            hidden-name="anesthesia_id" data-catalog-name="anesthesias" validationType="ajax" placeholder="ընտրել վիրահատությունը․․․" />
                    </div>
                </li>

                <li class="list-group-item">
                    <strong>Հիվանդ/խնամակալ/ ազգական՝ </strong>
                    <x-forms.text-field type="textarea" name="patient_guardian_relative" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                        value="" label="" />

                </li>

                <li class="list-group-item">
                    <div class="form-row align-items-center">
                            <strong>Բուժող բժիշկ՝</strong>
                            <x-forms.magic-search hidden-id="apse_attending_doctor_id" validationType="ajax" hidden-name="attending_doctor_id"
                            placeholder="Ընտրել բուժող բժիշկին․․․" class="magic-search ajax my-2" data-list-name="users"
                            value="" />
                             <em class="error text-danger" data-input="attending_doctor_id"></em>
                    </div>
                </li>

                @include('shared.forms.list_group_item_submit', ['btn_text'=>'Ուղարկել'])

            </ul>
        </div>
    </form>
</div>
@endsection


@section('javascript')
<script src="{{ mix('js/jquery.js') }}"></script>
<script src="{{ mix('js/all.magicsearch.js') }}"></script>
<script src="{{ mix('/js/components/Select.js') }}"></script>
@endsection

<script>
    const usersUrl = @json(route('lists.users_full'));
    $('.user_search').magicsearch(
        window.medexMagicSearch.assignConfigs({
            type: "ajax",
            dataSource: `${usersUrl}?groupByRole=doctor`,
            fields: ["f_name","l_name"],
            id: "id",
            format: "%f_name% %l_name%",
            success: function($input, data) {
                console.log(data)
                const hidden_input_id = $input.data('hidden');
                $(hidden_input_id).val($input.attr("data-id"));
            },
            afterDelete: function($input, data) {
                const hidden_input_id = $input.data("hidden");
                $(hidden_input_id).val("");
            }
        })
    );

</script>
