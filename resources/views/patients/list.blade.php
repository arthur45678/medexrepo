@extends('layouts.cardBase')

@section('css')
<link href="{{ mix('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('card-header')
Հիվանդներ
@endsection

@section('card-content')

<table id="patients" class="table table-md table-hover table-responsive table-cursor" style="width:100%;">
    <thead class="thead-info">
        <tr>
            <th>Id</th>
            <th>Անուն</th>
            <th>Ազգանուն</th>
            <th>Հայրանուն</th>
            <th>Ծնված</th>
            <th>ՀԾՀՀ</th>
            <th>Անձնագիր</th>
            <th>Բջջային</th>
            <th>Քաղաքային</th>
            <th>Բնակավայր</th>
            <th>Քաղաք</th>
            <th>Փողոց</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($patients as $patient)
        <tr data-url={{url("/patients/{$patient->id}")}}>
            <td>{{$patient->id}}</td>
            <td>{{$patient->f_name}}</td>
            <td>{{$patient->l_name}}</td>
            <td>{{$patient->p_name}}</td>
            <td>{{$patient->birth_date}}</td>
            <td>{{$patient->soc_card}}</td>
            <td>{{$patient->passport}}</td>
            <td>{{$patient->m_phone}}</td>
            <td>{{$patient->c_phone}}</td>
            <td>{{$patient->residence_region}}</td>
            <td>{{$patient->town_village}}</td>
            <td>{{$patient->street_house}}</td>
        </tr>
        @empty
        @endforelse
    </tbody>
</table>
@endsection

@section('javascript')
<script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('js/datatables.js') }}"></script>
<script>
    window.$(document).ready(function() {
        const patientsDt = $('#patients').CDataTable();
    });
</script>
@endsection
