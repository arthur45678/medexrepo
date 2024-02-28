<form {{--class="ajax-submitable"--}} action="{{ route('samples.patients.radiation-treatment-card.storeRadiationTreatmentNotes', [$card->id]) }}" method="POST">
    @csrf
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
                                        value="" label="" />
                </div>
            </div>
        </li>

        <li class="list-group-item">
            <strong>
                Ճառագայթահարվող հատվածը
            </strong>

            <x-forms.text-field type="textarea" name="irradiated_area" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                value="" label="" />

        </li>

        <li class="list-group-item">
            <strong>
                Դաշտի չափերը
            </strong>

            <x-forms.text-field type="textarea" name="field_dimensions" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                value="" label="" />

        </li>

        <li class="list-group-item">
            <strong>
                Ճառագայթահարման տևողությունը
            </strong>

            <x-forms.text-field type="textarea" name="radiation_intensity" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                value="" label="" />

        </li>

        <li class="list-group-item">
            <strong>
                ՄՕԴ
            </strong>

            <x-forms.text-field type="textarea" name="mod" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                value="" label="" />

        </li>

        <li class="list-group-item">
            <strong>
                ԳՕԴ
            </strong>

            <x-forms.text-field type="textarea" name="god" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                value="" label="" />

        </li>

        <li class="list-group-item">
            <strong>
                N_ԴԴ
            </strong>

            <x-forms.text-field type="textarea" name="N_dd" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                value="" label="" />

        </li>

        <li class="list-group-item list-group-item-info">
            <input type="hidden" name="supplement_doctor_id" value="{{ Auth::user()->id }}">
        </li>

        @include('shared.forms.list_group_item_submit', ['btn_text'=>'Պահպանել 15րդ կետի փոփոխությունները'])

    </ul>
</form>


