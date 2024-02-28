@extends('layouts.AdminCardBase')

@section('css')
    <link href="{{ mix('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('card-header')
    <h3 class="text-center px-5">
        Բարի գալուստ Վ․Ա․ Ֆանարջյանի անվան ուռուցքաբանության ազգային կենտրոնի ադմին պանել։
       {{-- {{ $user->f_name }} &nbsp;{{ $user->l_name }} --}}
    </h3>
@endsection

@section('card-content')


@endsection

@section('javascript')
    <script src="{{ mix('js/jquery.js') }}"></script>
    <script src="{{ mix('js/datatables.js') }}"></script>
@endsection
