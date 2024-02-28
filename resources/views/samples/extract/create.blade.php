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
    <form class="ajax-submitable" action="{{route('samples.patients.extract.store',$patient->id)}}" method="POST">
        @csrf
        <ul class="list-group">
            <input type="hidden" value="{{$patient->id}}" name="patient_id">
            <input type="hidden" value="{{auth()->id()}}" name="user_id">
            <input type="hidden" value="{{auth()->user()->department->id}}" name="department_id">
            <input type="hidden" value="{{$ambulator->id}}" name="ambulator_id">
            <input type="hidden" value="{{$stationaries->id}}" name="stationary_id">

                    <li class="list-group-item">
                        <strong>Հաստատության անվնաումն ու հասցեն,ուր քաղվածքն ուղարկվում է</strong>
                        <div class="my-2">
                            <x-forms.text-field type="textarea" name="extract_sent" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                            value="" label="" />
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row my-2">
                            <div class="col-md-8">
                                <strong>Չարորակ նորագոյացության ախտորոշումը դրվել է կյանքում առաջին անգամ</strong>
                            </div>
                            <div class="col-md-2">
                                <x-forms.checkbox-radio pos="align" id="yes" value="yes" name="for_the_first_time" label="այո"/>
                            </div>
                            <div class="col-md-2">
                                <x-forms.checkbox-radio pos="align" id="no" value="no" name="for_the_first_time" label="ոչ"/>
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
                            <ins class="ml-4">{{$Months->m}} Ամիս {{$Months->d}} օր<ins>

                            @else
                                        <ins class="ml-4">{{$strat_days->diffInDays($end_days )}} օր<ins>

                            @endif
                    </li>
                <li class="list-group-item">
                    <div class="form-row align-items-center">
                        <div class="col-md-4">
                            <strong>Հատուկ բուժում սկսելու ամսաթիվ</strong>
                        </div>
                        <div class="col-md-8">
            <x-forms.text-field name="date" type="date"  validationType="ajax" value="" label=""/>
                            <em class="error text-danger" data-input="date"></em>
                        </div>
                    </div>
                </li>
{{--                    <li class="list-group-item">--}}
{{--                            <strong>--}}
{{--                                Վերջնական ախտորոշումը--}}
{{--                            </strong>--}}
{{--                            <ins class="ml-4">--}}
{{--                                @forelse ($stationaries->stationary_diagnoses->where("diagnosis_type",--}}
{{--        \App\Enums\StationaryDiagnosisEnum::final_clinical()) as $item)--}}

{{--                                    @if( ($status = $item->approvementStatusBoolean()) !== null)--}}
{{--                                        <div class="{{$status ?: 'waiting-for-approvement'}}">--}}
{{--                                            {{$item->disease_item->code_name ?? ""}}  <br>--}}
{{--                                            {{$item->diagnosis_comment ?? ""}} <br><br>--}}
{{--                                            <span class="print-hide">{{$item->approvementStatus()}}</span>--}}
{{--                                        </div>--}}
{{--                                    @else--}}
{{--                                        {{$item->disease_item->code_name ?? ""}}  <br>--}}
{{--                                        {{$item->diagnosis_comment ?? ""}} <br><br>--}}
{{--                                    @endif--}}

{{--                                @empty--}}

{{--                                @endforelse</ins>--}}
{{--                    </li>--}}
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
                <li class="list-group-item">
                    <strong>Ախտորոշումն հաստատված է</strong>
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
                          value="" label=""/>
            </li>
            <li class="list-group-item">
                    <div class="row my-2">
                        <div class="col-md-2">
                            <strong>Բուժումը</strong>
                        </div>
                        <div class="col-md-2">
                            <x-forms.checkbox-radio pos="align" id="" value="radical" name="treatment_type" label="Արմատական"/>
                        </div>
                        <div class="col-md-4">
                            <x-forms.checkbox-radio pos="align" id="" value="palliative" name="treatment_type" label="Ամոքիչ (պալիատաիվ)"/>
                        </div>
                    </div>
            </li>
{{--            <li class="list-group-item">--}}
{{--                <strong>--}}
{{--                    Միայն վիրահատական--}}
{{--                </strong>--}}
{{--                <table class="text-center surgery">--}}
{{--                    <tr>--}}
{{--                        <td>#</td>--}}
{{--                        <td>Վիրահատության <br> անվանումը</td>--}}
{{--                        <td>Ամսաթիվ,<br> ժամ</td>--}}
{{--                        <td>Անզգայացման<br> եղանակը</td>--}}
{{--                        <td>Բարդություններ</td>--}}
{{--                    </tr>--}}
{{--                    @forelse($stationaries->stationary_surgeries->where('type', \App\Enums\StationarySurgeryEnum::stationary()) as $item)--}}
{{--                        <tr>--}}
{{--                            <td>{{$item->stationary_id ?? ""}}</td>--}}
{{--                            <td>{{$item->surgery->name ?? ""}}</td>--}}
{{--                            <td>{{$item->surgery_date ?? ""}}</td>--}}
{{--                            <td>{{$item->anesthesia->name ?? ""}}</td>--}}
{{--                            <td>{{$item->complications ?? ""}}</td>--}}
{{--                        </tr>--}}
{{--                    @empty--}}

{{--                    @endforelse--}}
{{--                    <tr>--}}
{{--                        <td></td>--}}
{{--                        <td></td>--}}
{{--                        <td></td>--}}
{{--                        <td></td>--}}
{{--                        <td></td>--}}
{{--                    </tr>--}}
{{--                </table>--}}
{{--                <ins class="ml-4"></ins>--}}
{{--            </li>--}}
            <li class="list-group-item">
                <strong>
                    Միայն ճառագայթային
                </strong>

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
                          value="" label=""/>
            </li>
            <li class="list-group-item">
                        <div class="form-row">
                            <strong>
                               Ռենտգենոթերապիա
                            </strong>
                        </div>
                            <x-forms.text-field id="" type="textarea" name="rentgenoterapia" class="form-control my-2" placeholder="լրացման ազատ դաշտ․․․"
                          value="" label=""/>
            </li>
            <li class="list-group-item">
                        <div class="form-row">
                            <strong>
                                Արագ էլեկտրոններ
                            </strong>
                        </div>
                            <x-forms.text-field id="" type="textarea" name="fast_electrons" class="form-control my-2" placeholder="լրացման ազատ դաշտ․․․"
                          value="" label=""/>
            </li>
            <li class="list-group-item">
                        <div class="form-row">
                            <strong>
                                Համակցված կոնտակտային և դիստանցիոն գամմաթերապիա
                            </strong>
                        </div>
                            <x-forms.text-field id="" type="textarea" name="gammotherapy" class="form-control my-2" placeholder="լրացման ազատ դաշտ․․․"
                          value="" label=""/>
            </li>
            <li class="list-group-item">
                        <div class="form-row">
                            <strong>
                                Կոնտակտային գամմաթերապիա և խորը ռենտգենոթերապիա
                            </strong>
                        </div>
                            <x-forms.text-field id="" type="textarea" name="contact_rentgenoterapia" class="form-control my-2" placeholder="լրացման ազատ դաշտ․․․"
                          value="" label=""/>
            </li>
            <li class="list-group-item">
                        <div class="md-12">
                            <strong>
                                Զուգակցված բուժում վիրահատության ամսաթիվ և բնույթ,ճառագայթման մեթոդիկա և տեսակը,կիրառման հաջորդականությունը,ճառագայթման դոզան յուրաքանչյուրի համար առանձին
                            </strong>
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
                value="" label=""/>
            </li>
            <li class="list-group-item">
                <strong>
                   Համալիր բուժում
                </strong>
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
                            <x-forms.text-field name="admission_date" type="date"  validationType="ajax" value="" label=""/>
                        </div>
                    </div>
                </li>
            <li class="list-group-item">
                <strong>Բուժող բժիշկ՝</strong>
                <x-forms.magic-search hidden-id="attending_doctor" hidden-name="attending_doctor"
                                      placeholder="Ընտրել բուժող բժիշկին․․․" class="magic-search ajax my-2" data-list-name="users"
                                      value="" />
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


<script src="{{ asset('js/Chart.min.js') }}"></script>
<script src="{{ asset('js/coreui-chartjs.bundle.js') }}"></script>
<script src="{{ asset('js/charts.js') }}"></script>

@endsection
