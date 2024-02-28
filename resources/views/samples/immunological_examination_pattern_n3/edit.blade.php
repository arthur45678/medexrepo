@extends('layouts.cardBase')


@section('css')
<link href="{{mix("/css/jquery.magicsearch.min.css")}}" rel="stylesheet" />
@endsection


@section('card-header')
@section('card-header-classes', '')

<div class="text-center">
    <h3>ԻՄՈՒՆԱԲԱՆԱԿԱՆ ԼԱԲՈՐԱՏՈՐԻԱ ԲԺՇԿԱԿԱՆ ՁԵՎ N 3</h3>
</div>
@endsection


@section('card-content')

<div class="container">
    <form  action="{{route('samples.patients.iep-n3.update',[$immunologia->id,$patent->id])}}" method="POST" class="ajax-submitable">
        @csrf
        @method('put')
        <ul class="list-group">
            <li class="list-group-item">
                <div class="form-row align-items-center">
                    <div class="col-md-6">
                        <strong>ԻՄՈՒՆԱԲԱՆԱԿԱՆ  հետազոտություն № </strong>
                    </div>
                    <ins class="ml-4">{{$immunologia->research}}</ins>
                </div>
            </li>
            <li class="list-group-item">
                <div class="form-row align-items-center">
                    <div class="col-md-4">
                        <strong>Կենսանյութը վերցնելու ամսաթիվ</strong>
                    </div>
                    <div class="col-md-8">
                        <x-forms.text-field name="date" validation-type="ajax" type="datetime-local"
                            value="{{\Illuminate\Support\Carbon::parse($immunologia->date)->format('Y-m-d\TH:i')}}" label="" />
                        @error('date')
                        <em class="error text-danger">Կենսանյութը վերցնելու ամսաթիվ դաշտը պարտադիր է։</em>
                        @enderror
                    </div>
                </div>
            </li>
            <li class="list-group-item ">
               <div class="form-row">
                    <div class="col-md-6">
                        <input type="hidden" name="patient_id" value="{{$patent->id}}">
                        <input type="hidden" name="user_id" value="{{auth()->id()}}">
                        <input type="hidden" name="immunologia" value="{{$immunologia->id}}">
                        <strong>
                         Ազգանուն, անուն, հայրանուն
                        </strong>
                        <ins class="ml-4">{{$patent->full_name}}</ins>

                    </div>
                    <div class="col-md-6">
                        <strong>
                            Տարիք
                        </strong>

                        <ins class="ml-4">{{$patent->birth_date}}</ins>
                    </div>
               </div>
            </li>
            <li class="list-group-item">
                <strong>Բաժանմունք՝</strong>
                <div class="my-2">
                    <x-forms.magic-search class="magic-search ajax" value='{{$immunologia->department_id}}' hidden-id="department_id" validationType="ajax"
                                          hidden-name="department_id" data-catalog-name="departments" placeholder="ընտրել բաժանմունքը․․․" />
                    <em class="error text-danger" data-input="department_id"></em>
                </div>
            </li>
            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="number" name="hospital_room_number" min="0" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                    value="{{$immunologia->hospital_room_number}}" label="Պալատ" />
                    @error('hospital_room_number')
                    <em class="error text-danger">Պալատ դաշտը պարտադիր է։</em>
                    @enderror
                </div>
            </li>
            <li class="list-group-item">
                <strong>Ուղեգրող բժիշկ</strong>
                <x-forms.magic-search hidden-id="specialist_id" hidden-name="specialist"
                placeholder="Ընտրել բուժող բժիշկին․․․" class="magic-search ajax my-2" data-list-name="users"
                value="{{$immunologia->specialist}}" validationType="ajax" />
                <em class="error text-danger" data-input="specialist"></em>

            </li>
            <li class="list-group-item">
                <strong>Ամբուլատոր բժշկական քարտի № {{$amboulator->number ?? ' '}}</strong>
                <input type="hidden" name="ambulator_id" value="{{$amboulator->id ?? ''}}">

            </li>
            <li class="list-group-item">
                <strong>Հիվանդության պատմագրի № </strong>
                <select name="stationary_id" id="">
                    @foreach($stationarie as $stationaries)
                        @if($stationaries->id==$immunologia->stationary_id)
                            <option value="{{$stationaries->id}}" selected>{{$stationaries->number}}</option>
                        @else
                        <option value="{{$stationaries->id}}" >{{$stationaries->number}}</option>
                        @endif

                    @endforeach
                </select>
           </li>


            <li class="list-group-item list-group-item-info">
                <h4 class="text-center">
                    ՎԻՐՈՒՍԱՅԻՆ ԻՆՖԵԿՑԻԱՆԵՐԻ ՇՃԱԲԱՆԱԿԱՆ ՀԵՏԱԶՈՏՈՒԹՅՈՒՆ
                </h4>
            </li>
            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="textarea" name="HAV" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                                        value="{{$immunologia->HAV}}" label="HAV Ig M հեպատիտ A-ի հակամարմիններ" />
                </div>
            </li>
            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="textarea" name="HBsAg" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                                        value="{{$immunologia->HBsAg}}" label="HBsAg հեպատիտ B-ի մակերեսային հակածին" />
                </div>
            </li>
            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="textarea" name="aոti_HBcAg_b" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                                        value="{{$immunologia->aոti_HBcAg_b}}" label="Aոti HBcAg- հեպատիտ B-ի միջուկային հակամարմիններ" />
                </div>
            </li>
            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="textarea" name="aոti_HBcAg_Ig" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                                        value="{{$immunologia->aոti_HBcAg_Ig}}" label="Aոti HBcAg- Ig M, Ig G հեպատիտ B-ի միջուկային հակամարմիններ" />
                </div>
            </li>
            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="textarea" name="aոti_HBcAg_Hepatitis_b" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                                        value="{{$immunologia->aոti_HBcAg_Hepatitis_b}}" label="Aոti HBeAg- հեպատիտ B-ի միջուկային հակամարմիններ" />
                </div>
            </li>
            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="textarea" name="HCV_Hepatitis_C" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                                        value="{{$immunologia->HCV_Hepatitis_C}}" label="HCV հեպատիտ C- ի ընդ. հակամարմիններ" />
                </div>
            </li>
            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="textarea" name="MIAV" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                                        value="{{$immunologia->MIAV}}" label="Aոti HIV 1+2- ՄԻԱՎ-ի հակամարմիններ" />
                </div>
            </li>
            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="textarea" name="EBV" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                                        value="{{$immunologia->EBV}}" label="EBV Ig M / IgG _Էպշտեյն-Բարրի վիրուս հակամարմիններ" />
                </div>
            </li>
            <li class="list-group-item">
                <div class="form-row align-items-center">
                    <div class="col-md-4">
                        <strong>Հետազոտությունը կատարվել է</strong>
                    </div>
                    <div class="col-md-6">
                        <x-forms.text-field type="text" name="research_done" validation-type="ajax"
                                            value="{{$immunologia->research_done}}" label=""  placeholder="Լրացրեք ազատ դաշտը․․․" />
                    </div>
                    <div class="col-md-2">
                        <strong>վերլուծիչով</strong>
                    </div>
                </div>
            </li>
            <li class="list-group-item">
                <div class="form-row align-items-center">
                    <div class="col-md-6">
                        <strong>ԻՄՈՒՆԱԲԱՆԱԿԱՆ  հետազոտության պատասխանի ամսաթիվ</strong>
                    </div>
                    <div class="col-md-6">
                        <x-forms.text-field name="date_research" validation-type="ajax" type="datetime-local"
                            value="{{\Illuminate\Support\Carbon::parse($immunologia->date_research)->format('Y-m-d\TH:i')}}" label="" />
                    </div>
                </div>
            </li>
            <li class="list-group-item">
                <strong>Հետազոտությունը իրականացնող բժիշկ</strong>
                <x-forms.magic-search hidden-id="sender_doctor_id" hidden-name="attending_doctor"
                placeholder="Ընտրել բուժող բժիշկին․․․" class="magic-search ajax my-2" data-list-name="users"
                value="{{$immunologia->attending_doctor}}" />
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
