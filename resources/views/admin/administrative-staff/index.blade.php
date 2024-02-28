@extends('layouts.AdminCardBase')

@section('css')
    <link href="{{ mix('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
@endsection

@section('card-header')
    <div class="card-header-actions">
        <h4>Վարչական անձնակազմ</h4>
    </div>
    <div class="card-header-actions">
        <a href="{{ route("admin.administrative-staff.create") }}" class="btn btn-primary float-right mr-4" type="button" target="_blank">
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
                {{--<th>Ստատուս</th>--}}
                <th width="280px">Գործողություններ</th>
            </tr>
        </thead>

        <tbody>
        @foreach ($posts as $key => $post)
            <tr data-url={{url("/admin/roles/{$post->id}")}}>
                <td>{{ ++$i }}</td>
                <td>{{ $post->title }}</td>
                {{--<td>{{ $post->status == 1 ? 'Ակտիվ է' : 'Ակտիվ չե' }}</td>--}}
                <td>
                    <a class="btn btn-info btn-sm" href="{{ route('admin.administrative-staff.show',$post->id) }}" title="Տեսնել">
                        <svg class="c-icon">
                            <use xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-applications"></use>
                        </svg>
                    </a>

                    <a class="btn btn-warning btn-sm" href="{{ route('admin.administrative-staff.edit',$post->id) }}" title="Փոփոխել">
                        <svg class="c-icon">
                            <use xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-external-link"></use>
                        </svg>
                    </a>
                    {{--<a class="btn btn-danger btn-sm" onclick="return confirm('Համոզվա՞ծ եք որ ցանկանւմ եք ջնջել')" href="{{ route('admin.administrative-staff.destroy',$post->id) }}" title="Ջնջել">
                        <svg class="c-icon">
                            <use xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-trash"></use>
                        </svg>
                    </a>--}}
                    <form method="post" action="{{ route('admin.administrative-staff.destroy', [$post->id]) }}" style="display: inline">
                        @csrf()
                        @method('delete')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Համոզվա՞ծ եք որ ցանկանւմ եք ջնջել')">
                            <svg class="c-icon">
                                <use xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-trash"></use>
                            </svg>
                        </button>
                    </form>
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
