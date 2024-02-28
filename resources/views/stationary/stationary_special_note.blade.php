@php
// view name - stationary_special_note.blade.php
$special_notes = $user->stationary_special_notes ?? [];
$route = route("patients.stationary.show", ["patient" => $patient, "stationary" => $stationary]);
$ssn_action = route("patients.stationary.special_note", ["patient" => $patient, "stationary" => $stationary])
@endphp


<section id="stationary_special_note">
    <ul class="list-group mt-2">
        <li class="list-group-item list-group-item-info">
            <h4 class="text-center">Հատուկ նշումներ
                <x-forms.prev-posts-link href='{{$route."#stationary_special_note"}}' />
                @if (count($special_notes))
                <button class="btn btn-primary btn-sm" type="button" data-toggle="collapse"
                    data-target=".special-notes-collapse">
                    <x-svg icon="cui-pencil" />
                </button>
                @endif
            </h4>
        </li>
    </ul>

    @if (count($special_notes))
    <div class="collapse special-notes-collapse">
        @forelse ($special_notes as $item)
        <form method="POST" class="ajax-submitable has-files dont-reset" action="{{ $ssn_action }}">
            @csrf
            @method("PATCH")
            <input type="hidden" name="id" value={{ $item->id }}>
            <ul class="list-group mt-2">
                <li class="list-group-item">
                    <strong>Ամսաթիվ</strong>
                    <x-forms.text-field type='date' name='special_note_date'
                        value='{{ $item->getFormattedDate("special_note_date") }}' validationType="ajax" />

                    <hr class="hr-dashed">
                    <strong>Նշում</strong>
                    <x-forms.text-field type='textarea' name='special_note_comment' placeholder="ազատ լրացման դաշտ․․․"
                        value='{{ $item->special_note_comment }}' validationType="ajax" />
                </li>

                <li class="list-group-item">
                    @include('shared.forms.attachments_container', ["attachments" => $item->attachments])
                    <div class="form-group">
                        <x-forms.text-field type="file" label="Կցել փաստաթղթեր" name="attachments[]"
                            multiple="multiple" />
                    </div>
                </li>

                @include('shared.forms.list_group_item_submit', ["has_files" => true, 'btn_text' => 'Պահպանել'])
            </ul>
        </form>
        @empty
        <h4>Գրառումներ չեն գտնվել</h4>
        @endforelse
    </div>
    @endif

    <div class="collapse show special-notes-collapse">
        <form method="POST" class="ajax-submitable has-files" action="{{ $ssn_action }}">
            @csrf
            @method("PATCH")

            <ul class="list-group mt-2">
                <li class="list-group-item">
                    <strong>Ամսաթիվ</strong>
                    <x-forms.text-field type='date' name='special_note_date' value='{{old("special_note_date")}}'
                        validationType="ajax" label="" />

                    <hr class="hr-dashed">
                    <strong>Նշում</strong>
                    <x-forms.text-field type='textarea' name='special_note_comment' placeholder="ազատ լրացման դաշտ․․․"
                        value='{{old("special_note_comment")}}' validationType="ajax" label="" />
                </li>

                <li class="list-group-item">
                    <x-forms.text-field type="file" label="Կցել փաստաթղթեր" name="attachments[]" multiple="multiple" />
                </li>

                @include('shared.forms.list_group_item_submit', ["has_files" => true, 'btn_text' => 'Ավելացնել'])
            </ul>
        </form>
    </div>
</section>
