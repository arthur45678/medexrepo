@php
// stationary_treatment_evaluation.blade.php
use App\Models\StationaryTreatmentEvaluation;
$route = route("patients.stationary.show", ["patient" => $patient, "stationary" => $stationary]);
$ste_action = route("patients.stationary.treatment_evaluation", ["patient" => $patient, "stationary" => $stationary]);
$ste = $stationary->stationary_treatment_evaluation ?? new StationaryTreatmentEvaluation;
@endphp

<section id="treatment_evaluation">
    <form method="POST" class="ajax-submitable dont-reset" action="{{ $ste_action }}">
        @csrf
        @method("PATCH")

        <ul class="list-group mt-2">
            <li class="list-group-item list-group-item-info text-center">
                <h4>
                    Հիվանդի վիճակի և բուժման գնահատում
                    <x-forms.prev-posts-link href='{{$route."#stationary_treatment_evaluation"}}' />
                </h4>
            </li>

            @if ($ste->user_id === $user->id || empty($ste->user_id))


            <li class="list-group-item">
                <strong>ֆունկցիոնալ վիճակի գնահատումը ըստ Eastern Cooperative Oncology Group-ի սանդղակի՝</strong>
                <select name="eastern_cooperative_oncology_group" class="custom-select mt-2">
                    <option value="">գնահատել հիվանդի ֆունկցիոնալ վիճակը․․․</option>
                    @foreach ($eastern_cooperative_oncology_group_enum as $item)
                    <option value="{{$item}}" @if (old('eastern_cooperative_oncology_group', $ste->eastern_cooperative_oncology_group ? $ste->eastern_cooperative_oncology_group->getValue() : null) === $item)
                        selected='selected'
                        @endif>
                        {{__("enums.eastern_cooperative_oncology_group_enum.$item")}}
                    </option>
                    @endforeach
                </select>
            </li>

            <li class="list-group-item">
                <strong>Կարնոֆսկու գործունակության սանդղակ (Karnofsky performance scale)՝</strong>
                <select name="karnofsky_performance" class="custom-select mt-2">
                    <option value="">ընտրել գործունակության աստիճանը․․․</option>
                    @foreach ($karnofsky_performance_enum as $item)
                    <option value="{{$item}}" @if (old('karnofsky_performance', $ste->karnofsky_performance ? $ste->karnofsky_performance->getValue() : null) === $item)
                        selected='selected'
                        @endif>
                        {{__("enums.karnofsky_performance_enum.$item")}}
                    </option>
                    @endforeach
                </select>
            </li>

            <li class="list-group-item">
                <strong>Բուժման արդյունավետություն՝</strong>
                <select name="treatment_effectiveness" class="custom-select mt-2">
                    <option value="">գնահատել բուժման արդյունավետությունը․․․</option>
                    @foreach ($treatment_effectiveness_enum as $item)
                    <option value="{{$item}}" @if (old('treatment_effectiveness', $ste->treatment_effectiveness ? $ste->treatment_effectiveness->getValue() : null) === $item)
                        selected='selected'
                        @endif>
                        {{__("enums.treatment_effectiveness_enum.$item")}}
                    </option>
                    @endforeach
                </select>
            </li>

            @include('shared.forms.list_group_item_submit', ['btn_text' => 'Պահպանել'])

            @endif
        </ul>

    </form>
</section>
