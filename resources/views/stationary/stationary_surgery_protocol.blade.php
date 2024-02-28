@php
$surgery_protocols = $user->stationary_surgery_protocols;
$route = route("patients.stationary.show", ["patient" => $patient, "stationary" => $stationary]);
@endphp

<section id="surgery-protocol">

    <ul class="list-group mt-2">
        <li class="list-group-item list-group-item-info text-center">
            <h4>
                Վիրահատության արձանագրություն
                <x-forms.prev-posts-link href='{{$route."#surgery-protocol"}}' />

                @if (count($surgery_protocols))
                <button class="btn btn-primary btn-sm" type="button" data-toggle="collapse"
                    data-target=".surgery-protocols-collapse">
                    <x-svg icon="cui-pencil" />
                </button>
                @endif
            </h4>
        </li>
    </ul>
    @if (count($surgery_protocols))
    <div class="collapse surgery-protocols-collapse">
        @forelse ($surgery_protocols as $i => $item)
        <form method="POST" class="ajax-submitable has-files dont-reset"
            action="{{ route("patients.stationary.surgery_protocol", ["patient" => $patient, "stationary" => $stationary]) }}">
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
                                value="{{ $item->getFormattedDate('date') }}" />
                        </div>
                    </div>
                </li>

                <li class="list-group-item">
                    <div class="form-group">
                        <strong>Վիրահատության անվանում</strong>
                        <x-forms.magic-search hidden-id="sp_surgery_id_{{ $i }}" hidden-name="surgery_id"
                            placeholder="Ընտրել վիրահատություն․․․" class="magic-search ajax"
                            data-catalog-name="surgeries" data-id="{{ $item->surgery_id }}" />
                    </div>
                    <div class="form-group">
                        <x-forms.text-field type="textarea" label="Վիրահատության անվանում" name="surgery_name"
                            validationType="ajax" value="{{ $item->surgery_name }}" />
                    </div>
                </li>

                <li class="list-group-item">
                    <div class="form-row align-items-center">
                        <div class="col-sm-12 col-md-4">
                            <strong>Վիրահատության սկիզբ</strong>
                        </div>
                        <div class="col-sm-12 col-md-8">
                            <x-forms.text-field type="datetime-local" name="surgery_start" validationType="ajax"
                                value="{{ $item->getFormattedDate('surgery_start', true) }}" />
                        </div>
                    </div>
                </li>

                <li class="list-group-item">
                    <div class="form-row align-items-center">
                        <div class="col-sm-12 col-md-4">
                            <strong>Վիրահատության վերջ</strong>
                        </div>
                        <div class="col-sm-12 col-md-8">
                            <x-forms.text-field type="datetime-local" name="surgery_end" validationType="ajax"
                                value="{{ $item->getFormattedDate('surgery_end', true) }}" />
                        </div>
                    </div>
                </li>

                <li class="list-group-item">
                    <div class="form-group">
                        <strong>Անզգայացումը</strong>
                        <x-forms.magic-search hidden-id="sp_anesthesia_id_{{ $i }}" hidden-name="anesthesia_id"
                            placeholder="Ընտրել Անզգայացման տեսակ․․․" class="magic-search ajax"
                            data-catalog-name="anesthesias" data-id="{{ $item->anesthesia_id }}" />
                    </div>
                </li>

                <li class="list-group-item">
                    <div class="form-group">
                        <strong>Անզգայացման ընթացքը</strong>
                        <x-forms.magic-search hidden-id="sp_medicine_id_{{ $i }}" hidden-name="medicine_id"
                            placeholder="Ընտրել դեղամիջոց․․․" class="magic-search ajax" data-catalog-name="medicines"
                            data-id="{{ $item->medicine_id }}" />
                    </div>
                    <div class="form-group">
                        <x-forms.text-field type="textarea" label="Անզգայացման ընթացքը" name="anesthesia_process"
                            validationType="ajax" value="{{ $item->anesthesia_process }}" />
                    </div>
                </li>

                <li class="list-group-item">
                    <div class="form-row align-items-center my-2 mx-2">
                        <div class="col-sm-12 col-md-6">
                            <strong>Անեսթեզիստ</strong>
                            <x-forms.magic-search hidden-id="old_anesthesiologist_id_{{ $i }}"
                                hidden-name="anesthesiologist_id" placeholder="Ընտրել անեսթեզիստին․․․"
                                class="magic-search ajax" data-list-name="users"
                                data-id="{{ $item->anesthesiologist_id }}" />
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <strong>Անզգայացման բժիշկ</strong>
                            <x-forms.magic-search hidden-id="old_anesthesiology_doctor_id{{ $i }}"
                                hidden-name="anesthesiology_doctor_id" placeholder="Ընտրել անզգայացման բժիշկին․․․"
                                class="magic-search ajax" data-list-name="users"
                                data-id="{{ $item->department_head_id }}" />
                        </div>
                    </div>
                </li>

                @include('shared.forms.list_group_item_submit', ['btn_text' => 'Պահպանել'])
            </ul>

        </form>
        @empty

        <h4>Գրառումներ չեն գտնվել</h4>

        @endforelse
    </div>
    @endif

    <div class="collapse show surgery-protocols-collapse">
        <form method="POST" class="ajax-submitable"
            action="{{ route("patients.stationary.surgery_protocol", ["patient" => $patient, "stationary" => $stationary]) }}">
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
                        <strong>Վիրահատության անվանում</strong>
                        <x-forms.magic-search hidden-id="sp_surgery_id" hidden-name="surgery_id"
                            placeholder="Ընտրել վիրահատություն․․․" class="magic-search ajax"
                            data-catalog-name="surgeries" />
                    </div>
                    <div class="form-group">
                        <x-forms.text-field type="textarea" label="Վիրահատության անվանում" name="surgery_name"
                            validationType="ajax" />
                    </div>
                </li>

                <li class="list-group-item">
                    <div class="form-row align-items-center">
                        <div class="col-sm-12 col-md-4">
                            <strong>Վիրահատության սկիզբ</strong>
                        </div>
                        <div class="col-sm-12 col-md-8">
                            <x-forms.text-field type="datetime-local" name="surgery_start" validationType="ajax" />
                        </div>
                    </div>
                </li>

                <li class="list-group-item">
                    <div class="form-row align-items-center">
                        <div class="col-sm-12 col-md-4">
                            <strong>Վիրահատության վերջ</strong>
                        </div>
                        <div class="col-sm-12 col-md-8">
                            <x-forms.text-field type="datetime-local" name="surgery_end" validationType="ajax" />
                        </div>
                    </div>
                </li>

                <li class="list-group-item">
                    <div class="form-group">
                        <strong>Անզգայացումը</strong>
                        <x-forms.magic-search hidden-id="sp_anesthesia_id" hidden-name="anesthesia_id"
                            placeholder="Ընտրել Անզգայացման տեսակ․․․" class="magic-search ajax"
                            data-catalog-name="anesthesias" />
                    </div>
                </li>

                <li class="list-group-item">
                    <div class="form-group">
                        <strong>Անզգայացման ընթացքը</strong>
                        <x-forms.magic-search hidden-id="sp_medicine_id" hidden-name="medicine_id"
                            placeholder="Ընտրել դեղամիջոց․․․" class="magic-search ajax" data-catalog-name="medicines" />
                    </div>
                    <div class="form-group">
                        <x-forms.text-field type="textarea" label="Անզգայացման ընթացքը" name="anesthesia_process"
                            validationType="ajax" />
                    </div>
                </li>

                <li class="list-group-item">
                    <div class="form-row align-items-center my-2 mx-2">
                        <div class="col-sm-12 col-md-6">
                            <strong>Անեսթեզիստ</strong>
                            <x-forms.magic-search hidden-id="anesthesiologist_id" hidden-name="anesthesiologist_id"
                                placeholder="Ընտրել անեսթեզիստին․․․" class="magic-search ajax" data-list-name="users" />
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <strong>Անզգայացման բժիշկ</strong>
                            <x-forms.magic-search hidden-id="anesthesiology_doctor_id" hidden-name="anesthesiology_doctor_id"
                                placeholder="Ընտրել անզգայացման բժիշկին․․․" class="magic-search ajax"
                                data-list-name="users" />
                        </div>
                    </div>
                </li>

                @include('shared.forms.list_group_item_submit', ['btn_text' => 'Ավելացնել'])
            </ul>
        </form>
    </div>
</section>
