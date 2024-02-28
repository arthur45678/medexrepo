@extends('layouts.base')

@section('css')
<link href="{{ mix('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
{{-- @dump($referral_services) --}}

<div class="container-fluid">
    <div class="fade-in">
        <div class="row">
            <div class="card col-12">
                <div class="card-header">Կատարած Ծառայություններ</div>
                <div class="card-body">
                    <table class="datatable-services table table-md table-hover" style="width:100%;">
                        <thead class="thead-info">
                            <tr>
                                <th>ID</th>
                                <th>Հիվանդի Ա․Ա․Հ․</th>
                                <th>Հծհհ</th>
                                <th>Բաժին</th>
                                <th>Բժիշկ</th>
                                <th>Ծառայության կոդ/անվանում</th>
                                <th>Ծառայության գին</th>
                                <th>Վճարման տեսակ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($referral_services as $item)
                                <tr>
                                    <td>{{$item->id}} {{$item->created_at}}</td>
                                    <td>{{$item->patient->all_names}}</td>
                                    <td>{{$item->patient->soc_card}}</td>
                                    <td>{{$item->sender->full_name}}</td>
                                    <td>{{$item->sender->department->name}}</td>
                                    <td title='{{$item->serviceable->name}}'>
                                        {{$item->serviceable->code}} - {{$item->serviceable->name}}
                                    </td>
                                    <td>{{$item->serviceable->cost}} դրամ</td>
                                    <td>{{__("enums.service_payment_type_enum.{$item->payment_type}")}}</td>
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
    <script>
        const dataTable = $(".datatable-services").CDataTable({
            "order": [[ 0, "desc" ]]
        });
    </script>
@endsection
