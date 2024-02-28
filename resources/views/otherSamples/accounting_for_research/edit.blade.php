@extends('layouts.cardBase')



@section('card-header')
@section('card-header-classes', '')

<div class="text-center">
    <h3>ԿԱՏԱՐՎԱԾ ՀԵՏԱԶՈՏՈՒԹՅՈՒՆՆԵՐԻ ՀԱՇՎԱՌՈՒՄ</span></h3>
</div>
@endsection


@section('card-content')

<div class="container">
    <form class="ajax-submitable" action="{{route('otherSamples.accounting-for-research.update',$accounting->id)}}" method="POST">
        @csrf
        @method('put')
        <ul class="list-group">
                <li class="list-group-item">
                    <div class="form-row align-items-center">
                        <div class="col-md-4">
                            <strong>Ամսաթիվ</strong>
                        </div>
                        <div class="col-md-8">
                            <x-forms.text-field name="date" type="date"  validationType="ajax" value="{{$accounting->date}}" label=""/>
                        </div>
                    </div>
                </li>

                <li class="list-group-item">
                    <strong>Բժիշկ</strong>
                    <x-forms.magic-search hidden-id="attending_doctor_id" hidden-name="attending_doctor_id"
                    placeholder="Ընտրել բուժող բժիշկին․․․" class="my-2 user_search" value="{{$accounting->attending_doctor_id}}"/>
                    <em class="error text-danger" data-input="attending_doctor_id"></em>
                </li>

                @php

                    $action_array = ['Ռենտգեն','КТ','Ստամ.','Թոք','Սոնո','Դուպլեքս','Մամո'];

                @endphp
                <li class="list-group-item">
                    <h5>Գործողությունը` </h5>
                    <select name="action" id="" class="form-control my-2" validationType="ajax">
                    @foreach($action_array as $key => $item)
                        <option {{$accounting->action == ($key+1) ? 'selected' : '' }} value="{{$key+1}}">{{$item}}</option>
                    @endforeach
                    </select>

                </li>

                <li class="list-group-item list-group-item-info">
                    <h4 class="text-center">
                        ՍՏԱՑԻՈՆԱՐ
                    </h4>
                </li>
                <li class="list-group-item">
                    <div class="form-row align-items-center">
                        <div class="col-md-6 my-2">
                            <strong>Պ/Պ</strong>
                                <x-forms.text-field id="" type="text" name="stationary_pp"  class="form-control my-2" placeholder="լրացման ազատ դաշտ․․․"
                                value="{{$accounting->stationary_pp}}" label=""/>
                        </div>
                        <div class="col-md-6">
                            <strong>ՎՃ</strong>
                                <x-forms.text-field id="" type="text" name="stationary_vj" class="form-control my-2" placeholder="լրացման ազատ դաշտ․․․"
                                value="{{$accounting->stationary_vj}}" label=""/>
                        </div>
                    </div>
                    <div class="form-row align-items-center">
                        <div class="col-md-6">
                            <strong>սոց.փ.</strong>
                                <x-forms.text-field id="" type="text" name="social_package" class="form-control my-2" placeholder="լրացման ազատ դաշտ․․․"
                                value="{{$accounting->social_package}}" label=""/>
                        </div>
                        <div class="col-md-6">
                            <strong>ս/պ</strong>
                                <x-forms.text-field id="" type="text" name="stationary_sp" class="form-control my-2" placeholder="լրացման ազատ դաշտ․․․"
                                value="{{$accounting->stationary_sp}}" label=""/>
                        </div>
                    </div>
                </li>
                <li class="list-group-item list-group-item-info">
                    <h4 class="text-center">
                        ԱՄԲՈՒԼԱՏՈՐ
                    </h4>
                </li>
                <li class="list-group-item">
                        <div>
                            <x-forms.text-field type="text" name="ambulator_pp" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                            value="{{$accounting->ambulator_pp}}" label="Պ/Պ" />
                        </div>
                </li>
                <li class="list-group-item">
                    <h4 class="text-center">ՎՃ</h4>
                </li>
                <li class="list-group-item">
                    <div class="form-row align-items-center">
                        <div class="col-md-6 my-2">
                            <strong>Ներքին</strong>
                                <x-forms.text-field id="" type="text" name="ambulator_internal" class="form-control my-2" placeholder="լրացման ազատ դաշտ․․․"
                                value="{{$accounting->ambulator_internal}}" label=""/>
                        </div>
                        <div class="col-md-6">
                            <strong>Դրսի</strong>
                                <x-forms.text-field id="" type="text" name="ambulator_out" class="form-control my-2" placeholder="լրացման ազատ դաշտ․․․"
                                value="{{$accounting->ambulator_out}}" label=""/>
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <h4 class="text-center">ՍՈՑ.Փ.</h4>
                </li>
                <li class="list-group-item">
                    <div class="form-row align-items-center">
                        <div class="col-md-6 my-2">
                            <strong>Ներքին</strong>
                                <x-forms.text-field id="" type="text" name="social_package_internal" class="form-control my-2" placeholder="լրացման ազատ դաշտ․․․" 
                                value="{{$accounting->social_package_internal}}" label=""/>
                        </div>
                        <div class="col-md-6">
                            <strong>Դրսի</strong>
                                <x-forms.text-field id="" type="text" name="social_package_out" class="form-control my-2" placeholder="լրացման ազատ դաշտ․․․"
                                value="{{$accounting->social_package_out}}" label=""/>
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <h4 class="text-center">Ս/Պ ԳՐՈՒԹՅՈՒՅՈՒՆ</h4>
                </li>
                <li class="list-group-item">
                    <div class="form-row align-items-center">
                        <div class="col-md-6 my-2">
                            <strong>Ներքին</strong>
                                <x-forms.text-field id="" type="text" name="writing_sp_internal" class="form-control my-2" placeholder="լրացման ազատ դաշտ․․․"
                                value="{{$accounting->writing_sp_internal}}" label=""/>
                        </div>
                        <div class="col-md-6">
                            <strong>Դրսի</strong>
                                <x-forms.text-field id="" type="text" name="writing_sp_out" class="form-control my-2" placeholder="լրացման ազատ դաշտ․․․"
                                value="{{$accounting->writing_sp_out}}" label=""/>
                        </div>
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
</script>

@endsection
