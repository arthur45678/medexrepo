<ul class="list-group" id="other_treatments">
    <li class="list-group-item">

        <!--  other-treatments 14 :UPDATE: -->
        @if (!$stationary_treatments->isEmpty())
        <div class="collapse other-treatments-collapse">
            <strong>
                <span class="badge badge-light">14.1</span>
                Բուժման այլ տեսակներ՝
            </strong>
            <x-forms.prev-posts-link href='{{$route."#stationary_histological_examinations"}}' />

            <button class="btn btn-primary btn-sm float-right" type="button" data-toggle="collapse" data-target=".other-treatments-collapse">
                <x-svg icon="cui-pencil" />
            </button>

            @forelse ($stationary_treatments as $item)
                @include('shared.forms.stationary_edit_sections.stationary_other_treatments', [
                    'item' => $item,
                    // 'included_action_route' => $route_diagnosis,
                    // 'included_form_method' => 'PATCH',
                    'included_submit_txt' => 'փոփոխել',
                    // 'has_hidden_type' => true,
                    // 'has_diagnosis_date' => true,
                    'row_name' =>" 14.1 Բուժման այլ տեսակներ",
                    'route_delete' => route('patients.stationary.delete_other_treatments'),
                    'is_approvable' => true
                ])
            @empty
            @endforelse
        </div>
        @endif

        <!--  other-treatments 14 :CREATE: -->
        <div class="collapse show other-treatments-collapse">
            <form action="{{$create_other_treatment}}" method="POST" class="ajax-submitable -off">
                @csrf
                <input type="hidden" name="wrapper_id" value="#other_treatments">
                <input type="hidden" name="is_approvable" value="1">

                <strong>
                    <span class="badge badge-light mx-1">14.1</span>
                    Բուժման այլ տեսակներ
                </strong>
                <x-forms.prev-posts-link href='{{$route."#stationary_treatments"}}' />

                @if (!$stationary_treatments->isEmpty())
                    <button class="btn btn-primary btn-sm float-right" type="button" data-toggle="collapse" data-target=".other-treatments-collapse">
                        <x-svg icon="cui-pencil" />
                    </button>
                @endif

                <div class="container">
                    <div class="col-md-12 my-2">
                        <x-forms.magic-search class="treatments-search" value='{{old("treatment_id")}}'
                            hidden-id="create_treatment_other_type_id" hidden-name="treatment_id"
                            placeholder="ընտրել բուժման տեսակը․․․" />
                    </div>

                    <div class="col-md-12 my-2">
                        <textarea name="treatment_comment" class="form-control"
                            placeholder="ազատ լրացման դաշտ․․․">{{old('treatment_comment')}}</textarea>
                    </div>
                    <div class="col-md-12 my-2">
                        @include('shared.forms.list_group_item_submit', ['btn_text' => 'ավելացնել'])
                    </div>
                </div>
            </form>
        </div>
    </li>
</ul>
