@extends('layouts.cardBase')

@section('css')
<link href="{{ mix('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('card-header')
Հիվանդներ
<div class="card-header-actions">
    @can('create patients')
{{--    <button class="btn btn-primary" data-toggle="modal" data-target="#patient-create-modal">--}}
{{--        <x-svg icon="cui-plus" />--}}
{{--    </button>--}}
    <button class="btn btn-primary" onclick="window.open('{{route('patients.create')}}')">
        <x-svg icon="cui-plus" />
    </button>
    @endcan
    @cannot('create patients')
        <button class="btn btn-secondary" disabled><x-svg icon="cui-plus" /></button>
    @endcannot
</div>
@endsection

@section('card-content')


<table class="table table-md table-hover table-responsive table-cursor" style="width:100%;"><!-- datatable-default -->
    <thead class="thead-info">
        <tr>
            <th>Id</th>
            <th>Անուն</th>
            <th>Ազգանուն</th>
            <th>Հայրանուն</th>
            <th>Ծնված</th>
            <th>ՀԾՀ</th>
            <th>Անձնագիր</th>
            <th>Սեռ</th>
            <th>Բջջային</th>
            <th>Քաղաքային</th>
            <th>Բնակավայր</th>
            <th>Քաղաք</th>
            <th>Փողոց</th>
            <th>Արխիվ</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($patients as $patient)
        @php
            $show_patient_route = isset($department) ? route('departments.patient', ['department'=> $department, 'patient' => $patient]) : url("/patients/{$patient->id}");
        @endphp
        <tr data-url={{$show_patient_route}}>
            <td>{{$patient->id}}</td>
            <td>{{$patient->f_name}}</td>
            <td>{{$patient->l_name}}</td>
            <td>{{$patient->p_name}}</td>
            <td>{{$patient->birth_date}}</td>
            <td>{{$patient->soc_card}}</td>
            <td>{{$patient->passport}}</td>
            @if($patient->is_male == 0)
                <td>Կին</td>
            @else
                <td>Տղամարդ</td>
            @endif
            <td>{{$patient->m_phone}}</td>
            <td>{{$patient->c_phone}}</td>
            <td>{{$patient->residence_region}}</td>
            <td>{{$patient->town_village}}</td>
            <td>{{$patient->street_house}}</td>
            @if($patient->archive == 0)
                <td>Ոչ</td>
            @else
                <td>Այո</td>
            @endif

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
    var dataTable = $(".table").CDataTable({
        "order": [[ 0, "desc" ]]
    });

    $("#btn-armed").click(function(e){
        const btn = $(this);

        btn.closest("form").cleanValidation();
        const ssn = $("#soc_card").val();

        btn.toggleLoading(true);

        $.ajax({
            type: "POST",
            url: "{{route('patients.load_from_armed')}}",
            data: { soc_card: ssn },
            success: function(resp){
                btn.toggleLoading();
            },
            error: function(err){
                btn.toggleLoading();
                const errors = err.responseJSON.errors;
                btn.closest("form").validateForm(errors);
            }
        }).done(function(resp) {
            for(var i in resp.user){
                btn.closest("form").find("input[name="+i+"]").val(resp.user[i]);
            }
        });
    });
</script>
@endsection
