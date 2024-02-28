@extends('layouts.base')

@section('css')
<link href="{{ mix('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')

<div class="container-fluid">
    <div class="fade-in">
        <div class="row">
            <div class="card col-12">
                <div class="card-header">Ուղարկված ուղեգրեր
                    <span class="badge badge-info ml-auto h6">{{$sentReferrals->count()}}</span>
                </div>
                <div class="card-body">
                    <table id="sentReferrals" class="table table-md table-hover table-cursor" style="width:100%;">
                        <thead class="thead-info">
                            <tr>
                                <th>Փուլ</th>
                                <th>Ամսաթիվ</th>
                                <th>Ստացող</th>
                                <th>Ստացող բաժին</th>
                                <th>2 Ծառայության կոդ/վճարման տեսակ</th>
                                <th>Հիվանդի տվյալներ</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('javascript')
<script src="{{ mix('js/jquery.js') }}"></script>
<script src="{{ mix('js/datatables.js') }}"></script>
<script src="{{ mix('js/tooltips.js') }}"></script>

<script>
    const userId = {{ auth()->id() }};
    const sentUrl = @json(route('referrals.patients.sent'));
    const dataTable = $("#sentReferrals").CDataTable({
        'ajax': {
            url: sentUrl,
            type: 'GET',
            dataSrc: 'sentReferrals',
            error: function(xhr, status, error){  // error handling code
                var errorMessage = xhr.status + ': ' + xhr.statusText
                console.log('processingError - ' + errorMessage)
            },
        },
        'columns': [
            { data: 'draw_referral_phase' },
            { data: 'date_with_diff' },
            {
                data: 'receiver',
                render: function (data, type, row) {
                    return data ? data.full_name : 'բաժին';
                }
            },
            { data: 'department.name' },
            {
                data: 'referral_services',
                render : function (data, type, row) {
                    // referral_services with their serviceables
                    console.log(data)
                    let serviceList = data.map( function(service, index) {
                        return `<p title='${service.serviceable.name}'> ${index+1}) ${service.serviceable.code}/${service.payment_type_translated} - ${service.serviceable.cost} դրամ</p>`;
                    });
                    return serviceList;
                }
            },
            {
                data: 'patient',
                render: function (data, type, row) {
                    // patient's all_names and link to his page
                    return '<a href="' + (data.show_page_url) + '" target="_blank">' + (data.all_names) + '</a>';
                }
            }
        ],
        createdRow: function(row, data, dataIndex) {
            // addding url to show each sent-referral
            $( row ).attr('data-url', window.location.href + '/'+ data.id);
        }
    });

    console.log(window.Laravel.user.id);
</script>
@endsection
