<!-- stationary_primary_diagnosis: top of the page - stationary-edit -->
<ul class="list-group" id="stationary_primary_diagnosis">
    <li class="list-group-item">
        <strong>
            Հիմնական հիվանդության ախտորոշումը՝ <small>գրվում է դուրս գրումից հետո</small>
            <x-forms.prev-posts-link href='{{$route . "#stationary_diagnosis_primary_disease"}}' size='sm'/>
        </strong>

        <!-- CREATE diagnosis_primary_disease -->
        @if ($primary_diagnosis->user_id  === auth()->id() || empty($primary_diagnosis->user_id))
        @php
            $pd_insert_form = 'pd_insert_form';
            $pd_delete_form = 'pd_delete_form';
        @endphp
        <form action="{{$update_diagnosis}}" method="POST" class="ajax-submitable dont-reset"
        id="{{$pd_insert_form}}">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" value="{{$primary_diagnosis->id}}">
            <input type="hidden" name="diagnosis_type" value="{{$primary_diagnosis->diagnosis_type}}">
            <input type="hidden" name="wrapper_id" value="#stationary_primary_diagnosis">
            <input type="hidden" name="is_approvable" value="1">

            <div class="container collapse show primary-disease">

                <div class="col-md-12 my-2">
                    {{-- <x-forms.magic-search class="magic-search ajax" data-catalog-name="diseases"
                        value='{{$primary_diagnosis->disease_id}}'
                        hidden-id="primary_disease_id" hidden-name="disease_id"
                        placeholder="Ընտրել ախտորոշումը․․․" /> --}}
                    <x-forms.magic-search class="magic-search-diseases" data-catalog-name="diseases"
                        value='{{$primary_diagnosis->disease_id}}'
                        hidden-id="primary_disease_id" hidden-name="disease_id"
                        placeholder="Ընտրել ախտորոշումը․․․" />
                </div>
                <div class="col-md-12 my-2">
                    <textarea name="diagnosis_comment" class="form-control"
                        placeholder="ազատ գրառման դաշտ․․․">{{$primary_diagnosis->diagnosis_comment}}</textarea>
                </div>
                <div class="col-md-12 my-2">
                    @include('shared.forms.list_group_item_submit', [
                        'btn_text'=>$primary_diagnosis->id ? 'փոփխել' : 'ավելացնել',
                        'delete_form_id' => $primary_diagnosis->id ? $pd_delete_form : null,
                    ])
                </div>
            </div>
        </form>
        <form action="{{$delete_reset_diagnoses}}" method="POST" class="ajax-submitable" id='{{$pd_delete_form}}'>
            @csrf
            <input type="hidden" name="diagnosis_id" value="{{$primary_diagnosis->id?? null}}">
            <input type="hidden" name="reset_form_id" value="{{$pd_insert_form}}">
            {{-- <input type="hidden" name="reset_fields[]" value="diagnosis_date"> --}}
            <input type="hidden" name="reset_fields[]" value="diagnosis_comment">
            <input type="hidden" name="reset_fields[]" value="diagnosis_id">
            <input type="hidden" name="reset_fields[]" value="disease_id">
            <input type="hidden" name="reset_fields[]" value="id">
        </form>
        @endif
    </li>
</ul>
