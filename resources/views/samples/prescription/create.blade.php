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
    <div class="alert alert-danger alert-block add-false" style="display: none;">
        <button type="button" class="close" onclick="$('.add-false').hide()">×</button>
        <strong>Լրացնել ճիշտ </strong>
    </div>
    <div class="container">
        <form class="ajax-submitableADD" action="{{route('samples.patients.assignment_sheet.store', ['patient'=> $patient])}}"
              method="POST">
            @csrf
            <ul class="list-group">
                <li class="list-group-item">
                    <strong>
                        <span class="badge badge-light mr-1">1.</span>Բաժինը

                    </strong>
                    <ins class="ml-4"></ins>
                    <br>
                    {{$departments->name}}
                    <input type="hidden" value="{{auth()->user()->department_id}}" name="department">
                </li>
                <li class="list-group-item">
                    <strong>
                        <span class="badge badge-light mr-1">2.</span>
                      Հիվանդասենյակի համարը

                    </strong>
                    <ins class="ml-4"></ins>
                    <input type="number" class="form-control col-3" name="hospital_room_number">
                </li>

                <li class="list-group-item">
                    <strong>
                        <input type="hidden" name="patient_id" value="{{$patient->id}}">
                        <input type="hidden" name="user_id" value="{{auth()->id()}}">
                        <span class="badge badge-light mr-1">4.</span>
                        {{$patient->f_name}}
                        {{$patient->l_name}}
                        {{$patient->p_name}}

                    </strong>
                    <ins class="ml-4"></ins>
                </li>
                <!-- 2 -->

                <li class="list-group-item">
                    <strong>
                        <span class="badge badge-light mr-1">5.</span>
                        Բուժախտորոշիչ նշանակում
                    </strong>
                    <ins class="ml-4"></ins>
                    <table class="table" border="2">
                        <tr align="center">
                            <th class="nn" rowspan="2">#</th>
                            <th class="nn" rowspan="2">Բուժախտորոշիչ նշանակում</th>
                            <th class="nn" colspan="2">Ամսաթիվ</th>
                        </tr>
                        <tr>
                            <td>նշանակում</td>
                            <td>հանում</td>
                        </tr>
                        @foreach($diagnostics as $diagnostic)
                            <tr>
                                <td>{{$diagnostic->id}}</td>
                                <td>{{$diagnostic->name}}</td>
                                <td ><input type="date" name="appointment_date[]"></td>
                                <td ><input type="date" name="end_day[]"></td>
                            </tr>
                        @endforeach


                    </table>


                </li>

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
                                                      value='{{ old("prescription_medicine_id.$i") }}'
                                                      hidden-id="prescription_medicine_id{{ $i }}" hidden-name="prescription_medicine_id[]"
                                                      placeholder="Ընտրել դեղամիջոցը․․" />
                            </div>
                            <div class="form-row align-items-center my-2">
                                <div class="col-md-6">
                                    <strong>Քանակ՝</strong>
                                    <x-forms.text-field type="number" name='prescription_medicine_dose[]' label=""
                                                        value='{{ old("prescription_medicine_dose.$i") }}' validationType="ajax" />
                                </div>
                                <div class="col-md-6">
                                    <strong>չափման միավոր՝</strong>
                                    <select name="prescription_medicine_measure[]" class="form-control">
                                        <option value="">Ընտրել չախման միավորը․․․</option>

                                        @foreach ($measurement_units as $unit)
                                            <option value="{{$unit->id}}">{{__('measurement_units.'.$unit->name)}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <hr class="hr-dashed">
                            <div class="my-2">
                                <x-forms.text-field type="textarea" placeholder="դեղամիջոցի նշանակման աազատ դաշտ․․․"
                                                    value='{{ old("prescription_text.$i") }}' name="prescription_text[]"
                                                    validationType="ajax" label="" />
                            </div>
                        </div>
                    @endfor
                </li>
                @include('shared.forms.list_group_item_submit', ['btn_text'=>'Ուղարկել'])
                </li>
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
                        location.href='{{route('samples.patients.assignment_sheet.index',$patient->id)}}'
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

