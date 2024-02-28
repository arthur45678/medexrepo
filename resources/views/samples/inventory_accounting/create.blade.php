@extends('layouts.cardBase')


@section('css')
<link href="{{mix("/css/jquery.magicsearch.min.css")}}" rel="stylesheet" />
@endsection


@section('card-header')
@section('card-header-classes', '')

<div class="text-center">
    <h3>Վիրակապական պարագաների հաշվառում /ըստ հիվանդների/</span></h3>
</div>
@endsection


@section('card-content')

<div class="container">
    <form class="ajax-submitable" action="{{route('samples.patients.inventory-accounting.store', ['patient'=> $patient])}}" method="POST">
        @csrf
        <ul class="list-group">
            <li class="list-group-item">
                <div class="form-row align-items-center">
                    <div class="col-md-4">
                        <strong>Ամսաթիվ</strong>
                    </div>
                    <div class="col-md-8">
                        <x-forms.text-field type="date" name="date" validationType="ajax" label=""/>
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
               </div>
            </li>

           
            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="textarea"  name="manipulation" validationType="ajax" 
                    placeholder="Լրացման ազատ դաշտ․․․" label="Մանիպուլացիա"/>
                </div>
            </li>

            <li class="list-group-item">
                <div class="form-row align-items-center">
                    <div class="col-md-4">
                        <strong>Մուտքի ամսաթիվ</strong>
                    </div>
                    <div class="col-md-8">
                        <x-forms.text-field type="date" name="entry_date" validationType="ajax" label=""/>
                    </div>
                </div>
            </li>

            <li class="list-group-item">
                <strong>Վիրակապարանի Բուժքույր</strong>
                <x-forms.magic-search hidden-id="bandage_nurse_id" hidden-name="bandage_nurse_id"
                placeholder="Ընտրել ուղեգրող բժիշկին․․․"  validationType="ajax" class="my-2 user_search"/>
                <em class="error text-danger" data-input="bandage_nurse_id"></em>
            </li>
            
            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="textarea"  name="get_from" validationType="ajax" 
                    placeholder="Լրացման ազատ դաշտ․․․" label="Որտեղից է ստացել"/>
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="textarea"  name="bandages" validationType="ajax" 
                    placeholder="Լրացման ազատ դաշտ․․․" label="Վիրակապական նյութեր"/>
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="textarea"  name="bandag" validationType="ajax" 
                    placeholder="Լրացման ազատ դաշտ․․․" label="Վիրակապ"/>
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="textarea"  name="tanzif" validationType="ajax" 
                    placeholder="Լրացման ազատ դաշտ․․․" label="Թանզիֆ"/>
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="textarea"  name="alcohol" validationType="ajax" 
                    placeholder="Լրացման ազատ դաշտ․․․" label="Սպիրտ 96%"/>
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="textarea"  name="hydrogen_peroxide" validationType="ajax" 
                    placeholder="Լրացման ազատ դաշտ․․․" label="Ջրածնի պերոքսիդ 33%"/>
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="textarea"  name="povidonioditis" validationType="ajax" 
                    placeholder="Լրացման ազատ դաշտ․․․" label="Պովիդոնյոդիտ 33%"/>
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="textarea"  name="sodium_chloride" validationType="ajax" 
                    placeholder="Լրացման ազատ դաշտ․․․" label="Նատրիքլոր 10%"/>
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="textarea"  name="furacillin" validationType="ajax" 
                    placeholder="Լրացման ազատ դաշտ․․․" label="Ֆուռացիլին 1։5000"/>
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="textarea"  name="adhesive_tape" validationType="ajax" 
                    placeholder="Լրացման ազատ դաշտ․․․" label="Կպչուն սպեղանի"/>
                </div>
            </li>

            <li class="list-group-item">
                <div class="mt-2">
                    <x-forms.text-field type="textarea"  name="glove" validationType="ajax" 
                    placeholder="Լրացման ազատ դաշտ․․․" label="Ձեռնոց"/>
                </div>
            </li>


            <li class="list-group-item">
                <strong>Գլխավոր բուժքույր</strong>
                    <x-forms.magic-search hidden-id="chief_nurse_id" hidden-name="chief_nurse_id"
                    placeholder="Ընտրել բուժող բժիշկին․․․" class="my-2 user_search" value=""/>
                    <em class="error text-danger" data-input="chief_nurse_id"></em>
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
