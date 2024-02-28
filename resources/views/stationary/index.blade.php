@extends('layouts.cardBase')

@section('css')
<link href="{{ mix('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
@endsection

@section('card-header')
<div>
    <h4>Ստացիոնար քարտեր</h4>
    <h6 class="pt-1">{{$patient->all_names}} | {{$patient->soc_card}}</h6>
</div>
<div class="card-header-actions">
    @can('create stationaries')
    <a href="{{ route("patients.stationary.create", ["patient" => $patient]) }}" class="btn btn-primary float-right mr-4" type="button" target="_blank">
        <x-svg icon="cui-plus" />
        Նոր քարտ
    </a>
    @endcan
    @cannot('create stationaries')
    <button class="btn btn-secondary" disabled><x-svg icon="cui-plus" />Նոր քարտ</button>
    @endcannot
</div>
@endsection

@section('card-content')

<table class="table table-striped table-bordered datatable-default">
    <thead>
        <tr>
            <th>ID</th>
            <th>Ընդունման ամսաթիվ</th>
            <th>Բուժող բժիշկ</th>
            <th>Գործողություններ</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($stationaries as $stationary)
        <tr>
            <td>
                {{ $stationary->id }}
            </td>
            <td>
                {{ $stationary->admission_date }}
            </td>
            <td>
                {{ $stationary->attending_doctor->full_name ?? "" }}
            </td>
            <td>
                <a href="{{ route('patients.stationary.sections', compact("patient", "stationary")) }}" class="btn btn-info btn-sm">
                    <x-svg icon="cui-applications" />
                </a>

                <a href="{{ route('patients.stationary.show', compact("patient", "stationary")) }}" class="btn btn-info btn-sm">
                    <x-svg icon="cui-external-link" />
                </a>

                @hasrole('receptionist')
                    <a href="{{ route('patients.stationary.edit', compact("patient", "stationary")) }}" class="btn btn-primary btn-sm" target="_blank">
                        >>> 9
                        <x-svg icon="cui-pencil" />
                    </a>
                @else
                    <a href="{{ route('patients.stationary.edit', compact("patient", "stationary")) }}" class="btn btn-primary btn-sm" target="_blank">
                        >>> 19
                        <x-svg icon="cui-pencil" />
                    </a>

                    <a href='{{ route("patients.stationary.edit", ["patient" => $patient, "stationary" =>$stationary, "part" =>2]) }}' class="btn btn-primary btn-sm" target="_blank">
                        <x-svg icon="cui-pencil" />
                        19 >>>
                    </a>
                @endhasrole

                {{-- @can('update', $stationary) --}}
                {{-- <a href="{{ route('patients.stationary.edit', compact("patient", "stationary")) }}" class="btn btn-primary btn-sm">
                    <x-svg icon="cui-pencil" />
                </a> --}}
                {{-- @endcan --}}

                {{-- @can('user-can-approve', $uex)
                <form method="POST" action="{{ route("approvements.update", ["approvement" => $uex->approvement]) }}" class="d-inline">
                    @csrf
                    @method("PATCH")
                    <button class="btn btn-success btn-sm">
                        <x-svg icon="cui-check" />
                    </button>
                </form>
                @endcan --}}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection

@section('javascript')
<script src="{{ mix('js/jquery.js') }}"></script>
<script src="{{ mix('js/datatables.js') }}"></script>
@endsection
