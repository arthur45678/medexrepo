{{-- @extends('layouts.cardBase')
@section('css')
<link href="{{mix("/css/jquery.magicsearch.min.css")}}" rel="stylesheet" />
<style>
    #disease_course {
        margin-top: 100px;
        width: 80%;
        margin-left: 20%;
    }
</style>
@endsection --}}
{{-- for returning as individual view --}}


@php
// stationary_disease_course.blade
$disease_courses = $user->stationary_disease_courses;
$route = route("patients.stationary.show", ["patient" => $patient, "stationary" => $stationary]);
$sdc_action = route("patients.stationary.disease_course", ["patient" => $patient, "stationary" => $stationary]);

// Added $with ['stationary_prescriptions'] into "StationaryDiseaseCourse" model
// to get prescriptions of each  disease_course

// dummy_prescriotion is provides non-breaking page, when disease_course does not have prescriptions.
$dummy_prescription = [
    'medicine_id' => null,
    'medicine_dose' => null,
    'measurement_unit_id' => null, // medicine_measure
    'prescription_text' => null,
];
@endphp

<section id="disease_course">

    <ul class="list-group mt-2">
        <li class="list-group-item list-group-item-info text-center">
            <h4>
                Հիվանդության ընթացքը
                <x-forms.prev-posts-link href="{{ $route . '#stationary_disease_course' }}" />
                @if(count($disease_courses))
                <button class="btn btn-primary btn-sm" type="button" data-toggle="collapse"
                    data-target=".disease-course-collapse">
                    <x-svg icon="cui-pencil" />
                </button>
                @endif
            </h4>
        </li>
    </ul>

    @if (count($disease_courses))
    <!-- start update part -->
    <div class="collapse disease-course-collapse">
        @forelse ($disease_courses as $dc_key => $item)
        <form action="{{ $sdc_action }}" class="ajax-submitable dont-reset" method="POST">
            @method("PATCH")
            @csrf
            {{-- <kbd>disease course id:</kbd><!-- remove hidden when testing  --> --}}
            <input type="hidden" name="id" value="{{ $item->id }}">
            <ul class="list-group mt-2">
                <li class="list-group-item">
                    <strong>Ամսաթիվ</strong>
                    <x-forms.text-field type='date' name='disease_course_date'
                        value="{{  old('disease_course_comment', $item->disease_course_date) }}"
                        validationType="ajax" />

                    <hr class="hr-dashed">
                    <strong>Հիվանդության ընթացքը</strong>
                    <x-forms.text-field type='textarea' name='disease_course_comment' placeholder="ազատ լրացման դաշտ․․․"
                        value="{{ old('disease_course_comment', $item->disease_course_comment) }}"
                        validationType="ajax" />
                </li>

                {{-- Նշանակումներ սկիզբ --}}
                @php
                    $item_prescriptions = $item->stationary_prescriptions;
                    $prescription_length = count($item_prescriptions) ?? 1;
                    // dump('length --- '.$prescription_length);
                    $size = max($repeatables, $prescription_length);
                    // dump('size ----- '.$size);
                    $item_prescriptions_pad = array_pad($item_prescriptions->toArray(),$size, $dummy_prescription);

                @endphp

                <li class="list-group-item">
                    <strong>Նշանակումներ՝</strong>
                    <x-forms.prev-posts-link href='{{ $route . '#stationary_prescriptions' }}' size='md' />

                    <x-forms.add-reduce-button type="add" data-row=".stationary-prescription-{{$dc_key}}-row" />
                    <x-forms.add-reduce-button type="reduce" data-row=".stationary-prescription-{{$dc_key}}-row" data-limit='{{$prescription_length}}' />
                    <x-forms.hidden-counter class="stationary-prescription-{{$dc_key}}-rows" name="prescription_length" old='{{$prescription_length}}' />

                    @for($i = 0; $i < $repeatables; $i++)
                    @if ($item_prescriptions_pad[$i]['medicine_id'])
                        {{-- @dump($item_prescriptions_pad[$i] ?? 'yoga') --}}
                        {{-- <kbd>prescription id:</kbd><!-- remove hidden when testing --> --}}
                        <input type="hidden" name="prescription_id[]" value="{{$item_prescriptions_pad[$i]['id']}}">
                    @endif

                    <div class="stationary-prescription-{{$dc_key}}-row {{ $i < old('prescription_length', $prescription_length) ? ' ' : 'd-none' }}">
                        <hr class="mb-2">
                        <strong>դեղամիջոց՝</strong>
                        <div class="mb-2">
                            <x-forms.magic-search class="magic-search ajax"
                                data-catalog-name="medicines"
                                value='{{ old("prescription_medicine_id.$i", $item_prescriptions_pad[$i]["medicine_id"]) }}'
                                hidden-id="prescription_medicine_id_{{{$dc_key}}}_{{ $i }}_edit"
                                hidden-name="prescription_medicine_id[]" placeholder="Ընտրել դեղամիջոցը․․" />
                        </div>
                        <div class="form-row align-items-center my-2">
                            <div class="col-md-6">
                                <strong>Քանակ՝</strong>
                                <x-forms.text-field type="number" name='prescription_medicine_dose[]' label=""
                                    value='{{ old("prescription_medicine_dose.$i", $item_prescriptions_pad[$i]["medicine_dose"]) }}'
                                    validationType="ajax" />
                            </div>
                            <div class="col-md-6">
                                <strong>չափման միավոր՝</strong>
                                <select name="prescription_medicine_measure[]" class="form-control">
                                    <option value="">Ընտրել չախման միավորը․․․</option>

                                    @foreach ($measurement_units as $unit)
                                        <option value="{{$unit->id}}" {{$item_prescriptions_pad[$i]["measurement_unit_id"] === $unit->id ? 'selected' : '' }}>
                                            {{__('measurement_units.'.$unit->name)}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <hr class="hr-dashed">
                        <div class="my-2">
                            <x-forms.text-field type="textarea" placeholder="դեղամիջոցի նշանակման աազատ դաշտ․․․"
                                value='{{ old("prescription_text.$i", $item_prescriptions_pad[$i]["prescription_text"]) }}'
                                name="prescription_text[]" validationType="ajax" label="" />
                        </div>
                    </div>
                    @endfor
                </li>
                {{-- Նշանակումներ վերջ --}}
                @include('shared.forms.list_group_item_submit', ['btn_text' => 'Պահպանել'])
            </ul>
        </form>
        @empty

        @endforelse
    </div>
    <!-- end update part -->
    @endif

    <div class="collapse show disease-course-collapse">
        <form action="{{ $sdc_action }}" class="ajax-submitable" method="POST">
            @method("PATCH")
            @csrf

            <ul class="list-group mt-2">
                <li class="list-group-item">
                    <strong>Ամսաթիվ</strong>
                    <x-forms.text-field type='date' name='disease_course_date' validationType="ajax" />

                    <hr class="hr-dashed">
                    <strong>Հիվանդության ընթացքը</strong>
                    <x-forms.text-field type='textarea' name='disease_course_comment' placeholder="ազատ լրացման դաշտ․․․"
                        validationType="ajax" />
                </li>
                <li class="list-group-item">
                    <strong>Նշանակումներ՝</strong>
                    <x-forms.prev-posts-link href="{{ $route . '#stationary_prescriptions' }}" size='md'/>

                    <x-forms.add-reduce-button type="add" data-row=".stationary-prescription-row" />
                    <x-forms.add-reduce-button type="reduce" data-row=".stationary-prescription-row" />
                    <x-forms.hidden-counter class="stationary-prescription-rows" name="prescription_length" />

                    @for($i = 0; $i < $repeatables; $i++)
                    <div class="stationary-prescription-row {{ $i < old('prescription_length', 1) ? ' ' : 'd-none' }}">
                        <hr class="mb-2">
                        <strong>դեղամիջոց՝</strong>
                        <div class="mb-2">
                            <x-forms.magic-search class="medicines-search magic-search ajax"
                                data-catalog-name="medicines"
                                value='{{ old("prescription_medicine_id.$i") }}'
                                hidden-id="prescription_medicine_id{{ $i }}" hidden-name="prescription_medicine_id[]"
                                placeholder="Ընտրել դեղամիջոցը․․" />
                        </div>
                        <div class="form-row align-items-center my-2">
                            <div class="col-md-6">
                                <strong>Քանակ՝</strong>
                                <x-forms.text-field type="number" name='prescription_medicine_dose[]' label=""
                                    value='{{ old("prescription_medicine_dose.$i") }}' validationType="ajax" />
                            </div>
                            <div class="col-md-6">
                                <strong>չափման միավոր՝</strong>
                                <select name="prescription_medicine_measure[]" class="form-control">
                                    <option value="">Ընտրել չախման միավորը․․․</option>

                                    @foreach ($measurement_units as $unit)
                                        <option value="{{$unit->id}}">{{__('measurement_units.'.$unit->name)}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <hr class="hr-dashed">
                        <div class="my-2">
                            <x-forms.text-field type="textarea" placeholder="դեղամիջոցի նշանակման աազատ դաշտ․․․"
                                value='{{ old("prescription_text.$i") }}' name="prescription_text[]"
                                validationType="ajax" label="" />
                        </div>
                    </div>
                    @endfor
                </li>

                @include('shared.forms.list_group_item_submit', ['btn_text' => 'Ավելացնել'])
            </ul>

        </form>
    </div>

</section>

{{-- for returning as individual view --}}
{{-- @section('javascript')
<script src="{{ mix('js/jquery.js') }}"></script>
<script src="{{ mix('js/all.magicsearch.js') }}"></script>
<script src="{{ mix('/js/components/Select.js')}}"></script>
<script>
    var repeatables = {{$repeatables}};
</script>
@endsection --}}
