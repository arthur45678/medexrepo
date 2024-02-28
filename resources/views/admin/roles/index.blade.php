@extends('layouts.AdminCardBase')

@section('css')
    <link href="{{ mix('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
@endsection

@section('card-header')
    <div class="card-header-actions">
        <h4>Պաշտոն</h4>
    </div>
    <div class="card-header-actions">
        <a href="{{ route("admin.roles.create") }}" class="btn btn-primary float-right mr-4" type="button" target="_blank">
            <x-svg icon="cui-plus" />
            ավելացնել նորը
        </a>
    </div>
@endsection

@section('card-content')
    <table class="table table-md table-hover table-responsive table-cursor datatable-default" style="width:100%;">
        <thead class="thead-info">
            <tr>
                <th>ID</th>
                <th>Պաշտոն</th>
                <th>Ստատուս</th>
                <th width="280px">Գործողություններ</th>
            </tr>
        </thead>

        <tbody>
        @foreach ($roles as $key => $role)
            <tr data-url={{url("/admin/roles/{$role->id}")}}>
                <td>{{ ++$i }}</td>
                <td>{{ $role->name }}</td>
                <td>{{ $role->status == 1 ? 'Ակտիվ է' : 'Ակտիվ չե' }}</td>
                <td>
                    <a class="btn btn-info btn-sm" href="{{ route('admin.roles.show',$role->id) }}">
                        <svg class="c-icon">
                            <use xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-external-link"></use>
                        </svg>
                    </a>

                    <a class="btn btn-info btn-sm" href="{{ route('admin.roles.edit',$role->id) }}">
                        <svg class="c-icon">
                            <x-svg icon="cui-pencil" />
                        </svg>
                    </a>

                    {{-- <form method="post" action="{{ route('admin.roles.destroy', [$role->id]) }}" style="display: inline">
                        @csrf()
                        @method('delete')
                        <button type="submit" class="btn btn-danger btn-sm">
                            <svg class="c-icon">
                                <use xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-trash"></use>
                            </svg>
                        </button>
                    </form>--}}
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
