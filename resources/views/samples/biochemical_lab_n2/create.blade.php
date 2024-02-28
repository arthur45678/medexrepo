@extends('layouts.cardBase')


@section('css')
<link href="{{mix("/css/jquery.magicsearch.min.css")}}" rel="stylesheet" />
@endsection


@section('card-header')
@section('card-header-classes', '')

<div class="text-center">
    <h3>ԿԵՆՍԱՔԻՄԻԱԿԱՆ ԼԱԲՈՐԱՏՈՐԻԱ ԲԺՇԿԱԿԱՆ ՁԵՎ N 2</span></h3>
</div>
@endsection


@section('card-content')

<div class="container">
    <form class="ajax-submitable" action="{{route('samples.patients.biochemical-lab-n2.store', ['patient'=> $patient])}}" method="POST">
        @csrf
        <ul class="list-group">
            <li class="list-group-item">
                <div class="form-row align-items-center">
                    <div class="col-md-6">
                        <strong>Լիպիդային սպեկտրի հետազոտություն № </span></strong>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group align-items-center">
                            <x-forms.text-field type="number" class="col-12" name="bbe_number" 
                                placeholder="լրացրեք համապատասխան թիվը․․․" id="height" value="{{$next_bbe_number}}"  readonly  label=""/>
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
                    <x-forms.text-field type="number" step="0.1" name="total_cholesterol" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="" label="Ընդհանուր խոլեստերին նորմա - 3.0 – 5.2 մմոլ/լ" />
                </div>
            </li>
            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="number" step="0.1" name="beta_lipoproteins" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="" label="Բետա–լիպոպրոտեիդներ նորմա - 3.0 – 4.5 գ/լ" />
                </div>
            </li>
            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="number" step="0.1" name="low_density_lipoproteins" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="" label="Ցածր խտությամբ լիպոպրոտեիդներ(ԽՍ ՑԽԼՊ) նորմա - 1.56 – 4.94 մմոլ/լ" />
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="number" step="0.1" name="very_low_density_lipoproteins" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="" label="Շատ ցածր խտությամբ լիպոպրոտեիդներ(ԽՍ ՇՑԽԼՊ) նորմա - 0.26 – 1.04 մմոլ/լ" />
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="number" step="0.1" name="high_density_lipoproteins" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="" label="Բարձր խտությամբ լիպոպրոտեիդներ(ԽՍ ԲԽԼՊ) նորմա - 0.78 – 1.82 մմոլ/լ" />
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="number" step="0.1" name="triglycerides" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="" label="Տրիգլիցերիդներ նորմա - 0.45 – 1.86 մմոլ/լ" />
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="number" step="0.1" name="atherogenic_coefficient_man" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="" label="Աթերոգենության գործակից նորմա - Տղամարդ  մինչև 2.5" />
                </div>
            </li>
           
            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="number" step="0.1" name="atherogenic_coefficient_wooman" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="" label="Աթերոգենության գործակից նորմա - Կին  մինչև 2.2" />
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