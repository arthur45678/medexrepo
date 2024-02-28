@extends('layouts.base')

@section('css')
<link href="{{ mix('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')

<div class="container-fluid">
    @php
        // dump($sentReferrals);
        // echo url()->current();
    @endphp
    <div class="fade-in">
        <div class="row">
            <div class="card col-12">
                <div class="card-header">Բաժնից ուղարկված ուղեգրեր
                    <span class="badge badge-info ml-auto h6">{{$sentReferrals->count()}}</span>
                </div>
                <div class="card-body">
                    <table id="sentReferrals" class="table table-md table-hover table-cursor" style="width:100%;">
                        <thead class="thead-info">
                            <tr>
                                <th>Փուլ</th>
                                <th>Ամսաթիվ</th>
                                <th>Ուղարկող</th>
                                <th>Ստացող</th>
                                <th>Ստացող բաժին</th>
                                <th>2 Ծառայության կոդ/վճարման տեսակ</th>
                                <th>Հիվանդի տվյալներ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($sentReferrals as $item)
                                <tr data-url={{route("referrals.patients.sent.show", $item->id)}}>
                                    <td>{!!$item->draw_referral_phase()!!}</td>
                                    <td>{{$item->date_with_diff}}</td>
                                    <td>{{$item->sender->full_name}}</td>
                                    <td>{{$item->receiver->full_name ?? 'բաժին->'}}</td>
                                    <td>{{$item->department->name}}</td>
                                    <td>
                                        @forelse ($item->referral_services as $s_key => $service)
                                            <p class="mb-2" title='{{$service->serviceable->name}}'>
                                                {{$s_key+1}}) {{$service->serviceable->code}} /
                                                {{__("enums.service_payment_type_enum.{$service->payment_type}")}}
                                            </p>
                                        @empty
                                        @endforelse
                                    </td>
                                    <td>{{$item->patient->full_name}}</td>
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
        const dataTable = $("#sentReferrals").CDataTable();
        console.log(window.Laravel.user.id);
    </script>
@endsection
