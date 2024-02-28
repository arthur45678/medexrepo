@extends('layouts.cardBase')

@section('css')
    <link href="{{ mix('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"/>
@endsection

@section('card-header')
    <div>
        <h4>ՍՏԱՑԻՈՆԱՐ ՀԻՎԱՆԴԻ ՀԱՇՎԱՌՄԱՆ ԳՐԱՆՑԱՄԱՏՅԱՆ</h4>
        <h5>{{ $patient->all_names }}</h5>
    </div>
    <div class="card-header-actions">
        <a href="{{ route("samples.patients.stationary-inpatient-register.create", ['patient' => $patient]) }}"
           class="btn btn-primary float-right mr-4" type="button">
            <x-svg icon="cui-plus"/>
            Նոր ՀԱՇՎԱՌՄԱՆ
        </a>
    </div>
@endsection

@section('card-content')
    @if(session()->has('ok'))
        <div class="card-body">
            <div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Հաջողություն!</strong>
                Ֆայլը ջնջված է.
                <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
            </div>
        </div>
    @endif
    <table class="table table-striped table-bordered table-cursor datatable-default">
        <thead>
        <tr>
            <th>ID</th>
            <th>Ամսաթիվ</th>
            <th>Բուժող բժիշկ</th>
            <th>Կարգավիճակ</th>
            <th>Գործողություններ</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($inpatient as $im)
            <tr data-url="{{ route("samples.patients.biochemical-lab-n1.show", ['patient' => $patient , 'biochemical_lab_n1' => $im]) }}">
                <td>
                    {{ $im->id }}
                </td>
                <td>
                    {{ $im->date}}
                </td>

                <td>
                    {{ $im->Doctor->full_name ?? ''}}
                </td>
                <td>
                    {{ optional($im->approvement)->status  ? "Հաստատված" : "Սպասման մեջ"}}
                    {{ $im->approvementStatus() }}
                </td>
                <td>
                    <a href="{{ route('samples.patients.stationary-inpatient-register.show', [$patient->id , $im->id]) }}"
                       class="btn btn-info btn-sm">
                        <x-svg icon="cui-external-link"/>
                    </a>
                    @if($im->user_id==auth()->id())

                        <a href="{{ route('samples.patients.stationary-inpatient-register.edit', [$patient->id , $im->id]) }}"
                           class="btn btn-primary btn-sm">
                            <x-svg icon="cui-pencil"/>
                        </a>



                        <form method="POST" action="{{route('samples.patients.stationary-inpatient-register.destroy', [$patient->id , $im->id]) }}" class="d-inline">
                            @csrf
                            @method('delete')

                            <button class="btn btn-danger btn-sm" >
                                <x-svg icon="cui-trash" />
                            </button>
                        </form>
                    @endif
                    @if($im->approvement!=null)
                    @can('user-can-approve', $im)

                        <form method="POST" action="{{ route("approvements.update",$im->approvement) }}" class="d-inline">
                            @csrf
                            @method("PATCH")
                            <button class="btn btn-success btn-sm" {{ $im->approvement->status ? "disabled" : "" }}>
                                <x-svg icon="cui-check" />
                            </button>
                        </form>
                    @endcan
                        @endif
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
