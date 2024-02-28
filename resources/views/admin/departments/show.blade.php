@extends('layouts.AdminCardBase')

@section('css')
<link rel="stylesheet" href="{{mix('/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{mix("/css/jquery.magicsearch.min.css")}}"/>
@endsection

@section('card-header')
@section('card-header-classes', '')
<div class="text-center">
    <h3>{{ $department->name }}</h3>
</div>
@endsection

@section('card-content')
<div class="nav-tabs-boxed">
    <ul class="list-group">
        <li class="list-group-item">
            <div class="form-row">
                <div class="form-group col-sm-12 col-md-12">
                    <x-forms.text-field disabled name="name" label="Անուն"  value="{{ $department->name }}" />
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-sm-12 col-md-4">

                    <div class="checkbox">
                        <label>
                            <input disabled {{ $department->has_bads ? 'checked' : '' }} id="has_bads" type="checkbox" name="has_bads" value="has_bads"> Մահճակալ
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-sm-12 col-md-4">

                    <div class="checkbox">
                        <label>
                            <input disabled {{ $department->closed_from_inside ? 'checked' : '' }} id="closed_from_inside" type="checkbox" name="closed_from_inside" value="closed_from_inside"> Հաստատուն կենտրոնացված է
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-sm-12 col-md-4">

                    <div class="checkbox">
                        <label>
                            <input disabled {{ $department->closed_from_outside ? 'checked' : '' }} id="closed_from_outside" type="checkbox" name="closed_from_outside" value="closed_from_outside"> Բաշխված կենտրոնացված է
                        </label>
                    </div>
                </div>
            </div>
        </li>

    </ul>
</div>
@endsection

@section('javascript')
<script src="{{mix('/js/jquery.js')}}"></script>
<script src="{{mix('/js/datatables.js')}}"></script>
<script src="{{ mix('js/all.magicsearch.js') }}"></script>
@endsection
