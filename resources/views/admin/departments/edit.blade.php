@extends('layouts.AdminCardBase')

@section('css')
<link href="{{mix("/css/jquery.magicsearch.min.css")}}" rel="stylesheet" />
@endsection


@section('card-header')
@section('card-header-classes', '')
<div class="text-center">
    <h3>Խմբագրել {{ $department->name }}</h3>
</div>
@endsection


@section('card-content')

<div class="container">
    <form class="ajax-submitable dont-reset" action="{{route('admin.departments.update', ['department'=> $department])}}" method="POST">
        @method("PATCH")
        <ul class="list-group">
            <li class="list-group-item">
                <div class="form-row">
                    <div class="form-group col-sm-12 col-md-12">
                        <x-forms.text-field name="name" label="Անուն"  value="{{ $department->name }}" />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-12 col-md-4">

                        <div class="checkbox">
                            <label>
                                <input {{ $department->has_bads ? 'checked' : '' }} id="has_bads" type="checkbox" name="has_bads" value="has_bads"> Մահճակալ
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-sm-12 col-md-4">

                        <div class="checkbox">
                            <label>
                                <input {{ $department->closed_from_inside ? 'checked' : '' }} id="closed_from_inside" type="checkbox" name="closed_from_inside" value="closed_from_inside"> Հաստատուն կենտրոնացված է
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-sm-12 col-md-4">

                        <div class="checkbox">
                            <label>
                                <input {{ $department->closed_from_outside ? 'checked' : '' }} id="closed_from_outside" type="checkbox" name="closed_from_outside" value="closed_from_outside"> Բաշխված կենտրոնացված է
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
