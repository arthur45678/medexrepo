@extends('layouts.cardBase')

@section('css')
<link href="{{mix("/css/jquery.magicsearch.min.css")}}" rel="stylesheet" />
@endsection


@section('card-header')
@section('card-header-classes', '')

<div class="text-center">
    <h3>ԳԻՏԱԿՑՎԱԾ ԿԱՄԱՎՈՐ ՀԱՄԱՁԱՅՆՈՒԹՅՈՒՆ</h3>
</div>
@endsection


@section('card-content')

<div class="container">
    <form class="ajax-submitable dont-reset" action="{{ route('samples.patients.conscious-voluntary-consents.update', ['patient'=> $patient,  $conscious->id]) }}" method="POST">
        @csrf
        @method('put')
        <ul class="list-group">
                <li class="list-group-item">
                    <div class="form-row align-items-center">
                        <div class="col-md-4">
                            <strong>Հրաման №</strong>
                        </div>
                        <div class="col-md-8">
                            <x-forms.text-field type="text" name="command_number" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                            value="{{ $conscious->command_number }}" label="" />
                        </div>
                    </div>
                </li>

                <li class="list-group-item">
                    <div class="form-row align-items-center">
                        <div class="col-md-4">
                            <strong>Ամսաթիվ</strong>
                        </div>
                        <div class="col-md-8">
                            <x-forms.text-field name="admission_date" validation-type="ajax" type="date"
                            value="{{ $conscious->admission_date }}" label="" />
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                            <strong>Բուժման համար նախատեսված դեղորայքը</strong>
                    <div class="my-2">
                        <x-forms.magic-search class="magic-search ajax" value='{{ $conscious->medicine_id }}' hidden-id="medicine_id"
                                              hidden-name="medicine_id" data-catalog-name="medicines" placeholder="ընտրել դեղամիջոցը․․․" />
                    </div>
                </li>
                <li class="list-group-item">

                    <strong>ՀՀ օրենսդրությամբ սահմանված դեպքերում հետազոտությունների մի մասը կարող է իրականցվել</strong>
                    <select name="payment_type" id="payment_type_id" class="form-control my-2">
                                <option {{ $conscious->payment_type == 'paid' ? 'selected' : '' }} value="paid">Վճարովի</option>
                                <option {{ $conscious->payment_type == 'state_order' ? 'selected' : '' }} value="state_order">Պետպատվեր</option>
                                <option {{ $conscious->payment_type == 'social_insurance' ? 'selected' : '' }}  value="social_insurance">Սոց․ ապահովագրություն</option>
                                <option {{ $conscious->payment_type == 'co_payment' ? 'selected' : '' }} value="co_payment">Համավճար</option>
                    </select>
                </li>
                <li class="list-group-item">
                    <strong>Հիվանդի հարազատի, խնամակալի կամ օրինական ներկայացուցչի ԱԱՀ</strong>
                    <div class="my-2">
                    <x-forms.text-field type="textarea" name="firstName_lastName_patronymic" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                    value="{{ $conscious->firstName_lastName_patronymic }}" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Վիրահատություն, ռադիոթերապիա, քիմիոթերապիա և այլ</strong>
                    <div class="my-2">
                    <x-forms.text-field type="textarea" name="treatment_description" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                    value="{{ $conscious->treatment_description }}" label="" />
                    </div>
                </li>

                <li class="list-group-item">
                    <div class="form-row align-items-center">
                        <div class="col-md-4">
                            <strong>Ամսաթիվ</strong>
                        </div>
                        <div class="col-md-8">
                            <x-forms.text-field name="client_confirm_date" validation-type="ajax" type="date"
                            value="{{ $conscious->client_confirm_date }}" label="" />
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                        <strong>Բաժանմունքի վարիչ</strong>
                        <x-forms.magic-search hidden-id="department_head_doctor_id" hidden-name="department_head_doctor_id"
                        placeholder="Ընտրել բաժանմունքի վարիչ․․․" class="magic-search ajax my-2" data-list-name="users"
                        value="{{ $conscious->department_head_doctor_id }}" />
                        <strong>Բուժող բժիշկ</strong>
                        <x-forms.magic-search hidden-id="doctor_id" hidden-name="doctor_id"
                        placeholder="Ընտրել բուժող բժիշկին․․․" class="magic-search ajax my-2" data-list-name="users"
                        value="{{ $conscious->doctor_id }}" />
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
    $(document).ready(function () {
        $(".medicines-search").magicsearch(
            window.medexMagicSearch.assignConfigs({
                dataSource: "/catalogs/medicines.json",
                type: "ajax",
                success: function($input, data) {
                    const hidden_id = $input.data("hidden");
                    $(hidden_id).val($input.attr("data-id"));
                }
            })
        );
    });
    </script>

@endsection
