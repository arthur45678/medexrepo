@extends('layouts.cardBase')


@section('css')
<link href="{{mix("/css/jquery.magicsearch.min.css")}}" rel="stylesheet" />
@endsection


@section('card-header')
@section('card-header-classes', '')

<div class="text-center">
    <h3>ԿԼԻՆԻԿԱԿԱՆ ԼԱԲՈՐԱՏՈՐԻԱ</h3>
    <h3>ԲԺՇԿԱԿԱՆ ՁԵՎ N 2</h3>
</div>
@endsection


@section('card-content')

<div class="container">
    <form class="ajax-submitable" action="{{route('samples.patients.clinical-lab-n2.update', ['patient'=> $patient, $cl->id])}}" method="POST">
        @csrf
        @method('put')
        <ul class="list-group">
                <li class="list-group-item">
                    <div class="form-row align-items-center">
                        <div class="col-md-6">
                            <strong>Արյունաբանական հետազոտություն № </strong>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group align-items-center">
                                <x-forms.text-field type="number" class="col-12" name="bbe_number" id="height" value="{{$cl->bbe_number}}"  readonly min="1"
                                value="{{$cl->bbe_number}}" min="1"  label=""/>
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
                        <x-forms.magic-search class="magic-search ajax" value='{{$cl->department_id}}' hidden-id="department_id" 
                        hidden-name="department_id" data-catalog-name="departments" placeholder="ընտրել բաժանմունքը․․․" />
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="mt-2">
                        <x-forms.text-field type="number" name="chamber" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$cl->chamber}}" label="Պալատ" />
                    </div>
                </li>
             
                <li class="list-group-item">
                    <strong>Ուղեգրող բժշկ</strong>
                    <x-forms.magic-search hidden-id="sender_doctor_id" hidden-name="sender_doctor_id"
                    placeholder="Ընտրել բուժող բժիշկին․․․" class="magic-search ajax my-2" data-list-name="users"
                    value="{{$cl->sender_doctor_id}}" />
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
                        <x-forms.text-field type="textarea" name="hemoglobin" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$cl->hemoglobin}}" label="Հեմոգլոբին" />
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="erythrocyte_sedimentation_rate" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$cl->erythrocyte_sedimentation_rate}}" label="Էրիթրոցիտների նստեցման արագություն (ԷՆԱ)" />
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="leukocytes" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$cl->leukocytes}}" label="Լեյկոցիտներ" />
                    </div>
                </li>

                <li class="list-group-item">
                    <div class="form-row align-items-center">
                        <div class="col-md-6">
                            <strong>Հետազոտության պատասխանի տրման ամսաթիվ</strong>
                        </div>
                        <div class="col-md-6">
                            <x-forms.text-field name="research_date" validationType="ajax" type="date"
                                value="{{$cl->research_date}}" label="" />
                        </div>
                    </div>
                </li>

                <li class="list-group-item">
                    <strong>Հետազոտությունը իրականացնող բժիշկ</strong>
                    <x-forms.magic-search hidden-id="attending_doctor_id" hidden-name="attending_doctor_id"
                    placeholder="Ընտրել բուժող բժիշկին․․․" class="magic-search ajax my-2" data-list-name="users"
                    value="{{$cl->attending_doctor_id}}" />
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