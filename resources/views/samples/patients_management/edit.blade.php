@extends('layouts.cardBase')


@section('css')
<link href="{{mix("/css/jquery.magicsearch.min.css")}}" rel="stylesheet" />
@endsection


@section('card-header')
@section('card-header-classes', '')

<div class="text-center">
    <h3>ՕԺԱՆԴԱԿ - ՄԵԽԱՆԻԿԱԿԱՆ ՇՆՉԱՌՈՒԹՅԱՄԲ ՀԻԱՎԱՆԴՆՐԻ ՎԱՐՈՒՄ</h3>
</div>
@endsection


@section('card-content')

<div class="container">
    <form class="ajax-submitable" action="{{route('samples.patients.patients-management.store', ['patient'=> $patient])}}" method="POST">
        @csrf
        <ul class="list-group">
                <li class="list-group-item">
                    <div class="form-row">
                        <div class="col-md-6">
                            <strong>
                                Ազգանուն, անուն, հայրանուն
                            </strong>
                            <ins class="ml-4"></ins>
                        </div>
                        <div class="col-md-6">
                            <strong>
                            հ/պ №
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
                            <x-forms.text-field name="admission_date" validation-type="ajax" type="date"
                                value="{{ $post->admission_date }}" label="" />
                        </div>
                    </div>
                </li>
                <li class="list-group-item list-group-item-info">
                    <h4 class="text-center">
                        ՇՆՉԱՌԱԿԱՆ ՍԱՐՔԻ ՑՈՒՑԱՆԻՇՆԵՐԸ
                    </h4>
                </li>
                <li class="list-group-item">
                    <div class="form-row align-items-center">
                        <div class="col-md-4">
                            <strong>Ռեժիմը V (շնչառական ծավալը)</strong>
                        </div>
                        <div class="col-md-8">
                            <div class="input-group align-items-center">
                                <x-forms.text-field type="number" class="col-4" name="mode_v" id="height" value="" min="1" max="24" label="" value="{{ $post->mode_v }}"/>
                                <label class="ml-2" for="height"><strong></strong></label>
                            </div>
                        </div>
                    </div>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="mode_v_comment" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{ $post->mode_v_comment }}" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="form-row align-items-center">
                        <div class="col-md-4">
                            <strong>Հիվանդի V cxp</strong>
                        </div>
                        <div class="col-md-8">
                            <div class="input-group align-items-center">
                                <x-forms.text-field  type="number" class="col-4" name="patient_v_cxp" id="patient_v_cxp" value="{{ $post->patient_v_cxp }}" min="1" max="24" label=""/>
                                <label class="ml-2" for="	patient_v_cxp"><strong></strong></label>
                            </div>
                        </div>
                    </div>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="patient_v_cxp_comment" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{ $post->patient_v_cxp_comment }}" label="" />
                    </div>
                </li>

                <li class="list-group-item">
                    <div class="form-row align-items-center">
                        <div class="col-md-4">
                            <strong>Fq (շնչ.Հաճախ)</strong>
                        </div>
                        <div class="col-md-8">
                            <div class="input-group align-items-center">
                                <x-forms.text-field type="number" class="col-4" name="fq" id="fq" value="{{ $post->fq }}" min="1" max="24" label=""/>
                                <label class="ml-2" for="height"><strong></strong></label>
                            </div>
                        </div>
                    </div>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="fq_comment" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{ $post->fq_comment }}" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="form-row align-items-center">
                        <div class="col-md-4">
                            <strong>Հիվանդի Fq</strong>
                        </div>
                        <div class="col-md-8">
                            <div class="input-group align-items-center">
                                <x-forms.text-field type="number" class="col-4" name="patient_fq" id="patient_fq" value="{{ $post->patient_fq }}" min="1" max="24" label=""/>
                                <label class="ml-2" for="patient_fq"><strong></strong></label>
                            </div>
                        </div>
                    </div>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="patient_fq_comment" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{ $post->patient_fq_comment }}" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="form-row align-items-center">
                        <div class="col-md-4">
                            <strong>FiO2 / PEEP</strong>
                        </div>
                        <div class="col-md-8">
                            <div class="input-group align-items-center">
                                <x-forms.text-field type="number" class="col-4" name="fiO2_peep" id="fiO2_peep" value="{{ $post->fiO2_peep }}" min="1" max="24" label=""/>
                                <label class="ml-2" for="height"><strong></strong></label>
                            </div>
                        </div>
                    </div>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="fiO2_peep_comment" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{ $post->fiO2_peep_comment }}" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="form-row align-items-center">
                        <div class="col-md-4">
                            <strong>Ps (շնչ.Օգնություն)</strong>
                        </div>
                        <div class="col-md-8">
                            <div class="input-group align-items-center">
                                <x-forms.text-field value="{{ $post->ps_respiratory_assistance }}" type="number" class="col-4" name="ps_respiratory_assistance" id="height" value="" min="1" max="24" label=""/>
                                <label class="ml-2" for="ps_respiratory_assistance"><strong></strong></label>
                            </div>
                        </div>
                    </div>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="ps_respiratory_assistance_comment" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{ $post->ps_respiratory_assistance_comment }}" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="form-row align-items-center">
                        <div class="col-md-4">
                            <strong>Ճնշ. Շնչուղիներում SaO2</strong>
                        </div>
                        <div class="col-md-8">
                            <div class="input-group align-items-center">
                                <x-forms.text-field type="number" class="col-4" name="in_the_airways_saO2" id="height" value="{{ $post->in_the_airways_saO2 }}" min="1" max="24" label=""/>
                                <label class="ml-2" for="height"><strong></strong></label>
                            </div>
                        </div>
                    </div>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="in_the_airways_saO2_comment" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{ $post->in_the_airways_saO2_comment }}" label="" />
                    </div>
                </li>
                <li class="list-group-item list-group-item-info">
                    <h4 class="text-center">
                        ՀՍԿՈՂՈՒԹՅՈՒՆԸ
                    </h4>
                </li>
                <li class="list-group-item">
                    <div class="form-row align-items-center">
                        <div class="col-md-4">
                            <strong>Զարկ. Ճնշում</strong>
                        </div>
                        <div class="col-md-8">
                            <div class="input-group align-items-center">
                                <x-forms.text-field type="number" class="col-4" name="artery_pressure" id="artery_pressure" value="{{ $post->artery_pressure }}" min="1" max="24" label=""/>
                                <label class="ml-2" for="height"><strong></strong></label>
                            </div>
                        </div>
                    </div>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="artery_pressure_comment" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{ $post->artery_pressure_comment }}" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="form-row align-items-center">
                        <div class="col-md-4">
                            <strong>Կենտ երակ ճնշ.</strong>
                        </div>
                        <div class="col-md-8">
                            <div class="input-group align-items-center">
                                <x-forms.text-field type="number" class="col-4" name="central_vein_pressure" id="central_vein_pressure" value="{{ $post->central_vein_pressure }}" min="1" max="24" label=""/>
                                <label class="ml-2" for="height"><strong></strong></label>
                            </div>
                        </div>
                    </div>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="central_vein_pressure_comment" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{ $post->central_vein_pressure_comment }}" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="form-row align-items-center">
                        <div class="col-md-4">
                            <strong>Պուլս</strong>
                        </div>
                        <div class="col-md-8">
                            <div class="input-group align-items-center">
                                <x-forms.text-field type="number" class="col-4" name="pulse" id="pulse" value="{{ $post->pulse }}" min="1" max="24" label=""/>
                                <label class="ml-2" for="height"><strong></strong></label>
                            </div>
                        </div>
                    </div>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="pulse_comment" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{ $post->pulse_comment }}" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="form-row align-items-center">
                        <div class="col-md-4">
                            <strong>Ջերմություն</strong>
                        </div>
                        <div class="col-md-8">
                            <div class="input-group align-items-center">
                                <x-forms.text-field type="number" class="col-4" name="temperature" id="temperature" value="{{ $post->temperature }}" min="1" max="24" label=""/>
                                <label class="ml-2" for="height"><strong></strong></label>
                            </div>
                        </div>
                    </div>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="temperature_comment" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{ $post->temperature_comment }}" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="form-row align-items-center">
                        <div class="col-md-4">
                            <strong>Դիհուրեզ</strong>
                        </div>
                        <div class="col-md-8">
                            <div class="input-group align-items-center">
                                <x-forms.text-field type="number" class="col-4" name="dihurez" id="dihurez" value="{{ $post->dihurez }}" min="1" max="24" label=""/>
                                <label class="ml-2" for="height"><strong></strong></label>
                            </div>
                        </div>
                    </div>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="dihurez_comment" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{ $post->dihurez_comment }}" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="form-row align-items-center">
                        <div class="col-md-4">
                            <strong>Դրենաժներ՝</strong>
                        </div>
                        <div class="col-md-8">
                            <div class="input-group align-items-center">
                                <x-forms.text-field type="number" class="col-4" name="drainages" id="drainages" value="{{ $post->drainages }}" min="1" max="24" label=""/>
                                <label class="ml-2" for="height"><strong></strong></label>
                            </div>
                        </div>
                    </div>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="drainages_comment" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{ $post->drainages_comment }}" label="" />
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="form-row align-items-center">
                        <div class="col-md-4">
                            <strong>Ներմուծված հեղուկ Մլ.</strong>
                        </div>
                        <div class="col-md-8">
                            <div class="input-group align-items-center">
                                <x-forms.text-field type="number" class="col-4" name="imported_liquid_ml" id="imported_liquid_ml" value="{{ $post->imported_liquid_ml }}" min="1" max="24" label=""/>
                                <label class="ml-2" for="height"><strong></strong></label>
                            </div>
                        </div>
                    </div>
                    <div class="mt-2">
                        <x-forms.text-field type="textarea" name="imported_liquid_ml_comment" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․"
                        value="{{ $post->imported_liquid_ml_comment }}" label="" />
                    </div>
                </li>


            /*Test*/
            @foreach($medicineLists as $k=>$medicineList)


                <form class="ajax-submitableADD"
                      action="{{route('samples.patients-management.medicinelistsUpdate',$medicineList->id)}}"
                      method="post" >
                    @method('PATCH')
                    @csrf
                    <tr class="delete{{$medicineList->id}}" >
                        <td>{{$k+1}}</td>
                        <td>

                            <x-forms.magic-search class="medicines-search magic-search ajax"
                                                  data-catalog-name="medicines"
                                                  value='{{$medicineList->medicine_item->id}}'
                                                  hidden-id="prescription_medicine_id{{ $medicineList->medicine_item->id }}"
                                                  hidden-name="prescription_medicine_id"
                                                  placeholder="Ընտրել դեղամիջոցը․․" style="width: 250px;"/>


                        </td>
                        <td><input type="number" value="{{$medicineList->medicine_dose}}"
                                   name='prescription_medicine_dose' style="width: 90px;"></td>
                        <td>

                        <td>
                            <x-forms.text-field type="textarea" placeholder="դեղամիջոցի նշանակման աազատ դաշտ․․․"
                                                value='{{$medicineList->prescription_comments}}'
                                                name="prescription_text"
                                                validationType="ajax" label=""/>
                        </td>
                        <td><input type="number" value="{{$medicineList->drugs}}" name="drugs"
                                   style="width: 90px;"></td>
                        <td >
                            <button type="submit"
                                    class="btn btn-primary mr-2">
                                <svg class="c-icon">
                                    <use
                                        xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-save"></use>
                                </svg>

                            </button>

                        </td>

                </form>
                <td>
                    <form class="ajax-submitable"
                          action="{{route('samples.medicationDelete',$medicineList->id)}}"
                          method="post" id="restdata">
                        @method('PATCH')
                        @csrf
                        <button type="submit" class="btn btn-primary mr-2" onclick="$('.delete{{$medicineList->id}}').hide()">  <x-svg icon="cui-trash" /></button>
                    </form>

                </td>

                </tr>

            @endforeach

            /*Testend*/

                <li class="list-group-item">
                    <strong>Նշանակումներ՝</strong>
                    <x-forms.prev-posts-link href='' size='md' />

                    <x-forms.add-reduce-button type="add" data-row=".stationary-prescription-row" />
                    <x-forms.add-reduce-button type="reduce" data-row=".stationary-prescription-row" />
                    <x-forms.hidden-counter class="stationary-prescription-rows" name="prescription_length" />

                    @for($i = 0; $i < $repeatables; $i++)
                        <div class="stationary-prescription-row {{ $i < old('prescription_length', 1) ? ' ' : 'd-none' }}">
                            <hr class="mb-2">
                            <strong>դեղամիջոց՝</strong>
                            <div class="mb-2">
                                <x-forms.magic-search class="medicines-search magic-search ajax"
                                                      data-catalog-name="medicines"
                                                      value='{{ old("medicinelists_id.$i") }}'
                                                      hidden-id="medicinelists_id{{ $i }}" hidden-name="medicinelists_id[]"
                                                      placeholder="Ընտրել դեղամիջոցը․․" />
                            </div>
                            <div class="form-row align-items-center my-2">
                                <div class="input-group align-items-center">
                                    <x-forms.text-field type="number" class="col-md-12" name="drug_using_time[]" id="drug_using_time[]" value="" min="1" max="24" label="" placeholder="ժամ"/>
                                </div>

                            </div>
                            <hr class="hr-dashed">
                            <div class="my-2">
                                <x-forms.text-field type="textarea" placeholder="դեղամիջոցի նշանակման աազատ դաշտ․․․"
                                                    value='{{ old("medicinelists_comment.$i") }}' name="medicinelists_comment[]"
                                                    validationType="ajax" label="" />
                            </div>
                        </div>
                    @endfor
                </li>



                <li class="list-group-item">

                        <strong>Հերթապահ Բժիշկ՝</strong>
                        <x-forms.magic-search hidden-id="ue_attending_doctor_id" hidden-name="attending_doctor_id"
                        placeholder="Ընտրել բուժող բժիշկին․․․" class="magic-search ajax my-2" data-list-name="users"
                        value="{{ $post->attending_doctor->id }}" />
                        <strong>Բուժքույրեր՝</strong>
                        <x-forms.magic-search hidden-id="nurse_doctor_id" hidden-name="nurse_doctor_id"
                        placeholder="Ընտրել բուժող բժիշկին․․․" class="magic-search ajax my-2" data-list-name="users"
                        value="{{ $post->nurse_doctor->id }}" />
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

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content")
            }
        }); // Form unsing ajax

        $(".ajax-submitableADD").submit(function (e) {
            e.preventDefault();
            $(this).cleanValidation();
            var btn = $(this).find(":submit");
            if (!btn.length) btn = $("button[form=" + $(this).attr("id") + "]");
            var formData = new FormData(this);
            var form = $(this);
            btn.toggleLoading(true);
            $(form).find(".alert").addClass("d-none");

            if ($(form).hasClass("has-files")) {
                $(form).find(".progress").removeClass("d-none").find(".progress-bar").removeClass("bg-danger").attr("aria-valuenow", 0).css("width", 0 + "%");
            }

            var ajaxConfig = {
                type: "POST",
                url: $(this).attr("action"),
                data: formData,
                contentType: false,
                processData: false,
                cache: false,
                success: function success(resp) {
                    // console.log("resp-", resp);
                    btn.toggleLoading();

                    if ($(form).hasClass("has-files")) {
                        $(form).find(".progress").addClass("d-none").find(".progress-bar").attr("aria-valuenow", 0).css("width", 0 + "%");
                    }
                    console.log(resp)
                    if(resp=='reload'){


                        window.location.href="{{route('samples.patients.patients-management.index',$patient->id)}}";
                    }else if(resp=='add-false') {
                        $('.add-false').show()

                    }

                },
                error: function error(err) {
                    btn.toggleLoading();
                    console.log(err);
                    var errors = err.responseJSON.errors || {};
                    form.validateForm(errors);

                    if (form.hasClass("has-files")) {
                        form.find(".progress-bar").addClass("bg-danger");
                    }

                    form.find(".alert.alert-danger").removeClass("d-none").find(".alert-content") // .text(err.responseJSON.message || "An error occured");
                        .text("Լրացված տվյալներն անվավեր են:");
                }
            };

            if ($(this).hasClass("has-files")) {
                ajaxConfig.xhr = function () {
                    var xhr = $.ajaxSettings.xhr();

                    if (xhr.upload) {
                        // For handling the progress of the upload
                        xhr.upload.addEventListener("progress", function (e) {
                            if (e.lengthComputable) {
                                var percent = Math.round(e.loaded / e.total * 100);
                                $(form).find(".progress-bar").attr("aria-valuenow", percent).css("width", percent + "%");
                            }
                        }, false);
                    }

                    return xhr;
                };
            }

            $.ajax(ajaxConfig).done(function (resp) {
                if (resp.success) {
                    if (resp.redirect) {
                        // Redirect to the url (if present) sent by back-end
                        setTimeout(function () {
                            window.location.assign(resp.redirect);
                        }, 1000);
                    }

                    var container = form.find(".attachments-container");

                    if (resp.attachments && container.length) {
                        // Immidiately render attachment badges, without refresh, data comes from back-end
                        resp.attachments.forEach(function (_ref) {
                            var id = _ref.id,
                                attachment_name = _ref.attachment_name,
                                full_path = _ref.full_path;
                            var attachmentTemplate = container.find(".attachment").last().clone(true); // preserve events after clone

                            attachmentTemplate.find("a").attr("href", full_path).text(attachment_name);
                            attachmentTemplate.find("button.deletes-attachment").data("attachment", id);
                            attachmentTemplate.appendTo(container);
                        });
                    }

                    if (form.hasClass("dont-reset")) {
                        form.find(":file").val(""); // Reset only file inputs
                    } else {
                        form[0].reset();
                    }

                    form.find(".alert.alert-success").removeClass("d-none").find(".alert-content").text(resp.success);
                }

                if (resp.warning) {
                    form.find(".alert.alert-warning").removeClass("d-none").find(".alert-content").text(resp.warning);
                }
            });
        }); // closing ajax-message (success and warning)

    </script>
@endsection
