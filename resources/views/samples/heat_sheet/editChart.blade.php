@extends('layouts.cardBase')

@section('card-header')
@section('card-header-classes', '')

<div class="text-center">
    <h3>Ջերմության թերթիկ</span></h3>
</div>
@endsection


@section('card-content')

<div class="container">
    <form class="ajax-submitable" action="{{ route('samples.heat_sheet.heat_sheet_charts.update', [$heatSheet, $chart->id]) }}" method="POST">
        @csrf
        @method('put')
        <ul class="list-group">
            <li class="list-group-item">
                <div class="form-row align-items-center">
                    <div class="col-md-6 my-2">
                        <strong>Պ</strong>
                        <x-forms.text-field id="" type="text" name="p" class="form-control my-2" placeholder="լրացման ազատ դաշտ․․․"
                                            value="{{ $chart->p }}" label=""/>
                    </div>
                    <div class="col-md-6">
                        <strong>ԱՃ</strong>
                        <x-forms.text-field id="A_CH_comment" type="text" name="A_CH_comment" class="form-control my-2" placeholder="լրացման ազատ դաշտ․․․"
                                            value="{{ $chart->A_CH_comment }}" label=""/>
                    </div>
                </div>
                <div class="form-row align-items-center">
                    <div class="col-md-6">
                        <strong>T <sup>0</sup> </strong>
                        <x-forms.text-field id="" type="text" name="t_0" class="form-control my-2" placeholder="լրացման ազատ դաշտ․․․"
                                            value="{{ $chart->t_0 }}" label=""/>
                    </div>
                </div>
            </li>

            <li class="list-group-item">
                <strong>Ստացիոնար ընդունվելու օրը</strong>
                <select  name="day"  class="form-control my-2" validationType="ajax">
                    <option>{{ $chart->day }}</option>
                    <option value="0"></option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
                    <option value="19">19</option>
                    <option value="20">20</option>
                    <option value="21">21</option>
                    <option value="22">22</option>
                    <option value="23">23</option>
                    <option value="24">24</option>
                    <option value="25">25</option>
                    <option value="26">26</option>
                    <option value="27">27</option>
                    <option value="28">28</option>
                    <option value="29">29</option>
                    <option value="30">30</option>
                    <option value="31">31</option>

                </select>
                <select  name="day_time_period"  class="form-control my-2" validationType="ajax">
                    <option {{ isset($chart->day_time_period) == 'A' ? 'checked' : '' }} value="A">Առավոտ</option>
                    <option {{ isset($chart->day_time_period) == 'E' ? 'checked' : '' }}  value="E">Երեկո</option>
                </select>
            </li>
            @include('shared.forms.list_group_item_submit', ['btn_text'=>'Ուղարկել'])







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


</script>


<script src="{{ asset('js/Chart.min.js') }}"></script>
<script src="{{ asset('js/coreui-chartjs.bundle.js') }}"></script>
<script src="{{ asset('js/charts.js') }}"></script>

@endsection
