@extends('layouts.AdminCardBase')

@section('css')
<link rel="stylesheet" href="{{mix('/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{mix("/css/jquery.magicsearch.min.css")}}"/>
@endsection

@section('card-header')
@section('card-header-classes', '')
<div class="text-center">
    <h3>{{ $log->name }}</h3>
</div>
@endsection

@section('card-content')






<div class="nav-tabs-boxed">



    <h3>{{ $log->log_name }}</h3>
    <p class="lead">{{ $log->description }}</p>

    <?php echo '<pre>';  var_export($log->toArray()['properties']); echo '</pre>'; ?>
    <?php echo '<pre>';  print_r($log->toArray()['properties']); echo '</pre>'; ?>


</div>



@endsection

@section('javascript')
<script src="{{mix('/js/jquery.js')}}"></script>
<script src="{{mix('/js/datatables.js')}}"></script>
<script src="{{ mix('js/all.magicsearch.js') }}"></script>
@endsection
