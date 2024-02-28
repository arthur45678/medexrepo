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

        <form {{--class="ajax-submitable"--}} action="{{ route('samples.patients.microbiology_examination.update', ['patient'=> $patient,  $post->id]) }}" method="POST">
            @csrf
            @method('put')
                <ul>

                    <li class="list-group-item">
                        <div class="form-row align-items-center">
                            <div class="col-md-12">
                                <strong>ԲԺՇԿԱԿԱՆ ՁԵՎ N {{ $post->id }}</strong>

                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="form-row align-items-center">
                            <div class="col-md-12">
                                <strong>ԲԺՇԿԱԿԱՆ ԿԱԶՄԱԿԵՐՊՈՒԹՅԱՆ ԱՆՎԱՆՈՒՄ ԿԱՄ ԱՆՀԱՏ ՁԵՌՆԱՐԿԱՏԻՐՈՋ ԱՆՈՒՆ, ԱԶԳԱՆՈՒՆ</strong>
                                <div class="my-2">
                                    <x-forms.text-field type="textarea" name="medical_company_name" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                                        value="{{ $post->medical_company_name }}" label="" />
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
                                                            value="{{ $post->susceptibility_to_antibiotics_date }}" label="" />
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <strong>Զգայունության որոշում հակաբիոտիկների հանդեպ</strong>
                                    <div class="my-2">
                                        <x-forms.text-field type="textarea" name="susceptibility_to_antibiotics" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                                            value="{{ $post->susceptibility_to_antibiotics }}" label="" />
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
                            <x-forms.magic-search class="magic-search ajax" value="{{ $post->department_id }}" hidden-id="department_id" validationType="ajax"
                                                  hidden-name="department_id" data-catalog-name="departments" placeholder="ընտրել բաժանմունքը․․․" />
                            <em class="error text-danger" data-input="department_id"></em>
                        </div>
                    </li>


                    <li class="list-group-item">
                        <div class="mt-2">
                            <x-forms.text-field type="textarea"  name="room" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                                                value="{{ $post->room }}" label="Պալատ" />
                        </div>
                    </li>

                    <li class="list-group-item">
                        <strong>Ուղեգրող բժիշկ</strong>
                        <x-forms.magic-search hidden-id="referred_doctor_id" hidden-name="referred_doctor_id"
                                              placeholder="Ընտրել բուժող բժիշկին․․․" class="magic-search ajax my-2" data-list-name="users"
                                              value="{{ $post->referred_doctor_id }}" />
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
                                                        value="{{ $post->microbiology_examination }}" label="" />
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
                                                        value="{{ $post->isolated_microflora }}" label="" />
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
                                                        <input class="form-check-input" {{ isset($post->amoxiclav_is_sensitive) ? "checked" : "" }} id="wheelchair-radio1" type="radio" value="1" name="amoxiclav_is_sensitive">
                                                        <label class="form-check-label" for="wheelchair-radio1">զգայուն է</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 pr-0">
                                                    <div class="form-check form-check-inline mr-1">
                                                        <input class="form-check-input" id="wheelchair-radio2" type="radio" value="0" {{ empty($post->amoxiclav_is_sensitive) || $post->amoxiclav_is_sensitive == 0 ? "checked" : "" }} name="amoxiclav_is_sensitive">
                                                        <label class="form-check-label" for="wheelchair-radio2">զգայուն չէ</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <x-forms.text-field type="textarea" name="antibiotk_amoxiclav" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                                                value="{{ $post->antibiotk_amoxiclav }}" label="" />
                                        </td>
                                        <td>
                                            <div class="row my-2">
                                                <div class="col-md-5">
                                                    <p>Ցիպրոֆլոքսացին</p>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-check form-check-inline mr-1">
                                                        <input class="form-check-input" id="wheelchair-radio3" type="radio" value="1" {{ isset($post->ciprofloxacin_is_sensitive) ? "checked" : "" }} name="ciprofloxacin_is_sensitive">
                                                        <label class="form-check-label" for="wheelchair-radio3">զգայուն է</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 pr-0">
                                                    <div class="form-check form-check-inline mr-1">
                                                        <input class="form-check-input" id="wheelchair-radio4" type="radio" value="0" {{ empty($post->ciprofloxacin_is_sensitive) || $post->ciprofloxacin_is_sensitive == 0 ? "checked" : "" }} name="ciprofloxacin_is_sensitive">
                                                        <label class="form-check-label" for="wheelchair-radio4">զգայուն չէ</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <x-forms.text-field type="textarea" name="antibiotk_ciprofloxacin" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                                                value="{{ $post->antibiotk_ciprofloxacin }}" label="" />
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
                                                        <input class="form-check-input" id="wheelchair-radio5" type="radio" value="1" {{ isset($post->azithromycin_is_sensitive) ? "checked" : "" }} name="azithromycin_is_sensitive">
                                                        <label class="form-check-label" for="wheelchair-radio5">զգայուն է</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 pr-0">
                                                    <div class="form-check form-check-inline mr-1">
                                                        <input class="form-check-input" id="wheelchair-radio6" type="radio" value="0" {{ empty($post->azithromycin_is_sensitive) || $post->azithromycin_is_sensitive == 0 ? "checked" : "" }} name="azithromycin_is_sensitive">
                                                        <label class="form-check-label" for="wheelchair-radio6">զգայուն չէ</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <x-forms.text-field type="textarea" name="antibiotk_azithromycin" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                                                value="{{ $post->antibiotk_azithromycin }}" label="" />
                                        </td>
                                        <td>
                                            <div class="row my-2">
                                                <div class="col-md-5">
                                                    <p>Կարբենիցիլին</p>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-check form-check-inline mr-1">
                                                        <input class="form-check-input" id="wheelchair-radio7" type="radio" value="1" {{ isset($post->Carbenicillin_is_sensitive) ? "checked" : "" }} name="Carbenicillin_is_sensitive">
                                                        <label class="form-check-label" for="wheelchair-radio7">զգայուն է</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 pr-0">
                                                    <div class="form-check form-check-inline mr-1">
                                                        <input class="form-check-input" id="wheelchair-radio8" type="radio" value="0" {{ empty($post->Carbenicillin_is_sensitive) || $post->Carbenicillin_is_sensitive == 0 ? "checked" : "" }} name="Carbenicillin_is_sensitive">
                                                        <label class="form-check-label" for="wheelchair-radio8">զգայուն չէ</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <x-forms.text-field type="textarea" name="antibiotk_Carbenicillin" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                                                value="{{ $post->antibiotk_Carbenicillin }}" label="" />
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
                                                        <input class="form-check-input" id="wheelchair-radio7" type="radio" value="1" {{ isset($post->ampicillin_is_sensitive) ? "checked" : "" }} name="ampicillin_is_sensitive">
                                                        <label class="form-check-label" for="wheelchair-radio7">զգայուն է</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 pr-0">
                                                    <div class="form-check form-check-inline mr-1">
                                                        <input class="form-check-input" id="wheelchair-radio8" type="radio" value="0" {{ empty($post->ampicillin_is_sensitive) || $post->ampicillin_is_sensitive == 0 ? "checked" : "" }} name="ampicillin_is_sensitive">
                                                        <label class="form-check-label" for="wheelchair-radio8">զգայուն չէ</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <x-forms.text-field type="textarea" name="antibiotk_ampicillin" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                                                value="{{ $post->antibiotk_ampicillin }}" label="" />
                                        </td>
                                        <td>
                                            <div class="row my-2">
                                                <div class="col-md-5">
                                                    <p>Ցեֆազոլին</p>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-check form-check-inline mr-1">
                                                        <input class="form-check-input" id="wheelchair-radio7" type="radio" value="1" {{ isset($post->Cefazolin_is_sensitive) ? "checked" : "" }} name="Cefazolin_is_sensitive">
                                                        <label class="form-check-label" for="wheelchair-radio7">զգայուն է</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 pr-0">
                                                    <div class="form-check form-check-inline mr-1">
                                                        <input class="form-check-input" id="wheelchair-radio8" type="radio" value="0" {{ empty($post->Cefazolin_is_sensitive) || $post->Cefazolin_is_sensitive == 0 ? "checked" : "" }} name="Cefazolin_is_sensitive">
                                                        <label class="form-check-label" for="wheelchair-radio8">զգայուն չէ</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <x-forms.text-field type="textarea" name="antibiotk_Cefazolin" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                                                value="{{ $post->antibiotk_Cefazolin }}" label="" />
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
                                                        <input class="form-check-input" id="wheelchair-radio7" type="radio" value="1" {{ isset($post->Amoxicillin_is_sensitive) ? "checked" : "" }} name="Amoxicillin_is_sensitive">
                                                        <label class="form-check-label" for="wheelchair-radio7">զգայուն է</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 pr-0">
                                                    <div class="form-check form-check-inline mr-1">
                                                        <input class="form-check-input" id="wheelchair-radio8" type="radio" value="0" {{ empty($post->Amoxicillin_is_sensitive) || $post->Amoxicillin_is_sensitive == 0 ? "checked" : "" }} name="Amoxicillin_is_sensitive">
                                                        <label class="form-check-label" for="wheelchair-radio8">զգայուն չէ</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <x-forms.text-field type="textarea" name="antibiotk_Amoxicillin" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                                                value="{{ $post->antibiotk_Amoxicillin }}" label="" />
                                        </td>
                                        <td>
                                            <div class="row my-2">
                                                <div class="col-md-5">
                                                    <p>Ցեֆոտաքսիմ (կլաֆորան)</p>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-check form-check-inline mr-1">
                                                        <input class="form-check-input" id="wheelchair-radio7" type="radio" value="1" {{ isset($post->Cefotaxime_is_sensitive) ? "checked" : "" }} name="Cefotaxime_is_sensitive">
                                                        <label class="form-check-label" for="wheelchair-radio7">զգայուն է</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 pr-0">
                                                    <div class="form-check form-check-inline mr-1">
                                                        <input class="form-check-input" id="wheelchair-radio8" type="radio" value="0" {{ empty($post->Cefotaxime_is_sensitive) || $post->Cefotaxime_is_sensitive == 0 ? "checked" : "" }} name="Cefotaxime_is_sensitive">
                                                        <label class="form-check-label" for="wheelchair-radio8">զգայուն չէ</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <x-forms.text-field type="textarea" name="antibiotk_Cefotaxime" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                                                value="{{ $post->antibiotk_Cefotaxime }}" label="" />
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
                                                        <input class="form-check-input" id="wheelchair-radio7" type="radio" value="1" {{ isset($post->Oxacillin_is_sensitive) ? "checked" : "" }} name="Oxacillin_is_sensitive">
                                                        <label class="form-check-label" for="wheelchair-radio7">զգայուն է</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 pr-0">
                                                    <div class="form-check form-check-inline mr-1">
                                                        <input class="form-check-input" id="wheelchair-radio8" type="radio" value="0" {{ empty($post->Oxacillin_is_sensitive) || $post->Oxacillin_is_sensitive == 0 ? "checked" : "" }} name="Oxacillin_is_sensitive">
                                                        <label class="form-check-label" for="wheelchair-radio8">զգայուն չէ</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <x-forms.text-field type="textarea" name="antibiotk_Oxacillin" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                                                value="{{ $post->antibiotk_Oxacillin }}" label="" />
                                        </td>
                                        <td>
                                            <div class="row my-2">
                                                <div class="col-md-5">
                                                    <p>Ցեֆտազիդիմ (ֆորտում)</p>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-check form-check-inline mr-1">
                                                        <input class="form-check-input" id="wheelchair-radio7" type="radio" value="1" {{ isset($post->Ceftazidime_is_sensitive) ? "checked" : "" }} name="Ceftazidime_is_sensitive">
                                                        <label class="form-check-label" for="wheelchair-radio7">զգայուն է</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 pr-0">
                                                    <div class="form-check form-check-inline mr-1">
                                                        <input class="form-check-input" id="wheelchair-radio8" type="radio" value="0" {{ empty($post->Ceftazidime_is_sensitive) || $post->Ceftazidime_is_sensitive == 0 ? "checked" : "" }} name="Ceftazidime_is_sensitive">
                                                        <label class="form-check-label" for="wheelchair-radio8">զգայուն չէ</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <x-forms.text-field type="textarea" name="antibiotk_Ceftazidime" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                                                value="{{ $post->antibiotk_Ceftazidime }}" label="" />
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
                                                        <input class="form-check-input" id="wheelchair-radio7" type="radio" value="1" {{ isset($post->Gentamicin_is_sensitive) ? "checked" : "" }} name="Gentamicin_is_sensitive">
                                                        <label class="form-check-label" for="wheelchair-radio7">զգայուն է</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 pr-0">
                                                    <div class="form-check form-check-inline mr-1">
                                                        <input class="form-check-input" id="wheelchair-radio8" type="radio" value="0" {{ empty($post->Gentamicin_is_sensitive) || $post->Gentamicin_is_sensitive == 0 ? "checked" : "" }} name="Gentamicin_is_sensitive">
                                                        <label class="form-check-label" for="wheelchair-radio8">զգայուն չէ</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <x-forms.text-field type="textarea" name="antibiotk_Gentamicin" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                                                value="{{ $post->antibiotk_Gentamicin }}" label="" />
                                        </td>
                                        <td>
                                            <div class="row my-2">
                                                <div class="col-md-5">
                                                    <p>Ցեֆուրոքսիմ (զինացեֆ)</p>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-check form-check-inline mr-1">
                                                        <input class="form-check-input" id="wheelchair-radio7" type="radio" value="1" {{ isset($post->Cefuroxime_is_sensitive) ? "checked" : "" }} name="Cefuroxime_is_sensitive">
                                                        <label class="form-check-label" for="wheelchair-radio7">զգայուն է</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 pr-0">
                                                    <div class="form-check form-check-inline mr-1">
                                                        <input class="form-check-input" id="wheelchair-radio8" type="radio" value="0" {{ empty($post->Cefuroxime_is_sensitive) || $post->Cefuroxime_is_sensitive == 0 ? "checked" : "" }} name="Cefuroxime_is_sensitive">
                                                        <label class="form-check-label" for="wheelchair-radio8">զգայուն չէ</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <x-forms.text-field type="textarea" name="antibiotk_Cefuroxime" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                                                value="{{ $post->antibiotk_Cefuroxime }}" label="" />
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
                                                        <input class="form-check-input" id="wheelchair-radio7" type="radio" value="1" {{ isset($post->Vancomycin_is_sensitive) ? "checked" : "" }} name="Vancomycin_is_sensitive">
                                                        <label class="form-check-label" for="wheelchair-radio7">զգայուն է</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 pr-0">
                                                    <div class="form-check form-check-inline mr-1">
                                                        <input class="form-check-input" id="wheelchair-radio8" type="radio" value="0" {{ empty($post->Vancomycin_is_sensitive) || $post->Vancomycin_is_sensitive == 0 ? "checked" : "" }} name="Vancomycin_is_sensitive">
                                                        <label class="form-check-label" for="wheelchair-radio8">զգայուն չէ</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <x-forms.text-field type="textarea" name="antibiotk_Vancomycin" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                                                value="{{ $post->antibiotk_Vancomycin }}" label="" />
                                        </td>
                                        <td>
                                            <div class="row my-2">
                                                <div class="col-md-5">
                                                    <p>Ցեֆտրիաքսոն (ռոտացեֆ)</p>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-check form-check-inline mr-1">
                                                        <input class="form-check-input" id="wheelchair-radio7" type="radio" value="1" {{ isset($post->Ceftriaxone_is_sensitive) ? "checked" : "" }} name="Ceftriaxone_is_sensitive">
                                                        <label class="form-check-label" for="wheelchair-radio7">զգայուն է</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 pr-0">
                                                    <div class="form-check form-check-inline mr-1">
                                                        <input class="form-check-input" id="wheelchair-radio8" type="radio" value="0" {{ empty($post->Ceftriaxone_is_sensitive) || $post->Ceftriaxone_is_sensitive == 0 ? "checked" : "" }} name="Ceftriaxone_is_sensitive">
                                                        <label class="form-check-label" for="wheelchair-radio8">զգայուն չէ</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <x-forms.text-field type="textarea" name="antibiotk_Ceftriaxone" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                                                value="{{ $post->antibiotk_Ceftriaxone }}" label="" />
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
                                                        <input class="form-check-input" id="wheelchair-radio7" type="radio" value="1" {{ isset($post->Imipenem_is_sensitive) ? "checked" : "" }} name="Imipenem_is_sensitive">
                                                        <label class="form-check-label" for="wheelchair-radio7">զգայուն է</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 pr-0">
                                                    <div class="form-check form-check-inline mr-1">
                                                        <input class="form-check-input" id="wheelchair-radio8" type="radio" value="0" {{ empty($post->Imipenem_is_sensitive) || $post->Imipenem_is_sensitive == 0 ? "checked" : "" }} name="Imipenem_is_sensitive">
                                                        <label class="form-check-label" for="wheelchair-radio8">զգայուն չէ</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <x-forms.text-field type="textarea" name="antibiotk_Imipenem" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                                                value="{{ $post->antibiotk_Imipenem }}" label="" />
                                        </td>
                                        <td>
                                            <div class="row my-2">
                                                <div class="col-md-5">
                                                    <p>Մոքսիֆլոքսացին (ավելոքս)</p>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-check form-check-inline mr-1">
                                                        <input class="form-check-input" id="wheelchair-radio7" type="radio" value="1" {{ isset($post->Moxifloxacin_is_sensitive) ? "checked" : "" }} name="Moxifloxacin_is_sensitive">
                                                        <label class="form-check-label" for="wheelchair-radio7">զգայուն է</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 pr-0">
                                                    <div class="form-check form-check-inline mr-1">
                                                        <input class="form-check-input" id="wheelchair-radio8" type="radio" value="0" {{ empty($post->Moxifloxacin_is_sensitive) || $post->Moxifloxacin_is_sensitive == 0 ? "checked" : "" }} name="Moxifloxacin_is_sensitive">
                                                        <label class="form-check-label" for="wheelchair-radio8">զգայուն չէ</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <x-forms.text-field type="textarea" name="antibiotk_Moxifloxacin" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                                                value="{{ $post->antibiotk_Moxifloxacin }}" label="" />
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
                                                        <input class="form-check-input" id="wheelchair-radio7" type="radio" value="1" {{ isset($post->Penicillin_is_sensitive) ? "checked" : "" }} name="Penicillin_is_sensitive">
                                                        <label class="form-check-label" for="wheelchair-radio7">զգայուն է</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 pr-0">
                                                    <div class="form-check form-check-inline mr-1">
                                                        <input class="form-check-input" id="wheelchair-radio8" type="radio" value="0" {{ empty($post->Penicillin_is_sensitive) || $post->Penicillin_is_sensitive == 0 ? "checked" : "" }} name="Penicillin_is_sensitive">
                                                        <label class="form-check-label" for="wheelchair-radio8">զգայուն չէ</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <x-forms.text-field type="textarea" name="antibiotk_Penicillin" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                                                value="{{ $post->antibiotk_Penicillin }}" label="" />
                                        </td>
                                        <td>
                                            <div class="row my-2">
                                                <div class="col-md-5">
                                                    <p>Նորֆլոքսացին</p>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-check form-check-inline mr-1">
                                                        <input class="form-check-input" id="wheelchair-radio7" type="radio" value="1" {{ isset($post->Norfloxacin_is_sensitive) ? "checked" : "" }} name="Norfloxacin_is_sensitive">
                                                        <label class="form-check-label" for="wheelchair-radio7">զգայուն է</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 pr-0">
                                                    <div class="form-check form-check-inline mr-1">
                                                        <input class="form-check-input" id="wheelchair-radio8" type="radio" value="0" {{ empty($post->Norfloxacin_is_sensitive) || $post->Norfloxacin_is_sensitive == 0 ? "checked" : "" }} name="Norfloxacin_is_sensitive">
                                                        <label class="form-check-label" for="wheelchair-radio8">զգայուն չէ</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <x-forms.text-field type="textarea" name="antibiotk_Norfloxacin" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                                                value="{{ $post->antibiotk_Norfloxacin }}" label="" />
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
                                                        <input class="form-check-input" id="wheelchair-radio7" type="radio" value="1" {{ isset($post->Metronidazole_is_sensitive) ? "checked" : "" }} name="Metronidazole_is_sensitive">
                                                        <label class="form-check-label" for="wheelchair-radio7">զգայուն է</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 pr-0">
                                                    <div class="form-check form-check-inline mr-1">
                                                        <input class="form-check-input" id="wheelchair-radio8" type="radio" value="0" {{ empty($post->Metronidazole_is_sensitive) || $post->Metronidazole_is_sensitive == 0 ? "checked" : "" }} name="Metronidazole_is_sensitive">
                                                        <label class="form-check-label" for="wheelchair-radio8">զգայուն չէ</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <x-forms.text-field type="textarea" name="antibiotk_Metronidazole" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                                                value="{{ $post->antibiotk_Metronidazole }}" label="" />
                                        </td>
                                        <td>
                                            <div class="row my-2">
                                                <div class="col-md-5">
                                                    <p>Ցեֆոպերազոն</p>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-check form-check-inline mr-1">
                                                        <input class="form-check-input" id="wheelchair-radio7" type="radio" value="1" {{ isset($post->Cefoperazone_is_sensitive) ? "checked" : "" }} name="Cefoperazone_is_sensitive">
                                                        <label class="form-check-label" for="wheelchair-radio7">զգայուն է</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 pr-0">
                                                    <div class="form-check form-check-inline mr-1">
                                                        <input class="form-check-input" id="wheelchair-radio8" type="radio" value="0" {{ empty($post->Cefoperazone_is_sensitive) || $post->Cefoperazone_is_sensitive == 0 ? "checked" : "" }} name="Cefoperazone_is_sensitive">
                                                        <label class="form-check-label" for="wheelchair-radio8">զգայուն չէ</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <x-forms.text-field type="textarea" name="antibiotk_Cefoperazone" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                                                value="{{ $post->antibiotk_Cefoperazone }}" label="" />
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
                                                        <input class="form-check-input" id="wheelchair-radio7" type="radio" value="1" {{ isset($post->Doxicillin_is_sensitive) ? "checked" : "" }} name="Doxicillin_is_sensitive">
                                                        <label class="form-check-label" for="wheelchair-radio7">զգայուն է</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 pr-0">
                                                    <div class="form-check form-check-inline mr-1">
                                                        <input class="form-check-input" id="wheelchair-radio8" type="radio" value="0" {{ empty($post->Doxicillin_is_sensitive) || $post->Doxicillin_is_sensitive == 0 ? "checked" : "" }} name="Doxicillin_is_sensitive">
                                                        <label class="form-check-label" for="wheelchair-radio8">զգայուն չէ</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <x-forms.text-field type="textarea" name="antibiotk_Doxicillin" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                                                value="{{ $post->antibiotk_Doxicillin }}" label="" />
                                        </td>
                                        <td>
                                            <div class="row my-2">
                                                <div class="col-md-5">
                                                    <p>Ֆուրադոնին</p>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-check form-check-inline mr-1">
                                                        <input class="form-check-input" id="wheelchair-radio41" type="radio" value="1" {{ isset($post->furodonin_is_sensitive) ? "checked" : "" }} name="furodonin_is_sensitive">
                                                        <label class="form-check-label" for="wheelchair-radio41">զգայուն է</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 pr-0">
                                                    <div class="form-check form-check-inline mr-1">
                                                        <input class="form-check-input" id="wheelchair-radio42" type="radio" {{ empty($post->furodonin_is_sensitive) || $post->furodonin_is_sensitive == 0 ? "checked" : "" }} value="0" name="furodonin_is_sensitive">
                                                        <label class="form-check-label" for="wheelchair-radio42">զգայուն չէ</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <x-forms.text-field type="textarea" name="antibiotk_furodonin" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                                                value="{{$post->antibiotk_furodonin}}" label="" />
                                        </td>

                                    </tr>

                                </table>
                            </div>
                        </div>
                    <li class="list-group-item">
                        <strong>Հետազոտությունը իրականացնող բժշկի անուն, ազգանուն</strong>
                        <x-forms.magic-search hidden-id="attending_doctor_id" hidden-name="attending_doctor_id"
                                              placeholder="Ընտրել բուժող բժիշկին․․․" class="magic-search ajax my-2" data-list-name="users"
                                              value="{{ $post->attending_doctor_id }}" />
                    </li>
                    <li class="list-group-item">
                        <strong>Հակաբիոտիկների հանդեպ զգայունության որոշման պատասխանի տրման օր, ամիս, տարի</strong>
                        <ins class="ml-4">
                            <x-forms.text-field name="antibiotic_sensitive_date" validation-type="ajax" type="date"
                                                value="{{ $post->antibiotic_sensitive_date }}" label="" />
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
