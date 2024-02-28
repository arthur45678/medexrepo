<ul class="list-group" id="medicine_side_effects_intolerance">
    <li class="list-group-item">
        <!-- medicine-intolerance :UPDATE: -->
        @if ($mse_intolerance)
            <div class="collapse medicine-intolerance-collapse">
                <strong>Դեղանյութերի կողմնակի ազդեցությունը (անտանելիությունը)՝</strong>
                <x-forms.prev-posts-link href='{{$route . "#stationary_medicine_side_effect_intolerance"}}' size='sm' />

                <button class="btn btn-sm btn-primary float-right" type="button" data-toggle="collapse" data-target=".medicine-intolerance-collapse">
                    <x-svg icon="cui-pencil" />
                </button>

                @foreach ($mse_intolerance as $item)
                    @include('shared.forms.stationary_edit_sections.stationary_medicine_side_effects',[
                        'item' => $item,
                        // 'included_action_route' => $route_diagnosis,
                        // 'included_form_method' => 'PATCH',
                        'included_submit_txt' => 'փոփոխել',
                        // 'has_hidden_type' => true,
                        'has_diagnosis_date' => true,
                        'row_name' => __("enums.stationary_medicine_side_effect_enum." . $item->type),
                        'route_delete' => route('patients.stationary.delete_medicine_side_effects'),
                        'is_approvable' => true
                    ])
                @endforeach
            </div>
        @endif

        <!-- medicine-intolerance :CREATE: -->
        <div class="collapse show medicine-intolerance-collapse">
            <form action="{{$create_many_medicine_side_effects}}" method="POST" class="ajax-submitable -off">
                @csrf
                <input type="hidden" name="wrapper_id" value="#medicine_side_effects_intolerance">
                <input type="hidden" name="type" value="{{App\Enums\StationaryMedicineSideEffectEnum::intolerance()}}">
                <input type="hidden" name="is_approvable" value="1">

                <strong>Դեղանյութերի կողմնակի ազդեցությունը (անտանելիությունը)՝</strong>
                <x-forms.prev-posts-link href='{{$route . "#stationary_medicine_side_effect_intolerance"}}' size='sm' />

                <x-forms.add-reduce-button type="add" data-row=".side-effect-medicine-row" classes='btn-sm' />
                <x-forms.add-reduce-button type="reduce" data-row=".side-effect-medicine-row" classes='btn-sm' />
                <x-forms.hidden-counter class="side-effect-medicine-rows" name="medicine_length" />

                @if ($mse_intolerance)
                <button class="btn btn-sm btn-primary float-right" type="button" data-toggle="collapse" data-target=".medicine-intolerance-collapse">
                    <x-svg icon="cui-pencil" />
                </button>
                @endif

                @for ($i = 0; $i < $repeatables; $i++)
                <div class="container side-effect-medicine-row {{$i < old('medicine_length', 1) ?' ':'d-none'}}">
                    <div class="col-md-12 my-2">

                        {{-- <x-forms.magic-search class="magic-search ajax" data-catalog-name="medicines" value='{{old("medicine_id.$i")}}'
                            hidden-id="side_effect_medicine_{{$i}}" hidden-name="medicine_id[]"
                            placeholder="Ընտրել դեղամիջոցը․․" /> --}}
                        <x-forms.magic-search class="magic-search-medicines" data-catalog-name="medicines" value='{{old("medicine_id.$i")}}'
                            hidden-id="side_effect_medicine_{{$i}}" hidden-name="medicine_id[]"
                            placeholder="Ընտրել դեղամիջոցը․․" />
                    </div>
                    <div class="col-md-12 my-2">
                        <textarea name="medicine_comment[]" class="form-control"
                            placeholder="ազատ գրառման դաշտ․․․">{{old("medicine_comment.$i")}}</textarea>
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
