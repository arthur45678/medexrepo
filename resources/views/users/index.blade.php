@extends('layouts.cardBase')

@section('css')
<link href="{{ mix('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('card-header')
Բժիշկներ
@endsection

@section('card-content')

<table id="users" class="table table-md table-hover table-responsive table-cursor" style="width:100%;">
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
        @forelse ($users as $user)
        @php
            $show_user_route = isset($department) ? route('departments.user', ['department'=> $department, 'user' => $user]) : url("/users/{$user->id}");
        @endphp
        <tr data-url={{$show_user_route}}>
            <td>{{$user->id}}</td>
            <td>{{$user->f_name}}</td>
            <td>{{$user->l_name}}</td>
            <td>{{$user->p_name}}</td>
            <td>{{$user->birth_date}}</td>
            <td>{{$user->soc_card}}</td>
            <td>{{$user->passport}}</td>
            <td>{{$user->m_phone}}</td>
            <td>{{$user->c_phone}}</td>
            <td>{{$user->residence_region}}</td>
            <td>{{$user->town_village}}</td>
            <td>{{$user->street_house}}</td>
        </tr>
        @empty
        @endforelse
    </tbody>
</table>
@endsection

@section('javascript')
<script src="{{ mix('js/jquery.js') }}"></script>
<script src="{{ mix('js/datatables.js') }}"></script>
<script>
    $(document).ready(function() {
        const usersDt = $('#users').CDataTable();
    });
</script>
@endsection
