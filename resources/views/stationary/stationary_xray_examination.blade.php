@php
$xray_examinations = $user->stationary_xray_examinations;
$route = route("patients.stationary.show", ["patient" => $patient, "stationary" => $stationary]);
@endphp

<section id="xray-examination">

    <ul class="list-group mt-2">
        <li class="list-group-item list-group-item-info">
            <h4 class="text-center">Ռենտգենաբանական հետազոտություններ
                <x-forms.prev-posts-link href="{{ $route . '#xray-examinations' }}" />
                @if(count($xray_examinations))
                <button class="btn btn-primary btn-sm" type="button" data-toggle="collapse"
                    data-target=".xray-examination-collapse">
                    <x-svg icon="cui-pencil" />
                </button>
                @endif
            </h4>
        </li>
    </ul>

    <div class="collapse xray-examination-collapse">
        @forelse ($xray_examinations as $item)
        <form method="POST" class="ajax-submitable has-files dont-reset"
            action="{{ route("patients.stationary.xray_examination", ["patient" => $patient, "stationary" => $stationary]) }}">
            @csrf
            @method("PATCH")

            <input type="hidden" name="id" value="{{ $item->id }}">

            <ul class="list-group mt-2">
                <li class="list-group-item">
                    <div class="form-row align-items-center">
                        <div class="col-sm-12 col-md-4">
                            <strong>Հետազոտության ամսաթիվ</strong>
                        </div>
                        <div class="col-sm-12 col-md-8">
                            <x-forms.text-field type="date" name="examination_date" validationType="ajax"
                                value="{{ $item->examination_date }}" />
                        </div>
                    </div>
                </li>

                <li class="list-group-item">
                    <div class="form-group">
                        <x-forms.text-field type="textarea" label="Հետազոտություն" name="examination_comment"
                            validationType="ajax" value="{{ $item->examination_comment }}" />
                    </div>
                </li>

                <li class="list-group-item">
                    @include('shared.forms.attachments_container', ["attachments" => $item->attachments]);
                    <div class="form-group">
                        <x-forms.text-field type="file" label="Կից փաստաթղթեր" name="attachments[]"
                            validationType="ajax" multiple="multiple" />
                    </div>
                </li>

                @include('shared.forms.list_group_item_submit', ["has_files" => true, 'btn_text' => 'Պահպանել'])
            </ul>
        </form>
        @empty

        @endforelse
    </div>

    <div class="collapse show xray-examination-collapse">
        <form method="POST" class="ajax-submitable has-files"
            action="{{ route("patients.stationary.xray_examination", ["patient" => $patient, "stationary" => $stationary]) }}">
            @csrf
            @method("PATCH")

            <ul class="list-group mt-2">
                <li class="list-group-item">
                    <div class="form-row align-items-center">
                        <div class="col-sm-12 col-md-4">
                            <strong>Հետազոտության ամսաթիվ</strong>
                        </div>
                        <div class="col-sm-12 col-md-8">
                            <x-forms.text-field type="date" name="examination_date" validationType="ajax" />
                        </div>
                    </div>
                </li>

                <li class="list-group-item">
                    <div class="form-group">
                        <x-forms.text-field type="textarea" label="Հետազոտություն" name="examination_comment"
                            validationType="ajax" />
                    </div>
                </li>

                <li class="list-group-item">
                    <div class="form-group">
                        <x-forms.text-field type="file" label="Կից փաստաթղթեր" name="attachments[]"
                            validationType="ajax" multiple="multiple" />
                    </div>
                </li>

                @include('shared.forms.list_group_item_submit', ["has_files" => true, 'btn_text' => 'Ավելացնել'])
            </ul>
        </form>
    </div>
</section>
