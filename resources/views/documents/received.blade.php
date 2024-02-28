@extends('layouts.base')

@section('css')
<link href="{{ mix('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')

<div class="container-fluid">
    <div class="fade-in">
        <div class="row">
            <div class="card col-12">
                <div class="card-header">Ստացված փաստաթղթեր</div>
                <div class="card-body">
                    <table id="documents" class="table table-md table-hover table-cursor" style="width:100%;">
                        <thead class="thead-info">
                            <tr>
                                <th>Id</th>
                                <th>Ամսաթիվ</th>
                                <th>Անվանում</th>
                                <th>Կցված</th>
                                <th>Բաժին</th>
                                <th>Հաստիք</th>
                                <th>ՀԾՀՀ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($documents as $item)
                            <tr id={{$item['id']}} data-url={{url("/documents/$item[id]")}}>
                                <td>{{$item['id']}}</td>
                                <td>{{$item['data']}}</td>
                                <td>{{$item['document_name']}}
                                <td>
                                    @if($item['attach_document']==true)
                                    <a href="#" data-toggle="tooltip" data-placement="right"
                                        title="Շատ Կարևոր Փաստաթուղտ">
                                        <i class="cil-paperclip"></i>
                                    </a>
                                    @else
                                    <p>-</p>
                                    @endif
                                </td>
                                <td>{{$item['sending_department']}}</td>
                                <td>{{$item['sender']}}</td>
                                <td>{{$item['social_number']}}</td>
                            </tr>
                            @empty
                            @endforelse
                        </tbody>
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
<script src="{{ mix('js/broadcast.js') }}"></script>
<script src="{{ mix('js/tooltips.js') }}"></script>

<script>
    var userId = {{ auth()->id() }};

    // console.log(userId);
    Echo.private("App.User." + userId).listen("ReferralAcceptedEvent", (e) => console.log(e) );

    Echo.channel("referrals-channel").listen("ReferralAcceptedEvent", (e) => {
        console.log(e);
        alert("AMANA KUKARELA");
    });

    $(document).ready(function() {
        const patientsDt = $('#documents').DataTable({
            // responsive: true,
            "language": window.dt.hy
        });
        $('#documents tbody').on('dblclick', 'tr', function(){
            const url = $(this).data('url');
            window.open(url);
        })
    });
</script>
@endsection
