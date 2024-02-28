@extends('layouts.base')

@section('css')
<link href="{{ mix('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ mix('css/rowGroup.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')

<div class="container-fluid">
    <div class="fade-in">
        <div class="row">
            <div class="card col-12">
                <div class="card-header">Հիվանդներ</div>
                <div class="card-body">
                    <table id="patients-not-attached" class="table table-md table-hover table-responsive"
                        style="width:100%;">
                        <thead class="thead-info">
                            <tr>
                                <th>Id</th>
                                <th>Անուն</th>
                                <th>Ազգանուն</th>
                                <th>Հայրանուն</th>
                                <th>Տիպ</th>
                                <th>Ծնված</th>
                                <th>Անձնագիր</th>
                                <th>Բջջային</th>
                                <th>Քաղաքային</th>
                                <th>Փողոց</th>
                                <th>Շենք</th>
                                <th>Տուն</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($patients as $item)
                            <tr id={{$item['id']}} data-url={{url("/patients/$item[id]")}}>
                                <td>{{$item['id']}}</td>
                                <td>{{$item['name']}}</td>
                                <td>{{$item['lastname']}}</td>
                                <td>{{$item['patronymic']}}</td>
                                <td>{{$item['type']}}</td>

                                <td>{{$item['birthday']}}</td>
                                <td>{{$item['passport']}}</td>
                                <td>{{$item['m_phone']}}</td>
                                <td>{{$item['tel_num']}}</td>
                                <td>{{$item['strit']}}</td>
                                <td>{{$item['building']}}</td>
                                <td>{{$item['house']}}</td>
                            </tr>
                            @empty
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Id</th>
                                <th>Անուն</th>
                                <th>Ազգանուն</th>
                                <th>Հայրանուն</th>
                                <th>Տիպ</th>
                                <th>Ծնված</th>
                                <th>Անձնագիր</th>
                                <th>Բջջային</th>
                                <th>Քաղաքային</th>
                                <th>Փողոց</th>
                                <th>Շենք</th>
                                <th>Տուն</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('javascript')
<script src="{{ mix('js/jquery.js') }}"></script>
<script src="{{ mix('js/datatables.js') }}"></script>

<script>
    $(document).ready(function() {
        const patientsDt = $('#patients-not-attached').DataTable({
            responsive: true,
            "language": window.dt.hy,
            rowGroup: {
                dataSrc: 5
            }
        });
        // $('#patients tbody').on('dblclick', 'tr', function(){
        //     const url = $(this).data('url');
        //     window.open(url);
        // })
    });
</script>
@endsection
