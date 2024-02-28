@extends('layouts.cardBase')

@section('css')
    <link href="{{mix("/css/jquery.magicsearch.min.css")}}" rel="stylesheet" />
@endsection


@section('card-header')
    @section('card-header-classes', '')
    <div class="text-center">
        <h3>Սերվիսների սելեկտոր</h3>
    </div>
@endsection

@section('card-content')
    @include('shared.info-box')
    <div class="container">
        <form action="">

@for ($j = 4; $j < 5; $j++)
    <h3> Uxegir {{$j}}</h3>
    @for ($i = 0; $i < 2; $i++)
        <h5>carayutyun {{$i}}</h5>
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

    @endfor
@endfor
        </form>
    </div>
@endsection

@section('javascript')
    <script src="{{ mix('js/jquery.js') }}"></script>
    <script src="{{ mix('js/all.magicsearch.js') }}"></script>
    <script>
        // urls related to service selection
        const paid_services = @json($paid_services);
        const state_ordered_services = @json($state_ordered_services);

        const payment_types_hy_url = @json(route('catalogs.payment_types_hy_json'));
        const paid_services_url = @json(route('catalogs.paid_services_json'));
        const state_ordered_services_url = @json(route('catalogs.state_ordered_services_json'));

        const paid_services_k2_url = @json(route('catalogs.paid_services_k2_json'));
        const paid_services_k1_url = @json(route('catalogs.paid_services_k1_json'));

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



