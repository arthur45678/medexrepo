@extends('layouts.cardBase')

@section('card-header')
@section('card-header-classes', '')

<div class="text-center">
    <h3>Ջերմության թերթիկ</span></h3>
</div>
@endsection


@section('card-content')

<div class="container">
    <form class="ajax-submitable" action="{{ route('samples.patients.heat_sheet.update', ['patient'=> $patient,  $post->id]) }}" method="POST">
        @csrf
        @method('put')
        <ul class="list-group">
                <li class="list-group-item">
                    <strong>
                       Քարտ No: {{ $post->id }}
                    </strong>
                    <ins class="ml-4"></ins>
                </li>
                <li class="list-group-item">
                    <strong>
                        Ազգանուն, անուն, հայրանուն  {{ $patient->getAllNamesAttribute() }}
                    </strong>
                    <ins class="ml-4"></ins>

                </li>
                <li class="list-group-item">
                    <div class="col-md-6">
                        <strong>
                            Տարիք
                        </strong>
                        <ins class="ml-4"><span>{{ $patient->getAgeAttribute() }}
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="form-row align-items-center">
                        <div class="col-md-4">
                            <strong>Բաժանմունք՝</strong>
                        </div>
                        <div class="col-md-8">
                        <x-forms.magic-search class="magic-search ajax" value="{{ $post->department_id }}" hidden-id="department_id" validationType="ajax"
                        hidden-name="department_id" data-catalog-name="departments" placeholder="ընտրել բաժանմունքը․․․" />
                    </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="form-row align-items-center">
                        <div class="col-md-4">
                            <strong>Ամսաթիվ</strong>
                        </div>
                        <div class="col-md-8">
                            <x-forms.text-field name="admission_date" type="date"  validationType="ajax" value="{{ $post->admission_date }}" label=""/>
                        </div>
                    </div>
                </li>

            <li class="list-group-item">
                <div class="form-row align-items-center">
                    <div class="col-md-4">
                        <strong>Բաժանմունք՝</strong>
                    </div>
                    <div class="col-md-8">
                        <x-forms.magic-search class="magic-search ajax" value="{{ $post->department_id }}" hidden-id="department_id" validationType="ajax"
                                              hidden-name="department_id" data-catalog-name="departments" placeholder="ընտրել բաժանմունքը․․․" />
                    </div>
                </div>
            </li>

            <li class="list-group-item">
                <strong>Բուժող բժիշկ՝</strong>
                <x-forms.magic-search hidden-id="attending_doctor_id" hidden-name="attending_doctor_id"
                                      placeholder="Ընտրել  բաժանմունքի վարչին․․․" class="magic-search ajax my-2" data-list-name="users"
                                      value="{{ $post->attending_doctor_id }}" />
            </li>
            @include('shared.forms.list_group_item_submit', ['btn_text'=>'Ուղարկել'])


        </ul>
    </form>


    @foreach($charts as $chart)
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Ստացիոնար ընդունվելու օրը</th>
                    <th>Ժամանակահատված</th>
                    <th>Գործողություններ</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $chart->day }}</td>
                    <td>{{ $chart->day_time_period }}</td>


                    <td>
                        <a href="{{ route("samples.heat_sheet.heat_sheet_charts.create", [$post]) }}" class="btn btn-info btn-sm">
                            <x-svg icon="cui-plus" />
                        </a>
                       {{-- <a href="{{ route("samples.heat_sheet.heat_sheet_charts.show", [$post, $chart->id]) }}" class="btn btn-info btn-sm">
                            <x-svg icon="cui-external-link" />
                        </a>--}}

                        <a href="{{ route('samples.heat_sheet.heat_sheet_charts.edit', [$post, $chart->id]) }}" class="btn btn-primary btn-sm">
                            <x-svg icon="cui-pencil" />
                        </a>


                        <form method="POST" action="{{ route('samples.heat_sheet.heat_sheet_charts.update', [$post,$chart->id]) }}" class="d-inline">
                            @csrf
                            @method("PATCH")

                        </form>


                        <form method="POST" action="{{route('samples.heat_sheet.heat_sheet_charts.destroy', [$post, $chart->id]) }}" class="d-inline">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger btn-sm">
                                <x-svg icon="cui-trash"/>
                            </button>
                        </form>

                    </td>

                </tr>
                <tr>

                </tr>
            </tbody>
        </table>
    @endforeach

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
