@extends('layouts.cardBase')

@section('css')
<link href="{{mix("/css/tail.select-default.css")}}" rel="stylesheet" />
@endsection

@section('card-header')
Հիվանդներ | {{$patient->full_name}}
@endsection

@section('card-content')

<form action="{{route('patients.ambulator.store', ["patient" => $patient])}}" method="POST">
    @csrf
    <div class="row">
        <div class="form-group col-sm-12 col-md-6">

            <x-forms.text-field name="registration_date" value="{{now()->format('Y-m-d')}}" type="date"
                label="Հաշվառման վերցնելու ամսաթիվ" />
        </div>
        <div class="form-group col-sm-12 col-md-6">
            <label>Կլինիկական խումբ</label>
            <select name="cancer_group" class="form-control">
                @foreach ($cancer_groups as $cancer_group)
                <option value="{{$cancer_group->id}}">{{$cancer_group->name}}</option>
                @endforeach
            </select>
            @error('cancer_group')
            <em class="error text-danger">{{$message}}</em>
            @enderror
        </div>
    </div>

    <div class="form-group">
        <label>Վնասակար սովորություններ</label>
        <select class="form-control" name="harmfuls">
            @forelse ($harmfuls as $harmful)
            <option value="{{$harmful->id}}">{{$harmful->name}}</option>
            @empty

            @endforelse
        </select>
        @error('harmfuls')
        <em class="error text-danger">{{$message}}</em>
        @enderror
    </div>

    <h5>Հիվանդը դիմել է առաջին անգամ</h5>
    <div class="row">
        <div class="form-group col-sm-12 col-md-6">
            <label>Որտեղ</label>
            <select class="form-control" name="first_clinic">
                @forelse ($clinics as $clinic)
                <option value="{{$clinic->id}}">{{$clinic->name}}</option>
                @empty

                @endforelse
            </select>
            @error('first_clinic')
            <em class="error text-danger">{{$message}}</em>
            @enderror
        </div>
        <div class="form-group col-sm-12 col-md-6">
            <x-forms.text-field name="first_clinic_date" type="date" label="Երբ" />
        </div>
    </div>

    <h5>Հիվանդությունը առաջին անգամ հայտնաբերվել է</h5>
    <div class="row">
        <div class="form-group col-sm-12 col-md-6">
            <label>Որտեղ</label>
            <select class="form-control" name="first_discovered">
                @forelse ($clinics as $clinic)
                <option value="{{$clinic->id}}">{{$clinic->name}}</option>
                @empty

                @endforelse
            </select>
            @error('first_discovered')
            <em class="error text-danger">{{$message}}</em>
            @enderror
        </div>
        <div class="form-group col-sm-12 col-md-6">
            <x-forms.text-field name="first_discovered_date" type="date" label="Երբ" />
        </div>
    </div>

    <div class="form-group">
        <x-forms.text-field name="past_treatments" type="textarea" label="Նախկինում ստացած բուժումներ" />
    </div>

    <button class="btn btn-primary">
        Ուղարկել
    </button>
</form>

@endsection


@section('javascript')
<script src="{{mix('/js/select-pure.js')}}"></script>
@endsection
