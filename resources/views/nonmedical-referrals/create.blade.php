@extends('layouts.cardBase')

@section('css')
    <link href="{{mix("/css/jquery.magicsearch.min.css")}}" rel="stylesheet" />
@endsection


@section('card-header')
@section('card-header-classes', '')

<div class="text-center">
    <h3>Ուղեգիր</h3>
</div>
@endsection


@section('card-content')
    @include('shared.info-box')

    <div class="container">
        <form class="ajax-submitable-off" action="{{ route('nonmedical-referrals.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <ul class="list-group">

                @for ($j = 0; $j < $repeatables; $j++)
                    <div class="container referral-wrap-row {{$j < old("referral_wrap_length", 1) ?' ':'d-none'}}">
                        <li class="list-group-item list-group-item-dark">
                            <h5>Ուղեգիր № {{$j+1}}</h5>
                        </li>
                        <li class="list-group-item">
                            <strong>
                                <span class="badge badge-light mr-1">1.</span>
                                Ստացող բաժին<span class="text-danger">*</span>/օգտատեր
                            </strong>
                            <x-forms.magic-search hidden-id="department_id_{{$j}}" hidden-name="department_id[]"
                                                  placeholder="Ընտրել ստացող բաժինը․․․" class="my-2" id="department_search_{{$j}}" />
                            <x-forms.magic-search hidden-id="receiver_id_{{$j}}" hidden-name="receiver_id[]"
                                                  placeholder="Ընտրել ստացող օգտատիրոջը․․․" class="my-2" id="user_search_{{$j}}" />
                        </li>




                        <li class="list-group-item">
                            <strong>
                                <span class="badge badge-light mr-1">2.</span>

                                Լրացուցիչ տեղեկություն
                            </strong>
                            {{-- data-limit="{{$data_limit}}" --}}
                            <x-forms.add-reduce-button type="add" data-row=".service-wrap-{{$j}}-row" data-limit="{{$data_limit}}"/>
                            <x-forms.add-reduce-button type="reduce" data-row=".service-wrap-{{$j}}-row" />
                            <x-forms.hidden-counter class="service-wrap-{{$j}}-rows" name="service_wrap_length[]" />

                            @for ($i = 0; $i < $data_limit; $i++)
                                <div class="container service-wrap-{{$j}}-row {{$i < old("service_wrap_length.$j", 1) ?' ':'d-none'}}">


                                    {{--Add dynamic images fields--}}
                                    <div class="form-group ">
                                        <div class="input-group-btn">
                                            <input type="file" name="attachments[{{$j}}][]" id="fileToUpload">
                                        </div>
                                    </div>

                                    <x-forms.text-field name="attachment_comments[{{$j}}][]" placeholder="լրացուցիչ տեղեկություն" type="textarea" />
                                </div>
                            @endfor

                        </li>


                        <hr class="hr-dashed">
                    </div>
                @endfor

                <li class="list-group-item list-group-item-light">
                    <x-forms.add-reduce-button type="add" data-row=".referral-wrap-row" classes="mr-1"/>
                    <x-forms.add-reduce-button type="reduce" data-row=".referral-wrap-row" />
                    <x-forms.hidden-counter class="referral-wrap-rows" name="referral_wrap_length"/>
                </li>
                @include('shared.forms.list_group_item_submit')
            </ul>
        </form>
    </div>
@endsection

@section('javascript')
    <script src="{{ mix('js/jquery.js') }}"></script>
    <script src="{{ mix('js/all.magicsearch.js') }}"></script>
    <script>
        const repeatables = @json($repeatables);
        const usersUrl = @json(route('lists.users_full')); // same as {!! json_encode(route('lists.users_full'))  !!}
        const departmentsUrl = @json(route('catalogs.departments_full'));
        const servicesUrl = @json(route('catalogs.services_full'));

        console.log(usersUrl)
        console.log(departmentsUrl)
        console.log(servicesUrl)

        $('[id^="user_search"]').magicsearch(
            window.medexMagicSearch.assignConfigs({
                type: "ajax",
                dataSource: `${usersUrl}?filterBy=department_id&needle=0`,
                fields: ["f_name","l_name"],
                id: "id",
                format: "%f_name% %l_name%",
                success: function($input, data) {
                    console.log(data)
                    const hidden_input_id = $input.data('hidden');
                    $(hidden_input_id).val($input.attr("data-id"));
                }
            })
        );

        $('[id^="service_search"]').magicsearch(
            window.medexMagicSearch.assignConfigs({
                type: "ajax",
                dataSource: `${servicesUrl}?filterBy=department_id&needle=0`,
                fields: ["code","name"],
                id: "id",
                format: "%code% %name%",
                success: function($input, data) {
                    console.log(data)
                    const hidden_input_id = $input.data('hidden');
                    $(hidden_input_id).val($input.attr("data-id"));
                }
            })
        );

        $('[id^="department_search"]').magicsearch(
            window.medexMagicSearch.assignConfigs({
                type:'ajax',
                dataSource: departmentsUrl,
                fields: ["name"],
                id: "id",
                format: "%name%", // "%id% %name%",
                success: function($input, data) {
                    console.log(data)
                    const nth = $input.attr('id').slice(-1);
                    console.log('nth ->', nth)
                    // const usersJsonUrl = (data.closed_from_outside === '1') ? `${usersUrl}?groupByRole=department_head` : usersUrl;

                    $.getJSON(usersUrl, {filterBy: 'department_id', needle: data.id}, function(filteredUsers) {
                        console.log(filteredUsers)
                        // const closedFromOutside = data.closed_from_outside === '1';
                        // const dataUsers = closedFromOutside ? [] : filteredUsers;
                        // $('#user_search_' + nth).trigger('update',{dataSource: dataUsers}).val('').attr("disabled", closedFromOutside);
                        $('#user_search_' + nth).trigger('update',{dataSource: filteredUsers}).val('');
                        $('#receiver_id_' + nth).val('');
                    })

                    $.getJSON(servicesUrl, {filterBy: 'department_id', needle: data.id}, function(filteredServices) {
                        console.log(filteredServices)
                        $('[id^="service_search_'+ nth+'"]' ).trigger('update',{dataSource: filteredServices}).val('');
                        $('[id^="service_id_'+ nth+'"]').val('');
                    })

                    const hidden_input_id = $input.data('hidden');
                    $(hidden_input_id).val($input.attr("data-id"));
                },
                afterDelete: function($input, data) {
                    const nth = $input.attr('id').slice(-1);
                    $('#user_search_' + nth).trigger('update',{dataSource: []}).val('').attr("disabled", false);
                    $('#receiver_id' + nth).val('');

                    $('[id^="service_search_'+ nth+'"]' ).trigger('update',{dataSource: []}).val('');
                    $('[id^="service_id_'+ nth+'"]').val('');

                    const hidden_input_id = $input.data('hidden');
                    $(hidden_input_id).val('');
                }
            })
        )
    </script>

@endsection
