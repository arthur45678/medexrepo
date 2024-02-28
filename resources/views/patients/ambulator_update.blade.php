@extends('layouts.cardBase')

@section('css')
<link href="{{mix("/css/tail.select-default.css")}}" rel="stylesheet" />
@endsection

@section('card-header')
Հիվանդներ | {{$patient->full_name}} -ի Ամբուլատոր քարտ
@endsection

@section('card-content')

<form action="{{route('patients.ambulator.update', ["patient" => $patient, "ambulator" => $ambulator])}}" method="POST">
    @csrf
    @method("PATCH")

    <button class="btn btn-lg btn-primary" style="position: fixed; bottom:20px; right:20px; z-index: 10">
        <x-svg icon="cui-file" />
    </button>

    <x-forms.section title="Նախնական ախտորոշում"
        view-url="{{ route('patients.ambulator.show', ['ambulator' => $ambulator, 'patient' => $patient, '#preliminary_diagnosis']) }}">
        <ul class="list-group">
            @forelse ($ambulator->diagnoses->where("type", "preliminary") as $diagnosis)
            <x-quote-item :source="$diagnosis->user->full_name">
                {{ $diagnosis->disease_item->code_name }} <br>
                {{ $diagnosis->diagnosis_comment }}
            </x-quote-item>
            @empty

            @endforelse
        </ul>

        <div class="form-group mt-4">
            <div class="react-select-container" data-name="preliminary_diagnosis_disease"></div>
        </div>

        <div class="form-group">
            <x-forms.text-field name="preliminary_diagnosis" type="textarea" label="Նախնական ախտորոշում" />
        </div>
    </x-forms.section>

    <x-forms.section title="Վերջնական ախտորոշում">
        <ul class="list-group">
            @forelse ($ambulator->diagnoses->where("type", "final") as $diagnosis)
            <x-quote-item :source="$diagnosis->user->full_name">
                {{ $diagnosis->disease_item->code_name }} <br>
                {{ $diagnosis->diagnosis_comment }}
            </x-quote-item>
            @empty

            @endforelse
        </ul>

        <div class="form-group mt-4">
            <div class="react-select-container" data-name="final_diagnosis_disease"></div>
        </div>

        <div class="form-group">
            <x-forms.text-field name="final_diagnosis" type="textarea" label="Վերջնական ախտորոշում" />
        </div>
    </x-forms.section>

    <x-forms.section title="Ինչ հիվանդություններով է հիվանդացել">
        <ul class="list-group mb-4">
            @forelse ($ambulator->last_diseases as $disease)
            <x-quote-item :source="$disease->user->fullname">
                {{ $disease->disease_item->code_name }} <br>
                {{ $disease->disease_comment }}
            </x-quote-item>
            @empty

            @endforelse
        </ul>

        <div class="form-group mt-2">
            <div class="react-select-container" data-name="last_diseases_id"></div>
        </div>

        <div class="form-group mt-2">
            <x-forms.text-field name="last_diseases_comment" type="textarea" label="Հիվանդության նկարագրություն" />
        </div>
    </x-forms.section>

    <x-forms.section title="Հիվանդի Գանգատներ">
        <ul class="list-group">
            @forelse ($ambulator->complaints as $complaint)
            <x-quote-item :source="$complaint->user->full_name">
                {{$complaint->complaint_text}}
            </x-quote-item>
            @empty

            @endforelse
        </ul>
        <div class="form-group mt-2">
            <x-forms.text-field name="complaints" type="textarea" label="Հիվանդի Գանգատներ" />
        </div>
    </x-forms.section>

    <div class="row">
        <div class="form-group col-sm-12 col-md-6">
            <x-forms.text-field name="number_of_births" type="number" label="Ծննդաբերություններ թիվը" />
        </div>
        <div class="form-group col-sm-12 col-md-6">
            <x-forms.text-field name="number_of_abortions" type="number" label="Վիժումների թիվը" />
        </div>
    </div>

    <div class="form-group">
        <x-forms.text-field name="date_of_last_birth" type="date" label="Վերջին ծննդաբերության ամսաթիվը" />
    </div>

    <div class="form-group">
        <x-forms.text-field name="breast_inflammation" type="textarea" label="Կրծքագեղձի բորբոքում" />
    </div>

    <div class="form-group">
        <x-forms.text-field name="menstruation" type="textarea" label="Դաշտանը" />
    </div>

    <div class="form-group">
        <x-forms.text-field name="breastfeeding_complications" type="textarea"
            label="Բարդություններ կրծքով կերակրելու շրջանում" />
    </div>

    <x-forms.section title="Ուռուցքի նկարագրություն, տեղակայումը">
        <ul class="list-group">
            @forelse ($ambulator->tumor_infos as $tumor_info)
            <x-quote-item :source="$tumor_info->user->full_name">
                {{$tumor_info->tumor_description}}
            </x-quote-item>
            @empty

            @endforelse
        </ul>
        <div class="form-group mt-2">
            <x-forms.text-field name="tumor_description" type="textarea" label="Ուռուցքի նկարագրություն, տեղակայումը" />
        </div>
    </x-forms.section>

    <x-forms.section title="Հիվանդության զարգացումը, հանդես գալը">
        <ul class="list-group">
            @forelse ($ambulator->onset_and_developments as $oad)
            <x-quote-item :source="$oad->user->full_name">
                {{$oad->oad_comment}}
            </x-quote-item>
            @empty

            @endforelse
        </ul>
        <div class="form-group mt-2">
            <x-forms.text-field name="disease_progression" type="textarea"
                label="Հիվանդության զարգացումը, հանդես գալը" />
        </div>
    </x-forms.section>

    <div class="form-group">
        <label>Հիվանդը ունի երկվորյակ</label>
        <div class="form-check">
            <input class="form-check-input" id="has-twin-true" type="radio" value="1" name="has_twin">
            <label class="form-check-label" for="has-twin-true">Այո</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" id="has-twin-false" type="radio" value="0" name="has_twin">
            <label class="form-check-label" for="has-twin-false">Ոչ</label>
        </div>
        @error("has_twin")
        <em class="error text-danger">{{$message}}</em>
        @enderror
    </div>

    <div class="duplicatable">
        <div class="d-flex justify-content-between">
            <h5>Հիվանդի Վիճակը.
                <a
                    href="{{ route('patients.ambulator.show', ['ambulator' => $ambulator, 'patient' => $patient, '#health_statuses']) }}">
                    Նախորդ գրառումներ
                </a>
            </h5>
            <div>
                <button type="button" class="btn btn-primary btn-duplicatable">
                    <x-svg icon="cui-plus" />
                </button>
            </div>
        </div>
        <div class="duplicatable-content">
            <div class="row">
                <div class="form-group col-sm-12 col-md-6">
                    <x-forms.text-field name="health_status_dates[]" type="date" label="Ներկայացել է" />
                </div>
                <div class="form-group col-sm-12 col-md-6">
                    <x-forms.text-field name="heath_status_texts[]" type="textarea" label="Վիճակը, նշանակումներ" />
                </div>
            </div>
        </div>
    </div>

    <button class="btn btn-primary">
        Ուղարկել
    </button>
</form>

@endsection

@section('javascript')
<script src="{{mix('/js/select-pure.js')}}"></script>
<script src="{{mix('/js/components/Select.js')}}"></script>
{{-- <script>
    document.addEventListener("DOMContentLoaded", () => alert());

</script> --}}
@endsection
