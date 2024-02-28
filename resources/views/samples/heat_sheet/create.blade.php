@extends('layouts.cardBase')

@section('card-header')
@section('card-header-classes', '')

<div class="text-center">
    <h3>Ջերմության թերթիկ</span></h3>
</div>
@endsection


@section('card-content')

<div class="container">
    <form class="ajax-submitable" action="{{ route('samples.patients.heat_sheet.store', ['patient'=> $patient]) }}" method="POST">
        @csrf
        <ul class="list-group">
                <li class="list-group-item">
                    <strong>
                   {{--     Քարտ No--}}
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
                        <x-forms.magic-search class="magic-search ajax" value='' hidden-id="department_id" validationType="ajax"
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
                            <x-forms.text-field name="admission_date" type="date"  validationType="ajax" value="" label=""/>
                        </div>
                    </div>
                </li>


            <li class="list-group-item">
                <strong>Բուժող բժիշկ՝</strong>
                <x-forms.magic-search hidden-id="attending_doctor_id" hidden-name="attending_doctor_id"
                                      placeholder="Ընտրել  բաժանմունքի վարչին․․․" class="magic-search ajax my-2" data-list-name="users"
                                      value="" />
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


</script>


<script src="{{ asset('js/Chart.min.js') }}"></script>
<script src="{{ asset('js/coreui-chartjs.bundle.js') }}"></script>
<script src="{{ asset('js/charts.js') }}"></script>

@endsection
