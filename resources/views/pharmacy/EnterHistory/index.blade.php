{{--pharmacy--}}
@extends('layouts.base')
@section('content')

    {{--    $pharmacy--}}


    {{--        <td scope="col" >Քանակ <span style="float: right">Գումար</span></td>--}}



    <div class="container-fluid">

        <div class="fade-in">
            <div class="row">
                <div class="card col-12">
                    <div class="card-header">Որոնել օրով


                                    <div class="col-4">
                                        <form method="POST" action="{{route('pharmacy.Searchmedication',$id)}}"
                                              class="d-inline">
                                            @csrf
                                            @isset($date)
                                            <input type="date" name="date" value="{{$date}}">
                                            @else
                                            <input type="date" name="date" value="{{\Illuminate\Support\Carbon::parse(\Illuminate\Support\Carbon::now()->startOfMonth())->format('Y-m-d')}}">
                                            @endif
                                            <button class="btn btn-secondary" >Search</button>
                                        </form>


                                    </div>
                    </div>
                    <div class="card-body" style="overflow-x:scroll;">
                        <table id="receivedReferrals" class="table table-md table-hover table-cursor ">
                            <thead class="thead-info">
                            <tr>
                                <td class="text-center"></td>
                                <td class="text-center">ԱՆՎԱՆՈՒՄԸ</td>
                                <td class="text-center">Բաժանմունք</td>
                                <td class="text-center">ՄՈՒՏՔ</td>
                                <td class="text-center">Ժամ</td>
                            </tr>

                            </thead>
                            <tbody>

                            @foreach($pharmacy as $k=>$pharmacys)
                                <tr>
                                    <td>{{$k+1}}</td>
                                    <td>{{$pharmacys->medicine_name->name}}</td>
                                    <td>{{$pharmacys->departament_name->name}}</td>
                                    <td>{{$pharmacys->enter}} </td>
                                    <td>{{$pharmacys->created_at->format('y-m-d H:i')}} </td>
                                </tr>
                            @endforeach
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
    <script src="{{ mix('js/all.magicsearch.js') }}"></script>
    <script src="{{ mix('/js/components/Select.js')}}"></script>
    <script src="{{ mix('js/datatables.js') }}"></script>
    {{-- <script src="{{ mix('js/broadcast.js') }}"></script> --}}
    <script src="{{ mix('js/tooltips.js') }}"></script>
    <script>
        var userId = {{ auth()->id() }};
        var dataTable = $("#receivedReferrals").CDataTable();

        console.log(window.Laravel.user.id);

        // console.log(userId);
        // Echo.private("App.User." + userId).listen("ReferralReceivedEvent", function(e){
        //     console.log(e);
        //     // dataTable.row.add([e.referral.date_with_diff, e.referral.sender.full_name, "---"]).draw(false);
        // });

        // Echo.channel("referrals-channel").listen("ReferralAcceptedEvent", (e) => {
        //     console.log(e);
        //     alert("AMANA KUKARELA");
        // });
    </script>
@endsection
@section('css')
    <link href="{{ mix('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{mix("/css/jquery.magicsearch.min.css")}}" rel="stylesheet"/>
    <style>
        /*td {*/
        /*    border: 0.1px solid black;*/
        /*}*/
    </style>
@endsection
