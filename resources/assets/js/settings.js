$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('.alert').delay(6000).slideUp(200, function () {
        $(this).alert('close');
    });
});

toastr.options = {
    'closeButton': true,
    'debug': false,
    'positionClass': 'toast-bottom-right',
    'onclick': null,
    'showDuration': '1000',
    'hideDuration': '1000',
    'timeOut': '5000',
    'extendedTimeOut': '1000',
    'showEasing': 'swing',
    'hideEasing': 'linear',
    'showMethod': 'fadeIn',
    'hideMethod': 'fadeOut'
};