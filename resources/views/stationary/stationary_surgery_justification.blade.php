@php
$surgery_justifications = $user->stationary_surgery_justifications;
$route = route("patients.stationary.show", ["patient" => $patient, "stationary" => $stationary]);
@endphp

<section id="surgery-justification">

    <ul class="list-group mt-2">
        <li class="list-group-item list-group-item-info text-center">
            <h4>Վիրահատության հիմնավորում
                <x-forms.prev-posts-link href="{{ $route . '#surgery-justification' }}" />
                @if(count($surgery_justifications))
                <button class="btn btn-primary btn-sm" type="button" data-toggle="collapse"
                    data-target=".surgery-justification-collapse">
                    <x-svg icon="cui-pencil" />
                </button>
                @endif
            </h4>
            <h5>Հիվանդության պատմագիր N {{ $stationary->number }}</h5>
        </li>
    </ul>

    <div class="collapse surgery-justification-collapse">
        @forelse ($surgery_justifications as $item)
        <form method="POST" class="ajax-submitable dont-reset"
            action="{{ route("patients.stationary.surgery_justification", ["patient" => $patient, "stationary" => $stationary]) }}">
            @csrf
            @method("PATCH")

            <input type="hidden" name="id" value="{{ $item->id }}">

            <ul class="list-group mt-2">
                <li class="list-group-item">
                    <div class="form-row align-items-center">
                        <div class="col-sm-12 col-md-4">
                            <strong>Ամսաթիվ</strong>
                        </div>
                        <div class="col-sm-12 col-md-8">
                            <x-forms.text-field type="date" name="date" validationType="ajax"
                                value="{{ $item->date }}" />
                        </div>
                    </div>
                </li>

                <li class="list-group-item">
                    <div class="form-group">
                        <x-forms.text-field type="textarea" label="Վիրահատության հիմնավորում" name="justification"
                            validationType="ajax" value="{{ $item->justification }}" />
                    </div>
                </li>

                <li class="list-group-item">
                    <hr class="hr-dashed">
                    <div class="form-row align-items-center my-2 mx-2">
                        <div class="col-sm-12 col-md-4">
                            <strong>Բուժող բժիշկ</strong>
                            <x-forms.magic-search hidden-id="old_sj_attending_doctor_id_{{ $item->id }}" hidden-name="attending_doctor_id"
                                placeholder="Ընտրել բուժող բժիշկին․․․" class="magic-search ajax" data-list-name="users"
                                data-id="{{ $item->attending_doctor_id }}" />
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <strong>Բաժանմունքի վարիչ</strong>
                            <x-forms.magic-search hidden-id="old_sj_department_head_id_{{ $item->id }}" hidden-name="department_head_id"
                                placeholder="Ընտրել բաժանմունքի վարիչին․․․" class="magic-search ajax"
                                data-list-name="users" data-id="{{ $item->department_head_id }}" />
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <strong>Բուժական գծով փոխտնօրեն</strong>
                            <x-forms.magic-search hidden-id="old_medical_affairs_deputy_director_id_{{ $item->id }}"
                                hidden-name="medical_affairs_deputy_director_id"
                                placeholder="Ընտրել բուժական գծով փոխտնօրենին․․․" class="magic-search ajax"
                                data-list-name="users" data-id="{{ $item->medical_affairs_deputy_director_id }}" />
                        </div>
                    </div>
                </li>

                @include('shared.forms.list_group_item_submit', ['btn_text' => 'Պահպանել'])
            </ul>
        </form>
        @empty
        @endforelse
    </div>


    <div class="collapse show surgery-justification-collapse">
        <form method="POST" class="ajax-submitable"
            action="{{ route("patients.stationary.surgery_justification", ["patient" => $patient, "stationary" => $stationary]) }}">
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
                        <x-forms.text-field type="textarea" label="Վիրահատության հիմնավորում" name="justification"
                            validationType="ajax" />
                    </div>
                </li>

                <li class="list-group-item">
                    <hr class="hr-dashed">
                    <div class="form-row align-items-center my-2 mx-2">
                        <div class="col-sm-12 col-md-4">
                            <strong>Բուժող բժիշկ</strong>
                            <x-forms.magic-search hidden-id="sj_attending_doctor_id" hidden-name="attending_doctor_id"
                                placeholder="Ընտրել բուժող բժիշկին․․․" class="magic-search ajax"
                                data-list-name="users" />
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <strong>Բաժանմունքի վարիչ</strong>
                            <x-forms.magic-search hidden-id="sj_department_head_id" hidden-name="department_head_id"
                                placeholder="Ընտրել բաժանմունքի վարիչին․․․" class="magic-search ajax"
                                data-list-name="users" />
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <strong>Բուժական գծով փոխտնօրեն</strong>
                            <x-forms.magic-search hidden-id="medical_affairs_deputy_director_id"
                                hidden-name="medical_affairs_deputy_director_id"
                                placeholder="Ընտրել բուժական գծով փոխտնօրենին․․․" class="magic-search ajax"
                                data-list-name="users" />
                        </div>
                    </div>
                </li>

                @include('shared.forms.list_group_item_submit', ['btn_text' => 'Ավելացնել'])
            </ul>
        </form>
    </div>
</section>
