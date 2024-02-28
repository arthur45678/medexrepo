@extends('layouts.cardBase')

@section('css')
<link href="{{mix("/css/jquery.magicsearch.min.css")}}" rel="stylesheet" />
@endsection


@section('card-header')
@section('card-header-classes', '')

<div class="text-center">
    <h3>ՍՏԱՑԻՈՆԱՐ ՀԻՎԱՆԴԻ ՀԱՇՎԱՌՄԱՆ ԳՐԱՆՑԱՄԱՏՅԱՆ</h3>
</div>
@endsection


@section('card-content')

<div class="container">
    <form  action="{{route('samples.patients.stationary-inpatient-register.store',$patent->id)}}" method="POST">
        @csrf
        <ul class="list-group">
            <input type="hidden" name="patient_id" value="{{$patent->id}}">
            <input type="hidden" name="user_id" value="{{auth()->id()}}">
                <li class="list-group-item">
                    <strong>
                        No{{$research}}
                    </strong>
                    <input type="hidden" name="research" value="{{$research}}">
                    <ins class="ml-4"></ins>
                </li>
                    <li class="list-group-item">
                        <div class="form-row align-items-center">
                            <div class="col-md-6">
                                <strong>Հիվանդության պատմության թերթիկի No</strong>
                            </div>
                            <div class="col-md-6">
                                <select name="stationary_id" id="">
                                    @foreach($stationarie as $stationaries)
                                        <option value="{{$stationaries->id}}" >{{$stationaries->number}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="col-md-8">
                            <x-forms.checkbox-radio pos="align" id="wheelchair-radio1" value="pp" name="payment" label="Պ.Պ"/>
                            <x-forms.checkbox-radio pos="align" id="wheelchair-radio2" value="paid" name="payment" label="վճարովի"/>
                            @error('by_wheelchair')
                                <em class="error text-danger"></em>
                            @enderror
                        </div>
                        <div class="my-2">
                            <x-forms.text-field type="textarea" name="payment_info" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                            value="" label="" />
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="form-row align-items-center">
                            <div class="col-md-3">
                                <strong>Ընդունման ամսաթիվ</strong>
                            </div>
                            <div class="col-md-9">
                                <x-forms.text-field name="date" validation-type="ajax" type="datetime-local"
                                value="" label="" />
                            </div>
                        </div>
                    </li>
                        <li class="list-group-item">
                            <strong>
                                Հիվանդի Ազգանուն, անուն, հայրանուն
                            </strong>
                            <ins class="ml-4">{{$patent->full_name}}</ins>
                        </li>
                        <li class="list-group-item">
                                <strong>
                                    Տարիք
                                </strong>
                                <ins class="ml-4">{{$patent->birth_date}}</ins>
                            </li>
                        <li class="list-group-item">
                            <strong>
                                Մշտական բնակավայրը՝ քաղաք, գյուղ
                            </strong>
                            <ins class="ml-4">{{$patent->town_village}}</ins>
                        </li>
                        <li class="list-group-item">
                            <strong>
                                Հեռախոսահամար՝
                            </strong>
                            <ins class="ml-4">{{$patent->m_phone}}</ins>
                        </li>
                        <li class="list-group-item">
                            <strong>
                                Աշխատավայրը՝
                            </strong>
                            <ins class="ml-4">{{$patent->workplace}}</ins>
                        </li>
                    <li class="list-group-item">
                                <strong>
                                    Մասնագիտությունը կամ պաշտոնը՝
                                </strong>
                                <ins class="ml-4">{{$patent->profession}}</ins>
                    </li>
                    <li class="list-group-item">
                        <div class="collapse referring-institutuion-diagnosis">
                            <strong>
                                Ախտորոշում ընդունման պահին
                            </strong>
                            <x-forms.prev-posts-link href='' size='md' />
                            <button class="btn btn-primary float-right" type="button" data-toggle="collapse" data-target=".referring-institutuion-diagnosis">
                                <x-svg icon="cui-pencil" />
                            </button>
                        </div>
                        <div class="collapse show referring-institutuion-diagnosis">
                            <strong>
                            Ախտորոշում ընդունման պահին
                            </strong>
                            <x-forms.add-reduce-button type="add" data-row=".enter-row"/>
                            <x-forms.add-reduce-button type="reduce" data-row=".enter-row"/>
                            <x-forms.hidden-counter class="admission-rows" name="admission_enter_length"/>
                            @for($i = 0; $i < $repeatables; $i++)
                                <div class="enter-row {{ $i < old('admission_enter_length', 1) ? ' ' : 'd-none' }}">
                                    <div class="my-2">
                                        <x-forms.magic-search class="magic-search ajax" value='{{ old("enter_id.$i") }}' hidden-id="enter_id{{ $i }}"
                                                              hidden-name="enter_id[]" data-catalog-name="diseases" placeholder="ընտրել հիվանդությունը․․․" />
                                    </div>
                                    <x-forms.text-field type="textarea" name="enter_comment[]" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                                        value="" label="" />
                                </div>
                            @endfor
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="collapse referring-institutuion-diagnosis">
                            <strong>
                                Ախտորոշում դուրս գրման պահին
                            </strong>
                            <x-forms.prev-posts-link href='' size='md' />
                            <button class="btn btn-primary float-right" type="button" data-toggle="collapse" data-target=".referring-institutuion-diagnosis">
                                <x-svg icon="cui-pencil" />
                            </button>
                        </div>
                        <div class="collapse show referring-institutuion-diagnosis">
                            <strong>
                            Ախտորոշում դուրս գրման պահին
                            </strong>
                            <x-forms.add-reduce-button type="add" data-row=".admission-exit-row"/>
                            <x-forms.add-reduce-button type="reduce" data-row=".admission-exit-row"/>
                            <x-forms.hidden-counter class="admission-rows" name="admission_exit_length"/>
                            @for($i = 0; $i < $repeatables; $i++)
                                <div class="admission-exit-row {{ $i < old('admission_exit_length', 1) ? ' ' : 'd-none' }}">
                                    <div class="my-2">
                                        <x-forms.magic-search class="magic-search ajax" value='{{ old("exit_id.$i") }}' hidden-id="exit_id{{ $i }}"
                                                              hidden-name="exit_id[]" data-catalog-name="diseases" placeholder="ընտրել հիվանդությունը․․․" />
                                    </div>
                                    <x-forms.text-field type="textarea" name="exit_comment[]" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                                        value="" label="" />
                                </div>
                            @endfor
                        </div>
                    </li>
                    <li class="list-group-item">
                        <strong>
                            Բուժման ձև
                        </strong>
                            <div class="my-2">
                                <x-forms.magic-search class="treatments-search" data-catalog-name="treatments"  value=''
                                    hidden-id="treatment_other_type_id"  hidden-name="treatment_id"
                                    placeholder="ընտրել բուժման տեսակը․․․" />
                            </div>
                    </li>
                    <li class="list-group-item">
                        <div class="form-row align-items-center">
                            <div class="col-md-3">
                                <strong>Դուրս գրման ամսաթիվ</strong>
                            </div>
                            <div class="col-md-9">
                                <x-forms.text-field name="date_discharge" validation-type="ajax" type="datetime-local"
                                value="" label="" />
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="form-row align-items-center">
                            <div class="col-md-6">
                                <strong >Մահճակալ՝</strong>
                                <div class="my-2">
                                    <input  class="form-control" name="bed_id" placeholder="ընտրել մահճակալը․․․"
                                     style="max-width: 100%">
{{--                                    <x-forms.text-field id="bed_id" type="hidden" name="bed_id"--}}
{{--                                    value="" label="" />--}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <strong>Օրերի քանակ՝</strong>
                                <div class="my-2">
                                    <x-forms.text-field type="number" name="number_days"
                                    value="" min="0" label="" />
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <strong>Բուժման արդյունք</strong>
                        <div class="my-2">
                            <x-forms.text-field type="textarea" name="treatment_result" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                            value="" label="" />
                        </div>
                    </li>
                <li class="list-group-item">
                        <strong>Բուժող բժիշկ</strong>
                        <x-forms.magic-search hidden-id="r_attending_doctor_id" hidden-name="doctor"
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
    $('.treatments-search').magicsearch(
        window.medexMagicSearch.assignConfigs({
            dataSource: "/catalogs/treatments.json",
            type: "ajax",
            success: function($input, data) {
                const hidden_input_id = $input.data('hidden');
                $(hidden_input_id).val($input.attr("data-id"));
            }
        })
    );
</script>
<script>
    var repeatables = {{$repeatables}};
</script>
@endsection
