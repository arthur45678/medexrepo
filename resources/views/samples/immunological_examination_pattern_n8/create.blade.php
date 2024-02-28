@extends('layouts.cardBase')


@section('css')
<link href="{{mix("/css/jquery.magicsearch.min.css")}}" rel="stylesheet" />
@endsection


@section('card-header')
@section('card-header-classes', '')

<div class="text-center">
    <h3>ԻՄՈՒՆԱԲԱՆԱԿԱՆ ԼԱԲՈՐԱՏՈՐԻԱ ԲԺՇԿԱԿԱՆ ՁԵՎ N 8</h3>
</div>
@endsection


@section('card-content')

<div class="container">
    <form  action="{{route('samples.patients.iep-n8.store',$patent->id)}}" method="POST" class="ajax-submitable">
        @csrf
        <ul class="list-group">
            <li class="list-group-item">
                <div class="form-row align-items-center">
                    <div class="col-md-6">
                        <strong>Շճաբանական հետազոտություն №</strong>
                    </div>
                    <ins class="ml-4">{{$research}}</ins>
                    <input type="hidden" name="research" value="{{$research}}">
                </div>
            </li>
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
                        <input type="hidden" name="patient_id" value="{{$patent->id}}">
                        <input type="hidden" name="user_id" value="{{auth()->id()}}">
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
                    <x-forms.magic-search class="magic-search ajax" value='' hidden-id="department_id" validationType="ajax"
                                          hidden-name="department_id" data-catalog-name="departments" placeholder="ընտրել բաժանմունքը․․․" />
                    <em class="error text-danger" data-input="department_id"></em>
                </div>
            </li>
            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="number" name="hospital_room_number" min="0" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                                        value="" label="Պալատ" />
                    @error('hospital_room_number')
                    <em class="error text-danger">Պալատ դաշտը պարտադիր է։</em>
                    @enderror
                </div>
            </li>
            <li class="list-group-item">
                <strong>Ուղեգրող բժիշկ</strong>
                <x-forms.magic-search hidden-id="specialist_id" hidden-name="specialist"
                                      placeholder="Ընտրել բուժող բժիշկին․․․" class="magic-search ajax my-2" data-list-name="users"
                                      value="" />
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
                        <option value="{{$stationaries->id}}" >{{$stationaries->number}}</option>
                    @endforeach
                </select>
            </li>
           <li class="list-group-item list-group-item-info">
                <h4 class="text-center">
                ՀՈՐՄՈՆՆԵՐԻ ՀԵՏԱԶՈՏՈՒԹՅՈՒՆ
                </h4>
            </li>
            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="textarea" name="FSH" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                    value="" label="FSH-ֆոլիկուլ խթանող հորմոն" />
                </div>
            </li>
            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="textarea" name="LH" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                    value="" label="LH-լյուտեինացնող հորմոն" />
                </div>
            </li>
            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="textarea" name="AMH" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                    value="" label="AMH-հակամյուլերային հորմոն" />
                </div>
            </li>
            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="textarea" name="PRL" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                    value="" label="PRL-պրոլակտին" />
                </div>
            </li>
            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="textarea" name="E3" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                    value="" label="E3-էստրիոլ" />
                </div>
            </li>
            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="textarea" name="PROG" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                    value="" label="PROG-պրոգեստերոն" />
                </div>
            </li>
            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="textarea" name="TEST" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                    value="" label="TEST-տեստոստերոն" />
                </div>
            </li>
            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="textarea" name="DHEA" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                    value="" label="DHEA-դիհիդրոէպիանդրոստերոն" />
                </div>
            </li>
            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="textarea" name="DHEA-S" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                    value="" label="DHEA-S դիհիդրոէպիանդրոստերոն սուլֆատ" />
                </div>
            </li>
            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="textarea" name="COR" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                    value="" label="COR-կորտիզոլ" />
                </div>
            </li>
            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="textarea" name="ACTG" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                    value="" label="ACTG-ադրենոկորտիկոտրոպ հորմոն" />
                </div>
            </li>
            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="textarea" name="HGH" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                    value="" label="HGH – մարդու աճի հորմոն" />
                </div>
            </li>
            <li class="list-group-item">
                <div class="form-row align-items-center">
                    <div class="col-md-4">
                        <strong>Հետազոտությունը կատարվել է</strong>
                    </div>
                    <div class="col-md-6">
                        <x-forms.text-field type="text" name="research-was-done" validationType="ajax" placeholder=""
                                            value="" label="" />
                    </div>
                    <div class="col-md-2">
                        <strong>վերլուծիչով</strong>
                    </div>
                </div>
            </li>
            <li class="list-group-item">
                <div class="form-row align-items-center">
                    <div class="col-md-6">
                        <strong>Շճաբանական հետազոտության պատասխանի ամսաթիվ</strong>
                    </div>
                    <div class="col-md-6">
                        <x-forms.text-field name="date_research" validationType="ajax" type="datetime-local"
                                            value="" label="" />
                    </div>
                </div>
            </li>
            <li class="list-group-item">
                <strong>Հետազոտությունը իրականացնող բժիշկ</strong>
                <x-forms.magic-search hidden-id="attending_doctor" hidden-name="attending_doctor"
                                      placeholder="Ընտրել բուժող բժիշկին․․․" class="magic-search ajax my-2" data-list-name="users"
                                      value="" />
                <em class="error text-danger" data-input="attending_doctor_id"></em>
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
