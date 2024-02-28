@extends('layouts.cardBase')

@section('css')
<link href="{{ mix('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('card-header')
<div>
    <h4>Ամբուլատոր քարտ</h4>
    <h6 class="pt-1">{{$patient->all_names}} | {{$patient->soc_card}}</h6>
</div>
<div class="card-header-actions">
    <!-- each patient can have only ONE ambulator card -->
    @can('create ambulators')
        @if ($patientAmbulator->count() === 0)
        <a href="{{ route("patients.ambulator.create", ["patient" => $patient]) }}" class="btn btn-primary float-right mr-4" type="button" target="_blank">
            <x-svg icon="cui-plus" />
            Նոր քարտ
        </a>
        @endif
    @endcan
    @cannot('create ambulators')
    <button class="btn btn-secondary" disabled><x-svg icon="cui-plus" />Նոր քարտ</button>
    @endcannot
</div>
@endsection

@section('card-content')

<table class="table table-striped table-bordered datatable-default">
    <thead>
        <tr>
            <th>ID</th>
            <th>Համար №</th>
            <th>Բացման ամսաթիվ</th>
            <th>Գործողություններ</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($patientAmbulator as $ambulator)
        <tr>
            <td>
                {{ $ambulator->id }}
            </td>
            <td>
                N{{ $ambulator->number }}/ {{date('Y')}}
            </td>
            <td>
                {{ $ambulator->created_at }}
            </td>
            <td>
                <a href="{{ route('patients.ambulator.approvement.show',["patient" => $patient,"ambulator"=>$ambulator->id,0]) }}" class="btn btn-info btn-sm">
                    <x-svg icon="cui-applications" />
                </a>
                <a href="{{ route('patients.ambulator.show', compact("patient", "ambulator")) }}" class="btn btn-info btn-sm">
                    <x-svg icon="cui-external-link" />
                </a>

                <a href="{{ route('patients.ambulator.edit', compact("patient", "ambulator")) }}" class="btn btn-primary btn-sm">
                    <x-svg icon="cui-pencil" />
                </a>
            </td>
        </tr>
        @empty
        @endforelse
    </tbody>
</table>

@endsection

@section('javascript')
<script src="{{ mix('js/jquery.js') }}"></script>
<script src="{{ mix('js/datatables.js') }}"></script>
@endsection

