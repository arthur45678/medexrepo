
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

                            <td>{{\Carbon\Carbon::parse($expres_parent['dateTime'])->format('d.m.Y')}}</td>

                    </tr>
                    <tr>
                        <td>Ժամ</td>

                            <td>{{\Carbon\Carbon::parse($expres_parent['dateTime'])->format('H:i')}}</td>


                    </tr>

                </table>
                <br>
                <div class="text-center"><strong>Արյան կլինիկական հետազոտություն</strong></div>
                <br>
                <table>
                    <tr>
                        <td>Հեմոգլոբին</td>

                            <td>{{$expres_parent['hemoglobin']??'-'}}</td>




                    </tr>
                    <tr>
                        <td>Էրիթրոցիտներ</td>

                            <td>{{$expres_parent['erythrocytes']??'-'}}</td>


                    </tr>
                    <tr>
                        <td>Լեյկոցիտներ</td>

                            <td>{{$expres_parent['leukocytes']??'-'}}</td>



                    </tr>
                    <tr>
                        <td>Հեմատոկրիտ</td>

                            <td>{{$expres_parent['hematocrit']??'-'}}</td>


                    </tr>
                    <tr>
                        <td>Էրիթրոցիտների նստեցման արագություն (ԷՆԱ)</td>

                            <td>{{$expres_parent['ena']??'-'}}</td>


                    </tr>
                </table>
                <br>
                <div class="text-center"><strong>Արյան կենսաքիմիական հետազոտություն</strong></div>
                <br>
                <table>
                    <tr>
                        <td>Գլյուկոզ</td>

                            <td>{{$expres_parent['glucose']??'-'}}</td>

                    </tr>
                    <tr>
                        <td>Միզանյութ</td>

                            <td>{{$expres_parent['urine']??'-'}}</td>

                    </tr>
                    <tr>
                        <td>Պրոթրոմբին</td>

                            <td>{{$expres_parent['prothrombin']??'-'}}</td>

                    </tr>
                    <tr>
                        <td>Բիլիռուբին</td>

                            <td>{{$expres_parent['bilirubin']??'-'}}</td>

                    </tr>
                    <tr>
                        <td>ՈՒղղակի</td>

                            <td>{{$expres_parent['just']??'-'}}</td>


                    </tr>
                    <tr>
                        <td>Անուղղակի</td>

                            <td>{{$expres_parent['indirect']??'-'}}</td>

                    </tr>
                    <tr>
                        <td>Մակարդելիության ժամանակ</td>

                            <td>{{$expres_parent['coagulation']??'-'}}</td>

                    </tr>
                    <tr>
                        <td>Ընդհանուր սպիտակուց</td>

                            <td>{{$expres_parent['common_protein']??'-'}}</td>

                    </tr>
                    <tr>
                        <td>Դիաստազ</td>

                            <td>{{$expres_parent['diastasis']??'-'}}</td>


                    </tr>
                    <tr>
                        <td>Ամիլազ</td>

                            <td>{{$expres_parent['amylase']??'-'}}</td>

                    </tr>
                </table>
                <br>
                <div class="text-center"><strong>Մեզի հետազոտություն</strong></div>
                <br>
                <table>
                    <tr>
                        <td>Գույն</td>

                            <td>{{$expres_parent['color']??'-'}}</td>

                    </tr>
                    <tr>
                        <td>Տեսակարար կշիռ</td>

                            <td>{{$expres_parent['specific_weight']??'-'}}</td>

                    </tr>
                    <tr>
                        <td>Սպիտակուց</td>

                            <td>{{$expres_parent['protein']??'-'}}</td>

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

                            <td>{{$expres_parent['ketone_bodies']??'-'}}</td>

                    </tr>
                    <tr>
                        <td>Նստվածք</td>

                            <td>{{$expres_parent['sediment']??'-'}}</td>

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

                            <td>{{$expres_parent['urine_erythrocytes']??'-'}}</td>

                    </tr>
                    <tr>
                        <td>Լեյկոցիտներ</td>

                            <td>{{$expres_parent['urine_leukocytes']??'-'}}</td>

                    </tr>
                    <tr>
                        <td>էպիթել</td>

                            <td>{{$expres_parent['urine_epithelium']??'-'}}</td>

                    </tr>
                    <tr>
                        <td>Գլանակներ</td>

                            <td>{{$expres_parent['urine_rollers']??'-'}}</td>

                    </tr>
                    <tr>
                        <td>Բյուրեղներ</td>

                            <td>{{$expres_parent['urine_crystals']??'-'}}</td>

                    </tr>
                    <tr>
                        <td>Միկրոօրգանիզմներ</td>

                            <td>{{$expres_parent['urine_microorganisms']??'-'}}</td>

                    </tr>
                </table>
                <br>
                <div class="display-flex">
                    <div> Հետազոտությունը իրականացնող բժշկի անուն, ազգանուն,</div>
                    <div class="bottom-line">{{$expres_parent->user_doctor->full_name ?? ' '}}</div>
                </div>
            </div>
        </div>
