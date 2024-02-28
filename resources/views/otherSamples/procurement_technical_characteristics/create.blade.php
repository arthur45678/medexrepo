@extends('layouts.cardBase')


@section('css')
<link href="{{mix("/css/jquery.magicsearch.min.css")}}" rel="stylesheet" />
<style>
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }
</style>
@endsection


@section('card-header')
@section('card-header-classes', '')

<div class="text-center">
    <h3>ՏԵԽՆԻԿԱԿԱՆ ԲՆՈՒԹԱԳԻՐ-ԳՆՄԱՆ ԺԱՄՆԱԿԱՑՈՒՅՑ</span></h3>
</div>
@endsection


@section('card-content')

<div class="container">
    <form class="ajax-submitable" action="{{route('otherSamples.ptc.store')}}" method="POST">
        @csrf
        <ul class="list-group">
            <li class="list-group-item">
                    <div>
                        <x-forms.text-field type="textarea" name="invitation_quota_number" validationType="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="" label="Հրավերով նախատեսված չափաբաժնի համարը" />
                    </div>
            </li>
            <li class="list-group-item">
                    <div>
                        <x-forms.text-field type="textarea" name="procurement_plan_passcode" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="" label="Գնումների պլանով նախատեսված միջանցիկ ծածկագիրը ըստ ԳՄԱ դասկարգման (CPV)" />
                    </div>
            </li>
            <li class="list-group-item">
                    <div>
                        <x-forms.text-field type="textarea" name="name_and_trademark" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="" label="Անվանումը և ապրանքային նշանը" />
                    </div>
            </li>
            <li class="list-group-item">
                    <div>
                        <x-forms.text-field type="textarea" name="manufacturer_name_and_country" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="" label="Արտադրողի անվանումը և ծագման երկիրը" />
                    </div>
            </li>
            <li class="list-group-item">
                    <div>
                        <x-forms.text-field type="textarea" name="technical_specifications" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="" label="Տեխնիկական բնութագիրը" />
                    </div>
            </li>
            <li class="list-group-item">
                    <div>
                        <x-forms.text-field type="textarea" name="measurement_unit" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="" label="Չափման միավորը" />
                    </div>
            </li>
            <li class="list-group-item">
                    <div>
                        <x-forms.text-field type="number" name="unit_price" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="" label="Միավոր գինը ՀՀ դրամ" />
                    </div>
            </li>
            <li class="list-group-item">
                    <div>
                        <x-forms.text-field type="number" name="total_price" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="" label="Ընդհանուր գինը ՀՀ դրամ" />
                    </div>
            </li>
            <li class="list-group-item">
                    <div>
                        <x-forms.text-field type="number" name="total_quantity" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="" label="Ընդհանուր քանակը" />
                    </div>
            </li>
            <li class="list-group-item list-group-item-info">
                <h4 class="text-center">
                    ՄԱՏԱԿԱՐԱՐՈՒՄ
                </h4>
            </li>
            <li class="list-group-item">
                    <div>
                        <x-forms.text-field type="textarea" name="address" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="" label="Հասցե" />
                    </div>
            </li>
            <li class="list-group-item">
                    <div>
                        <x-forms.text-field type="number" name="quantities" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="" label="Ենթակա քանակներ" />
                    </div>
            </li>
            <li class="list-group-item">
                    <div>
                        <x-forms.text-field type="textarea" name="deadlines" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="" label="Ժամկետներ" />
                    </div>
            </li>
            <li class="list-group-item">
{{--                    <div>--}}
{{--                        <x-forms.text-field type="textarea" name="general" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"--}}
{{--                        value="" label="Ընդհանուր" />--}}
{{--                    </div>--}}
                <input type="hidden" value="{{auth()->user()->id}}" name="user_id">
            </li>

            @include('shared.forms.list_group_item_submit', ['btn_text'=>'Ավելացնել'])

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
    $('form').on('focus', 'input[type=number]', function (e) {
        $(this).on('wheel.disableScroll', function (e) {
            e.preventDefault()
        })
    })
    $('form').on('blur', 'input[type=number]', function (e) {
        $(this).off('wheel.disableScroll')
    })
</script>

@endsection
