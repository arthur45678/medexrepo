window.$.fn.DataTable = require("datatables.net-bs4");
import dtHy from "./trans/hy/dt";
window.dt = { hy: {}, ru: {}, en: {} };
window.dt.hy = dtHy;

void (function($) {
    $.fn.CDataTable = async function(configs = {}, lang = "hy") {
        const language = window.dt[lang] || window.dt.hy;

        if (configs.rowGroup) {
            try {
                $.fn.DataTable.rowGroup = await require("datatables.net-rowgroup-bs4");
            } catch (e) {
                console.log(e);
            }
        }

        const table = $(this).DataTable({
            language,
            ...configs
        });

        if ($(this).hasClass("table-cursor")) {
            $(this)
                .find("tbody")
                .on("dblclick", "tr", function() {
                    const url = $(this).data("url");
                    window.open(url);
                });
        }

        return table;
    };

    $(".datatable-default").CDataTable();
})(window.$);
