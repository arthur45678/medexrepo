@php
    $action_route = $included_action_route ?? route("patients.stationary.update_histological_examinations");
    $submit_txt = $included_submit_txt ?? null;
    $method = $included_form_method ?? "PUT";
    $form_id = \Str::random(12);
    $insert_form_id = 'insert_'.$form_id;
    $delete_form_id = 'delete_'.$form_id;
    $route_delete = $route_delete ?? '#';
    $is_approvable = $is_approvable ?? false;
    $row_name = $row_name ?? '';
@endphp
<div id={{$insert_form_id}}>
<p class="my-2">#{{$item->id}}</p>
    <form action="{{ $action_route }}" method="POST" class="ajax-submitable dont-reset">
        @method($method)
        <input type="hidden" name="id" value="{{ $item->id }}">
        <input type="hidden" name="insert_form_id" value="{{ $insert_form_id }}">
        @if (isset($is_approvable))
            <input type="hidden" name="is_approvable" value="{{ $is_approvable }}">
        @endif

        <ul class="list-group mt-2">
            <li class="list-group-item">
                <div class="form-row align-items-center my-2 mx-2">
                    <div class="col-md-6" style="height: 90px">
                        <strong>ամսաթիվ</strong>
                        <x-forms.text-field type="date" validationType="ajax" class="mt-1" name="examination_date" value="{{ $item->examination_date }}" />
                    </div>
                    <div class="col-md-6" style="height: 90px">
                        <strong>եզրակացության համար №</strong>
                        <x-forms.text-field type="number" min="0" validationType="ajax" class="mt-1" name="examination_number" value="{{ $item->examination_number }}" />
                    </div>
                </div>

                <hr class="hr-dashed">
                <div class="container">
                    <x-forms.text-field type="textarea" validationType="ajax" class="mt-1" name="examination" placeholder="ազատ լրացման դաշտ․․․" value="{{ $item->examination }}" />
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
</div>
