@extends('layouts.cardBase')

@section('card-header')
<div class="text-center">
    <h3>Create/Update/Edit Patient</h3>
</div>
@endsection
@section('card-content')
<div class="container">
    <form action="{{ route('patients.store') }}" id="patient-create-form" class="ajax-submitable" method="POST">

        @csrf
        <ul class="list-group">
            <li class="list-group-item">
                <div class="form-row">
                    <div class="form-group col-sm-12 col-md-4">
                        <x-forms.text-field name="f_name" label="Անուն" validationType="ajax" value="{{old('f_name')}}" />
                    </div>
                    <div class="form-group col-sm-12 col-md-4">
                        <x-forms.text-field name="l_name" label="Ազգանուն" validationType="ajax" value="{{old('l_name')}}" />
                    </div>
                    <div class="form-group col-sm-12 col-md-4">
                        <x-forms.text-field name="p_name" label="Հայրանուն" validationType="ajax" value="{{old('p_name')}}" />
                    </div>
                </div>
            </li>

            <li class="list-group-item">
                <div class="form-row">
                    <div class="form-group col-sm-12 col-md-4">
                        <x-forms.text-field name="birth_date" type="date" label="Ծն․ ամսաթիվ" validationType="ajax" value="{{old('birth_date')}}" />
                    </div>
                    <div class="form-group col-sm-12 col-md-4">
                        <x-forms.text-field name="soc_card" maxlength="10" minlength="10" type="text" label="ՀԾՀ" validationType="ajax" value="{{old('soc_card')}}" />
                    </div>
                    <div class="form-group col-sm-12 col-md-4">
                        <x-forms.text-field name="email" type="email" label="Էլ․ հասցե" validationType="ajax" value="{{old('email')}}" />
                    </div>
                </div>
            </li>

            <li class="list-group-item">
                <div class="form-row">
                    <div class="form-group col-sm-12 col-md-4">
                        <x-forms.text-field name="residence_region" label="Մարզ" validationType="ajax" value="{{old('residence_region')}}" />
                    </div>
                    <div class="form-group col-sm-12 col-md-4">
                        <x-forms.text-field name="town_village" label="Քաղաք/Գյուղ" validationType="ajax" value="{{old('town_village')}}" />
                    </div>
                    <div class="form-group col-sm-12 col-md-4">
                        <x-forms.text-field name="street_house" label="Փողոց/Շենք" validationType="ajax" value="{{old('street_house')}}" />
                    </div>
                </div>
            </li>

            <li class="list-group-item">
                <div class="form-row">
                    <div class="form-group col-sm-12 col-md-6">
                        {{--<x-forms.text-field name="m_phone" label="Հեռ․ Բջջային" validationType="ajax" value="" />--}}
                       <label style="font-weight: bold">Հեռ․ Բջջային</label>
                        <input type="number" class="form-control" name="m_phone" value="{{old('m_phone')}}">
                    </div>
                    <div class="form-group col-sm-12 col-md-6">
                        {{--<x-forms.text-field name="c_phone" label="Հեռ․ Քաղաք" validationType="ajax" value="" />--}}
                        <label style="font-weight: bold">Հեռ․ Քաղաք</label>
                        <input type="number" class="form-control" name="c_phone" value="{{old('c_phone')}}">
                    </div>
                </div>
            </li>

            <li class="list-group-item">
                <div class="form-row">
                    <div class="form-group col-sm-12 col-md-4">
                        <x-forms.text-field name="nationality" label="Ազգություն" validationType="ajax" value="{{old('nationality')}}" />
                    </div>
                    <div class="form-group col-sm-12 col-md-4">
                        <x-forms.text-field name="blood_group" type="number" min="1" max="4" label="Արյան խումբ" validationType="ajax" value="{{old('blood_group')}}" />
                    </div>
                    <div class="form-group col-sm-12 col-md-4">
                        <label><strong>RH գործոն</strong></label>
                        <select name="rh_factor" class="form-control">
                            <option value="1" >Դրական</option>
                            <option value="0">Բացասական</option>
                        </select>
                    </div>
                </div>
            </li>
            {{-- @dump(empty($patient->is_male)) --}}
            <li class="list-group-item">
                <div class="form-row">
                    <div class="form-group col-sm-12 col-md-6">
                        <x-forms.text-field name="passport" label="Անձնագիր" validationType="ajax" value="{{old('passport')}}" />
                    </div>
                    <div class="form-group col-sm-12 col-md-6">
                        <label><strong>Սեռ</strong></label>
                        <select name="is_male" class="form-control">
                            <option></option>
                            <option value="0" >Կին</option>
                            <option value="1" >Տղամարդ</option>
                        </select>
                    </div>
                    <label><strong>Արխիվ</strong></label>
                    <select name="archive" class="form-control">
                        <option></option>
                        <option value="0">Ոչ</option>
                        <option value="1">Այո</option>
                    </select>
                </div>
            </li>

            @include('shared.forms.list_group_item_submit',['btn_text'=>'Ավելացնել'])
        </ul>
    </form>
</div>
@endsection
