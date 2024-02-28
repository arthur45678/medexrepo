@extends('layouts.cardBase')

@section('css')
    <link href="{{ mix('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('card-header')
    <div>
        <h4>Ամբուլատոր քարտ</h4>
        <h6 class="pt-1">{{$patient->all_names}} | {{$patient->soc_card}}</h6>
    </div>
    <div class="card-header-actions">

    </div>
@endsection

@section('card-content')

    <table class="table table-striped table-bordered datatable-default">
        <thead>
        <tr>
            <th>Անվանում</th>
            <th>Լրացրել է</th>
            <th>Կարգավիճակ</th>
            <th>Գործողություններ</th>

        </tr>
        </thead>
        <tbody>
        @foreach($approvementdiagnoses->tnms as $tnms)

            <tr>
                <td>
                    TNM
                </td>
                <td>
                    {{$tnms->user->full_name ?? ' '}}
                </td>
                @if($tnms->approvement)
                    <td>
                        {{ optional($tnms->approvement)->status  ? "Հաստատված" : "Սպասման մեջ"}}
                        {{ $tnms->approvementStatus() }}
                    </td>
                @else
                    <td>
                        Չհաստատված
                    </td>
                @endif
                <td>

                    @if($tnms->approvement)
                        @can('user-can-approve', $tnms)
                            <form method="POST"
                                  action="{{ route("approvements.update", ["approvement" => $tnms->approvement]) }}"
                                  class="d-inline">
                                @csrf
                                @method("PATCH")
                                <button
                                    class="btn btn-success btn-sm" {{ $tnms->approvement->status ? "disabled" : "" }}>
                                    <x-svg icon="cui-check"/>
                                </button>
                            </form>
                        @endcan
                    @endif
                    {{--                        ambulator.delete_diagnosis--}}
                    @can('belongs-to-user', $tnms)
                        <form method="POST" action="{{route('ambulator.trash', ['tnms',$tnms->id]) }}" class="d-inline">
                            @csrf

                            <button class="btn btn-danger btn-sm"  >
                                <x-svg icon="cui-trash" />
                            </button>
                        </form>
                    @endcan
                        <a href="{{url('patients/'.$approvementdiagnoses->patient_id.'/ambulator/'.$approvementdiagnoses->id.'#ambulator-tnms')}}" target="_blank" class="btn btn-info btn-sm">
                            <x-svg icon="cui-external-link" />
                        </a>


                </td>
            </tr>
        @endforeach

        @foreach($approvementdiagnoses->diagnoses as $diagnose)

            <tr>
                <td>
                     @if($diagnose->type=='preliminary') Նախնական ախտորոշում
                     @elseif($diagnose->type=='final') Վերջնական ախտորոշում
                     @elseif($diagnose->type=='previous') Ինչ հիվանդություններով է հիվանդացել
                         @endif
                </td>
                <td>
                    {{$diagnose->user->full_name ?? ' '}}
                </td>
                @if($diagnose->approvement)
                    <td>
                        {{ optional($diagnose->approvement)->status  ? "Հաստատված" : "Սպասման մեջ"}}
                        {{ $diagnose->approvementStatus() }}
                    </td>
                @else
                    <td>
                        Չհաստատված
                    </td>
                @endif
                <td>
                    @if($diagnose->approvement)
                        @can('user-can-approve', $diagnose)
                            <form method="POST"
                                  action="{{ route("approvements.update", ["approvement" => $diagnose->approvement]) }}"
                                  class="d-inline">
                                @csrf
                                @method("PATCH")
                                <button
                                    class="btn btn-success btn-sm" {{ $diagnose->approvement->status ? "disabled" : "" }}>
                                    <x-svg icon="cui-check"/>
                                </button>
                            </form>
                        @endcan
                    @endif
{{--                        ambulator.delete_diagnosis--}}
                        @can('belongs-to-user', $diagnose)
                            <form method="POST" action="{{route('ambulator.trash', ['attendances',$diagnose->id]) }}" class="d-inline">
                                @csrf

                                <button class="btn btn-danger btn-sm"  >
                                    <x-svg icon="cui-trash" />
                                </button>
                            </form>
                        @endcan

                        @if($diagnose->type=='preliminary')
                            <a href="{{url('patients/'.$approvementdiagnoses->patient_id.'/ambulator/'.$approvementdiagnoses->id.'#preliminary_diagnosis')}}" class="btn btn-info btn-sm">
                                <x-svg icon="cui-external-link" />
                            </a>

                        @elseif($diagnose->type=='final')
                            <a href="{{url('patients/'.$approvementdiagnoses->patient_id.'/ambulator/'.$approvementdiagnoses->id.'#final_diagnosis')}}" class="btn btn-info btn-sm">
                                <x-svg icon="cui-external-link" />
                            </a>
                        @elseif($diagnose->type=='previous')
                            <a href="{{url('patients/'.$approvementdiagnoses->patient_id.'/ambulator/'.$approvementdiagnoses->id.'#last_disease')}}" class="btn btn-info btn-sm">
                                <x-svg icon="cui-external-link" />
                            </a>
                        @endif

                </td>
            </tr>
                @endforeach

        @foreach($approvementdiagnoses->attendances as $attendances)

            <tr>
                <td>
                    Հաճախումների հսկողություն
                </td>
                <td>
                    {{$attendances->user->full_name ?? ' '}}
                </td>
                @if($attendances->approvement)
                    <td>
                        {{ optional($attendances->approvement)->status  ? "Հաստատված" : "Սպասման մեջ"}}
                        {{ $attendances->approvementStatus() }}
                    </td>
                @else
                    <td>
                    Չհաստատված
                    </td>
                @endif
                <td>
                    @if($attendances->approvement)
                        @can('user-can-approve', $attendances)
                            <form method="POST"
                                  action="{{ route("approvements.update", ["approvement" => $attendances->approvement]) }}"
                                  class="d-inline">
                                @csrf
                                @method("PATCH")
                                <button
                                    class="btn btn-success btn-sm" {{ $attendances->approvement->status ? "disabled" : "" }}>
                                    <x-svg icon="cui-check"/>
                                </button>
                            </form>
                        @endcan
                    @endif
{{--                        ambulator.delete_diagnosis--}}
                        @can('belongs-to-user', $attendances)
                            <form method="POST" action="{{route('ambulator.trash', ['diagnoses',$attendances->id]) }}" class="d-inline">
                                @csrf

                                <button class="btn btn-danger btn-sm"  >
                                    <x-svg icon="cui-trash" />
                                </button>
                            </form>
                        @endcan
                        <a href="{{url('patients/'.$approvementdiagnoses->patient_id.'/ambulator/'.$approvementdiagnoses->id.'#ambulator-attendances')}}" class="btn btn-info btn-sm">
                            <x-svg icon="cui-external-link" />
                        </a>



                </td>
            </tr>
                @endforeach

        @foreach($approvementdiagnoses->complaints as $complaints)

            <tr>
                <td>
                     Հիվանդի Գանգատներ
                </td>
                <td>
                    {{$complaints->user->full_name ?? ' '}}
                </td>
                @if($complaints->approvement)
                    <td>
                        {{ optional($complaints->approvement)->status  ? "Հաստատված" : "Սպասման մեջ"}}
                        {{ $complaints->approvementStatus() }}
                    </td>
                @else
                    <td>
                        Չհաստատված
                    </td>
                @endif

                <td>
                    @if($complaints->approvement)
                        @can('user-can-approve', $complaints)
                            <form method="POST"
                                  action="{{ route("approvements.update", ["approvement" => $complaints->approvement]) }}"
                                  class="d-inline">
                                @csrf
                                @method("PATCH")
                                <button
                                    class="btn btn-success btn-sm" {{ $complaints->approvement->status ? "disabled" : "" }}>
                                    <x-svg icon="cui-check"/>
                                </button>
                            </form>
                        @endcan
                    @endif

{{--                        ambulator.delete_diagnosis--}}
                        @can('belongs-to-user', $complaints)
                            <form method="POST" action="{{route('ambulator.trash', ['complaints',$complaints->id]) }}" class="d-inline">
                                @csrf

                                <button class="btn btn-danger btn-sm"  >
                                    <x-svg icon="cui-trash" />
                                </button>
                            </form>
                        @endcan
                        <a href="{{url('patients/'.$approvementdiagnoses->patient_id.'/ambulator/'.$approvementdiagnoses->id.'#last_disease')}}" class="btn btn-info btn-sm">
                            <x-svg icon="cui-external-link" />
                        </a>

                </td>
            </tr>
                @endforeach

       <?php $female_issues=$approvementdiagnoses->female_issues ?>
        @if($female_issues!=null)
            <tr>
                <td>
                    Կանացի տվյալներ

                </td>
                <td>
                    {{$female_issues->user->full_name ?? ' '}}
                </td>
                @if($female_issues->approvement)
                    <td>
                        {{ optional($female_issues->approvement)->status  ? "Հաստատված" : "Սպասման մեջ"}}
                        {{ $female_issues->approvementStatus() }}
                    </td>
                @else
                    <td>
                        Սպասման մեջ
                    </td>
                @endif
                <td>
                    @if($female_issues->approvement)
                        @can('user-can-approve', $female_issues)
                            <form method="POST"
                                  action="{{ route("approvements.update", ["approvement" => $female_issues->approvement]) }}"
                                  class="d-inline">
                                @csrf
                                @method("PATCH")
                                <button
                                    class="btn btn-success btn-sm" {{ $female_issues->approvement->status ? "disabled" : "" }}>
                                    <x-svg icon="cui-check"/>
                                </button>
                            </form>
                        @endcan
                    @endif
{{--                        ambulator.delete_diagnosis--}}
                        @can('belongs-to-user', $female_issues)
                            <form method="POST" action="{{route('ambulator.trash', ['female_issues',$female_issues->id]) }}" class="d-inline">
                                @csrf

                                <button class="btn btn-danger btn-sm"  >
                                    <x-svg icon="cui-trash" />
                                </button>
                            </form>
                        @endcan
                        <a href="{{url('patients/'.$approvementdiagnoses->patient_id.'/ambulator/'.$approvementdiagnoses->id.'#ambulator-female-issues')}}" class="btn btn-info btn-sm">
                            <x-svg icon="cui-external-link" />
                        </a>


                </td>
            </tr>
        @endif
        @foreach($approvementdiagnoses->tumor_infos as $tumor_infos)

            <tr>
                <td>
                    Ուռուցքի նկարագրություն, տեղակայումը
                    {{$tumor_infos->type}}
                </td>
                <td>
                    {{$tumor_infos->user->full_name ?? ' '}}
                </td>
                @if($tumor_infos->approvement)
                    <td>
                        {{ optional($tumor_infos->approvement)->status  ? "Հաստատված" : "Սպասման մեջ"}}
                        {{ $tumor_infos->approvementStatus() }}
                    </td>
                @else
                    <td>
                        Չհաստատված
                    </td>
                @endif
                <td>
                    @if($tumor_infos->approvement)
                        @can('user-can-approve', $tumor_infos)
                            <form method="POST"
                                  action="{{ route("approvements.update", ["approvement" => $tumor_infos->approvement]) }}"
                                  class="d-inline">
                                @csrf
                                @method("PATCH")
                                <button
                                    class="btn btn-success btn-sm" {{ $tumor_infos->approvement->status ? "disabled" : "" }}>
                                    <x-svg icon="cui-check"/>
                                </button>
                            </form>
                        @endcan
                    @endif
                    {{--                        ambulator.delete_diagnosis--}}
                    @can('belongs-to-user', $tumor_infos)
                        <form method="POST" action="{{route('ambulator.trash', ['tumor_infos',$tumor_infos->id]) }}" class="d-inline">
                            @csrf

                            <button class="btn btn-danger btn-sm"  >
                                <x-svg icon="cui-trash" />
                            </button>
                        </form>
                    @endcan
                        <a href="{{url('patients/'.$approvementdiagnoses->patient_id.'/ambulator/'.$approvementdiagnoses->id.'#ambulator-tumor-infos')}}" class="btn btn-info btn-sm">
                            <x-svg icon="cui-external-link" />
                        </a>


                </td>
            </tr>
        @endforeach
        @foreach($approvementdiagnoses->onset_and_developments as $onset_and_developments)

            <tr>
                <td>

                    Հիվանդության հանդես գալը, զարգացումը

                </td>
                <td>
                    {{$onset_and_developments->user->full_name ?? ' '}}
                </td>
                @if($onset_and_developments->approvement)
                    <td>
                        {{ optional($onset_and_developments->approvement)->status  ? "Հաստատված" : "Սպասման մեջ"}}
                        {{ $onset_and_developments->approvementStatus() }}
                    </td>
                @else
                    <td>
                        Չհաստատված
                    </td>
                @endif
                <td>
                    @if($onset_and_developments->approvement)
                        @can('user-can-approve', $onset_and_developments)
                            <form method="POST"
                                  action="{{ route("approvements.update", ["approvement" => $onset_and_developments->approvement]) }}"
                                  class="d-inline">
                                @csrf
                                @method("PATCH")
                                <button
                                    class="btn btn-success btn-sm" {{ $onset_and_developments->approvement->status ? "disabled" : "" }}>
                                    <x-svg icon="cui-check"/>
                                </button>
                            </form>
                        @endcan
                    @endif
                    {{--                        ambulator.delete_diagnosis--}}
                    @can('belongs-to-user', $onset_and_developments)
                        <form method="POST" action="{{route('ambulator.trash', ['onset_and_developments',$onset_and_developments->id]) }}" class="d-inline">
                            @csrf

                            <button class="btn btn-danger btn-sm"  >
                                <x-svg icon="cui-trash" />
                            </button>
                        </form>
                    @endcan
                        <a href="{{url('patients/'.$approvementdiagnoses->patient_id.'/ambulator/'.$approvementdiagnoses->id.'#ambulator-onset-and-developments')}}" class="btn btn-info btn-sm">
                            <x-svg icon="cui-external-link" />
                        </a>


                </td>
            </tr>
        @endforeach

        @foreach($approvementdiagnoses->health_statuses as $health_statuses)

            <tr>
                <td>
                    Հիվանդի Վիճակը, նշանակումները
                </td>
                <td>
                    {{$health_statuses->user->full_name ?? ' '}}
                </td>
                @if($health_statuses->approvement)
                    <td>
                        {{ optional($health_statuses->approvement)->status  ? "Հաստատված" : "Սպասման մեջ"}}
                        {{ $health_statuses->approvementStatus() }}
                    </td>
                @else
                    <td>
                        Չհաստատված
                    </td>
                @endif
                <td>
                    @if($health_statuses->approvement)
                        @can('user-can-approve', $health_statuses)
                            <form method="POST"
                                  action="{{ route("approvements.update", ["approvement" => $health_statuses->approvement]) }}"
                                  class="d-inline">
                                @csrf
                                @method("PATCH")
                                <button
                                    class="btn btn-success btn-sm" {{ $health_statuses->approvement->status ? "disabled" : "" }}>
                                    <x-svg icon="cui-check"/>
                                </button>
                            </form>
                        @endcan
                    @endif
                    {{--                        ambulator.delete_diagnosis--}}
                    @can('belongs-to-user', $health_statuses)
                        <form method="POST" action="{{route('ambulator.trash', ['health_statuses',$health_statuses->id]) }}" class="d-inline">
                            @csrf

                            <button class="btn btn-danger btn-sm"  >
                                <x-svg icon="cui-trash" />
                            </button>
                        </form>
                    @endcan
                        <a href="{{url('patients/'.$approvementdiagnoses->patient_id.'/ambulator/'.$approvementdiagnoses->id.'#ambulator-health-statuses')}}" class="btn btn-info btn-sm">
                            <x-svg icon="cui-external-link" />
                        </a>


                </td>
            </tr>
        @endforeach



        </tbody>
    </table>

@endsection

@section('javascript')
    <script src="{{ mix('js/jquery.js') }}"></script>
    <script src="{{ mix('js/datatables.js') }}"></script>
@endsection

