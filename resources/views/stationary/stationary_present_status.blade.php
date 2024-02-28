{{-- @dump($stationary) --}}
<?php
    use App\Models\StationaryPresentStatus;

    $sps = $stationary->stationary_present_status ?? new StationaryPresentStatus();
    // dd($sps);
    $sps_preliminary = $stationary->stationary_diagnoses->where('diagnosis_type','=','stationary_present_status_preliminary')->first();
    $examination_program = $sps->examination_program_array ?? $examination_program_default_array;
?>
<section id="stationary-present-status">
    <ul class="list-group">
        <li class="list-group-item list-group-item-info">
            <h4 class="text-center my-2">
                Status praesens subjetivus et objectivus
                <x-forms.prev-posts-link href='{{$route."#stationary-present-status"}}' />
            </h4>
        </li>
        @if ($sps->user_id === auth()->id() || empty($sps->user_id))
        <form
            action="{{route('patients.stationary.present_status', ["patient" => $patient, "stationary" => $stationary])}}"
            method="post">
            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
            @csrf


            <li class="list-group-item">
                <h5 class="text-center">Հիվանդի ընդհանուր վիճակը</h5>
                <x-forms.text-field type="textarea" name="patient_general_condition" placeholder="լրացման ազատ դաշտ․․․"
                    value="{{old('patient_general_condition', $sps->patient_general_condition ?? null)}}" class="mt-2"
                    label="" />

                <hr>
                <strong>ըստ Կարնովսկու սանդղակի</strong>
                <x-forms.text-field type="textarea" name="by_karnowski_scale" placeholder="լրացման ազատ դաշտ․․․"
                    value="{{old('by_karnowski_scale', $sps->by_karnowski_scale ?? null)}}" class="mt-2" label="" />

                <hr>
                <strong>Գիտակցությունը</strong>
                <x-forms.text-field type="textarea" name="consciousness" placeholder="լրացման ազատ դաշտ․․․"
                    value="{{old('consciousness', $sps->consciousness ?? null)}}" class="mt-2" label="" />

                <hr>
                <strong>Դիրքը անկողնում</strong>
                <select name="position_in_bed" class="form-control mt-2">
                    <option value="">ընտրել դիրքը անկողնում․․․</option>
                    @foreach ($position_in_bed_enum as $item)
                    <option value="{{$item}}" @if (old('position_in_bed',$sps->position_in_bed ? $sps->position_in_bed->getValue() :
                        null) === $item)
                        selected='selected'
                        @endif>
                        {{__("enums.position_in_bed_enum.$item")}}
                    </option>
                    @endforeach
                </select>
            </li>

            <li class="list-group-item">
                <h5 class="text-center">Մաշկածածկույթները</h5>
                <select name="skin_coverings" class="form-control mt-2">
                    <option value="">ընտրել մաշկածածկույթները․․․</option>
                    @foreach ($skin_coverings_enum as $item)
                    <option value="{{$item}}" @if (old('skin_coverings',$sps->skin_coverings ? $sps->skin_coverings->getValue() : null)
                        === $item)
                        selected='selected'
                        @endif>
                        {{__("enums.skin_coverings_enum.$item")}}
                    </option>
                    @endforeach
                </select>

                <hr>
                <strong>Ենթամաշկային ճարպաշերտը</strong>
                <select name="subcutaneous_fat" class="form-control mt-2">
                    <option value="">ընտրել ենթամաշկային ճարպաշերտը․․․</option>
                    @foreach ($subcutaneous_fat_enum as $item)
                    <option value="{{$item}}" @if (old('subcutaneous_fat',$sps->subcutaneous_fat ? $sps->subcutaneous_fat->getValue() :
                        null) === $item)
                        selected='selected'
                        @endif>
                        {{__("enums.subcutaneous_fat_enum.$item")}}
                    </option>
                    @endforeach
                </select>

                <hr>
                <div class="form-row align-items-center">
                    <div class="col-md-2">
                        <strong>Ճարպակալում</strong>
                    </div>
                    <div class="col-md-8">
                        <!-- կարիք չկա բազա (obesity) տանելու -->
                        <div class="input-group align-items-center">
                            <x-forms.text-field type="number" disabled value="{{$stationary->bmi}}" name="obesity_bmi"
                                class="col-4" min="0" label="" />
                            <label class="ml-2" for="obesity_bmi"><strong>աստիճանի</strong></label>
                        </div>
                    </div>
                </div>

                <hr>
                <div class="row">
                    <div class="col-md-9">
                        <strong>
                            Ստորին վեջույթների ենթամաշկային երակների վարիկոզ լայնացում
                        </strong>
                    </div>
                    <div class="col-md-3">
                        <x-forms.checkbox-radio pos="align" id="vole-radio1" value="1"
                            name="varicose_of_lower_extremities"
                            old-default="{{$sps->varicose_of_lower_extremities ?? null}}" label="Այո" />
                        <x-forms.checkbox-radio pos="align" id="vole-radio2" value="0"
                            name="varicose_of_lower_extremities"
                            old-default="{{$sps->varicose_of_lower_extremities ?? null}}" label="Ոչ" />
                        @error('varicose_of_lower_extremities')
                        <em class="error text-danger">{{$message}}</em>
                        @enderror
                    </div>
                </div>

                <hr class="hr-dashed">
                <x-forms.text-field type="textarea" name="varicose_of_lower_extremities_comment"
                    placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                    value="{{old('varicose_of_lower_extremities_comment', $sps->varicose_of_lower_extremities_comment ?? null)}}"
                    label="" />

                <hr>
                <div class="row">
                    <div class="col-md-9">
                        <strong>
                            Ծայրամասային այտուցներ
                        </strong>
                    </div>
                    <div class="col-md-3">
                        <x-forms.checkbox-radio pos="align" id="pe-radio1" value="1" name="peripheral_edema"
                            old-default="{{$sps->peripheral_edema ?? null}}" label="Այո" />
                        <x-forms.checkbox-radio pos="align" id="pe-radio2" value="0" name="peripheral_edema"
                            old-default="{{$sps->peripheral_edema ?? null}}" label="Ոչ" />
                        @error('peripheral_edema')
                        <em class="error text-danger">{{$message}}</em>
                        @enderror
                    </div>
                </div>

                <hr class="hr-dashed">
                <x-forms.text-field type="textarea" name="peripheral_edema_comment" placeholder="լրացման ազատ դաշտ․․․"
                    class="mt-2" value="{{old('peripheral_edema_comment', $sps->peripheral_edema_comment ?? null)}}"
                    label="" />
            </li>


            <li class="list-group-item">
                <h5 class="text-center">Ավշային հանգույցներ</h5>
                <x-forms.text-field type="textarea" name="lymph_node" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                    value="{{old('lymph_node', $sps->lymph_node ?? null)}}" label="" />
            </li>
            <li class="list-group-item">
                <h5 class="text-center">Հենաշարժիչ համակարգ</h5>
                <x-forms.text-field type="textarea" name="propulsion_system" placeholder="լրացման ազատ դաշտ․․․"
                    class="mt-2" value="{{old('propulsion_system', $sps->propulsion_system ?? null)}}" label="" />
            </li>
            <li class="list-group-item">
                <h5 class="text-center">Նյարդային համակարգ</h5>
                <x-forms.text-field type="textarea" name="nervous_system" placeholder="լրացման ազատ դաշտ․․․"
                    class="mt-2" value="{{old('nervous_system', $sps->nervous_system ?? null)}}" label="" />
            </li>
            <li class="list-group-item">
                <h5 class="text-center">Կրծքագեղձեր</h5>
                <x-forms.text-field type="textarea" name="breasts" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                    value="{{old('breasts', $sps->breasts ?? null)}}" label="" />
            </li>
            <li class="list-group-item">
                <h5 class="text-center">Շնչառական համակարգ</h5>
                <strong>Շնչառական գանգատներ</strong>
                <x-forms.text-field type="textarea" name="respiratory_complaints" placeholder="լրացման ազատ դաշտ․․․"
                    class="mt-2" value="{{old('respiratory_complaints', $sps->respiratory_complaints ?? null)}}"
                    label="" />

                <hr>
                <strong>Շնչառությունը</strong>
                <select name="breathing_type" class="form-control mt-2">
                    <option value="">ընտրել շնչառության տիպը․․․</option>
                    @foreach ($breathing_type_enum as $item)
                    <option value="{{$item}}" @if (old('breathing_type',$sps->breathing_type ? $sps->breathing_type->getValue() : null)
                        === $item)
                        selected='selected'
                        @endif>
                        {{__("enums.breathing_type_enum.$item")}}
                    </option>
                    @endforeach
                </select>

                <hr>
                <strong>Թոքերի բախում</strong>
                <x-forms.text-field type="textarea" name="lung_collision" placeholder="լրացման ազատ դաշտ․․․"
                    class="mt-2" value="{{old('lung_collision', $sps->lung_collision ?? null)}}" label="" />

                <hr>
                <strong>Թոքերի լսում</strong>
                <x-forms.text-field type="textarea" name="listening_breathing" placeholder="լրացման ազատ դաշտ․․․"
                    class="mt-2" value="{{old('listening_breathing', $sps->listening_breathing ?? null)}}" label="" />

                <hr>
                <strong>Շնչառական շարժումների հաճախականությունը (1 րոպեում)</strong>
                <x-forms.text-field type="textarea" name="respiratory_movements_frequency_per_minute"
                    placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                    value="{{old('respiratory_movements_frequency_per_minute', $sps->respiratory_movements_frequency_per_minute ?? null)}}"
                    label="" />
            </li>

            <li class="list-group-item">
                <h5 class="text-center">Սիրտ-անոթային համակարգ</h5>
                <strong>Սիրտ-անոթային գանգատներ</strong>
                <x-forms.text-field type="textarea" name="cardiovascular_complaints" placeholder="լրացման ազատ դաշտ․․․"
                    class="mt-2" value="{{old('cardiovascular_complaints', $sps->cardiovascular_complaints ?? null)}}"
                    label="" />

                <hr>
                <strong>Սրտի պերկուտոր սահմաններ</strong>
                <x-forms.text-field type="textarea" name="heart_percutaneous_border" placeholder="լրացման ազատ դաշտ․․․"
                    class="mt-2" value="{{old('heart_percutaneous_border', $sps->heart_percutaneous_border ?? null)}}"
                    label="" />

                <hr>
                <strong>Սրտի լսում</strong>
                <x-forms.text-field type="textarea" name="heartbeat" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                    value="{{old('heartbeat', $sps->heartbeat ?? null)}}" label="" />

                <hr>
                <strong>Անոթազարկ</strong>
                <x-forms.text-field type="textarea" name="vascular_stroke" placeholder="լրացման ազատ դաշտ․․․"
                    class="mt-2" value="{{old('vascular_stroke', $sps->vascular_stroke ?? null)}}" label="" />

                <hr>
                <div class="form-row align-items-center">
                    <div class="col-md-4">
                        <strong>Զարկերակային ճնշում</strong>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group align-items-center">
                            <strong class="mr-2">Սիստոլիկ</strong>
                            <x-forms.text-field type="number" name="blood_pressure_systolic" class="col-4" min="0"
                                value="{{old('blood_pressure_systolic', $sps->blood_pressure_systolic ?? null)}}" label="" />
                            <label class="ml-2 my-0" for="blood_pressure_systolic"><strong>մմ ս․ս․</strong></label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group align-items-center">
                            <strong class="mr-2">Դիաստոլիկ</strong>
                            <x-forms.text-field type="number" name="blood_pressure_diastolic" class="col-4" min="0"
                                value="{{old('blood_pressure_diastolic', $sps->blood_pressure_diastolic ?? null)}}" label="" />
                            <label class="ml-2 my-0" for="blood_pressure_diastolic"><strong>մմ ս․ս․</strong></label>
                        </div>
                    </div>
                </div>
            </li>

            <li class="list-group-item">
                <h5 class="text-center">Էնդոկրին համակարգ</h5>
                <x-forms.text-field type="textarea" name="endocrine_system" placeholder="լրացման ազատ դաշտ․․․"
                    class="mt-2" value="{{old('endocrine_system', $sps->endocrine_system ?? null)}}" label="" />
            </li>

            <li class="list-group-item">
                <h5 class="text-center">LOR օրգաններ</h5>
                <x-forms.text-field type="textarea" name="lor_organs" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                    value="{{old('lor_organs', $sps->lor_organs ?? null)}}" label="" />
            </li>

            <li class="list-group-item">
                <h5 class="text-center">Մարսողական համակարգ</h5>
                <strong>Մարսողական գանգատներ</strong>
                <x-forms.text-field type="textarea" name="digestive_complaints" placeholder="լրացման ազատ դաշտ․․․"
                    class="mt-2" value="{{old('digestive_complaints', $sps->digestive_complaints ?? null)}}" label="" />

                <hr>
                <strong>Լեզուն</strong>
                <select name="tongue_state" class="form-control mt-2">
                    <option value="">ընտրել լեզվի վիճակը․․․</option>
                    @foreach ($tongue_state_enum as $item)
                    <option value="{{$item}}" @if (old('tongue_state', $sps->tongue_state ? $sps->tongue_state->getValue() : null) ===
                        $item)
                        selected='selected'
                        @endif>
                        {{__("enums.tongue_state_enum.$item")}}
                    </option>
                    @endforeach
                </select>

                <hr>
                <strong>Կլման ակտը</strong>
                <select name="act_of_absorption" class="form-control mt-2">
                    <option value="">ընտրել կլման ակտի նկարագրությունը․․․</option>
                    @foreach ($act_of_absorption_enum as $item)
                    <option value="{{$item}}" @if (old('act_of_absorption', $sps->act_of_absorption ? $sps->act_of_absorption->getValue() :
                        null) === $item)
                        selected='selected'
                        @endif>
                        {{__("enums.act_of_absorption_enum.$item")}}
                    </option>
                    @endforeach
                </select>

                <hr class="hr-dashed">
                <small>(դժվարացած) կլման ակտի դժվարության աստիճանը</small>
                <x-forms.text-field type="textarea" name="absorption_difficulty_degree"
                    placeholder="ազատ լրացման դաշտ․․․" class="mt-2"
                    value="{{old('absorption_difficulty_degree', $sps->absorption_difficulty_degree ?? null)}}"
                    label="" />


                <hr>
                <div class="row">
                    <div class="col-md-7">
                        <strong>
                            Որովայնը՝
                        </strong>
                    </div>
                    <div class="col-md-5">
                        <x-forms.checkbox-radio pos="align" id="ais-radio1" value="1" name="abdomen_is_symmetrical"
                            old-default="{{$sps->peripheral_edema ?? null}}" label="համաչափ" />
                        <x-forms.checkbox-radio pos="align" id="ais-radio2" value="0" name="abdomen_is_symmetrical"
                            old-default="{{$sps->peripheral_edema ?? null}}" label="անհամաչափ" />
                        @error('abdomen_is_symmetrical')
                        <em class="error text-danger">{{$message}}</em>
                        @enderror
                    </div>
                </div>

                <hr>
                <div class="row">
                    <div class="col-md-7">
                        <strong>
                            Շնչառությանը՝
                        </strong>
                    </div>
                    <div class="col-md-5">
                        <x-forms.checkbox-radio pos="align" id="aiib-radio1" value="1"
                            name="abdomen_is_involved_in_breathing"
                            old-default="{{$sps->abdomen_is_involved_in_breathing ?? null}}" label="մասնակցում է" />
                        <x-forms.checkbox-radio pos="align" id="aiib-radio2" value="0"
                            name="abdomen_is_involved_in_breathing"
                            old-default="{{$sps->abdomen_is_involved_in_breathing ?? null}}" label="չի մասնակցում" />
                        @error('abdomen_is_involved_in_breathing')
                        <em class="error text-danger">{{$message}}</em>
                        @enderror
                    </div>
                </div>

                <hr>
                <strong>Ցավոտություն շոշափման ժամանակ</strong>
                <x-forms.text-field type="textarea" name="pain_when_touching_abdomen_comment"
                    placeholder="ազատ լրացման դաշտ․․․" class="mt-2"
                    value="{{old('pain_when_touching_abdomen_comment', $sps->pain_when_touching_abdomen_comment ?? null)}}"
                    label="" />

                <hr>
                <strong>որովայնամիզային ախտանշանները՝</strong>
                <select name="abdominal_urinary_symptom" class="form-control mt-2">
                    <option value="">ընտրել առկա որովայնամիզային ախտանշանները․․․</option>
                    @foreach ($abdominal_urinary_symptom_enum as $item)
                    <option value="{{$item}}" @if (old('abdominal_urinary_symptom', $sps->abdominal_urinary_symptom ? $sps->abdominal_urinary_symptom->getValue() : null) === $item)
                        selected='selected'
                        @endif>
                        {{__("enums.abdominal_urinary_symptom_enum.$item")}}
                    </option>
                    @endforeach
                </select>

                <hr class="hr-dashed">
                <small>(տեղակայումը)՝</small>
                <x-forms.text-field type="textarea" name="abdominal_urinary_symptom_comment"
                    placeholder="ազատ լրացման դաշտ․․․" class="mt-2"
                    value="{{old('abdominal_urinary_symptom_comment', $sps->abdominal_urinary_symptom_comment ?? null)}}"
                    label="" />

                <hr>
                <div class="form-row align-items-center">
                    <div class="col-md-4">
                        <strong>լյարդը</strong><br>
                        <x-forms.checkbox-radio pos="align" id="lie-radio1" value="1" name="liver_is_enlarged"
                            old-default="{{$sps->liver_is_enlarged ?? $sps}}" label="մեծացած է" />
                        <x-forms.checkbox-radio pos="align" id="lie-radio2" value="0" name="liver_is_enlarged"
                            old-default="{{$sps->liver_is_enlarged ?? $sps}}" label="մեծացած չէ" />
                        @error('liver_is_enlarged')
                        <em class="error text-danger">{{$message}}</em>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <strong>չափը (սմ.)</strong>
                        <x-forms.text-field type="number" name="liver_size" class="col-10" min="0"
                            value="{{old('liver_size', $sps->liver_size ?? null)}}" label="" />
                    </div>
                    <div class="col-md-4">
                        <strong>ձևը</strong>
                        <select name="liver_type" class="form-control mt-2">
                            <option value="">ընտրել լյարդի ձևը․․․</option>
                            @foreach ($liver_and_spleen_type_enum as $item)
                            <option value="{{$item}}" @if (old('liver_type', $sps->liver_type ? $sps->liver_type->getValue() : null)
                                === $item)
                                selected='selected'
                                @endif>
                                {{__("enums.liver_and_spleen_type_enum.$item")}}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <hr>
                <div class="form-row align-items-center">
                    <div class="col-md-4">
                        <strong>փայծախը`</strong><br>
                        <x-forms.checkbox-radio pos="align" id="sie-radio1" value="1" name="spleen_is_enlarged"
                            old-default="{{$sps->spleen_is_enlarged ?? null}}" label="մեծացած է" />
                        <x-forms.checkbox-radio pos="align" id="sie-radio2" value="0" name="spleen_is_enlarged"
                            old-default="{{$sps->spleen_is_enlarged ?? null}}" label="մեծացած չէ" />
                        @error('spleen_is_enlarged')
                        <em class="error text-danger">{{$message}}</em>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <strong>չափը (սմ.)</strong>
                        <x-forms.text-field type="number" name="spleen_size" class="col-10" min="0"
                            value="{{old('spleen_size', $sps->spleen_size ?? null)}}" label="" />
                    </div>
                    <div class="col-md-4">
                        <strong>ձևը</strong>
                        <select name="spleen_type" class="form-control mt-2">
                            <option value="">ընտրել փայծախի ձևը․․․</option>
                            @foreach ($liver_and_spleen_type_enum as $item)
                            <option value="{{$item}}" @if (old('spleen_type', $sps->spleen_type ? $sps->spleen_type->getValue() :
                                null) === $item)
                                selected='selected'
                                @endif>
                                {{__("enums.liver_and_spleen_type_enum.$item")}}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <hr>
                <strong>աղիքային պերիստալտիկան՝</strong>
                <select name="intestinal_peristalsis" class="form-control mt-2">
                    <option value="">ընտրել աղիքային պերիստալտիկան․․․</option>
                    @foreach ($intestinal_peristalsis_enum as $item)
                    <option value="{{$item}}" @if (old('intestinal_peristalsis', $sps->intestinal_peristalsis ? $sps->intestinal_peristalsis->getValue() : null) === $item)
                        selected='selected'
                        @endif>
                        {{__("enums.intestinal_peristalsis_enum.$item")}}
                    </option>
                    @endforeach
                </select>
            </li>

            <li class="list-group-item">
                <h5 class="text-center">Միզասեռական համակարգ՝</h5>
                <strong>միզասեռական գանգատներ՝</strong>
                <x-forms.text-field type="textarea" name="urogenital_complaints" placeholder="ազատ լրացման դաշտ․․․"
                    class="mt-2" value="{{old('urogenital_complaints', $sps->urogenital_complaints ?? null)}}"
                    label="" />

                <hr>
                <strong>միզարձակումը՝</strong>
                <select name="urination_type" class="form-control mt-2">
                    <option value="">ընտրել միզարձակման ակտի նկարագրությունը․․․</option>
                    @foreach ($urination_type_enum as $item)
                    <option value="{{$item}}" @if (old('urination_type', $sps->urination_type ? $sps->urination_type->getValue() : null)
                        === $item)
                        selected='selected'
                        @endif>
                        {{__("enums.urination_type_enum.$item")}}
                    </option>
                    @endforeach
                </select>

                <hr>
                <div class="row">
                    <div class="col-md-7">
                        <strong>
                            բաշխման ախտանշանը՝
                        </strong>
                    </div>
                    <div class="col-md-5">
                        <x-forms.checkbox-radio pos="align" id="soud-radio1" value="1"
                            name="symptom_of_urogenital_distribution"
                            old-default="{{$sps->symptom_of_urogenital_distribution ?? null}}" label="դրական" />
                        <x-forms.checkbox-radio pos="align" id="soud-radio2" value="0"
                            name="symptom_of_urogenital_distribution"
                            old-default="{{$sps->symptom_of_urogenital_distribution ?? null}}" label="բացասական" />
                        @error('symptom_of_urogenital_distribution')
                        <em class="error text-danger">{{$message}}</em>
                        @enderror
                    </div>
                </div>

                <hr>
                <div class="row">
                    <div class="col-md-7">
                        <strong>
                            բաշխման ախտանշանի դիրքը (կողմից)՝
                        </strong>
                    </div>
                    <div class="col-md-12">
                        <x-forms.text-field type="textarea" name="symptom_of_urogenital_distribution_comment"
                            placeholder="ազատ լրացման դաշտ․․․" class="mt-2"
                            value="{{old('symptom_of_urogenital_distribution_comment', $sps->symptom_of_urogenital_distribution_comment ?? null)}}"
                            label="" />
                    </div>
                </div>
            </li>

            <li class="list-group-item">
                <h5 class="text-center">Status localis</h5>
                <x-forms.text-field type="textarea" name="status_localis" placeholder="ազատ լրացման դաշտ․․․"
                    class="mt-2" value="{{old('status_localis', $sps->status_localis ?? null)}}" label="" />
            </li>

            <li class="list-group-item">
                <h5 class="text-center">Նախնական ախտորոշում՝</h5>
                <x-forms.magic-search class="magic-search-diseases mt-2" placeholder="Ընտրել ախտորոշումը․․․"
                    hidden-id="present_status_preliminary_disease_id"
                    hidden-name="present_status_preliminary_disease_id"
                    value="{{old('present_status_preliminary_disease_id', $sps_preliminary->disease_id ?? null)}}" />

                <hr class="hr-dashed">
                <x-forms.text-field type="textarea" name="present_status_preliminary_diagnosis_comment"
                    placeholder="ազատ լրացման դաշտ․․․"
                    value="{{old('present_status_preliminary_diagnosis_comment', $sps_preliminary->diagnosis_comment ?? null)}}"
                    label="" />
            </li>

            <li class="list-group-item">
                {{-- @dump($examination_program) --}}
                @php
                $ultrasoundable_number_base = count($examination_type_enum) + 1;
                $otherexamtype_number_base = count($ultrasoundable_body_part_enum) + $ultrasoundable_number_base;
                $otherexamtype_length_default = count($examination_program['other']);
                @endphp

                <h5 class="text-center">Հետազոտության ծրագիր՝</h5>
                <input type="hidden" name="examination_program[not_ultrasoundable][]" value="">
                @foreach ($examination_type_enum as $key => $item)
                <x-forms.checkbox-radio type="checkbox" pos="valign" name="examination_program[not_ultrasoundable][]"
                    id="exam-type-{{$item}}" value="{{$item}}"
                    label='{{$key+1}} . {{__("enums.examination_type_enum.$item")}}'
                    check="{{in_array($item, $examination_program['not_ultrasoundable'])}}" />
                @endforeach

                <strong>ուլտրաձայնային հետազոտություն՝</strong>
                <input type="hidden" name="examination_program[ultrasoundable][]" class="my-2" value="">
                @foreach ($ultrasoundable_body_part_enum as $key => $item)
                <x-forms.checkbox-radio type="checkbox" pos="valign" name="examination_program[ultrasoundable][]"
                    id="exam-type-{{$item}}" value="{{$item}}"
                    label='{{$key + $ultrasoundable_number_base}} . {{__("enums.ultrasoundable_body_part_enum.$item")}}'
                    check="{{in_array($item, $examination_program['ultrasoundable'])}}" />
                @endforeach

                <strong>այլ՝</strong>
                <div class="my-2">
                    <x-forms.add-reduce-button type="add" data-row=".other-exam-type-row" />
                    <x-forms.add-reduce-button type="reduce" data-row=".other-exam-type-row" />
                    <x-forms.hidden-counter class="other-exam-type-rows" name="other_exam_type_length"
                        old="{{$otherexamtype_length_default}}" />

                    @for ($i = 0; $i < $repeatables; $i++) <div
                        class="form-row mt-2 other-exam-type-row {{$i < old('other_exam_type_length', $otherexamtype_length_default) ?' ':'d-none'}}">
                        <div class="col-md-1 border-secondary rounded">{{$otherexamtype_number_base + $i}} .</div>
                        <div class="col-md-11">
                            <textarea name="examination_program[other][]" placeholder="ազատ գրառման դաշտ․․․"
                                class="form-control">{{old("examination_program.other.$i", $examination_program['other'][$i] ?? null)}}</textarea>
                        </div>
                </div>
                @endfor
                </div>
            </li>

            {{-- <li class="list-group-item list-group-item-secondary">
        <button type="submit" class="btn btn-primary">Պահպանել "Status praesens subjetivus et objectivus" փոփոխությունները</button>
    </li> --}}
            @include('shared.forms.list_group_item_submit',['btn_text' => 'Պահպանել'])
        </form>
        @endif
    </ul>
</section>
