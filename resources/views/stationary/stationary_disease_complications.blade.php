<!-- stationary_disease_complications -->
<!--  disease-complications 11.b :UPDATE: -->
@if ($sd_disease_complication)
    <div class="collapse disease-complications-collapse">
        <strong>
            <span class="badge badge-light mr-1">11.բ)</span>
            հիմնական հիվանդության բարդություն՝
        </strong>
        <x-forms.prev-posts-link href='{{$route."#stationary_diagnosis_disease_complication"}}' size='sm'/>

        <button class="btn btn-primary btn-sm float-right" type="button" data-toggle="collapse" data-target=".disease-complications-collapse">
            <x-svg icon="cui-pencil" />
        </button>

        @foreach ($sd_disease_complication as $disease_complication_key => $item)
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

<!--  disease-complications 11.b :CREATE: -->
<div class="collapse show disease-complications-collapse">
    <form action="{{$update_diagnosis}}" method="POST" class="ajax-submitable">
        @csrf
        @method('PUT')
        <input type="hidden" name="wrapper_id" value="#disease_complication">
        <input type="hidden" name="diagnosis_type" value="{{App\Enums\StationaryDiagnosisEnum::disease_complication()}}">
        <input type="hidden" name="is_approvable" value="1">
        <strong>
            <span class="badge badge-light mr-1">11.բ)</span>
            հիմնական հիվանդության բարդություն՝
        </strong>
        <x-forms.prev-posts-link href='{{$route."#stationary_diagnosis_disease_complication"}}' size='sm'/>

        @if ($sd_disease_complication)
            <button class="btn btn-primary btn-sm float-right" type="button" data-toggle="collapse" data-target=".disease-complications-collapse">
                <x-svg icon="cui-pencil" />
            </button>
        @endif

        <div class="container mt-2">
            <div class="col-md-12 my-2">
                {{-- <x-forms.magic-search class="magic-search ajax" data-catalog-name="diseases"
                hidden-id="underlying_disease_complication_id" hidden-name="disease_id"
                placeholder="Ընտրել ախտորոշումը․․․" /> --}}
                <x-forms.magic-search class="magic-search-diseases" data-catalog-name="diseases"
                    hidden-id="underlying_disease_complication_id" hidden-name="disease_id"
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
