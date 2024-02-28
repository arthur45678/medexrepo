@extends('layouts.cardBase')

@section('css')
<link href="{{ mix('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('card-header')
Բժիշկներ
@endsection

@section('card-content')

<table id="dt-users" class="table table-hover table-responsive table-cursor" style="width:100%;min-width:100%">
    <thead class="thead-info">
        <tr>
            <th>Id</th>
            <th>Անուն</th>
            <th>Ազգանուն</th>
            <th>Հայրանուն</th>
            <th>Լրիվ Անուն</th>
            <th>Մուտքանուն</th>
        </tr>
    </thead>

    <tfoot>
        <tr>
            <th>Id</th>
            <th>Անուն</th>
            <th>Ազգանուն</th>
            <th>Հայրանուն</th>
            <th>Լրիվ Անուն</th>
            <th>Մուտքանուն</th>
        </tr>
        </tr>
    </tfoot>
</table>
@endsection

@section('javascript')
<script src="{{ mix('js/jquery.js') }}"></script>
<script src="{{ mix('js/datatables.js') }}"></script>
<script>
    const url = 'http://medexrepo/dtssp/users_processing';
    const usersUrl = @json(route('dtssp.users.processing'));
    $(document).ready(function() {

        console.log(usersUrl)
        const dtUsers = $('#dt-users').CDataTable({
            "processing":true,
            "serverSide": true,
            "ajax":{
                url: usersUrl,
                type: 'GET',
                dataSrc: 'staff',
                error: function(xhr, status, error){  // error handling code
                    var errorMessage = xhr.status + ': ' + xhr.statusText
                    console.log('processingError - ' + errorMessage)
                },
                // success: function(data) {
                //     // uncomment to log response
                //     console.log(data)
                // },


            },
            "columns": [
                { data: 'id' },
                { data: 'f_name' },
                { data: 'l_name' },
                { data: 'p_name' },
                { data: 'full_name', orderable: false, searchable: false },
                { data: 'username' },
            ]
        });

    });
</script>
@endsection
