@extends('layouts.AdminCardBase')

@section('css')
<link href="{{ mix('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('card-header')
    <h4>Հիվանդություններ</h4>
    <div class="card-header-actions">
        <a href="{{ route("admin.dinisase-list.create") }}" class="btn btn-primary float-right mr-4" type="button" target="_blank">
            <x-svg icon="cui-plus" />
            ավելացնել նորը
        </a>
    </div>
@endsection

@section('card-content')

    @if(Session::has('msg'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>Տվյալները հաջողությամբ պահպանված են։</strong>
        </div>
        @php
            Session::forget('msg');
        @endphp
    @endif

    <table class="table table-md table-hover table-responsive table-cursor datatable-default" style="width:100%;">
        <thead class="thead-info">
        <tr>
            <th>ID</th>
            <th>Անվանում</th>
            <th>chapter </th>
            <th>block</th>
            <th>code</th>
            <th>Ստեղծվել է</th>

            <th>Գործողություններ</th>
        </tr>
        </thead>

        <tbody>
        @foreach ($dinisase as $list)
            <tr >
                <td>{{ $list->id }}</td>
                <td>{{ $list->name }}</td>
                <td>{{ $list->chapter }}</td>
                <td>{{ $list->block }}</td>

                <td>{{ $list->code}}</td>
                <td>{{ $list->created_at}}</td>
                <td>
                    <form method="POST" action="{{route('admin.dinisase-list.update',$list->id)}}" class="d-inline">
                        @csrf
                        @method("put")
                        <button class="btn btn-danger btn-sm" type="submit">
                            <x-svg icon="cui-trash" />
                        </button>
                    </form>
                    <a href="{{route('admin.dinisase-list.edit',$list->id)}}">
                        <button class="btn btn-primary btn-sm text-white" type="submit">
                            <x-svg icon="cui-pencil" />
                        </button>
                    </a>
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
