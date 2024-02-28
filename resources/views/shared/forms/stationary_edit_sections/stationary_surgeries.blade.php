@php
    $action_route = $included_action_route ?? route("patients.stationary.update_many_surgeries");
    $submit_txt = $included_submit_txt ?? null;
    $method = $included_form_method ?? "PUT";

    $form_id = \Str::random(12);
    $insert_form_id = 'insert_'.$form_id;
    $delete_form_id = 'delete_'.$form_id;
    $is_approvable = $is_approvable ?? false;
    $row_name = $row_name ?? '';
@endphp

<form action="{{ $action_route }}" class="ajax-submitable dont-reset" method="POST" id='{{$insert_form_id}}'>
    <p class="my-2">#{{$item->id}}</p>
    @method($method)
    <input type="hidden" name="id" value="{{ $item->id }}">
    <input type="hidden" name="insert_form_id" value="{{ $insert_form_id }}">
    @if (isset($is_approvable))
        <input type="hidden" name="is_approvable" value="{{ $is_approvable }}">
    @endif

    <ul class="list-group mt-2">
        <li class="list-group-item">
            <div class="col-xs-12 my-2">
                <x-forms.text-field name="surgery_date" type="datetime-local" value="{{ $item->getFormattedDate('surgery_date', true) }}" validationType="ajax" />
            </div>
            <div class="col-xs-12 my-2">
                <x-forms.magic-search class="magic-search ajax" data-catalog-name="surgeries" value='{{ $item->surgery_id }}' hidden-id="old_surgery_id_{{ $item->id }}"
                    hidden-name="surgery_id" placeholder="ընտրել վիրահատությունը․․․" />
            </div>
            <div class="col-xs-12 my-2">
                <x-forms.magic-search class="magic-search ajax" data-catalog-name="anesthesias" value='{{ $item->anesthesia_id }}'
                    hidden-id="anesthesia_id" hidden-name="anesthesia_id" placeholder="ընտրել անզգայացման եղանակը․․․" />
            </div>
            <div class="col-xs-12 my-2">
                <x-forms.text-field type="textarea" name="complications" placeholder="վիրահատման բարդություններ․․․" value="{{ $item->complications }}" validationType="ajax" />
            </div>
        </li>
        @include('shared.forms.list_group_item_submit', [
            'btn_text' => $submit_txt,
            'delete_form_id' => $delete_form_id
        ])
    </ul>
</form>
<form action="{{$route_delete}}" method="POST" class="ajax-submitable" id='{{$delete_form_id}}'>
    @csrf

    <input type="hidden" name="id" value="{{$item->id}}">
    <input type="hidden" name="row_name" value="{{$row_name}}">
    <input type="hidden" name="hideFormId" value="{{$insert_form_id}}">
</form>
