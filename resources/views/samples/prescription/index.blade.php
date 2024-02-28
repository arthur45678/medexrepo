@extends('layouts.cardBase')

@section('css')
    <link href="{{ mix('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"/>
@endsection

@section('card-header')
    <div>
        <h4>Նշանակման թերթիկ</h4>
        {{--        <h5>{{ $patient->all_names }}</h5>--}}
    </div>
    <div class="card-header-actions">
        <a href="{{route('samples.patients.assignment_sheet.create',$patients)}}"
           class="btn btn-primary float-right mr-4" type="button">
            <x-svg icon="cui-plus"/>
            Նոր Նշանակման թերթիկ
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

        @foreach ($sheet as $em)
            <tr>
                <td>
                    {{ $em->id }}
                </td>
                <td>
                    {{ $em->created_at }}
                </td>
                <td>
                    {{ $em->attending_doctor->full_name }}
                </td>
                <td>

                        {{ optional($em->approvement)->status  ? "Հաստատված" : "Սպասման մեջ"}}
                        {{ $em->approvementStatus() }}

                </td>
                <td>

                    <a href="{{route('samples.sheetshow',$em->id) }}" class="btn btn-info btn-sm">
                        <x-svg icon="cui-external-link"/>
                        {{--                        show--}}
                    </a>

                    {{--                    @can('belongs-to-user', $em)--}}

                    @if($em->created_at->format('d-m-d') == \Illuminate\Support\Carbon::today()->format('d-m-d'))

                        @if($em->user_id == auth()->id())
                            <a href="{{route('samples.sheetEdit',$em->id)}}" class="btn btn-primary btn-sm">
                                <x-svg icon="cui-pencil"/>
                            </a>
                        @endif
                    @endif
                    <?php
                    $user_dipatment_id = $em->attending_doctor->department_id;

                    ?>
                    @if(auth()->user()->hasRole('head_nurse') and auth()->user()->department_id==$user_dipatment_id)
                        <a href="{{route('samples.sieorsheetEdit',$em->id)}}" class="btn btn-primary btn-sm">
                            <x-svg icon="cui-pencil"/>
                        </a>
                    @endif


                    @if($em->user_id == auth()->id())

                        <form method="POST" action="{{route('samples.sheetdestroy',$em->id) }}" class="d-inline">
                            @csrf
                            <button class="btn btn-success btn-sm"
                                   >
{{--                                title="Chem, sarqel petq e petq e jnjeluc sat gortcoxutyuner ani"--}}
                                <x-svg icon="cui-trash"/>
                            </button>
                        </form>
                    @endif

                        @can('user-can-approve', $em)

                            <form method="POST" action="{{ route("approvements.update",$em->approvement) }}"
                                  class="d-inline">
                                @csrf
                                @method("PATCH")
                                <button class="btn btn-success btn-sm" {{ $em->approvement->status ? "disabled" : "" }}>
                                    <x-svg icon="cui-check"/>
                                </button>
                            </form>
                        @endcan

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
