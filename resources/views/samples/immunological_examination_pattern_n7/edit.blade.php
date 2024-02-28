@extends('layouts.cardBase')


@section('css')
<link href="{{mix("/css/jquery.magicsearch.min.css")}}" rel="stylesheet" />
@endsection


@section('card-header')
@section('card-header-classes', '')

<div class="text-center">
    <h3>ԻՄՈՒՆԱԲԱՆԱԿԱՆ ԼԱԲՈՐԱՏՈՐԻԱ ԲԺՇԿԱԿԱՆ ՁԵՎ N 7</h3>
</div>
@endsection


@section('card-content')

<div class="container">
    <form  action="{{route('samples.patients.iep-n7.update',[$immunologia->id,$patent->id])}}" method="POST" class="ajax-submitable">
        @csrf
        @method('put')
        <ul class="list-group">
            <li class="list-group-item">
                <div class="form-row align-items-center">
                    <div class="col-md-6">
                        <strong>ԻՄՈՒՆԱԲԱՆԱԿԱՆ  հետազոտություն № </strong>
                    </div>
                    <ins class="ml-4">{{$immunologia->research}}</ins>
                </div>
            </li>
            <li class="list-group-item">
                <div class="form-row align-items-center">
                    <div class="col-md-4">
                        <strong>Կենսանյութը վերցնելու ամսաթիվ</strong>
                    </div>
                    <div class="col-md-8">
                        <x-forms.text-field name="date" validation-type="ajax" type="datetime-local"
                                            value="{{\Illuminate\Support\Carbon::parse($immunologia->date)->format('Y-m-d\TH:i')}}" label="" />
                        @error('date')
                        <em class="error text-danger">Կենսանյութը վերցնելու ամսաթիվ դաշտը պարտադիր է։</em>
                        @enderror
                    </div>
                </div>
            </li>
            <li class="list-group-item ">
                <div class="form-row">
                    <div class="col-md-6">
                        <input type="hidden" name="patient_id" value="{{$patent->id}}">
                        <input type="hidden" name="user_id" value="{{auth()->id()}}">
                        <input type="hidden" name="immunologia" value="{{$immunologia->id}}">
                        <strong>
                            Ազգանուն, անուն, հայրանուն
                        </strong>
                        <ins class="ml-4">{{$patent->full_name}}</ins>

                    </div>
                    <div class="col-md-6">
                        <strong>
                            Տարիք
                        </strong>

                        <ins class="ml-4">{{$patent->birth_date}}</ins>
                    </div>
                </div>
            </li>
            <li class="list-group-item">
                <strong>Բաժանմունք՝</strong>
                <div class="my-2">
                    <x-forms.magic-search class="magic-search ajax" value='{{$immunologia->department_id}}' hidden-id="department_id" validationType="ajax"
                                          hidden-name="department_id" data-catalog-name="departments" placeholder="ընտրել բաժանմունքը․․․" />
                    <em class="error text-danger" data-input="department_id"></em>
                </div>
            </li>
            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="number" name="hospital_room_number" min="0" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                                        value="{{$immunologia->hospital_room_number}}" label="Պալատ" />
                    @error('hospital_room_number')
                    <em class="error text-danger">Պալատ դաշտը պարտադիր է։</em>
                    @enderror
                </div>
            </li>
            <li class="list-group-item">
                <strong>Ուղեգրող բժիշկ</strong>
                <x-forms.magic-search hidden-id="specialist_id" hidden-name="specialist"
                                      placeholder="Ընտրել բուժող բժիշկին․․․" class="magic-search ajax my-2" data-list-name="users"
                                      value="{{$immunologia->specialist}}" validationType="ajax" />
                <em class="error text-danger" data-input="specialist"></em>

            </li>
            <li class="list-group-item">
                <strong>Ամբուլատոր բժշկական քարտի № {{$amboulator->number ?? ' '}}</strong>
                <input type="hidden" name="ambulator_id" value="{{$amboulator->id ?? ''}}">

            </li>
            <li class="list-group-item">
                <strong>Հիվանդության պատմագրի № </strong>
                <select name="stationary_id" id="">
                    @foreach($stationarie as $stationaries)
                        @if($stationaries->id==$immunologia->stationary_id)
                            <option value="{{$stationaries->id}}" selected>{{$stationaries->number}}</option>
                        @else
                            <option value="{{$stationaries->id}}" >{{$stationaries->number}}</option>
                        @endif

                    @endforeach
                </select>
            </li>
            <li class="list-group-item list-group-item-info">
                <h4 class="text-center">
                    ՇՃԱԲԱՆԱԿԱՆ ՀԵՏԱԶՈՏՈՒԹՅՈՒՆ
                </h4>
            </li>
            <li class="list-group-item">
                <div class="form-row align-items-center">
                    <div class="col-md-3">
                        <strong>AFP / ալֆա ֆետոպրոտեին/</strong>
                    </div>
                    <div class="col-md-6">
                        <x-forms.text-field type="text" name="AFP" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                                            value="{{$immunologia['AFP']}}" label="" />
                    </div>
                    <div class="col-md-3">
                        <strong>- N – մինչև 10 ՄՄ/մլ</strong>
                    </div>
                </div>
            </li>
            <li class="list-group-item">
                <div class="form-row align-items-center">
                    <div class="col-md-5">
                        <strong>TPSA /ընդ.պրոստատ սպեցիֆիկ հակածին</strong>
                    </div>
                    <div class="col-md-5">
                        <x-forms.text-field type="text" name="TPSA" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                                            value="{{$immunologia['TPSA']}}" label="" />
                    </div>
                    <div class="col-md-2">
                        <strong>2,4-4,0նգ/մլ</strong>
                    </div>
                </div>
            </li>
            <li class="list-group-item">
                <div class="form-row align-items-center">
                    <div class="col-md-5">
                        <strong>FPSA / ազատ պրոստատ սպեցիֆիկ հակածին/</strong>
                    </div>
                    <div class="col-md-5">
                        <x-forms.text-field type="text" name="FPSA" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                                            value="{{$immunologia['FPSA']}}" label="" />
                    </div>
                    <div class="col-md-2">
                        <strong>15% TPSA-ից</strong>
                    </div>
                </div>
            </li>
            <li class="list-group-item">
                <div class="form-row align-items-center">
                    <div class="col-md-5">
                        <strong>CEA / կարցինոէմբրիոնալ հակածին/</strong>
                    </div>
                    <div class="col-md-5">
                        <x-forms.text-field type="text" name="CEA" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                                            value="{{$immunologia['CEA']}}" label="" />
                    </div>
                    <div class="col-md-2">
                        <strong>0-5, 0նգ/մլ</strong>
                    </div>
                </div>
            </li>
            <li class="list-group-item">
                <div class="form-row align-items-center">
                    <div class="col-md-5">
                        <strong>CA19-9 / կարբոհիդրատ հակածին 19-9/</strong>
                    </div>
                    <div class="col-md-5">
                        <x-forms.text-field type="text" name="CA19" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                                            value="{{$immunologia['CA19']}}" label="" />
                    </div>
                    <div class="col-md-2">
                        <strong>մինչև 37 ՄՄ/մլ</strong>
                    </div>
                </div>
            </li>
            <li class="list-group-item">
                <div class="form-row align-items-center">
                    <div class="col-md-5">
                        <strong>CA15-3 / ուռուցքային հակածին 15-3/</strong>
                    </div>
                    <div class="col-md-5">
                        <x-forms.text-field type="text" name="CA15" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                                            value="{{$immunologia['CA15']}}" label="" />
                    </div>
                    <div class="col-md-2">
                        <strong>մինչև 27 ՄՄ/մլ</strong>
                    </div>
                </div>
            </li>
            <li class="list-group-item">
                <div class="form-row align-items-center">
                    <div class="col-md-5">
                        <strong>CA125 / ուռուցքային հակածին 125/</strong>
                    </div>
                    <div class="col-md-5">
                        <x-forms.text-field type="text" name="CA125" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                                            value="{{$immunologia['CA125']}}" label="" />
                    </div>
                    <div class="col-md-2">
                        <strong>մինչև 35 ՄՄ/մլլ</strong>
                    </div>
                </div>
            </li>
            <li class="list-group-item">
                <div class="form-row align-items-center">
                    <div class="col-md-5">
                        <strong>CA 72-4 / կարբոհիդրատ հակածին 72-4/</strong>
                    </div>
                    <div class="col-md-5">
                        <x-forms.text-field type="text" name="CA72" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                                            value="{{$immunologia['CA72']}}" label="" />
                    </div>
                    <div class="col-md-2">
                        <strong>0-4,0 ՄՄ/մլ</strong>
                    </div>
                </div>
            </li>
            <li class="list-group-item">
                <div class="form-row align-items-center">
                    <div class="col-md-5">
                        <strong>NSE / նեյրոսպեցիֆիկ էնոլազա/</strong>
                    </div>
                    <div class="col-md-5">
                        <x-forms.text-field type="text" name="NSE" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                                            value="{{$immunologia['NSE']}}" label="" />
                    </div>
                    <div class="col-md-2">
                        <strong>մինչև 13,2 ՄՄ/մլ</strong>
                    </div>
                </div>
            </li>
            <li class="list-group-item">
                <div class="form-row align-items-center">
                    <div class="col-md-5">
                        <strong>Cyfra 21-2 / ցիտոկերատինի մասնիկ 21-2/</strong>
                    </div>
                    <div class="col-md-5">
                        <x-forms.text-field type="text" name="Cyfra" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                                            value="{{$immunologia['Cyfra']}}" label="" />
                    </div>
                    <div class="col-md-2">
                        <strong>մինչև 3,3 ՄՄ/մլ</strong>
                    </div>
                </div>
            </li>
            <li class="list-group-item">
                <div class="form-row align-items-center">
                    <div class="col-md-5">
                        <strong>b-hCG / բետա խորիոնիկ հոնադոթրոպին/</strong>
                    </div>
                    <div class="col-md-5">
                        <x-forms.text-field type="text" name="b-hCG" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                                            value="{{$immunologia['b-hCG']}}" label="" />
                    </div>
                    <div class="col-md-2">
                        <strong>մինչև 5,0 ՄՄդ/լ</strong>
                    </div>
                </div>
            </li>
            <li class="list-group-item">
                <div class="form-row align-items-center">
                    <div class="col-md-5">
                        <strong>SCC / տափակբջջային ուռուցքային հակածին/</strong>
                    </div>
                    <div class="col-md-5">
                        <x-forms.text-field type="text" name="SCC" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                                            value="{{$immunologia['SCC']}}" label="" />
                    </div>
                    <div class="col-md-2">
                        <strong>մինչև 2,0 նգ/մլ</strong>
                    </div>
                </div>
            </li>
            <li class="list-group-item">
                <div class="form-row align-items-center">
                    <div class="col-md-5">
                        <strong>b-2MG / բետա -2միկրոգլոբուլին/</strong>
                    </div>
                    <div class="col-md-5">
                        <x-forms.text-field type="text" name="b-2MG" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                                            value="{{$immunologia['b-2MG']}}" label="" />
                    </div>
                    <div class="col-md-2">
                        <strong>660-2740 նգ/մլ</strong>
                    </div>
                </div>
            </li>
            <li class="list-group-item">
                <div class="form-row align-items-center">
                    <div class="col-md-4">
                        <strong>Հետազոտությունը կատարվել է</strong>
                    </div>
                    <div class="col-md-6">
                        <x-forms.text-field type="text" name="research-was-done" validationType="ajax" placeholder=""
                                            value="{{$immunologia['research-was-done']}}" label="" />
                    </div>
                    <div class="col-md-2">
                        <strong>վերլուծիչով</strong>
                    </div>
                </div>
            </li>
            <li class="list-group-item">
                <div class="form-row align-items-center">
                    <div class="col-md-6">
                        <strong>ԻՄՈՒՆԱԲԱՆԱԿԱՆ  հետազոտության պատասխանի ամսաթիվ</strong>
                    </div>
                    <div class="col-md-6">
                        <x-forms.text-field name="date_research" validation-type="ajax" type="datetime-local"
                                            value="{{\Illuminate\Support\Carbon::parse($immunologia->date_research)->format('Y-m-d\TH:i')}}" label="" />
                    </div>
                </div>
            </li>
            <li class="list-group-item">
                <strong>Հետազոտությունը իրականացնող բժիշկ</strong>
                <x-forms.magic-search hidden-id="sender_doctor_id" hidden-name="attending_doctor"
                                      placeholder="Ընտրել բուժող բժիշկին․․․" class="magic-search ajax my-2" data-list-name="users"
                                      value="{{$immunologia->attending_doctor}}" />
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
