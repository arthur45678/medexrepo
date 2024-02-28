@extends('layouts.cardBase')

@section('css')
    <link href="{{ mix('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{mix("/css/jquery.magicsearch.min.css")}}" rel="stylesheet" />
@endsection

@section('card-header')
    Դրամարկղ
    <div class="card-header-actions">
        <button class="btn btn-primary float-right mr-4" type="button" data-toggle="modal"
                data-target="#order-import-modal">
            <x-svg icon="cui-plus" />
            Մուտք
        </button>
        <button class="btn btn-primary float-right mr-4" type="button" data-toggle="modal"
                data-target="#order-export-modal">
            <x-svg icon="cui-plus" />
            Ելք
        </button>

    </div>
@endsection

@section('card-content')
    @if(session('updated'))
        <div class="alert alert-success sesionDiv">
            {{session('updated')}}
        </div>
    @elseif(session('deleted'))
        <div class="alert alert-danger sesionDiv">
            {{session('deleted')}}
        </div>
    @endif

    <x-modal modal-id="order-import-modal" title="Մուտքի օրդեր" form-id="order-import-form">
        <form action="{{ route('cashbox.cashboxThirth.orderinput.store') }}" id="order-import-form" method="post">
            @csrf

            <div class="alert alert-success alert-block d-none">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong class="alert-content"></strong>
            </div>

            <div class="form-group">
                <label>Բաժին</label>
                <x-forms.magic-search    hidden-name="departments_full_ids[]" hidden-id="department_id"
                                         placeholder="Ընտրել բաժինը․․․" class="magic-search ajax my-2" data-catalog-name="departments" />
            </div>

            <div class="form-group">
                <label>Գումարը թվերով (Դրամ)</label>

                <x-forms.text-field id="price_input"   name="price" label="" validationType="ajax" />


                {{--   <input type="number" class="form-control" type="text" name="price"  />--}}
            </div>
            <div class="form-group">
                <label>Գումարը տառերով  (Դրամ)</label>

                <x-forms.text-field id="sum_text_input" name="sum_text" label="" validationType="ajax" />
            </div>

            <div class="form-group">
                <label>Հիվանդ</label>
                <select name="patient_id" class="form-control" id="patient_id">
                    <option></option>
                    @foreach($patients as $item)
                        <option value="{{$item->id}}">{{ $item->f_name ." ".$item->l_name ." ". $item->p_name}}</option>
                    @endforeach
                </select>
            </div>


            <div class="form-group">
                <label>Նպատակ (Ծառայությանի տեսակ)</label>
                <x-forms.magic-search   hidden-name="treatment_ids[]" hidden-id="treatment_ids"
                                        placeholder="Ընտրել ծառայությունը․․․" class="magic-search ajax my-2" data-catalog-name="treatments" />
            </div>

            <div class="form-group">
                <label>Բժիշկ</label>
                <select name="user_id" class="form-control" id="user_id">
                    <option></option>
                    @foreach($doctors as $item)
                        <option value="{{$item->id}}">{{ $item->f_name ." ".$item->l_name ." ". $item->p_name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>ՀԾՀ</label>
                <x-forms.text-field type="number" id="social_card_input" name="social_card" label="" validationType="ajax" />
            </div>
            <div class="form-group">
                <label>Ստացողի անձը հաստատող փաստաթղթի անվանումը</label>
                <input name="document_type" type="text" class="form-control"  />
            </div>
            <label>Թղթակցող հաշիվ</label>
            <select name="correspondentaccount_id" class="form-control">
                <option></option>
                @foreach ($correspondentaccount as $item)
                    <option value="{{$item->id}}">{{$item->code}}</option>
                @endforeach
            </select>
        </form>
    </x-modal>

    <x-modal modal-id="order-export-modal" title="Ելքի օրդեր" form-id="order-export-form">
        <form action="{{ route('cashbox.cashboxThirth.orderoutput.store') }}" id="order-export-form" method="post">
            @csrf
            <div class="alert alert-success alert-block d-none">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong class="alert-content"></strong>
            </div>
            <div class="form-group">
                <label>Գումարը թվերով (Դրամ)</label>
                <input name="price" type="number" class="form-control" type="text" validationType="ajax" />
            </div>

            <div class="form-group">
                <label>Գումարը տառերով (Դրամ)</label>
                <input name="sum_text" type="text" class="form-control" type="text" validationType="ajax" />
            </div>
            <div class="form-group">
                <label>Ստացողի անձը հաստատող փաստաթղթի անվանումը</label>
                <input name="document_type" type="text" class="form-control" type="text"  />

            </div>

            <div class="form-group">
                <label>Հիվանդ</label>
                <select name="patient_id" class="form-control" id="patient_id">
                    <option></option>
                    @foreach($patients as $item)
                        <option value="{{$item->id}}">{{ $item->f_name ." ".$item->l_name ." ". $item->p_name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>ՀԾՀ</label>
                <x-forms.text-field type="number" id="social_card_input" name="social_card" label="" validationType="ajax" />
            </div>

            <label>Թղթակցող հաշիվ</label>
            <select name="cancer_group" class="form-control">
                <option></option>
                @foreach ($correspondentaccount as $item)
                    <option value="{{$item->id}}">{{$item->code}}</option>
                @endforeach
            </select>
            <div class="form-group">
                <label>Համարը, ամսաթիվը և հանձման վայրը</label>

                <textarea name="passport_data" class="form-control" id="" cols="30" rows="10"></textarea>
            </div>
        </form>
    </x-modal>

    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="input-order-tab" data-toggle="pill" href="#input-order" role="tab" aria-controls="input-order" aria-selected="true">Ելքի օրդերներ</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="output-order-tab" data-toggle="pill" href="#output-order" role="tab" aria-controls="output-order" aria-selected="false">Մուտքի օրդերներ</a>
        </li>

    </ul>
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="input-order" role="tabpanel" aria-labelledby="input-order-tab">
            <table id="example" class="table table-striped table-bordered table-cursor" style="width: 100%;">
                <thead>
                <tr>
                    <th>N</th>
                    <th>Ամսաթիվ</th>
                    <th>Գումար</th>
                    <th>Պացիենտ</th>
                    <th>Գործողություններ</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orderOutput as $order)
                    <tr data-url={{url("/cashbox/order/{$order->id}/show_1_CashInputOrders")}}>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->created_at }}</td>
                        <td>{{ $order->price }}</td>
                        <th>{{ $order->patient->f_name }}&nbsp;{{ $order->patient->l_name }}&nbsp;{{ $order->patient->p_name }}</th>
                        <th>
                            <a class="btn btn-info btn-sm" href="{{ route('cashbox.cashboxThirth.orderoutput.show', $order) }}">
                                <svg class="c-icon">
                                    <use xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-applications"></use>
                                </svg>
                            </a>
                            <a href="{{ route('cashbox.cashboxThirth.orderoutput.edit',$order->id) }}" class="btn btn-primary btn-sm" >
                                <x-svg icon="cui-pencil" />
                            </a>
                            <form style="display:inline" action="{{ route('cashbox.cashboxThirth.orderoutput.destroy',$order->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" type="submit"><x-svg icon="cui-trash" /></button>
                            </form>
                        </th>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
        <div class="tab-pane fade" id="output-order" role="tabpanel" aria-labelledby="output-order-tab">
            <table id="example" class="table table-striped table-bordered table-cursor" style="width: 100%;">
                <thead>
                <tr>
                    <th>N</th>
                    <th>Ամսաթիվ</th>
                    <th>Գումար</th>
                    <th>Պացիենտ</th>
                    <th>Գործողություններ</th>
                </tr>
                </thead>
                <tbody>
                @foreach($ordersInput as $order)
                    <tr data-url={{url("/cashbox/order/{$order->id}/show_1_CashInputOrders")}}>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->created_at }}</td>
                        <td>{{ $order->price }}</td>
                        <th>{{ $order->patient->f_name }}&nbsp;{{ $order->patient->l_name }}&nbsp;{{ $order->patient->p_name }}</th>
                        <th>
                            <a class="btn btn-info btn-sm" href="{{ route('cashbox.cashboxThirth.orderinput.show', $order->id) }}">
                                <svg class="c-icon">
                                    <use xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-applications"></use>
                                </svg>
                            </a>
                            <a href="{{ route('cashbox.cashboxThirth.orderinput.edit',$order->id) }}" class="btn btn-primary btn-sm" >
                                <x-svg icon="cui-pencil" />
                            </a>
                            <form style="display:inline" action="{{ route('cashbox.cashboxThirth.orderinput.destroy',$order->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" type="submit"><x-svg icon="cui-trash" /></button>
                            </form>
                        </th>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>



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
