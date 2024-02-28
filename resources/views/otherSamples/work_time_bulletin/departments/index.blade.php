@extends('layouts.cardBase')

@section('css')
<link href="{{ mix('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('card-header')
<div>
    <h3>
        {{$department->name}}
    </h3>
    <small>Աշխատաժամանակի հաշվարկի տեղեկագրեր</small>
</div>
@endsection

@section('card-content')


<table class="table table-md table-hover  table-cursor datatable-default" style="width:100%;">
    <thead class="thead-info">
        <tr>
            <th>Id</th>
            <th>Տարի/Ամիս</th>
            <th>Բաժին</th>
            <th>Գործողություններ</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($department_work_time_bulletin as $bulletin)
        @php
            $show_bulletin_route = route('otherSamples.departments.work-time-bulletins.show',[
                'department'=>$bulletin->department->id,
                'work_time_bulletin'=>$bulletin->id
            ]);
            $edit_bulletin_route = route('otherSamples.departments.work-time-bulletins.edit',[
                'department'=>$bulletin->department->id,
                'work_time_bulletin'=>$bulletin->id
            ]);

            $destroy_bulletin_route = route('otherSamples.departments.work-time-bulletins.destroy', [
                'department'=>$bulletin->department->id,
                'work_time_bulletin'=>$bulletin->id
            ]);
        @endphp
        <tr data-url={{$show_bulletin_route}}>
            <td>{{ $bulletin->id}}</td>
            <td>{{ $bulletin->created_at->year .' / '. $bulletin->created_at->getTranslatedMonthName()}}</td>
            <td>{{ $bulletin->department->name}}</td>
            <td>
                @if ($bulletin->user_id === auth()->id())
                    <a class="btn btn-primary" href='{{$edit_bulletin_route}}' target="_blank">
                        <x-svg icon='cui-pencil' />
                        խմբագրել
                    </a>
                    <form action='{{$destroy_bulletin_route}}' method="POST" style="display: inline-block">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="id" value='{{$bulletin->id}}'>
                        <button class="btn btn-danger">
                            <x-svg icon='cui-basket' />
                            ջնջել
                        </button>
                    </form>
                @else
                    <button class="btn btn-secondary" disabled><x-svg icon='cui-pencil'/>խմբագրել</button>
                    <button class="btn btn-secondary" disabled><x-svg icon='cui-basket' />ջնջել</button>
                @endif

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
@endsection
