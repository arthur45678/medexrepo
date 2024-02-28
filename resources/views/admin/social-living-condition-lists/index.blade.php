@extends('layouts.AdminCardBase')
@section('css')
<link href="{{ mix('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('card-header')
    <h4>Սոցիալական կենսապայմանների</h4>
    <div class="card-header-actions">
        <a href="{{ route("admin.social-living-condition-lists.create") }}" class="btn btn-primary float-right mr-4" type="button" >
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
            <th>ID</th>
            <th>Անվանում</th>
            <th>Վիճակ</th>
            <th>Գործողություններ</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($lists as $key => $list)
                <tr data-url='{{route("admin.social-living-condition-lists.edit", $list->id)}}'>
                    <td>{{ $list->id }}</td>
                    <td>{{ $list->name }}</td>
                    @if($list->status=='active')
                        <td class="text-success">ակտիվ</td>
                    @else
                        <td class="text-danger">պասիվ</td>
                    @endif
                    <td>
                        <form method="POST" action='{{route("admin.social-living-condition-lists.update",  $list->id)}}' class="d-inline">
                            @csrf
                            @method("PATCH")
                            <input type="hidden" name="deactivate" value="1">
                            <button class="btn btn-danger btn-sm" type="submit" name="status" value="{{$list->status}}">
                                <x-svg icon="cui-trash" />
                            </button>
                        </form>

                        <a href="{{route("admin.social-living-condition-lists.edit",  $list->id)}}" class="btn btn-primary btn-sm">
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
