@extends('layouts.cardBase')

@section('css')
<link rel="stylesheet" href="{{mix('/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href='{{mix("/css/jquery.magicsearch.min.css")}}'>
@endsection

@section('card-header')
@section('card-header-classes', '')

<div class="text-center">
    <h3>ՔԱՂՎԱԾՔ</span></h3>
</div>
@endsection


@section('card-content')

<div class="container">
    <form class="ajax-submitable" action="{{route('samples.patients.extract.update',['patient'=> $patient, $extract->id])}}" method="POST">
        @csrf
        @method('PUT')
        <ul class="list-group">


                    <li class="list-group-item">
                        <strong>Հաստատության անվնաումն ու հասցեն,ուր քաղվածքն ուղարկվում է</strong>
                        <div class="my-2">
                            <x-forms.text-field type="textarea" name="extract_sent" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                            value="{{$extract['extract_sent']}}" label="" />
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row my-2">
                            <div class="col-md-8">
                                <strong>Չարորակ նորագոյացության ախտորոշումը դրվել է կյանքում առաջին անգամ</strong>
                            </div>
                            <div class="col-md-2">
                                <x-forms.checkbox-radio pos="align" id="yes" value="yes" name="for_the_first_time" check="{{$extract['for_the_first_time']=='yes'}}" label="այո"/>
                            </div>
                            <div class="col-md-2">
                                <x-forms.checkbox-radio pos="align" id="no" value="no" name="for_the_first_time" check="{{$extract['for_the_first_time']=='no'}}" label="ոչ"/>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                            <div class="form-row">
                                <div class="col-md-8">
                                    <strong>
                                        Ազգանուն, անուն, հայրանուն
                                    </strong>
                                    <ins class="ml-4">{{$patient->full_name}} {{$patient->p_name}}</ins>
                                </div>
                                <div>
                                    <strong>
                                        Ազգություն
                                    </strong>
                                    <ins class="ml-4">{{$patient->nationality}} </ins>
                                </div>
                            </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row my-2">
                            <div class="col-md-2">
                                <strong>Սեռը</strong>
                            </div>

                            @if($patient->is_male==0)
                                <ins class="ml-4">Իգական</ins>
                            @else
                                <ins class="ml-4">Արական</ins>
                            @endif
                        </div>
                    </li>
                    <li class="list-group-item">
                            <strong>
                                Ծննդյան ամսաթիվ
                            </strong>
                        <ins class="ml-4">{{$patient->birth_date}}</ins>
                    </li>
                    <li class="list-group-item">
                        <div class="form-row">
                            <strong>
                                Աշխատանքի վայրը
                            </strong>
                            <ins class="ml-4">{{$patient->workplace}}</ins>
                        </div>

                    </li>
                    <li class="list-group-item">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <strong>
                                        Մասնագիտություն
                                    </strong>
                                    <ins class="ml-4">{{$patient->profession}}</ins>
                                </div>
                                <div class="col-md-6">
                                    <strong>
                                        Հիվանդի հասցեն
                                    </strong>
                                    <ins class="ml-4">{{$patient->residence_region}} {{$patient->street_house}}<span>

                                </div>
                            </div>
                    </li>
                    <li class="list-group-item">
                            <strong>
                                Ստացիոնար ընդունվելու ամսաթիվ
                            </strong>
                        <ins class="ml-4">
    {{\Illuminate\Support\Carbon::parse($stationaries->admission_date ?? "")->format('Y-m-d')}}

</ins>
                    </li>
                    <li class="list-group-item">
                            <strong>
                                Դուրս գրման կամ մահվան ամսաթիվ
                            </strong>
                            <ins class="ml-4">{{\Illuminate\Support\Carbon::parse($stationaries->discharge_date ?? "")->format('Y-m-d')}}<ins>
                    </li>
            <?php $strat_days= \Illuminate\Support\Carbon::parse($stationaries->admission_date ?? "");
                  $end_days=\Illuminate\Support\Carbon::parse($stationaries->discharge_date ?? "");
                  $Months = $strat_days->diff($end_days);?>

                    <li class="list-group-item">
                            <strong>
                               Ստացիոնարում գտնվելու տևողությունը
                            </strong>
                        @if($strat_days->diffInDays($end_days )>30)
                            <ins class="ml-4">{{$Months->m}} Ամիս {{$Months->d}} օր</ins>

                            @else
                                        <ins class="ml-4">{{$strat_days->diffInDays($end_days )}} օր</ins>

                            @endif
                    </li>
                <li class="list-group-item">
                    <div class="form-row align-items-center">
                        <div class="col-md-4">
                            <strong>Հատուկ բուժում սկսելու ամսաթիվ</strong>
                        </div>
                        <div class="col-md-8">
            <x-forms.text-field name="date" type="date"  validationType="ajax" value="{{$extract['date']}}" label=""/>
                            <em class="error text-danger" data-input="date"></em>
                        </div>
                    </div>
                </li>

                <li class="list-group-item">
                        <div class="form-row">
                            <div class="col-md-6">
                                <strong>
                                    Կլինիկական փուլը
                                </strong>
                                <ins class="ml-4"></ins>
                                @forelse ($ambulator->patient->cancer_groups as $item)

                                        <ins class="ml-4">{{date('d-m-Y', strtotime($item->pivot->created_at))}}</ins>

                                @empty
                                @endforelse
                            </div>
                            <div class="col-md-6">
                                <strong>
                                    Խումբը
                                </strong>
                                @forelse ($ambulator->patient->cancer_groups as $item)
                                    <ins class="ml-4">{{$item->name}}</ins>
                                @empty
                                @endforelse
                            </div>

                        </div>
                </li>
            <?php $period_data = [
                "1" => "Մորֆոլոգիական",
                "2" => "Բջջաբանական",
                "3" => "Ռենտգենաբանական",
                "4" => "Էնդոսկոպիկ",
                "5" => "Ռադիոիզոտոպային մեթոդներով",
                "6" => "Միայն կլինկիորեն",
            ];
            ?>
                <li class="list-group-item">
                    <strong>Ախտորոշումն հաստատված է</strong>


                    <table class="table" border="2">
                        <thead>
                        <tr>
                            <th>Անվանումը</th>
                            <th>ջնջել</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($period as $periods)

                            <tr id="trashPeriodData{{$periods->id}}">
                                <td>{{$period_data[$periods->data] ?? ' '}}</td>
                                <td>
                                    <button class="btn btn-danger btn-sm clickTrash" type="button"
                                            onclick="clickPeriodTrash({{$periods->id}})">
                                        <x-svg icon="cui-trash"/>
                                    </button>
                                </td>
                            </tr>
                        @endforeach


                        </tbody>
                    </table>













                    <x-forms.add-reduce-button type="add" data-row=".side-effect-medicine-row2" data-limit="{{$repeatables}}"/>
                    <x-forms.add-reduce-button type="reduce" data-row=".side-effect-medicine-row2"/>
                    <x-forms.hidden-counter class="treatment-rows" name="side-effect-medicine-row2"/>

                    <div class="">
                    @for ($i = 0; $i < $repeatables; $i++)
                        <div class="container side-effect-medicine-row2 {{$i>0 ? 'd-none' : ''}}">
                            <div class="my-2">
                                <select  name="period_time1_data[]"  class="form-control my-2" validationType="ajax">

                                    <option value="{{null}}" disabled selected>Ընտրել</option>
                                    <option value="1">Մորֆոլոգիական</option>
                                    <option value="2">Բջջաբանական</option>
                                    <option value="3">Ռենտգենաբանական</option>
                                    <option value="4">Էնդոսկոպիկ</option>
                                    <option value="5">Ռադիոիզոտոպային մեթոդներով</option>
                                    <option value="6">Միայն կլինկիորեն</option>

                                </select>
                            </div>
                        </div>
                    @endfor
                </li>
            <li class="list-group-item">
                        <div class="form-row">
                            <strong>
                                Ուռուցքի հյուսվածքաբանական կառուցվածքը
                            </strong>
                        </div>
                            <x-forms.text-field id="" type="textarea" name="tumor_histological_structure" class="form-control my-2" placeholder="լրացման ազատ դաշտ․․․"
                          value="{{$extract['tumor_histological_structure']}}" label=""/>
            </li>
            <li class="list-group-item">
                    <div class="row my-2">
                        <div class="col-md-2">
                            <strong>Բուժումը</strong>
                        </div>
                        <div class="col-md-2">
                            <x-forms.checkbox-radio pos="align" id="" value="radical"  check="{{$extract['treatment_type']=='radical'}}" name="treatment_type" label="Արմատական"/>
                        </div>
                        <div class="col-md-4">
                            <x-forms.checkbox-radio pos="align" id="" value="palliative" check="{{$extract['treatment_type']=='palliative'}}"  name="treatment_type" label="Ամոքիչ (պալիատաիվ)"/>
                        </div>
                    </div>
            </li>
            <li class="list-group-item">
                <strong>
                    Միայն ճառագայթային
                </strong>
                <table class="table" border="2">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Անվանումը</th>
                        <th>Գրառման</th>
                        <th>ջնջել</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($treatment_c as $k=>$treatment_c_1)

                        <tr id="trashData{{$treatment_c_1->id}}">
                            <td>{{$k+1}}</td>
                            <td>{{$treatment_c_1->TreatmentList->name ?? ' '}}</td>

                            <td>{{$treatment_c_1->treatment_comments}}</td>
                            <td>
                                <button class="btn btn-danger btn-sm clickTrash" type="button"
                                        onclick="clickTrash({{$treatment_c_1->id}})">
                                    <x-svg icon="cui-trash"/>
                                </button>
                            </td>
                        </tr>
                    @endforeach


                    </tbody>
                </table>
                <x-forms.add-reduce-button type="add" data-row=".treatment-row" data-limit="{{$repeatables}}"/>
                <x-forms.add-reduce-button type="reduce" data-row=".treatment-row"/>
                <x-forms.hidden-counter class="treatment-rows" name="treatment_length"/>

                @for ($i = 0; $i < $repeatables; $i++)
                    <div class="container treatment-row {{$i>0 ? 'd-none' : ''}}">
                        <div class="my-2">
                            <x-forms.magic-search class="magic-search ajax" value=''
                                                  hidden-id="treatment_id_c{{ $i }}" hidden-name="treatment_c[]"  validationType="ajax" data-catalog-name="treatments"
                                                  placeholder="Ընտրել ախտորոշումը․․․"/>
                        </div>
                        <x-forms.text-field type="textarea" name="treatment_comment_c[]"  validationType="ajax" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                            value="" label="" />

                    </div>
                @endfor
            </li>

            <li class="list-group-item">
                        <div class="form-row">
                            <strong>
                                Դիստանցիոն գամմաթերապիա
                            </strong>
                        </div>
                            <x-forms.text-field id="" type="textarea" name="remote_gammotherapy" class="form-control my-2" placeholder="լրացման ազատ դաշտ․․․"
                          value="{{$extract['remote_gammotherapy']}}" label=""/>
            </li>
            <li class="list-group-item">
                        <div class="form-row">
                            <strong>
                               Ռենտգենոթերապիա
                            </strong>
                        </div>
                            <x-forms.text-field id="" type="textarea" name="rentgenoterapia" class="form-control my-2" placeholder="լրացման ազատ դաշտ․․․"
                          value="{{$extract['rentgenoterapia']}}" label=""/>
            </li>
            <li class="list-group-item">
                        <div class="form-row">
                            <strong>
                                Արագ էլեկտրոններ
                            </strong>
                        </div>
                            <x-forms.text-field id="" type="textarea" name="fast_electrons" class="form-control my-2" placeholder="լրացման ազատ դաշտ․․․"
                          value="{{$extract['fast_electrons']}}" label=""/>
            </li>
            <li class="list-group-item">
                        <div class="form-row">
                            <strong>
                                Համակցված կոնտակտային և դիստանցիոն գամմաթերապիա
                            </strong>
                        </div>
                            <x-forms.text-field id="" type="textarea" name="gammotherapy" class="form-control my-2" placeholder="լրացման ազատ դաշտ․․․"
                          value="{{$extract['gammotherapy']}}" label=""/>
            </li>
            <li class="list-group-item">
                        <div class="form-row">
                            <strong>
                                Կոնտակտային գամմաթերապիա և խորը ռենտգենոթերապիա
                            </strong>
                        </div>
                            <x-forms.text-field id="" type="textarea" name="contact_rentgenoterapia" class="form-control my-2" placeholder="լրացման ազատ դաշտ․․․"
                          value="{{$extract['contact_rentgenoterapia']}}" label=""/>
            </li>
            <?php $period_data_2 = [
                "1" => "վիրահատական և գամմաթերապիա",
                "2" => "վիրահատական և  ռենտգենոթերապիա",
                "3" => "վիրահատական և ճառագայթային",
                "4" => "վիրահատական և դեղորայքային",
                "5" => "ճառագայթային և դեղորայքային մեթոդներով",

            ];
            ?>
            <li class="list-group-item">
                        <div class="md-12">
                            <strong>
                                Զուգակցված բուժում վիրահատության ամսաթիվ և բնույթ,ճառագայթման մեթոդիկա և տեսակը,կիրառման հաջորդականությունը,ճառագայթման դոզան յուրաքանչյուրի համար առանձին
                            </strong>


                            <table class="table" border="2">
                                <thead>
                                <tr>
                                    <th>Անվանումը</th>
                                    <th>Գրառման</th>
                                    <th>ջնջել</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($period2 as $periods2)

                                    <tr id="trashPeriod2Data{{$periods2->id}}">
                                        <td>{{$period_data_2[$periods2->data] ?? ' '}}</td>
                                        <td>{{$periods2->comments}}</td>
                                        <td>
                                            <button class="btn btn-danger btn-sm clickTrash" type="button"
                                                    onclick="clickPeriod2Trash({{$periods2->id}})">
                                                <x-svg icon="cui-trash"/>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach


                                </tbody>
                            </table>





                            <x-forms.add-reduce-button type="add" data-row=".side-effect-medicine-row" data-limit="{{$repeatables}}"/>
                            <x-forms.add-reduce-button type="reduce" data-row=".side-effect-medicine-row"/>
                            <x-forms.hidden-counter class="treatment-rows" name="side-effect-medicine-row"/>
                        </div>
                @for ($i = 0; $i < $repeatables; $i++)
                    <div class="container side-effect-medicine-row {{$i>0 ? 'd-none' : ''}}">
                        <div class="my-2">
                            <select  name="period_time2_data[]"  class="form-control my-2" validationType="ajax">
                                <option value="{{null}}" disabled selected>Ընտրել</option>
                                <option value="1">վիրահատական և գամմաթերապիա</option>
                                <option value="2">վիրահատական և  ռենտգենոթերապիա</option>
                                <option value="3">վիրահատական և ճառագայթային</option>
                                <option value="4">վիրահատական և դեղորայքային</option>
                                <option value="5">ճառագայթային և դեղորայքային</option>

                            </select>
                        </div>
                        <x-forms.text-field type="textarea" name="period_time2_data_comment[]"  validationType="ajax" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                            value="" label="" />

                    </div>
                @endfor

            </li>
            <li class="list-group-item">
                <strong>
                    Միայն քիմիաթերապևտիկ կամ հորմոնային
                </strong>
                <x-forms.text-field id="" type="textarea" name="only_chemotherapeutic_or_hormonal" class="form-control my-2" placeholder="լրացման ազատ դաշտ․․․"
                value="{{$extract['only_chemotherapeutic_or_hormonal']}}" label=""/>
            </li>
            <li class="list-group-item">
                <strong>
                   Համալիր բուժում
                </strong>
                <table class="table" border="2">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Անվանումը</th>
                        <th>Գրառման</th>
                        <th>ջնջել</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($treatment_c2 as $k=>$treatment_c2_1)

                        <tr id="trashData{{$treatment_c2_1->id}}">
                            <td>{{$k+1}}</td>
                            <td>{{$treatment_c2_1->TreatmentList->name ?? ' '}}</td>

                            <td>{{$treatment_c2_1->treatment_comments}}</td>
                            <td>
                                <button class="btn btn-danger btn-sm clickTrash" type="button"
                                        onclick="clickTrash({{$treatment_c2_1->id}})">
                                    <x-svg icon="cui-trash"/>
                                </button>
                            </td>
                        </tr>
                    @endforeach


                    </tbody>
                </table>
                <x-forms.add-reduce-button type="add" data-row=".treatment-row2" data-limit="{{$repeatables}}"/>
                <x-forms.add-reduce-button type="reduce" data-row=".treatment-row2"/>
                <x-forms.hidden-counter class="treatment-rows" name="treatment_length2"/>

                @for ($i = 0; $i < $repeatables; $i++)
                    <div class="container treatment-row2 {{$i>0 ? 'd-none' : ''}}">
                        <div class="my-2">
                            <x-forms.magic-search class="magic-search ajax" value=''
                                                  hidden-id="treatment_id_c2{{ $i }}" hidden-name="treatment_c2[]"  validationType="ajax" data-catalog-name="treatments"
                                                  placeholder="Ընտրել ախտորոշումը․․․"/>
                        </div>
                        <x-forms.text-field type="textarea" name="treatment_comment_c2[]"  validationType="ajax" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                            value="" label="" />

                    </div>
                @endfor
            </li>
                <li class="list-group-item">
                        <div>
                            <strong>Բուժման այլ եղանակներ</strong>
                            <table class="table" border="2">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Անվանումը</th>
                                    <th>Գրառման</th>
                                    <th>ջնջել</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($treatment_c3 as $k=>$treatment_c3_1)

                                    <tr id="trashData{{$treatment_c3_1->id}}">
                                        <td>{{$k+1}}</td>
                                        <td>{{$treatment_c3_1->TreatmentList->name ?? ' '}}</td>

                                        <td>{{$treatment_c3_1->treatment_comments}}</td>
                                        <td>
                                            <button class="btn btn-danger btn-sm clickTrash" type="button"
                                                    onclick="clickTrash({{$treatment_c3_1->id}})">
                                                <x-svg icon="cui-trash"/>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach


                                </tbody>
                            </table>
                            <x-forms.add-reduce-button type="add" data-row=".treatment-row3" data-limit="{{$repeatables}}"/>
                            <x-forms.add-reduce-button type="reduce" data-row=".treatment-row3"/>
                            <x-forms.hidden-counter class="treatment-rows" name="treatment_length3"/>

                            @for ($i = 0; $i < $repeatables; $i++)
                                <div class="container treatment-row3 {{$i>0 ? 'd-none' : ''}}">
                                    <div class="my-2">
                                        <x-forms.magic-search class="magic-search ajax" value=''
                                                              hidden-id="treatment_id_c3{{ $i }}" hidden-name="treatment_c3[]"  validationType="ajax" data-catalog-name="treatments"
                                                              placeholder="Ընտրել ախտորոշումը․․․"/>
                                    </div>
                                    <x-forms.text-field type="textarea" name="treatment_comment_c3[]"  validationType="ajax" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                                        value="" label="" />

                                </div>
                            @endfor
                        </div>

                </li>
                <li class="list-group-item">
                    <div class="form-row align-items-center">
                        <div class="col-md-4">
                            <strong>Ամսաթիվ</strong>
                        </div>
                        <div class="col-md-8">
                            <x-forms.text-field name="admission_date" type="date"  validationType="ajax" value="{{$extract['admission_date']}}" label=""/>
                        </div>
                    </div>
                </li>
            <li class="list-group-item">
                <strong>Բուժող բժիշկ՝</strong>
                <x-forms.magic-search hidden-id="attending_doctor" hidden-name="attending_doctor"
                                      placeholder="Ընտրել բուժող բժիշկին․․․" class="magic-search ajax my-2" data-list-name="users"
                                      value="{{$extract['attending_doctor']}}" />
                <em class="error text-danger" data-input="attending_doctor"></em>

            </li>
            @include('shared.forms.list_group_item_submit', ['btn_text'=>'Ուղարկել'])

                <canvas id="myChart" width="400" height="400"></canvas>



        </ul>
    </form>
</div>
@endsection

@section('javascript')
<script src="{{ mix('js/jquery.js') }}"></script>
<script src="{{ mix('js/all.magicsearch.js') }}"></script>
<script src="https://www.chartjs.org/dist/master/chart.min.js"></script>
<script src="https://www.chartjs.org/samples/master/utils.js"></script>

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

    $('form').on('focus', 'input[type=number]', function (e) {
        $(this).on('wheel.disableScroll', function (e) {
            e.preventDefault()
        })
    })
    $('form').on('blur', 'input[type=number]', function (e) {
        $(this).off('wheel.disableScroll')
    })

    // charts

    });
</script>
<script>
    function clickPeriodTrash(data) {
        let _token = $('meta[name="csrf-token"]').attr('content');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '{{url('samples/trash/extract/period/')}}' + '/' + data,
            type: "get",
            success: function (data) {
                $('#trashPeriodData' + data).remove()
            }
        });
    }
    function clickPeriod2Trash(data) {
        let _token = $('meta[name="csrf-token"]').attr('content');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '{{url('samples/trash/extract/period/')}}' + '/' + data,
            type: "get",
            success: function (data) {
                $('#trashPeriod2Data' + data).remove()
            }
        });
    }
    function clickTrash(data) {
        let _token = $('meta[name="csrf-token"]').attr('content');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '{{url('samples/trash/extract/')}}' + '/' + data,
            type: "get",
            success: function (data) {
                $('#trashData' + data).remove()
            }
        });
    }

</script>


<script src="{{ asset('js/Chart.min.js') }}"></script>
<script src="{{ asset('js/coreui-chartjs.bundle.js') }}"></script>
<script src="{{ asset('js/charts.js') }}"></script>

@endsection
