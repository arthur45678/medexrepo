@extends('layouts.cardBase')


@section('css')
<link href="{{mix("/css/jquery.magicsearch.min.css")}}" rel="stylesheet" />
@endsection


@section('card-header')
@section('card-header-classes', '')

<div class="text-center">
    <h3>ԿԵՆՍԱՔԻՄԻԱԿԱՆ ԼԱԲՈՐԱՏՈՐԻԱ ԲԺՇԿԱԿԱՆ ՁԵՎ N 8</span></h3>
</div>
@endsection


@section('card-content')

<div class="container">
    <form class="ajax-submitable" action="{{route('samples.patients.biochemical-lab-n8.update', ['patient'=> $patient, $bl->id])}}" method="POST">
        @csrf
        @method('put')
        <ul class="list-group">
            <li class="list-group-item">
                <div class="form-row align-items-center">
                    <div class="col-md-6">
                        <strong>Արյան կենսաքիմիական հետազոտություն № </span></strong>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group align-items-center">
                            <x-forms.text-field type="number" class="col-12" name="bbe_number" 
                                placeholder="լրացրեք համապատասխան թիվը․․․" id="height" value="{{$bl->bbe_number}}" readonly  label=""/>
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
                    <x-forms.text-field type="number" step="0.1" name="common_protein" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="{{$bl->common_protein}}" label="Ընդհանուր սպիտակուց  նորմա - 65 – 85 գ/լ" />
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="number" step="0.1" name="total_bilirubin" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="{{$bl->total_bilirubin}}" label="Ընդհանուր բիլիռուբին նորմա - 8.55 – 20.5 մկմոլ/լ" />
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="number" step="0.1" name="related_bilirubin" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="{{$bl->related_bilirubin}}" label="կապված բիլիռուբին նորմա - 0 – 5.1 մկմոլ/լ" />
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
                    <x-forms.text-field type="number" step="0.1" name="timol_experience" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="{{$bl->timol_experience}}" label="Թիմոլային փորձ նորմա - 0 – 5 միավոր" />
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="number" step="0.1" name="urine" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="{{$bl->urine}}" label="Միզանյութ նորմա - 2.5 – 8.3 մմոլ/լ" />
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="number" step="0.1" name="glucose" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="{{$bl->glucose}}" label="Գլյուկոզ նորմա - 6.4 մմոլ/լ" />
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="number" step="0.1" name="aspartate_aminotransferase" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="{{$bl->aspartate_aminotransferase}}" label="Ասպարտատամինոտրասֆերազա (ԱՍՏ) նորմա - մինչև 37 Մ/լ" />
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="number" step="0.1" name="alanine_aminotransferase" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="{{$bl->alanine_aminotransferase}}" label="Ալանինամինոտրանսֆերազա(ԱԼՏ) նորմա - մինչև 42 Մ/լ" />
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