@extends('layouts.cardBase')


@section('css')
<link href="{{mix("/css/jquery.magicsearch.min.css")}}" rel="stylesheet" />
@endsection


@section('card-header')
@section('card-header-classes', '')

<div class="text-center">
    <h3>ԿԼԻՆԻԿԱԿԱՆ ԼԱԲՈՐԱՏՈՐԻԱ</h3>
    <h3>ԲԺՇԿԱԿԱՆ ՁԵՎ N 12</h3>
</div>
@endsection


@section('card-content')  

<div class="container">
    <form class="ajax-submitable" action="{{route('samples.patients.clinical-lab-n12.update', ['patient'=> $patient, $cl->id])}}  " method="POST">
        @csrf
        @method('put')
        <ul class="list-group">
                <li class="list-group-item">
                    <div class="form-row align-items-center">
                        <div class="col-md-6">
                            <strong>Մեզի հետազոտություն № </span></strong>
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
                        <x-forms.magic-search class="magic-search ajax" value='' hidden-id="department_id" validationType="ajax"
                        hidden-name="department_id" data-catalog-name="departments" placeholder="ընտրել բաժանմունքը․․․" 
                        value="{{$cl->department_id}}"/>
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
                    placeholder="Ընտրել ուղեգրող բժիշկին․․․" class="my-2 user_search"
                    value="{{$cl->sender_doctor_id}}"/>
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
                    <li class="list-group-item list-group-item-info">
                        <h4 class="text-center">
                        ՖԻԶԻԿԱՔԻՄԻԱԿԱՆ ՀԱՏԿՈՒԹՅՈՒՆՆԵՐ 
                        </h4>
                    </li>
                <li class="list-group-item">
                    <strong>Քանակը լ.</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="number"  step="0.1" min="0" name="count_l" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$cl->count_l}}" label="" /> 
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Քանակը մլ.</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="number"  step="0.1" min="0" name="count_ml" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$cl->count_ml}}" label="" /> 
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" min="0" name="color" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$cl->color}}" label="Գույնը" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Թափանցիկությունը</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="transparency" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$cl->transparency}}" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Հարաբերական խտությունը</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="number"  step="0.1" name="relative_density" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$cl->relative_density}}" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Ռեակցիա</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="reaction" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$cl->reaction}}" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Սպիտակուց գ/լ</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="number"  step="0.1" name="protein_gl" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$cl->protein_gl}}" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Սպիտակուց գ%</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="number"  step="0.1" name="protein_g" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$cl->protein_g}}" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Գլյուկոզ մմոլ/լ</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="number"  step="0.1" name="glucose_mmol" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$cl->glucose_mmol}}" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Գլյուկոզ գ%</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="number"  step="0.1" name="glucose_g" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$cl->glucose_g}}" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Կետոնային մարմիններ</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="number"  step="0.1" name="ketone_bodies" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$cl->ketone_bodies}}" label="" />
                    </div>
                </li>

                @php 

                $hemoglobin_array = ['դրական','թույլ','արտահայտված','բացասական'];

                @endphp
                
                <li class="list-group-item">
                    <h5>Հեմոգլոբին ռեակցիա ` </h5>
                    {{-- @dump($cl->hemoglobin) --}}
                    <select name="hemoglobin" id="">
                        @foreach($hemoglobin_array as $key => $item)
                            <option {{$cl->hemoglobin == ($key+1) ? 'selected' : '' }} value="{{$key+1}}">{{$item}}</option>
                        @endforeach
                        </select>
                </li>

                <li class="list-group-item">
                    <strong>Բիլիռուբին</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="bilirubin" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$cl->bilirubin}}" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Ուռոբիլինոիդներ</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="urobilinoids" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$cl->urobilinoids}}" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Լեղաթթուներ</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="bile_acids" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$cl->bile_acids}}" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Ինդիկան</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="indica" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$cl->indica}}" label="" />
                    </div>
                </li>


                <li class="list-group-item list-group-item-info">
                        <h4 class="text-center">
                        ՄԱՆՐԱԴԻՏՈՒՄ
                        </h4>
                    </li>
                <li class="list-group-item text-center">
                    
                </li>
                <li class="list-group-item">
                    <h4 class="text-center">Էպիթել`</h4>
                    <strong>Տափակ</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="flat" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$cl->flat}}" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Անցումային</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="transitional" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$cl->transitional}}" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Երիկամային</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="renal" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$cl->renal}}" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Լեյկոցիտներ</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="leukocytes" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$cl->leukocytes}}" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Էրիթրոցիտներ</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="erythrocytes" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$cl->erythrocytes}}" label="" />
                    </div>
                </li>

                <li class="list-group-item">
                    <div class="row">
                        <div class="col-md-8">
                            
                            @dump($cl->erythrocytes_bool)
                            <x-forms.checkbox-radio pos="align" id="erythrocytes_bool-radio1" value="{{$cl->erythrocytes_bool == 0 ? 'checked' : ''}}" name="erythrocytes_bool" label="Անփոփոխ "/>
                            <x-forms.checkbox-radio pos="align" id="erythrocytes_bool-radio2" value="{{$cl->erythrocytes_bool == 1 ? 'checked' : ''}}" name="erythrocytes_bool" label="Փոփոխված"/>

                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <h4 class="text-center">Գլանակներ`</h4>
                    <strong> Հիալինային</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="hyalina" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$cl->hyalina}}" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Հատիկավոր</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="granular" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$cl->granular}}" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Մոմանման</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="wax" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$cl->wax}}" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Էպիթելային</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="epithelial" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$cl->epithelial}}" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Լեյկոցիտար</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="leukocyte" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$cl->leukocyte}}" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>էրիթրոցիտար</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="erythrocytar" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$cl->erythrocytar}}" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Պիգմենտային</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="pigmented" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$cl->pigmented}}" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Լորձ</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="mucus" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$cl->mucus}}" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Աղեր</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="salts" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$cl->salts}}" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Բակտերիաներ</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="bacteria" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$cl->bacteria}}" label="" />
                    </div>
                </li>


                <li class="list-group-item">
                    <strong>Հետազոտությունը իրականացնող բժիշկ</strong>
                    <x-forms.magic-search hidden-id="cl_attending_doctor_id" hidden-name="attending_doctor_id"
                    placeholder="Ընտրել բուժող բժիշկին․․․" class="my-2 user_search" value="{{$cl->attending_doctor_id}}"/>
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