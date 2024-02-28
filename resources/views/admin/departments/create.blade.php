@extends('layouts.AdminCardBase')

@section('css')
<link href="{{mix("/css/jquery.magicsearch.min.css")}}" rel="stylesheet" />
@endsection


@section('card-header')
@section('card-header-classes', '')
<div class="text-center">
    <h3>Ավելացնել բաժին</h3>
</div>
@endsection


@section('card-content')

<div class="container">
    <form action="{{route('admin.departments.store')}}" method="POST">
        @csrf
        <ul class="list-group">
            <li class="list-group-item">
                <div class="form-row">
                    <div class="form-group col-sm-12 col-md-12">
                        <x-forms.text-field name="name" label="Անուն"  value="{{ old('name') }}" />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-12 col-md-4">

                        <div class="checkbox">
                            <label>
                                <input id="agree" type="checkbox" name="has_bads" value="has_bads"> Մահճակալ
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-sm-12 col-md-4">

                        <div class="checkbox">
                            <label>
                                <input id="agree" type="checkbox" name="closed_from_inside" value="closed_from_inside"> կենտրոնացված / անհատական  {{--Հաստոտում, չեկբոքսը դնելուբ գրում ենք հաստատված է--}}
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-sm-12 col-md-4">

                        <div class="checkbox">
                            <label>
                                <input id="agree" type="checkbox" name="closed_from_outside" value="closed_from_outside"> Բաշխումը կենտրանացված է {{--Բաշխում--}}
                            </label>
                        </div>
                    </div>
                </div>
            </li>

            @include('shared.forms.list_group_item_submit')
        </ul>
    </form>
</div>

@endsection

@section('javascript')
<script src="{{ mix('js/jquery.js') }}"></script>
<script src="{{ mix('js/all.magicsearch.js') }}"></script>
@endsection
