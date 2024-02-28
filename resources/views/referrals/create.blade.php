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
    <form class="ajax-submitable-off" action="{{ route('patients.referrals.store', ['patient'=> $patient]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <ul class="list-group">

            <li class="list-group-item list-group-item-dark py-0">
                <h6 class="my-0 py-1">Ուղեգրվող հիվանդի տվյալները․</h6>
            </li>
            <li class="list-group-item">
                <strong>
                    <span class="badge badge-light mr-1">1.</span>
                    Ազգանուն, անուն, հայրանուն
                </strong>
                <ins class="ml-4">{{$patient->all_names}}</ins>
            </li>
            <li class="list-group-item">
                <strong>
                    <span class="badge badge-light mr-1">2.</span>
                    Ծննդյան թիվը՝
                </strong>
                <ins class="ml-4">{{$patient->birth_date_reversed}}</ins>
            </li>
            <hr class="hr-dotted">



            @for ($j = 0; $j < $repeatables; $j++)
            <div class="container referral-wrap-row {{$j < old("referral_wrap_length", 1) ?' ':'d-none'}}">
                <li class="list-group-item list-group-item-dark">
                    <h5>Ուղեգիր № {{$j+1}}</h5>
                </li>
                <li class="list-group-item">
                    <strong>
                        <span class="badge badge-light mr-1">3.</span>
                        Ստացող բաժին<span class="text-danger">*</span>/օգտատեր
                    </strong>
                    <x-forms.magic-search hidden-id="department_id_{{$j}}" hidden-name="department_id[]" autocomplete="off"
                        placeholder="Ընտրել ստացող բաժինը․․․" class="my-2" id="department_search_{{$j}}"
                        value='{{old("department_id.$j")}}' />
                    <x-forms.magic-search hidden-id="receiver_id_{{$j}}" hidden-name="receiver_id[]" autocomplete="off"
                        placeholder="Ընտրել ստացող օգտատիրոջը․․․" class="my-2" id="user_search_{{$j}}"
                        value='{{old("receiver_id.$j")}}' />


                    <input type="datetime-local"  id="data_start_{{$j}}" name="calendar_id[]">
                    <a href="#" class="user_calendar"  style="display: none;" target="_blank">Դիտել գրաֆիկը</a>
                </li>

                <li class="list-group-item">
                    <strong>
                        <span class="badge badge-light mr-1">4.</span>
                        Ծառայություն<span class="text-danger">*</span>/
                        վճարման տեսակ<span class="text-danger">*</span>/լրացուցիչ տեղեկություն
                    </strong>
                    {{-- data-limit="{{$data_limit}}" --}}
                    <x-forms.add-reduce-button type="add" data-row=".service-wrap-{{$j}}-row" data-limit="{{$data_limit}}"/>
                    <x-forms.add-reduce-button type="reduce" data-row=".service-wrap-{{$j}}-row" />
                    <x-forms.hidden-counter class="service-wrap-{{$j}}-rows" name="service_wrap_length[]"
                    value='{{old("service_wrap_length.$j", 1)}}'/>

                    @for ($i = 0; $i < $data_limit; $i++)
                    <div class="container service-wrap-{{$j}}-row {{$i < old("service_wrap_length.$j", 1) ?' ':'d-none'}}">
                        {{-- <strong>№ {{$i+1}} - ծառայություն</strong>

                        <x-forms.magic-search hidden-name="service_id[{{$j}}][]" hidden-id="service_id_{{$j}}_{{$i}}" autocomplete="off"
                        placeholder="Ընտրել ծառայությունը․․․" class="my-2" id="service_search_{{$j}}_{{$i}}"
                        value='{{old("service_id.$j.$i")}}' />

                        <x-forms.magic-search hidden-name="payment_type[{{$j}}][]" hidden-id="payment_type_id_{{$j}}_{{$i}}" autocomplete="off"
                        placeholder="Ընտրել վճարման տեսակը․․․" class="my-2" id="payment_type_search_{{$j}}_{{$i}}"
                        value='{{old("payment_type.$j.$i")}}' />

                        <x-forms.text-field name="comment[{{$j}}][]" placeholder="լրացուցիչ տեղեկություն"
                        type="textarea" value='{{old("comment.$j.$i")}}'/> --}}
                        <div class="row">
                            <div class="col-md-4">
                                <x-forms.magic-search hidden-name="payment_type[{{$j}}][]" hidden-id="payment_type_id_{{$j}}_{{$i}}"
                                    placeholder="Ընտրել վճարման տեսակը․․․" class="my-2" id="payment_type_search_{{$j}}_{{$i}}"
                                    value='{{old("payment_type.$j.$i", "paid")}}' data-key-wrapper-id='key_wrapper_{{$j}}_{{$i}}'/>
                            </div>
                            <div class="col-md-8" id="key_wrapper_{{$j}}_{{$i}}">
                                <div class="row">
                                    <div class="col-md-6">
                                        <x-forms.magic-search hidden-name="service_k1[{{$j}}][]" hidden-id="service_k1_{{$j}}_{{$i}}"
                                            placeholder="Ընտրել k1․․․" class="my-2" id="service_k1_search_{{$j}}_{{$i}}"
                                            value='{{old("service_k1.$j.$i")}}' />
                                    </div>
                                    <div class="col-md-6">
                                        <x-forms.magic-search hidden-name="service_k2[{{$j}}][]" hidden-id="service_k2_{{$j}}_{{$i}}"
                                            placeholder="Ընտրել k2․․․" class="my-2" id="service_k2_search_{{$j}}_{{$i}}"
                                            value='{{old("service_k2.$j.$i")}}' />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <strong>№ {{$i+1}} - ծառայություն</strong>
                                <span class="spinner-border spinner-border-sm d-none" id="spinner_{{$j}}_{{$i}}"></span>
                                <x-forms.magic-search hidden-name="service_id[{{$j}}][]" hidden-id="service_id_{{$j}}_{{$i}}"
                                    placeholder="Ընտրել ծառայությունը․․․" class="my-2" id="service_search_{{$j}}_{{$i}}"
                                    value='{{old("service_id.$j.$i")}}' />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <x-forms.text-field name="comment[{{$j}}][]" placeholder="լրացուցիչ տեղեկություն"
                                    type="textarea" value='{{old("comment.$j.$i")}}'/>
                            </div>
                        </div>
                    </div>
                    @endfor

                </li>
                <hr class="hr-dashed">
            </div>
            @endfor

            <li class="list-group-item list-group-item-light">
                <x-forms.add-reduce-button type="add" data-row=".referral-wrap-row" classes="mr-1"/>
                <x-forms.add-reduce-button type="reduce" data-row=".referral-wrap-row" />
                <x-forms.hidden-counter class="referral-wrap-rows" name="referral_wrap_length"
                value='{{old("referral_wrap_length", 1)}}'/>
            </li>
            @include('shared.forms.list_group_item_submit')
        </ul>
    </form>
</div>
@endsection

@section('javascript')
<script src="{{ mix('js/jquery.js') }}"></script>
<script src="{{ mix('js/all.magicsearch.js') }}"></script>
@yield('myadd')
<script>
    const repeatables = @json($repeatables);
    const usersUrl = @json(route('lists.users_full')); // same as {!! json_encode(route('lists.users_full'))  !!}
    const departmentsUrl = @json(route('catalogs.departments_full'));
    const servicesUrl = @json(route('catalogs.services_full'));
    // console.log(usersUrl)
    // console.log(departmentsUrl)
    // console.log(servicesUrl)

    // urls related to service selection
    const paid_services = @json($paid_services);
    const state_ordered_services = @json($state_ordered_services);

    const payment_types_hy_url = @json(route('catalogs.payment_types_hy_json'));
    const paid_services_url = @json(route('catalogs.paid_services_json'));
    const state_ordered_services_url = @json(route('catalogs.state_ordered_services_json'));

    const paid_services_k2_url = @json(route('catalogs.paid_services_k2_json'));
    const paid_services_k1_url = @json(route('catalogs.paid_services_k1_json'));


    $('[id^="user_search"]').magicsearch(
        window.medexMagicSearch.assignConfigs({
            type: "ajax",
            dataSource: `${usersUrl}?filterBy=department_id&needle=0`,
            fields: ["f_name","l_name"],
            id: "id",
            onchange: true,
            format: "%f_name% %l_name%",
            success: function($input, data) {
                // console.log(data.id)

                $input.parent().parent().find(".user_calendar").show();
                $input.parent().parent().find(".user_calendar").attr('href','{{url('calendar')}}/'+data.id);

                const hidden_input_id = $input.data('hidden');
                $(hidden_input_id).val($input.attr("data-id"));
            },
            afterDelete: function($input, data) {
                const hidden_input_id = $input.data("hidden");
                $(hidden_input_id).val("");
            }
        })
    );

    // $('[id^="service_search"]').magicsearch(
    //     window.medexMagicSearch.assignConfigs({
    //         type: "ajax",
    //         // dataSource: `${servicesUrl}?filterBy=department_id&needle=0`,
    //         dataSource: `${servicesUrl}`,
    //         fields: ["code","name"],
    //         id: "id",
    //         format: "%code% %name%",
    //         success: function($input, data) {
    //             // console.log(data)

    //             const hidden_input_id = $input.data('hidden');
    //             $(hidden_input_id).val($input.attr("data-id"));
    //         },
    //         afterDelete: function($input, data) {
    //             const hidden_input_id = $input.data("hidden");
    //             $(hidden_input_id).val("");
    //         }
    //     })
    // );

    // //
    // $('[id^="payment_type_search"]').magicsearch(
    //     window.medexMagicSearch.assignConfigs({
    //         type: "ajax",
    //         dataSource: `${payment_types_hy_url}`,
    //         success: function($input, data) {
    //             console.log(data)

    //             const hidden_input_id = $input.data('hidden');
    //             $(hidden_input_id).val($input.attr("data-id"));
    //         },
    //         afterDelete: function($input, data) {
    //             const hidden_input_id = $input.data("hidden");
    //             $(hidden_input_id).val("");
    //         }
    //     })
    // );

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
                // console.log('nth ->', nth)

                const usersJsonUrl = (data.closed_from_outside === '1') ? `${usersUrl}?groupByRole=department_head` : usersUrl;

                $.getJSON(usersJsonUrl, {filterBy: 'department_id', needle: data.id}, function(filteredUsers) {
                    console.log(filteredUsers)
                    // const closedFromOutside = data.closed_from_outside === '1';
                    // const dataUsers = closedFromOutside ? [] : filteredUsers;
                    // $('#user_search_' + nth).trigger('update',{dataSource: dataUsers}).val('').attr("disabled", closedFromOutside);
                    $('#user_search_' + nth).trigger('update',{dataSource: filteredUsers}).val('');
                    $('#receiver_id_' + nth).val('');
                })

                /*
                $.getJSON(servicesUrl, {filterBy: 'department_id', needle: data.id}, function(filteredServices) {
                    console.log(filteredServices)
                    $('[id^="service_search_'+ nth+'"]' ).trigger('update',{dataSource: filteredServices}).val('');
                    $('[id^="service_id_'+ nth+'"]').val('');
                })
                */

                const hidden_input_id = $input.data('hidden');
                $(hidden_input_id).val($input.attr("data-id"));
            },
            afterDelete: function($input, data) {
                const nth = $input.attr('id').slice(-1);
                $('#user_search_' + nth).trigger('update',{dataSource: []}).val('');//.attr("disabled", false);
                $('#receiver_id' + nth).val('');

                /*
                $('[id^="service_search_'+ nth+'"]' ).trigger('update',{dataSource: []}).val('');
                $('[id^="service_id_'+ nth+'"]').val('');
                */

                const hidden_input_id = $input.data('hidden');
                $(hidden_input_id).val('');
            }
        })
    )


    $('[id^="payment_type_search"]').magicsearch(
            window.medexMagicSearch.assignConfigs({
                type: "ajax",
                dataSource: `${payment_types_hy_url}`,

                success: function($input, data = {value:'', label:''}) {
                    console.log(data)

                    toggleHiddenInputValue($input,'add');
                    toggleNthServiceSource($input, data.value);
                },

                afterDelete: function($input, data) {

                    toggleHiddenInputValue($input, 'remove');
                    toggleNthServiceSource($input, 'paid');
                }
            })
        );

        function toggleNthServiceSource($input, payment_type_value = 'paid' ) {
            const nth = $input.attr('id').slice(-4) || console.error('id must to be longer then 4 character');
            const serviceSource = payment_type_value === 'state_order' ? state_ordered_services : paid_services;
            const KeyWrapperSwitch = payment_type_value === 'state_order' ? 'hide' : 'show';
            console.log(nth);

            toggleSpinner(nth);
            toggleKeyWrapper($input, KeyWrapperSwitch);
            setNthServiceSource($input, serviceSource);
            setTimeout(() => toggleSpinner(nth), 800);
        }

        function toggleSpinner(nth) {
            const service_spinner = $('#spinner'+ nth);

            service_spinner.hasClass('d-none') ?
            service_spinner.removeClass('d-none') :
            service_spinner.addClass('d-none');
        }

        function toggleKeyWrapper($input, switTo = '') {
            const key_wrapper_id = $input.data('key-wrapper-id') || console.error('Need to have data-key-wrapper-id');
            const key_wrapper_elem = $(`#${key_wrapper_id}`);

            if(switTo === 'show') {
                key_wrapper_elem.removeClass('d-none');
            } else if(switTo === 'hide') {
                key_wrapper_elem.addClass('d-none');
            }else{
                key_wrapper_elem.hasClass('d-none') ?
                key_wrapper_elem.removeClass('d-none') :
                key_wrapper_elem.addClass('d-none');
            }
        }

        function setNthServiceSource($input, serviceSource) {
            const nth = $input.attr('id').slice(-4) || console.error('id must to be longer then 4 character');
            const service_search_elem = $('#service_search' + nth);
            const hidden_service_elem = $('#service_id' + nth);

            service_search_elem.trigger('update',{dataSource: serviceSource}).val('');
            hidden_service_elem.val('');
        }

        function setNthK2Source($input, k2Source) {
            const nth = $input.attr('id').slice(-4) || console.error('id must to be longer then 4 character');
            const service_k2_search_elem = $('#service_k2_search'+ nth);
            const hidden_service_k2_elem = $('#service_k2' + nth);

            // console.log(service_k2_search_elem)
            // console.log(hidden_service_k2_elem)

            service_k2_search_elem.trigger('update',{dataSource: k2Source}).val('');
            hidden_service_k2_elem.val('');
        }

        function toggleHiddenInputValue($input, switchTo='')
        {
            const hidden_input_id = $input.data('hidden');
            if(switchTo==='add') {
                $(hidden_input_id).val($input.attr("data-id"));
            }else if(switchTo==='remove')
            {
                $(hidden_input_id).val('');
            }else{
                $(hidden_input_id).val() ?
                $(hidden_input_id).val('') :
                $(hidden_input_id).val($input.attr("data-id"));
            }
        }

        function ajaxPaidServicesByKeys($input, key_one = '', key_two = '') {
            $.getJSON(`${paid_services_url}?key_one=${key_one}&key_two=${key_two}`,
            function(paid_services_by_keys) {
                console.log('paid_services_by_keys_length->', paid_services_by_keys.length);
                setNthServiceSource($input, paid_services_by_keys);
            });
        }

        function ajaxNthK2Source($input, key_one = '') {
            $.getJSON(`${paid_services_k2_url}?key_one=${key_one}`,
            function(k2_by_key_one) {
                console.log(k2_by_key_one);
                console.log('k2_by_key_one_length->',k2_by_key_one.length);
                setNthK2Source($input, k2_by_key_one);
            });
        }


        $('[id^="service_k1_search_"]').magicsearch(
            window.medexMagicSearch.assignConfigs({
                type: "ajax",
                dataSource: `${paid_services_k1_url}`,
                fields: ["id","code","key_one","cost"],
                id: "key_one",
                format: "%id% - %code% - %key_one% - %cost%դրամ",
                success: function($input, data) {
                    console.log(data)
                    console.log($input)

                    toggleHiddenInputValue($input, 'add');
                    ajaxPaidServicesByKeys($input, $input.attr("data-id"));
                    ajaxNthK2Source($input, $input.attr("data-id"))

                },
                afterDelete: function($input, data) {

                    toggleHiddenInputValue($input, 'remove');
                    setNthServiceSource($input, paid_services);
                    ajaxNthK2Source($input, $input.attr("data-id"));
                }
            })

        );

        $('[id^="service_k2_search_"]').magicsearch(
            window.medexMagicSearch.assignConfigs({
                type: "ajax",
                dataSource: `${paid_services_k2_url}`,
                fields: ["id","code","key_two","cost"],
                id: "key_two",
                format: "%id% - %code% - %key_two% - %cost%դրամ",
                success: function($input, data) {
                    console.log(data)
                    toggleHiddenInputValue($input, 'add');
                    ajaxPaidServicesByKeys($input, '', $input.attr("data-id"));
                },
                afterDelete: function($input, data) {
                    toggleHiddenInputValue($input, 'remove');

                    const nth = $input.attr('id').slice(-4) || console.error('id must to be longer then 4 character');
                    ajaxPaidServicesByKeys($input, $('#service_k1' + nth).val() || '');
                }
            })
        );

        $('[id^="service_search"]').magicsearch(
            window.medexMagicSearch.assignConfigs({
                dataSource: paid_services,
                fields: ["id","code","name","cost"],
                id: "id",
                format: "%id% - %code% - %name% - %cost%դրամ",
                success: function($input, data) {
                    console.log(data)
                    toggleHiddenInputValue($input, 'add');
                },
                afterDelete: function($input, data) {
                    toggleHiddenInputValue($input, 'remove');
                }
            })
        );
</script>

@endsection
