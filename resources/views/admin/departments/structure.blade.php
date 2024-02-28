@extends('layouts.AdminCardBase')

@section('content')
<div class="container-fluid">
    <div class="fade-in">
        <div class="row">
            <div class="card col-12">
                <div class="card-header">Կառուցվածք</div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-2">
                          <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            {{--<a class="nav-link active text-align-center text-height" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Փոխտնօրեն ընդհանուր հարցերով</a>
                            <a class="nav-link text-align-center " id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Փոխտնօրեն դիսպանսեր և պոլիկլինիկական գծով</a>
                            <a class="nav-link text-align-center text-height" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Փոխտնօրեն բուժական գծով</a>
                            <a class="nav-link text-align-center text-line-height" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">Գլխավոր բժիշկ</a>
                            <a class="nav-link text-align-center text-height" id="v-pills-set-tab" data-toggle="pill" href="#v-pills-set" role="tab" aria-controls="v-pills-set" aria-selected="false">Տնօրենի խորհրդական ֆինանսական գծով</a>--}}
                              @foreach($posts as $item)
                                  <a class="nav-link text-align-center" id="v-pills-profile-tab" data-toggle="pill" href="#{{$item->type}}" role="tab" aria-controls="{{$item->type}}" aria-selected="false">{{$item->title}}</a>
                              @endforeach
                          </div>
                        </div>
                        <div class="col-9">
                            <div class="tab-content" id="v-pills-tabContent">
                                @foreach($posts as $value)
                                    <div class="tab-pane fade" id="{{ $value->type }}" role="tabpanel" aria-labelledby="{{ $value->type }}">
                                        @foreach($value->departments as $value)
                                            <div class="col-3">
                                                <button class="btn btn-block btn-outline-info active btn-size btn-margin" type="button" aria-pressed="true">{{ $value->name }}</button>
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                            {{--<div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                            </div>
                              <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                                  <div class="col-3">
                                    <button class="btn btn-block btn-outline-info active btn-size btn-margin" type="button" aria-pressed="true">Ամբուլատոր դիսպանսեր հսկողության բաժանմունք</button>
                                    <button class="btn btn-block btn-outline-info active btn-size btn-margin" type="button" aria-pressed="true">Արխիվ</button>
                                  </div>
                              </div>
                            <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                              <div class="buttons-flex-box">
                                  <button class="btn btn-block btn-outline-info active btn-size " type="button" aria-pressed="true">Մամոլոգիական բաժանմունք</button>
                                  <button class="btn btn-block btn-outline-info active btn-size " type="button" aria-pressed="true">Որովայնային և էնդովիրաբուժության բաժանմունք</button>
                                  <button class="btn btn-block btn-outline-info active btn-size " type="button" aria-pressed="true">Օնկոլոգիայի բաժանմունք</button>
                                  <button class="btn btn-block btn-outline-info active btn-size " type="button" aria-pressed="true">Վիրահատարան</button>
                                  <button class="btn btn-block btn-outline-info active btn-size " type="button" aria-pressed="true">Նեյրոնկոլոգիական բաժանմունք</button>
                                  <button class="btn btn-block btn-outline-info active btn-size " type="button" aria-pressed="true">Օնկոուրոլոգիական բաժանմունք</button>
                              </div>
                                <div class="buttons-flex-box">
                                  <button class="btn btn-block btn-outline-info active btn-size " type="button" aria-pressed="true">Ոսկրային ուռուցքաբանության բաժանմունք</button>
                                  <button class="btn btn-block btn-outline-info active btn-size " type="button" aria-pressed="true">Ընդհանուր մանկական ուռուցքաբանության բաժանմունք</button>
                                  <button class="btn btn-block btn-outline-info active btn-size " type="button" aria-pressed="true">Ճառագայթային ուռուցքաբանության բաժանմունք</button>
                                  <button class="btn btn-block btn-outline-info active btn-size " type="button" aria-pressed="true">Ռադիոգինեկոլոգիական բաժանմունք</button>
                                  <button class="btn btn-block btn-outline-info active btn-size " type="button" aria-pressed="true">Ոսկրային ուռուցքաբանության բաժանմունք</button>
                                  <button class="btn btn-block btn-outline-info active btn-size " type="button" aria-pressed="true">Թորակալ վիրաբուժության բաժանմունք</button>
                                </div>
                                <div class="buttons-flex-box">
                                  <button class="btn btn-block btn-outline-info active btn-size " type="button" aria-pressed="true">Միջուկային բժկության ստորաբաժանում</button>
                                  <button class="btn btn-block btn-outline-info active btn-size " type="button" aria-pressed="true">Միջուկային բժկության ստորաբաժանում</button>
                                  <button class="btn btn-block btn-outline-info active btn-size " type="button" aria-pressed="true">Ընդհանուր մանկական քիմիաթերապիայի բաժանմունք</button>
                                  <button class="btn btn-block btn-outline-info active btn-size " type="button" aria-pressed="true">Ընդհանուր հիվանդանոցային անձնակազմ</button>
                                  <button class="btn btn-block btn-outline-info active btn-size " type="button" aria-pressed="true">Ռադիոիզոտոպային հետազոտության խումբ</button>
                                  <button class="btn btn-block btn-outline-info active btn-size " type="button" aria-pressed="true">Ընդհանուր հիվանդանոցային անձնակազմ</button>
                                </div>
                                <div class="buttons-flex-box">
                                  <button class="btn btn-block btn-outline-info active btn-size " type="button" aria-pressed="true">Անզգայացման և վերակենդանացման բաժանմունք</button>
                                  <button class="btn btn-block btn-outline-info active btn-size " type="button" aria-pressed="true">Էնդոսկոպիկ և ուլտրաձայնային ախտորոշման բաժանմունք</button>
                                  <button class="btn btn-block btn-outline-info active btn-size " type="button" aria-pressed="true">Կանանց առողջության կլինիկա</button>
                                  <button class="btn btn-block btn-outline-info active btn-size " type="button" aria-pressed="true">Կլինիկական պաթոմորֆոլոգիական բաժանմունք</button>
                                  <button class="btn btn-block btn-outline-info active btn-size " type="button" aria-pressed="true">Կլինիկական կենսաքիմիայի իմունաբանության լաբարատորիա</button>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                                <div class="col-3">
                                  <button class="btn btn-block btn-outline-info active btn-size btn-margin" type="button" aria-pressed="true">Տնտեսական ծառայություն</button>
                                  <button class="btn btn-block btn-outline-info active btn-size btn-margin" type="button" aria-pressed="true">Ներհիվանդանոցային վիճակագրական խումբ</button>
                                  <button class="btn btn-block btn-outline-info active btn-size btn-margin" type="button" aria-pressed="true">Ինժեներական խումբ</button>
                                  <button class="btn btn-block btn-outline-info active btn-size btn-margin" type="button" aria-pressed="true">Հանրապետական ուռուցքաբանության վիճակագրական խումբ</button>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="v-pills-set" role="tabpanel" aria-labelledby="v-pills-set-tab">
                                <div class="buttons-flex-box">
                                  <button class="btn btn-block btn-outline-info active btn-size " type="button" aria-pressed="true">Գլխավոր հաշվապահ</button>
                                  <button class="btn btn-block btn-outline-info active btn-size " type="button" aria-pressed="true">Հաշվապահություն</button>
                                  <button class="btn btn-block btn-outline-info active btn-size " type="button" aria-pressed="true">Գիտական խորհրդի քարտուղար</button>
                                </div>
                                <div class="buttons-flex-box">
                                  <button class="btn btn-block btn-outline-info active btn-size " type="button" aria-pressed="true">Իրավաբան</button>
                                  <button class="btn btn-block btn-outline-info active btn-size " type="button" aria-pressed="true">Տնօրենի օգնական</button>
                                  <button class="btn btn-block btn-outline-info active btn-size " type="button" aria-pressed="true">Կադրերի բայժին</button>
                                </div>
                                <div class="buttons-flex-box">
                                  <button class="btn btn-block btn-outline-info active btn-size " type="button" aria-pressed="true">Գնումների բաժին</button>
                                  <button class="btn btn-block btn-outline-info active btn-size " type="button" aria-pressed="true">Ներքին անվտանգության մասնագետ</button>
                                </div>
                            </div>--}}
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
