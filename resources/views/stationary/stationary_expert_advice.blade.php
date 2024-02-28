@php
$expert_advices = $user->stationary_expert_advice;
$route = route("patients.stationary.show", ["patient" => $patient, "stationary" => $stationary]);
$expert_advice_route = route("patients.stationary.expert_advice", ["patient" => $patient, "stationary" => $stationary]);
@endphp

<section id="stationary-expert-advice">
    <!-- class="ajax-submitable has-files" -->

        <ul class="list-group">
            <li class="list-group-item list-group-item-info">
                <h4 class="text-center my-2">Մասնագետների խորհրդատվություն
                    <x-forms.prev-posts-link href='{{$route."#expert_advice"}}'/>
                    @if(count($expert_advices))
                    <button class="btn btn-primary btn-sm" type="button" data-toggle="collapse"
                        data-target=".expert-advice-collapse">
                        <x-svg icon="cui-pencil" />
                    </button>
                    @endif
                </h4>
            </li>
        </ul>

        <div class="collapse expert-advice-collapse">
            @forelse ($expert_advices as $item)
            <form method="POST" class="ajax-submitable dont-reset" action="{{$expert_advice_route}}">
                @csrf
                @method("PATCH")
                <input type="hidden" name="id" value="{{ $item->id }}">

                <ul class="list-group mt-2">
                    <li class="list-group-item">
                        <div class="form-row align-items-center">
                            <div class="col-sm-12 col-md-4">
                                <strong>Խորհրդատվության ամսաթիվ</strong>
                            </div>
                            <div class="col-sm-12 col-md-8">
                                <x-forms.text-field type="date" name="expert_advice_date" validationType="ajax" value="{{ $item->expert_advice_date }}"/>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <x-forms.text-field type="textarea" label="Խորհրդատվություն" name="expert_advice_comment"
                                validationType="ajax" placeholder="ազատ լրացման դաշտ․․․" value="{{ $item->expert_advice_comment }}"/>
                        </div>
                    </li>

                    @include('shared.forms.list_group_item_submit', ['btn_text' => 'Պահպանել'])
                </ul>
                <hr class="hr-dashed">

            </form>
            @empty
            @endforelse
        </div>

        <div class="collapse show expert-advice-collapse">
            <form method="POST" class="ajax-submitable" action="{{ $expert_advice_route }}">
                @csrf
                @method("PATCH")
                <ul class="list-group">
                    <li class="list-group-item">
                        <div class="form-row align-items-center">
                            <div class="col-sm-12 col-md-4">
                                <strong>Խորհրդատվության ամսաթիվ</strong>
                            </div>
                            <div class="col-sm-12 col-md-8">
                                <x-forms.text-field type="date" name="expert_advice_date" validationType="ajax" />
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <x-forms.text-field type="textarea" label="Խորհրդատվություն" name="expert_advice_comment"
                                validationType="ajax" placeholder="ազատ լրացման դաշտ․․․" />
                        </div>
                    </li>

                    @include('shared.forms.list_group_item_submit', ['btn_text' => 'Ավելացնել'])
                </ul>
            </form>
        </div>
</section>
