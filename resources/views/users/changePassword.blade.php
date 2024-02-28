@extends('layouts.cardBase')

@section('css')
    <link href="{{mix("/css/jquery.magicsearch.min.css")}}" rel="stylesheet" />
@endsection


@section('card-header')
@section('card-header-classes', '')
<div class="text-center">
    <h3>{{ \Illuminate\Support\Facades\Auth::user()->full_name }}</h3>
</div>
@endsection


@section('card-content')

    <div class="container">
        <form class="ajax-submitable dont-reset" action="{{route('users.updateUserPassword')}}" method="POST">
            @csrf

            <ul class="list-group">
                <li class="list-group-item">
                    <div class="form-row">
                        <div class="form-group col-sm-12 col-md-4">
                            <x-forms.text-field name="current_password" label="Հին գաղտնաբար" validationType="ajax" value="" />
                        </div>
                        <div class="form-group col-sm-12 col-md-4">
                            <x-forms.text-field name="password" label="Նոր գաղտնաբար" validationType="ajax" value="" />
                        </div>
                        <div class="form-group col-sm-12 col-md-4">
                            <x-forms.text-field name="password_confirmation" label="Կրկնել նոր գաղտնաբար" validationType="ajax" value="" />
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

@endsection
