import {loadTinymce} from './custom';

$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('.alert').delay(6000).slideUp(200, function () {
        $(this).alert('close');
    });
    loadTinymce();
});