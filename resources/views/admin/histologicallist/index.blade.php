@extends('layouts.AdminCardBase')

@section('css')
<link href="{{ mix('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('card-header')
    <h4>Հյուսվածքաբանական նշումներ</h4>
    <div class="card-header-actions">
        <a href="{{ route("admin.histological-lists.create") }}" class="btn btn-primary float-right mr-4" type="button" target="_blank">
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
            <th>Համար</th>
            <th>Թարմացվե է</th>
            <th>Գործողություններ</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($lists as $k=>$list)
            <tr >
                <td>{{ $k+1 }}</td>
                <td>{{ $list->name }}</td>
                <td>{{ $list->code }}</td>
                @if($list->status=='active')
                    <td class="text-success">ակտիվ</td>
                @else
                    <td class="text-danger">պասիվ</td>
                @endif
                <td>
                    <form method="POST" action="{{route('admin.histological-lists.update',$list->id)}}" class="d-inline">
                        @csrf
                        @method("put")
                        <button class="btn btn-danger btn-sm" type="submit" name="status" value="{{ $list->status }}">
                            <x-svg icon="cui-trash" />
                        </button>
                    </form>
                    <a href="{{route('admin.histological-lists.edit',$list->id)}}">
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
