@php
    $action_route = $included_action_route ?? route("patients.stationary.update_social_packages");
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
                {{-- <div class="container">
                    <div class="col-md-12 my-2">
                        <x-forms.magic-search class="treatments-search" value='{{$item->treatment_id}}'
                            hidden-id="update_treatment_other_type_id" hidden-name="treatment_id"
                            placeholder="ընտրել բուժման տեսակը․․․" />
                    </div>

                    <div class="col-md-12 my-2">
                        <textarea name="treatment_comment" class="form-control"
                            placeholder="ազատ լրացման դաշտ․․․">{{$item->treatment_comment}}</textarea>
                    </div>
                </div> --}}
                <x-forms.magic-search class="magic-search ajax my-2" data-catalog-name="social_packages"
                    hidden-id="update_social_package_id_{{$insert_form_id}}" hidden-name="social_package_id" autocomplete="off"
                    placeholder="Ընտրել սոցիալական խումբը․․․" validationType="ajax"
                    value='{{$item->social_package_id}}' />
                <em class="error text-danger" data-input="social_package_id"></em>
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
