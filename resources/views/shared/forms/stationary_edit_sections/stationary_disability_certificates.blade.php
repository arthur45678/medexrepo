@php
    $certificate_action_route = $included_action_route ?? route("patients.stationary.update_disability_certificates");
    $certificate_submit_txt = $included_submit_txt ?? null;
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
    <form action="{{ $certificate_action_route }}" class="ajax-submitable dont-reset" method="POST">
        @method("PUT")
        <input type="hidden" name="id" value="{{ $item->id }}">
        <input type="hidden" name="insert_form_id" value="{{ $insert_form_id }}">
        @if (isset($is_approvable))
            <input type="hidden" name="is_approvable" value="{{ $is_approvable }}">
        @endif
        <ul class="list-group mt-2">
            <li class="list-group-item">
                <div class="form-row align-items-center my-2">
                    <strong class="ml-2">№</strong>
                    <x-forms.text-field type="number" name="number" min="0" class="col-sm-2 ml-2" value="{{ $item->number }}" validationType="ajax" />
                </div>

                <div class="form-row align-items-center my-2">
                    <div class="col-md-5" style="height: 70px">
                        <x-forms.text-field type="date" name="from" value="{{ $item->from }}" validationType="ajax" />
                    </div>
                    <div class="col-md-2" style="height: 70px">
                        <em class="ml-2">ից, մինչև</em>
                    </div>
                    <div class="col-md-5" style="height: 70px">
                        <x-forms.text-field type="date" name="to" value="{{ $item->to }}" validationType="ajax" />
                    </div>
                </div>
            </li>
            @include('shared.forms.list_group_item_submit', [
                'btn_text' => $certificate_submit_txt,
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
