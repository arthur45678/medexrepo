{{--pharmacy--}}
@extends('layouts.base')
@section('content')

<?php
    $d = scandir(public_path('MedicineTransfer'), SCANDIR_SORT_NONE );
    $count=count($d)-2;
?>

<div class="container-fluid">
    <div class="fade-in">
        <div class="row">
            @isset($pharmacys)
                @include('pharmacy.include.search')
            @else
                @isset($pharmacy)
                    @include('pharmacy.include.base')
                @endisset
            @endisset
        </div>
    </div>
</div>

@endsection
@section('javascript')
    <script src="{{ mix('js/jquery.js') }}"></script>
    <script src="{{ mix('js/all.magicsearch.js') }}"></script>
    <script src="{{ mix('/js/components/Select.js')}}"></script>
    <script src="{{ mix('js/datatables.js') }}"></script>
    <script src="{{ mix('js/tooltips.js') }}"></script>
    <script>
        var userId = {{ auth()->id() }};
        var dataTable = $("#receivedReferrals").CDataTable();
        console.log(window.Laravel.user.id);
    </script>
@endsection
@section('css')
    <link href="{{ mix('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{mix("/css/jquery.magicsearch.min.css")}}" rel="stylesheet"/>
@endsection
