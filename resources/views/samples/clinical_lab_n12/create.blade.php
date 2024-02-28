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
    <form class="ajax-submitable" action="{{route('samples.patients.clinical-lab-n12.store', ['patient'=> $patient])}} " method="POST">
        @csrf
        <ul class="list-group">
                <li class="list-group-item">
                    <div class="form-row align-items-center">
                        <div class="col-md-6">
                            <strong>Մեզի հետազոտություն № </span></strong>
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
                    placeholder="Ընտրել ուղեգրող բժիշկին․․․" class="my-2 user_search"/>
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
                    <li class="list-group-item list-group-item-info">
                        <h4 class="text-center">
                        ՖԻԶԻԿԱՔԻՄԻԱԿԱՆ ՀԱՏԿՈՒԹՅՈՒՆՆԵՐ 
                        </h4>
                    </li>
                <li class="list-group-item">
                    <strong>Քանակը լ.</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="number"  step="0.1" min="0" name="count_l" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="" label="" /> 
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Քանակը մլ.</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="number"  step="0.1" min="0" name="count_ml" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="" label="" /> 
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" min="0" name="color" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="" label="Գույնը" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Թափանցիկությունը</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="transparency" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Հարաբերական խտությունը</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="number"  step="0.1" name="relative_density" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Ռեակցիա</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="reaction" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Սպիտակուց գ/լ</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="number"  step="0.1" name="protein_gl" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Սպիտակուց գ%</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="number"  step="0.1" name="protein_g" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Գլյուկոզ մմոլ/լ</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="number"  step="0.1" name="glucose_mmol" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Գլյուկոզ գ%</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="number"  step="0.1" name="glucose_g" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Կետոնային մարմիններ</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="number"  step="0.1" name="ketone_bodies" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-md-4">
                            <strong>Հեմոգլոբին ռեակցիա</strong>
                        </div>
                        <select name="hemoglobin" id="hemoglobin_id">
                            <option value="1">դրական</option>
                            <option value="2">թույլ</option>
                            <option value="3">արտահայտված</option>
                            <option value="4">բացասական</option>
                        </select>
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Բիլիռուբին</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="bilirubin" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Ուռոբիլինոիդներ</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="urobilinoids" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Լեղաթթուներ</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="bile_acids" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Ինդիկան</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="indica" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="" label="" />
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
                        value="" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Անցումային</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="transitional" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Երիկամային</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="renal" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Լեյկոցիտներ</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="leukocytes" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Էրիթրոցիտներ</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="erythrocytes" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-md-8">
                            <x-forms.checkbox-radio pos="align" id="erythrocytes_bool-radio1" value="0" name="erythrocytes_bool" label="Անփոփոխ "/>
                            <x-forms.checkbox-radio pos="align" id="erythrocytes_bool-radio2" value="1" name="erythrocytes_bool" label="Փոփոխված"/>
                            @error('by_wheelchair')
                                <em class="error text-danger">{{$message}}</em>
                            @enderror
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <h4 class="text-center">Գլանակներ`</h4>
                    <strong> Հիալինային</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="hyalina" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Հատիկավոր</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="granular" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Մոմանման</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="wax" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Էպիթելային</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="epithelial" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Լեյկոցիտար</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="leukocyte" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>էրիթրոցիտար</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="erythrocytar" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Պիգմենտային</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="pigmented" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Լորձ</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="mucus" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Աղեր</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="salts" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Բակտերիաներ</strong>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="bacteria" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="" label="" />
                    </div>
                </li>


                <li class="list-group-item">
                    <strong>Հետազոտությունը իրականացնող բժիշկ</strong>
                    <x-forms.magic-search hidden-id="cl_attending_doctor_id" hidden-name="attending_doctor_id"
                    placeholder="Ընտրել բուժող բժիշկին․․․" class="my-2 user_search" value="{{auth()->id()}}"/>
                    <em class="error text-danger" data-input="cl_attending_doctor_id"></em>
                </li>

                <li class="list-group-item">
                            <strong>Արյան հետազոտության պատասխանի տրման ամսաթիվ</strong>
                            <x-forms.text-field name="research_date" validationType="ajax" type="date"
                                value="" label="" class="my-2" />
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