@php
$resuscitation_departments = $user->stationary_resuscitation_departments;
$route = route("patients.stationary.show", ["patient" => $patient, "stationary" => $stationary]);
@endphp

<section id="resuscitation-department">
    <ul class="list-group mt-2">
        <li class="list-group-item list-group-item-info">
            <h4 class="text-center">Վերակենդանացման բաժանմունք
                <x-forms.prev-posts-link href='{{$route."#resuscitation-department"}}' />

                @if (count($resuscitation_departments))
                <button class="btn btn-primary btn-sm" type="button" data-toggle="collapse"
                    data-target=".resuscitation-department-collapse">
                    <x-svg icon="cui-pencil" />
                </button>
                @endif
            </h4>
        </li>
    </ul>

    @if (count($resuscitation_departments))
    <div class="collapse resuscitation-department-collapse">
        @forelse ($resuscitation_departments as $item)
        <form method="POST" class="ajax-submitable dont-reset"
            action="{{ route("patients.stationary.resuscitation_department", ["patient" => $patient, "stationary" => $stationary]) }}">
            @csrf
            @method("PATCH")

            <input type="hidden" name="id" value="{{ $item->id }}" />

            <ul class="list-group mt-2">
                <li class="list-group-item">
                    <div class="form-row align-items-center">
                        <div class="col-sm-12 col-md-4">
                            <strong>Ամսաթիվ</strong>
                        </div>
                        <div class="col-sm-12 col-md-8">
                            <x-forms.text-field type="date" name="date" validationType="ajax"
                                :value="$item->getFormattedDate('date')" />
                        </div>
                    </div>
                </li>

                <li class="list-group-item">
                    <div class="form-group">
                        <x-forms.text-field type="textarea" label="Ազատ գրառման դաշտ" name="comment"
                            validationType="ajax" :value="$item->comment" />
                    </div>
                </li>

                @include('shared.forms.list_group_item_submit', ["has_files" => true, 'btn_text' => 'Պահպանել'])
            </ul>
        </form>
        @empty

        @endforelse
    </div>
    @endif

    <div class="collapse show resuscitation-department-collapse">
        <form method="POST" class="ajax-submitable"
            action="{{ route("patients.stationary.resuscitation_department", ["patient" => $patient, "stationary" => $stationary]) }}">
            @csrf
            @method("PATCH")
            <ul class="list-group mt-2">
                <li class="list-group-item">
                    <div class="form-row align-items-center">
                        <div class="col-sm-12 col-md-4">
                            <strong>Ամսաթիվ</strong>
                        </div>
                        <div class="col-sm-12 col-md-8">
                            <x-forms.text-field type="date" name="date" validationType="ajax" />
                        </div>
                    </div>
                </li>

                <li class="list-group-item">
                    <div class="form-group">
                        <x-forms.text-field type="textarea" label="Ազատ գրառման դաշտ" name="comment"
                            validationType="ajax" />
                    </div>
                </li>

                @include('shared.forms.list_group_item_submit', ["has_files" => true, 'btn_text' => 'Ավելացնել'])
            </ul>

        </form>
    </div>

</section>
