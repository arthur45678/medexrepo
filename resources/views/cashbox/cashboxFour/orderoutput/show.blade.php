@extends('layouts.cardBase')

@section('css')
    <link href="{{ mix('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{mix("/css/jquery.magicsearch.min.css")}}" rel="stylesheet" />
@endsection

@section('card-header')
    Դրամարկղ
@endsection

@section('card-content')


    <form method="#" action="#">
        <div class="form-group">
            <label for="#">Id</label>
            <input disabled type="text" name="#" id="#" value="{{ $order->id }}" class="form-control">
        </div>

        <div class="form-group">
            <label for="#">Ամսաթիվ</label>
            <input disabled type="text" name="#" id="#" value="{{ $order->created_at }}" class="form-control">
        </div>
        <div class="form-group">
            <label for="#">Գումար</label>
            <input disabled type="text" name="#" id="#" value="{{ $order->price }}" class="form-control">
        </div>
        <div class="form-group">
            <label for="#">Պացիենտ</label>
            <input disabled type="text" name="#" id="#" value="{{ $order->patient->f_name }}&nbsp;{{ $order->patient->l_name }}&nbsp;{{ $order->patient->p_name }}" class="form-control">
        </div>

    </form>



@endsection

@section('javascript')
    <script src="{{ mix('js/jquery.js') }}"></script>
    <script src="{{ mix('js/datatables.js') }}"></script>
    <script src="{{ mix('js/all.magicsearch.js') }}"></script>

    <script>
        $(document).ready(function() {
            const documentsDt = $("#example").CDataTable({
                rowGroup: {
                    dataSrc: 5
                }
            });
        });
    </script>
@endsection
