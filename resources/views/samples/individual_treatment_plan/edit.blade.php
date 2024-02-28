@extends('layouts.cardBase')


@section('css')
<link href="{{mix("/css/jquery.magicsearch.min.css")}}" rel="stylesheet" />
@endsection


@section('card-header')
@section('card-header-classes', '')

<div class="text-center">
    <h3>ԱՆՀԱՏԱԿԱՆ ԲՈՒԺՄԱՆ ՊԼԱՆ</h3>
    <h3>ՉԱՐՈՐԱԿ ՆՈՐԱԳՈՅԱՑՈՒԹՅՈՒՆՆԵՐՈՎ ՊԱՑԻԵՆՏԻ</h3>
</div>
@endsection


@section('card-content')

<div class="container">
    <form  action="{{route('samples.patients.individual-treatment-plan.update',[$patient->id,$indivdual_id])}}" method="POST" class="ajax-submitable">
        @csrf
        @method('put')
        <ul class="list-group">
            <input type="hidden" value="{{$patient->id}}" name="patient_id">
            <input type="hidden" value="{{auth()->id()}}" name="user_id">
            <input type="hidden" value="{{auth()->user()->department_id}}" name="department_id">
            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="textarea"  name="manipulation" validationType="ajax"
                    placeholder="Լրացման ազատ դաշտ․․․" value="{{$indivdual['manipulation']}}" label="ՈՒռուցքաբանական խմբի որոշման հերթական համարը"/>
                </div>
            </li>
            <li class="list-group-item ">
               <div class="form-row">
                    <div class="col-md-6">
                        <strong>
                         Ազգանուն, անուն, հայրանուն
                        </strong>
                        <ins class="ml-4">{{$patient->full_name}} {{$patient->p_name}}</ins>
                    </div>
               </div>
            </li>
            <li class="list-group-item">
                <div class="form-row align-items-center">
                    <div class="col-md-4">
                        <strong>Դիմելու ամսաթիվ</strong>
                    </div>
                    <div class="col-md-8">
                        <x-forms.text-field type="date" name="entry_date"
                       value="{{\Illuminate\Support\Carbon::parse($indivdual->entry_date)->format('Y-m-d')}}"                   validationType="ajax" label=""/>
                    </div>
                </div>
            </li>
            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="textarea"   name="get_from" validationType="ajax"
                    placeholder="Լրացման ազատ դաշտ․․․" value="{{$indivdual['get_from']}}" label="Պացիենտի մոտ առկա իրականացվախծ լաբարատոր գործիքային ախտորոշիչ հետազոտությունների արդյունքները"/>
                </div>
            </li>
            <li class="list-group-item">
                        <strong>Լաբարատոր հետազոտություններ</strong>
                    <div class="my-2">
                        <x-forms.magic-search hidden-name="laboratory_id" hidden-id="laboratory_id"
                        placeholder="Ընտրել ծառայությունը․․․" class="my-2" value="{{$indivdual_service_laboratory['service_id']}}" id="service_search_" autocomplete="off" />
                    </div>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" value="{{$indivdual_service_laboratory['comment']}}"  name="laboratory_comment" validationType="ajax"
                        placeholder="Լրացման ազատ դաշտ․․․" label=""/>
                    </div>
            </li>
            <li class="list-group-item">
                        <strong>Գործիքային հետազոտություններ</strong>
                    <div class="my-2">
                        <x-forms.magic-search hidden-name="instrumental_id" value="{{$indivdual_service_instrumental['service_id']}}" hidden-id="instrumental_id"
                        placeholder="Ընտրել ծառայությունը․․․" class="my-2" id="service_search_" autocomplete="off" />
                    </div>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea"  value="{{$indivdual_service_instrumental['comment']}}"  name="instrumental_comment" validationType="ajax"
                        placeholder="Լրացման ազատ դաշտ․․․" label=""/>
                    </div>
            </li>
            <li class="list-group-item">
                        <strong>Ճառագայթային ախտորոշիչ հետազոտություններ</strong>
                    <div class="my-2">
                        <x-forms.magic-search hidden-name="radiation_id" hidden-id="radiation_id" value="{{$indivdual_service_radiation['service_id']}}"
                        placeholder="Ընտրել ծառայությունը․․․" class="my-2" id="service_search_" autocomplete="off" />
                    </div>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea"   name="radiation_comment" value="{{$indivdual_service_radiation['comment']}}" validationType="ajax"
                        placeholder="Լրացման ազատ դաշտ․․․" label=""/>
                    </div>
            </li>
            <li class="list-group-item">
                        <strong>Հյուսվածքաբանական կամ բջջաբանական հետազոտություններ</strong>
                    <div class="my-2">
                        <x-forms.magic-search hidden-name="histological_id" hidden-id="histological_id" value="{{$indivdual_service_histological['service_id']}}"
                        placeholder="Ընտրել ծառայությունը․․․" class="my-2" id="service_search_" autocomplete="off" />
                    </div>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea"   name="histological_comment" validationType="ajax" value="{{$indivdual_service_histological['comment']}}"
                                            placeholder="Լրացման ազատ դաշտ․․․" label=""/>
                    </div>
            </li>
            <li class="list-group-item">
                        <strong>Այլ նշումներ</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" value="{{$indivdual['histological_other_comment']}}"  name="histological_other_comment" validationType="ajax"
                        placeholder="Լրացման ազատ դաշտ․․․" label=""/>
                    </div>
            </li>
            <li class="list-group-item">
                <strong>
                    Վիրահատական միջամտություն
                </strong>
                    <div class="my-2">
                        <x-forms.magic-search class="magic-search ajax" data-catalog-name="surgeries" value="{{$indivdual['surgery_id']}}" hidden-id="surgery_id"
                            hidden-name="surgery_id" placeholder="ընտրել վիրահատությունը․․․" />
                    </div>
                    <div class="my-2">
                        <x-forms.text-field type="textarea" value="{{$indivdual['surgery_comment']}}"  name="surgery_comment" validationType="ajax"
                        placeholder="Լրացման ազատ դաշտ․․․" label=""/>
                    </div>
            </li>
            <li class="list-group-item">
                <strong>
                    Քիմիաթերապևտիկ բուժում
                </strong>
                    <div class="my-2">
                        <x-forms.magic-search class="magic-search ajax" data-catalog-name="treatments" value='{{$indivdual_treatment_chemotherapy->treatment_id}}' hidden-id="treatment_chemotherapy_id"
                            hidden-name="treatment_chemotherapy_id" placeholder="ընտրել բուժումը․․․" />
                    </div>
                    <div class="my-2">
                        <x-forms.text-field type="textarea"   name="treatment_chemotherapy_comment" validationType="ajax" value="{{$indivdual_treatment_chemotherapy->treatment_comment}}"
                        placeholder="Լրացման ազատ դաշտ․․․" label=""/>
                    </div>
            </li>
            <li class="list-group-item">
                <strong>
                    Ճառագայթային թերապիա
                </strong>
                    <div class="my-2">
                        <x-forms.magic-search class="magic-search ajax" data-catalog-name="treatments" value='{{$indivdual_treatment_radiation->treatment_id}}' hidden-id="treatment_radiation_id"
                            hidden-name="treatment_radiation_id" placeholder="ընտրել բուժումը․․․" />
                    </div>
                    <div class="my-2">
                        <x-forms.text-field type="textarea"   name="treatment_radiation_comment" validationType="ajax" value="{{$indivdual_treatment_radiation->treatment_comment}}"
                        placeholder="Լրացման ազատ դաշտ․․․" label=""/>
                    </div>
            </li>
            <li class="list-group-item">
                        <strong>Այլ միջամտություններ</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea"   name="other_interventions" validationType="ajax" value="{{$indivdual['other_interventions']}}"
                                            placeholder="Լրացման ազատ դաշտ․․․" label=""/>
                    </div>
            </li>
            <li class="list-group-item">
                        <strong >Միջփուլային հսկողություն</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea"   name="intermediate_control" validationType="ajax" value="{{$indivdual['intermediate_control']}}"
                                            placeholder="Լրացման ազատ դաշտ․․․" label=""/>
                    </div>
            </li>
            <li class="list-group-item">
                        <div class="text-center"><h4>Վիրահատական միջամտությունից հետո</h4></div>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" value="{{$indivdual['surgical_after_surgical_comment']}}"   name="surgical_after_surgical_comment" validationType="ajax"
                        placeholder="Լրացման ազատ դաշտ․․․" label=""/>
                    </div>
            </li>
            <li class="list-group-item">
                <strong>ԱԱՊ բժշկի մոտ ներկայանալ</strong>
                <x-forms.magic-search hidden-id="doctor_aap_id" hidden-name="doctor_surgical_id"
                placeholder="Ընտրել բժիշկին․․․"  validationType="ajax" class="my-2 user_search"  value="{{$indivdual['doctor_surgical_id']}}"/>
                <em class="error text-danger" data-input="clinics"></em>
                <div class="mt-2">
                        <x-forms.text-field type="textarea"   name="doctor_surgical_comment" validationType="ajax"
                        placeholder="Լրացման ազատ դաշտ․․․" label="" value="{{$indivdual['doctor_surgical_comment']}}"/>
                </div>
            </li>

            <li class="list-group-item">

                    <strong>Նշանակումներ</strong>
                <table class="table" border="2">
                    <thead>
                    <tr>
                        <th>Նշանակումներ</th>
                        <th>գրառման</th>
                        <th>ջնջել</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($indivdual_appointments_surgical as $indivdual_appointments_surgicals)

                        <tr id="trashData{{$indivdual_appointments_surgicals->id}}">
                            <td>{{$indivdual_appointments_surgicals->medicine_name->name ?? ' '}}</td>
                            <td>{{$indivdual_appointments_surgicals->appointments_comments}}</td>
                            <td>
                                <button class="btn btn-danger btn-sm clickTrash" type="button"
                                        onclick="clickTrash({{$indivdual_appointments_surgicals->id}})">
                                    <x-svg icon="cui-trash"/>
                                </button>
                            </td>
                        </tr>
                    @endforeach


                    </tbody>
                </table>
                <strong>Ավելացնել նոր Նշանակումներ</strong>
                <x-forms.add-reduce-button type="add" data-row=".appointments_surgical_row" />
                <x-forms.add-reduce-button type="reduce" data-row=".appointments_surgical_row" />
                <x-forms.hidden-counter class="ambulator-prescription-rows" name="appointments_surgica_length" />
            </li>
            @for($i = 0; $i < $repeatables; $i++)
                <li class="list-group-item appointments_surgical_row {{ $i < old('appointments_surgica_length', 1) ? ' ' : 'd-none' }}">
                    <div class="my-2">
                        <x-forms.magic-search class="medicines-search magic-search ajax"
                                              data-catalog-name="medicines"
                                              value='{{ old("appointments_surgical_id.$i") }}'
                                              hidden-id="appointments_surgical_id{{ $i }}" hidden-name="appointments_surgical_id[]"
                                              placeholder="Ընտրել դեղամիջոցը․․" />
                    </div>
                    <div class="form-row align-items-center my-2">
                        <div class="col-md-12 mt-3">

                            <x-forms.text-field type="textarea" placeholder="դեղամիջոցի նշանակման աազատ դաշտ․․․"
                                                value='{{ old("appointments_surgical_comment.$i") }}' name="appointments_surgical_comment[]"
                                                validationType="ajax" label="" />
                        </div>
                    </div>
                </li>
                @endfor
            </li>
            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="textarea"  name="surgical_present_comment" validationType="ajax"
                    placeholder="Լրացման ազատ դաշտ․․․" value="{{$indivdual['surgical_present_comment']}}" label="Մասնագիտացված կազմակերպության բուժող բժիշկ-ուռուցքաբանի մոտ ներկայանալ"/>
                </div>
            </li>

            <li class="list-group-item">
            <div class="text-center"><h4>Քիմիաթերապևտիկ բուժումից հետո</h4></div>
                <div class="mt-2">
                    <x-forms.text-field type="textarea"  name="after_chemotherapy_comment" validationType="ajax"
                    placeholder="Լրացման ազատ դաշտ․․․" value="{{$indivdual['after_chemotherapy_comment']}}"  label=""/>
                </div>
            </li>
            <li class="list-group-item">
                <strong>ԱԱՊ բժշկի մոտ ներկայանալ</strong>
                <x-forms.magic-search hidden-id="doctor_chemotherapy_id" hidden-name="doctor_chemotherapy_id"
                placeholder="Ընտրել բժիշկին․․․" value="{{$indivdual['doctor_chemotherapy_id']}}"  validationType="ajax" class="my-2 user_search"/>
                <em class="error text-danger" data-input="clinics"></em>
                <div class="mt-2">
                        <x-forms.text-field type="textarea" value="{{$indivdual['doctor_chemotherapy_comment']}}"   name="doctor_chemotherapy_comment" validationType="ajax"
                        placeholder="Լրացման ազատ դաշտ․․․" label=""/>
                </div>
            </li>



                <li class="list-group-item">
                    <strong>Նշանակումներ</strong>
                    <table class="table" border="2">
                        <thead>
                        <tr>
                            <th>Նշանակումներ</th>
                            <th>գրառման</th>
                            <th>ջնջել</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($indivdual_appointments_chemotherapy as $indivdual_appointments_chemotherapys)

                            <tr id="trashData{{$indivdual_appointments_chemotherapys->id}}">
                                <td>{{$indivdual_appointments_chemotherapys->medicine_name->name ?? ' '}}</td>
                                <td>{{$indivdual_appointments_chemotherapys->appointments_comments}}</td>
                                <td>
                                    <button class="btn btn-danger btn-sm clickTrash" type="button"
                                            onclick="clickTrash({{$indivdual_appointments_chemotherapys->id}})">
                                        <x-svg icon="cui-trash"/>
                                    </button>
                                </td>
                            </tr>
                        @endforeach


                        </tbody>
                    </table>
                    <strong>Ավելացնել նոր Նշանակումներ</strong>
                    <x-forms.add-reduce-button type="add" data-row=".appointments_chemotherapy_row" />
                    <x-forms.add-reduce-button type="reduce" data-row=".appointments_chemotherapy_row" />
                    <x-forms.hidden-counter class="ambulator-prescription-rows" name="appointments_chemotherapy_length" />
                </li>
                @for($i = 0; $i < $repeatables; $i++)
                    <li class="list-group-item appointments_chemotherapy_row {{ $i < old('appointments_chemotherapy_length', 1) ? ' ' : 'd-none' }}">
                        <div class="my-2">
                            <x-forms.magic-search class="medicines-search magic-search ajax"
                                                  data-catalog-name="medicines"
                                                  value='{{ old("appointments_chemotherapy_id.$i") }}'
                                                  hidden-id="appointments_chemotherapy_id{{ $i }}" hidden-name="appointments_chemotherapy_id[]"
                                                  placeholder="Ընտրել դեղամիջոցը․․" />
                        </div>
                        <div class="form-row align-items-center my-2">
                            <div class="col-md-12 mt-3">
                                <x-forms.text-field type="textarea" placeholder="դեղամիջոցի նշանակման աազատ դաշտ․․․"
                                                    value='{{ old("appointments_chemotherapy_comment.$i") }}' name="appointments_chemotherapy_comment[]"
                                                    validationType="ajax" label="" />
                            </div>
                        </div>
                    </li>
                    @endfor
                    </li>
            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="textarea" value="{{$indivdual['chemotherapy_present_comment']}}"  name="chemotherapy_present_comment" validationType="ajax"
                    placeholder="Լրացման ազատ դաշտ․․․" label="Մասնագիտացված կազմակերպության բուժող բժիշկ-ուռուցքաբանի մոտ ներկայանալ"/>
                </div>
            </li>
            <li class="list-group-item">
                <div class="text-center"><h4>Ճառագայթային թերապիայից հետո</h4></div>
            </li>
            <li class="list-group-item">
                <strong>ԱԱՊ բժշկի մոտ ներկայանալ</strong>
                <x-forms.magic-search hidden-id="doctor_radiation_id" hidden-name="doctor_radiation_id"
                placeholder="Ընտրել բժիշկին․․․"  validationType="ajax" value="{{$indivdual['doctor_radiation_id']}}" class="my-2 user_search"/>
                <em class="error text-danger" data-input="clinics"></em>
                <div class="mt-2">
                        <x-forms.text-field type="textarea" value="{{$indivdual['doctor_radiation_comment']}}"  name="doctor_radiation_comment" validationType="ajax"
                        placeholder="Լրացման ազատ դաշտ․․․" label=""/>
                </div>
            </li>

                    <li class="list-group-item">
                        <strong>Նշանակումներ</strong>
                        <table class="table" border="2">
                            <thead>
                            <tr>
                                <th>Նշանակումներ</th>
                                <th>գրառման</th>
                                <th>ջնջել</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($indivdual_appointments_radiation as $indivdual_appointments_radiations)

                                <tr id="trashData{{$indivdual_appointments_radiations->id}}">
                                    <td>{{$indivdual_appointments_radiations->medicine_name->name ?? ' '}}</td>
                                    <td>{{$indivdual_appointments_radiations->appointments_comments}}</td>
                                    <td>
                                        <button class="btn btn-danger btn-sm clickTrash" type="button"
                                                onclick="clickTrash({{$indivdual_appointments_radiations->id}})">
                                            <x-svg icon="cui-trash"/>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach


                            </tbody>
                        </table>
                        <strong>Ավելացնել նոր Նշանակումներ</strong>
                        <x-forms.add-reduce-button type="add" data-row=".appointments_radiation_row" />
                        <x-forms.add-reduce-button type="reduce" data-row=".appointments_radiation_row" />
                        <x-forms.hidden-counter class="ambulator-prescription-rows" name="appointments_radiation_length" />
                    </li>
                    @for($i = 0; $i < $repeatables; $i++)
       <li class="list-group-item appointments_radiation_row {{ $i < old('appointments_radiation_length', 1) ? ' ' : 'd-none' }}">
                            <div class="my-2">
                                <x-forms.magic-search class="medicines-search magic-search ajax"
                                                      data-catalog-name="medicines"
                                                      value='{{ old("appointments_radiation_id.$i") }}'
                                                      hidden-id="appointments_radiation_id{{ $i }}" hidden-name="appointments_radiation_id[]"
                                                      placeholder="Ընտրել դեղամիջոցը․․" />
                            </div>

                            <div class="form-row align-items-center my-2">



                                <div class="col-md-12 mt-3">

                                    <x-forms.text-field type="textarea" placeholder="դեղամիջոցի նշանակման աազատ դաշտ․․․"
                                                        value='{{ old("appointments_radiation_comment.$i") }}' name="appointments_radiation_comment[]"
                                                        validationType="ajax" label="" />
                                </div>
                            </div>
                        </li>
                        @endfor
                        </li>
            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="textarea" value="{{$indivdual['radiation_present_comment']}}" name="radiation_present_comment" validationType="ajax"
                    placeholder="Լրացման ազատ դաշտ․․․" label="Մասնագիտացված կազմակերպության բուժող բժիշկ-ուռուցքաբանի մոտ ներկայանալ"/>
                </div>
            </li>
            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="textarea"  name="radiation_other_comment" value="{{$indivdual['radiation_other_comment']}}" validationType="ajax"
                    placeholder="Լրացման ազատ դաշտ․․․" label="Հատուկ նշումներ"/>
                </div>
            </li>
            <li class="list-group-item">
                <div class="text-center"><h4>Բուժումն ավարտելուց հետո հետագա հսկողությունը</h4></div>
                <div class="mt-2">
                    <x-forms.text-field type="textarea"  name="after_control_comment" value="{{$indivdual['after_control_comment']}}"  validationType="ajax"
                    placeholder="Լրացման ազատ դաշտ․․․" label=""/>
                </div>
            </li>
            <li class="list-group-item">
                <strong>ԱԱՊ բժշկի մոտ ներկայանալ</strong>
                <x-forms.magic-search hidden-id="doctor_control_id" hidden-name="doctor_control_id" value="{{$indivdual['doctor_control_id']}}"
                                      placeholder="Ընտրել բժիշկին․․․"  validationType="ajax" class="my-2 user_search"/>
                <em class="error text-danger" data-input="clinics"></em>
                <div class="mt-2">
                        <x-forms.text-field type="textarea"   name="doctor_control_comment" validationType="ajax" value="{{$indivdual['doctor_control_comment']}}"
                        placeholder="Լրացման ազատ դաշտ․․․" label=""/>
                </div>
            </li>
            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="textarea"  name="control_present_comment" validationType="ajax"
                    placeholder="Լրացման ազատ դաշտ․․․" label="Լաբարատոր գործիքային ախտորոշիչ հետազոտություններ"
                                        value="{{$indivdual['control_present_comment']}}"/>
                </div>
            </li>



                        <li class="list-group-item">
                            <strong>Նշանակումներ</strong>
                            <table class="table" border="2">
                                <thead>
                                <tr>
                                    <th>Նշանակումներ</th>
                                    <th>գրառման</th>
                                    <th>ջնջել</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($indivdual_appointments_control as $indivdual_appointments_controls)

                                    <tr id="trashData{{$indivdual_appointments_controls->id}}">
                                        <td>{{$indivdual_appointments_controls->medicine_name->name ?? ' '}}</td>
                                        <td>{{$indivdual_appointments_controls->appointments_comments}}</td>
                                        <td>
                                            <button class="btn btn-danger btn-sm clickTrash" type="button"
                                                    onclick="clickTrash({{$indivdual_appointments_controls->id}})">
                                                <x-svg icon="cui-trash"/>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach


                                </tbody>
                            </table>
                            <strong>Ավելացնել նոր Նշանակումներ</strong>
                            <x-forms.add-reduce-button type="add" data-row=".appointments_control_row" />
                            <x-forms.add-reduce-button type="reduce" data-row=".appointments_control_row" />
                            <x-forms.hidden-counter class="ambulator-prescription-rows" name="appointments_control_length" />
                        </li>
                        @for($i = 0; $i < $repeatables; $i++)
                            <li class="list-group-item appointments_control_row {{ $i < old('appointments_control_length', 1) ? ' ' : 'd-none' }}">
                                <div class="my-2">
                                    <x-forms.magic-search class="medicines-search magic-search ajax"
                                                          data-catalog-name="medicines"
                                                          value='{{ old("appointments_control_id.$i") }}'
                                                          hidden-id="appointments_control_id{{ $i }}" hidden-name="appointments_control_id[]"
                                                          placeholder="Ընտրել դեղամիջոցը․․" />
                                </div>
                                <div class="form-row align-items-center my-2">
                                    <div class="col-md-12 mt-3">
                                        <x-forms.text-field type="textarea" placeholder="դեղամիջոցի նշանակման աազատ դաշտ․․․"
                                                            value='{{ old("appointments_control_comment.$i") }}' name="appointments_control_comment[]"
                                                            validationType="ajax" label="" />
                                    </div>
                                </div>
                            </li>
                            @endfor
                            </li>
            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="textarea"
                    name="control_other_comments" validationType="ajax" value="{{$indivdual['control_other_comments']}}"
                    placeholder="Լրացման ազատ դաշտ․․․" label="Հատուկ նշումներ"/>
                </div>
            </li>
            <li class="list-group-item">
                <div class="form-row align-items-center">
                    <div class="col-md-6">
                        <strong>Անհատական բուժման պլանի կազմելու ամսաթիվ</strong>
                    </div>
                    <div class="col-md-6">
                        <x-forms.text-field type="date" value="{{\Illuminate\Support\Carbon::parse($indivdual->treatment_date)->format('Y-m-d')}}" name="treatment_date" validationType="ajax" label=""/>
                    </div>

                </div>
            </li>
            <li class="list-group-item">
                <strong>Մասնագիտացված կազմակերպության բուժող բժիշկ-ուռուցքաբան</strong>
                    <x-forms.magic-search hidden-id="doctor_oncologist_id" hidden-name="doctor_oncologist_id"
                    placeholder="Ընտրել բժիշկին․․․" class="my-2 user_search" value="{{$indivdual['doctor_oncologist_id']}}"/>
                    <em class="error text-danger" data-input="doctor_oncologist_id"></em>
                    <strong>Վիրաբույժ-ուռուցքաբան</strong>
                    <x-forms.magic-search hidden-id="surgeon_oncologist_id" hidden-name="surgeon_oncologist_id"
                    placeholder="Ընտրել  բժիշկին․․․" class="my-2 user_search" value="{{$indivdual['surgeon_oncologist_id']}}"/>
                    <em class="error text-danger" data-input="surgeon_oncologist_id"></em>
                    <strong>Քիմիաթերապևտ</strong>
                    <x-forms.magic-search hidden-id="chemotherapist_id" hidden-name="chemotherapist_id"
                    placeholder="Ընտրել բժիշկին․․․" class="my-2 user_search" value="{{$indivdual['chemotherapist_id']}}"/>
                    <em class="error text-danger" data-input="chemotherapist_id"></em>
                    <strong>Հյուսվածքաբան</strong>
                    <x-forms.magic-search hidden-id="histologist_id" hidden-name="histologist_id"
                    placeholder="Ընտրել  բժիշկին․․․" class="my-2 user_search" value="{{$indivdual['histologist_id']}}"/>
                    <em class="error text-danger" data-input="histologist_id"></em>
                    <strong>Ճառագայթաբան</strong>
                    <x-forms.magic-search hidden-id="radiologist_id" hidden-name="radiologist_id"
                    placeholder="Ընտրել  բժիշկին․․․" class="my-2 user_search" value="{{$indivdual['radiologist_id']}}"/>
                    <em class="error text-danger" data-input="radiologist_id"></em>
                    <strong>Ճառագայթային ախտորոշման մասնագետ</strong>
                    <x-forms.magic-search hidden-id="radiologist_specialist_id" hidden-name="radiologist_specialist_id"
                    placeholder="Ընտրել  բժիշկին․․․" class="my-2 user_search" value="{{$indivdual['radiologist_specialist_id']}}"/>
                    <em class="error text-danger" data-input="radiologist_specialist_id"></em>
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

    const servicesUrl = @json(route('catalogs.services_full'));
    $('[id^="service_search"]').magicsearch(
        window.medexMagicSearch.assignConfigs({
            type: "ajax",
            // dataSource: `${servicesUrl}?filterBy=department_id&needle=0`,
            dataSource: `${servicesUrl}`,
            fields: ["code","name"],
            id: "id",
            format: "%code% %name%",
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
<script>
    var repeatables = {{$repeatables}};
</script>
<script>
    function clickTrash(data) {
        let _token   = $('meta[name="csrf-token"]').attr('content');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '{{url('samples/trash/individual-treatment-plan/')}}'+'/'+data,
            type:"get",
            success: function (data) {
                $('#trashData'+data).remove()
            }
        });
    }
</script>
@endsection
