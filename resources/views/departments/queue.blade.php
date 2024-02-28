@extends('layouts.base')

@section('css')
<link href="{{ mix('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')

<div class="container-fluid">
    <div class="fade-in">
        <div class="row">
            <div class="card col-12">
                {{-- <div class="card-header">Հերթագրման ցուցակ</div> --}}
                <div class="card-body">

                    @include('shared.info-box')
                    @php
                        $doc_pane_id = "doc_pane_".($doctor->id);
                        $doc_queues = $doctor->queues;
                    @endphp

                    <div class="nav-tabs-boxed">
                        <ul class="nav nav-tabs nav-queue" role="tablist" id="queue-tabs">
                            <li class="nav-item" data-toggle="tooltip" data-placement="top" title="{{$doctor->full_name}}">
                                <a class="nav-link active" data-toggle="tab" href="#{{$doc_pane_id}}" role="tab"
                                    aria-controls="{{$doc_pane_id}}">
                                    {{$doctor->full_name}}
                                    <span class="badge badge-pill badge-info">
                                        {{$doctor->queues->count()}}
                                    </span>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            @include('shared/queues/doctor_pane',[
                                'doc' => $doctor,
                                'doc_pane_id' => $doc_pane_id,
                                'doc_queues' => $doc_queues,
                                'single' => 'active'
                            ])
                        </div>
                    </div>
                </div>
                <div class="card-footer"></div>

            </div>
        </div>
    </div>
</div>

@endsection

@section('javascript')
<script src="{{ mix('js/tooltips.js') }}"></script>
<script src="{{ mix('js/jquery.js') }}"></script>
<script src="{{ mix('js/datatables.js') }}"></script>
<script>
    $(document).ready(function() {
        $('table.table').DataTable({
            "language": window.dt.hy,
        });
    });
</script>
@endsection
