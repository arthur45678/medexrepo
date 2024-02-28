@extends('layouts.cardBase')

@section('css')
<link href="{{mix("/css/jquery.magicsearch.min.css")}}" rel="stylesheet" />
@endsection


@section('card-header')
@section('card-header-classes', '')

<div class="text-center">
    <h3>ՀԱՄԱՁԱՅԱՆԳԻՐ</h3>

</div>
@endsection


@section('card-content')

<div class="container">
    <form class="ajax-submitable" action="{{route('samples.patients.agreement-hospital-room.update',[$agreem->id,$patent->id])}}" method="POST">
        @csrf
        @method('put')
        <ul class="list-group">
            <li class="list-group-item">
                    <div class="form-row align-items-center">
                        <div class="col-md-1">
                            <strong>Ք</strong>
                        </div>
                        <div class="col-md-11">
                            <x-forms.text-field type="text" name="recommended" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                            value="{{$agreem->recommended}}" label="" />
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="form-row align-items-center">
                        <div class="col-md-4">
                            <strong>Ամսաթիվ</strong>
                        </div>
                        <div class="col-md-8">
                            <x-forms.text-field name="date" type="date"  validation-type="ajax" value="{{\Illuminate\Support\Carbon::parse($agreem->date)->format('Y-m-d')}}" label=""/>
                            <em class="error text-danger" data-input="date"></em>
                        </div>
                    </div>
                </li>
                <li class="list-group-item ">
                    <div class="form-row">
                        <div class="col-md-6">
                            <strong>
                                Ազգանուն, անուն, հայրանուն
                            </strong>
                            <ins class="ml-4">{{$patient->full_name}} {{$patient->p_name}}</ins>
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>
                    Բաժանմունք
                    </strong>

                        <x-forms.magic-search class="magic-search ajax" value='{{$agreem->department_id}}' hidden-id="department_id" validationType="ajax"
                                              hidden-name="department_id" data-catalog-name="departments" placeholder="ընտրել բաժանմունքը․․․" />
                        <em class="error text-danger" data-input="department_id"></em>

                </li>
                <li class="list-group-item ">
                    <div class="form-row">
                        <div class="col-md-6">
                            <strong>
                                Սոցիալական քարտ
                            </strong>
                            <ins class="ml-4">{{$patient->soc_card}}</ins>
                        </div>
                        <div class="col-md-6">
                            <strong>
                                Հասցե
                            </strong>
                            <ins class="ml-4">{{$patient->residence_region}}{{$patient->street_house}}</ins>
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div>
                        <x-forms.text-field type="textarea" name="company_name" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{$agreem->company_name}}" label="Ընկրության անվանումը" />
                    </div>
                </li>

                <li class="list-group-item">
                        <strong>Տնօրեն</strong>
                        <x-forms.magic-search hidden-id="director" hidden-name="director"
                        placeholder="Ընտրել  բաժանմունքի վարչին․․․" class="magic-search ajax my-2" data-list-name="users"
                        value="{{$agreem->director}}" />
                    <em class="error text-danger" data-input="director"></em>
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
