@extends('layouts.AdminCardBase')

@section('css')
    <link href="{{ mix('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('card-header')
    <h4>Դիմումների տեսակներ</h4>
    <div class="card-header-actions">
        <a href="{{ route("admin.ApplicationPurpose-lists.create") }}" class="btn btn-primary float-right mr-4" type="button" target="_blank">
            <x-svg icon="cui-plus" />
            ավելացնել նորը
        </a>
    </div>
@endsection

@section('card-content')

    @include('shared.info-box')

    <table class="table table-md table-hover table-responsive table-cursor datatable-default" style="width:100%;">
        <thead class="thead-info">
            <tr>
                <th>№</th>
                <th>ID</th>
                <th>Անվանում</th>
                <th>Վիճակ</th>
                <th>Գործողություններ</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($lists as $k=>$list)
            @php
                $status_class = $list->status ? ($list->status === 'active' ? 'text-success' : 'text-danger') : 'text-primary';
                $status_text = $list->status ? ($list->status === 'active' ? 'ակտիվ' : 'պասիվ') : 'սահմանված չէ';
            @endphp
                <tr data-url='{{route("admin.ApplicationPurpose-lists.edit", $list->id)}}'>
                    <td>{{ $k+1 }}</td>
                    <td>{{ $list->id }}</td>
                    <td>{{ $list->name }}</td>
                    <td class="{{$status_class}}">{{ $status_text }}</td>
                    <td data-url='{{route('admin.ApplicationPurpose-lists.edit', $list->id)}}'>
                        <form method="POST" action="{{route('admin.ApplicationPurpose-lists.update',$list->id)}}" class="d-inline">
                            @csrf
                            @method("put")
                            <input type="hidden" name="deactivate" value="1">
                            <button class="btn btn-danger btn-sm" type="submit">
                                <x-svg icon="cui-trash" />
                            </button>
                        </form>
                        <a href="{{route("admin.ApplicationPurpose-lists.edit",  $list->id)}}" class="btn btn-primary btn-sm" target="_blank">
                            <x-svg icon="cui-pencil" />
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
