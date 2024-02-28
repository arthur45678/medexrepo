@extends('layouts.cardBase')


@section('css')
    <link href="{{mix("/css/jquery.magicsearch.min.css")}}" rel="stylesheet" />
@endsection

@section('card-header')
@section('card-header-classes', '')

<div class="text-center">
    <h3>ՃԱՌԱԳԱՅԹԱՅԻՆ ԲՈՒԺՄԱՆ ՔԱՐՏ</h3>
</div>
@endsection

@section('card-content')
    <div class="container">
        <a href="{{ route("samples.patients.radiation-treatment-card.show", ['patient' => $patient , $card->id]) }}" class="btn btn-info btn-sm">
            <x-svg icon="cui-external-link" />
        </a>

        {{--1-7--}}
        @if($card->user_id == Auth::user()->id)
            @include('samples.radiation_treatment_cards.includes-edit.radiation-card-edit',['card' => $card])
        @else
            @include('samples.radiation_treatment_cards.includes-edit.radiation-card-show',['card' => $card])
        @endif

        @if(isset($card->treatment_plan))
            @if($card->treatment_plan->user_id == Auth::user()->id)
                @include('samples.radiation_treatment_cards.includes-edit.radiation_treatment_plans-edit',['card' => $card])
            @else
                @include('samples.radiation_treatment_cards.includes-edit.radiation_treatment_plans-show',['card' => $card])
            @endif
        @else
            @include('samples.radiation_treatment_cards.includes-edit.radiation_treatment_plans-create',['card' => $card])
        @endif

        {{--15--}}
        @if(isset($card->treatment_notes))
            @if($card->treatment_notes->user_id == Auth::user()->id)
                @include('samples.radiation_treatment_cards.includes-edit.radiation_treatment_notes-edit',['card' => $card])
            @else
                @include('samples.radiation_treatment_cards.includes-edit.radiation_treatment_notes-show',['card' => $card])
            @endif
        @else
            @include('samples.radiation_treatment_cards.includes-edit.radiation_treatment_notes-create',['card' => $card])
        @endif

        {{--16-ից 19--}}
        @if(isset($card->treatment_final_data))
            @if($card->treatment_final_data->user_id == Auth::user()->id)
                @include('samples.radiation_treatment_cards.includes-edit.radiation_treatment_final_data-edit',['card' => $card])
            @else
                @include('samples.radiation_treatment_cards.includes-edit.radiation_treatment_final_data-show',['card' => $card])
            @endif
        @else

            @include('samples.radiation_treatment_cards.includes-edit.radiation_treatment_final_data-create',['card' => $card])
        @endif

    </div>
@endsection

@section('javascript')
    <script src="{{ mix('js/jquery.js') }}"></script>
    <script src="{{ mix('js/all.magicsearch.js') }}"></script>

@endsection
