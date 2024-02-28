@extends('layouts.cardBase')

@section('css')
    <link href="{{ mix('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"/>
@endsection

@section('card-header')
    <div>
        <h4>Էքսպրես թերթիկ</h4>
        {{--        <h5>{{ $patient->all_names }}</h5>--}}
    </div>
    <div class="card-header-actions">
        <a href="{{route('samples.patients.express-pattern.create',$patient->id)}}"
           class="btn btn-primary float-right mr-4" type="button">
            <x-svg icon="cui-plus"/>
            Նոր Էքսպրես թերթիկ
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
            <th>Parent_ID</th>
            <th>Ամսաթիվ</th>
            <th>Ուղեգրող բժշկի անուն</th>
            <th>Կարգավիճակ</th>
            <th>Հիվանդության պատմագրի №</th>
            <th>Գործողություններ</th>
        </tr>
        </thead>
        <tbody>

        @foreach ($expres as $k=>$em)
            <tr>
                <td>
                    {{ $em->id}}
                </td>
                <td>
                    {{ $em->parent_id}}
                </td>
                <td>
                    {{ $em->dateTime }}
                </td>
                <td>
                    {{ $em->attending_doctor_name->full_name }}
                </td>
                <td>
                    {{ optional($em->approvement)->status  ? "Հաստատված" : "Սպասման մեջ"}}
                    {{ $em->approvementStatus() }}
                </td>
                <td>
                    {{ $em->historian}}
                </td>
                <td>
                    @if(!$em->parent_id)
                        <a href="{{ route('samples.patients.express-pattern.show', [$patient->id , $em->id]) }}" class="btn btn-info btn-sm">
                            <x-svg icon="cui-external-link"/>
                            {{--                        show--}}
                        </a>
                        <a href="{{route('samples.expresscreate_parent',$em->id)}}"
                           class="btn btn-primary float-right mr-4" type="button">
                            <x-svg icon="cui-plus"/>

                        </a>
                    @endif

                    {{--@can('belongs-to-user', $em)--}}
                    @if(auth()->id()==$em->user_id)

                        <?php $chekcount=\App\Models\Samples\ExpressPaterrn::where('parent_id',$em->id)->get()->count()?>

                            <a href="{{ route('samples.patients.express-pattern.edit', [$patient->id , $em->id]) }}" class="btn btn-primary btn-sm">
                            <x-svg icon="cui-pencil"/>

                        </a>
                       @if($chekcount==0)
                            <form method="POST" action="{{route('samples.patients.express-pattern.destroy', [$patient->id , $em->id]) }}" class="d-inline">
                                @csrf
                                @method('delete')

                                <button class="btn btn-danger btn-sm" >
                                    <x-svg icon="cui-trash" />
                                </button>
                            </form>
                        @endif
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
