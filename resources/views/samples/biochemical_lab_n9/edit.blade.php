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
    <form class="ajax-submitable" action="{{route('samples.patients.biochemical-lab-n9.update', ['patient'=> $patient, $bl->id])}}" method="POST">
        @csrf
        @method('put')
        <ul class="list-group">
            <li class="list-group-item">
                <div class="form-row align-items-center">
                    <div class="col-md-6">
                        <strong>Արյունաբանական հետազոտություն № </span></strong>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group align-items-center">
                            <x-forms.text-field type="number" class="col-12" name="bbe_number" 
                                placeholder="լրացրեք համապատասխան թիվը․․․" id="height" value="{{$bl->bbe_number}}" readonly label=""/>
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
                            value="{{$bl->biopsy_date}}" label="" />
                    </div>
                </div>
            </li>
            <li class="list-group-item ">
               <div class="form-row">
                    <div class="col-md-6">
                        <strong>
                         Ազգանուն, անուն, հայրանուն  
                        </strong>
                        <ins class="ml-4">{{$patient->full_name}}</ins>
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
                    <x-forms.magic-search class="magic-search ajax" value='{{$bl->department_id}}' hidden-id="department_id" 
                    hidden-name="department_id" data-catalog-name="departments" placeholder="ընտրել բաժանմունքը․․․" />
                </div>
            </li>
            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="number" min="1" name="chamber" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                    value="{{$bl->chamber}}" label="Պալատ" />
                </div>
            </li>
            <li class="list-group-item">
                <strong>Ուղեգրող բժիշկ</strong>
                <x-forms.magic-search hidden-id="bl_sender_doctor_id" hidden-name="sender_doctor_id"
                placeholder="Ընտրել բուժող բժիշկին․․․" class="magic-search ajax my-2" data-list-name="users"
                value="{{$bl->sender_doctor_id}}" />
            </li>
            <li class="list-group-item">
                 <strong>Ամբուլատոր բժշկական քարտի № </strong>
                 <ins class="ml-4">{{$ambulator_id}}</ins>
            </li>
            <li class="list-group-item">
                <strong>Հիվանդության պատմագրի № </strong>
                <select name="stationary_id" id="stationary_id" class="form-control my-2">
                    @foreach($all_stationary_id as $key => $item)
                                <option {{$bl->stationary_id === ($key+1) ? 'selected' : '' }} value="{{$item}}">{{$item}}</option>
                    @endforeach
                </select>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="number" step="0.1" name="total_protein" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="{{$bl->total_protein}}" label="Ընդհանուր սպիտակուց /TP/ նորմա - 65 – 85 գ/լ" />
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="number" step="0.1" name="albumin" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="{{$bl->albumin}}" label="Ալբումին /ALB/ նորմա - 39-52գ/լ" />
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="number" step="0.1" name="urine" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="{{$bl->urine}}" label="Միզանյութ /UREA/ նորմա - 2.5 – 7,3մմոլ/լ" />
                </div>
            </li>
            
            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="number" step="0.1" name="creatine_man" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="{{$bl->creatine_man}}" label="Կրեատինին /CREA/ Տ. նորմա - 66-110 մկմոլ/լ" />
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="number" step="0.1" name="creatine_wooman" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="{{$bl->creatine_wooman}}" label="Կրեատինին /CREA/ Կ. նորմա - /44-94 մկմոլ/լ" />
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="number" step="0.1" name="cystatin" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="{{$bl->cystatin}}" label="Ցիստատին Ց /Cys. C/ նորմա - 0.54-1.55 մգ/լ" />
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="number" step="0.1" name="uric_acid" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="{{$bl->uric_acid}}" label="Միզաթթու /URIC ACID/ նորմա - 200-420 մկմոլ/լ" />
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="number" step="0.1" name="total_cholesterol" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="{{$bl->total_cholesterol}}" label="Ընդհանուր խոլեստերին /Chol tot/ նորմա - < 5,2մմոլ/լ" />
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="number" step="0.1" name="low_density_lipoproteins" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="{{$bl->low_density_lipoproteins}}" label="Ցածր խտությամբ լիպոպրոտեիդներ/ Chol LDL/ նորմա - 1,6-4,9 մմոլ/լ" />
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="number" step="0.1" name="high_density_lipoproteins" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="{{$bl->high_density_lipoproteins}}" label="Բարձր խտությամբ լիպոպրոտեիդներ / Chol HDL/ նորմա - 0,9-1,82 մմոլ/լ" />
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="number" step="0.1" name="triglycerides" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="{{$bl->triglycerides}}" label="Տրիգլիցերիդներ / TRIG/ նորմա - 0,45-1,8 մմոլ/լ" />
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="number" step="0.1" name="total_bilirubin" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="{{$bl->total_bilirubin}}" label="Ընդհանուր բիլիռուբին /Bil-tot/ նորմա - 8.55 – 20.5 մկմոլ/լ" />
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="number" step="0.1" name="related_bilirubin" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="{{$bl->related_bilirubin}}" label="կապված բիլիռուբին /Bil-dir/ նորմա - 0 – 5.1 մկմոլ/լ" />
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="number" step="0.1" name="free_bilirubin" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="{{$bl->free_bilirubin}}" label="ազատ բիլիռուբին նորմա - 8.55 – 15.4 մկմոլ/լ" />
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="number" step="0.1" name="glucose" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="{{$bl->glucose}}" label="Գլյուկոզ/GLU/մազանոթ./երակային նորմա - 3,3-5,5 / 3,5-6.4 մմոլ/լ" />
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="number" step="0.01" name="troponin" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="{{$bl->troponin}}" label="Տրոպոնին Տ նորմա - մինչև 0,1նգ/մլ" />
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="number" step="0.1" name="glycosylated_hemoglobin" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="{{$bl->glycosylated_hemoglobin}}" label="Գլիկոլիզացված հեմոգլոբին HbA1C նորմա - մինչև 6,5%" />
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="number" step="0.1" name="insulin" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="{{$bl->insulin}}" label="INS- Ինսուլին նորմա - 29-172 պմ/լ" />
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="number" step="0.1" name="pre_insulin" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="{{$bl->pre_insulin}}" label="Proins.- Նախաինսուլին նորմա - 1-9,4 պմ/լ" />
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="number" step="0.1" name="peptide" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="{{$bl->peptide}}" label="C-Pept. -Ց-պեպտիդ նորմա - 0,5-3,0նգ/մլ" />
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="number" step="0.1" name="alpha_amylase" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="{{$bl->alpha_amylase}}" label="Ալֆա ամիլազ /AMYL/ նորմա - 25-220 մմոլ/լ" />
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="number" step="0.1" name="uroamylase" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="{{$bl->uroamylase}}" label="Ուրոամիլազ /UAMYL/ նորմա - 10-490 մմոլ/լ" />
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="number" step="0.1" name="lipase" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="{{$bl->lipase}}" label="Լիպազ /LIP/ նորմա - մինչև190 մմոլ/լ" />
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="number" step="0.1" name="basic_phosphatase" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="{{$bl->basic_phosphatase}}" label="Հիմնային ֆոսֆատազ /ALP/ նորմա - 30-120 մմոլ/լ" />
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="number" step="0.1" name="acid_phosphatase" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="{{$bl->acid_phosphatase}}" label="Թթվային ֆոսֆատազ /ACP/ նորմա - 0-6,5 մմոլ/լ" />
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="number" step="0.1" name="gammaglutamyltransferase" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="{{$bl->gammaglutamyltransferase}}" label="Գամագլուտամիլտրանսֆերազ /GGT/ նորմա - 6-19 մմոլ/լ" />
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="number" step="0.1" name="aspartateaminotransferase" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="{{$bl->aspartateaminotransferase}}" label="Ասպարտատամինոտրանսֆերազ /AST/ նորմա - մինչև 35 մմոլ/լ" />
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="number" step="0.1" name="alanineaminotransferase" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="{{$bl->alanineaminotransferase}}" label="Ալանինատամինոտրանսֆերազ /ALT/ նորմա - մինչև 40 մմոլ/լ" />
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="number" step="0.1" name="lactatedehydrogenase" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="{{$bl->lactatedehydrogenase}}" label="Լակտատդեհիդրոգենազ /LDH/ նորմա - 120-240 մմոլ/լ" />
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="number" step="0.1" name="cholinesterase" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="{{$bl->cholinesterase}}" label="Խոլինէսթերազ /CHOE նորմա - 5200-12000 մմոլ/լ" />
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="number" step="0.1" name="creatine_kinase_general_man" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="{{$bl->creatine_kinase_general_man}}" label="Կրեատինկինազա-ընդհանուր /KK/ Տ. նորմա - 60-200մմոլ/" />
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="number" step="0.1" name="creatine_kinase_general_wooman" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="{{$bl->creatine_kinase_general_wooman}}" label="Կրեատինկինազա-ընդհանուր /KK/ Կ. նորմա - 35-170 մմոլ/" />
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="number" step="0.1" name="creatine_kinase" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="{{$bl->creatine_kinase}}" label="Կրեատինկինազա-ՄԲ/KK-MB/ նորմա - մինչև 25 մմոլ/լ" />
                </div>
            </li>

            <li class="list-group-item">
                <div class="form-row align-items-center">
                    <div class="col-md-6">
                        <strong>Հետազոտության պատասխանի տրման ամսաթիվ</strong>
                    </div>
                    <div class="col-md-6">
                        <x-forms.text-field name="research_date" validationType="ajax" type="date"
                            value="{{$bl->research_date}}" label="" />
                    </div>
                </div>
            </li>

            <li class="list-group-item">
                <strong>Հետազոտությունը իրականացնող բժիշկ</strong>
                <x-forms.magic-search hidden-id="attending_doctor_id" hidden-name="attending_doctor_id"
                placeholder="Ընտրել բուժող բժիշկին․․․" class="magic-search ajax my-2" data-list-name="users"
                value="{{$bl->attending_doctor_id}}" />
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