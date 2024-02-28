@extends('layouts.cardBase')


@section('css')
<link href="{{mix("/css/jquery.magicsearch.min.css")}}" rel="stylesheet" />
@endsection


@section('card-header')
@section('card-header-classes', '')

<div class="text-center">
    <h3>Թմրամիջոցների ոչնչացման ակտ</span></h3>
</div>
@endsection


@section('card-content')

<div class="container">
    <form class="ajax-submitable" action="{{ route('samples.patients.drug-destruction-act.store', ['patient'=> $patient]) }}" method="POST">
        @csrf
        <ul class="list-group">

            <li class="list-group-item ">
               <div class="form-row">
                    <div class="col-md-6">
                        <strong>
                            Հանձնաժողովի անդամներ՝
                        </strong>
                        <ins class="ml-4"></ins>
                    </div>
               </div>
            </li>

            <li class="list-group-item">
                <strong>Գլխավոր բժիշկ</strong>
                <x-forms.magic-search hidden-id="head_doctor_id" hidden-name="head_doctor_id"
                placeholder="Ընտրել ուղեգրող բժիշկին․․․" class="my-2 user_search"/>
                <em class="error text-danger" data-input=""></em>
            </li>

            <li class="list-group-item">
                <strong>Դեղատան վարիչ</strong>
                <x-forms.magic-search hidden-id="pharmacy_manager_id" hidden-name="pharmacy_manager_id"
                placeholder="Ընտրել ուղեգրող բժիշկին․․․" class="my-2 user_search"/>
                <em class="error text-danger" data-input=""></em>
            </li>

            <li class="list-group-item">
                <strong>Գլխավոր բուժքույր</strong>
                <x-forms.magic-search hidden-id="chief_nurse_id" hidden-name="chief_nurse_id"
                placeholder="Ընտրել ուղեգրող բժիշկին․․․" class="my-2 user_search"/>
                <em class="error text-danger" data-input=""></em>
            </li>

            <li class="list-group-item ">
                <div class="form-row">
                     <div class="col-md-6">
                         <strong>
                            Կատարվել է թմրամիջոցների և հոգեմետ նյութերի օգտագործված սրվակների ոչնչացում՝
                         </strong>
                         <ins class="ml-4"></ins>
                     </div>
                </div>
             </li>

            <li class="list-group-item">
                <div class="form-row align-items-center">
                    <div class="col-md-6">
                        <strong>Սկսած</strong>
                    </div>
                    <div class="col-md-6">
                        <x-forms.text-field name="started_destroying_date" validationType="ajax" type="date"
                            value="" label="" />
                    </div>
                </div>
            </li>

            <li class="list-group-item">
                <div class="form-row align-items-center">
                    <div class="col-md-6">
                        <strong>Մինչև</strong>
                    </div>
                    <div class="col-md-6">
                        <x-forms.text-field name="finished_destroying_date" validationType="ajax" type="date"
                            value="" label="" />
                    </div>
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="textarea" step="0.1" name="dose" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="" label="Քանակը՝/տառերով և թվերով/
                    " />
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="textarea" step="0.1" name="dose_patients" validationType="ajax" placeholder="լրացրեք համապատասխան թիվը․․․"
                    value="" label="Թմրամիջոցներ և հոգեմետ դեղեր ստացած հիվանդների քանակը,
                    նշել հիվանդության պատմագրերի համարները՝" />
                </div>
            </li>

            <li class="list-group-item ">
                <div class="form-row">
                     <div class="col-md-6">
                         <strong>
                            Սրվակները ոչնչացվել են կոտրելու, մանրացնելու միջոցով։
                         </strong>
                         <ins class="ml-4"></ins>
                     </div>
                </div>
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
