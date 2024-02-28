@php
use App\Models\StationaryPrimaryExamination;

$primary_examination = $stationary->stationary_primary_examination ?? new StationaryPrimaryExamination;

$route = route("patients.stationary.show", ["patient" => $patient, "stationary" => $stationary]);
@endphp

<section id="primary-examination">
    {{-- <form method="POST" id="primary-examination-form" --}}
    <form method="POST" class="ajax-submitable"
        action="{{ route("patients.stationary.primary_examination", ["patient" => $patient, "stationary" => $stationary]) }}">
        @csrf
        @method("PATCH")

        <ul class="list-group mt-2">
            <li class="list-group-item list-group-item-info">
                <h4 class="text-center">Առաջնային զննում
                    <x-forms.prev-posts-link href='{{$route."#primary-examination"}}' />
                </h4>
            </li>
            @if ($primary_examination->user_id === auth()->id() || empty($primary_examination->user_id))

            <li class="list-group-item">
                <div class="form-row align-items-center">
                    <div class="col-sm-12 col-md-4">
                        <strong>Զննման ամսաթիվ</strong>
                    </div>
                    <div class="col-sm-12 col-md-8">
                        <x-forms.text-field type="date" name="examination_date"
                            :value="$primary_examination->examination_date ? $primary_examination->getFormattedDate('examination_date') : ''" />
                    </div>
                </div>
            </li>

            <li class="list-group-item">
                <div class="form-group">
                    <x-forms.text-field type="textarea" label="Գանգատներ" name="complaints"
                        :value="$primary_examination->complaints" />
                </div>
            </li>

            <li class=" list-group-item">
                <div class="form-group">
                    <x-forms.text-field type="textarea" label="Anamnesis morbi" name="anamnesis_morbi"
                        :value="$primary_examination->anamnesis_morbi" />
                </div>
            </li>

            <li class="list-group-item">
                <div class="form-group">
                    <x-forms.text-field type="textarea" label="Աճը և զարգացումը" name="growth_and_development"
                        :value="$primary_examination->growth_and_development" />
                </div>
            </li>

            <li class="list-group-item">
                <strong>Նախկինում տարած ուրիշ հիվանդություններ</strong>
                <x-forms.add-reduce-button type="add" data-row=".previous-disease-row" />
                <x-forms.add-reduce-button type="reduce" data-row=".previous-disease-row" />
                <x-forms.hidden-counter class="previous-disease-rows" name="previous_diseases_length" />
                <h6><a href="{{ $route."#diagnoses-previous-disease" }}" target="_blank">Նախկին գրառումներ</a></h6>

                @for ($i = 0; $i < $repeatables; $i++) <div
                    class="container previous-disease-row {{$i < old('previous_diseases_length', 1) ?' ':'d-none'}}">
                    <div class="col-md-12 my-2">
                        <div class="react-select-container" data-name="previous_disease_ids[]"></div>
                    </div>
                    <div class="col-md-12 my-2">
                        <textarea name="previous_disease_comments[]"
                            class="form-control">{{old("previous_disease_comments.$i")}}</textarea>
                    </div>
                    </div>
                    @endfor
            </li>

            <li class="list-group-item">
                <strong>Վիրահատություններ</strong>
                <x-forms.add-reduce-button type="add" data-row=".surgery-row" />
                <x-forms.add-reduce-button type="reduce" data-row=".surgery-row" />
                <x-forms.hidden-counter class="surgery-rows" name="surgeries_length" />
                <h6><a href="{{ $route."#surgeries-primary-examination" }}" target="_blank">Նախկին գրառումներ</a></h6>

                @for ($i = 0; $i < $repeatables; $i++) <div
                    class="container surgery-row {{$i < old('surgeries_length', 1) ?' ':'d-none'}}">
                    <div class="col-md-12 my-2">
                        <div class="react-select-container" data-name="surgery_ids[]" data-catalog-name="surgeries">
                        </div>
                    </div>
                    <div class="col-md-12 my-2">
                        <textarea name="surgery_comments[]"
                            class="form-control">{{old("surgery_comments.$i")}}</textarea>
                    </div>
                    </div>
                    @endfor
            </li>

            <li class="list-group-item">
                <strong>Դեղանյութերի հանդեպ ալերգիկ երևութներ</strong>
                <x-forms.add-reduce-button type="add" data-row=".medicine-side-effect-row" />
                <x-forms.add-reduce-button type="reduce" data-row=".medicine-side-effect-row" />
                <x-forms.hidden-counter class="surgery-rows" name="medicine_side_effects_length" />
                <h6><a href="{{ $route."#medicine-side-effects-allergy" }}" target="_blank">Նախկին գրառումներ</a></h6>

                @for ($i = 0; $i < $repeatables; $i++) <div
                    class="container medicine-side-effect-row {{$i < old('medicine_side_effects_length', 1) ?' ':'d-none'}}">
                    <div class="col-md-12 my-2">
                        <div class="react-select-container" data-name="medicine_ids[]" data-catalog-name="medicines">
                        </div>
                    </div>
                    <div class="col-md-12 my-2">
                        <textarea name="medicine_side_effect_comments[]"
                            class="form-control">{{old("medicine_side_effect_comments.$i")}}</textarea>
                    </div>
                    </div>
                    @endfor
            </li>

            <li class="list-group-item">
                <strong>Վնասակար սովորություններ</strong>
                <a href="{{ $route."#stationary-harmfuls" }}" class="btn btn-primary" target="_blank">
                    <x-svg icon="cui-external-link" />
                </a>
                <x-forms.add-reduce-button type="add" data-row=".harmful-row" />
                <x-forms.add-reduce-button type="reduce" data-row=".harmful-row" />
                <x-forms.hidden-counter class="harmful-rows" name="harmfuls_length" />
                <h6><a href="{{ $route."#stationary_harmfuls" }}" target="_blank">Նախկին գրառումներ</a></h6>

                @for ($i = 0; $i < $repeatables; $i++) <div
                    class="container harmful-row {{$i < old('harmfuls_length', 1) ?' ':'d-none'}}">
                    <x-forms.magic-search class="magic-search ajax"
                        data-catalog-name="harmfuls"
                        hidden-id="harmfuls_{{ $i }}"
                        hidden-name="harmful_ids[]" placeholder="Ընտրել վնասակար սովորություն․․․" />
                    <div class="col-md-12 my-2">
                        <textarea name="harmful_comments[]"
                            class="form-control">{{old("harmful_comments.$i")}}</textarea>
                    </div>
                    </div>
                    @endfor
            </li>

            <li class="list-group-item">
                <div class="form-group">
                    <x-forms.text-field type="textarea" label="Ժառանգականությունը ծանրաբեռնված" name="inheritance"
                        :value="$primary_examination->inheritance" />
                </div>
            </li>

            <li class="list-group-item">
                <div class="form-group">
                    <x-forms.text-field type="textarea" label="Սեռական անամնեզ" name="sextual_history"
                        :value="$primary_examination->sextual_history" />
                </div>
            </li>

            <li class="list-group-item">
                <div class="form-row">
                    <div class="form-group col-sm-12 col-md-4">
                        <x-forms.text-field type="number" min="0" max="25" label="Menarche" name="menarche_age"
                            :value="$primary_examination->menarche_age" />
                    </div>

                    <div class="form-group col-sm-12 col-md-4">
                        <x-forms.text-field type="number" min="0" max="254" label="Դաշտանի տևողությունը" name="cycle_from"
                            :value="$primary_examination->cycle_from" />
                    </div>

                    <div class="form-group col-sm-12 col-md-4">
                        <x-forms.text-field type="number" min="0" max="254" label="Դաշտանային ցիկլի տևողությունը" name="cycle_to"
                            :value="$primary_examination->cycle_to" />
                    </div>
                </div>
            </li>

            <li class="list-group-item">
                <div class="form-row">
                    <div class="form-group col-sm-12 col-md-4">
                        <x-forms.text-field type="date" label="Վերջին mensis" name="last_mensis"
                            :value="$primary_examination->last_mensis" />
                    </div>

                    <div class="form-group col-sm-12 col-md-4">
                        <x-forms.text-field type="number" min="0" max="254" label="Menopausa" name="menopausa_age"
                            :value="$primary_examination->menopausa_age" />
                    </div>

                    <div class="form-group col-sm-12 col-md-4">
                        <x-forms.text-field type="number" min="0" max="254" label="Հղիությունների թիվը"
                            name="number_of_pregnancies" :value="$primary_examination->number_of_pregnancies" />
                    </div>
                </div>
            </li>

            <li class="list-group-item">
                <div class="form-row">
                    <div class="form-group col-sm-12 col-md-4">
                        <x-forms.text-field type="number" min="0" max="254" label="Ծննդաբերություններ"
                            name="number_of_births" :value="$primary_examination->number_of_births" />
                    </div>

                    <div class="form-group col-sm-12 col-md-4">
                        <x-forms.text-field type="number" min="0" max="254" label="Արհեստական ընդհատումներ"
                            name="number_of_interruptions" :value="$primary_examination->number_of_interruptions" />
                    </div>

                    <div class="form-group col-sm-12 col-md-4">
                        <x-forms.text-field type="number" min="0" max="254" label="Վիժումներ" name="number_of_abortions"
                            :value="$primary_examination->number_of_abortions" />
                    </div>
                </div>
            </li>

            <li class="list-group-item">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-5">
                            <strong>
                                Կրծքով կերակրելը
                            </strong>
                        </div>
                        <div class="col-md-7">
                            <x-forms.checkbox-radio pos="align" id="breast-feeding-radio1" value="1"
                                old-default="{{$primary_examination->breast_feeding}}" name="breast_feeding"
                                label="Այո" />
                            <x-forms.checkbox-radio pos="align" id="breast-feeding-radio2" value="0"
                                old-default="{{$primary_examination->breast_feeding}}" name="breast_feeding"
                                label="Ոչ" />
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <x-forms.text-field type="textarea" name="breast_feeding_comment"
                        :value="$primary_examination->breast_feeding_comment" />
                </div>
            </li>

            <li class="list-group-item">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-5">
                            <strong>
                                Հորմոնային դեղամիջոցների ընդունում
                            </strong>
                        </div>
                        <div class="col-md-7">
                            <x-forms.checkbox-radio pos="align" id="hormonal-drugs-radio1" value="1"
                                old-default="{{$primary_examination->taking_hormonal_drugs}}"
                                name="taking_hormonal_drugs" label="Այո" />
                            <x-forms.checkbox-radio pos="align" id="hormonal-drugs-radio2" value="0"
                                old-default="{{$primary_examination->taking_hormonal_drugs}}"
                                name="taking_hormonal_drugs" label="Ոչ" />
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <x-forms.text-field type="textarea" name="taking_hormonal_drugs_comment"
                        :value="$primary_examination->taking_hormonal_drugs_comment" validationType="ajax" />
                </div>
            </li>

            @include('shared.forms.list_group_item_submit', ["has_files" => true, "btn_text" => "Պահպանել Առաջնային
            Զննումը"])
            @endif
        </ul>

    </form>

</section>
