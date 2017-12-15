import {AppElement} from './custom';

$(document).ready(function () {
    $('body').on('change', '.group-checkable', function () {
        if (this.checked) {
            $('.checkboxes').prop('checked', true);
        } else {
            $('.checkboxes').prop('checked', false);
        }
    });

    $('body').on('click', '.ajax-pagination li', function (e) {
        e.preventDefault();
        var bodyElement = $('#raw-profiles');
        var bodyObject = new AppElement(bodyElement);
        var liObject = new AppElement($(this).children());
        liObject.only_icon_loading();
        bodyObject.loading_area();
        $.ajax({
            url: $(this).children().attr('href'),
            type: 'GET',
            dataType: 'JSON',
            success: function (response) {
                if (response.error == false) {
                    $('#raw-profiles').hide().html(response.data).fadeIn();
                }
            },
            complete: function () {
                bodyObject.remove_loading_area();
                liObject.reset();
            }
        }).bind(this);
    });

    $('body').on('keyup', '.search-in-table input', function () {
        var bodyElement = $('#raw-profiles');
        var bodyObject = new AppElement(bodyElement);
        var liObject = new AppElement($(this).children());
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            dataType: 'JSON',
            data: {
                'search': $(this).val()
            },
            success: function (response) {
                if (response.error == false) {
                    $('#raw-profiles').html(response.data);
                }
            },
            complete: function () {
                bodyObject.remove_loading_area();
                liObject.reset();
            }
        }).bind(this);
    });
})