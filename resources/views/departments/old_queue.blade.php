@extends('layouts.base')

@section('css')
<link href="{{ mix('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')

<div class="container-fluid">
    <div class="fade-in">
        <div class="row">
            <div class="card col-12">
                <div class="card-header">Հերթագրման ցուցակ</div>
                <div class="card-body">

                    <div class="nav-tabs-boxed">
                        <ul class="nav nav-tabs nav-queue" role="tablist" id="queue-tabs">
                            <li class="nav-item" data-toggle="tooltip" data-placement="top" title="Արմեն Առաքելյան">
                                <a class="nav-link active" data-toggle="tab" href="#doc_pane_1" role="tab"
                                    aria-controls="doc_pane_1">
                                    ԱԱ
                                    <span class="badge badge-pill badge-info">0</span>
                                </a>
                            </li>
                            <li class="nav-item" data-toggle="tooltip" data-placement="top" title="Գևորգ Բադակյան">
                                <a class="nav-link" data-toggle="tab" href="#doc_pane_2" role="tab"
                                    aria-controls="doc_pane_2">
                                    ԳԲ
                                    <span class="badge badge-pill badge-info">8</span>
                                </a>
                            </li>
                            <li class="nav-item" data-toggle="tooltip" data-placement="top" title="Ռուբեն Նավասարդյան">
                                <a class="nav-link" data-toggle="tab" href="#doc_pane_3" role="tab"
                                    aria-controls="doc_pane_3">
                                    ՌՆ
                                    <span class="badge badge-pill badge-info">19</span>
                                </a>
                            </li>

                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="doc_pane_1" role="tabpanel">

                                <div class="card">
                                    <div class="card-header">
                                        <!-- adding new patient to doctor's queue -->
                                        <form id="doc_form_1" class="form-inline justify-content-center">
                                            @csrf
                                            <div class="form-group mr-1">
                                                <input class="form-control" id="soc_card" type="text"
                                                    placeholder="ՀԾՀՀ">
                                            </div>
                                            <div class="form-group">
                                                <button class="btn btn-success mr-1" type="button"
                                                    data-type="current">Ընթացիկ</button>
                                                <button class="btn btn-warning" type="button"
                                                    data-type="urgent">Շտապ</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-body x-overflow-auto">
                                        <h6 class="card-title">բժիշկ՝ Արմեն Առաքելյան</h6>
                                        <table id="doc_table_1" class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Համար</th>
                                                    <th>Անուն</th>
                                                    <th>Ազգանուն</th>
                                                    <th>ՀԾՀՀ</th>
                                                    <th>Ուղեգրի համար</th>
                                                    <th>Ամսաթիվ</th>
                                                    <th>Գործողություն</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Վազգեն</td>
                                                    <td>Կարեյան</td>
                                                    <td>2000034568856</td>
                                                    <td>345</td>
                                                    <td>20.05.2020</td>
                                                    <td>
                                                        <button class="btn btn-danger" type="button"
                                                            data-url="remove/id">Ավարտել 1</button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>Սուրեն</td>
                                                    <td>Կյուրեղյան</td>
                                                    <td>2000055566677</td>
                                                    <td>567</td>
                                                    <td>20.05.2020</td>
                                                    <td>
                                                        <button class="btn btn-danger" type="button"
                                                            data-url="remove/id">Ավարտել 2</button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Համար</th>
                                                    <th>Անուն</th>
                                                    <th>Ազգանուն</th>
                                                    <th>ՀԾՀՀ</th>
                                                    <th>Ուղեգրի համար</th>
                                                    <th>Ամսաթիվ</th>
                                                    <th>Գործողություն</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>

                            </div>
                            <div class="tab-pane" id="doc_pane_2" role="tabpanel">

                                <div class="card">
                                    <div class="card-header">
                                        <form id="doc_form_2" class="form-inline justify-content-center">
                                            @csrf
                                            <div class="form-group mr-1">
                                                <input class="form-control" id="soc_card" type="text"
                                                    placeholder="ՀԾՀՀ">
                                            </div>
                                            <div class="form-group">
                                                <button class="btn btn-success mr-1" type="button"
                                                    data-type="current">Ընթացիկ</button>
                                                <button class="btn btn-warning" type="button"
                                                    data-type="urgent">Շտապ</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-body x-overflow-auto">
                                        <h6 class="card-title">բժիշկ՝ Գևորգ Բադակյան</h6>
                                        <table id="doc_table_2" class="table table-hover">
                                            <thead class="thead-info">
                                                <tr>
                                                    <th>Համար</th>
                                                    <th>Անուն</th>
                                                    <th>Ազգանուն</th>
                                                    <th>ՀԾՀՀ</th>
                                                    <th>Ուղեգրի համար</th>
                                                    <th>Ամսաթիվ</th>
                                                    <th>Գործողություն</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Գագիկ</td>
                                                    <td>Սիմոնյան</td>
                                                    <td>2000034567789</td>
                                                    <td>123</td>
                                                    <td>23.05.2020</td>
                                                    <td>
                                                        <button class="btn btn-danger" type="button"
                                                            data-url="remove/id">Ավարտել 1</button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Համար</th>
                                                    <th>Անուն</th>
                                                    <th>Ազգանուն</th>
                                                    <th>ՀԾՀՀ</th>
                                                    <th>Ուղեգրի համար</th>
                                                    <th>Ամսաթիվ</th>
                                                    <th>Գործողություն</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>

                            </div>
                            <div class="tab-pane" id="doc_pane_3" role="tabpanel">
                                Ruben Navasardyan
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer"></div>

            </div>
        </div>
    </div>
</div>

@endsection

@section('javascript')
<script src="{{ mix('js/tooltips.js') }}"></script>
<script src="{{ mix('js/jquery.js') }}"></script>
<script src="{{ mix('js/datatables.js') }}"></script>
<script>
    $(document).ready(function() {
            $('table.table').DataTable({
                "language": window.dt.hy,
            });
        });
</script>
@endsection
