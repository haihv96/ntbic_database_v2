/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(1);
module.exports = __webpack_require__(5);


/***/ }),
/* 1 */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(2);
__webpack_require__(3);

/***/ }),
/* 2 */
/***/ (function(module, exports) {

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

/***/ }),
/* 3 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__custom__ = __webpack_require__(4);


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
        var bodyObject = new __WEBPACK_IMPORTED_MODULE_0__custom__["a" /* AppElement */](bodyElement);
        var liObject = new __WEBPACK_IMPORTED_MODULE_0__custom__["a" /* AppElement */]($(this).children());
        liObject.only_icon_loading();
        bodyObject.loading_area();
        $.ajax({
            url: $(this).children().attr('href'),
            type: 'GET',
            dataType: 'JSON',
            success: function success(response) {
                if (response.error == false) {
                    $('#raw-profiles').hide().html(response.data).fadeIn();
                }
            },
            complete: function complete() {
                bodyObject.remove_loading_area();
                liObject.reset();
            }
        }).bind(this);
    });

    $('body').on('keyup', '.search-in-table input', function () {
        var bodyElement = $('#raw-profiles');
        var bodyObject = new __WEBPACK_IMPORTED_MODULE_0__custom__["a" /* AppElement */](bodyElement);
        var liObject = new __WEBPACK_IMPORTED_MODULE_0__custom__["a" /* AppElement */]($(this).children());
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            dataType: 'JSON',
            data: {
                'search': $(this).val()
            },
            success: function success(response) {
                if (response.error == false) {
                    $('#raw-profiles').html(response.data);
                }
            },
            complete: function complete() {
                bodyObject.remove_loading_area();
                liObject.reset();
            }
        }).bind(this);
    });
});

/***/ }),
/* 4 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return AppElement; });
/* unused harmony export Form */
/* unused harmony export AjaxFormRequest */
var AppElement = function AppElement(element) {
    this.app_element = element;
    this.html = element.html();

    this.loading = function (html_append) {
        this.app_element.html(html_append);
        this.disable();
    };

    this.disable = function () {
        this.app_element.prop('disabled', true);
    };

    this.enable = function () {
        this.app_element.prop('disabled', false);
    };

    this.reset = function () {
        this.app_element.html(this.html);
        this.enable();
    };

    this.default_loading = function () {
        this.app_element.html('<i class="fa fa-spinner fa-spin"></i> ' + 'Loading...');
        this.disable();
    };

    this.only_icon_loading = function () {
        this.app_element.html('<i class="fa fa-spinner fa-spin"></i>');
        this.disable();
    };

    this.default_loading_gif = function () {
        this.app_element.html('<img width="40px" src="/assets/gif/loading.gif">');
        this.disable();
    };

    this.loading_area = function () {
        this.app_element.append('<div class="loading-area-background"></div> ' + '<div class="loading-area"></div>');
    };

    this.remove_loading_area = function () {
        this.app_element.find('.loading-area-background').remove();
        this.app_element.find('.loading-area').remove();
    };
};

var Form = function Form(form) {
    this.element = form;

    this.method = function () {
        var method = null;
        if (this.element.attr('method').length) {
            method = this.element.attr('method');
        } else {
            method = this.element.children('input[name="_method"]').val();
        }
        return method;
    };

    this.params = function () {
        return this.element.serialize();
    };

    this.action = function () {
        return this.element.attr('action');
    };

    this.clear_error = function () {
        this.element.find('.form-group').removeClass('has-error');
        this.element.find('span.error-class').remove();
        this.element.find('div.error-class').remove();
    };

    this.bootstrap_show_error = function (model, error_messages) {
        var number_errors = 0;
        var form_element = this.element;
        $.each(error_messages, function (key, values) {
            var input_element = form_element.find('#' + model + '_' + key);
            input_element.closest('.form-group').addClass('has-error');
            input_element.closest('.form-group').find('label').addClass('help-block error-class');
            $.each(values, function (index, value) {
                number_errors++;
                input_element.after('<span class="help-block error-class">' + '<div>' + key.replace('_', ' ') + ' field ' + value + '</div> ' + '</span>');
            });
        });
        form_element.find('.form-group').first().before('' + '<div class="alert alert-danger fade in alert-dismissable error-class">' + ' <a href="#" class="close" data-dismiss="alert" ' + 'aria-label="close" title="close">×' + '</a>you have <strong>' + number_errors + ' errors</strong> </div>');
    };

    this.clear_password_field = function () {
        this.element.find('input[type="password"]').val(null);
    };

    this.clear_input = function () {
        this.element.find('input').val(null);
        if (tinyMCE.activeEditor != null) {
            tinyMCE.activeEditor.setContent('');
        }
    };

    this.undo_input = function (form_for_model, method, url_ajax) {
        var form_element = this.element;
        $.ajax({
            type: method,
            url: url_ajax,
            data: { get_data_only: true },
            dataType: 'json',
            success: function success(response) {
                if (response.status == 'success') {
                    $.each(response.object, function (key, value) {
                        var input = form_element.find('#' + form_for_model + '_' + key);
                        if (input.prop('tagName') == 'TEXTAREA') {
                            tinyMCE.activeEditor.setContent(value);
                        } else {
                            input.val(value);
                        }
                    });
                }
            }
        });
        return false;
    };
};

var AjaxFormRequest = function AjaxFormRequest(datatype, form_object) {
    this.datatype = datatype;

    this.request = function (start, _success, warning, error, _complete, show_notice) {
        start();
        $.ajax({
            type: form_object.method(),
            url: form_object.action(),
            data: form_object.params(),
            dataType: this.datatype,
            success: function success(response) {
                if (show_notice) {
                    toastr[response.status](response.message);
                }
                switch (response.status) {
                    case 'success':
                        if (_success != null) {
                            _success(response);
                        }
                        break;
                    case 'warning':
                        if (warning != null) {
                            warning(response);
                        }
                        break;
                    default:
                        if (error != null) {
                            error(response);
                        }
                }
            },
            complete: function complete(response) {
                _complete(response);
            }
        });
        return false;
    };
};

/***/ }),
/* 5 */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ })
/******/ ]);