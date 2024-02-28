<!-- stationary_disability_certificates 15. -->
<ul class="list-group" id="disability_certificates">
    <li class="list-group-item">

        <!-- disability-certificates :UPDATE: -->
        @if (!$stationary_disability_certificates->isEmpty())
        <div class="collapse disability-certificates-collapse mx-2">
            <strong>
                <span class="badge badge-light mx-1">15.</span>
                Նշումներ անաշխատունակության թերթիկ տրման մասին
            </strong>
            <x-forms.prev-posts-link href='{{$route."#stationary_disability_certificates"}}' />

            <button class="btn btn-primary btn-sm float-right" type="button" data-toggle="collapse" data-target=".disability-certificates-collapse">
                <x-svg icon="cui-pencil" />
            </button>

            @foreach ($stationary_disability_certificates as $item)
                @include('shared.forms.stationary_edit_sections.stationary_disability_certificates', [
                    'item' => $item,
                    // 'included_action_route' => $route_diagnosis,
                    // 'included_form_method' => 'PATCH',
                    'included_submit_txt' => 'փոփոխել',
                    // 'has_hidden_type' => true,
                    // 'has_diagnosis_date' => false,
                    'row_name' => '15. Նշումներ անաշխատունակության թերթիկ տրման մասին',
                    'route_delete' => route('patients.stationary.delete_disability_certificates'),
                    'is_approvable' => true
                ])
            @endforeach
        </div>
        @endif

        <!-- disability-certificates :CREATE: -->
        <div class="collapse show disability-certificates-collapse">
            <form action="{{$create_disability_certificate}}" method="POST" class="ajax-submitable -off">
                @csrf
                <input type="hidden" name="wrapper_id" value="#disability_certificates">
                <input type="hidden" name="is_approvable" value="1">
                <strong>
                    <span class="badge badge-light mx-1">15.</span>
                    Նշումներ անաշխատունակության թերթիկ տրման մասին
                </strong>
                <x-forms.prev-posts-link href='{{$route."#stationary_disability_certificates"}}' />

                @if (!$stationary_disability_certificates->isEmpty())
                    <button class="btn btn-primary btn-sm float-right" type="button" data-toggle="collapse" data-target=".disability-certificates-collapse">
                        <x-svg icon="cui-pencil" />
                    </button>
                @endif

                <div class="form-row align-items-center my-2">
                    <strong class="ml-2">№</strong>
                    <x-forms.text-field type="number" name="number" class="col-md-2 ml-2" label="" min="0" validationType="ajax" />
                </div>

                <div class="form-row align-items-center my-2">

                    <div class="col-md-5" style="height: 70px">
                        <x-forms.text-field type="date" name="from" label="" validationType="ajax" />
                    </div>
                    <div class="col-md-2" style="height: 70px">
                        <em class="ml-2">ից, մինչև</em>
                    </div>

                    <div class="col-md-5" style="height: 70px">
                        <x-forms.text-field type="date" name="to" label="" validationType="ajax" />
                    </div>
                </div>
                <div class="my-2">
                    @include('shared.forms.list_group_item_submit', ['btn_text' => 'ավելացնել'])
                </div>
            </form>
        </div>

    </li>
</ul>
