@foreach ($expres->chunk(5) as $k=>$expre)

    <div class="page-wrap">
        <div class="new-page">
            <div class="main-container">
                <br><br>

                <div>ԲԺՇԿԱԿԱՆ ԿԱԶՄԱԿԵՐՊՈՒԹՅԱՆ ԱՆՎԱՆՈՒՄ ԿԱՄ ԱՆՀԱՏ ՁԵՌՆԱՐԿԱՏԻՐՈՋ ԱՆՈՒՆ, ԱԶԳԱՆՈՒՆ</div>
                <p class="text-center"></p>
                <br>
                <div class="text-center">ԷՔՍՊՐԵՍ ԼԱԲՈՐԱՏՈՐԻԱՆԵՐՈՒՄ ԿԻՐԱՌՎՈՂ ԲԺՇԿԱԿԱՆ ՁԵՎ</div>
                <br>

                <div class="display-flex">
                    <div> Ազգանուն, անուն, հայրանուն</div>
                    <div class="bottom-line"> {{$patient['full_name']}}</div>
                </div>
                <br>
                <div class="display-flex">
                    <div> Տարիք</div>
                    <div class="bottom-line">{{$patient['birth_date']}}</div>
                </div>
                <br>
                <div class="display-flex">
                    <div>Բաժանմունք</div>


                    <div class="bottom-line">{{$expres_parent->departments->name}}</div>
                </div>
                <br>
                <div class="display-flex">
                    <div>Պալատ</div>
                    <div class="bottom-line"> {{ $expres_parent['hospital_room_number']}}</div>
                </div>
                <br>
                <div class="display-flex">
                    <div> Ուղեգրող բժշկի անուն, ազգանուն</div>

                    <div class="bottom-line">{{$expres_parent->attending_doctor_name->full_name ??' ' }} </div>
                </div>
                <br>

                <div class="display-flex">
                    <div>Հիվանդության պատմագրի N</div>
                    <div class="bottom-line">{{ $expres_parent['historian']}}</div>
                </div>

                <br><br>
                <table>
                    <tr>
                        <td>Ամսաթիվ</td>
                        @if($k==0)
                            <td>{{\Carbon\Carbon::parse($expres_parent['dateTime'])->format('d.m.Y')}}</td>
                        @endif
                        @foreach($expre as $item)

                            <td>{{\Carbon\Carbon::parse($item['dateTime'])->format('d.m.Y')}}</td>
                        @endforeach
                    </tr>
                    <tr>
                        <td>Ժամ</td>
                        @if($k==0)
                            <td>{{\Carbon\Carbon::parse($expres_parent['dateTime'])->format('H:i')}}</td>
                        @endif
                        @foreach($expre as $item)

                            <td>{{\Carbon\Carbon::parse($item['dateTime'])->format('H:i')}}</td>
                        @endforeach
                    </tr>

                </table>
                <br>
                <div class="text-center"><strong>Արյան կլինիկական հետազոտություն</strong></div>
                <br>
                <table>
                    <tr>
                        <td>Հեմոգլոբին</td>
                        @if($k==0)
                            <td>{{$expres_parent['hemoglobin']??'-'}}</td>
                        @endif
                        @foreach($expre as $items)

                            <td>{{$items['hemoglobin']??'-'}}</td>
                        @endforeach
                    </tr>
                    <tr>
                        <td>Էրիթրոցիտներ</td>
                        @if($k==0)
                            <td>{{$expres_parent['erythrocytes']??'-'}}</td>

                        @endif
                        @foreach($expre as $item)

                            <td>{{$item['erythrocytes']??'-'}}</td>
                        @endforeach
                    </tr>
                    <tr>
                        <td>Լեյկոցիտներ</td>
                        @if($k==0)
                            <td>{{$expres_parent['leukocytes']??'-'}}</td>
                        @endif

                        @foreach($expre as $item)

                            <td>{{$item['leukocytes']??'-'}}</td>
                        @endforeach
                    </tr>
                    <tr>
                        <td>Հեմատոկրիտ</td>
                        @if($k==0)
                            <td>{{$expres_parent['hematocrit']??'-'}}</td>
                        @endif
                        @foreach($expre as $item)

                            <td>{{$item['hematocrit']??'-'}}</td>
                        @endforeach
                    </tr>
                    <tr>
                        <td>Էրիթրոցիտների նստեցման արագություն (ԷՆԱ)</td>
                        @if($k==0)
                            <td>{{$expres_parent['ena']??'-'}}</td>
                        @endif
                        @foreach($expre as $item)

                            <td>{{$item['ena']??'-'}}</td>
                        @endforeach
                    </tr>
                </table>
                <br>
                <div class="text-center"><strong>Արյան կենսաքիմիական հետազոտություն</strong></div>
                <br>
                <table>
                    <tr>
                        <td>Գլյուկոզ</td>
                        @if($k==0)
                            <td>{{$expres_parent['glucose']??'-'}}</td>
                        @endif
                        @foreach($expre as $item)

                            <td>{{$item['glucose']??'-'}}</td>
                        @endforeach
                    </tr>
                    <tr>
                        <td>Միզանյութ</td>
                        @if($k==0)
                            <td>{{$expres_parent['urine']??'-'}}</td>
                        @endif
                        @foreach($expre as $item)

                            <td>{{$item['urine']??'-'}}</td>
                        @endforeach
                    </tr>
                    <tr>
                        <td>Պրոթրոմբին</td>
                        @if($k==0)
                            <td>{{$expres_parent['prothrombin']??'-'}}</td>
                        @endif
                        @foreach($expre as $item)

                            <td>{{$item['prothrombin']??'-'}}</td>
                        @endforeach
                    </tr>
                    <tr>
                        <td>Բիլիռուբին</td>
                        @if($k==0)
                            <td>{{$expres_parent['bilirubin']??'-'}}</td>
                        @endif
                        @foreach($expre as $item)

                            <td>{{$item['bilirubin']??'-'}}</td>
                        @endforeach
                    </tr>
                    <tr>
                        <td>ՈՒղղակի</td>
                        @if($k==0)
                            <td>{{$expres_parent['just']??'-'}}</td>
                        @endif
                        @foreach($expre as $item)

                            <td>{{$item['just']??'-'}}</td>
                        @endforeach
                    </tr>
                    <tr>
                        <td>Անուղղակի</td>
                        @if($k==0)
                            <td>{{$expres_parent['indirect']??'-'}}</td>
                        @endif
                        @foreach($expre as $item)

                            <td>{{$item['indirect']??'-'}}</td>
                        @endforeach
                    </tr>
                    <tr>
                        <td>Մակարդելիության ժամանակ</td>
                        @if($k==0)
                            <td>{{$expres_parent['coagulation']??'-'}}</td>
                        @endif
                        @foreach($expre as $item)

                            <td>{{$item['coagulation']??'-'}}</td>
                        @endforeach
                    </tr>
                    <tr>
                        <td>Ընդհանուր սպիտակուց</td>
                        @if($k==0)
                            <td>{{$expres_parent['common_protein']??'-'}}</td>
                        @endif
                        @foreach($expre as $item)

                            <td>{{$item['common_protein']??'-'}}</td>
                        @endforeach
                    </tr>
                    <tr>
                        <td>Դիաստազ</td>
                        @if($k==0)
                            <td>{{$expres_parent['diastasis']??'-'}}</td>
                        @endif
                        @foreach($expre as $item)

                            <td>{{$item['diastasis']??'-'}}</td>
                        @endforeach

                    </tr>
                    <tr>
                        <td>Ամիլազ</td>
                        @if($k==0)
                            <td>{{$expres_parent['amylase']??'-'}}</td>
                        @endif
                        @foreach($expre as $item)

                            <td>{{$item['amylase']??'-'}}</td>
                        @endforeach
                    </tr>
                </table>
                <br>
                <div class="text-center"><strong>Մեզի հետազոտություն</strong></div>
                <br>
                <table>
                    <tr>
                        <td>Գույն</td>
                        @if($k==0)
                            <td>{{$expres_parent['color']??'-'}}</td>
                        @endif
                        @foreach($expre as $item)

                            <td>{{$item['color']??'-'}}</td>
                        @endforeach
                    </tr>
                    <tr>
                        <td>Տեսակարար կշիռ</td>
                        @if($k==0)
                            <td>{{$expres_parent['specific_weight']??'-'}}</td>
                        @endif
                        @foreach($expre as $item)

                            <td>{{$item['specific_weight']??'-'}}</td>
                        @endforeach
                    </tr>
                    <tr>
                        <td>Սպիտակուց</td>
                        @if($k==0)
                            <td>{{$expres_parent['protein']??'-'}}</td>
                        @endif
                        @foreach($expre as $item)

                            <td>{{$item['protein']??'-'}}</td>
                        @endforeach
                    </tr>
                    {{--                    <tr>--}}
                    {{--                        <td>Գլյուկոզ</td>--}}
                    {{--                        <td>{{$expre['ketone_bodies']??'-'}}</td>--}}
                    {{--                        @foreach($expre['childs'] as $item)--}}

                    {{--                            <td>{{$item['ketone_bodies']??'-'}}</td>--}}
                    {{--                        @endforeach--}}
                    {{--                    </tr>--}}
                    <tr>
                        <td>Կետոնային մարմիններ</td>
                        @if($k==0)
                            <td>{{$expres_parent['ketone_bodies']??'-'}}</td>
                        @endif
                        @foreach($expre as $item)

                            <td>{{$item['ketone_bodies']??'-'}}</td>
                        @endforeach
                    </tr>
                    <tr>
                        <td>Նստվածք</td>
                        @if($k==0)
                            <td>{{$expres_parent['sediment']??'-'}}</td>
                        @endif
                        @foreach($expre as $item)

                            <td>{{$item['sediment']??'-'}}</td>
                        @endforeach
                    </tr>
                    {{--                    <tr>--}}
                    {{--                        <td>Մակարդելիության ժամանակ</td>--}}
                    {{--                        <td>{{$expre['urine_leukocytes']??'-'}}</td>--}}
                    {{--                        @foreach($expre['childs'] as $item)--}}

                    {{--                            <td>{{$item['urine_leukocytes']??'-'}}</td>--}}
                    {{--                        @endforeach--}}
                    {{--                    </tr>--}}
                    <tr>
                        <td>էրիթրոցիտներ</td>
                        @if($k==0)
                            <td>{{$expres_parent['urine_erythrocytes']??'-'}}</td>
                        @endif
                        @foreach($expre as $item)

                            <td>{{$item['urine_erythrocytes']??'-'}}</td>
                        @endforeach
                    </tr>
                    <tr>
                        <td>Լեյկոցիտներ</td>
                        @if($k==0)
                            <td>{{$expres_parent['urine_leukocytes']??'-'}}</td>
                        @endif
                        @foreach($expre as $item)

                            <td>{{$item['urine_leukocytes']??'-'}}</td>
                        @endforeach
                    </tr>
                    <tr>
                        <td>էպիթել</td>
                        @if($k==0)
                            <td>{{$expres_parent['urine_epithelium']??'-'}}</td>
                        @endif
                        @foreach($expre as $item)

                            <td>{{$item['urine_epithelium']??'-'}}</td>
                        @endforeach
                    </tr>
                    <tr>
                        <td>Գլանակներ</td>
                        @if($k==0)
                            <td>{{$expres_parent['urine_rollers']??'-'}}</td>
                        @endif
                        @foreach($expre as $item)

                            <td>{{$item['urine_rollers']??'-'}}</td>
                        @endforeach
                    </tr>
                    <tr>
                        <td>Բյուրեղներ</td>
                        @if($k==0)
                            <td>{{$expres_parent['urine_crystals']??'-'}}</td>
                        @endif
                        @foreach($expre as $item)

                            <td>{{$item['urine_crystals']??'-'}}</td>
                        @endforeach
                    </tr>
                    <tr>
                        <td>Միկրոօրգանիզմներ</td>
                        @if($k==0)
                            <td>{{$expres_parent['urine_microorganisms']??'-'}}</td>
                        @endif
                        @foreach($expre as $item)

                            <td>{{$item['urine_microorganisms']??'-'}}</td>
                        @endforeach
                    </tr>
                </table>
                <br>
                <div class="display-flex">
                    <div> Հետազոտությունը իրականացնող բժշկի անուն, ազգանուն,</div>
                    @if($k==0)

                        <div class="bottom-line">{{$expres_parent->user_doctor->full_name ?? ' '}}</div>
                    @endif
                    @foreach($expre as $item)

                        <div class="bottom-line">{{$item->user_doctor->full_name ?? ' '}}</div>
                    @endforeach

                </div>
            </div>
        </div>
        <br><br>
        <br><br>
        <br><br>

@endforeach
