<!-- stationary_tuberculosis_complaints -->
<!-- tuberculosis_complaints 11.a :UPDATE: -->
@if ($sd_tuberculosis_complaint)
<div class="collapse tuberculosis-complaints-collapse">
    <strong>
        <span class="badge badge-light mr-1">11.1.դ)</span>
        տուբերկուլյոզին բնորոշ գանգատներ՝
    </strong>
    <x-forms.prev-posts-link href='{{$route."#stationary_diagnosis_tuberculosis_complaint"}}' />

    <button class="btn btn-sm btn-primary float-right" type="button" data-toggle="collapse" data-target=".tuberculosis-complaints-collapse">
        <x-svg icon="cui-pencil" />
    </button>

    @foreach ($sd_tuberculosis_complaint as $tuberculosis_complaint_key => $item)
        @include('shared.forms.stationary_edit_sections.stationary_diagnoses', [
            'item' => $item,
            // 'included_action_route' => $route_diagnosis,
            // 'included_form_method' => 'PATCH',
            'included_submit_txt' => 'փոփոխել',
            // 'has_hidden_type' => true,
            // 'has_diagnosis_date' => true,
            'row_name' => __("enums.stationary_diagnosis_enum." . $item->diagnosis_type),
            'route_delete' => route('patients.stationary.delete_diagnoses'),
            'is_approvable' => true
        ])
    @endforeach
</div>
@endif

<!-- tuberculosis_complaints 11.a :CREATE: -->
<div class="collapse show tuberculosis-complaints-collapse">
    <form action="{{$update_diagnosis}}" method="POST" class="ajax-submitable">
        @csrf
        @method('PUT')
        <input type="hidden" name="wrapper_id" value="#tuberculosis_complaints">
        <input type="hidden" name="diagnosis_type" value="{{App\Enums\StationaryDiagnosisEnum::tuberculosis_complaint()}}">
        <input type="hidden" name="is_approvable" value="1">
        <strong>
            <span class="badge badge-light mr-1">11.1.դ)</span>
            տուբերկուլյոզին բնորոշ գանգատներ՝
        </strong>
        <x-forms.prev-posts-link href='{{$route."#stationary_diagnosis_tuberculosis_complaint"}}' />

        @if ($sd_tuberculosis_complaint)
            <button class="btn btn-primary btn-sm float-right" type="button" data-toggle="collapse" data-target=".tuberculosis-complaints-collapse">
                <x-svg icon="cui-pencil" />
            </button>
        @endif

        <div class="container">
            <div class="col-md-12 my-2">
                <!-- complication of concomitant disease -->
                {{-- <x-forms.magic-search class="magic-search ajax" data-catalog-name="diseases"
                hidden-id="tuberculosis_complaints_disease_id" hidden-name="disease_id"
                placeholder="Ընտրել ախտորոշումը․․․" /> --}}
                <x-forms.magic-search class="magic-search-diseases" data-catalog-name="diseases"
                    hidden-id="tuberculosis_complaints_disease_id" hidden-name="disease_id"
                    placeholder="Ընտրել ախտորոշումը․․․" />
            </div>
            <div class="col-md-12 my-2">
                <textarea name="diagnosis_comment" class="form-control"
                    placeholder="ազատ գրառման դաշտ․․․"></textarea>
            </div>
            <div class="col-md-12 my-2">
                @include('shared.forms.list_group_item_submit', ['btn_text' => 'ավելացնել'])
            </div>
        </div>
    </form>
</div>
