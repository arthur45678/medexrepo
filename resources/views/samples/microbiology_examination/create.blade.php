@extends('layouts.cardBase')

@section('css')
    <link href="{{mix("/css/jquery.magicsearch.min.css")}}" rel="stylesheet" />
@endsection


@section('card-header')
@section('card-header-classes', '')

<div class="text-center">
    <h3>ՄԱՆՐԷԱԲԱՆԱԿԱՆ ԼԱԲՈՐԱՏՈՐԻԱ</h3>
</div>
@endsection


@section('card-content')
    <div class="container">

        <form class="ajax-submitable" action="{{ route('samples.patients.microbiology_examination.store', ['patient'=> $patient]) }}" method="POST">
            @csrf
                <ul>

                    <li class="list-group-item">
                        <div class="form-row align-items-center">
                            <div class="col-md-12">
                                <strong>ԲԺՇԿԱԿԱՆ ԿԱԶՄԱԿԵՐՊՈՒԹՅԱՆ ԱՆՎԱՆՈՒՄ ԿԱՄ ԱՆՀԱՏ ՁԵՌՆԱՐԿԱՏԻՐՈՋ ԱՆՈՒՆ, ԱԶԳԱՆՈՒՆ</strong>
                                <div class="my-2">
                                    <x-forms.text-field type="textarea" name="medical_company_name" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                                        value="" label="" />
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="list-group-item">
                        <div class="form-row align-items-center">
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="float-right">

                                        <x-forms.text-field name="susceptibility_to_antibiotics_date" validation-type="ajax" type="date"
                                                            value="" label="" />
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <strong>Զգայունության որոշում հակաբիոտիկների հանդեպ</strong>
                                    <div class="my-2">
                                        <x-forms.text-field type="textarea" name="susceptibility_to_antibiotics" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                                            value="" label="" />
                                    </div>
                                </div>
                            </div><!--row-->

                        </div>
                    </li>
                    <li class="list-group-item ">
                        <div class="form-row">
                            <div class="col-md-6">
                                <strong>
                                    Ազգանուն, անուն, հայրանուն
                                </strong>
                                <ins class="ml-4">{{ $patient->getAllNamesAttribute() }}</ins>
                            </div>
                            <div class="col-md-6">
                                <strong>
                                    Տարիք
                                </strong>
                                <ins class="ml-4"><span>{{ $patient->getAgeAttribute() }}
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <strong>Բաժանմունք՝</strong>
                        <div class="my-2">
                            <x-forms.magic-search class="magic-search ajax" value='' hidden-id="department_id" validationType="ajax"
                                                  hidden-name="department_id" data-catalog-name="departments" placeholder="ընտրել բաժանմունքը․․․" />
                            <em class="error text-danger" data-input="department_id"></em>
                        </div>
                    </li>


                    <li class="list-group-item">
                        <div class="mt-2">
                            <x-forms.text-field type="textarea"  name="room" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                                                value="" label="Պալատ" />
                        </div>
                    </li>

                    <li class="list-group-item">
                        <strong>Ուղեգրող բժիշկ</strong>
                        <x-forms.magic-search hidden-id="referred_doctor_id" hidden-name="referred_doctor_id"
                                              placeholder="Ընտրել բուժող բժիշկին․․․" class="magic-search ajax my-2" data-list-name="users"
                                              value="" />
                    </li>


                    <li class="list-group-item">
                        <div class="form-row align-items-center">
                            <div class="col-md-7">
                                <strong>Ամբուլատոր բժշկական քարտի/հիվանդության պատմագրի №</strong>
                                <ins class="ml-4">940462</ins>
                                <input type="hidden" name="research" value="">
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="form-row align-items-center">
                            <div class="col-md-12">
                                <strong>Մանրէաբանական հետազոտություն</strong>
                                <div class="my-2">
                                    <x-forms.text-field type="textarea" name="microbiology_examination" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                                        value="" label="" />
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="form-row align-items-center">
                            <div class="col-md-12">
                                <strong>Անջատված միկրոֆլորա</strong>
                                <div class="my-2">
                                    <x-forms.text-field type="textarea" name="isolated_microflora" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                                        value="" label="" />
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="text-center">
                            <h4>Զգայունության որոշում հակաբիոտիկների հանդեպ</h4>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="form-row align-items-center">
                            <strong>Զգայունության որոշում հակաբիոտիկների հանդեպ</strong>
                            <br><br>
                            <div class="col-md-12 mx-auto">
                                <table class="table table-bordered table-md">

                                    <tr>
                                        <td>
                                            <div class="row my-2">
                                                <div class="col-md-5">
                                                    <p>Ամոքսիկլավ (աուգմենտին)</p>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-check form-check-inline mr-1">
                                                        <input class="form-check-input" id="wheelchair-radio1" type="radio" value="1" name="amoxiclav_is_sensitive">
                                                        <label class="form-check-label" for="wheelchair-radio1">զգայուն է</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 pr-0">
                                                    <div class="form-check form-check-inline mr-1">
                                                        <input class="form-check-input" id="wheelchair-radio2" type="radio" value="0" name="amoxiclav_is_sensitive">
                                                        <label class="form-check-label" for="wheelchair-radio2">զգայուն չէ</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <x-forms.text-field type="textarea" name="antibiotk_amoxiclav" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                                                value="" label="" />
                                        </td>
                                        <td>
                                            <div class="row my-2">
                                                <div class="col-md-5">
                                                    <p>Ցիպրոֆլոքսացին</p>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-check form-check-inline mr-1">
                                                        <input class="form-check-input" id="wheelchair-radio3" type="radio" value="1" name="ciprofloxacin_is_sensitive">
                                                        <label class="form-check-label" for="wheelchair-radio3">զգայուն է</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 pr-0">
                                                    <div class="form-check form-check-inline mr-1">
                                                        <input class="form-check-input" id="wheelchair-radio4" type="radio" value="0" name="ciprofloxacin_is_sensitive">
                                                        <label class="form-check-label" for="wheelchair-radio4">զգայուն չէ</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <x-forms.text-field type="textarea" name="antibiotk_ciprofloxacin" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                                                value="" label="" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="row my-2">
                                                <div class="col-md-5">
                                                    <p>Ազիտրոմիցին</p>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-check form-check-inline mr-1">
                                                        <input class="form-check-input" id="wheelchair-radio5" type="radio" value="1" name="azithromycin_is_sensitive">
                                                        <label class="form-check-label" for="wheelchair-radio5">զգայուն է</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 pr-0">
                                                    <div class="form-check form-check-inline mr-1">
                                                        <input class="form-check-input" id="wheelchair-radio6" type="radio" value="0" name="azithromycin_is_sensitive">
                                                        <label class="form-check-label" for="wheelchair-radio6">զգայուն չէ</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <x-forms.text-field type="textarea" name="antibiotk_azithromycin" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                                                value="" label="" />
                                        </td>
                                        <td>
                                            <div class="row my-2">
                                                <div class="col-md-5">
                                                    <p>Կարբենիցիլին</p>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-check form-check-inline mr-1">
                                                        <input class="form-check-input" id="wheelchair-radio7" type="radio" value="1" name="Carbenicillin_is_sensitive">
                                                        <label class="form-check-label" for="wheelchair-radio7">զգայուն է</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 pr-0">
                                                    <div class="form-check form-check-inline mr-1">
                                                        <input class="form-check-input" id="wheelchair-radio8" type="radio" value="0" name="Carbenicillin_is_sensitive">
                                                        <label class="form-check-label" for="wheelchair-radio8">զգայուն չէ</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <x-forms.text-field type="textarea" name="antibiotk_Carbenicillin" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                                                value="" label="" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="row my-2">
                                                <div class="col-md-5">
                                                    <p>Ամպիցիլին</p>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-check form-check-inline mr-1">
                                                        <input class="form-check-input" id="wheelchair-radio9" type="radio" value="1" name="ampicillin_is_sensitive">
                                                        <label class="form-check-label" for="wheelchair-radio9">զգայուն է</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 pr-0">
                                                    <div class="form-check form-check-inline mr-1">
                                                        <input class="form-check-input" id="wheelchair-radio10" type="radio" value="2" name="ampicillin_is_sensitive">
                                                        <label class="form-check-label" for="wheelchair-radio10">զգայուն չէ</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <x-forms.text-field type="textarea" name="antibiotk_ampicillin" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                                                value="" label="" />
                                        </td>
                                        <td>
                                            <div class="row my-2">
                                                <div class="col-md-5">
                                                    <p>Ցեֆազոլին</p>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-check form-check-inline mr-1">
                                                        <input class="form-check-input" id="wheelchair-radio11" type="radio" value="1" name="Cefazolin_is_sensitive">
                                                        <label class="form-check-label" for="wheelchair-radio11">զգայուն է</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 pr-0">
                                                    <div class="form-check form-check-inline mr-1">
                                                        <input class="form-check-input" id="wheelchair-radio12" type="radio" value="0" name="Cefazolin_is_sensitive">
                                                        <label class="form-check-label" for="wheelchair-radio12">զգայուն չէ</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <x-forms.text-field type="textarea" name="antibiotk_Cefazolin" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                                                value="" label="" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="row my-2">
                                                <div class="col-md-5">
                                                    <p>Ամոքսիցիլին</p>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-check form-check-inline mr-1">
                                                        <input class="form-check-input" id="wheelchair-radio13" type="radio" value="1" name="Amoxicillin_is_sensitive">
                                                        <label class="form-check-label" for="wheelchair-radio13">զգայուն է</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 pr-0">
                                                    <div class="form-check form-check-inline mr-1">
                                                        <input class="form-check-input" id="wheelchair-radio14" type="radio" value="0" name="Amoxicillin_is_sensitive">
                                                        <label class="form-check-label" for="wheelchair-radio14">զգայուն չէ</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <x-forms.text-field type="textarea" name="	antibiotk_Amoxicillin" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                                                value="" label="" />
                                        </td>
                                        <td>
                                            <div class="row my-2">
                                                <div class="col-md-5">
                                                    <p>Ցեֆոտաքսիմ (կլաֆորան)</p>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-check form-check-inline mr-1">
                                                        <input class="form-check-input" id="wheelchair-radio15" type="radio" value="1" name="Cefotaxime_is_sensitive">
                                                        <label class="form-check-label" for="wheelchair-radio15">զգայուն է</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 pr-0">
                                                    <div class="form-check form-check-inline mr-1">
                                                        <input class="form-check-input" id="wheelchair-radio16" type="radio" value="0" name="Cefotaxime_is_sensitive">
                                                        <label class="form-check-label" for="wheelchair-radio16">զգայուն չէ</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <x-forms.text-field type="textarea" name="antibiotk_Cefotaxime" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                                                value="" label="" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="row my-2">
                                                <div class="col-md-5">
                                                    <p>Օքսացիլին</p>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-check form-check-inline mr-1">
                                                        <input class="form-check-input" id="wheelchair-radio17" type="radio" value="1" name="Oxacillin_is_sensitive">
                                                        <label class="form-check-label" for="wheelchair-radio17">զգայուն է</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 pr-0">
                                                    <div class="form-check form-check-inline mr-1">
                                                        <input class="form-check-input" id="wheelchair-radio18" type="radio" value="0" name="Oxacillin_is_sensitive">
                                                        <label class="form-check-label" for="wheelchair-radio18">զգայուն չէ</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <x-forms.text-field type="textarea" name="antibiotk_Oxacillin" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                                                value="" label="" />
                                        </td>
                                        <td>
                                            <div class="row my-2">
                                                <div class="col-md-5">
                                                    <p>Ցեֆտազիդիմ (ֆորտում)</p>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-check form-check-inline mr-1">
                                                        <input class="form-check-input" id="wheelchair-radio19" type="radio" value="1" name="Ceftazidime_is_sensitive">
                                                        <label class="form-check-label" for="wheelchair-radio19">զգայուն է</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 pr-0">
                                                    <div class="form-check form-check-inline mr-1">
                                                        <input class="form-check-input" id="wheelchair-radio20" type="radio" value="0" name="Ceftazidime_is_sensitive">
                                                        <label class="form-check-label" for="wheelchair-radio20">զգայուն չէ</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <x-forms.text-field type="textarea" name="antibiotk_Ceftazidime" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                                                value="" label="" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="row my-2">
                                                <div class="col-md-5">
                                                    <p>Գենտամիցին</p>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-check form-check-inline mr-1">
                                                        <input class="form-check-input" id="wheelchair-radio21" type="radio" value="1" name="Gentamicin_is_sensitive">
                                                        <label class="form-check-label" for="wheelchair-radio21">զգայուն է</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 pr-0">
                                                    <div class="form-check form-check-inline mr-1">
                                                        <input class="form-check-input" id="wheelchair-radio22" type="radio" value="2" name="Gentamicin_is_sensitive">
                                                        <label class="form-check-label" for="wheelchair-radio22">զգայուն չէ</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <x-forms.text-field type="textarea" name="antibiotk_Gentamicin" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                                                value="" label="" />
                                        </td>
                                        <td>
                                            <div class="row my-2">
                                                <div class="col-md-5">
                                                    <p>Ցեֆուրոքսիմ (զինացեֆ)</p>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-check form-check-inline mr-1">
                                                        <input class="form-check-input" id="wheelchair-radio23" type="radio" value="1" name="Cefuroxime_is_sensitive">
                                                        <label class="form-check-label" for="wheelchair-radio23">զգայուն է</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 pr-0">
                                                    <div class="form-check form-check-inline mr-1">
                                                        <input class="form-check-input" id="wheelchair-radio24" type="radio" value="0" name="Cefuroxime_is_sensitive">
                                                        <label class="form-check-label" for="wheelchair-radio24">զգայուն չէ</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <x-forms.text-field type="textarea" name="antibiotk_Cefuroxime" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                                                value="" label="" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="row my-2">
                                                <div class="col-md-5">
                                                    <p>Վանկոմիցին</p>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-check form-check-inline mr-1">
                                                        <input class="form-check-input" id="wheelchair-radio25" type="radio" value="1" name="Vancomycin_is_sensitive">
                                                        <label class="form-check-label" for="wheelchair-radio25">զգայուն է</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 pr-0">
                                                    <div class="form-check form-check-inline mr-1">
                                                        <input class="form-check-input" id="wheelchair-radio26" type="radio" value="0" name="Vancomycin_is_sensitive">
                                                        <label class="form-check-label" for="wheelchair-radio26">զգայուն չէ</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <x-forms.text-field type="textarea" name="antibiotk_Vancomycin" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                                                value="" label="" />
                                        </td>
                                        <td>
                                            <div class="row my-2">
                                                <div class="col-md-5">
                                                    <p>Ցեֆտրիաքսոն (ռոտացեֆ)</p>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-check form-check-inline mr-1">
                                                        <input class="form-check-input" id="wheelchair-radio27" type="radio" value="1" name="Ceftriaxone_is_sensitive">
                                                        <label class="form-check-label" for="wheelchair-radio27">զգայուն է</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 pr-0">
                                                    <div class="form-check form-check-inline mr-1">
                                                        <input class="form-check-input" id="wheelchair-radio28" type="radio" value="0" name="Ceftriaxone_is_sensitive">
                                                        <label class="form-check-label" for="wheelchair-radio28">զգայուն չէ</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <x-forms.text-field type="textarea" name="antibiotk_Ceftriaxone" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                                                value="" label="" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="row my-2">
                                                <div class="col-md-5">
                                                    <p>Իմիպենեմ (մերոպենեմ)</p>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-check form-check-inline mr-1">
                                                        <input class="form-check-input" id="wheelchair-radio29" type="radio" value="1" name="Imipenem_is_sensitive">
                                                        <label class="form-check-label" for="wheelchair-radio29">զգայուն է</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 pr-0">
                                                    <div class="form-check form-check-inline mr-1">
                                                        <input class="form-check-input" id="wheelchair-radio30" type="radio" value="0" name="Imipenem_is_sensitive">
                                                        <label class="form-check-label" for="wheelchair-radio30">զգայուն չէ</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <x-forms.text-field type="textarea" name="antibiotk_Imipenem" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                                                value="" label="" />
                                        </td>
                                        <td>
                                            <div class="row my-2">
                                                <div class="col-md-5">
                                                    <p>Մոքսիֆլոքսացին (ավելոքս)</p>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-check form-check-inline mr-1">
                                                        <input class="form-check-input" id="wheelchair-radio31" type="radio" value="0" name="Moxifloxacin_is_sensitive">
                                                        <label class="form-check-label" for="wheelchair-radio31">զգայուն է</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 pr-0">
                                                    <div class="form-check form-check-inline mr-1">
                                                        <input class="form-check-input" id="wheelchair-radio32" type="radio" value="1" name="Moxifloxacin_is_sensitive">
                                                        <label class="form-check-label" for="wheelchair-radio32">զգայուն չէ</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <x-forms.text-field type="textarea" name="antibiotk_Moxifloxacin" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                                                value="" label="" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="row my-2">
                                                <div class="col-md-5">
                                                    <p>Պենիցիլին</p>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-check form-check-inline mr-1">
                                                        <input class="form-check-input" id="wheelchair-radio33" type="radio" value="1" name="Penicillin_is_sensitive">
                                                        <label class="form-check-label" for="wheelchair-radio33">զգայուն է</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 pr-0">
                                                    <div class="form-check form-check-inline mr-1">
                                                        <input class="form-check-input" id="wheelchair-radio34" type="radio" value="0" name="Penicillin_is_sensitive">
                                                        <label class="form-check-label" for="wheelchair-radio34">զգայուն չէ</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <x-forms.text-field type="textarea" name="antibiotk_Penicillin" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                                                value="" label="" />
                                        </td>
                                        <td>
                                            <div class="row my-2">
                                                <div class="col-md-5">
                                                    <p>Նորֆլոքսացին</p>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-check form-check-inline mr-1">
                                                        <input class="form-check-input" id="wheelchair-radio35" type="radio" value="1" name="Norfloxacin_is_sensitive">
                                                        <label class="form-check-label" for="wheelchair-radio35">զգայուն է</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 pr-0">
                                                    <div class="form-check form-check-inline mr-1">
                                                        <input class="form-check-input" id="wheelchair-radio36" type="radio" value="0" name="Norfloxacin_is_sensitive">
                                                        <label class="form-check-label" for="wheelchair-radio36">զգայուն չէ</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <x-forms.text-field type="textarea" name="antibiotk_Norfloxacin" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                                                value="" label="" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="row my-2">
                                                <div class="col-md-5">
                                                    <p>Մետրոնիդազոլ</p>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-check form-check-inline mr-1">
                                                        <input class="form-check-input" id="wheelchair-radio37" type="radio" value="1" name="Metronidazole_is_sensitive">
                                                        <label class="form-check-label" for="wheelchair-radio37">զգայուն է</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 pr-0">
                                                    <div class="form-check form-check-inline mr-1">
                                                        <input class="form-check-input" id="wheelchair-radio38" type="radio" value="0" name="Metronidazole_is_sensitive">
                                                        <label class="form-check-label" for="wheelchair-radio38">զգայուն չէ</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <x-forms.text-field type="textarea" name="antibiotk_Metronidazole" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                                                value="" label="" />
                                        </td>
                                        <td>
                                            <div class="row my-2">
                                                <div class="col-md-5">
                                                    <p>Ցեֆոպերազոն</p>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-check form-check-inline mr-1">
                                                        <input class="form-check-input" id="wheelchair-radio39" type="radio" value="1" name="Cefoperazone_is_sensitive">
                                                        <label class="form-check-label" for="wheelchair-radio39">զգայուն է</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 pr-0">
                                                    <div class="form-check form-check-inline mr-1">
                                                        <input class="form-check-input" id="wheelchair-radio40" type="radio" value="0" name="Cefoperazone_is_sensitive">
                                                        <label class="form-check-label" for="wheelchair-radio40">զգայուն չէ</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <x-forms.text-field type="textarea" name="antibiotk_Cefoperazone" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                                                value="" label="" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="row my-2">
                                                <div class="col-md-5">
                                                    <p>Դոքսիցիլին</p>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-check form-check-inline mr-1">
                                                        <input class="form-check-input" id="wheelchair-radio41" type="radio" value="1" name="Doxicillin_is_sensitive">
                                                        <label class="form-check-label" for="wheelchair-radio41">զգայուն է</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 pr-0">
                                                    <div class="form-check form-check-inline mr-1">
                                                        <input class="form-check-input" id="wheelchair-radio42" type="radio" value="0" name="Doxicillin_is_sensitive">
                                                        <label class="form-check-label" for="wheelchair-radio42">զգայուն չէ</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <x-forms.text-field type="textarea" name="antibiotk_Doxicillin" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                                                value="" label="" />
                                        </td>

                                        <td>
                                            <div class="row my-2">
                                                <div class="col-md-5">
                                                    <p>Ֆուրադոնին</p>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-check form-check-inline mr-1">
                                                        <input class="form-check-input" id="wheelchair-radio41" type="radio" value="1" name="furodonin_is_sensitive">
                                                        <label class="form-check-label" for="wheelchair-radio41">զգայուն է</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 pr-0">
                                                    <div class="form-check form-check-inline mr-1">
                                                        <input class="form-check-input" id="wheelchair-radio42" type="radio" value="0" name="furodonin_is_sensitive">
                                                        <label class="form-check-label" for="wheelchair-radio42">զգայուն չէ</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <x-forms.text-field type="textarea" name="antibiotk_furodonin" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                                                value="" label="" />
                                        </td>

                                    </tr>

                                </table>
                            </div>
                        </div>
                    <li class="list-group-item">
                        <strong>Հետազոտությունը իրականացնող բժշկի անուն, ազգանուն</strong>
                        <x-forms.magic-search hidden-id="attending_doctor_id" hidden-name="attending_doctor_id"
                                              placeholder="Ընտրել բուժող բժիշկին․․․" class="magic-search ajax my-2" data-list-name="users"
                                              value="" />
                    </li>
                    <li class="list-group-item">
                        <strong>Հակաբիոտիկների հանդեպ զգայունության որոշման պատասխանի տրման օր, ամիս, տարի</strong>
                        <ins class="ml-4">
                            <x-forms.text-field name="antibiotic_sensitive_date" validation-type="ajax" type="date"
                                                value="" label="" />

                    </li>


                @include('shared.forms.list_group_item_submit', ['btn_text'=>'Ուղարկել'])
                </ul>
        </form>
    </div>
@endsection
@section('javascript')
    <script src="{{ mix('js/jquery.js') }}"></script>
    <script src="{{ mix('js/all.magicsearch.js') }}"></script>

@endsection
