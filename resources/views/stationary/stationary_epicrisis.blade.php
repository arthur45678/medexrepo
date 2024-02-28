@inject('stationaryEpicrisis', 'App\Models\StationaryEpicrisis')

@php
$stationary_epicrisis = $stationary->stationary_epicrisis ?? new $stationaryEpicrisis;
$route = route("patients.stationary.show", ["patient" => $patient, "stationary" => $stationary]);
@endphp

<section id="epicrisis">
    <form method="POST" class="ajax-submitable has-files dont-reset"
        action="{{ route("patients.stationary.epicrisis", ["patient" => $patient, "stationary" => $stationary]) }}">
        @csrf
        @method("PATCH")

        <ul class="list-group mt-2">
            <li class="list-group-item list-group-item-info">
                <h4 class="text-center">Էպիկրիզ
                    <x-forms.prev-posts-link href='{{$route."#epicrisis"}}' />
                </h4>
            </li>

            @if ($stationary_epicrisis->user_id === $user->id || empty($stationary_epicrisis->user_id))

            <li class="list-group-item">
                <div class="form-row align-items-center">
                    <div class="col-sm-12 col-md-4">
                        <strong>Ամսաթիվ</strong>
                    </div>
                    <div class="col-sm-12 col-md-8">
                        <x-forms.text-field type="date" name="date" validationType="ajax"
                            :value="$stationary_epicrisis->epicrisis_date ? $stationary_epicrisis->getFormattedDate('epicrisis_date') : ''" />
                    </div>
                </div>
            </li>

            <li class="list-group-item">
                <div class="form-group">
                    <x-forms.text-field type="textarea" label="Էպիկրիզ" name="epicrisis" validationType="ajax"
                        :value="$stationary_epicrisis->epicrisis" />
                </div>
            </li>

            <li class="list-group-item">
                @include('shared.forms.attachments_container', ["attachments" => $stationary_epicrisis->attachments])
                <div class="form-group">
                    <x-forms.text-field type="file" label="Կից փաստաթղթեր" name="attachments[]" validationType="ajax"
                        multiple="multiple" />
                </div>
            </li>

            <li class="list-group-item">
                <hr class="hr-dashed">
                <div class="form-row align-items-center my-2 mx-2">
                    <div class="col-sm-12 col-md-4">
                        <strong>Բուժող բժիշկ</strong>
                        <x-forms.magic-search hidden-id="se_attending_doctor_id" hidden-name="attending_doctor_id"
                            placeholder="Ընտրել բուժող բժիշկին․․․" class="magic-search ajax" data-list-name="users"
                            :value="$stationary_epicrisis->attending_doctor_id" />
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <strong>Բաժանմունքի վարիչ</strong>
                        <x-forms.magic-search hidden-id="se_department_head_id" hidden-name="department_head_id"
                            placeholder="Ընտրել բաժանմունքի վարիչին․․․" class="magic-search ajax" data-list-name="users"
                            :value="$stationary_epicrisis->department_head_id" />
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <strong>Գլխավոր բժիշկ</strong>
                        <x-forms.magic-search hidden-id="se_chief_doctor_id" hidden-name="chief_doctor_id"
                            placeholder="Ընտրել գլխավոր բժիշկին․․․" class="magic-search ajax" data-list-name="users"
                            :value="$stationary_epicrisis->chief_doctor_id" />
                    </div>
                </div>
            </li>
            @include('shared.forms.list_group_item_submit', ["has_files" => true, 'btn_text' => 'Պահպանել'])
            @endif
        </ul>
    </form>
</section>
