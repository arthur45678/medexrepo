@extends('layouts.base')

@section('css')
    <link href="{{ mix('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')

<div class="container-fluid">
    <div class="fade-in">
        <div class="row">
            <div class="card col-12">
                <div class="card-header">Ստացված ուղեգրեր
                    <span class="badge badge-info ml-auto">{{$receivedReferrals->count()}}</span>
                </div>
                <div class="card-body">
                    <table id="receivedReferrals" class="table table-md table-hover table-cursor" style="width:100%;">
                        <thead class="thead-info">
                            <tr>
                                <th>Nn</th>
                                <th>Ամսաթիվ</th>
                                <th>Ուղարկող</th>
                                <th>Բաժին</th>
                                <th>2 Ծառայության կոդ/վճարման տեսակ</th>
                                <th>Հիվանդի տվյալներ</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse ($receivedReferrals as $item)
                            <tr data-url={{route("referrals.patients.received.show", $item->id)}}>
                                <td>{{$item->id}}</td>
                                <td>{{$item->date_with_diff}}</td>
                                <td>{{$item->sender->full_name}}</td>
                                <td>{{$item->sender->department->name}}</td>
                                <td>
                                    @forelse ($item->referral_services as $i => $service)
                                        <p title="{{$service->serviceable->name}}">
                                            {{ $i + 1 }}) {{ $service->serviceable->code }} / {{__("enums.service_payment_type_enum.{$service->payment_type}")}}
                                            - {{$service->serviceable->cost}} դրամ
                                        </p>
                                    @empty
                                    @endforelse
                                </td>
                                <td>
                                    <a href="{{ route('patients.show', ["patient" => $item->patient]) }}">{{ $item->patient->all_names }}</a>
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
</div>

@endsection

@section('javascript')
<script src="{{ mix('js/jquery.js') }}"></script>
<script src="{{ mix('js/datatables.js') }}"></script>
<script src="{{ mix('js/tooltips.js') }}"></script>

<script>
    const userId = {{ auth()->id() }};
    const dataTable = $("#receivedReferrals").CDataTable({
        "order": [[ 0, "desc" ]]
    });
    console.log(window.Laravel.user.id);
</script>
@endsection
