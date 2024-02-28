@extends('layouts.cardBase')

@section('css')
<link href="{{mix("/css/jquery.magicsearch.min.css")}}" rel="stylesheet" />
@endsection


@section('card-header')
@section('card-header-classes', '')
<div class="text-center">
    <h3>{{ $user->full_name }}</h3>
</div>
@endsection


@section('card-content')

<div class="container">
    <form class="ajax-submitable dont-reset" action="{{route('users.update', ['user'=> $user])}}" method="POST">
        @csrf
        @method("PATCH")
        <ul class="list-group">
            <li class="list-group-item">
                <div class="form-row">
                    <div class="form-group col-sm-12 col-md-4">
                        <x-forms.text-field name="f_name" label="Անուն" validationType="ajax" value="{{ $user->f_name }}" />
                    </div>
                    <div class="form-group col-sm-12 col-md-4">
                        <x-forms.text-field name="l_name" label="Ազգանուն" validationType="ajax" value="{{ $user->l_name }}" />
                    </div>
                    <div class="form-group col-sm-12 col-md-4">
                        <x-forms.text-field name="p_name" label="Հայրանուն" validationType="ajax" value="{{ $user->p_name }}" />
                    </div>
                </div>
            </li>

            <li class="list-group-item">
                <div class="form-row">
                    <div class="form-group col-sm-12 col-md-4">
                        <x-forms.text-field name="birth_date" type="date" label="Ծն․ ամսաթիվ" validationType="ajax" value="{{ $user->birth_date }}" />
                    </div>
                    <div class="form-group col-sm-12 col-md-4">
                        <x-forms.text-field name="soc_card" min="0" type="number" label="Հծհ" validationType="ajax" value="{{ $user->soc_card }}" />
                    </div>
                    <div class="form-group col-sm-12 col-md-4">
                        <x-forms.text-field name="email" type="email" label="Էլ․ հասցե" validationType="ajax" value="{{ $user->email }}" />
                    </div>
                </div>
            </li>

            <li class="list-group-item">
                <div class="form-row">
                    <div class="form-group col-sm-12 col-md-4">
                        <x-forms.text-field name="residence_region" label="Մարզ" validationType="ajax" value="{{ $user->residence_region }}" />
                    </div>
                    <div class="form-group col-sm-12 col-md-4">
                        <x-forms.text-field name="town_village" label="Քաղաք/Գյուղ" validationType="ajax" value="{{ $user->town_village }}" />
                    </div>
                    <div class="form-group col-sm-12 col-md-4">
                        <x-forms.text-field name="street_house" label="Փողոց/Շենք" validationType="ajax" value="{{ $user->street_house }}" />
                    </div>
                </div>
            </li>

            <li class="list-group-item">
                <div class="form-row">
                    <div class="form-group col-sm-12 col-md-6">
                        <x-forms.text-field name="m_phone" label="Հեռ․ Բջջային" validationType="ajax" value="{{ $user->m_phone }}" />
                    </div>
                    <div class="form-group col-sm-12 col-md-6">
                        <x-forms.text-field name="c_phone" label="Հեռ․ Քաղաքային" validationType="ajax" value="{{ $user->c_phone }}" />
                    </div>
                </div>
            </li>

            <li class="list-group-item">
                <div class="form-row">
                    <div class="form-group col-sm-12 col-md-4">
                        <label> <strong>Բաժին</strong></label>
                        <x-forms.magic-search class="magic-search ajax" data-catalog-name="departments"
                        hidden-name="department_id" hidden-id="department_id" placeholder="Ընտրել բաժինը․․․"
                        value='{{old("department_id", $user->department_id)}}'/>
                    </div>
                    <div class="form-group col-sm-12 col-md-4">
                        <x-forms.text-field name="degree" type="text" label="Գիտ․ աստիճան" validationType="ajax" value="{{ $user->degree }}" />
                    </div>
                    <div class="form-group col-sm-12 col-md-4">
                        <x-forms.text-field name="position" type="text" label="Պաշտոն" validationType="ajax" value="{{ $user->position }}" />
                    </div>
                </div>
            </li>

            <li class="list-group-item">
                <div class="form-row">
                    <div class="form-group col-sm-12 col-md-4">
                        <x-forms.text-field name="passport" label="Անձնագիր" validationType="ajax" value="{{ $user->passport }}" />
                    </div>
                    <div class="form-group col-sm-12 col-md-4">
                        <x-forms.text-field name="nationality" label="Ազգություն" validationType="ajax" value="{{ $user->nationality }}" />
                    </div>
                    <div class="form-group col-sm-12 col-md-4">
                        <label><strong>Սեռ</strong></label>
                        <select name="is_male" class="form-control">
                            <option value="">նշված չէ</option>
                            <option value="0" @if ($user->is_male === 0)
                                selected
                            @endif>Կին</option>
                            <option value="1" @if ($user->is_male === 1)
                                selected
                            @endif>Տղամարդ</option>
                        </select>
                    </div>
                </div>
            </li>

            @include('shared.forms.list_group_item_submit', ['btn_text' =>'Պահպանել փոփոխությունները'])
        </ul>
    </form>
</div>

@endsection

@section('javascript')
<script src="{{ mix('js/jquery.js') }}"></script>
<script src="{{ mix('js/all.magicsearch.js') }}"></script>
@endsection
