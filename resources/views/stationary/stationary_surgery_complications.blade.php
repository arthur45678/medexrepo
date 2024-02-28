<!-- stationary_surgery_complications -->
<ul class="list-group" id="stationary_surgery_complications">
    <li class="list-group-item">

        <!-- stationary_surgery_complications 13. :UPDATE:  -->
        @if ($stationary_surgeries)
            <div class="collapse surgeries-collapse">
                <strong>
                    <span class="badge badge-light">13.</span>
                    Վիրահատություններ, անզգայացման եղանակներ և հետվիրահատական բարդություններ
                </strong>
                <x-forms.prev-posts-link href='{{$route."#stationary_surgeries"}}' />

                <button class="btn btn-sm btn-primary float-right" type="button" data-toggle="collapse" data-target=".surgeries-collapse">
                    <x-svg icon="cui-pencil" />
                </button>
                @foreach ($stationary_surgeries as $item)
                    @include('shared.forms.stationary_edit_sections.stationary_surgeries',[
                            'item' => $item,
                        // 'included_action_route' => ''
                        // 'included_form_method' => 'PATCH',
                        'included_submit_txt' => 'փոփոխել',
                        // 'has_surgery_date' => true,
                        'row_name' => __("enums.stationary_surgery_enum." . $item->type),
                        'route_delete' => route('patients.stationary.delete_surgeries'),
                        'is_approvable' => true
                    ])
                @endforeach

                {{-- @each('shared.forms.stationary_edit_sections.stationary_surgeries', $stationary_surgeries, 'item') --}}
            </div>
        @endif

        <!-- stationary_surgery_complications 13. :CREATE:  -->
        <div class="collapse show surgeries-collapse">
            <form action="{{$create_surgery}}" class="ajax-submitable -off" method="POST">
                @csrf
                <input type="hidden" name="wrapper_id" value="#stationary_surgery_complications">
                <input type="hidden" name="type" value="{{App\Enums\StationarySurgeryEnum::stationary()}}">
                <input type="hidden" name="is_approvable" value="1">
                <strong>
                    <span class="badge badge-light">13.</span>
                    Վիրահատություններ, անզգայացման եղանակներ և հետվիրահատական բարդություններ
                </strong>
                <x-forms.prev-posts-link href='{{$route."#stationary_surgeries"}}' />

                @if ($stationary_surgeries)
                    <button class="btn btn-primary btn-sm float-right" type="button" data-toggle="collapse" data-target=".surgeries-collapse">
                        <x-svg icon="cui-pencil" />
                    </button>
                @endif

                <div class="container surgery-row mt-2">
                    <div class="col-md-12 my-2">
                        <x-forms.text-field name="surgery_date" type="datetime-local" label="" />
                    </div>
                    <div class="col-md-12 my-2">
                        <x-forms.magic-search class="magic-search ajax" data-catalog-name="surgeries" value='{{old("surgery_id")}}' hidden-id="surgery_id"
                            hidden-name="surgery_id" placeholder="ընտրել վիրահատությունը․․․" />
                    </div>
                    <div class="col-md-12 my-2">
                        <x-forms.magic-search class="magic-search ajax" data-catalog-name="anesthesias" value='{{old("anesthesia_id")}}'
                            hidden-id="anesthesia_id" hidden-name="anesthesia_id" placeholder="ընտրել անզգայացման եղանակը․․․" />
                    </div>
                    <div class="col-md-12 my-2">
                        <textarea name="complications" class="form-control"
                            placeholder="վիրահատման բարդություններ․․․">{{old('complications')}}</textarea>
                    </div>
                    <div class="col-md-12 my-2">
                        <!-- վիրահատող -->
                        <em class="ml-2 text-info">* Տվյալ կետը լարցնողը ավտոմատ կերպով ֆիքսվում է իբրև վիրահատող։</em>
                        {{-- <input class="doctors-search form-control" data-hidden="#surgeon_id" placeholder="վիրահատել է․․․">
                            <x-forms.text-field type="hidden" id="surgeon_id" name="surgeon_id"  value="" label=""/> --}}
                    </div>
                    <div class="col-md-12 my-2">
                        @include('shared.forms.list_group_item_submit', ['btn_text' => 'ավելացնել'])
                    </div>
                </div>
            </form>
        </div>

    </li>
</ul>
