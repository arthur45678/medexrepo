{{--pharmacy--}}
@extends('layouts.base')
@section('content')

    {{--    $pharmacy--}}


    {{--        <td scope="col" >Քանակ <span style="float: right">Գումար</span></td>--}}

    <?php
    $d = scandir(public_path('Warehouse'), SCANDIR_SORT_NONE );
    $count=count($d)-2;
    ?>

    <div class="container-fluid">
@if(session()->has('warning'))
    <p align="right">Այդ ֆայլը արդեն ավելացված է</p>
    @endif
        <div class="fade-in">
            <div class="row">
                <form action="{{route('wareHouse.warehouses.store')}}" id="xml" method="post" enctype="multipart/form-data">
                    @csrf
                    <button type="submit" class="btn btn-primary float-right mr-4" {{ $count>0 ? "" : "disabled" }}>
                        <x-svg icon="cui-reload" />
                        Թարմացնել {{$count}}
                    </button>


                </form>
                <div class="card col-12">

                    <div class="card-body" style="overflow-x:scroll;">
                        <table id="receivedReferrals" class="table table-md table-hover table-cursor ">
                            <thead class="thead-info">
                            <tr>
                                <td colspan="2" class="text-center">Միավորի արժեքը</td>
                                <td colspan="2" class="text-center">Նյութերի, ապրանքների</td>
                                <td rowspan="2" class="text-center">Չափման միավորը</td>
                                <td rowspan="2" class="text-center">Բաց թողնված քանակը</td>
                                <td rowspan="2" class="text-center">Միավորի արժեքը</td>
                                <td rowspan="2" class="text-center">Գումարը</td>
                            </tr>
                            <tr>
                                <td class="text-center">մուտքի հաշիվ, ենթահաշիվ</td>
                                <td class="text-center">ելքի հաշիվ, ենթահաշիվ</td>
                                <td class="text-center">անվանումը, բնութագիրը</td>
                                <td class="text-center">ծածկագիրը</td>

                            </tr>
                            <tr align="center">
                                <td>1</td>
                                <td>2</td>
                                <td>3</td>
                                <td>4</td>
                                <td>5</td>
                                <td>6</td>
                                <td>7</td>
                                <td>8</td>

                            </tr>
                            </thead>

                            <tbody>

                            @foreach($warehouse as $warehouses)
                                <tr align="center">

                                    <td>*</td>
                                    <td>{{$warehouses->exit}}</td>
                                    <td>{{$warehouses->NMV->name ?? ' '}}</td>
                                    <td>{{$warehouses->code}}</td>
                                    <td>{{$warehouses->NMV->unit ?? ''}}</td>
                                    <td>{{$warehouses->quantity}}</td>
{{--                                    <td>{{$warehouses->departament_name->name}}</td>--}}
                                    <td>{{ $warehouses->price}}</td>
                                    <td>{{$warehouses->quantity*$warehouses->price}}</td>

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
