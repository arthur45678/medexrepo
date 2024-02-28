

<div class="card col-12">
    <div class="card-header">
        <form action="{{route('pharmacy.Uploadmedication')}}" id="xml" method="post" enctype="multipart/form-data">
            @csrf
            <button type="submit" class="btn btn-primary float-right mr-4" {{ $count>0 ? "" : "disabled" }}>
                <x-svg icon="cui-reload" />
                Թարմացնել {{$count}}
            </button>


        </form>
        <form action="{{route('pharmacy.updateofmath')}}" method="post">
            @csrf
            <button type="submit" class="btn btn-primary float-right mr-4">
                <x-svg icon="cui-reload" />
               Հաշվել մնացորդները
            </button>
        </form>

        @if($pharmacy->count()==0)
        <form action="{{route('pharmacy.createdofmath')}}" method="post">
            @csrf
            <button type="submit" class="btn btn-primary float-right mr-4">
                <x-svg icon="cui-reload" />
              Ստանալ նախորդ ամսվա մնացորդը
            </button>
        </form>
        @endif
        @isset($data)
            <a href="{{ route("pharmacy.pharmacy_show-all",$data) }}" style="float: right"
               class="btn btn-primary mr-2">
                <svg class="c-icon">
                    <use xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-external-link"></use>
                </svg>
            </a>
        @else
            <a href="{{ route("pharmacy.pharmacy_show-all",'show-all') }}" style="float: right"
               class="btn btn-primary mr-2">
                <svg class="c-icon">
                    <use
                        xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-external-link"></use>
                </svg>
                @endif

            </a>

            <a href="{{ route("pharmacy.pharmacy.show",'act') }}" style="float: right"
               class="btn btn-primary mr-2">
                ԱԿՏ
            </a>
            <a href="{{ route("pharmacy.pharmacy.show",'medication') }}" style="float: right"
               class="btn btn-primary mr-2">
                Հաշվետվություն
            </a>


    </div>
    <div class="col-md-12">
        @can('search medicines')
            <div class="col-4">
                <span>Ստուգել դեղամիջոցի մնացորդը</span>
                <br>
                <form style="margin-top: 30px" method="POST" action="{{route('pharmacy.findmedication')}}" class="d-inline">
                    @csrf
                    <x-forms.magic-search class="medicines-search magic-search mt-2"
                                          data-catalog-name="medicines"
                                          value=''
                                          hidden-id="prescription_medicine_id"
                                          hidden-name="prescription_medicine_id[]"
                                          placeholder="Ընտրել դեղամիջոցը․․" />
                    <br>
                    <button class="btn btn-secondary">Search</button>
                </form>
            </div>
        @endcan
    </div>
    <div class="card-body" style="overflow-x:scroll;">
        <table id="receivedReferrals" class="table table-md table-hover table-cursor ">
            <thead class="thead-info">
            <tr>
                <td rowspan="2" class="text-center"></td>
                <td rowspan="2" class="text-center">ԱՆՎԱՆՈՒՄԸ</td>
                <td rowspan="2" class="text-center">ԱԿՏ</td>
                <td rowspan="2" class="text-center">ԳԻՆԸ</td>
                <td colspan="2" class="text-center">ՄՆԱՑՈՐԴԸ ԱՄՍՎԱ ՍԿԶԲՈՒՄ</td>
                <td colspan="2" class="text-center">ՄՈՒՏՔ</td>
                <td colspan="2" class="text-center">ԵԼՔ</td>
                <td colspan="2" class="text-center">ՄՆԱՑՈՐԴԸ ԱՄՍՎԱ ՎԵՐՋՈՒՄ</td>
            </tr>
            <tr>
                <td class="text-center">Քանակը</td>
                <td class="text-center">Գումար</td>
                <td class="text-center">Քանակը</td>
                <td class="text-center">Գումար</td>
                <td class="text-center">Քանակը</td>
                <td class="text-center">Գումար</td>
                <td class="text-center">Քանակը</td>
                <td class="text-center">Գումար</td>

            </tr>
            </thead>

            <tbody>
            <tr>
                @foreach($pharmacy as $k=>$pharmacys)
                    <td>{{$pharmacys->id}}</td>
                    <td>{{$pharmacys->medicine_name->name}}</td>
                    <td>
                        @if($pharmacys->act=='act')
                            <input type="checkbox" name="act" value="medication" checked
                                   onchange="$('#sumbitdata{{$pharmacys->id}}').submit()">ԱԿՏ
                        @else
                            <input type="checkbox" name="act" value="act"
                                   onchange="$('#sumbitdata{{$pharmacys->id}}').submit()">ԱԿՏ
                        @endif
                    </td>

                    <td>{{$pharmacys->price}}</td>
                    <td>{{$pharmacys->balance_of_the_month ?? ' '}}</td>
                    <td>{{$pharmacys->balance_of_the_month* $pharmacys->price}}</td>

                    <td ondblclick="window.open('{{route('pharmacy.pharmacyEnterHistory.show',$pharmacys->medicine_id)}}','_blank')">{{$pharmacys->enter}} ok</td>
                    <td>{{$pharmacys->enter* $pharmacys->price}}</td>


                    <td>{{$pharmacys->cost}} </td>

                    <td>{{$pharmacys->cost* $pharmacys->price}}</td>
                    <td>{{$pharmacys->balance_end_math_count}}</td>



                    <td>{{$pharmacys->balance_end_math_count*$pharmacys->price}}</td>

            </tr>
            @endforeach
            </tbody>

        </table>

    </div>
</div>
