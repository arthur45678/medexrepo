@extends('layouts.cardBase')


@section('css')
<link href="{{mix("/css/jquery.magicsearch.min.css")}}" rel="stylesheet" />
@endsection


@section('card-header')
@section('card-header-classes', '')

<div class="text-center">
    <h3>Ստացիոնարից դուրս գրվածի վիճակագրական քարտ</span></h3>
</div>
@endsection


@section('card-content')
{{--    class="ajax-submitable"--}}
    <div class="container">
    <form action="{{route('samples.patients.stationary-discharge-card.update', ['patient'=> $patient,$apse_id])}}" method="POST" class="ajax-submitable">
        @csrf
        @method('put')
        <ul class="list-group">
            <li class="list-group-item ">
               <div class="form-row">
                    <div class="col-md-6">
                        <strong>
                         Ազգանուն, անուն, հայրանուն
                        </strong>
                        <ins class="ml-4">{{$patient->all_names}}</ins>
                    </div>
               </div>
            </li>
            <input type="hidden" name="user_id" value="{{auth()->id()}}">
            <input type="hidden"  name="patient_id" value="{{$patient->id}}">
            <li class="list-group-item ">
                <div class="form-row">
                     <div class="col-md-6">
                         <strong>
                             Սեռը
                         </strong>
                         @if($patient->is_male==0)
                             <ins class="ml-4">Իգական</ins>
                         @else
                             <ins class="ml-4">Արական</ins>
                         @endif
                     </div>
                </div>
            </li>

            <li class="list-group-item ">
                <div class="form-row">
                     <div class="col-md-6">
                         <strong>
                             Ծննդյան ամսաթիվը
                         </strong>
                         <ins class="ml-4">{{$patient->birth_date}}</ins>

                     </div>
                </div>
            </li>

            <li class="list-group-item ">
                <div class="form-row">
                     <div class="col-md-6">
                         <strong>
                             Մշտական հասցեն
                         </strong>
                         <ins class="ml-4">{{$patient->town_village}}</ins>
                     </div>
                </div>
            </li>

{{--            <li class="list-group-item">--}}
{{--                <div class="mt-2">--}}
{{--                    <x-forms.text-field type="textarea"  name="sent_patient" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"--}}
{{--                    value="{{$descharge->sent_patient}}" label="Ում կողմից է ուղարկված հիվանդը" />--}}
{{--                </div>--}}

{{--            </li>--}}

            <li class="list-group-item">
                <strong>Բաժանմունք՝</strong>
                <div class="my-2">
                    {{$departmentauth->name}}
                    <input type="hidden" name="department_id" value="{{auth()->user()->department_id}}">
                   <em class="error text-danger" data-input="department_id"></em>
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="textarea"  name="bed_profiles" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                    value="{{$descharge->bed_profiles}}" label="Մահճակալների պռոֆիլները" />
                </div>
            </li>

{{--            <li class="list-group-item">--}}
{{--                <div class="row">--}}
{{--                    <div class="col-md-12 ">--}}
{{--                        <strong>Ստացիանար է ընդունվել անհետաձգելի ցուցումով</strong>--}}
{{--                    </div>--}}
{{--                    <div class="col-md-12 mt-2">--}}
{{--                        <x-forms.checkbox-radio pos="align" id="radio1" value="yes" check="{{$descharge->accept=='yes'}}" name="accept" label="Այո"/>--}}
{{--                        <x-forms.checkbox-radio pos="align" id="radio2" value="no" check="{{$descharge->accept=='no'}}" name="accept" label="Ոչ"/>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </li>--}}

{{--            <li class="list-group-item">--}}
{{--                <div class="row">--}}
{{--                    <div class="col-md-12 ">--}}
{{--                        <strong>Հիվանդության սկզբից(վնասվածք ստանալուց)քանի ժամ անց</strong>--}}
{{--                    </div>--}}
{{--                    <div class="col-md-12 mt-2">--}}
{{--                       <select name="from_injury" id="">--}}
{{--                           <option value="in_the_first_6_hours" {{$descharge->from_injury=='in_the_first_6_hours' ? 'selected':''}} >առաջին 6 ժամում</option>--}}
{{--                           <option value="7_24_hours_later" {{$descharge->from_injury=='7_24_hours_later' ? 'selected':''}}>7-24 ժամ անց</option>--}}
{{--                           <option value="No_later_than_24_hours"  {{$descharge->from_injury=='No_later_than_24_hours' ? 'selected':''}}>24 ժամից ոչ ուշ</option>--}}
{{--                       </select>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </li>--}}

{{--            <li class="list-group-item">--}}
{{--                <div class="form-row align-items-center">--}}
{{--                    <div class="col-md-6">--}}
{{--                        <strong>Ստացիոնար ընդունվելու ամսաթիվ</strong>--}}
{{--                    </div>--}}
{{--                    <div class="col-md-6">--}}
{{--                        <x-forms.text-field name="research_date" validationType="ajax" type="date"--}}
{{--                            value="{{\Illuminate\Support\Carbon::parse($descharge->research_date)->format('Y-m-d')}}" label="" />--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </li>--}}

{{--            <li class="list-group-item">--}}
{{--                <div class="row">--}}
{{--                    <div class="col-md-12 ">--}}
{{--                        <strong>Հիվանդության Ելքը</strong>--}}
{{--                    </div>--}}
{{--                    <div class="col-md-12 mt-2">--}}
{{--                       <select name="outcome_of_the_disease" id="">--}}
{{--                           <option value="discharged" {{$descharge->outcome_of_the_disease=='discharged' ? 'selected':''}}>դուրս է գրվել</option>--}}
{{--                           <option value="died" {{$descharge->outcome_of_the_disease=='died' ? 'selected':''}}>մահացել է</option>--}}
{{--                           <option value="moved" {{$descharge->outcome_of_the_disease=='moved' ? 'selected':''}}>տեղափոխվել է</option>--}}
{{--                       </select>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </li>--}}

{{--            <li class="list-group-item">--}}
{{--                <div class="form-row align-items-center">--}}
{{--                    <div class="col-md-6">--}}
{{--                        <strong>Դուրս գրման(մահվան) ամսաթիվը</strong>--}}
{{--                    </div>--}}
{{--                    <div class="col-md-6">--}}
{{--                        <x-forms.text-field name="date_discharge_or_death" validationType="ajax" type="date"--}}
{{--                            value="{{\Illuminate\Support\Carbon::parse($descharge->date_discharge_or_death)->format('Y-m-d')}}" label="" />--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </li>--}}

{{--            <li class="list-group-item">--}}
{{--                <div class="mt-2">--}}
{{--                    <x-forms.text-field type="textarea"  name="research" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"--}}
{{--                    value="{{$descharge->research}}" label="Անցկացրել է (մ/օր)" />--}}
{{--                </div>--}}
{{--            </li>--}}

{{--            <li class="list-group-item">--}}
{{--                <div class="mt-2">--}}
{{--                    <x-forms.text-field type="textarea"  name="sent_diagnosis_facility" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"--}}
{{--                    value="{{$descharge->sent_diagnosis_facility}}" label="Ուղարկված հաստատության ախտորոշումը" />--}}
{{--                </div>--}}
{{--            </li>--}}

            <li class="list-group-item">
                <div class="row">
                    <div class="col-md-12 ">
                        <strong>Տվյալ տարում տվյալ հիվանդության կապակցությամբ հոսպիտալացվել է</strong>
                    </div>
                    <div class="col-md-12 mt-2">
                        <x-forms.checkbox-radio pos="align" id="first_time1" value="first_time" name="hospitalized" check="{{$descharge->hospitalized=='first_time'}}" label="Առաջին անգամ"/>
                        <x-forms.checkbox-radio pos="align" id="double2" value="double" name="hospitalized" check="{{$descharge->hospitalized=='double'}}" label="կրկնակի"/>
                    </div>
                </div>
            </li>

{{--            <li class="list-group-item list-group-item-info">--}}
{{--                <div class="text-center"><h4>Ստացիոնարի ախտորոշումը</h4> </div>--}}
{{--            </li>--}}


{{--            <li class="list-group-item">--}}
{{--                <div class="text-center"><h5>Վերջնական կլինիկական</h5> </div>--}}
{{--            </li>--}}
{{--            <li class="list-group-item">--}}
{{--                <strong >ա․ Հիմնական՝</strong>--}}
{{--                <table class="table" border="2">--}}
{{--                    <thead>--}}
{{--                    <tr>--}}
{{--                        <th>Ախտորոշում</th>--}}
{{--                        <th>գրառման</th>--}}
{{--                        <th>ջնջել</th>--}}
{{--                    </tr>--}}
{{--                    </thead>--}}
{{--                    <tbody>--}}

{{--                    @foreach($diagnostic_aa as $diagnos_exits_aa)--}}
{{--                        <tr id="trashData{{$diagnos_exits_aa->id}}">--}}
{{--                            <td>{{$diagnos_exits_aa->disease_name->name}}</td>--}}
{{--                            <td>{{$diagnos_exits_aa->diagnoses_comments}}</td>--}}
{{--                            <td>--}}
{{--                                <button class="btn btn-danger btn-sm clickTrash" type="button"--}}
{{--                                        onclick="clickTrash({{$diagnos_exits_aa->id}})">--}}
{{--                                    <x-svg icon="cui-trash"/>--}}
{{--                                </button>--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                    @endforeach--}}


{{--                    </tbody>--}}
{{--                </table>--}}
{{--                <strong >ա․ Ավելացնել նոր Հիմնական՝</strong>--}}
{{--                <x-forms.add-reduce-button type="add" data-row=".first-diagnosis-row_a" data-limit="{{$repeatables}}"/>--}}
{{--                <x-forms.add-reduce-button type="reduce" data-row=".first-diagnosis-row_a"/>--}}
{{--                <x-forms.hidden-counter class="first-diagnosis-rows" name="first_diagnosis_length_a"/>--}}

{{--                @for ($i = 0; $i < $repeatables; $i++)--}}
{{--                    <div class="container first-diagnosis-row_a {{$i>0 ? 'd-none' : ''}}">--}}
{{--                        <div class="my-2">--}}
{{--                            <x-forms.magic-search class="magic-search ajax"--}}
{{--                                                  hidden-id="first_diagnosis_id_a{{ $i }}" hidden-name="first_diagnosis_a[]"  validationType="ajax" data-catalog-name="diseases"--}}
{{--                                                  placeholder="Ընտրել ախտորոշումը․․․"/>--}}
{{--                        </div>--}}
{{--                        <x-forms.text-field type="textarea" name="first_diagnosis_comment_a[]"  validationType="ajax" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"--}}
{{--                                            value="" label="" />--}}

{{--                    </div>--}}
{{--                @endfor--}}

{{--            </li>--}}

{{--            <li class="list-group-item">--}}
{{--                <strong >բ․ Բարդություններ՝</strong>--}}
{{--                <table class="table" border="2">--}}
{{--                    <thead>--}}
{{--                    <tr>--}}
{{--                        <th>Ախտորոշում</th>--}}
{{--                        <th>գրառման</th>--}}
{{--                        <th>ջնջել</th>--}}
{{--                    </tr>--}}
{{--                    </thead>--}}
{{--                    <tbody>--}}

{{--                    @foreach($diagnostic_ab as $diagnos_exits_ab)--}}
{{--                        <tr id="trashData{{$diagnos_exits_ab->id}}">--}}
{{--                            <td>{{$diagnos_exits_ab->disease_name->name ?? ' '}}</td>--}}
{{--                            <td>{{$diagnos_exits_ab->diagnoses_comments}}</td>--}}
{{--                            <td>--}}
{{--                                <button class="btn btn-danger btn-sm clickTrash" type="button"--}}
{{--                                        onclick="clickTrash({{$diagnos_exits_ab->id}})">--}}
{{--                                    <x-svg icon="cui-trash"/>--}}
{{--                                </button>--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                    @endforeach--}}


{{--                    </tbody>--}}
{{--                </table>--}}
{{--                <strong >բ․Ավելացնել նոր Բարդություններ՝</strong>--}}
{{--                <x-forms.add-reduce-button type="add" data-row=".first-diagnosis-row_b" data-limit="{{$repeatables}}"/>--}}
{{--                <x-forms.add-reduce-button type="reduce" data-row=".first-diagnosis-row_b"/>--}}
{{--                <x-forms.hidden-counter class="first-diagnosis-rows" name="first_diagnosis_length_b"/>--}}

{{--                @for ($i = 0; $i < $repeatables; $i++)--}}
{{--                    <div class="container first-diagnosis-row_b {{$i>0 ? 'd-none' : ''}}">--}}
{{--                        <div class="my-2">--}}
{{--                            <x-forms.magic-search class="magic-search ajax"--}}
{{--                                                  hidden-id="first_diagnosis_id_b{{ $i }}" hidden-name="first_diagnosis_b[]"  validationType="ajax" data-catalog-name="diseases"--}}
{{--                                                  placeholder="Ընտրել ախտորոշումը․․․"/>--}}
{{--                        </div>--}}
{{--                        <x-forms.text-field type="textarea" name="first_diagnosis_comment_b[]"  validationType="ajax" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"--}}
{{--                                            value="" label="" />--}}

{{--                    </div>--}}
{{--                @endfor--}}

{{--            </li>--}}

{{--            <li class="list-group-item">--}}
{{--                <strong>գ․ Ուղեկցող հիվանդություններ՝</strong>--}}
{{--                <table class="table" border="2">--}}
{{--                    <thead>--}}
{{--                    <tr>--}}
{{--                        <th>Ախտորոշում</th>--}}
{{--                        <th>գրառման</th>--}}
{{--                        <th>ջնջել</th>--}}
{{--                    </tr>--}}
{{--                    </thead>--}}
{{--                    <tbody>--}}

{{--                    @foreach($diagnostic_ac as $diagnos_exits_ac)--}}
{{--                        <tr id="trashData{{$diagnos_exits_ac->id}}">--}}
{{--                            <td>{{$diagnos_exits_ac->disease_name->name ?? ' '}}</td>--}}
{{--                            <td>{{$diagnos_exits_ac->diagnoses_comments}}</td>--}}
{{--                            <td>--}}
{{--                                <button class="btn btn-danger btn-sm clickTrash" type="button"--}}
{{--                                        onclick="clickTrash({{$diagnos_exits_ac->id}})">--}}
{{--                                    <x-svg icon="cui-trash"/>--}}
{{--                                </button>--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                    @endforeach--}}


{{--                    </tbody>--}}
{{--                </table>--}}
{{--                <strong>գ․ Ավելացնել նոր Ուղեկցող հիվանդություններ՝</strong>--}}
{{--                <x-forms.add-reduce-button type="add" data-row=".first-diagnosis-row_c" data-limit="{{$repeatables}}"/>--}}
{{--                <x-forms.add-reduce-button type="reduce" data-row=".first-diagnosis-row_c"/>--}}
{{--                <x-forms.hidden-counter class="first-diagnosis-rows" name="first_diagnosis_length_c"/>--}}

{{--                @for ($i = 0; $i < $repeatables; $i++)--}}
{{--                    <div class="container first-diagnosis-row_c {{$i>0 ? 'd-none' : ''}}">--}}
{{--                        <div class="my-2">--}}
{{--                            <x-forms.magic-search class="magic-search ajax"--}}
{{--                                                  hidden-id="first_diagnosis_id_c{{ $i }}" hidden-name="first_diagnosis_c[]"  validationType="ajax" data-catalog-name="diseases"--}}
{{--                                                  placeholder="Ընտրել ախտորոշումը․․․"/>--}}
{{--                        </div>--}}
{{--                        <x-forms.text-field type="textarea" name="first_diagnosis_comment_c[]"  validationType="ajax" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"--}}
{{--                                            value="" label="" />--}}

{{--                    </div>--}}
{{--                @endfor--}}
{{--            </li>--}}

{{--            <li class="list-group-item">--}}
{{--                <div class="text-center"><h5>Ախտաբանական անատոմիական</h5> </div>--}}
{{--            </li>--}}

{{--            <li class="list-group-item">--}}
{{--                <strong >ա․ Հիմնական՝</strong>--}}
{{--                <table class="table" border="2">--}}
{{--                    <thead>--}}
{{--                    <tr>--}}
{{--                        <th>Ախտորոշում</th>--}}
{{--                        <th>գրառման</th>--}}
{{--                        <th>ջնջել</th>--}}
{{--                    </tr>--}}
{{--                    </thead>--}}
{{--                    <tbody>--}}

{{--                    @foreach($diagnostic_ba as $diagnos_exits_ba)--}}
{{--                        <tr id="trashData{{$diagnos_exits_ba->id}}">--}}
{{--                            <td>{{$diagnos_exits_ba->disease_name->name ?? ' '}}</td>--}}
{{--                            <td>{{$diagnos_exits_ba->diagnoses_comments}}</td>--}}
{{--                            <td>--}}
{{--                                <button class="btn btn-danger btn-sm clickTrash" type="button"--}}
{{--                                        onclick="clickTrash({{$diagnos_exits_ba->id}})">--}}
{{--                                    <x-svg icon="cui-trash"/>--}}
{{--                                </button>--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                    @endforeach--}}


{{--                    </tbody>--}}
{{--                </table>--}}
{{--                <x-forms.add-reduce-button type="add" data-row=".first-diagnosis-row_ba" data-limit="{{$repeatables}}"/>--}}
{{--                <x-forms.add-reduce-button type="reduce" data-row=".first-diagnosis-row_ba"/>--}}
{{--                <x-forms.hidden-counter class="first-diagnosis-rows" name="first_diagnosis_length_ba"/>--}}

{{--                @for ($i = 0; $i < $repeatables; $i++)--}}
{{--                    <div class="container first-diagnosis-row_ba {{$i>0 ? 'd-none' : ''}}">--}}
{{--                        <div class="my-2">--}}
{{--                            <x-forms.magic-search class="magic-search ajax"--}}
{{--                                                  hidden-id="first_diagnosis_id_ba{{ $i }}" hidden-name="first_diagnosis_ba[]"  validationType="ajax" data-catalog-name="diseases"--}}
{{--                                                  placeholder="Ընտրել ախտորոշումը․․․"/>--}}
{{--                        </div>--}}
{{--                        <x-forms.text-field type="textarea" name="first_diagnosis_comment_ba[]"  validationType="ajax" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"--}}
{{--                                            value="" label="" />--}}

{{--                    </div>--}}
{{--                @endfor--}}

{{--            </li>--}}

{{--            <li class="list-group-item">--}}
{{--                <strong >բ․ Բարդություններ՝</strong>--}}
{{--                <table class="table" border="2">--}}
{{--                    <thead>--}}
{{--                    <tr>--}}
{{--                        <th>Ախտորոշում</th>--}}
{{--                        <th>գրառման</th>--}}
{{--                        <th>ջնջել</th>--}}
{{--                    </tr>--}}
{{--                    </thead>--}}
{{--                    <tbody>--}}

{{--                    @foreach($diagnostic_bb as $diagnos_exits_bb)--}}
{{--                        <tr id="trashData{{$diagnos_exits_bb->id}}">--}}
{{--                            <td>{{$diagnos_exits_bb->disease_name->name ?? ' '}}</td>--}}
{{--                            <td>{{$diagnos_exits_bb->diagnoses_comments}}</td>--}}
{{--                            <td>--}}
{{--                                <button class="btn btn-danger btn-sm clickTrash" type="button"--}}
{{--                                        onclick="clickTrash({{$diagnos_exits_bb->id}})">--}}
{{--                                    <x-svg icon="cui-trash"/>--}}
{{--                                </button>--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                    @endforeach--}}


{{--                    </tbody>--}}
{{--                </table>--}}
{{--                <strong >բ․ Ավելացնել նոր Բարդություններ՝</strong>--}}

{{--                <x-forms.add-reduce-button type="add" data-row=".first-diagnosis-row_bb" data-limit="{{$repeatables}}"/>--}}
{{--                <x-forms.add-reduce-button type="reduce" data-row=".first-diagnosis-row_bb"/>--}}
{{--                <x-forms.hidden-counter class="first-diagnosis-rows" name="first_diagnosis_length_bb"/>--}}

{{--                @for ($i = 0; $i < $repeatables; $i++)--}}
{{--                    <div class="container first-diagnosis-row_bb {{$i>0 ? 'd-none' : ''}}">--}}
{{--                        <div class="my-2">--}}
{{--                            <x-forms.magic-search class="magic-search ajax"--}}
{{--                                                  hidden-id="first_diagnosis_id_bb{{ $i }}" hidden-name="first_diagnosis_bb[]"  validationType="ajax" data-catalog-name="diseases"--}}
{{--                                                  placeholder="Ընտրել ախտորոշումը․․․"/>--}}
{{--                        </div>--}}
{{--                        <x-forms.text-field type="textarea" name="first_diagnosis_comment_bb[]"  validationType="ajax" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"--}}
{{--                                            value="" label="" />--}}

{{--                    </div>--}}
{{--                @endfor--}}

{{--            </li>--}}

{{--            <li class="list-group-item">--}}
{{--                <strong>գ․ Ուղեկցող հիվանդություններ՝</strong>--}}
{{--                <table class="table" border="2">--}}
{{--                    <thead>--}}
{{--                    <tr>--}}
{{--                        <th>Ախտորոշում</th>--}}
{{--                        <th>գրառման</th>--}}
{{--                        <th>ջնջել</th>--}}
{{--                    </tr>--}}
{{--                    </thead>--}}
{{--                    <tbody>--}}

{{--                    @foreach($diagnostic_bc as $diagnos_exits_bc)--}}
{{--                        <tr id="trashData{{$diagnos_exits_bc->id}}">--}}
{{--                            <td>{{$diagnos_exits_bc->disease_name->name ?? ' '}}</td>--}}
{{--                            <td>{{$diagnos_exits_bc->diagnoses_comments}}</td>--}}
{{--                            <td>--}}
{{--                                <button class="btn btn-danger btn-sm clickTrash" type="button"--}}
{{--                                        onclick="clickTrash({{$diagnos_exits_bc->id}})">--}}
{{--                                    <x-svg icon="cui-trash"/>--}}
{{--                                </button>--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                    @endforeach--}}


{{--                    </tbody>--}}
{{--                </table>--}}
{{--                <strong>գ․ Ավելացնել նոր Ուղեկցող հիվանդություններ՝</strong>--}}
{{--                <x-forms.add-reduce-button type="add" data-row=".first-diagnosis-row_bc" data-limit="{{$repeatables}}"/>--}}
{{--                <x-forms.add-reduce-button type="reduce" data-row=".first-diagnosis-row_bc"/>--}}
{{--                <x-forms.hidden-counter class="first-diagnosis-rows" name="first_diagnosis_length_bc"/>--}}

{{--                @for ($i = 0; $i < $repeatables; $i++)--}}
{{--                    <div class="container first-diagnosis-row_bc {{$i>0 ? 'd-none' : ''}}">--}}
{{--                        <div class="my-2">--}}
{{--                            <x-forms.magic-search class="magic-search ajax"--}}
{{--                                                  hidden-id="first_diagnosis_id_bc{{ $i }}" hidden-name="first_diagnosis_bc[]"  validationType="ajax" data-catalog-name="diseases"--}}
{{--                                                  placeholder="Ընտրել ախտորոշումը․․․"/>--}}
{{--                        </div>--}}
{{--                        <x-forms.text-field type="textarea" name="first_diagnosis_comment_bc[]"  validationType="ajax" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"--}}
{{--                                            value="" label="" />--}}

{{--                    </div>--}}
{{--                @endfor--}}
{{--            </li>--}}

            <li class="list-group-item">
                <div class="form-row align-items-center">

                    <strong>Մահվան դեպքում նշել պատճառը</strong>


            </li>

            <li class="list-group-item">
                <div class="col-md-12 mt-2">
                    <x-forms.text-field type="textarea" name="died_a_comment" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                    value="{{$descharge->died_a_comment}}" label="1․ ա/ Մահվան անմիջական պատճառը (հիվանդության կամ հիմնական հիվանդության բորդություն)"  />
                </div>
            </li>

            <li class="list-group-item">
                    <div class="col-md-12">
                        <x-forms.text-field type="textarea" name="died_b_comment" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                        value="{{$descharge->died_b_comment}}" label="բ/ Մահվան անմիջական պատճառը (հիվանդության կամ հիմնական հիվանդության բորդություն)"  />
                    </div>
            </li>

{{--            <li class="list-group-item">--}}
{{--                    <div class="col-md-12">--}}
{{--                        <x-forms.text-field type="textarea" name="died_c_comment" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"--}}
{{--                        value="{{$descharge->died_c_comment}}" label="գ/Հիմնական հիվանդություն "  />--}}
{{--                    </div>--}}
{{--            </li>--}}

            <li class="list-group-item">
                    <div class="col-md-12">
                        <x-forms.text-field type="textarea" name="died_d_comment" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                        value="{{$descharge->died_d_comment}}" label="2/ Ուրիշ կարևոր հիվանդություններ, որոնք նպաստել են մահացու ելքին, բայց կապված չեն մահվան անմիջական պատճառ հանդիսացած հիվանդության հետ"  />
                    </div>
            </li>


{{--            <li class="list-group-item list-group-item-info">--}}
{{--                <div class="text-center"><h4>Վիրահատություններ</h4> </div>--}}
{{--            </li>--}}

{{--            <li class="list-group-item">--}}
{{--                <x-forms.text-field name="surgery_datetime" type="datetime-local" value="{{\Illuminate\Support\Carbon::parse($descharge->surgery_datetime)->format('Y-m-d\TH:i')}}"--}}
{{--                                    validationType="ajax" label="" class="mt-2" />--}}

{{--                <div class="my-2">--}}
{{--                    <x-forms.magic-search class="magic-search ajax" value='{{$descharge->surgery_id}}' hidden-id="surgery_id"--}}
{{--                        hidden-name="surgery_id" data-catalog-name="surgeries"  validationType="ajax" placeholder="ընտրել վիրահատությունը․․․" />--}}
{{--                </div>--}}
{{--                <x-forms.text-field type="textarea" name="surgery_comment" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"--}}
{{--                    value="{{$descharge->surgery_comment}}" label="" />--}}


{{--            </li>--}}

            <li class="list-group-item">
                <div><strong>RW հետազոտության ամսաթիվը</strong> </div>

                <div class="mt-2">
                    <x-forms.text-field name="RW_date" validationType="ajax" type="date"
                        value="{{\Illuminate\Support\Carbon::parse($descharge->date)->format('Y-m-d')}}" label="" />
                </div>
            </li>

            <li class="list-group-item">
                <div class="">
                    <x-forms.text-field type="textarea" name="result" placeholder="լրացման ազատ դաշտ․․․" class=""
                    value="{{$descharge->result}}" label="Արդյունքը" />
                </div>
            </li>

            <li class="list-group-item">
                <div class="row">
                    <div class="col-md-12 ">
                        <strong>Հայրենական պատերազմի հաշմանդամ</strong>
                    </div>
                    <div class="col-md-12 mt-2">
                        <x-forms.checkbox-radio pos="align" id="armenia_war_invalid1" value="yes"  check="{{$descharge->armenia_war_invalid=='yes'}}" name="armenia_war_invalid" label="Այո"/>
                        <x-forms.checkbox-radio pos="align" id="armenia_war_invalid2" value="no"  check="{{$descharge->armenia_war_invalid=='no'}}" name="armenia_war_invalid" label="Ոչ"/>
                    </div>
                </div>
            </li>

            <li class="list-group-item">
                <div class="row">
                    <div class="col-md-12 ">
                        <strong>Արցախյան պատերազմի հաշմանդամ</strong>
                    </div>
                    <div class="col-md-12 mt-2">
                        <x-forms.checkbox-radio pos="align" id="arcax_war_invalid1" value="yes"  check="{{$descharge->arcax_war_invalid=='yes'}}" name="arcax_war_invalid" label="Այո"/>
                        <x-forms.checkbox-radio pos="align" id="arcax_war_invalid2" value="no" check="{{$descharge->arcax_war_invalid=='no'}}" name="arcax_war_invalid" label="Ոչ"/>
                    </div>
                </div>
            </li>

            <li class="list-group-item">
                <strong>Հետազոտությունը իրականացնող բժիշկ</strong>
                <x-forms.magic-search hidden-id="attending_doctor_id" hidden-name="attending_doctor_id"
                placeholder="Ընտրել բուժող բժիշկին․․․" class="my-2 user_search" value="{{$descharge->attending_doctor_id}}"/>
                <em class="error text-danger" data-input="attending_doctor_id"></em>
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
            url: '{{url('samples/trash/stationaryDiagnostic/')}}'+'/'+data,
            type:"get",
            success: function (data) {
                $('#trashData'+data).remove()
            }
        });
    }
</script>
@endsection
