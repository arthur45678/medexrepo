const tooltips = document.querySelectorAll('[data-toggle="tooltip"]');

if (tooltips.length) {
    tooltips.forEach(function(element) {
        new coreui.Tooltip(element);
    });
}
