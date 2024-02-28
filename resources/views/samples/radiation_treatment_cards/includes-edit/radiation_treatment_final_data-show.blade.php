@php
    $treatment_final_data =  $card->treatment_final_data;
@endphp



    <li class="list-group-item list-group-item-info">
        <div class="text-center my-2">

            <h4>Եզրափակիչ տվյալներ</h4>
        </div>
        <ins class="ml-4"></ins>

    </li>

    <li class="list-group-item">
        <strong>
            <span class="badge badge-light mr-1">16.</span>
            Ճառագ․․ ռեակցիա՝
        </strong>
        <div class="form-group form-check-inline">
            <input name="radio_reaction_no" value="{{ $treatment_final_data->radio_reaction_no }}" type="checkbox" class="form-check-input" id="radiation_reaction_no">
            <label class="form-check-label" for="radiation_reaction_no">չկա</label>
        </div>
        <div class="form-group form-check-inline">
            <input name="radio_reaction_location" value="{{ $treatment_final_data->radio_reaction_location }}" type="checkbox" class="form-check-input" id="radiation_reaction_local">
            <label class="form-check-label" for="radiation_reaction_local">տեղ</label>
        </div>
        <div class="form-group form-check-inline">
            <input name="radio_reaction_hematologist" type="checkbox" value="{{ $treatment_final_data->radio_reaction_hematologist }}"  class="form-check-input" id="radiation_reaction_hemolog">
            <label class="form-check-label" for="radiation_reaction_hemolog">արյունաբան</label>
        </div>
        <div class="form-group form-check-inline">
            <input name="radio_reaction_general" value="{{ $treatment_final_data->radio_reaction_general }}"  type="checkbox" class="form-check-input" id="radiation_reaction_basic">
            <label class="form-check-label" for="radiation_reaction_basic">ընդհանուր</label>
        </div>

        <span class="badge badge-light mr-1">Աստիճանը</span>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="radio_reaction_category" {{ $treatment_final_data->radio_reaction_category == 1 ? 'checked' : '' }} id="radiation_reaction_level" value="1">
            <label class="form-check-label" for="radiation_reaction_level">1-ին</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="radio_reaction_category" id="radiation_reaction_level" {{ $treatment_final_data->radio_reaction_category == 2 ? 'checked' : '' }} value="2">
            <label class="form-check-label" for="radiation_reaction_level">2-րդ</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="radio_reaction_category" {{ $treatment_final_data->radio_reaction_category == 3 ? 'checked' : '' }} id="radiation_reaction_level" value="3">
            <label class="form-check-label" for="radiation_reaction_level">3-րդ</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" {{ $treatment_final_data->radio_reaction_category == 4 ? 'checked' : '' }} name="radio_reaction_category" id="radiation_reaction_level" value="4">
            <label class="form-check-label" for="radiation_reaction_level">4-րդ</label>
        </div>


        <x-forms.text-field type="textarea" name="radio_reaction_comment" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                            value="{{ $treatment_final_data->radio_reaction_comment }}" label="" />
        <ins class="ml-4"></ins>

    </li>

    <li class="list-group-item">
        <strong>
            <span class="badge badge-light mr-1">17․</span>
            Բուժման արդյունքը՝
        </strong>

        <div class="form-group form-check-inline">
            <input name="radio_reaction_full_absorption" {{ isset($treatment_final_data->radio_reaction_full_absorption)  ? 'checked' : '' }} type="checkbox" class="form-check-input" id="treatment_result_full_absorption">
            <label class="form-check-label" for="treatment_result_full_absorption">լրիվ ներծծում</label>
        </div>
        <div class="form-group form-check-inline">
            <input name="radio_reaction_small_50_procent" {{ isset($treatment_final_data->radio_reaction_small_50_procent)  ? 'checked' : '' }} type="checkbox" class="form-check-input" id="treatment_result_high_50_procent">
            <label class="form-check-label" for="treatment_result_high_50_procent">>50%</label>
        </div>
        <div class="form-group form-check-inline">
            <input name="radio_reaction_high_50_procent" {{ isset($treatment_final_data->radio_reaction_high_50_procent) ? 'checked' : '' }} type="checkbox" class="form-check-input" id="treatment_result_low_50_procent">
            <label class="form-check-label" for="treatment_result_low_50_procent"><50%</label>
        </div>
        <div class="form-group form-check-inline">
            <input name="treatment_result_no_result" {{ isset($treatment_final_data->treatment_result_no_result)  ? 'checked' : '' }} type="checkbox" class="form-check-input" id="treatment_result_no_result">
            <label class="form-check-label" for="treatment_result_no_result">առանց արդյունքի</label>
        </div>
        <div class="form-group form-check-inline">
            <input name="radio_reaction_deepening" {{ isset($treatment_final_data->radio_reaction_deepening)  ?'checked' : '' }} type="checkbox" class="form-check-input" id="treatment_result_deepening">
            <label class="form-check-label" for="treatment_result_deepening">խորացում</label>
        </div>

    </li>

    <li class="list-group-item">
        <strong>
            <span class="badge badge-light mr-1">18.</span>
            Եզրափակիչ տվյալներ
        </strong>

        <div class="mt-2">
            <strong>
                ԿԹԾ1
            </strong>

            <x-forms.text-field type="textarea" name="ktc_1" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                value="{{ $treatment_final_data->ktc_1 }}" label="" />
        </div>

        <div class="mt-2">
            <strong>
                ԿԹԾ2
            </strong>

            <x-forms.text-field type="textarea" name="ktc_2" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                value="{{ $treatment_final_data->ktc_2 }}" label="" />
        </div>

        <div class="mt-2">
            <strong>
                ԿԹԾ3
            </strong>

            <x-forms.text-field type="textarea" name="ktc_3" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                value="{{ $treatment_final_data->ktc_3 }}" label="" />
        </div>

        <div class="mt-2">
            <strong>
                ՄՕԴ1
            </strong>

            <x-forms.text-field type="textarea" name="mod_1" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                value="{{ $treatment_final_data->mod_1 }}" label="" />
        </div>

        <div class="mt-2">
            <strong>
                ՄՕԴ2
            </strong>

            <x-forms.text-field type="textarea" name="mod_2" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                value="{{ $treatment_final_data->mod_2 }}" label="" />
        </div>

        <div class="mt-2">
            <strong>
                ՄՕԴ3
            </strong>

            <x-forms.text-field type="textarea" name="mod_3" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                value="{{ $treatment_final_data->mod_3 }}" label="" />
        </div>

        <div class="mt-2">
            <strong>
                ԳՕԴ1
            </strong>

            <x-forms.text-field type="textarea" name="god_1" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                value="{{ $treatment_final_data->god_1 }}" label="" />
        </div>

        <div class="mt-2">
            <strong>
                ԳՕԴ2
            </strong>

            <x-forms.text-field type="textarea" name="god_2" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                value="{{ $treatment_final_data->god_2 }}" label="" />
        </div>

        <div class="mt-2">
            <strong>
                ԳՕԴ3
            </strong>

            <x-forms.text-field type="textarea" name="god_3" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                value="{{ $treatment_final_data->god_3 }}" label="" />
        </div>

        <div class="mt-2">
            <strong>
                ԺԴԲ1
            </strong>

            <x-forms.text-field type="textarea" name="jdb_1" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                value="{{ $treatment_final_data->jdb_1 }}" label="" />
        </div>

        <div class="mt-2">
            <strong>
                ԺԴԲ2
            </strong>

            <x-forms.text-field type="textarea" name="jdb_2" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                value="{{ $treatment_final_data->jdb_2 }}" label="" />
        </div>

        <div class="mt-2">
            <strong>
                ԺԴԲ3
            </strong>

            <x-forms.text-field type="textarea" name="jdb_3" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                value="{{ $treatment_final_data->jdb_3 }}" label="" />
        </div>

    </li>

    <li class="list-group-item">
        <strong>
            <span class="badge badge-light mr-1">19․</span>
            Հատուկ նշումներ՝
        </strong>
        <x-forms.text-field type="textarea" name="special_notes" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                            value="{{ $treatment_final_data->special_notes }}" label="" />
    </li>

    <li class="list-group-item">
        <div class="form-row align-items-center my-2 mx-2">
            <div class="col-sm-12 col-md-6">

                <strong>Բուժ․ Բժիշկ</strong>
                <x-forms.magic-search hidden-id="attending_doctor_id" hidden-name="attending_doctor_id" value="{{ $treatment_final_data->attending_doctor_id }}"
                                      placeholder="Ընտրել անեսթեզիստին․․․" class="magic-search ajax" data-list-name="users" />
            </div>
            <div class="col-sm-12 col-md-6">

                <strong>Բաժնի վարիչ</strong>
                <x-forms.magic-search hidden-id="department_head_doctor_id" hidden-name="department_head_doctor_id"  value="{{ $treatment_final_data->department_head_doctor_id }}"
                                      placeholder="Ընտրել անզգայացման բժիշկին․․․" class="magic-search ajax"
                                      data-list-name="users" />
            </div>
        </div>
    </li>
