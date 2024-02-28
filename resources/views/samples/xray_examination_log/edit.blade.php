@extends('layouts.cardBase')


@section('css')
<link href="{{mix("/css/jquery.magicsearch.min.css")}}" rel="stylesheet" />
@endsection


@section('card-header')
@section('card-header-classes', '')

<div class="text-center">
    <h3>Ռենտգեն հետազոտությունների հաշվառման մատյան</span></h3>
</div>
@endsection


@section('card-content')

<div class="container">
    <form class="ajax-submitable" action="{{route('samples.patients.xray-examination-log.update', ['patient'=> $patient, $xray->id])}}" method="POST">
        @csrf
        @method('put')
        <ul class="list-group">

            <li class="list-group-item">
                <div class="form-row align-items-center">
                    <div class="col-md-6">
                        <strong>Ամսաթիվ</strong>
                    </div>
                    <div class="col-md-6">
                        <x-forms.text-field name="reg_date" label="" type="date" value="{{$xray->reg_date}}" validationType="ajax" />
                    </div>
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="textarea"  name="research" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="{{$xray->research}}" label="Հետազոտություն" />
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="textarea"  name="organ" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="{{$xray->organ}}" label="Օրգան" />
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="textarea"  name="type" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="{{$xray->type}}" label="Տեսակ" />
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="textarea"  name="sum" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="{{$xray->sum}}" label="Գումար" />
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="textarea"  name="material" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="{{$xray->material}}" label="Նյութ" />
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="textarea"  name="baso" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="{{$xray->baso}}" label="BoSO4" />
                </div>
            </li>

            <li class="list-group-item">
                <strong>Հետազոտությունը իրականացնող բժիշկ</strong>
                <x-forms.magic-search hidden-id="examining_doctor_id" hidden-name="examining_doctor_id"
                placeholder="Ընտրել բուժող բժիշկին․․․" class="my-2 user_search" value="{{$xray->examining_doctor_id}}"/>
                <em class="error text-danger" data-input="examining_doctor_id"></em>
            </li>
            
            <li class="list-group-item">
                <strong>Բուժող բժիշկ</strong>
                <x-forms.magic-search hidden-id="attending_doctor_id" hidden-name="attending_doctor_id"
                placeholder="Ընտրել բուժող բժիշկին․․․" class="my-2 user_search" value="{{$xray->attending_doctor_id}}"/>
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