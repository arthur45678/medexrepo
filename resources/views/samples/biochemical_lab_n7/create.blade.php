@extends('layouts.cardBase')


@section('css')
<link href="{{mix("/css/jquery.magicsearch.min.css")}}" rel="stylesheet" />
@endsection


@section('card-header')
@section('card-header-classes', '')

<div class="text-center">
    <h3>ԿԵՆՍԱՔԻՄԻԱԿԱՆ ԼԱԲՈՐԱՏՈՐԻԱ ԲԺՇԿԱԿԱՆ ՁԵՎ N 7</span></h3>
</div>
@endsection


@section('card-content')

<div class="container">
    <form class="ajax-submitable" action="{{route('samples.patients.biochemical-lab-n7.store', ['patient'=> $patient])}}" method="POST">
        @csrf
        <ul class="list-group">
            <li class="list-group-item">
                <div class="form-row align-items-center">
                    <div class="col-md-6">
                        <strong>ԿՈԱԳՈՒԼՈԳՐԱՄԱ № </span></strong>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group align-items-center">
                            <x-forms.text-field type="number" class="col-12" name="bbe_number" 
                                placeholder="լրացրեք համապատասխան թիվը․․․" id="height" value="{{$next_bbe_number}}"  readonly min="1"  label=""/>
                            <label class="ml-2" for="height"><strong></strong></label>
                        </div>
                    </div>
                </div>
            </li>
            <li class="list-group-item">
                <div class="form-row align-items-center">
                    <div class="col-md-4">
                        <strong>Կենսանյութը վերցնելու ամսաթիվ</strong>
                    </div>
                    <div class="col-md-8">
                        <x-forms.text-field name="biopsy_date" validationType="ajax" type="date"
                            value="" label="" />
                    </div>
                </div>
            </li>
            <li class="list-group-item ">
                <div class="form-row">
                    <div class="col-md-6">
                        <strong>
                            Անուն, ազգանուն, հայրանուն
                        </strong>
                        <ins class="ml-4">{{$patient->f_name}} {{$patient->l_name}} {{$patient->p_name}}</ins>
                    </div>
                    <div class="col-md-6">
                        <strong>
                            Տարիք
                        </strong>
                        <ins class="ml-4">{{$patient->age}}</ins>
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
                    <x-forms.text-field type="number" min="1" name="chamber" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                    value="" label="Պալատ" />
                </div>
            </li>
            <li class="list-group-item">
                <strong>Ուղեգրող բժիշկ</strong>
                <x-forms.magic-search hidden-id="sender_doctor_id" hidden-name="sender_doctor_id"
                placeholder="Ընտրել ուղեգրող բժիշկին․․․" class="my-2 user_search" class="magic-search ajax my-2" data-list-name="users"/>
                <em class="error text-danger" data-input="sender_doctor_id"></em>
            </li>
            <li class="list-group-item">
                 <strong>Ամբուլատոր բժշկական քարտի № </strong>
                 <ins class="ml-4">{{$ambulator_id}}</ins>
            </li>
            <li class="list-group-item">
                <strong>Հիվանդության պատմագրի № </strong>
                
                    @foreach ($all_stationary_id as $key)
                    {{-- <div class="col-md-8"> --}}
                        <select name="stationary_id" id="stationary_id" class="form-control my-2">
                            <option value="{{$key}}">{{$key}}</option>
                        </select>
                    {{-- </div> --}}
                       
                    @endforeach 
                
           </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="number" step="0.1" name="prothrombin_time" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="" label="Պրոթրոմբինային ժամանակ /PT/  նորմա - 12`-16`" />
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="number" step="0.1" name="prothrombin_index" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="" label="Պրոթրոմբինային ինդեքս /iPT/ նորմա - 180-105 %" />
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="number" step="0.1" name="plasma_tolerance" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="" label="Պլազմայի տոլերանտությունը հեպարինի նկատմամբ նորմա - 3-6 րոպե" />
                </div>
            </li>
            
            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="number" step="0.1" name="fibrinogen" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="" label="Ֆիբրինոգեն /FG/ նորմա - 2-4 գ/լ" />
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="number" step="0.1" name="fibrinogen_b" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="" label="Ֆիբրինոգեն «Բ» /FG «B» նորմա - ( - )" />
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="number" step="0.1" name="normalized_international" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="" label="Միջազգային նորմալիզացված հարաբերություն /INR/ նորմա - 1-1,8" />
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="number" step="0.1" name="active_thromboplastin" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="" label="Ակտիվ մասնակի տրոմբոպլաստինային ժամանակ /APTT/ նորմա - 25`-35`" />
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="number" step="0.1" name="thrombin_time" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="" label="Թրոմբինային ժամանակ /TT/ նորմա - 15`-20`" />
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="number" step="0.1" name="ddimer" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="" label="Դդիմեր /D-dimer/ նորմա - < 250 մկգ/լ" />
                </div>
            </li>

            <li class="list-group-item">
                <div class="form-row align-items-center">
                    <div class="col-md-6">
                        <strong>Հետազոտության պատասխանի տրման ամսաթիվ</strong>
                    </div>
                    <div class="col-md-6">
                        <x-forms.text-field name="research_date" validationType="ajax" type="date"
                            value="" label="" />
                    </div>
                </div>
            </li>

            <li class="list-group-item">
                <strong>Հետազոտությունը իրականացնող բժիշկ</strong>
                <x-forms.magic-search hidden-id="attending_doctor_id" hidden-name="attending_doctor_id"
                placeholder="Ընտրել բուժող բժիշկին․․․" class="my-2 user_search" value="{{auth()->id()}}" class="magic-search ajax my-2" data-list-name="users"/>
                <em class="error text-danger" data-input="attending_doctor_id"></em>
            </li>

            @include('shared.forms.list_group_item_submit', ['btn_text'=>'Ուղարկել'])
       
       
        </ul>
    </form>
</div>
@endsection

@section('javascript')
<script src="{{ mix('js/jquery.js') }}"></script>
<script src="{{ mix('js/all.magicsearch.js') }}"></script>

<script>
    const usersUrl = @json(route('lists.users_full'));
    $('.user_search').magicsearch(
        window.medexMagicSearch.assignConfigs({
            type: "ajax",
            dataSource: `${usersUrl}?groupByRole=doctor`,
            fields: ["f_name","l_name"],
            id: "id",
            format: "%f_name% %l_name%",
            success: function($input, data) {
                console.log(data)
                const hidden_input_id = $input.data('hidden');
                $(hidden_input_id).val($input.attr("data-id"));
            },
            afterDelete: function($input, data) {
                const hidden_input_id = $input.data("hidden");
                $(hidden_input_id).val("");
            }
        })
    );

</script>

@endsection