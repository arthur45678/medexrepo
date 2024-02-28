@extends('layouts.cardBase')

@section('css')
<link href="{{ mix('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
@endsection

@section('card-header')
<div>
    <h4>ՏԵԽՆԻԿԱԿԱՆ ԲՆՈՒԹԱԳԻՐ-ԳՆՄԱՆ ԺԱՄՆԱԿԱՑՈՒՅՑ</h4>
</div>
<div class="card-header-actions">
    <a href="{{ route('otherSamples.ptc.create') }}" class="btn btn-primary float-right mr-4" type="button">
        <x-svg icon="cui-plus" />
        Ավելացնել Նոր
    </a>
    <a href="{{ route('otherSamples.ptc.show', 0) }}" class="btn btn-primary float-right mr-4">
        <x-svg icon="cui-external-link" />
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
            <th>Ավելացրել է</th>
            <th>Գործողություններ</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($procurements as $procurement)
        <tr data-url="{{ route('otherSamples.ptc.show', $procurement->id) }}">
            <td>
                {{ $procurement->id }}
            </td>
            <td>
                {{$procurement->getFormattedDate('created_at', 'd-m-Y H:i')}}
            </td>
            <td>
                {{ $procurement->user->full_name  ?? ''}}
            </td>
            <td>
                @if($procurement->user_id == auth()->id())
                @can('belongs-to-user', $procurements)
                    <a href="{{ route('otherSamples.ptc.edit', $procurement->id) }}" class="btn btn-primary btn-sm">
                    <x-svg icon="cui-pencil" />
                </a>
                @endcan
                <form method="POST" action="{{route('otherSamples.ptc.destroy', $procurement->id) }}" class="d-inline">
                    @csrf
                    @method('delete')
                    <button class="btn btn-danger btn-sm" >
                        <x-svg icon="cui-trash" />
                    </button>
                </form>
                    <a href="{{ route('otherSamples.ptc.show', $procurements->id) }}" class="btn btn-primary btn-sm">
                        <svg class="c-icon">
                            <use xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-applications"></use>
                        </svg>
                    </a>

                @endif
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
