@php
// stationary_surgery_description.blade
$route = route("patients.stationary.show", ["patient" => $patient, "stationary" => $stationary]);
$ssd_action = route("patients.stationary.surgery_description", ["patient" => $patient, "stationary" => $stationary]);
$ssd = $user->stationary_surgery_descriptions;
// $ssd = $stationary->stationary_surgery_descriptions;
// dump($ssd->surgeon)
// dump($ssd->assistant)
// dump($ssd->surgical_sister)
@endphp

<section id="surgery_description">


    <ul class="list-group mt-2">
        <li class="list-group-item list-group-item-info text-center">
            <h4>
                Վիրահատության նկարագրությունը
                <x-forms.prev-posts-link href='{{$route."#stationary_surgery_descriptions"}}'/>
                @if(count($ssd))
                <button class="btn btn-primary btn-sm" type="button" data-toggle="collapse"
                    data-target=".ssd-collapse">
                    <x-svg icon="cui-pencil" />
                </button>
                @endif
            </h4>
        </li>

        {{-- update --}}
        <div class="collapse ssd-collapse mt-4 col-md-11">
            @forelse ($ssd as $item)
            {{-- update-form-start --}}
            <form method="POST" class="ajax-submitable dont-reset" action="{{ $ssd_action }}">
                @csrf
                @method("PATCH")
                <input type="hidden" name="id" value="{{ $item->id }}">

                <li class="list-group-item">
                    <div class="form-row align-items-center">
                        <div class="col-sm-12 col-md-4">
                            <strong>Ամսաթիվ</strong>
                        </div>
                        <div class="col-sm-12 col-md-8">
                            <x-forms.text-field type="date" name="surgery_description_date" validationType="ajax"
                            {{-- value='{{old("surgery_description_date")}}'/> --}}
                            value='{{old("surgery_description_date", $item->surgery_description_date ?? null )}}'/>
                        </div>
                    </div>
                    <hr class="hr-dashed">
                    <strong>Նկարագրությունը</strong>
                    <x-forms.text-field type="textarea" name="surgery_description_comment" validationType="ajax"
                    {{-- value='{{old("surgery_description_comment")}}' label="" /> --}}
                    value='{{old("surgery_description_comment", $item->surgery_description_comment ?? null )}}' label=""/>
                </li>

                <li class="list-group-item">
                    <div class="form-row align-items-center my-2">
                        <div class="col-md-4">
                            <strong>վիրաբույժ</strong>

                            <x-forms.magic-search class="doctors-search" placeholder="Ընտրել վիրաբույժ․․․"
                            hidden-id="surgery_description_surgeon_id" hidden-name="surgery_description_surgeon_id"
                            {{-- value='{{old("surgery_description_surgeon_id")}}'/> --}}
                            value='{{old("surgery_description_surgeon_id", $item->surgeon->id ?? null)}}'/>
                        </div>
                        <div class="col-md-4">
                            <strong>օգնական</strong>

                            <x-forms.magic-search class="doctors-search" placeholder="Ընտրել օգնական․․․"
                            hidden-id="surgery_description_assistant_id" hidden-name="surgery_description_assistant_id"
                            {{-- value='{{old("surgery_description_assistant_id")}}'/> --}}
                            value='{{old("surgery_description_assistant_id", $item->assistant->id ?? null)}}'/>
                        </div>
                        <div class="col-md-4">
                            <strong>վիրաբուժական քույր</strong>

                            <x-forms.magic-search class="doctors-search" placeholder="Ընտրել վիրաբուժական քույր․․․"
                            hidden-id="surgery_description_surgical_sister_id" hidden-name="surgery_description_surgical_sister_id"
                            {{-- value='{{old("surgery_description_surgical_sister_id")}}'/> --}}
                            value='{{old("surgery_description_surgical_sister_id", $item->surgical_sister->id ?? null)}}'/>
                        </div>
                    </div>
                </li>
                @include('shared.forms.list_group_item_submit', ['btn_text' => 'Պահպանել'])
            </form>

            {{-- update-form-end --}}
            @empty
            @endforelse
        </div>

        {{-- create --}}
        <div class="collapse show ssd-collapse mt-4">
            <form method="POST" class="ajax-submitable dont-reset" action="{{ $ssd_action }}">
                @csrf
                @method("PATCH")
                <li class="list-group-item">
                    <div class="form-row align-items-center">
                        <div class="col-sm-12 col-md-4">
                            <strong>Ամսաթիվ</strong>
                        </div>
                        <div class="col-sm-12 col-md-8">
                            <x-forms.text-field type="date" name="surgery_description_date" validationType="ajax"
                            value='{{old("surgery_description_date")}}'/>
                            {{-- value='{{old("surgery_description_date", $ssd->surgery_description_date ?? null )}}'/> --}}
                        </div>
                    </div>
                    <hr class="hr-dashed">
                    <strong>Նկարագրությունը</strong>
                    <x-forms.text-field type="textarea" name="surgery_description_comment" validationType="ajax"
                    value='{{old("surgery_description_comment")}}' label="" />
                    {{-- value='{{old("surgery_description_comment", $ssd->surgery_description_comment ?? null )}}' label="" /> --}}
                </li>

                <li class="list-group-item">
                    <div class="form-row align-items-center my-2">
                        <div class="col-md-4">
                            <strong>վիրաբույժ</strong>

                            <x-forms.magic-search class="doctors-search" placeholder="Ընտրել վիրաբույժ․․․"
                            hidden-id="surgery_description_surgeon_id" hidden-name="surgery_description_surgeon_id"
                            value='{{old("surgery_description_surgeon_id")}}'/>
                            {{-- value='{{old("surgery_description_surgeon_id", $ssd->surgeon->id ?? null)}}'/> --}}
                        </div>
                        <div class="col-md-4">
                            <strong>օգնական</strong>

                            <x-forms.magic-search class="doctors-search" placeholder="Ընտրել օգնական․․․"
                            hidden-id="surgery_description_assistant_id" hidden-name="surgery_description_assistant_id"
                            value='{{old("surgery_description_assistant_id")}}'/>
                            {{-- value='{{old("surgery_description_assistant_id", $ssd->assistant->id ?? null)}}'/> --}}
                        </div>
                        <div class="col-md-4">
                            <strong>վիրաբուժական քույր</strong>

                            <x-forms.magic-search class="doctors-search" placeholder="Ընտրել վիրաբուժական քույր․․․"
                            hidden-id="surgery_description_surgical_sister_id" hidden-name="surgery_description_surgical_sister_id"
                            value='{{old("surgery_description_surgical_sister_id")}}'/>
                            {{-- value='{{old("surgery_description_surgical_sister_id", $ssd->surgical_sister->id ?? null)}}'/> --}}
                        </div>
                    </div>
                </li>
                @include('shared.forms.list_group_item_submit', ['btn_text' => 'Ավելացնել'])
            </form>
        </div>

    </ul>


</section>
