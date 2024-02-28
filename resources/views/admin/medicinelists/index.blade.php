@extends('layouts.AdminCardBase')

@section('css')
<link href="{{ mix('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('card-header')
    <?php
        $d = scandir(public_path('MedicineList'), SCANDIR_SORT_NONE );
        $count=count($d)-2;
    ?>
    <h4>Դեղորայքի անուներ</h4>
    <div class="card-header-actions" style="float: right">
        <form action="{{ route("admin.medicine-lists.store") }}" id="xml" method="post" enctype="multipart/form-data">
            @csrf
            <button type="submit" class="btn btn-primary float-right mr-4" {{ $count>0 ? "" : "disabled" }}>
                <x-svg icon="cui-reload" />
                Թարմացնել  {{$count}}
            </button>
        </form>
        <br>
        <br>
        <a href="{{ route("admin.medicine-lists.create") }}" class="btn btn-primary float-right mr-4" type="button" target="_blank">
            <x-svg icon="cui-plus" />
            ավելացնել նորը
        </a>
    </div>
@endsection

@section('card-content')

    @if(Session::has('msg'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>Տվյալները հաջողությամբ պահպանված են։</strong>
        </div>
        @php
            Session::forget('msg');
        @endphp
    @endif

    <table class="table table-md table-hover table-responsive table-cursor datatable-default" style="width:100%;">
        <thead class="thead-info">
        <tr>
            <th>ID</th>
            <th>ծածկագիր</th>
            <th>Անվանում</th>
            <th>Չափման միավոր</th>
            <th>պահեստ</th>
            <th>Ստեղծվել է</th>
            <th>Կարգավիճակ</th>
            <th>Գործողություններ</th>
        </tr>
        </thead>

        <tbody>

        @foreach ($lists as $list)

            <tr >
                <td>{{ $list->id }}</td>
                <td>{{ $list->code }}</td>
                <td>{{ $list->name }}</td>
                <td>{{ $list->unit }}</td>
                <td>{{ $list->warehouse }}</td>
                <td>{{ $list->created_at}}</td>
                @if($list->status=='active')
                    <td class="text-success">ակտիվ</td>
                @else
                    <td class="text-danger">պասիվ</td>
                @endif
                <td>
                    <form method="POST" action="{{route('admin.medicine-lists.update',$list->id)}}" class="d-inline">
                        @csrf
                        @method("put")
                        <button class="btn btn-danger btn-sm" type="submit" name="status" value="{{$list->status}}">
                            <x-svg icon="cui-trash" />
                        </button>
                    </form>
                    <a href="{{ route('admin.medicine-lists.edit',$list->id) }}" class="btn btn-primary btn-sm" >
                        <x-svg icon="cui-pencil" />
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
