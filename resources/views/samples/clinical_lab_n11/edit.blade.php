@extends('layouts.cardBase')


@section('css')
<link href="{{mix("/css/jquery.magicsearch.min.css")}}" rel="stylesheet" />
@endsection


@section('card-header')
@section('card-header-classes', '')

<div class="text-center">
    <h3>ԿԼԻՆԻԿԱԿԱՆ ԼԱԲՈՐԱՏՈՐԻԱ</h3>
    <h3>ԲԺՇԿԱԿԱՆ ՁԵՎ N 11</h3>
</div>
@endsection


@section('card-content')

<div class="container">
    <form class="ajax-submitable" action="{{route('samples.patients.clinical-lab-n11.update', ['patient'=> $patient , $cl->id])}} " method="POST">
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
                                    placeholder="լրացրեք համապատասխան թիվը․․․" id="height" value="{{$cl->bbe_number}}"  readonly min="1"  label=""/>
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
                                value="{{$cl->biopsy_date}}" label="" />
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
                        <x-forms.magic-search class="magic-search ajax" value='{{$cl->department_id}}' hidden-id="department_id" validationType="ajax"
                        hidden-name="department_id" data-catalog-name="departments" placeholder="ընտրել բաժանմունքը․․․" />
                        <em class="error text-danger" data-input="department_id"></em>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="mt-2">
                        <x-forms.text-field type="number" min="1" name="chamber" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$cl->chamber}}" label="Պալատ" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Ուղեգրող բժիշկ</strong>
                    <x-forms.magic-search hidden-id="sender_doctor_id" hidden-name="sender_doctor_id"
                    value="{{$cl->sender_doctor_id}}" placeholder="Ընտրել ուղեգրող բժիշկին․․․" class="my-2 user_search"/>
                    <em class="error text-danger" data-input="sender_doctor_id"></em>
                </li>
                <li class="list-group-item">
                    <strong>Ամբուլատոր բժշկական քարտի № </strong>
                    <ins class="ml-4">{{$ambulator_id}}</ins>
                </li>
                <li class="list-group-item">
                    <strong>Հիվանդության պատմագրի № </strong>
                    
                    <select name="stationary_id" id="stationary_id" class="form-control my-2">
                        @foreach($all_stationary_id as $key => $item)
                                    <option {{$cl->stationary_id == ($key+1) ? 'selected' : '' }} value="{{$key+1}}">{{$item}}</option>
                        @endforeach
                    </select>
                    
                 </li>

                <li class="list-group-item">
                    <div class="mt-2">
                        <x-forms.text-field type="number"  step="0.1" name="hemoglobin_man" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$cl->hemoglobin_man}}" label="Հեմոգլոբին Նորմա - Տ Տ130.0-160.0130.0-160.0 գ/լ" />
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="mt-2">
                        <x-forms.text-field type="number"  step="0.1" name="hemoglobin_wooman" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$cl->hemoglobin_wooman}}" label="Հեմոգլոբին Նորմա - Կ 120.0-140.0 գ/լ" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Էրիթրոցիտներ Նորմա - Տ 4.0-5.0 10<sup>12</sup> /լ</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="number"  step="0.1" name="erythrocytes_man" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$cl->erythrocytes_man}}" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Էրիթրոցիտներ Նորմա -  Կ 3.9-4.7 10 <sup>12</sup> /լ</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="number"  step="0.1" name="erythrocytes_wooman" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$cl->erythrocytes_wooman}}" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Գունային ցուցանիշ Նորմա - 0.85-1.05</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="number"  step="0.1" name="color_index" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$cl->color_index}}" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Արյան մակարդելիության ժամանակը ըստ Սուխարևի Նորմա - սկիզբը 3 – վերջը 5 րոպե</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="number"  step="0.1" name="blood_coagulation" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$cl->blood_coagulation}}" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Ռետիկուլոցիտներ Նորմա - 2-10 %</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="number"  step="0.1" name="reticulocytes" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$cl->reticulocytes}}" label="" />
                    </div>
                </li>
                {{-- <li class="list-group-item">
                    <strong>Գունային ցուցանիշ Նորմա - 0.85-1.05</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="number"  step="0.1" name="" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="" label="" />
                    </div>
                </li> --}}
                <li class="list-group-item">
                    <strong>Թրոմբոցիտներ Նորմա - 150.0-400.0 10<sup>9</sup> /լ </strong>
                    <div class="mt-2">
                        <x-forms.text-field type="number"  step="0.1" name="platelets" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$cl->platelets}}" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Լեյկոցիտներ Նորմա - 4.0-10.0 10<sup>9</sup> /լ </strong>
                    <div class="mt-2">
                        <x-forms.text-field type="number"  step="0.1" name="leukocytes" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$cl->leukocytes}}" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Բլաստներ %</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="number"  step="0.1" name="blasts" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$cl->blasts}}" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Նեյտրոֆիլներ</strong>
                </li>
                <li class="list-group-item">
                    <strong>Պրոմիելոցիտներ 10<sup>9</sup> /լ </strong>
                    <div class="mt-2">
                        <x-forms.text-field type="number"  step="0.1" name="promyelocytes" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$cl->promyelocytes}}" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Միելոցիտներ</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="number"  step="0.1" name="myelocytes" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$cl->myelocytes}}" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Մետամիլեոցիտներ</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="number"  step="0.1" name="metamyelocytes" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$cl->metamyelocytes}}" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Ցուպիկակորիզավորներ Նորմա - 1-6</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="number"  step="0.1" name="nozzles" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$cl->nozzles}}" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Հատվածակորիզավորներ Նորմա - 47-72</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="number"  step="0.1" name="segmented_stones" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$cl->segmented_stones}}" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Էոզինոֆիլներ Նորմա - 0.5-5</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="number"  step="0.1" name="eosinophils" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$cl->eosinophils}}" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Բազոֆիլներ Նորմա - 0,1</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="number"  step="0.1" name="basophils" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$cl->basophils}}" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Լիմֆոցիտներ Նորմա - 19-37</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="number"  step="0.1" name="lymphocytes" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$cl->lymphocytes}}" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Մոնոցիտներ Նորմա - 3-11</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="number"  step="0.1" name="monocytes" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$cl->monocytes}}" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Էրիթրոցիտների նստեցման արագություն /ռեակցիա/ ԷՆԱ Նորմա - Տ 2-10 մմ/ժ</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="number"  step="0.1" name="erythrocyte_sedimentation_man" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$cl->erythrocyte_sedimentation_man}}" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Էրիթրոցիտների նստեցման արագություն /ռեակցիա/ ԷՆԱ Նորմա - Կ 2-15 մմ/ժ</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="number"  step="0.1" name="erythrocyte_sedimentation_wooman" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$cl->erythrocyte_sedimentation_wooman}}" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Պլազմոցիտներ</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="number"  step="0.1" name="plasma_cells" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$cl->plasma_cells}}" label="" />
                    </div>
                </li>
                <li class="list-group-item list-group-item-info">
                    <h4 class="text-center">
                        ԷՐԻԹՐՈՑԻՏՆԵՐԻ ՁԵՎԱԲԱՆՈՒԹՅՈՒՆ 
                    </h4>
                </li>
                <li class="list-group-item">
                    <strong>Անիզոցիտոզ (մակրոցիտներ, միկրոցիտներ, մեգալոցիտներ)</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="anisocytosis" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$cl->anisocytosis}}" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Պոյկիլոցիտոզ</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="poikilocytosis" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$cl->poikilocytosis}}" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Բազոֆիլային հատիկավորմամբ էրիթրոցիտներ</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="erythrocytes_with_basophilic" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$cl->erythrocytes_with_basophilic}}" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Պոլիքրոմատոֆիլիա</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="polychromatophilia" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$cl->polychromatophilia}}" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Ժոլիի մարմիններ, Կեբոտի օղակներ </strong>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="jolies_bodies" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$cl->jolies_bodies}}" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Էրիթրո-նորմոբլաստներ (100 լեյկոցիտի համար) </strong>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="erythro_normoblasts" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$cl->erythro_normoblasts}}" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Մեգալոբլաստներ</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="megaloblasts" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$cl->megaloblasts}}" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Լեյկոցիտների ձևաբանություն </strong>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="leukocyte_morphology" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$cl->leukocyte_morphology}}" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Կորիզների գերհատվածավորում</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="core_overdose" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$cl->core_overdose}}" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Թունածին հատիկավորում</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="toxic_granulation" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$cl->toxic_granulation}}" label="" />
                    </div>
                </li>

                <li class="list-group-item">
                    <strong>Հետազոտությունը իրականացնող բժիշկ</strong>
                        <x-forms.magic-search hidden-id="cl_attending_doctor_id" hidden-name="attending_doctor_id"
                        placeholder="Ընտրել բուժող բժիշկին․․․" class="my-2 user_search" 
                        value="{{$cl->attending_doctor_id}}"/>
                        <em class="error text-danger" data-input="cl_attending_doctor_id"></em>
                </li>

                <li class="list-group-item">
                            <strong>Արյան հետազոտության պատասխանի տրման ամսաթիվ</strong>
                            <x-forms.text-field name="research_date" validationType="ajax" type="date"
                                value="{{$cl->research_date}}" label="" class="my-2" />
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