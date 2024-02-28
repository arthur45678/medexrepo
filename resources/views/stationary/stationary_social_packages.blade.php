<ul class="list-group" id="stationary_social_package">
    <li class="list-group-item">
        <div class="row align-items-center">

            <div class="col-md-12">
                <strong>
                    Սոցիալական խումբ՝
                    <x-forms.prev-posts-link href='{{$route . "#stationary_social_package"}}' size='sm'/>
                </strong>
                @if(!$stationary_social_packages->isEmpty())
                    <button class="btn btn-primary btn-sm float-right" type="button" data-toggle="collapse" data-target=".social-package-collapse">
                        <x-svg icon="cui-pencil" />
                    </button>
                @endif
            </div>

            <div class="col-md-12">
                @if(!$stationary_social_packages->isEmpty())
                <div class="collapse social-package-collapse">
                    <!-- stationary-social-package :UPDATE -->
                    @forelse ($stationary_social_packages as $item)
                        @include('shared.forms.stationary_edit_sections.stationary_social_packages', [
                            'item' => $item,
                            // 'included_action_route' => $route_diagnosis,
                            // 'included_form_method' => 'PATCH',
                            'included_submit_txt' => 'փոփոխել',
                            'row_name' =>"Սոցիալական խումբ",
                            'route_delete' => route('patients.stationary.delete_social_packages'),
                            'is_approvable' => false
                        ])
                    @empty
                    @endforelse
                </div>
                @endif
                <div class="collapse show social-package-collapse">
                    <!-- stationary-social-package :CREATE -->
                    <form action="{{$create_social_package}}" method="POST" class="ajax-submitable -off">
                        @csrf
                        <input type="hidden" name="wrapper_id" value="#stationary_social_package">

                        <x-forms.magic-search class="magic-search ajax my-2" data-catalog-name="social_packages"
                            hidden-id="social_package_id" hidden-name="social_package_id" autocomplete="off"
                            placeholder="Ընտրել սոցիալական խումբը․․․" validationType="ajax" />
                        <em class="error text-danger" data-input="social_package_id"></em>

                        @include('shared.forms.list_group_item_submit', ['btn_text' => 'ավելացնել'])
                    </form>
                </div>

            </div>
        </div>
    </li>
</ul>
