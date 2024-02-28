@extends('layouts.cardBase')


@section('css')
    <link href="{{mix("/css/jquery.magicsearch.min.css")}}" rel="stylesheet"/>
    <style>
        tr, td, th {
            border: 1px solid black;
        }</style>
@endsection


@section('card-header')
@section('card-header-classes', '')

<div class="text-center">
    <h3>Նշանակման թերթիկ</h3>
</div>
@endsection


@section('card-content')

    <div class="container">

        <ul class="list-group">


                <li class="list-group-item">
                    <strong>
                        <span class="badge badge-light mr-1">1.</span>Բաժինը

                    </strong>
                    {{$sheet->departments->name}}
                    <ins class="ml-4"></ins>
                    <br>

                </li>
                <input type="hidden" name="patient_id" value="{{$sheet->patient_id}}">
                <li class="list-group-item">
                    <strong>
                        <span class="badge badge-light mr-1">2.</span>
                        Հիվանդասենյակի համարը

                    </strong>
                    <ins class="ml-4"></ins>
                    N {{$sheet->hospital_room_number}}
                </li>
            <li class="list-group-item">
                <strong>
                    <span class="badge badge-light mr-1">4.</span>
                    {{$patient->f_name}}
                    {{$patient->l_name}}
                    {{$patient->p_name}}

                </strong>
                <ins class="ml-4"></ins>
            </li>

            <li class="list-group-item">
                <strong>
                    <span class="badge badge-light mr-1">5.</span>
                    Նշանակված դեղեր
                </strong>
                <div class="alert alert-success alert-block prescriptionupdatetrue" style="display: none">
                    <button type="button" class="close" onclick="$('.prescriptionupdatetrue').hide()">×</button>
                    <strong>Փոփոխություները պահպանված են</strong>
                </div>
                <div class="alert alert-danger alert-block prescriptionupdatefalse" style="display: none;">
                    <button type="button" class="close" onclick="$('.prescriptionupdatefalse').hide()">×</button>
                    <strong>Լրացնել ճիշտ </strong>
                </div>
                <ins class="ml-4"></ins>

                <table class="table" border="2" id="addColums">
                    <tr align="center">
                        <th class="nn" rowspan="2">#</th>
                        <th class="nn" rowspan="2">Դեղամիջոցը</th>
                        <th class="nn" colspan="2">նշանակում</th>
                        <th class="nn" rowspan="2">Մեկնաբանություն</th>
                        <th class="nn" rowspan="2">Ստացվել է դեղատնից</th>

                    </tr>

                    <tr>

                        <td>Հատ</td>
                        <td>Քանակ</td>


                    </tr>
                    @foreach($prescraption as $k=>$prescraptions)
                        <form class="ajax-submitableADD"
                              action="{{route('samples.medicationUpdate',$prescraptions->id)}}"
                              method="post" >
                            @method('PATCH')
                            @csrf
                            <tr class="delete{{$prescraptions->id}}" >
                                <td>{{$k+1}}</td>
                                <td>
                                    {{$prescraptions->medicine_name->name}}
                                    <input type="hidden" value=" {{$prescraptions->medicine_name->id}}" name="prescription_medicine_id">
                                </td>
                                <td><input type="hidden" value="{{$prescraptions->medicine_dose}}"
                                           name='prescription_medicine_dose' style="width: 90px;">{{$prescraptions->medicine_dose}}</td>
                                <td>
                                    {{__('measurement_units.'.$prescraptions->MeasurementUnit->name)}}
                                    <select name="prescription_medicine_measure" hidden>
                                        @foreach ($measurement_units as $unit)
                                            @if($prescraptions->measurement_unit_id==$unit->id)
                                                <option value="{{$unit->id}}"
                                                        selected>{{__('measurement_units.'.$unit->name)}}</option>

                                            @else
                                                <option value="{{$unit->id}}">{{__('measurement_units.'.$unit->name)}}</option>
                                            @endif
                                        @endforeach
                                    </select></td>
                                <td>
                                    <x-forms.text-field type="hidden" placeholder="դեղամիջոցի նշանակման աազատ դաշտ․․․"
                                                        value='{{$prescraptions->prescription_comments}}'
                                                        name="prescription_text"
                                                        validationType="ajax" label=""/> {{$prescraptions->prescription_comments}}
                                </td>
                                <td><input type="number" value="{{$prescraptions->drugs}}" name="drugs"
                                           style="width: 90px;">
                                    <button type="submit"
                                            class="btn btn-primary mr-2">
                                        <svg class="c-icon">
                                            <use
                                                xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-save"></use>
                                        </svg>

                                    </button>
                                </td>


                        </form>


                        </tr>

                    @endforeach


                </table>


            </li>

        </ul>
        <button class="btn btn-success" style="float:right;" onclick="location.href='{{route('samples.patients.assignment_sheet.index',$sheet->patient_id)}}'">back</button>
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
                        location.reload();
                    }else if(resp=='calendar-false') {
                        $('.msgcalendar').show();

                    }else if(resp=='calendar-true') {
                        $('.msgcalendartrue').show()


                    }else if(resp=='sheet-true') {
                        $('.msgsheettrue').show()

                    }else if(resp=='sheet-false') {
                        $('.msgshett').show()

                    }else if(resp=='add-false') {
                        $('.add-false').show()

                    }else if(resp=='prescription-updatetrue') {
                        $('.prescriptionupdatetrue').show()

                    }else if(resp=='prescription-updatefalse') {
                        $('.prescriptionupdatefalse').show()

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

