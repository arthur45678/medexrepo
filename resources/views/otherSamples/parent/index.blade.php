@extends('layouts.cardBase')

@section('css')
    <link rel="stylesheet" href="{{mix('/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{mix("/css/jquery.magicsearch.min.css")}}"/>
@endsection

@section('card-header')




@endsection

@section('card-content')
    <div class="nav-tabs-boxed">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#profile-1" role="tab" aria-controls="profile"
                   aria-selected="true">
                    Պատմություն
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#sample-1" role="tab" aria-controls="sample"
                   aria-selected="false">
                    Ձևամնուշներ/Քարտեր
                </a>
            </li>
        </ul>
        <div class="tab-content">


            <div class="tab-pane active" id="profile-1" role="tabpanel">
                <table class="table table-striped datatable-default">
                    <thead>
                    <tr>
                        <th>Համար</th>
                        <th>Ծառայություն</th>
                        <th>Քանակ</th>
                        <th>Գործողություն</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($new_array as $k => $newsamples)

                        @if($newsamples['count'] > 0)
                            @php
                            $index_route = $create_route = '/';
                            if (Str::contains($newsamples['path'], '.')) {
                                if( Str::contains($newsamples['path'], 'departments') &&
                                    Str::contains($newsamples['path'], 'work-time-bulletins')) {
                                        $index_route = route('otherSamples.departments.work-time-bulletins.index', ['department'=>auth()->user()->department_id]);
                                    }
                            } else {
                                $index_route = route('otherSamples.'.$newsamples['path'].'.'.'index');
                            }
                            @endphp
                            <tr>
                                <td>{{$k+1}}</td>
                                <td>{{$newsamples['name']}}</td>
                                <td>{{$newsamples['count']}}</td>
                                <td>
                                    <a href='{{$index_route}}' target="_blank" class="btn btn-primary">
                                        <x-svg icon='cui-external-link'/>դիտել
                                    </a>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="tab-pane" id="sample-1" role="tabpanel">
                <div class="card text-center">
                    <div class="card-header bg-primary">
                        <h5 class="text-white">Ստեղծել ձևանմուշներ/քարտեր</h5>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-3 text-left mb-3">
                                <strong>Ձևանմուշների ցանկ</strong>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                        ընտրել ձևանմուշը․․
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        @foreach($samples as $otherSamples)
                                            @if($otherSamples->path!='' && (strpos($otherSamples->path, '.') === false))
                                                <a class="dropdown-item"
                                                   href="{{route('otherSamples.'.$otherSamples->path.'.'.'create')}}" target="_blank">{{$otherSamples->name}}</a>
                                            {{-- @else
                                                <a class="dropdown-item">{{$otherSamples->name}}</a> --}}
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9 mt-3">
                                <!-- Work time calculation bulletin -->
                                {{-- <a href='{{route("otherSamples.departments.work-time-bulletins.create", ["department"=>auth()->user()->department_id])}}' class="btn btn-primary">
                                    create
                                </a> --}}
                                <form action='{{route("otherSamples.departments.work-time-bulletins.store", ["department"=>auth()->user()->department_id])}}' method="POST">
                                    @csrf
                                    <button class="btn btn-primary float-right">Աշխատաժամանակի հաշվարկի տեղեկագիր</button>
                                </form>
                            </div>

                            <div class="col-md-12 d-flex justify-content-between">
                                <div class="col-md-5">

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection

@section('javascript')
    <script src="{{mix('/js/jquery.js')}}"></script>
    <script src="{{mix('/js/datatables.js')}}"></script>
    <script src="{{ mix('js/all.magicsearch.js') }}"></script>
@endsection
