@extends('layouts.AdminCardBase')

@section('css')
    <link href="{{ mix('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
@endsection

@section('card-header')
    <div class="card-header-actions">
        <h4>Անձնակազմ</h4>
    </div>
    <div class="card-header-actions">
        <a href="{{ route("admin.users.create") }}" class="btn btn-primary float-right mr-4" type="button" target="_blank">
            <x-svg icon="cui-plus" />
            ավելացնել նորը
        </a>
    </div>
@endsection

@section('card-content')
    <table class="table table-md table-hover table-responsive table-cursor users-datatable" style="width:100%;">
        <thead class="thead-info">
            <tr>
                <th>ID</th>
                <th>Անուն</th>
                <th>Ազգանուն</th>
                <th>Լոգին</th>
                <th>Բաժանմունք</th>
                <th>Բաժանմունք code</th>
                <th>Էլ․ հասցե</th>
                <th>Կոչում</th>
                <th>Պաշտոն</th>
                <th width="280px">Գործողություններ</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $key => $user)
                <tr data-url={{url("/admin/users/{$user->id}")}}>
                    {{-- <td>{{ ++$i }}</td> --}}
                    <td>{{ ++$key }}</td>
                    <td>{{ $user->f_name }}</td>
                    <td>{{ $user->l_name}}</td>
                    <td>{{ $user->username}}</td>
                    <td>{{ $user->department->name ?? ' '}}</td>
                    {{-- <td>{{ $user->department_code ?? ' '}}</td> --}}
                    <td>{{ $user->department->code ?? ' '}}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->position }}</td>
                    <td>
                        @if(!empty($user->getRoleNames()))
                            @foreach($user->getRoleNames() as $v)
                                <label class="badge badge-success">{{ $v }}</label>
                            @endforeach
                        @endif
                    </td>
                    <td>
                        <a class="btn btn-info btn-sm" href="{{ route('admin.users.show',$user->id) }}">
                            <x-svg icon="cui-external-link" />
                        </a>
                        <a class="btn btn-primary btn-sm" href="{{ route('admin.users.edit',$user->id) }}">
                            <x-svg icon="cui-pencil" />
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>ID</th>
                <th>Անուն</th>
                <th>Ազգանուն</th>
                <th>Լոգին</th>
                <th>Բաժանմունք</th>
                <th>Բաժանմունք code</th>
                <th>Էլ․ հասցե</th>
                <th>Կոչում</th>
                <th>Պաշտոն</th>
                <th width="280px">Գործողություններ</th>
            </tr>
        </tfoot>

    </table>
@endsection

@section('javascript')
    <script src="{{ mix('js/jquery.js') }}"></script>
    <script src="{{ mix('js/datatables.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.users-datatable tfoot th').each( function () {
               if($(this).text() !== 'Գործողություններ') {
                    var title = $(this).text();
                    console.log(title)
                    $(this).html( '<input type="text" placeholder="Փնտրել '+title+'" />' );
               }
            });
            var depsDt = $('.users-datatable').CDataTable({
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
