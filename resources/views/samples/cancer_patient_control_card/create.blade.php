@extends('layouts.cardBase')


@section('css')
    <link href="{{mix("/css/jquery.magicsearch.min.css")}}" rel="stylesheet"/>
@endsection


@section('card-header')
@section('card-header-classes', '')

<div class="text-center">
    <h3>Քաղցկեղով հիվանդի հսկիչ քարտ</h3>
</div>
@endsection


@section('card-content')

    <div class="container">
        <form class="ajax-submitable" action="" method="POST">
            @csrf
            <ul class="list-group">

                <li class="list-group-item">
                    <strong>Հայտնաբերման հանգամանքները</strong>
                    <div class="mt-2">
                        <select class="form-control" name="">
                            <option value="1">Ինքն է դիմել</option>
                            <option value="2">Կանխարգելիչ այց</option>
                            <option value="3">սքրինինգ</option>
                            <option value="4">Այլ</option>
                        </select>
                    </div>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="" validationType="ajax"
                                            placeholder="ազատ գրառման դաշտ․․․"
                                            value="" label=""/>
                    </div>
                </li>

                <li class="list-group-item">
                    <div class="form-row align-items-center">
                        <div class="col-12 md-4">
                            <strong>Որտեղ է առաջին անգամ ախտորոշվել</strong>
                        </div>
                        <div class="col-12 my-2">
                            <x-forms.magic-search class="magic-search ajax" value='' hidden-id="clinics_id"
                                                  validationType="ajax"
                                                  hidden-name="clinics_id" data-catalog-name="clinics"
                                                  placeholder="նշել բժշկական հաստատությունը․․․"/>
                            <em class="error text-danger" data-input="clinics_id"></em>
                        </div>
                    </div>
                </li>

                <li class="list-group-item">
                    <div class="form-row align-items-center">
                        <div class="col-md-6">
                            <strong>Երբ է առաջին անգամ ախտորոշվել</strong>
                        </div>
                        <div class="col-md-6">
                            <x-forms.text-field name="research_date" label="" type="date" validationType="ajax"/>
                        </div>
                    </div>
                </li>

                <li class="list-group-item">
                    <div class="row">
                        <div class="col-md-4">
                            <strong>Առաջնակի բազմակի ուռուցքներ</strong>
                        </div>
                        <div class="col-md-8">
                            <x-forms.checkbox-radio pos="align" id="radio1" value="Ոյո" name="first" label="Այո"/>
                            <x-forms.checkbox-radio pos="align" id="radio2" value="Ոչ" name="first" label="Ոչ"/>
                        </div>
                    </div>
                </li>

                <li class="list-group-item">
                    <div class="row">
                        <div class="col-md-4">
                            <strong>Ուռուցքի տեսանելի տեղեկայում</strong>
                        </div>
                        <div class="col-md-8">
                            <x-forms.checkbox-radio pos="align" id="radio1" value="Ոյո" name="second" label="Այո"/>
                            <x-forms.checkbox-radio pos="align" id="radio2" value="Ոչ" name="second" label="Ոչ"/>
                        </div>
                    </div>
                </li>

                <li class="list-group-item">
                    <strong>Բարդություն</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="" validationType="ajax"
                                            placeholder="ազատ գրառման դաշտ․․․"
                                            value="" label=""/>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="form-row">
                        <div class="col-md-12">
                            <strong> Դիմելու նպատակը</strong>
                            <select class="form-control" name="T">
                                @foreach($applicationPurposeList as $applicationPurposeLists)
                                    <option value="{{$applicationPurposeLists->id}}">{{$applicationPurposeLists->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </li>
                <li class="list-group-item list-group-item-info">
                    <h4 class="text-center">
                        Հյուսվածքաբանական տեսակը
                    </h4>
                </li>

                <li class="list-group-item">
                    <strong>Կլինիկական խումբ</strong>
                    <div class="col-md-12 mt-2">
                        <select class="form-control" name="">
                            <option value="1">I</option>
                            <option value="2">II</option>
                            <option value="3">III</option>
                            <option value="4">IV</option>
                        </select>
                    </div>
                </li>

                <li class="list-group-item">
                    <strong>Հյուսվածքաբանական տեսակը</strong>
                    <div class="col-md-4 mt-2">
                        <select class="form-control" name="">
                            @foreach($histologicalLists as $histologicalList)
                            <option value="{{$histologicalList->id}}">{{$histologicalList->name}}</option>
                            @endforeach

                        </select>
                    </div>
                </li>

                <li class="list-group-item">
                    <strong>Գործնթացի փուլը TNM</strong>
                    <div class="form-row mt-2 px-3">
                        <div class="col-md-4">
                            <strong>T<em> - (0,1,2,3,4)</em></strong>
                            <select class="form-control" name="T">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <strong>N<em> - (0,1,2,3,x)</em></strong>
                            <select class="form-control" name="N">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="x">x</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <strong>M<em> - (0,1,x)</em></strong>
                            <select class="form-control" name="M">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="x">x</option>
                            </select>
                        </div>
                    </div>
                </li>
                <li class="list-group-item">


                    <div class="form-row">
                        <div class="col-md-12">
                            <strong> Ընթացիկ փուլը</strong>
                            <select class="form-control" name="T">
                                @foreach($currentStageLists as $currentStageList)
                                <option value="{{$currentStageList->id}}">{{$currentStageList->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </li>
                <li class="list-group-item">


                    <div class="form-row">
                        <div class="col-md-12">
                            <strong> Մետասթազ</strong>
                            <select class="form-control" name="T">
                                @foreach($metastasisList as $metastasisLists)
                                <option value="{{$metastasisLists->id}}">{{$metastasisLists->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </li>



                <li class="list-group-item">
                    <strong>Ռիսկի գործոններ</strong>
                    <div class="my-2">
                        <textarea name="" class="form-control" placeholder="ազատ գրառման դաշտ․․․"></textarea>
                    </div>
                </li>

                <li class="list-group-item">
                    <strong>Հաշվառման վերցնելու տարբերակները</strong>
                    <div class="form-row mt-2 px-1">
                        <div class="col-md-4">
                            <select class="form-control" name="">
                                <option value="0">Առաջին անգամ</option>
                                <option value="1">Նախկինում ախտորոշված</option>
                                <option value="2">Հետմահու հաստատված</option>
                                <option value="3">Մահից առաջ հաստատված</option>
                            </select>
                        </div>
                    </div>
                </li>

                <li class="list-group-item">
                    <strong>Հայտնաբերման հանգամանքները</strong>
                    <div class="form-row mt-2 px-1">
                        <div class="mt-2">
                            <select class="form-control" name="">
                                <option value="1">Ինքն է դիմել</option>
                                <option value="2">Կանխարգելիչ այց</option>
                                <option value="3">սքրինինգ</option>
                                <option value="4">Այլ</option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="" validationType="ajax"
                            placeholder="ազատ գրառման դաշտ․․․" value="" label=""/>
                    </div>
                </li>

                <li class="list-group-item">
                    <strong>ՀԵտազոտություն</strong>
                    <div class="mt-2">
                        <select class="form-control" name="">
                           @foreach($researchesLists as $researchesList)
                            <option value="{{$researchesList->id}}">{{$researchesList->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="" validationType="ajax"
                                            placeholder="լրացման ազատ դաշտ․․․"
                                            value="" label=""/>
                    </div>
                </li>

                <li class="list-group-item">
                    <strong>Ավելացնել</strong>
                    <x-forms.add-reduce-button type="add" data-row=".first-diagnosis-row_a" data-limit="{{$repeatables}}"/>
                    <x-forms.add-reduce-button type="reduce" data-row=".first-diagnosis-row_a"/>
                    <x-forms.hidden-counter class="first-diagnosis-rows" name="first_diagnosis_length_a"/>

                    @for ($i = 0; $i < $repeatables; $i++)
                   <div class="container first-diagnosis-row_a {{$i>0 ? 'd-none' : ''}}">
                       <strong>Բուժում N {{$i}}</strong>
                            <div class="my-2">
                    <div class="my-2">
                        <x-forms.magic-search class="magic-search ajax" value='' hidden-id="treatments_id"
                                              validationType="ajax"
                                              hidden-name="treatments_id" data-catalog-name="treatments"
                                              placeholder="ընտրել բուժումը․․․"/>
                        <em class="error text-danger" data-input="department_id"></em>
                    </div>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="" validationType="ajax"
                                            placeholder="ազատ գրառման դաշտ․․․․․․"
                                            value="" label=""/>
                    </div>


                    <div class=" mt-2">
                        <x-forms.text-field name="date" type="date" value="" validationType="ajax" label=""/>
                        <em class="error text-danger" data-input="date"></em>
                    </div>
                    <strong>Վիրահատությունների ցանկ</strong>
                                <div class="my-2">
                        <x-forms.magic-search class="magic-search ajax" value='' hidden-id="surgery_id"
                                              hidden-name="surgery_id" data-catalog-name="surgeries"  validationType="ajax" placeholder="ընտրել վիրահատությունը․․․" />
                    </div>
                    <x-forms.text-field type="textarea" name="surgeries_comment" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                        value="" label="" />
                            </div>
                   </div>
                    @endfor
                </li>

                <li class="list-group-item">
                    <div class="row">
                        <div class="col-md-4">
                            <strong>Բուժումը իրականացվել է</strong>
                        </div>
                        <div class="col-md-8">
                            <x-forms.checkbox-radio pos="align" id="radio1" value="Ամբուլատոր ստացիոնար"
                                name="stationary_type" label="Ամբուլատոր ստացիոնար"/>
                            <x-forms.checkbox-radio pos="align" id="radio2" value="Ցերեկային ստացիոնար"
                                name="stationary_type" label="Ցերեկային ստացիոնար"/>
                        </div>
                    </div>
                </li>

                <li class="list-group-item">
                    <strong>Ելք</strong>
                    <div class="form-row mt-2 px-1">
                        <div class="">
                            <select class="form-control" name="">
                                @foreach($exitLists as $exitList)
                                    <option value="{{$exitList->id}}">{{$exitList->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mt-2">
                        <x-forms.text-field name="date" type="date" value="" validationType="ajax" label=""/>
                        <em class="error text-danger" data-input="date"></em>
                    </div>

                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="" validationType="ajax"
                                            placeholder="ազատ գրառման դաշտ․․․․․․"
                                            value="" label=""/>
                    </div>
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
        const usersUrl = @json(route('lists.users_full'));
        $('.user_search').magicsearch(
            window.medexMagicSearch.assignConfigs({
                type: "ajax",
                dataSource: `${usersUrl}?groupByRole=doctor`,
                fields: ["f_name", "l_name"],
                id: "id",
                format: "%f_name% %l_name%",
                success: function ($input, data) {
                    console.log(data)
                    const hidden_input_id = $input.data('hidden');
                    $(hidden_input_id).val($input.attr("data-id"));
                },
                afterDelete: function ($input, data) {
                    const hidden_input_id = $input.data("hidden");
                    $(hidden_input_id).val("");
                }
            })
        );

    </script>

@endsection
