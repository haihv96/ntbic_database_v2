export class AppElement {
    constructor(element) {
        this.appElement = element;
        this.html = element.html()
    }

    loading(htmlAppend) {
        this.appElement.html(htmlAppend);
        this.disable();
    };

    disable() {
        this.appElement.prop('disabled', true);
    };

    enable() {
        this.appElement.prop('disabled', false);
    };

    reset() {
        this.appElement.html(this.html);
        this.enable();
    };

    defaultLoading() {
        this.appElement.html('<i class="fa fa-spinner fa-spin"></i> ' +
            'Loading...');
        this.disable();
    };

    onlyIconLoading() {
        this.appElement.html('<i class="fa fa-spinner fa-spin"></i>');
        this.disable();
    };

    defaultLoadingGif() {
        this.appElement.html('<img width="40px" src="/assets/gif/loading.gif">');
        this.disable();
    };

    loadingArea() {
        this.appElement.append('<div class="loading-area-background"></div> ' +
            '<div class="loading-area"></div>');
    };

    removeLoadingArea() {
        this.appElement.find('.loading-area-background').remove();
        this.appElement.find('.loading-area').remove();
    };

    empty() {
        this.appElement.html('');
    }
};

export class Form {
    constructor(form) {
        this.element = form;
    }

    method() {
        let method = null;
        if (this.element.children('input[name="_method"]').length) {
            method = this.element.children('input[name="_method"]').val();
        } else {
            method = this.element.attr('method');
        }
        return method;
    };

    params() {
        return this.element.serialize();
    };

    action() {
        return this.element.attr('action');
    };

    clearError() {
        this.element.find('.form-group').removeClass('has-error');
        this.element.find('span.error-class').remove();
        this.element.find('div.error-class').remove();
    };

    bootstrapShowError(errorMessages) {
        let numberErrors = 0;
        let formElement = this.element;
        for (let attr in errorMessages) {
            let inputElement = formElement.find('#' + attr);
            inputElement.closest('.form-group').addClass('has-error');
            inputElement.closest('.form-group').find('label')
                .addClass('help-block error-class');
            for (let value of errorMessages[attr]) {
                numberErrors++;
                inputElement.after(`<span class="help-block error-class">${value}</div></span>`);
            }
        }
        formElement.find('.form-group').first().before('' +
            '<div class="alert alert-danger fade in alert-dismissable error-class">' +
            ' <a href="#" class="close" data-dismiss="alert" ' +
            'aria-label="close" title="close">×' +
            '</a>you have <strong>' + numberErrors + ' errors</strong> </div>');
    };

    clearPasswordField() {
        this.element.find('input[type="password"]').val(null);
    };

    clearInput() {
        this.element.find('input').val(null);
        tinyMCE.activeEditor != null ? tinyMCE.activeEditor.setContent('') : null;
    };

    undoInput(formForModel, method, urlAjax) {
        var formElement = this.element;
        $.ajax({
            type: method,
            url: urlAjax,
            data: {get_data_only: true},
            dataType: 'json',
            success: function (response) {
                $.each(response.object, function (key, value) {
                    var input = formElement.find('#' + formForModel + '_' + key);
                    input.prop('tagName') == 'TEXTAREA' ?
                        tinyMCE.activeEditor.setContent(value) : input.val(value);
                });
            }
        });
        return false;
    };
}

export class AjaxFormRequest {
    constructor(datatype, formObject) {
        this.datatype = datatype;
        this.formObject = formObject;
    }

    request(start, success, error, complete, showNotice) {
        start ? start() : null;
        $.ajax({
            type: this.formObject.method(),
            url: this.formObject.action(),
            data: this.formObject.params(),
            dataType: this.datatype,
            success: function (response) {
                this.formObject.clearError();
                showNotice ? toastr['success'](response.message) : null;
                success ? success(response) : null;
            }.bind(this),
            error: function (response) {
                response.hasOwnProperty('responseJSON') ? response = response.responseJSON : null;
                this.formObject.clearError();
                this.formObject.bootstrapShowError(response.errors);
                showNotice ? toastr['error'](response.message) : null;
                error ? error(response) : null;
            }.bind(this),
            complete: function (response) {
                complete ? complete(response) : null;
            }.bind(this)
        });
        return false;
    }
}

export const loadTinymce = () => {
    tinymce.remove();
    tinyMCE.init({
        selector: '.tinymce',
        plugins: [
            'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            'searchreplace wordcount visualblocks visualchars code fullscreen',
            'insertdatetime media nonbreaking save table contextmenu directionality',
            'emoticons template paste textcolor colorpicker textpattern codesample',
            'toc spellchecker imagetools help'
        ],
        toolbar: 'insertfile undo redo | styleselect | bold italic strikethrough | alignleft aligncenter alignright alignjustify | ltr rtl | bullist numlist outdent indent removeformat formatselect| link image media | emoticons charmap | code codesample | forecolor backcolor',
        branding: false,
        relative_urls: false,
        file_browser_callback: function (field_name, url, type, win) {
            var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
            var y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight;

            var cmsURL = '/laravel-filemanager?field_name=' + field_name;
            if (type == 'image') {
                cmsURL = cmsURL + "&type=Images";
            } else {
                cmsURL = cmsURL + "&type=Files";
            }

            tinyMCE.activeEditor.windowManager.open({
                file: cmsURL,
                title: 'Filemanager',
                width: x * 0.8,
                height: y * 0.8,
                resizable: "yes",
                close_previous: "no"
            });
        },
        entity_encoding: "raw",
        forced_root_block: "",
        height: "200",
        skin: 'custom'
    });
};
