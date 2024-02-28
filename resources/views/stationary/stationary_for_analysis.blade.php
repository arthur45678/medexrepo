@php
$for_analyses = $user->stationary_for_analysis;
$route = route("patients.stationary.show", ["patient" => $patient, "stationary" => $stationary]);
$sfa_action = route("patients.stationary.for_analysis", ["patient" => $patient, "stationary" => $stationary]);
@endphp

<section id="stationary-for-analysis">
    <ul class="list-group mt-2">
        <li class="list-group-item list-group-item-info">
            <h4 class="text-center my-2">Անալիզների համար
                <x-forms.prev-posts-link href='{{$route."#for_analysis"}}' />
                @if(count($for_analyses))
                <button class="btn btn-primary btn-sm" type="button" data-toggle="collapse"
                    data-target=".for-analyses-collapse">
                    <x-svg icon="cui-pencil" />
                </button>
                @endif
            </h4>
        </li>
    </ul>

    @if (count($for_analyses))
    <div class="collapse for-analyses-collapse">
        @forelse ($for_analyses as $item)
        <form method="POST" class="ajax-submitable has-files" action="{{ $sfa_action }}">
            @csrf
            @method("PATCH")
            <ul class="list-group mt-2">
                <li class="list-group-item">
                    <div class="form-row align-items-center">
                        <div class="col-sm-12 col-md-4">
                            <strong>Ամսաթիվ</strong>
                        </div>
                        <div class="col-sm-12 col-md-8">
                            <x-forms.text-field type="date" name="for_analysis_date" validationType="ajax"
                                value="{{ $item->for_analysis_date }}" />
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <x-forms.text-field type="textarea" label="Անալիզ" name="for_analysis_comment"
                            validationType="ajax" placeholder="ազատ լրացման դաշտ․․․"
                            value="{{ $item->for_analysis_comment }}" />
                    </div>
                </li>

                <li class="list-group-item">
                    <h5 class="text-center">Անալիզին կից ֆայլեր
                        <x-forms.add-reduce-button type="add" data-row=".fora-attach-row" />
                        <x-forms.add-reduce-button type="reduce" data-row=".fora-attach-row" />
                        <x-forms.hidden-counter class="fora-attach-rows" name="fora_attach_lenght" />
                    </h5>

                    @include('shared.forms.attachments_container', ["attachments" => $item->attachments]);

                    @for ($i = 0; $i < $repeatables; $i++)
                    <div class="container fora-attach-row {{$i < old('fora_attach_lenght', 1) ?' ':'d-none'}}">
                        <strong>{{$i+1}}. ընտրել վերբեռնման ֆայլը</strong>
                        <div class="my-2">
                            <x-forms.text-field type="file" label="" name="attachments[]" class="my2"
                                value='{{old("attachments.$i")}}' validationType="ajax" />
                        </div>
                        <strong>{{$i+1}}. մեկնաբանել վերբեռնվող ֆայլը</strong>
                        <div class="my-2">
                            <x-forms.text-field type="textarea" label="" name="attachment_comments[]"
                                value='{{old("attachment_comments.$i")}}' validationType="ajax" />
                        </div>
                    </div>
                    @endfor
                </li>
                @include('shared.forms.list_group_item_submit', ["has_files" => true, 'btn_text' => 'Պահպանել'])
            </ul>
        </form>
        @empty
        @endforelse
    </div>
    @endif

    <div class="collapse show for-analyses-collapse">
        <form method="POST" class="ajax-submitable has-files" action="{{ $sfa_action }}">
            @csrf
            @method("PATCH")
            <ul class="list-group mt-2">
                <li class="list-group-item">
                    <div class="form-row align-items-center">
                        <div class="col-sm-12 col-md-4">
                            <strong>Ամսաթիվ</strong>
                        </div>
                        <div class="col-sm-12 col-md-8">
                            <x-forms.text-field type="date" name="for_analysis_date" validationType="ajax" />
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <x-forms.text-field type="textarea" label="Անալիզ" name="for_analysis_comment"
                            validationType="ajax" placeholder="ազատ լրացման դաշտ․․․" />
                    </div>
                </li>

                <li class="list-group-item">
                    <h5 class="text-center">Անալիզին կից ֆայլեր
                        <x-forms.add-reduce-button type="add" data-row=".fora-attach-row" />
                        <x-forms.add-reduce-button type="reduce" data-row=".fora-attach-row" />
                        <x-forms.hidden-counter class="fora-attach-rows" name="fora_attach_lenght" />
                    </h5>

                    @for ($i = 0; $i < $repeatables; $i++)
                    <div class="container fora-attach-row {{$i < old('fora_attach_lenght', 1) ?' ':'d-none'}}">
                        <strong>{{$i+1}}. ընտրել վերբեռնման ֆայլը</strong>
                        <div class="my-2">
                            <x-forms.text-field type="file" label="" name="attachments[]" class="my2"
                                value='{{old("attachments.$i")}}' validationType="ajax" />
                        </div>
                        <strong>{{$i+1}}. մեկնաբանել վերբեռնվող ֆայլը</strong>
                        <div class="my-2">
                            <x-forms.text-field type="textarea" label="" name="attachment_comments[]"
                                value='{{old("attachment_comments.$i")}}' validationType="ajax" />
                        </div>
                    </div>
                    @endfor
                </li>
                @include('shared.forms.list_group_item_submit', ["has_files" => true, 'btn_text' => 'Ավելացնել'])
            </ul>
        </form>
    </div>
</section>
