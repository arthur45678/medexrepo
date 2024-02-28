@extends('layouts.cardBase')
{{-- departments/api/create_queue.blade.php --}}

@section('css')
<link href="{{ mix('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
@endsection

@section('card-header')
<h3>Create new record for reception queue</h3>

@endsection

@section('card-content')
<div class="container">
    @if (is_null($api_patient))
        <h3>Please, create new Api Patient.</h3>
    @else
    <h5>Api Patien name: {{$api_patient->full_name ?? ' --/--'}}</h5>
    <form action='{{route("reception_queues.store")}}' method="POST">
        @csrf

        <x-forms.text-field name="enqueue_date" type="date" label="enqueue_date"/>
        <x-forms.text-field name="comment" type="textarea" label="comment"/>

        <x-forms.text-field name="patient_id" type="number" value="{{$api_patient->id}}" label="patient_id"/>

        <x-forms.text-field name="user_id" type="number" value="1" label="user_id"/>
        <x-forms.text-field name="department_id" type="number" value="1" label="department_id"/>

        <button type="submit" class="btn btn-success">Create</button>
    </form>
    @endif

</div>
@endsection
