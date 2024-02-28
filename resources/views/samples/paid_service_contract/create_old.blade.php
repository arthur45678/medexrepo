@extends('layouts.cardBase')

@section('css')
    <link href="{{mix("/css/jquery.magicsearch.min.css")}}" rel="stylesheet" />
@endsection


@section('card-header')
@section('card-header-classes', '')

<div class="text-center">
    <h3>ԲԺՇԿԱԿԱՆ ՕԳՆՈՒԹՅԱՆ ԵՎ ՍՊԱՍԱՐԿՄԱՆ ԾԱՌԱՅՈՒԹՅՈՒՆՆԵՐԻ ՎՃԱՐՈՎԻ ՄԱՏՈՒՑՄԱՆ ՕՐԻՆԱԿԵԼԻ ՊԱՅՄԱՆԱԳԻՐ</h3>

</div>
@endsection


@section('card-content')

    <div class="container">
        <form action="{{route('samples.patients.paid-service-contract.store',$patient->id)}}"  class="ajax-submitable" method="POST">
            @csrf
            <ul class="list-group">
                <li class="list-group-item">
                    <div class="form-row align-items-center">
                        <div class="col-md-4">
                            <strong>Կենսանյութը վերցնելու ամսաթիվ</strong>
                        </div>
                        <div class="col-md-8">
                            <x-forms.text-field name="date" validationType="ajax" type="datetime-local"
                                                value="" label="" />
                            @error('date')
                            <em class="error text-danger">Կենսանյութը վերցնելու ամսաթիվ դաշտը պարտադիր է։</em>
                            @enderror
                        </div>
                    </div>
                </li>
                <li class="list-group-item ">
                    <div class="form-row">
                        <div class="col-md-6">
                            <strong>
                                Ազգանուն, անուն, հայրանուն
                            </strong>
                            <ins class="ml-4">{{$patient->full_name}} {{ $patient->p_name}}</ins>
                        </div>
                        <div class="col-md-6">
                            <strong>
                                Բնակության վայր`
                            </strong>
                            <ins class="ml-4">{{ $patient->residence_region}} {{ $patient->town_village}} {{ $patient->street_house}}</ins>
                        </div>
                    </div>
                </li>
                <input type="hidden" name="patient_id" value="{{$patient->id}}">
                <input type="hidden" name="user_id" value="{{auth()->id()}}">
                <input type="hidden" name="department_id" value="{{auth()->user()->department_id}}">
                <li class="list-group-item ">
                    <div class="form-row">
                        <div class="col-md-4">
                            <strong>
                                Սոցիալական քարտ
                            </strong>
                            <ins class="ml-4">{{ $patient->soc_card}}</ins>
                        </div>
                    </div>
                </li>

                    @for ($j = 0; $j < $repeatables; $j++)
                        <div class="container referral-wrap-row {{$j < old("referral_wrap_length", 1) ?' ':'d-none'}}">
                <li class="list-group-item ">
                    {{-- data-limit="{{$data_limit}}" --}}
                    <x-forms.add-reduce-button type="add" data-row=".service-wrap-{{$j}}-row" data-limit="{{$data_limit}}"/>
                    <x-forms.add-reduce-button type="reduce" data-row=".service-wrap-{{$j}}-row" />
                    <x-forms.hidden-counter class="service-wrap-{{$j}}-rows" name="service_wrap_length[]" />
                    <strong>
                        Բժշկական օգնության և սպասարկման ծառայությունների անվանումները <br>
                        Գինը ըստ Կատարողի կողմից հաստատված գնացուցակի
                    </strong>
                    @for ($i = 0; $i < $data_limit; $i++)
                        <div class="container service-wrap-{{$j}}-row {{$i < old("service_wrap_length.$j", 1) ?' ':'d-none'}}">
                            <strong>№ {{$i+1}} - ծառայություն</strong>
                            <x-forms.magic-search hidden-name="service_id[{{$j}}][]" hidden-id="service_id_{{$j}}_{{$i}}"
                                                  placeholder="Ընտրել ծառայությունը․․․" class="my-2" id="service_search_{{$j}}_{{$i}}" />


                            <x-forms.text-field name="comment[{{$j}}][]" placeholder="լրացուցիչ տեղեկություն" type="textarea" />
                        </div>
                    @endfor

                </li>
                <hr class="hr-dashed">
    </div>
    @endfor

    <li class="list-group-item">
        <div>
            <x-forms.text-field type="textarea" name="doctor_services" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                                value="" label=" Անհրաժեշտ հարբժշկական և ոչ բուժական բնույթի հետևյալ ծառայությունների մատուցումը" />
        </div>
    </li>
    <li class="list-group-item">
        <div class="form-row align-items-center">
            <div class="col-md-9">
                <strong>Սույն պայմանագրով նախատեսված ծառայությունների մատուցումը սկսվում է</strong>
            </div>
            <div class="col-md-3">
                <x-forms.text-field name="date_start" type="datetime-local"  validation-type="ajax" value="" label=""/>
            </div>
            <div class="col-md-3 my-3">
                <strong> և պետք է ավարտվի</strong>
            </div>
            <div class="col-md-4" >
                <x-forms.text-field type="text" name="date_end" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                                    value="" label="" />
            </div>
            <div class="col-md-4 ml-5">
                <strong>ժամկետում</strong>
            </div>
        </div>
    </li>
    <li class="list-group-item">
        <div>
            <x-forms.text-field type="textarea" name="doctor_refusal" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                                value="" label="Բժշկական միջամտությունից հրաժարվելու դեպքում " />
        </div>
    </li>
    <li class="list-group-item">
        <div>
            <x-forms.text-field type="textarea" name="doctor_intervention" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                                value="" label="Բժշկական միջամտության ընթացքում" />
        </div>
    </li>
    <li class="list-group-item">
        <div>
            <x-forms.text-field type="textarea" name="doctor_period_following" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                                value="" label=" Բժշկական միջամտությանը հաջորդող ժամանակահատվածում" />
        </div>
    </li>
    <li class="list-group-item ">
        <div class="form-row">
            <div class="col-md-6">
                <x-forms.text-field type="text" name="price" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                                    value="" label="Գումարը" data-catalog-name="clinics" />
            </div>
            <div class="col-md-6">
                <x-forms.text-field type="text" name="" min="0" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                                    value="" label="Վճարման կարգը"  />
            </div>
        </div>
    </li>
    <li class="list-group-item">
        <div class="form-row align-items-center">
            <div class="col-md-9">
                <strong>Սույն պայմանագիրը ուժի մեջ է մտնում ստորագրման պահից և գործում է մինչև</strong>
            </div>
            <div class="col-md-3">
                <x-forms.text-field name="operates_until" type="datetime-local"  validation-type="ajax" value="" label=""/>
            </div>
        </div>
    </li>

    <li class="list-group-item">
        <strong>Բժիշկ</strong>
        <x-forms.add-reduce-button type="add" data-row=".side-effect-medicine-row"/>
        <x-forms.add-reduce-button type="reduce" data-row=".side-effect-medicine-row"/>
        <x-forms.magic-search hidden-id="ue_attending_doctor_id" hidden-name="attending_doctor_id"
                              placeholder="Ընտրել բուժող բժիշկին․․․" class="magic-search ajax my-2" data-list-name="users"
                              value="" />
        <strong>Տնօրեն</strong>
        <x-forms.magic-search hidden-id="ue_attending_doctor_id" hidden-name="director"
                              placeholder="Ընտրել բուժող բժիշկին․․․" class="magic-search ajax my-2" data-list-name="users"
                              value="" />
        <em class="error text-danger" data-input="director"></em>
    </li>
    @include('shared.forms.list_group_item_submit', ['btn_text'=>'Ուղարկել'])
    </ul>
    </form>
    </div>
@endsection
@section('javascript')
    <script src="{{ mix('js/jquery.js') }}"></script>
    <script src="{{ mix('js/all.magicsearch.js') }}"></script>


    <script>
        const repeatables = @json($repeatables);
        const servicesUrl = @json(route('catalogs.services_full'));
        $('[id^="service_search"]').magicsearch(
            window.medexMagicSearch.assignConfigs({
                type: "ajax",
                // dataSource: `${servicesUrl}?filterBy=department_id&needle=0`,
                dataSource: `${servicesUrl}`,
                fields: ["code","name"],
                id: "id",
                format: "%code% %name%",
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


    </script>

    <script>
        const usersUrl = @json(route('lists.users_full'));
        $('.user_search').magicsearch(
            window.medexMagicSearch.assignConfigs({
                type: "ajax",
                dataSource: `${usersUrl}?groupByRole=doctor`,
                fields: ["f_name","l_name"],
                id: "id",
                format: "%f_name% %l_name%",
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

    </script>
@endsection
