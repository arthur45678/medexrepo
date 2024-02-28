import $ from "jquery";
window.$ = window.jQuery = $;

void (function($) {
    window.addEventListener("beforeunload", function(e) {
        alert("Unload" + " " + localStorage.getItem("tabKey"));

        return "";
    });

    $.fn.checkForTag = function(tagName = "form") {
        if (!$(this).is(tagName)) {
            throw new Error(
                `This function can be used only on ${tagName} element,
                ${$(this).prop("tagName")} provided`
            );
        }
    };

    $.fn.toggleLoading = function(loading = false) {
        const spinner = $(this).find("span");
        const svg = $(this).find("svg");

        if (loading) {
            $(this).attr("disabled", "disabled");
            spinner.removeClass("d-none");
            svg.addClass("d-none");
        } else {
            $(this).removeAttr("disabled");
            spinner.addClass("d-none");
            svg.removeClass("d-none");
        }

        return this;
    };

    $.fn.validateForm = function(errors = {}) {
        $(this).checkForTag("form");

        for (let i in errors) {
            const elem = $(this).find(`.error[data-input=${i}]`);
            const inp = $(this).find(`input[name=${i}], textarea[name=${i}]`);

            if (elem.length) elem.text(errors[i]);

            if (inp.length) inp.addClass("is-invalid");
        }

        return this;
    };

    $.fn.cleanValidation = function() {
        $(this).checkForTag("form");

        $(this)
            .find(".is-invalid")
            .removeClass("is-invalid");

        $(this)
            .find(".error")
            .text("");

        return this;
    };

    $.ajaxSetup({
        headers: { "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content") }
    });

    // Form unsing ajax
    $(".ajax-submitable").submit(function(e) {
        e.preventDefault();

        $(this).cleanValidation();

        let btn = $(this).find(":submit");
        if (!btn.length) btn = $("button[form=" + $(this).attr("id") + "]");

        const formData = new FormData(this);
        const form = $(this);
        btn.toggleLoading(true);

        $(form)
            .find(".alert")
            .addClass("d-none");

        if ($(form).hasClass("has-files")) {
            $(form)
                .find(".progress")
                .removeClass("d-none")
                .find(".progress-bar")
                .removeClass("bg-danger")
                .attr("aria-valuenow", 0)
                .css("width", 0 + "%");
        }

        const ajaxConfig = {
            type: "POST",
            url: $(this).attr("action"),
            data: formData,
            contentType: false,
            processData: false,
            cache: false,
            success: function(resp) {
                // console.log("resp-", resp);
                btn.toggleLoading();
                if ($(form).hasClass("has-files")) {
                    $(form)
                        .find(".progress")
                        .addClass("d-none")
                        .find(".progress-bar")
                        .attr("aria-valuenow", 0)
                        .css("width", 0 + "%");
                }
            },
            error: function(err) {
                btn.toggleLoading();
                console.log(err);
                const errors = err.responseJSON.errors || {};
                form.validateForm(errors);

                if (form.hasClass("has-files")) {
                    form.find(".progress-bar").addClass("bg-danger");
                }

                form.find(".alert.alert-danger")
                    .removeClass("d-none")
                    .find(".alert-content")
                    // .text(err.responseJSON.message || "An error occured");
                    .text("Լրացված տվյալներն անվավեր են:");
            }
        };

        if ($(this).hasClass("has-files")) {
            ajaxConfig.xhr = function() {
                const xhr = $.ajaxSettings.xhr();
                if (xhr.upload) {
                    // For handling the progress of the upload
                    xhr.upload.addEventListener(
                        "progress",
                        function(e) {
                            if (e.lengthComputable) {
                                const percent = Math.round(
                                    (e.loaded / e.total) * 100
                                );
                                $(form)
                                    .find(".progress-bar")
                                    .attr("aria-valuenow", percent)
                                    .css("width", percent + "%");
                            }
                        },
                        false
                    );
                }
                return xhr;
            };
        }

        $.ajax(ajaxConfig).done(function(resp) {
            if (resp.success) {
                const container = form.find(".attachments-container");
                const delay = resp.delay || 1200;

                if (resp.attachments && container.length) {
                    // Immidiately render attachment badges, without refresh, data comes from back-end
                    resp.attachments.forEach(
                        ({ id, attachment_name, full_path }) => {
                            const attachmentTemplate = container
                                .find(".attachment")
                                .last()
                                .clone(true); // preserve events after clone

                            attachmentTemplate
                                .find("a")
                                .attr("href", full_path)
                                .text(attachment_name);

                            attachmentTemplate
                                .find("button.deletes-attachment")
                                .data("attachment", id);

                            attachmentTemplate.appendTo(container);
                        }
                    );
                }

                if (form.hasClass("dont-reset")) {
                    form.find(":file").val(""); // Reset only file inputs
                } else {
                    form[0].reset();
                }

                form.find(".alert.alert-success")
                    .removeClass("d-none")
                    .find(".alert-content")
                    .text(resp.success);

                console.log(resp)
                if(resp.hideFormId) {
                    let hideFormId = $(`#${resp.hideFormId}`);
                    if(hideFormId.length) {
                        hideFormId.find(".alert.alert-success")
                        .removeClass("d-none")
                        .find(".alert-content")
                        .text(resp.success);
                        setTimeout(() => {
                            hideFormId.hide(500);
                        }, delay);
                    }else{
                        console.error(`Error: form with "#${resp.hideFormId}" id not found!`);
                    }
                }

                if(resp.resetFormId) {
                    let resetFormId = $(`#${resp.resetFormId}`);
                    console.log(resetFormId)

                    if(resetFormId.length) {
                        resetFormId.find(".alert.alert-success")
                        .removeClass("d-none")
                        .find(".alert-content")
                        .text(resp.success);

                        if(resp.resetFields) {
                            setTimeout(() => {
                                resetFormId.get(0).reset();
                                let resetFields = resp.resetFields;
                                console.log(resetFields)
                                resetFields.forEach(function (value) {
                                    resetFormId.find(`[name="${value}"]`).val('');
                                })
                            }, delay);
                        }
                    }else{
                        console.error(`Error: form with "#${resp.hideFormId}" id not found!`);
                    }
                }

                if (resp.redirect) {
                    setTimeout(function () {
                      window.location.replace(resp.redirect);
                    }, delay);
                }

                if (resp.redirectWithHash) {
                    setTimeout(function () {
                      window.location.href = resp.redirectWithHash;
                      window.location.reload();
                    }, delay);
                }
            }

            if (resp.warning) {
                form.find(".alert.alert-warning")
                    .removeClass("d-none")
                    .find(".alert-content")
                    .text(resp.warning);

                if(resp.insertFormId) {
                    let insertFormId = $(`#${resp.insertFormId}`);
                    insertFormId.find(".alert.alert-warning")
                    .removeClass("d-none")
                    .find(".alert-content")
                    .text(resp.warning);
                }
            }
        });
    });

    // closing ajax-message (success and warning)
    $(".close-alert-btn").click(function() {
        $(this)
            .parent()
            .addClass("d-none");
    });

    $(".deletes-attachment").click(function(e) {
        $(this).toggleLoading(true);

        const attachment = $(this).data("attachment");
        $.ajax({
            method: "DELETE",
            url: `/attachments/${attachment}`,
            success: resp => {
                if (resp.success) {
                    $(this).toggleLoading();

                    $(this)
                        .closest(".attachment")
                        .fadeOut(400, function() {
                            $(this).remove();
                        });
                }
            },
            error: err => {
                $(this).toggleLoading();
                alert("An error occured");
            }
        });
    });

    //Duplicatable
    const btn_duplicatables = $(".btn-duplicatable");

    if (btn_duplicatables.length) {
        btn_duplicatables.click(function() {
            const dp_content = $(this)
                .closest(".duplicatable")
                .find(".duplicatable-content");

            const dp_element = dp_content.children().last();

            dp_element.clone().appendTo(dp_content);
        });
    }

    // add-reduce-btn functionality
    $(".btn-add-row").on("click", function() {
        const rowClass = $(this).data("row");
        const limit = $(this).data("limit") || repeatables;
        // console.log("limit-", limit);

        $(rowClass)
            .not(".d-none")
            .last()
            .next()
            .removeClass("d-none");
        const rowsLength = $(rowClass + "s");
        const rowsLengthVal = Number(rowsLength.val());
        if (rowsLengthVal < limit) {
            rowsLength.val(rowsLengthVal + 1);
        }
        // console.log("rowsLengthVal-", rowsLength.val());

        // only for /patients/1/referrals/create
        if (window.location.pathname === "/patients/1/referrals/create_test") {
            let prevIndex = rowsLengthVal - 1;
            let nextIndex = rowsLengthVal;

            let prevDepartmentSearchDataId = $(
                "#department_search_" + prevIndex
            ).data("id");
            let prevDepartmentSearchValue = $(
                "#department_search_" + prevIndex
            ).val();

            $("#department_search_" + nextIndex).val(prevDepartmentSearchValue);
            $("#department_id_" + nextIndex).val(prevDepartmentSearchDataId);

            let prevUserSearchDataId = $("#user_search_" + prevIndex).data(
                "id"
            );
            let prevUserSearchValue = $("#user_search_" + prevIndex).val();

            $("#user_search_" + nextIndex).val(prevUserSearchValue);
            $("#receiver_id_" + nextIndex).val(prevUserSearchDataId);
        }
    });

    $(".btn-reduce-row").on("click", function() {
        const rowClass = $(this).data("row");
        const limit = $(this).data('limit');
        const min = limit || 1;
        // console.log('not-d-none-length->',$(rowClass).not('.d-none').length)
        if ($(rowClass).not(".d-none").length > min) {
            $(rowClass)
                .not(".d-none")
                .last()
                .addClass("d-none");
            const rowsLength = $(rowClass + "s");
            rowsLength.val(Number(rowsLength.val()) - 1);
            // console.log('rowsLength-reduce ->', rowsLength.val())
        }
    });

    //confirmable button. Also works for submit buttons
    $(".btn-confirmable").click(function(e) {
        if (
            !confirm(
                $(this)
                    .data("confirm")
                    .replace("\n", "\n") || "Please confirm your action"
            )
        )
        e.preventDefault();
    });
})(window.$);
