@extends('layouts.cardBase')


@section('css')
<link href="{{mix("/css/jquery.magicsearch.min.css")}}" rel="stylesheet" />
@endsection


@section('card-header')
@section('card-header-classes', '')

<div class="text-center">
    <h3>ԿԵՆՍԱՔԻՄԻԱԿԱՆ ԼԱԲՈՐԱՏՈՐԻԱ ԲԺՇԿԱԿԱՆ ՁԵՎ N 1</span></h3>
</div>
@endsection


@section('card-content')

<div class="container">
    <form class="ajax-submitable" action="{{route('samples.patients.biochemical-lab-n1.store', ['patient'=> $patient])}}" method="POST">
        @csrf
        <ul class="list-group">
            <li class="list-group-item">
                <div class="form-row align-items-center">
                    <div class="col-md-6">
                        <strong>Արյան կենսաքիմիական հետազոտություն № </strong>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group align-items-center">
                            <x-forms.text-field type="number" class="col-12" name="bbe_number" validationType="ajax" readonly
                                placeholder="թիվը պետք է գա ավտոմատ" id="height" value="{{$next_bbe_number}}"   label=""/>
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
                        <x-forms.text-field type="date" name="biopsy_date" validationType="ajax" label=""/>
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
                    <x-forms.text-field type="number" min="1" name="chamber" validationType="ajax" 
                    placeholder="պալատի համար" label="Պալատ"/>
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
                    <x-forms.text-field type="number" step="0.1" name="glucose" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="" label="Գլյուկոզ նորմա - 3.3 – 5.5 մմոլ/լ"/>
                </div>
            </li>
            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="number" step="0.1" name="urine" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="" label="Միզանյութ նորմա - 1.7 – 8.3 մմոլ/լ" />
                </div>
            </li>
            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="number" step="0.1" name="prothrombin" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="" label="Պրոթրոմբին նորմա - 80 – 100 %" />
                </div>
            </li>
            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="number" step="0.1" name="amylase" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="" label="α-ամիլազ նորմա - մինչև 90 Մ/լ" />
                </div>
            </li>
            <li class="list-group-item">
                <div class="mt-2">
                    {{-- <x-forms.text-field type="number" step="0.1" name="uroamylase" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="" label="Ուռոամիլազ նորմա - մինչև 1000 Մ/լ" /> --}}

                    <x-forms.text-field name="uroamylase" label="Ուռոամիլազ նորմա - մինչև 1000 Մ/լ"
                    type="number" step="0.1" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"/>
                </div>
            </li>
            <li class="list-group-item">
                <div class="form-row align-items-center">
                    <div class="col-md-6">
                        <strong>Հետազոտության պատասխանի տրման ամսաթիվ</strong>
                    </div>
                    <div class="col-md-6">
                        {{-- <x-forms.text-field name="research_date" validationType="ajax" type="datetime-local"
                            value="" label="" /> --}}
                            <x-forms.text-field name="research_date" label="" type="date" validationType="ajax" />
                    </div>
                </div>
            </li>

            <li class="list-group-item">
                <strong>Հետազոտությունը իրականացնող բժիշկ</strong>
                {{-- <x-forms.magic-search hidden-id="attending_doctor_id" hidden-name="attending_doctor_id"
                placeholder="Ընտրել բուժող բժիշկին․․․" class="magic-search ajax my-2" data-list-name="users"
                value="{{auth()->id()}}"/> --}}

                <x-forms.magic-search hidden-id="attending_doctor_id" hidden-name="attending_doctor_id"
                placeholder="Ընտրել բուժող բժիշկին․․․" class="my-2 user_search" value="{{auth()->id()}}"
                class="magic-search ajax my-2" data-list-name="users"
                />
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
