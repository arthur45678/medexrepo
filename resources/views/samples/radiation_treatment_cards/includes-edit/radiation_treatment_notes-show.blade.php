@php
    $treatment_notes = $card->treatment_notes;
@endphp

    <ul class="list-group">
        <li class="list-group-item list-group-item-info">

            <div class="text-center my-2">

                <h4>15․Ճառագայթահարման օրագիր</h4>
            </div>
        </li>

        <li class="list-group-item">
            <div class="form-row align-items-center">
                <div class="col-md-4">
                    <strong>Ճառագայթահարման Ամսաթիվը և ժամը՝</strong>
                </div>
                <div class="col-md-8">
                    <x-forms.text-field name="radiation_date" type="date"
                                        value="{{ $treatment_notes->radiation_date }}" label="" />
                </div>
            </div>
        </li>

        <li class="list-group-item">
            <strong>
                Ճառագայթահարվող հատվածը
            </strong>

            <x-forms.text-field type="textarea" name="irradiated_area" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                value="{{ $treatment_notes->irradiated_area }}" label="" />

        </li>

        <li class="list-group-item">
            <strong>
                Դաշտի չափերը
            </strong>

            <x-forms.text-field type="textarea" name="field_dimensions" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                value="{{ $treatment_notes->field_dimensions }}" label="" />

        </li>

        <li class="list-group-item">
            <strong>
                Ճառագայթահարման տևողությունը
            </strong>

            <x-forms.text-field type="textarea" name="radiation_intensity" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                value="{{ $treatment_notes->radiation_intensity }}" label="" />

        </li>

        <li class="list-group-item">
            <strong>
                ՄՕԴ
            </strong>

            <x-forms.text-field type="textarea" name="mod" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                value="{{ $treatment_notes->mod }}" label="" />

        </li>

        <li class="list-group-item">
            <strong>
                ԳՕԴ
            </strong>

            <x-forms.text-field type="textarea" name="god" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                value="{{ $treatment_notes->god }}" label="" />

        </li>

        <li class="list-group-item">
            <strong>
                N_ԴԴ
            </strong>

            <x-forms.text-field type="textarea" name="N_dd" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                value="{{ $treatment_notes->N_dd }}" label="" />

        </li>

        <li class="list-group-item list-group-item-info">
            <input type="hidden" name="supplement_doctor_id" value="{{ Auth::user()->id }}">
        </li>


    </ul>



