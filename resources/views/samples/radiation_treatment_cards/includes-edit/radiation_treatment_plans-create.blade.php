
<form {{--class="ajax-submitable"--}} method="post" action="{{ route('samples.patients.radiation-treatment-card.storeRadiationTreatmentPlan',[$card->id]) }}">
    @csrf
    <ul class="list-group">
        <li class="list-group-item list-group-item-info">

            <div class="text-center my-2">
                <h4>Ճառագայթային բուժման պլանը և ֆիզիկոսի տվյալները</h4>
            </div>
        </li>

        <li class="list-group-item">
            <strong>
                <span class="badge badge-light mr-1">8․</span>
                Կուրսը՝
            </strong>

            <div class="form-group form-check">
                <input name="course_radical_program" type="checkbox" class="form-check-input" id="course_root">
                <label class="form-check-label" for="course_root">Արմատական ծրագիր</label>
            </div>
            <div class="form-group form-check">
                <input name="course_amoqich" type="checkbox" class="form-check-input" id="course_amoqich">
                <label class="form-check-label" for="course_amoqich">Ամոքիչ</label>
            </div>
            <div class="form-group form-check">
                <input name="course_auxiliary" type="checkbox" class="form-check-input" id="course_ojandak">
                <label class="form-check-label" for="course_ojandak">Օժանդակ</label>
            </div>
            <div class="form-group form-check">
                <input name="course_effective" type="checkbox" class="form-check-input" id="course_nerardyunavet">
                <label class="form-check-label" for="course_effective">Ներարդյունավետ</label>
            </div>
        </li>

        <li class="list-group-item">
            <strong>
                <span class="badge badge-light mr-1">9․</span>
                Դոզավորումը՝
            </strong>
            <div class="form-group form-check">
                <input name="dosage_standart" type="checkbox" class="form-check-input" id="dosage_standart">
                <label class="form-check-label" for="dosage_standart">Ստանդարտ</label>
            </div>
            <div class="form-group form-check">
                <input name="dosage_mult" type="checkbox" class="form-check-input" id="dosage_mult">
                <label class="form-check-label" for="dosage_mult">Մուլտ․</label>
            </div>
            <div class="form-group form-check">
                <input name="dosage_escal" type="checkbox" class="form-check-input" id="dosage_escal">
                <label class="form-check-label" for="dosage_escal">Էսկալ</label>
            </div>
            <div class="form-group form-check">
                <input name="dosage_large" type="checkbox" class="form-check-input" id="dosage_big">
                <label class="form-check-label" for="dosage_big">խոշոր</label>
            </div>

            <label class="form-check-label" for="dosage_description">Այլ</label>
            <x-forms.text-field type="textarea" name="dosage_comment" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                value="" label="" />
        </li>

        <li class="list-group-item">
            <strong>
                <span class="badge badge-light mr-1">10․</span>
                Հիվանդի դիրքը՝
            </strong>

            <div class="form-group form-check-inline">
                <input name="patient_position_on_the_back" type="checkbox" class="form-check-input" id="pationt_position_on_the_back">
                <label class="form-check-label" for="patient_position_on_the_back">մեջքի վրա</label>
            </div>
            <div class="form-group form-check-inline">
                <input name="patient_position_on_the_abdomen" type="checkbox" class="form-check-input" id="pationt_position_on_the_abdomen">
                <label class="form-check-label" for="pationt_position_on_the_abdomen">Փորի վրա</label>
            </div>

            <label for="" class="form-check-label">Այլ</label>
            <x-forms.text-field type="textarea" name="patient_position_comment" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                value="" label="" />
        </li>

        <li class="list-group-item">
            <strong>
                <span class="badge badge-light mr-1">11․</span>
                ՄՕԴ, ԳՕԴ, Ճառագայթային դաշտերը, անկյունները, ԱՈՒՀ/ԱՄՀ, բլոկներ, սեպեր, ճոճումների արագությունը և քանակը, ժամանակը (յուր․ դաշտի համար), ԺԴԲ, ԿԱԴ, փնջի ելքը սանտիգրեյ/ր
            </strong>
        </li>

        <li class="list-group-item">
            <strong>
                <span class="badge badge-light mr-1">ա)</span>
                ԿԹԾ1
            </strong>

            <x-forms.text-field type="textarea" name="ktc1" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                value="" label="" />

        </li>

        <li class="list-group-item">
            <strong>
                <span class="badge badge-light mr-1">բ)</span>
                ԿԹԾ2
            </strong>

            <x-forms.text-field type="textarea" name="ktc2" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                value="" label="" />

        </li>

        <li class="list-group-item">
            <strong>
                <span class="badge badge-light mr-1">գ)</span>
                ԿԹԾ3
            </strong>

            <x-forms.text-field type="textarea" name="ktc3" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                value="" label="" />
        </li>

        <li class="list-group-item">
            <div class="form-row align-items-center my-2 mx-2">
                <div class="col-sm-12 col-md-6">
                    <span class="badge badge-light mr-1">12․</span>
                    <strong>Բժիշկ ֆիզիկոս</strong>
                    <x-forms.magic-search hidden-id="physic_doctor_id" hidden-name="physic_doctor_id"
                                          placeholder="Ընտրել անեսթեզիստին․․․" class="magic-search ajax" data-list-name="users" />
                </div>
                <div class="col-sm-12 col-md-6">
                    <span class="badge badge-light mr-1">13․</span>
                    <strong>Ճառ․ թերապևտ</strong>
                    <x-forms.magic-search hidden-id="radiation_therapevt_doctor_id" hidden-name="radiation_therapevt_doctor_id"
                                          placeholder="Ընտրել անզգայացման բժիշկին․․․" class="magic-search ajax"
                                          data-list-name="users" />
                </div>
            </div>
        </li>

        @include('shared.forms.list_group_item_submit', ['btn_text'=>'Պահպանել 8-ից 13-րդ կետերի փոփոխությունները'])

        </li>
    </ul>
</form>
