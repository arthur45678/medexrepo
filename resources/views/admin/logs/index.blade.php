@extends('layouts.AdminCardBase')

@section('css')
<link href="{{ mix('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('card-header')
    <div class="card-header-actions">
        <h4>Լոգ</h4>

    </div>

@endsection

@section('card-content')

    <table class="table table-md table-hover table-responsive table-cursor datatable-default" style="width:100%;">
        <thead class="thead-info">
        <tr>
            <th>ID</th>
            <th>Անվանում</th>
            <th>Բնութագիր</th>
            <th>Թարմացվե է</th>
            <th>Ստեղծվել է</th>
            <th>Գործողություններ</th>
        </tr>
        </thead>

        <tbody>
        @foreach ($logs as $log)

            <tr data-url={{url("/admin/logs/{$log->id}")}}>
                <td>{{ $log->id }}</td>
                <td>{{ $log->log_name }}</td>
                <td>{{ $log->description}}</td>
                <td>{{ $log->updated_at}}</td>
                <td>{{ $log->created_at}}</td>
                <td>
                    <a class="btn btn-info btn-sm" href="{{ route('admin.logs.show',$log->id) }}">
                        <svg class="c-icon">
                            <use xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-applications"></use>
                        </svg>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>

    </table>


    {!! $logs->render() !!}


@endsection

@section('javascript')
<script src="{{ mix('js/jquery.js') }}"></script>
<script src="{{ mix('js/datatables.js') }}"></script>

@endsection
