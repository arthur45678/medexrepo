<!-- 19) stationary_histological_examinations  -->
<ul class="list-group" id="stationary_histological_examinations">
    <li class="list-group-item">

        <!-- stationary_histological_examinations :UPDATE: -->
        @if (!$stationary_histological_examinations->isEmpty())
            <div class="collapse histological-examinations-collapse">
                <strong>
                    <span class="badge badge-light">19.</span>
                    Հյուսվածքաբանական հետազոտության արդյունքը՝
                </strong>
                <x-forms.prev-posts-link href='{{$route."#stationary_histological_examinations"}}' />

                <button class="btn btn-primary btn-sm float-right" type="button" data-toggle="collapse" data-target=".histological-examinations-collapse">
                    <x-svg icon="cui-pencil" />
                </button>

                @forelse ($stationary_histological_examinations as $item)
                    @include('shared.forms.stationary_edit_sections.stationary_histological_examinations', [
                        'item' => $item,
                        // 'included_action_route' => $route_diagnosis,
                        // 'included_form_method' => 'PATCH',
                        'included_submit_txt' => 'փոփոխել',
                        // 'has_hidden_type' => true,
                        // 'has_diagnosis_date' => true,
                        'row_name' =>" 19. Հյուսվածքաբանական հետազոտության արդյունքը",
                        'route_delete' => route('patients.stationary.delete_histological_examinations'),
                        'is_approvable' => true
                    ])
                @empty
                @endforelse
            </div>
        @endif

        <!-- stationary_histological_examinations :CREATE: -->
        <div class="collapse show histological-examinations-collapse">
            <form action="{{$create_histological_examination}}" method="POST" class="ajax-submitable">
                @csrf
                <input type="hidden" name="wrapper_id" value="#stationary_histological_examinations">
                <input type="hidden" name="is_approvable" value="1">

                <strong>
                    <span class="badge badge-light">19.</span>
                    Հյուսվածքաբանական հետազոտության արդյունքը՝
                </strong>
                <x-forms.prev-posts-link href='{{$route."#stationary_histological_examinations"}}' />

                @if (!$stationary_histological_examinations->isEmpty())
                    <button class="btn btn-primary btn-sm float-right" type="button" data-toggle="collapse" data-target=".histological-examinations-collapse">
                        <x-svg icon="cui-pencil" />
                    </button>
                @endif

                <div class="form-row align-items-center my-2 mx-2">
                    <div class="col-md-6" style="height: 90px">
                        <strong>ամսաթիվ</strong>
                        <x-forms.text-field type="date" class="mt-1" name="examination_date" label="" validationType='ajax' />
                    </div>
                    <div class="col-md-6" style="height: 90px">
                        <strong>եզրակացության համար №</strong>
                        <x-forms.text-field type="number" min="0" class="mt-1" name="examination_number" label="" validationType='ajax' />
                    </div>
                </div>

                <hr class="hr-dashed">
                <div class="container">
                    <x-forms.text-field type="textarea" class="mt-1" name="examination" label="" validationType='ajax' />
                    <div class="my-2">
                        @include('shared.forms.list_group_item_submit', ['btn_text' => 'ավելացնել'])
                    </div>
                </div>
            </form>
        </div>
    </li>
</ul>
