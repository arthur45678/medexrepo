


<div class="card col-12">
    <div class="card-header">Ստացված ուղեգրեր
            <div class="col-4">
                <form method="POST" action="{{route('pharmacy.findmedication')}}" class="d-inline">
                    @csrf
                    <x-forms.magic-search class="medicines-search magic-search ajax"
                                          data-catalog-name="medicines"
                                          value=''
                                          hidden-id="prescription_medicine_id"
                                          hidden-name="prescription_medicine_id[]"
                                          placeholder="Ընտրել դեղամիջոցը․․" />
                    <button class="btn btn-secondary">Search</button>
                </form>


            </div>
    </div>
    <div class="card-body" style="overflow-x:scroll;">
        <table id="receivedReferrals" class="table table-md table-hover table-cursor ">
            <thead class="thead-info">
            <tr>
                <td rowspan="2" class="text-center"></td>
                <td rowspan="2" class="text-center">ԱՆՎԱՆՈՒՄԸ</td>
                <td rowspan="2" class="text-center">ԱԿՏ</td>
                <td rowspan="2" class="text-center">ՉԱՓՄԱՆ <br>ՄԻՎԱՈՐԸ</td>
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
                <td width="30px"> {{__('measurement_units.'.$pharmacys->MeasurementUnit->name)}}</td>

                <td>{{$pharmacys->price}}</td>
                <td>{{$pharmacys_balance_of_the_month}}</td>
                <td>{{$pharmacys_balance_of_the_month* $pharmacys->price}}</td>

                <td ondblclick="window.open('{{route('pharmacy.pharmacyEnterHistory.show',$pharmacys->medicine_id)}}','_blank')">{{$pharmacys_enter}} </td>
                <td>{{$pharmacys_enter* $pharmacys->price}}</td>


                <td>{{$pharmacys_cost}} </td>

                <td>{{$pharmacys_cost* $pharmacys->price}}</td>
                <td>{{$pharmacys_balance_end_math_count}}</td>



                <td>{{$pharmacys_balance_end_math_count*$pharmacys->price}}</td>

            </tr>

            </tbody>


        </table>

    </div>
</div>
