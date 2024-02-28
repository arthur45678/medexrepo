<!-- stationary_final_clinical_diagnoses 11.a -->
<!--final-clinical-diagnoses 11.a :UPDATE: -->
@if ($sd_final_clinical)
    <div class="collapse final-clinical-diagnoses-collapse">
        <strong>
            <span class="badge badge-light mr-1">11.ա)</span>
            հիմնական՝
        </strong>

        <button class="btn btn-primary btn-sm float-right" type="button" data-toggle="collapse" data-target=".final-clinical-diagnoses-collapse">
            <x-svg icon="cui-pencil" />
        </button>

        @foreach ($sd_final_clinical as $final_clinical_key => $item)
            @include('shared.forms.stationary_edit_sections.stationary_diagnoses', [
                'item' => $item,
                // 'included_action_route' => $route_diagnosis,
                // 'included_form_method' => 'PATCH',
                'included_submit_txt' => 'փոփոխել',
                // 'has_hidden_type' => true,
                'has_diagnosis_date' => true,
                'row_name' => __("enums.stationary_diagnosis_enum." . $item->diagnosis_type),
                'route_delete' => route('patients.stationary.delete_diagnoses'),
                'is_approvable' => true
            ])
        @endforeach
    </div>
@endif

<!--  clinical-diagnoses 11.a :CREATE: -->
<div class="collapse show final-clinical-diagnoses-collapse">
    <form action="{{$update_diagnosis}}" method="POST" class="ajax-submitable">
        @csrf
        @method('PUT')
        <input type="hidden" name="wrapper_id" value="#final_clinical_diagnoses">
        <input type="hidden" name="diagnosis_type" value="{{App\Enums\StationaryDiagnosisEnum::final_clinical()}}">
        <input type="hidden" name="is_approvable" value="1">
        <strong>
            <span class="badge badge-light mr-1">11.ա)</span>
            հիմնական՝
        </strong>

        @if ($sd_final_clinical)
            <button class="btn btn-primary btn-sm float-right" type="button" data-toggle="collapse" data-target=".final-clinical-diagnoses-collapse">
                <x-svg icon="cui-pencil" />
            </button>
        @endif

        <div class="container mt-2">
            <div class="col-md-12 my-2">
                {{-- <x-forms.magic-search class="magic-search ajax" data-catalog-name="diseases"
                hidden-id="final_clinical_disease_id" hidden-name="disease_id"
                placeholder="Ընտրել ախտորոշումը․․․" /> --}}
                <x-forms.magic-search class="magic-search-diseases" data-catalog-name="diseases"
                hidden-id="final_clinical_disease_id" hidden-name="disease_id"
                placeholder="Ընտրել ախտորոշումը․․․" />
            </div>
            <div class="col-md-12 my-2">
                <x-forms.text-field type="date" name="diagnosis_date" label="" />
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
