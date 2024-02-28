@extends('layouts.AdminCardBase')

@section('css')
<link href="{{ mix('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('card-header')
    <a href="{{ route("admin.departments.create") }}" class="btn btn-primary float-right mr-4" type="button" target="_blank">
        <x-svg icon="cui-plus" />
        Նոր Բաժին
    </a>
@endsection

@section('card-content')

{{-- datatable-department --}}
    <table class="table table-striped table-bordered deplartments-datatable">
        <thead>
        <tr>
            <th>ID</th>
            <th>Անվանում</th>
            <th>Բաշխումը</th>
            <th>Հաստատումը</th>
            <th>Գործողություններ</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($departments as $department)
            <tr>
                <td>
                    {{ $department->id }}
                </td>
                <td>
                    {{ $department->name }}
                </td>
                <td>
                    @if ( $department->closed_from_outside)
                        կենտրոնացված
                    @else
                        ազատ
                    @endif
                </td>
                <td>
                    @if ( $department->closed_from_inside)
                        կենտրոնացված
                    @else
                        անհատական
                    @endif
                </td>

                <td>
                    <a class="btn btn-info btn-sm" href="{{ route('admin.departments.show',$department->id) }}" title="Դիտել">
                        <svg class="c-icon">
                            <use xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-applications"></use>
                        </svg>
                    </a>
                    <a class="btn btn-primary btn-sm" href="{{ route('admin.departments.edit',$department->id) }}" title="Փոփոխել">
                        <svg class="c-icon">
                            <use xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-external-link"></use>
                        </svg>
                    </a>

                    <form method="post" action="{{ route('admin.departments.destroy', [$department->id]) }}" style='display: inline' title="Ջնջել">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger btn-sm">
                            <svg class="c-icon">
                                <use xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-trash"></use>
                            </svg>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>ID</th>
                <th>Անվանում</th>
                <th>Բաշխումը</th>
                <th>Հաստատումը</th>
                <th>Գործողություններ</th>
            </tr>
        </tfoot>
    </table>
@endsection

@section('javascript')
<script src="{{ mix('js/jquery.js') }}"></script>
<script src="{{ mix('js/datatables.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.deplartments-datatable tfoot th').each( function () {
           if($(this).text() !== 'Գործողություններ') {
                var title = $(this).text();
                console.log(title)
                $(this).html( '<input type="text" placeholder="Փնտրել '+title+'" />' );
           }
        });
        var depsDt = $('.deplartments-datatable').CDataTable({
            initComplete: function () {
                // Apply the search
                this.api().columns().every( function () {
                    var that = this;

                    $( 'input', this.footer() ).on( 'keyup change clear', function () {
                        if ( that.search() !== this.value.trim() ) {
                            that.search( this.value ).draw();
                        }
                    });
                });
            }
        });

    });
</script>

@endsection
