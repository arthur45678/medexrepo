<!--
    this pahe is pane-content of Չմակագրված
    need params: $department $doc_pane_id $doc_queues
    optional params: $single - only for separated doctor's queue
-->
<div class="tab-pane {{$single ?? ''}}" id="{{$doc_pane_id}}" role="tabpanel">
    <div class="card">
        <div class="card-header">
            <h5 class="text-center">{{date('d/m/Y')}}</h5>
        </div>
        <div class="card-body x-overflow-auto">
            @if (!isset($single))
            <h6 class="card-title">բժիշկ՝ {{$doc->full_name}}</h6>
            @endif
            <table id="doc_table_1" class="table table-hover table-bordered" style="width:100%;">
                <thead>
                    <tr>
                        <th>№</th>
                        <th>Ուղեգրի №</th>
                        <th>Ամսաթիվ</th>
                        <th>Հիվանդ</th>
                        <th>Շտապ</th>
                        {{-- <th>Ծառ. կոդ/վճարման տեսակ</th> --}}
                        <th class="text-center">Գործողություններ</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($doc_queues as $q_key => $queue)
                        <tr @if($queue->is_urgent) class="table-danger" @endif>
                            {{-- <td>{{$queue->number}}</td> --}}
                            <td>{{$q_key + 1}}</td>
                            <td>{{$queue->referral_id}}</td>
                            <td>{{$queue->created_at}}</td>
                            <td>{{$queue->referral->patient->full_name}}</td>
                            <td class="text-center">{{$queue->is_urgent ? 'Այո' : 'Ոչ'}}</td>
                            <td>
                                <form id="qdform_{{$q_key}}" class="form-inline justify-content-center"
                                    method="POST" action='{{route("departments.queues.delete")}}' onsubmit="approveDeletion()">
                                    @csrf
                                    <input type="hidden" name="queue_id" value="{{$queue->id}}">
                                    <button class="btn btn-danger mr-1 btn-confirmable" type="submit" data-confirm="Դուք պատրաստվում եք հերթից հեռացնել ընտրված հիվանդին:">Ավարտել</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                    @endforelse
                </tbody>
                <tfoot>
                    <tr>
                        <th>№</th>
                        <th>Ուղեգրի №</th>
                        <th>Ամսաթիվ</th>
                        <th>Հիվանդ</th>
                        <th>Շտապ</th>
                        {{-- <th>Ծառ. կոդ/վճարման տեսակ</th> --}}
                        <th class="text-center">Գործողություններ</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
