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

@php
    $route = route("samples.patients.advice-sheet.show",  ['patient' => $patient , $post->id]);
    $sd_sample_diagnoses = $user->sample_diagnoses_groupped[\App\Enums\Samples\SampleDiagnosesEnum::advice_sheet_diagnosis()->getValue()] ?? false;

@endphp


@section('card-content')

    <div class="container">
        <form class="ajax-submitable" action="{{ route('samples.patients.advice-sheet.update', ['patient'=> $patient,  $post->id]) }}" method="POST">
            @csrf
            @method('put')
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
                            <x-forms.text-field name="admission_date" type="date"  validation-type="ajax" value="{{ $post->admission_date }}" label=""/>
                        </div>
                    </div>
                </li>

                <div class="container referral-wrap-row">
                    <li class="list-group-item ">
                        <table class="table" border="2">
                            <thead>
                            <tr>
                                <th>Ախտորոշում</th>
                                <th>գրառում</th>
                                <th>ջնջել</th>
                            </tr>
                            </thead>
                            <tbody>


                            @foreach($samplesDiagnosis as $sampleDiagnose)
                                <tr id="trashData{{$sampleDiagnose->id}}">
                                    <td>{{$sampleDiagnose->disease_item->name ?? ' '}}</td>
                                    <td>{{$sampleDiagnose->diagnosis_comment}}</td>
                                    <td>

                                        @if($sampleDiagnose->user_id == auth()->user()->id)

                                            <button onclick="clickTrash({{$sampleDiagnose->id}})" class="btn btn-danger btn-sm clickTrash" type="submit"
                                                {{--   onclick="clickTrash({{$diagnose->id}})"--}}>
                                                <x-svg icon="cui-trash"/>
                                        @endif

                                    </td>
                                </tr>
                            @endforeach


                            </tbody>
                        </table>

                    </li>
                    <hr class="hr-dashed">
                </div>


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
                                            value="{{ $post->recommended }}" label="Խորհուրդ է տրվում" />
                    </div>
                </li>


                <li class="list-group-item">
                    <strong>Պոլիկնիկական բաժ. վարիչ</strong>
                    <x-forms.magic-search hidden-id="attending_doctor_id" hidden-name="attending_doctor_id"
                                          placeholder="Ընտրել  բաժանմունքի վարչին․․․" class="magic-search ajax my-2" data-list-name="users"
                                          value="{{ $post->attending_doctor_id }}" />


                    <x-forms.text-field type="textarea" name="consultant" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                                        value="{{ $post->consultant }}" label="Խորհուրդ է տրվում" />
                </li>
                @include('shared.forms.list_group_item_submit', ['btn_text'=>'Ուղարկել'])
            </ul>
        </form>
    </div>
@endsection
@section('javascript')
    <script src="{{ mix('js/jquery.js') }}"></script>
    <script src="{{ mix('js/all.magicsearch.js') }}"></script>
    <script src="{{ mix('/js/components/Select.js')}}"></script>

    <script>
        var repeatables = {{$repeatables}};





        // $('[name="workability"]').on('click', function(){
        //    $('[name="workability_comment"]').hide(200);
        // })
        // $('#workability-radio5').on('click', function(){
        //     $('[name="workability_comment"]').show(200);
        // })

        // $(".medicines-search").magicsearch(
        //     window.medexMagicSearch.assignConfigs({
        //         dataSource: "/catalogs/medicines.json",
        //         type: "ajax",
        //         success: function($input, data) {
        //             const hidden_id = $input.data("hidden");
        //             $(hidden_id).val($input.attr("data-id"));
        //         }
        //     })
        // );


        // $('.diagnoses-search').magicsearch(
        //     window.medexMagicSearch.assignConfigs({
        //         dataSource: "/catalogs/diseases.json",
        //         type: "ajax",
        //         success: function($input, data) {
        //             const hidden_input_id = $input.data('hidden');
        //             $(hidden_input_id).val($input.attr("data-id"));
        //         }
        //     })
        // );

        // $('.surgery-search').magicsearch(
        //     window.medexMagicSearch.assignConfigs({
        //         dataSource: "/catalogs/surgeries.json",
        //         type: "ajax",
        //         success: function($input, data) {
        //             // $("#surgery_id").val($input.attr("data-id"));
        //             const hidden_input_id = $input.data('hidden');
        //             $(hidden_input_id).val($input.attr("data-id"));
        //         }
        //     })
        // );

        // $('.anesthesia-methods-search').magicsearch(
        //     window.medexMagicSearch.assignConfigs({
        //         dataSource: "/catalogs/anesthesias.json",
        //         type: "ajax",
        //         success: function($input, data) {
        //             // $("#anesthesia_id").val($input.attr("data-id"));
        //             const hidden_input_id = $input.data('hidden');
        //             $(hidden_input_id).val($input.attr("data-id"));
        //         }
        //     })
        // );

        $('.doctors-search').magicsearch(
            window.medexMagicSearch.assignConfigs({
                dataSource: "/lists/users.json",
                type: "ajax",
                success: function($input, data) {
                    const hidden_input_id = $input.data('hidden');
                    $(hidden_input_id).val($input.attr("data-id"));
                }
            })
        );

        $('.treatments-search').magicsearch(
            window.medexMagicSearch.assignConfigs({
                dataSource: "/catalogs/treatments.json",
                type: "ajax",
                success: function($input, data) {
                    const hidden_input_id = $input.data('hidden');
                    $(hidden_input_id).val($input.attr("data-id"));
                }
            })
        );

        $('.clinics-search').magicsearch(
            window.medexMagicSearch.assignConfigs({
                dataSource: '/catalogs/clinics.json',
                type:'ajax',
                success: function($input, data) {
                    const hidden_input_id = $input.data('hidden');
                    $(hidden_input_id).val($input.attr('data-id'));
                }
            })
        );


    </script>
    <script>
        function clickTrash(data) {
            let _token   = $('meta[name="csrf-token"]').attr('content');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                }
            });
            $.ajax({
                url: '{{url('samples/trash/deleteSamplesDiagnosis/')}}'+'/'+data,
                type:"get",
                success: function (data) {
                    $('#trashData'+data).remove()
                   // $(this).remove();
                }
            });
        }
    </script>

@endsection
