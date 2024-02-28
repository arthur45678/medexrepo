@extends('layouts.cardBase')

@section('css')
<link href="{{ mix('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ mix('css/rowGroup.bootstrap4.min.css') }}" rel="stylesheet">
{{-- new css classes .td-overflow-hidden, .dt-close-details, .dt-open-details --}}
@endsection

@section('card-header')
Ընդունարանի առցանց հերթեր
@endsection

@section('card-content')
<div class="container-fluid">
    <div class="fade-in row">
        <div class="card col-12">
            <div class="card-body">
                @include('shared.info-box')
                <table class="table table-hover table-responsive" id="queue-table">
                    <thead class="thead-info">
                        <tr>
                            <th></th>
                            <th>№</th>
                            <th style="min-width:100px">Ամսաթիվ</th>

                            <th>Ա․Ա</th>
                            <th>Հեռ․</th>
                            <th>ՀԾՀՀ</th>
                            <th>Բաժին</th>
                            <th>Բժիշկ</th>

                            <th>Գործողություններ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($queues as $queue)

                        <tr data-url='{{route("reception_queues.show", $queue->id)}}'>
                            <td class="details-control" data-comment='{{$queue->comment}}' title="հիվանդի մեկնաբանությունը">
                                <div class="dt-open-details">
                                    <x-svg icon="cui-plus" />
                                </div>
                                <div class="dt-close-details d-none">
                                    <x-svg icon="cui-minus" />
                                </div>
                            </td>
                            <td>{{$queue->number}}</td>
                            <td>{{$queue->enqueue_date}}</td>

                            <td>{{$queue->patient->full_name}}</td>
                            <td>{{$queue->patient->phone}}</td>
                            <td>{{$queue->patient->soc_card}}</td>

                            <td>{{$queue->department->name ?? '--//--'}}</td>
                            <td>{{$queue->user->full_name ?? '--//--'}}</td>

                            <td>
                                <form action='{{route("reception_queues.destroy", ["reception_queue" =>$queue])}}' method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-confirmable" type="submit" data-confirm="Դուք պատրաստվում եք հերթից հեռացնել ընտրված հիվանդին:">Ավարտել</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        @endforelse
                    </tbody>

                </table>
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
        const queueTable = $('#queue-table').DataTable({
            "language": window.dt.hy,
            columnDefs: [
                {
                    "targets": [ 0 ],
                    "orderable": false,
                    "sortable": false,
                },
            ],
        });

        $('#queue-table tbody').on('click', 'tr td.details-control', function () {
            var tr = $(this).closest('tr');
            var row = queueTable.api().row(tr);

            var closeDetails = $(this).find('.dt-close-details');
            var openDetails = $(this).find('.dt-open-details');
            var rowData = row.data();
            var comment = $(this).data('comment');
            // console.log(row.data());
            // console.log(comment);

            if ( row.child.isShown() ) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
                closeDetails.addClass('d-none');
                openDetails.removeClass('d-none');
            }
            else {
                // Open this row
                // row.child( format(rowData) ).show();
                row.child( format(comment) ).show();
                tr.addClass('shown');
                closeDetails.removeClass('d-none');
                openDetails.addClass('d-none');
            }
        });
    });

    function format(rowData) {
        // return `<p>${rowData[3] || "Մեկնաբանություններ չկան։"}</p>`;
        return `<p class="border border-secondary rounded p-3">${rowData || "Մեկնաբանություններ չկան։"}</p>`;
    }


</script>
@endsection
