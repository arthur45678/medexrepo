@extends('layouts.cardBase')

@section('css')
<link href="{{mix("/css/jquery.magicsearch.min.css")}}" rel="stylesheet" />
@endsection


@section('card-header')
@section('card-header-classes', '')

<div class="text-center">
    <h3>Խորհրդատվական թերթիկ</h3>

</div>
@endsection


@section('card-content')

<div class="container">
    <form class="ajax-submitable" action="{{ route('samples.patients.advice-sheet.store', ['patient'=> $patient]) }}" method="POST">
        @csrf
        <ul class="list-group">
            <li class="list-group-item">
                    <div class="form-row align-items-center">
                        <div class="col-md-6">
                            <strong>Խորհրդատվական թերթիկ № </span></strong>
                        </div>
                    </div>
                </li>
                <li class="list-group-item ">
                    <div class="form-row">
                        <div class="col-md-6">
                            <strong>
                                Ազգանուն, անուն, հայրանուն {{ $patient->getAllNamesAttribute() }}
                            </strong>
                            <ins class="ml-4"></ins>
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="form-row align-items-center">
                        <div class="col-md-4">
                            <strong>Ամսաթիվ</strong>
                        </div>
                        <div class="col-md-8">
                            <x-forms.text-field name="admission_date" type="date"  validation-type="ajax" value="" label=""/>
                        </div>
                    </div>
                </li>


               <li class="list-group-item">
                <strong>Ախտորոշում</strong>
                <x-forms.add-reduce-button type="add" data-row=".sample_diagnoses-row"/>
                <x-forms.add-reduce-button type="reduce" data-row=".sample_diagnoses-row"/>
                <x-forms.hidden-counter class="sample_diagnoses-rows" name="sample_diagnoses_length"/>

                @for ($i = 0; $i < $repeatables; $i++)
                    <div class="container sample_diagnoses-row {{$i<old('sample_diagnoses_length', 1) ?' ':'d-none'}}">
                        <div class="col-md-12 my-2">
                            <div class="my-2">
                                <x-forms.magic-search
                                    class="magic-search ajax"
                                    value='{{old("sample_diagnoses.$i")}}'
                                    hidden-id="sample_diagnoses_{{$i}}"

                                    hidden-name="sample_diagnoses[]"
                                    data-catalog-name="diseases"
                                    placeholder="Ընտրել ախտորոշումը․․"
                                />
                            </div>

                        </div>
                        <div class="col-md-12 my-2">
                            <textarea name="sample_diagnoses_comment[]" class="form-control" placeholder="ազատ գրառման դաշտ․․․">{{old("sample_diagnoses_comment.$i")}}</textarea>
                        </div>
                    </div>
                @endfor
            </li>


                <li class="list-group-item">
                    <div>
                        <x-forms.text-field type="textarea" name="recommended" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="" label="Խորհուրդ է տրվում" />
                    </div>
                </li>

                <li class="list-group-item">
                        <strong>Պոլիկնիկական բաժ. վարիչ</strong>
                        <x-forms.magic-search hidden-id="attending_doctor_id" hidden-name="attending_doctor_id"
                        placeholder="Ընտրել  բաժանմունքի վարչին․․․" class="magic-search ajax my-2" data-list-name="users"
                        value="" />


                    <x-forms.text-field type="textarea" name="consultant" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                                        value="" label="Խորհուրդ է տրվում" />
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
    var repeatables = {{$repeatables}};
</script>


@endsection
