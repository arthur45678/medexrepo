@extends('layouts.cardBase')

@section('css')
<link href="{{ mix('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
@endsection

@section('card-header')
<div>
    <h4>ԿԱՏԱՐՎԱԾ ՀԵՏԱԶՈՏՈՒԹՅՈՒՆՆԵՐԻ ՀԱՇՎԱՌՈՒՄ</h4>

</div>
<div class="card-header-actions">
    <a href="{{ route('otherSamples.accounting-for-research.create') }}" class="btn btn-primary float-right mr-4" type="button">
        <x-svg icon="cui-plus" />
        Ավելացնել Նոր
    </a>
    <a href="{{ route('otherSamples.accounting-for-research.show', 0) }}" class="btn btn-primary float-right mr-4">
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
            <th>Ժամ</th>
            <th>Ավելացրել է</th>
            <th>Գործողություններ</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($accounting as $accountings)
        <tr data-url="{{ route('otherSamples.accounting-for-research.show', $accountings->id) }}">
            <td>
                {{ $accountings->id }}
            </td>
            <td>

                {{\Illuminate\Support\Carbon::parse($accountings->date)->format('Y-m-d')}}
            </td>

            <td>
                {{ $accountings->user->full_name  ?? ''}}
            </td>



            <td>

                @if($accountings->user_id==auth()->id())
                @can('belongs-to-user', $accountings)
                    <a href="{{ route('otherSamples.accounting-for-research.edit', $accountings->id) }}" class="btn btn-primary btn-sm">
                    <x-svg icon="cui-pencil" />
                </a>
                @endcan

                <form method="POST" action="{{route('otherSamples.accounting-for-research.destroy', $accountings->id) }}" class="d-inline">
                    @csrf
                    @method('delete')

                    <button class="btn btn-danger btn-sm" >
                        <x-svg icon="cui-trash" />
                    </button>
                </form>
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

  