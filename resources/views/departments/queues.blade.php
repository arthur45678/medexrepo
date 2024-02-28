@extends('layouts.base')

@section('css')
<link href="{{ mix('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')

<div class="container-fluid">
    <div class="fade-in">
        <div class="row">
            <div class="card col-12">
                <div class="card-header">Հերթագրման ցուցակ</div>
                <div class="card-body">

                    @include('shared.info-box')

                    <div class="nav-tabs-boxed">
                        <ul class="nav nav-tabs nav-queue" role="tablist" id="queue-tabs">
                            <li class="nav-item" data-toggle="tooltip" data-placement="top" title="Բաժին">
                                <a class="nav-link active" data-toggle="tab" href="#doc_pane_0" role="tab"
                                    aria-controls="doc_pane_0">
                                    Չմակագրված
                                    <span class="badge badge-pill badge-info">
                                        {{$receivedReferrals->count()}}
                                    </span>
                                </a>
                            </li>

                            @forelse ($doctors as $d_key => $doc)
                                @php
                                    $doc_pane_id = "doc_pane_".($d_key + 1);
                                @endphp
                                {{-- @dump($doc_pane_id) --}}

                                <li class="nav-item" data-toggle="tooltip" data-placement="top" title="{{$doc->full_name}}">
                                    <a class="nav-link" data-toggle="tab" href="#{{$doc_pane_id}}" role="tab"
                                        aria-controls="{{$doc_pane_id}}">
                                        {{$doc->initials}}
                                        <span class="mx-2">
                                            {{$doc->queues->count()}}
                                        </span>
                                    </a>
                                </li>
                            @empty
                            @endforelse
                        </ul>
                        <div class="tab-content">
                            @include('shared/queues/not_asigned_pane', [
                                'department' => $department,
                                'receivedReferrals' => $receivedReferrals,
                                'doctors' => $doctors
                            ])

                            @forelse ($doctors as $d_key => $doc)
                                @php
                                    $doc_pane_id = "doc_pane_".($d_key + 1);
                                    $doc_queues = $doc->queues;
                                @endphp
                                @include('shared/queues/doctor_pane',[
                                    'doc_pane_id' => $doc_pane_id,
                                    'doc_queues' => $doc_queues
                                ])
                            @empty
                            @endforelse
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
