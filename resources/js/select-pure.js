import * as tail from "tail.select/js/tail.select-es6";

window.tail = tail;

document.addEventListener("DOMContentLoaded", function() {
    tail.select(".without-search", {
        /* Your Options */
        search: false
    });
    tail.select(".with-search", {
        /* Your Options */
        search: true
    });
});
