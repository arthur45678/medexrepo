<!-- 8 stationary_referring_institution_diagnoses -->
<ul class="list-group" id="referring_institution_diagnoses">
    <li class="list-group-item">
        <!-- referring-institutuion-diagnoses 8 :UPDATE: -->
        @if ($sd_referring_institution)
            <div class="collapse referring-institutuion-diagnosis">
                <strong>
                    <span class="badge badge-light mr-1">8.</span>
                    Ուղեգրող հաստատության ախտորոշումը՝
                </strong>
                <x-forms.prev-posts-link href='{{$route."#referring_institution_diagnoses"}}' size='sm' />

                <button class="btn btn-sm btn-primary float-right" type="button" data-toggle="collapse" data-target=".referring-institutuion-diagnosis">
                    <x-svg icon="cui-pencil" />
                </button>

                @foreach ($sd_referring_institution as $referring_key => $item)
                    @include('shared.forms.stationary_edit_sections.stationary_diagnoses', [
                        'item' => $item,
                        // 'included_action_route' => $update_diagnosis,
                        // 'included_form_method' => 'PATCH',
                        'included_submit_txt' => 'փոփոխել',
                        // 'has_hidden_type' => true,
                        // 'has_diagnosis_date' => false,
                        'row_name' => __("enums.stationary_diagnosis_enum." . $item->diagnosis_type),
                        'route_delete' => route('patients.stationary.delete_diagnoses'),
                        'is_approvable' => false
                    ])
                @endforeach
            </div>
        @endif

        <!-- referring-institutuion-diagnoses 8 :CREATE: -->
        <div class="collapse show referring-institutuion-diagnosis">
            <form action="{{$create_many_diagnoses}}" method="POST" class="ajax-submitable">
                @csrf
                <input type="hidden" name="wrapper_id" value="#referring_institution_diagnoses">
                <input type="hidden" name="diagnosis_type" value="{{App\Enums\StationaryDiagnosisEnum::referring_institution()}}">
                <strong>
                    <span class="badge badge-light mr-1">8.</span>
                    Ուղեգրող հաստատության ախտորոշումը՝
                </strong>
                <x-forms.prev-posts-link href='{{$route."#stationary_diagnosis_referring_institution"}}' size='sm' />

                <x-forms.add-reduce-button type="add" data-row=".referring-row" classes="btn-sm" />
                <x-forms.add-reduce-button type="reduce" data-row=".referring-row" classes="btn-sm"/>
                <x-forms.hidden-counter class="referring-rows" name="diagnosis_length" />

                @if ($sd_referring_institution)
                <button class="btn btn-sm btn-primary float-right" type="button" data-toggle="collapse" data-target=".referring-institutuion-diagnosis">
                    <x-svg icon="cui-pencil" />
                </button>
                @endif

                @for ($i = 0; $i < $repeatables; $i++)
                    <div class="container referring-row {{$i<old('diagnosis_length', 1) ?' ':'d-none'}}">
                        <div class="col-md-12 my-2">
                            {{-- <x-forms.magic-search class="magic-search ajax" data-catalog-name="diseases" value='{{old("disease_id.$i")}}'
                                hidden-id="referring_diagnosis_{{$i}}" hidden-name="disease_id[]"
                                placeholder="Ընտրել ախտորոշումը․․․" /> --}}
                            <x-forms.magic-search class="magic-search-diseases" data-catalog-name="diseases" value='{{old("disease_id.$i")}}'
                                hidden-id="referring_diagnosis_{{$i}}" hidden-name="disease_id[]"
                                placeholder="Ընտրել ախտորոշումը․․․" />
                        </div>
                        <div class="col-md-12 my-2">
                            <textarea name="diagnosis_comment[]" class="form-control"
                                placeholder="ազատ գրառման դաշտ․․․">{{old("diagnosis_comment.$i")}}</textarea>
                        </div>
                    </div>
                @endfor
                <div class="container">
                    <div class="col-md-12 my-2">
                        @include('shared.forms.list_group_item_submit', ['btn_text' => 'ավելացնել'])
                    </div>
                </div>
            </form>
        </div>
    </li>
</ul>
