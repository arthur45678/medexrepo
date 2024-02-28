<form{{-- class="ajax-submitable"--}} action="{{ route('samples.patients.radiation-treatment-card.storeRadiationFinalData', [$card->id]) }}" method="POST">
    @csrf

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
            <input name="radio_reaction_no" type="checkbox" class="form-check-input" id="radiation_reaction_no">
            <label class="form-check-label" for="radiation_reaction_no">չկա</label>
        </div>
        <div class="form-group form-check-inline">
            <input name="radio_reaction_location" type="checkbox" class="form-check-input" id="radiation_reaction_local">
            <label class="form-check-label" for="radiation_reaction_local">տեղ</label>
        </div>
        <div class="form-group form-check-inline">
            <input name="radio_reaction_hematologist" type="checkbox" class="form-check-input" id="radiation_reaction_hemolog">
            <label class="form-check-label" for="radiation_reaction_hemolog">արյունաբան</label>
        </div>
        <div class="form-group form-check-inline">
            <input name="radio_reaction_general" type="checkbox" class="form-check-input" id="radiation_reaction_basic">
            <label class="form-check-label" for="radiation_reaction_basic">ընդհանուր</label>
        </div>

        <span class="badge badge-light mr-1">Աստիճանը</span>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="radio_reaction_category" id="radiation_reaction_level" value="1">
            <label class="form-check-label" for="radiation_reaction_level">1-ին</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="radio_reaction_category" id="radiation_reaction_level" value="2">
            <label class="form-check-label" for="radiation_reaction_level">2-րդ</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="radio_reaction_category" id="radiation_reaction_level" value="3">
            <label class="form-check-label" for="radiation_reaction_level">3-րդ</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="radio_reaction_category" id="radiation_reaction_level" value="4">
            <label class="form-check-label" for="radiation_reaction_level">4-րդ</label>
        </div>


        <x-forms.text-field type="textarea" name="radio_reaction_comment" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                            value="" label="" />
        <ins class="ml-4"></ins>

    </li>

    <li class="list-group-item">
        <strong>
            <span class="badge badge-light mr-1">17․</span>
            Բուժման արդյունքը՝
        </strong>

        <div class="form-group form-check-inline">
            <input name="radio_reaction_full_absorption" type="checkbox" class="form-check-input" id="treatment_result_full_absorption">
            <label class="form-check-label" for="treatment_result_full_absorption">լրիվ ներծծում</label>
        </div>
        <div class="form-group form-check-inline">
            <input name="radio_reaction_small_50_procent" type="checkbox" class="form-check-input" id="treatment_result_high_50_procent">
            <label class="form-check-label" for="treatment_result_high_50_procent">>50%</label>
        </div>
        <div class="form-group form-check-inline">
            <input name="radio_reaction_high_50_procent" type="checkbox" class="form-check-input" id="treatment_result_low_50_procent">
            <label class="form-check-label" for="treatment_result_low_50_procent"><50%</label>
        </div>
        <div class="form-group form-check-inline">
            <input name="treatment_result_no_result" type="checkbox" class="form-check-input" id="treatment_result_no_result">
            <label class="form-check-label" for="treatment_result_no_result">առանց արդյունքի</label>
        </div>
        <div class="form-group form-check-inline">
            <input name="radio_reaction_deepening" type="checkbox" class="form-check-input" id="treatment_result_deepening">
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
                                value="" label="" />
        </div>

        <div class="mt-2">
            <strong>
                ԿԹԾ2
            </strong>

            <x-forms.text-field type="textarea" name="ktc_2" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                value="" label="" />
        </div>

        <div class="mt-2">
            <strong>
                ԿԹԾ3
            </strong>

            <x-forms.text-field type="textarea" name="ktc_3" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                value="" label="" />
        </div>

        <div class="mt-2">
            <strong>
                ՄՕԴ1
            </strong>

            <x-forms.text-field type="textarea" name="mod_1" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                value="" label="" />
        </div>

        <div class="mt-2">
            <strong>
                ՄՕԴ2
            </strong>

            <x-forms.text-field type="textarea" name="mod_2" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                value="" label="" />
        </div>

        <div class="mt-2">
            <strong>
                ՄՕԴ3
            </strong>

            <x-forms.text-field type="textarea" name="mod_3" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                value="" label="" />
        </div>

        <div class="mt-2">
            <strong>
                ԳՕԴ1
            </strong>

            <x-forms.text-field type="textarea" name="god_1" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                value="" label="" />
        </div>

        <div class="mt-2">
            <strong>
                ԳՕԴ2
            </strong>

            <x-forms.text-field type="textarea" name="god_2" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                value="" label="" />
        </div>

        <div class="mt-2">
            <strong>
                ԳՕԴ3
            </strong>

            <x-forms.text-field type="textarea" name="god_3" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                value="" label="" />
        </div>

        <div class="mt-2">
            <strong>
                ԺԴԲ1
            </strong>

            <x-forms.text-field type="textarea" name="jdb_1" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                value="" label="" />
        </div>

        <div class="mt-2">
            <strong>
                ԺԴԲ2
            </strong>

            <x-forms.text-field type="textarea" name="jdb_2" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                value="" label="" />
        </div>

        <div class="mt-2">
            <strong>
                ԺԴԲ3
            </strong>

            <x-forms.text-field type="textarea" name="jdb_3" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                value="" label="" />
        </div>

    </li>

    <li class="list-group-item">
        <strong>
            <span class="badge badge-light mr-1">19․</span>
            Հատուկ նշումներ՝
        </strong>
        <x-forms.text-field type="textarea" name="special_notes" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                            value="" label="" />
    </li>

    <li class="list-group-item">
        <div class="form-row align-items-center my-2 mx-2">
            <div class="col-sm-12 col-md-6">

                <strong>Բուժ․ Բժիշկ</strong>
                <x-forms.magic-search hidden-id="attending_doctor_id" hidden-name="attending_doctor_id"
                                      placeholder="Ընտրել անեսթեզիստին․․․" class="magic-search ajax" data-list-name="users" />
            </div>
            <div class="col-sm-12 col-md-6">

                <strong>Բաժնի վարիչ</strong>
                <x-forms.magic-search hidden-id="department_head_doctor_id" hidden-name="department_head_doctor_id"
                                      placeholder="Ընտրել անզգայացման բժիշկին․․․" class="magic-search ajax"
                                      data-list-name="users" />
            </div>
        </div>
    </li>

@include('shared.forms.list_group_item_submit', ['btn_text'=>'Պահպանել 16-ից 19-րդ կետերի փոփոխությունները'])

</form>
