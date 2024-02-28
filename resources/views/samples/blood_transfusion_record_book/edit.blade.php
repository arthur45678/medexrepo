@extends('layouts.cardBase')

@section('css')
<link href="{{mix("/css/jquery.magicsearch.min.css")}}" rel="stylesheet" />
@endsection


@section('card-header')
@section('card-header-classes', '')

<div class="text-center">
    <h3>Արյան փոխներարկման հաշվառման գրանցամատյան</h3>
</div>
@endsection


@section('card-content')

<div class="container">
    <form class="ajax-submitable" action="{{route('samples.patients.blood-transfusion-record-book.store', ['patient'=> $patient, 'blood_transfusion_record_book' => $btrb])}}" method="POST">
        @csrf
        <ul class="list-group">
                <li class="list-group-item">
                    <h5 class="text-center">Հերթական №{{$btrb->id}}</h5>
                    <hr class="hr-dashed">
                        <strong>
                            Ազգանուն, անուն, հայրանուն
                        </strong>
                        <ins class="ml-4">{{$patient->full_name}}</ins>
                </li>
                <li class="list-group-item">
                    <strong>
                        Տարիք՝
                    </strong>
                    <ins class="ml-4">{{$patient->age}}</ins>
                </li>
                <li class="list-group-item">
                    <strong>
                    Հիվանդի պատմ. №
                    </strong>
                    <ins class="ml-4">{{$lates_stationary->id}}</ins>
                </li>
                <li class="list-group-item">
                    <strong>
                    Հիվանդի հասցե №
                    </strong>
                    <ins class="ml-4">{{$patient->town_village}},{{$patient->street_house}},{{$patient->workplace}}</ins>
                </li>
                <li class="list-group-item">
                    <div class="mt-2">
                    <x-forms.text-field type="textarea" name="bag_number" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$btrb->bag_number}}" label="Պարկի №,խումբ Rh" />
                    </div>
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

