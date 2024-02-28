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
                        <strong>№ {{$i+1}} - ծառայություն</strong>

                        <x-forms.magic-search hidden-name="service_id[{{$j}}][]" hidden-id="service_id_{{$j}}_{{$i}}" autocomplete="off"
                        placeholder="Ընտրել ծառայությունը․․․" class="my-2" id="service_search_{{$j}}_{{$i}}"
                        value='{{old("service_id.$j.$i")}}' />

                        <x-forms.magic-search hidden-name="payment_type[{{$j}}][]" hidden-id="payment_type_id_{{$j}}_{{$i}}" autocomplete="off"
                        placeholder="Ընտրել վճարման տեսակը․․․" class="my-2" id="payment_type_search_{{$j}}_{{$i}}"
                        value='{{old("payment_type.$j.$i")}}' />

                        <x-forms.text-field name="comment[{{$j}}][]" placeholder="լրացուցիչ տեղեկություն"
                        type="textarea" value='{{old("comment.$j.$i")}}'/>
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

    const payment_types_hy_url = @json(route('catalogs.payment_types_hy_json'));

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

    $('[id^="service_search"]').magicsearch(
        window.medexMagicSearch.assignConfigs({
            type: "ajax",
            // dataSource: `${servicesUrl}?filterBy=department_id&needle=0`,
            dataSource: `${servicesUrl}`,
            fields: ["code","name"],
            id: "id",
            format: "%code% %name%",
            success: function($input, data) {
                // console.log(data)

                const hidden_input_id = $input.data('hidden');
                $(hidden_input_id).val($input.attr("data-id"));
            },
            afterDelete: function($input, data) {
                const hidden_input_id = $input.data("hidden");
                $(hidden_input_id).val("");
            }
        })
    );

    //
    $('[id^="payment_type_search"]').magicsearch(
        window.medexMagicSearch.assignConfigs({
            type: "ajax",
            dataSource: `${payment_types_hy_url}`,
            success: function($input, data) {
                console.log(data)

                const hidden_input_id = $input.data('hidden');
                $(hidden_input_id).val($input.attr("data-id"));
            },
            afterDelete: function($input, data) {
                const hidden_input_id = $input.data("hidden");
                $(hidden_input_id).val("");
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
</script>

@endsection
