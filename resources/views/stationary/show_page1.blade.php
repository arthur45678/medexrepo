<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Stationary</title>
    <link rel="stylesheet" href="{{mix('css/print/stationary.css')}}">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    @if ($for_pdf)
        <style>
            *{ font-family: DejaVu Sans !important;}
        </style>
    @endif
</head>
<body>
<?php
use App\Enums\StationaryDiagnosisEnum;
use App\Enums\StationaryMedicineSideEffectEnum as MedSideEffect;
use App\Enums\StationarySurgeryEnum;
?>
    {{--Main page--}}
<div class="page-wrap">
    <div class="main-container">
        <div class="new-page">
            <br>
            <br>

            <div class="text-center">Բ․Ա.Ֆանարջյանի անվան ուռուցքաբանության ազգային կենտրոն ՓԲԸ</div>
            <br>
            <div class="text-center">
                <h1>ԲԱԺԱՆՄՈՒՆՔ</h1>
            </div>
            <div class="text-center"><img src="{{asset('assets/img/avatars/f-logo.jpg')}}"></div>
            <br>
            <div id="stationary-card" class="text-center"><strong>Հիվանդության պատմագիր N <span>{{$stationary->number ?? ""}}</span> </strong></div>
            <br><br>
            <div class="display-flex" id="stationary_social_package">
                <div> Սոցիալական խումբ՝</div>
                <div class="bottom-line">
                    @forelse($stationary_social_packages as $item)
                        {{$item->package_item->name}}
                    @empty

                    @endforelse
                </div>

            </div>
            <br>
            <div class="display-flex">
                <div>Ազգանուն, Անուն, Հայրանուն</div>
                <div class="bottom-line">{{$patient->all_names}}</div>
            </div>
            <br>
            <div id="stationary_diagnosis_primary_disease" >Հիմնական հիվանդության ախտորոշումը (գրվում է դուրսգրումից հետո)</div>
            <p>
                @forelse($stationary->stationary_diagnoses->where("diagnosis_type", StationaryDiagnosisEnum::primary_disease()) as $item)

                    @if( ($status = $item->approvementStatusBoolean()) !== null)
                        <div class="{{$status ?: 'waiting-for-approvement'}}">
                            {{$item->disease_item->code_name ?? ""}}  <br>
                            {{$item->diagnosis_comment ?? ""}} <br><br>
                            <span class="print-hide">{{$item->approvementStatus()}}</span>
                        </div>
                    @else
                        {{$item->disease_item->code_name ?? ""}} <br>
                        {{$item->diagnosis_comment ?? ""}} <br><br>
                    @endif

                @empty

                @endforelse
            </p>
            <br><br>
            <div class="min-container float-left" style="height: 125px;">
                <div class="float-left">Փուլը</div>
                <div class="number-line float-left">{{$stationary->stage ?? ""}}</div>
                <br><br>
                <div class="float-left">TNM</div>
                <div class="number-line float-left">
                    T-> {{$stationary->T ?? "'- - -'"}}
                    N-> {{$stationary->N ?? "'- - -'"}}
                </div>
                <div class="number-line float-left" style="margin-left: 44px;">
                    M-> {{$stationary->M ?? "'- - -'"}}
                    Grade-> {{$stationary->Grade ?? "'- - -'"}}
                </div>
                <div class="number-line float-left" style="margin-left: 44px;">
                    L-> {{$stationary->L ?? "'- - -'"}}
                    V-> {{$stationary->V ?? "'- - -'"}}
                </div>
                <div class="number-line float-left" style="margin-left: 44px;">
                    դասակարգում-> {{$stationary->pycmr ?? "'- - -'"}}
                </div>
            </div>
            <div class="min-container float-left" style="height: 125px;">
                <div class="float-left">Արյան խումբը</div>
                <div class="number-line float-left">{{$patient->blood_group ?? ""}}</div>
                <br><br>
                <div class="float-left">Rh - գործոն</div>
                <div class="number-line float-left">{{$patient->rh_factor_sign ?? ""}}</div>
            </div>
            <br><br>
            <div class="data-section">
                <div class="float-left">Ընդունման ամսաթիվ</div>
                <div class="bottom-line float-left">{{$stationary->admission_date ?? ""}}</div>
                <br><br><br>
                <div class="float-left">Դուրս գրման ամսաթիվ <br> (մահվան ամսաթիվ)</div>
                <div class="bottom-line float-left">{{$stationary->discharge_date ?? ""}}</div>
            </div>
            <br><br><br>
            <div class="display-flex">
                <div id="stationary-department-name" >Բաժանմունք</div>
                <div class="bottom-line">{{$stationary->department->name ?? ""}}</div>
            </div>
            <br><br>
            <div class="display-flex">
                <div >Բուժող բժիշկ</div>
                <div class="bottom-line">{{$stationary->attending_doctor->full_name ?? ""}}</div>
            </div>
        </div>

        {{-- Page 2  --}}
        @include("stationary.show_page2")

        {{-- Page 3 --}}
        @include("stationary.show_page3")

        {{-- page 4 --}}
        @include("stationary.show_page4")

        {{-- page 5 --}}
        @include("stationary.show_page5")

        {{-- page 6 --}}
        @include("stationary.show_page6")

        {{-- page 7 --}}
        @include("stationary.show_page7")

        {{-- page 8 --}}
        @include("stationary.show_page8")

        {{-- page 9 --}}
        @include("stationary.show_page9")

        {{-- page 10 --}}
        @include("stationary.show_page10")

        {{-- page 11 --}}
        @include("stationary.show_page11")

        {{-- page 12 --}}
        @include("stationary.show_page12")

        {{-- page 13-14 --}}
        @include("stationary.show_page13-14")

        {{-- page 15-16 --}}
        @include("stationary.show_page15-16")

        {{-- page 17 --}}
        @include("stationary.show_page17")

        {{-- page 18 --}}
        @include("stationary.show_page18")

        {{-- page 19 --}}
        @include("stationary.show_page19")

        {{-- page 20 --}}
        @include("stationary.show_page20")

    </div>
</div>
</div>
</body>
</html>
