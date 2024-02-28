<!-- stationary_expertise_conclusions 18. -->
<ul class="list-group" id="expertise_conclusions">
    <li class="list-group-item">

        <!-- expertise-conclusions :UPDATE: -->
        @if (!$stationary_expertise_conclusions->isEmpty())
            <div class="collapse expertise-conclusions-collapse mx-2">
                <strong>
                    <span class="badge badge-light">18.</span>
                    Փորձաքննության ընդունվածների համար, եզրակացություն՝
                </strong>
                <x-forms.prev-posts-link href='{{$route."#stationary_expertise_conclusions"}}' />

                <button class="btn btn-primary btn-sm float-right" type="button" data-toggle="collapse" data-target=".expertise-conclusions-collapse">
                    <x-svg icon="cui-pencil" />
                </button>

                @forelse ($stationary_expertise_conclusions as $item)
                    @include('shared.forms.stationary_edit_sections.stationary_expertise_conclusions', [
                        'item' => $item,
                        // 'included_action_route' => $route_diagnosis,
                        // 'included_form_method' => 'PATCH',
                        'included_submit_txt' => 'փոփոխել',
                        // 'has_hidden_type' => true,
                        // 'has_diagnosis_date' => false,
                        'row_name' => '18. Փորձաքննության ընդունվածների համար, եզրակացություն',
                        'route_delete' => route('patients.stationary.delete_expertise_conclusions'),
                        'is_approvable' => true
                    ])
                @empty
                @endforelse
            </div>
        @endif

        <!-- expertise-conclusions :CREATE: -->
        <div class="collapse show expertise-conclusions-collapse">
            <form action="{{$create_expertise_conclusion}}" method="POST" class="ajax-submitable -off">
                @csrf
                <input type="hidden" name="wrapper_id" value="#expertise_conclusions">
                <input type="hidden" name="is_approvable" value="1">
                <strong>
                    <span class="badge badge-light">18.</span>
                    Փորձաքննության ընդունվածների համար, եզրակացություն՝
                </strong>
                <x-forms.prev-posts-link href='{{$route."#stationary_expertise_conclusions"}}' />

                @if (!$stationary_expertise_conclusions->isEmpty())
                    <button class="btn btn-primary btn-sm float-right" type="button" data-toggle="collapse" data-target=".expertise-conclusions-collapse">
                        <x-svg icon="cui-pencil" />
                    </button>
                @endif

                <!-- conclusion of expertise -->
                <div class="container">
                    <div class="col-md-12">
                        <textarea name="conclusion" class="form-control mt-2"
                            placeholder="ազատ լրացման դաշտ․․․">{{old('conclusion')}}</textarea>
                    </div>
                    <div class="col-md-12 my-2">
                        @include('shared.forms.list_group_item_submit', ['btn_text' => 'ավելացնել'])
                    </div>
                </div>
            </form>
        </div>

    </li>
</ul>
