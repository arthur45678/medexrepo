@php
// stationary_pathological_anatomical.blade.php
use App\Models\StationaryPathologicalAnatomical;
$route = route("patients.stationary.show", ["patient" => $patient, "stationary" => $stationary]);
$spa_action = route("patients.stationary.pathological_anatomical", ["patient" => $patient, "stationary" =>
$stationary]);

$spa = $stationary->stationary_pathological_anatomical ?? new StationaryPathologicalAnatomical;
@endphp



<section id="stationary-pathological-anatomical">
    <!-- class="ajax-submitable has-files" // enctype="multipart/form-data" -->
    <form method="POST" class="ajax-submitable has-files dont-reset" action="{{ $spa_action }}">
        @csrf
        @method("PATCH")
        <ul class="list-group">
            <li class="list-group-item list-group-item-info">
                <h4 class="text-center my-2">Ախտաբանա-անատոմիական ախտորոշում
                    <x-forms.prev-posts-link href='{{$route."#spa_diagnosis"}}' />
                </h4>
            </li>

            @if($spa->user_id === $user->id || empty($spa->user_id))
            <li class="list-group-item">
                <strong>
                    ա) հիմական հիվանդություն՝
                    <x-forms.prev-posts-link href='{{$route."#spa_primary_disease"}}' />
                </strong>
                <hr class="hr-dashed">
                <strong>
                    բ) հիմական հիվանդության բարդություն՝
                    <x-forms.prev-posts-link href='{{$route."#spa_primary_disease_complication"}}' />
                </strong>
                <hr class="hr-dashed">
                <strong>
                    գ) ուղեկցող հիվանդություններ՝
                    <x-forms.prev-posts-link href='{{$route."#spa_concomitant_diseases"}}' />
                </strong>
                <hr class="hr-dashed">
            </li>

            <li class="list-group-item">
                <div class="form-row align-items-center my-2">
                    <div class="col-md-6">
                        <!-- validationType="ajax" -->
                        <strong>Դիահերձման ամսաթիվ</strong>
                        <x-forms.text-field type="date" name='autopsy_date' label="" validationType="ajax"
                            value='{{old("autopsy_date", $spa->autopsy_date ?? null)}}' />
                    </div>
                    <div class="col-md-6">
                        <strong>Դիահերձման արձանագրություն №</strong>
                        <x-forms.text-field name='autopsy_protocol' label="" validationType="ajax"
                            value='{{old("autopsy_protocol", $spa->autopsy_protocol ?? null)}}' />
                    </div>
                </div>
            </li>

            <li class="list-group-item">
                <strong>Մահվան պատճառը</strong>
                <x-forms.text-field type='textarea' name='cause_of_death' placeholder="ազատ լրացման դաշտ․․․"
                    value='{{old("cause_of_death", $spa->cause_of_death ?? null)}}' validationType="ajax" label="" />
            </li>

            <li class="list-group-item">
                <strong>Ախտաբանա-անատոմիական էպիկրիզ</strong>
                <x-forms.text-field type='textarea' name='pathological_anatomical_epicrisis'
                    placeholder="ազատ լրացման դաշտ․․․" validationType="ajax"
                    value='{{old("pathological_anatomical_epicrisis", $spa->pathological_anatomical_epicrisis ?? null)}}'
                    label="" />
            </li>

            <li class="list-group-item">
                <x-forms.text-field type="file" label="Կցել փաստաթղթեր" name="attachments[]" multiple="multiple" />
            </li>

            @include('shared.forms.list_group_item_submit', ["has_files" => true, 'btn_text' => 'Պահպանել'])
            @endif
        </ul>
    </form>
</section>
