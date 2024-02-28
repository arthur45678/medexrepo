@extends('layouts.cardBase')

@section('css')
<link href="{{ mix('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <style>
        input[type=time]::-webkit-datetime-edit-ampm-field {
            display: none;
        }
        input[type=time]::-webkit-clear-button {
            -webkit-appearance: none;
            -moz-appearance: none;
            -o-appearance: none;
            -ms-appearance:none;
            appearance: none;
            margin: -10px;
        }

        /* .bootstrap-timepicker-meridian, .meridian-column {
            display: none;
        } */
    </style>
@endsection

@section('card-header')
<div>
    <h3>
        {{$department->name}}
        <small class="ml-2">{{$department_bulletin->created_at->year .' / '. $department_bulletin->created_at->getTranslatedMonthName()}}</small>
    </h3>
    <span>Աշխատաժամանակի հաշվարկի տեղեկագիր - <strong>№{{$department_bulletin->id}}</strong></span>
</div>
@endsection

@section('card-content')
<table class="table table-md table-hover table-condenced " style="width:100%;"><!-- table-cursor -->
    <thead class="thead-info">
        <tr>
            <th>Id</th>
            <th>Պաշտոն</th>
            <th>Անուն,Ազգանուն</th>
            <th>ՀՎՀՀ</th>
            @for ($i = 1; $i < 32; $i++)
                <th>{{$i}}</th>
            @endfor

            <th>
                <div>Աշխատած</div>
                <div>օր/ժամ</div>
            </th>
            <th>
                <div>Պարապուրդի</div>
                <div>օր/ժամ</div>
            </th>
            <th>Գործողություններ</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($department_bulletin->user_work_time_bulletins as $b_key => $user_bulletin)
        @php
            $user_work_time = json_decode($user_bulletin->worktime);

            $user_month_days = $user_work_time->month_days;
            $user_summary = $user_work_time->summary;

            $user_month_idle_days = $user_work_time->month_idle_days;
            $user_idle_summary = $user_work_time->idle_summary;

            $form_id = 'form_'. Str::random(13);
            $update_route = route('otherSamples.users.work-time-bulletins.update',['user'=>$user_bulletin->user->id, 'work_time_bulletin' => $user_bulletin->id]);
            $hoursToDayHour = minutesHoursToDayHour((array)$user_summary);
            $idleHoursToDayHour = minutesHoursToDayHour((array)$user_idle_summary);
        @endphp

        <tr data-url={{'/'}}>
            <td class="align-middle">
                <button class="btn btn-primary" href='#' target="_blank" form='{{$form_id}}'>
                    {{ $user_bulletin->id}}
                    <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                    <x-svg icon='cui-save' />
                </button>
            </td>
            <td class="align-middle">{{ $user_bulletin->user->position ?? '--'}}</td>
            <td class="align-middle">{{ $user_bulletin->user->full_name ?? '--'}}</td>
            <td class="align-middle">{{ $user_bulletin->user->soc_card ?? '--'}}</td>

            <form action='{{$update_route}}' method="POST" class="ajax-submitable-off" id='{{$form_id}}' novalidate>
                @csrf
                <input type="hidden" name="id" value='{{$user_bulletin->id}}'>
                @method('PUT')
                @forelse ($user_month_days as $d_key => $user_day)

                    <td class="align-middle" style="min-width:155px">
                        {{-- <label for='month_day_{{$d_key}}'>{{$d_key}}</label> --}}
                        {{-- <input type="time" value='{{$user_day}}' name='month_days[{{$d_key}}]' id='month_day_{{$d_key}}'> --}}
                        <div class="input-group my-1">
                            <div class="input-group-prepend">
                              <span class="input-group-text" title="Աշխատած ժամ:րոպե">{{$d_key}} Ա․</span>
                            </div>
                            <input type="time" value='{{$user_day}}' name='month_days[{{$d_key}}]' id='month_day_{{$b_key}}_{{$d_key}}' class="form-control">
                        </div>

                        <hr class="hr-dashed my-2">

                        <div class="input-group my-1">
                            <div class="input-group-prepend">
                              <span class="input-group-text" title="Պարապուրդի ժամ:րոպե">{{$d_key}} Պ․</span>
                            </div>
                            <input type="time" value='{{$user_month_idle_days->$d_key}}' name='month_idle_days[{{$d_key}}]' id='month_idle_day_{{$b_key}}_{{$d_key}}' class="form-control">
                        </div>
                    </td>

                @empty
                @endforelse
            </form>

            <td class="align-middle summary">
                {{$hoursToDayHour['d']}} / {{$hoursToDayHour['h']}} : {{$hoursToDayHour['m']}}
            </td>

            <td class="align-middle idle-summary">
                {{$idleHoursToDayHour['d']}} / {{$idleHoursToDayHour['h']}} : {{$idleHoursToDayHour['m']}}
            </td>

            <td class="align-middle" style="display: table-caption;">
                <button class="btn btn-primary" form='{{$form_id}}'>
                    <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                    <x-svg icon='cui-save' />
                    պահպանել
                </button>
            </td>
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
        const documentsDt = $(".table").CDataTable({
            "scrollX": true
        });
    });
</script>
@endsection
