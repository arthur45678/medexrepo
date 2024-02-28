@extends('layouts.cardBase')

@section('css')
<link href="{{ mix('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
@endsection

@section('card-header')
<div>
    <h3>ԱՆՀԱՏԱԿԱՆ ԲՈՒԺՄԱՆ ՊԼԱՆ</h3>
    <h3>ՉԱՐՈՐԱԿ ՆՈՐԱԳՈՅԱՑՈՒԹՅՈՒՆՆԵՐՈՎ ՊԱՑԻԵՆՏԻ</h3>
    <h5>{{ $patient->all_names }}</h5>
</div>
<div class="card-header-actions">
    <a href="{{ route("samples.patients.individual-treatment-plan.create", ['patient' => $patient]) }}" class="btn btn-primary float-right mr-4" type="button">
        <x-svg icon="cui-plus" />
        Նոր հետազոտություն
    </a>
</div>
@endsection

@section('card-content')
    @if(session()->has('ok'))
        <div class="card-body">
            <div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Հաջողություն!</strong> Ֆայլը ջնջված է.
                <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
        </div>
    @endif
<table class="table table-striped table-bordered table-cursor datatable-default">
    <thead>
        <tr>
            <th>ID</th>
            <th>Ամսաթիվ</th>
            <th>Բուժող բժիշկ</th>
            <th>Կարգավիճակ</th>
            <th>Գործողություններ</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($lists as $k=>$list)
        <tr data-url="{{ route('samples.patients.individual-treatment-plan.show', [$patient , $list]) }}">
            <td>
                {{ $k+1 }}
            </td>
            <td>
                {{ $list->entry_date}}
            </td>

            <td>
                {{ $list->OncologistDoctor->full_name ?? ''}}
            </td>

                <td>
                    {{ optional($list->approvement)->status  ? "Հաստատված" : "Սպասման մեջ"}}
                    {{ $list->approvementStatus() }}
                </td>

            <td>
                <a href="{{ route('samples.patients.individual-treatment-plan.show', [$patient , $list]) }}" class="btn btn-info btn-sm">
                    <x-svg icon="cui-external-link" />
                </a>
                @if($list->user_id==auth()->id())
                @can('belongs-to-user', $list)
                    <a href="{{ route('samples.patients.individual-treatment-plan.edit', [$patient->id , $list->id]) }}" class="btn btn-primary btn-sm">
                    <x-svg icon="cui-pencil" />
                </a>
                @endcan

                <form method="POST" action="{{route('samples.patients.individual-treatment-plan.destroy', [$patient->id , $list->id]) }}" class="d-inline">
                    @csrf
                    @method('delete')

                    <button class="btn btn-danger btn-sm" >
                        <x-svg icon="cui-trash" />
                    </button>
                </form>
                @endif

                @can('user-can-approve', $list)
                    <form method="POST" action="{{ route("approvements.update",$list->approvement) }}" class="d-inline">
                        @csrf
                        @method("PATCH")
                        <button class="btn btn-success btn-sm" {{ $list->approvement->status ? "disabled" : "" }}>
                            <x-svg icon="cui-check" />
                        </button>
                    </form>
                @endcan

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
