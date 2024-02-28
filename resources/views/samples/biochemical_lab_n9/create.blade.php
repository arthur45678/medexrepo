@extends('layouts.cardBase')


@section('css')
<link href="{{mix("/css/jquery.magicsearch.min.css")}}" rel="stylesheet" />
@endsection


@section('card-header')
@section('card-header-classes', '')

<div class="text-center">
    <h3>ԿԵՆՍԱՔԻՄԻԱԿԱՆ ԼԱԲՈՐԱՏՈՐԻԱ ԲԺՇԿԱԿԱՆ ՁԵՎ N 9</span></h3>
</div>
@endsection


@section('card-content')

<div class="container">
    <form class="ajax-submitable" action="{{route('samples.patients.biochemical-lab-n9.store', ['patient'=> $patient])}}" method="POST">
        @csrf
        <ul class="list-group">
            <li class="list-group-item">
                <div class="form-row align-items-center">
                    <div class="col-md-6">
                        <strong>Արյունաբանական հետազոտություն № </span></strong>
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
                    <x-forms.text-field type="number" step="0.1" name="total_protein" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="" label="Ընդհանուր սպիտակուց /TP/ նորմա - 65 – 85 գ/լ" />
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="number" step="0.1" name="albumin" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="" label="Ալբումին /ALB/ նորմա - 39-52գ/լ" />
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="number" step="0.1" name="urine" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="" label="Միզանյութ /UREA/ նորմա - 2.5 – 7,3մմոլ/լ" />
                </div>
            </li>
            
            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="number" step="0.1" name="creatine_man" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="" label="Կրեատինին /CREA/ Տ. նորմա - 66-110 մկմոլ/լ" />
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="number" step="0.1" name="creatine_wooman" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="" label="Կրեատինին /CREA/ Կ. նորմա - /44-94 մկմոլ/լ" />
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="number" step="0.1" name="cystatin" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="" label="Ցիստատին Ց /Cys. C/ նորմա - 0.54-1.55 մգ/լ" />
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="number" step="0.1" name="uric_acid" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="" label="Միզաթթու /URIC ACID/ նորմա - 200-420 մկմոլ/լ" />
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="number" step="0.1" name="total_cholesterol" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="" label="Ընդհանուր խոլեստերին /Chol tot/ նորմա - < 5,2մմոլ/լ" />
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="number" step="0.1" name="low_density_lipoproteins" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="" label="Ցածր խտությամբ լիպոպրոտեիդներ/ Chol LDL/ նորմա - 1,6-4,9 մմոլ/լ" />
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="number" step="0.1" name="high_density_lipoproteins" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="" label="Բարձր խտությամբ լիպոպրոտեիդներ / Chol HDL/ նորմա - 0,9-1,82 մմոլ/լ" />
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="number" step="0.1" name="triglycerides" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="" label="Տրիգլիցերիդներ / TRIG/ նորմա - 0,45-1,8 մմոլ/լ" />
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="number" step="0.1" name="total_bilirubin" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="" label="Ընդհանուր բիլիռուբին /Bil-tot/ նորմա - 8.55 – 20.5 մկմոլ/լ" />
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="number" step="0.1" name="related_bilirubin" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="" label="կապված բիլիռուբին /Bil-dir/ նորմա - 0 – 5.1 մկմոլ/լ" />
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="number" step="0.1" name="free_bilirubin" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="" label="ազատ բիլիռուբին նորմա - 8.55 – 15.4 մկմոլ/լ" />
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="number" step="0.1" name="glucose" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="" label="Գլյուկոզ/GLU/մազանոթ./երակային նորմա - 3,3-5,5 / 3,5-6.4 մմոլ/լ" />
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="number" step="0.01" name="troponin" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="" label="Տրոպոնին Տ նորմա - մինչև 0,1նգ/մլ" />
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="number" step="0.1" name="glycosylated_hemoglobin" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="" label="Գլիկոլիզացված հեմոգլոբին HbA1C նորմա - մինչև 6,5%" />
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="number" step="0.1" name="insulin" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="" label="INS- Ինսուլին նորմա - 29-172 պմ/լ" />
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="number" step="0.1" name="pre_insulin" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="" label="Proins.- Նախաինսուլին նորմա - 1-9,4 պմ/լ" />
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="number" step="0.1" name="peptide" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="" label="C-Pept. -Ց-պեպտիդ նորմա - 0,5-3,0նգ/մլ" />
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="number" step="0.1" name="alpha_amylase" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="" label="Ալֆա ամիլազ /AMYL/ նորմա - 25-220 մմոլ/լ" />
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="number" step="0.1" name="uroamylase" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="" label="Ուրոամիլազ /UAMYL/ նորմա - 10-490 մմոլ/լ" />
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="number" step="0.1" name="lipase" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="" label="Լիպազ /LIP/ նորմա - մինչև190 մմոլ/լ" />
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="number" step="0.1" name="basic_phosphatase" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="" label="Հիմնային ֆոսֆատազ /ALP/ նորմա - 30-120 մմոլ/լ" />
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="number" step="0.1" name="acid_phosphatase" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="" label="Թթվային ֆոսֆատազ /ACP/ նորմա - 0-6,5 մմոլ/լ" />
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="number" step="0.1" name="gammaglutamyltransferase" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="" label="Գամագլուտամիլտրանսֆերազ /GGT/ նորմա - 6-19 մմոլ/լ" />
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="number" step="0.1" name="aspartateaminotransferase" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="" label="Ասպարտատամինոտրանսֆերազա /AST/ նորմա - մինչև 35 մմոլ/լ" />
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="number" step="0.1" name="alanineaminotransferase" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="" label="Ալանինատամինոտրանսֆերազ /ALT/ նորմա - մինչև 40 մմոլ/լ" />
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="number" step="0.1" name="lactatedehydrogenase" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="" label="Լակտատդեհիդրոգենազ /LDH/ նորմա - 120-240 մմոլ/լ" />
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="number" step="0.1" name="cholinesterase" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="" label="Խոլինէսթերազ /CHOE նորմա - 5200-12000 մմոլ/լ" />
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="number" step="0.1" name="creatine_kinase_general_man" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="" label="Կրեատինկինազա-ընդհանուր /KK/ Տ. նորմա - 60-200մմոլ/" />
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="number" step="0.1" name="creatine_kinase_general_wooman" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="" label="Կրեատինկինազա-ընդհանուր /KK/ Կ. նորմա - 35-170 մմոլ/" />
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="number" step="0.1" name="creatine_kinase" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="" label="Կրեատինկինազա-ՄԲ/KK-MB/ նորմա - մինչև 25 մմոլ/լ" />
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