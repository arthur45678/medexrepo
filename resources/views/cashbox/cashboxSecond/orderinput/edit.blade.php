@extends('layouts.cardBase')

@section('css')
    <link href="{{ mix('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{mix("/css/jquery.magicsearch.min.css")}}" rel="stylesheet" />
@endsection

@section('card-header')
    Դրամարկղ
@endsection

@section('card-content')

    <form method="post" action="{{ route('cashbox.cashboxSecond.orderinput.update',$order->id) }}">
        @csrf
        @method('put')
        <div class="form-group">
            <label for="#">Հիվանդ</label>
            <input disabled type="text" id="#" value="{{ $order->patient->f_name }} &nbsp {{ $order->patient->l_name }} &nbsp {{ $order->patient->p_name }}" class="form-control">
        </div>
        <div class="form-group">
            <label for="#">Գումար (ՀՀ դրամ թվերով)</label>
            <input  type="number" name="price" id="#" value="{{ $order->price }}" class="form-control">
        </div>
        <div class="form-group">
            <label for="#">Գումար (ՀՀ դրամ տառերով)</label>
            <input  type="text" name="sum_text" id="#" value="{{ $order->sum_text }}" class="form-control">
        </div>
        <div class="form-group">
            <label for="#">ՀԾՀ</label>
            <input  type="number" name="social_card" id="#" value="{{ $order->social_card }}" class="form-control">
        </div>
        <div class="form-group">
            <label for="#">Անձը հաստատող փաստաթուղթ</label>
            <input  type="text" name="document_type" id="#" value="{{ $order->document_type }}" class="form-control">
        </div>
        <div class="form-group">
            <label for="#">Թղթակցող հաշիվ</label>
            <input  type="text" name="correspondentAccount_id" id="#" value="{{ $order->correspondentAccount_id }}" class="form-control">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Փոփոխել</button>
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
