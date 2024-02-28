@php
    $diagnosis_action_route = $included_action_route ?? route("patients.stationary.update_many_diagnoses");
    $diagnosis_submit_txt = $included_submit_txt ?? null;
    $method = $included_form_method ?? "PUT";
    $form_id = \Str::random(12);
    $insert_form_id = 'insert_'.$form_id;
    $delete_form_id = 'delete_'.$form_id;
    $route_delete = $route_delete ?? '#';
    $is_approvable = $is_approvable ?? false;
    $row_name = $row_name ?? '';
@endphp

<div id='{{$insert_form_id}}'>
<p class="my-2">#{{$item->id}}</p>
<form action='{{ $diagnosis_action_route }}' class="ajax-submitable dont-reset" method="POST" id='{{$insert_form_id}}'>
    @method($method)
    @csrf
    <input type="hidden" name="id" value="{{ $item->id }}">
    <input type="hidden" name="insert_form_id" value="{{ $insert_form_id }}">
    @if (isset($has_hidden_type))
        <input type="hidden" name="type" value="{{ $item->type }}">
    @endif
    @if (isset($is_approvable))
        <input type="hidden" name="is_approvable" value="{{ $is_approvable }}">
    @endif
    <ul class="list-group mt-2">
        <li class="list-group-item">
            <div class="container">
                <div class="col-xs-12 my-2">
                    {{-- <x-forms.magic-search class="magic-search ajax" data-catalog-name="diseases" value='{{ $item->disease_id }}'
                        hidden-id="old_diagnoses_edit_{{ $item->id }}" hidden-name="disease_id"
                        placeholder="Ընտրել ախտորոշումը․․․" /> --}}
                    <x-forms.magic-search class="magic-search-diseases" data-catalog-name="diseases" value='{{ $item->disease_id }}'
                        hidden-id="old_diagnoses_edit_{{ $item->id }}" hidden-name="disease_id"
                        placeholder="Ընտրել ախտորոշումը․․․" />
                </div>

                @if (isset($has_diagnosis_date))
                <div class="col-xs-12 my-2">
                    <x-forms.text-field type="date" name="diagnosis_date" value="{{ $item->diagnosis_date }}" validationType="ajax" />
                </div>
                @endif

                <div class="col-xs-12 my-2">
                    <x-forms.text-field type="textarea" validationType="ajax" name="diagnosis_comment" placeholder="Ազատ լրացման դաշտ․․․" value="{{ $item->diagnosis_comment }}" />
                </div>
            </div>
        </li>
        @include('shared.forms.list_group_item_submit', [
            'btn_text' => $diagnosis_submit_txt,
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
</div>
