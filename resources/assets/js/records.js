import { AppElement, AjaxFormRequest, Form, loadTinymce } from './custom';

$(document).ready(function () {
  const BODY = $('body');

  // Check all child checkbox on click group-checkbox
  BODY.on('change', '.group-checkable', function () {
    if (this.checked) {
      $(this).closest('table').find('.checkboxes').prop('checked', true);
    } else {
      $(this).closest('table').find('.checkboxes').prop('checked', false);
    }
  });

  BODY.on('change', '.checkboxes, .group-checkable', function () {
    const checkboxCheckeds = $('.checkboxes:checked');
    if (checkboxCheckeds.length) {
      let ids = [];
      $.each($('.checkboxes:checked'), function () {
        ids.push($(this).val());
      });

      $.each($('.form-records-selected'), function () {
        $(this).attr('action', `${$(this).data('model-url')}/${JSON.stringify(ids)}`);
        $(this).find('.records-checked').text(ids.length);
      });

      $('.action-records-selected').show();

    } else {
      $('.action-records-selected').hide();
    }
  });

  // Ajax pagination
  BODY.on('click', '.ajax-pagination li', function (e) {
    e.preventDefault();
    if (!$(this).find('a').length) return false;
    const url = $(this).find('a').attr('href');
    const currentPage = url.split('page=').splice(-1)[0];
    const recordsPagination = $(`#records-pagination-${currentPage}`);
    $('#current-page-url').val(url);
    if (recordsPagination.length) {
      $('.records-pagination').hide();
      recordsPagination.show();
    } else {
      loadTableFromUrl(url);
    }
  });

  // Search ajax in table
  BODY.on('keyup', '.search-in-table input', function () {
    const loadableObject = new AppElement($('#search-loadable'));
    $.ajax({
      url: $(this).attr('action'),
      type: $(this).attr('method'),
      dataType: 'JSON',
      data: {
        'search': $(this).val()
      },
      success: function (response) {
        $('#records').html(response.data);
      },
      complete: function () {
      }
    }).bind(this);
  });

  // All tag <a> has class="send-request"
  BODY.on('click', 'a.send-request', function () {
    const modalContainer = $('.shared-modal').find('.modal-container');
    const modalBodyObject = new AppElement(modalContainer);
    modalBodyObject.empty();
    modalBodyObject.loadingArea();
    $.ajax({
      url: $(this).data('url'),
      type: $(this).data('method'),
      dataType: 'JSON',
      success: function (response) {
        modalContainer.html(response.data).ready(function () {
          loadTinymce();
        });
      }
    });
  });

  // All tag <a> has class="request-client-modal"
  BODY.on('click', 'a.request-client-modal', function () {
    const modalContainer = $('.shared-modal').find('.modal-container');
    modalContainer.html($(this).find('.modal-content').html());
  });

  // Submit form ajax with model form-ajax
  BODY.on('submit', 'form.form-ajax', function (e) {
    e.preventDefault();
    const formObject = new Form($(this));
    const formAjax = new AjaxFormRequest('json', formObject);
    const submitButton = new AppElement($(this).find('.submit-form-ajax'));
    const closeButton = new AppElement($(this).find('.close-modal'));
    formAjax.request(
      () => {
        submitButton.defaultLoading();
        this.disableSubmitButton = setInterval(() => {
          $('.submit-form-ajax').prop('disabled', true);
        });
        closeButton.disable();
      },
      (response) => {
        $('.modal').modal('hide');
        if (formObject.element.data().hasOwnProperty('reloadable')) {
          new AppElement($('#records')).empty();
          loadTableFromUrl($('#current-page-url').val())
          $('.action-records-selected').hide();
        } else {
          const id = formObject.action().split('/').splice(-1)[0];
          $(`#record-${id}`).hide(function () {
            $(`#record-${id}`).replaceWith(response.data).fadeIn();
          });
        }
      },
      null,
      () => {
        submitButton.reset();
        closeButton.reset();
        $('.submit-form-ajax').prop('disabled', false);
        clearInterval(this.disableSubmitButton);
      },
      true);
  });
});

function loadTableFromUrl(url) {
  const bodyElement = $('#records');
  const bodyObject = new AppElement(bodyElement);
  bodyObject.loadingArea();
  $.ajax({
    url: url,
    type: 'GET',
    dataType: 'JSON',
    success: function (response) {
      $('.records-pagination').hide();
      $('#records').hide().append(response.data).fadeIn();
    },
    complete: function () {
      bodyObject.removeLoadingArea();
    }
  });
}