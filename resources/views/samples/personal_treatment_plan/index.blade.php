@extends('layouts.cardBase')

@section('css')
    <link href="{{ mix('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"/>
@endsection

@section('card-header')
    <div>
        <h4>ԱՆՀԱՏԱԿԱՆ ԲՈՒԺՄԱՆ ՊԼԱՆ</h4>
        {{--        <h5>{{ $patient->all_names }}</h5>--}}
    </div>
    <div class="card-header-actions">
        <a href="{{route('samples.patients.personal-treatment-plan.create',$patent)}}" class="btn btn-primary float-right mr-4"
           type="button">
            <x-svg icon="cui-plus"/>
            Նոր ԱՆՀԱՏԱԿԱՆ ԲՈՒԺՄԱՆ ՊԼԱՆ
        </a>
    </div>
@endsection

@section('card-content')
    @if(session()->has('ok'))
        <div class="card-body">
            <div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Հաջողություն!</strong> Ֆայլը ջնջված է.
                <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
        </div>
    @endif
    <table class="table table-striped table-bordered table-cursor datatable-default">
        <thead>
        <tr>
            <th>ID</th>
            <th>Ամսաթիվ</th>
            <th>Գործողություններ</th>
        </tr>
        </thead>
        <tbody>

        @foreach ($plan as $em)
            <tr>
                <td>
                    {{ $em->id }}
                </td>
                <td>
                    {{ $em->created_at }}
                </td>
                <td>
                    <a href="{{ route('samples.patients.personal-treatment-plan.show', [$patent->id , $em->id]) }}" class="btn btn-success btn-sm">
                        <x-svg icon="cui-external-link"/>
                        {{--                        show--}}
                    </a>

                    @if($em->user_id==auth()->id())
                    <a href="{{ route('samples.patients.personal-treatment-plan.edit', [$patent->id , $em->id]) }}" class="btn btn-primary btn-sm">
                        <x-svg icon="cui-pencil"/>
                    </a>
                    <form method="POST" action="{{route('samples.patients.personal-treatment-plan.destroy', [$patent->id , $em->id]) }}" class="d-inline">
                        @csrf
                        @method('delete')

                        <button class="btn btn-danger btn-sm" >
                            <x-svg icon="cui-trash" />
                        </button>
                    </form>
                    @endif
                    @if($em->approvement!=null)
                    @can('user-can-approve', $em)

                        <form method="POST" action="{{ route("approvements.update",$em->approvement) }}" class="d-inline">
                            @csrf
                            @method("PATCH")
                            <button class="btn btn-success btn-sm" {{ $em->approvement->status ? "disabled" : "" }}>
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
