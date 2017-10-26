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
/******/ 	return __webpack_require__(__webpack_require__.s = 10);
/******/ })
/************************************************************************/
/******/ ({

/***/ 10:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(11);


/***/ }),

/***/ 11:
/***/ (function(module, exports) {

var submitButtonFormat = '<i class="checkmark icon"></i>Submit';
var nextButtonFormat = '<i class="angle double right icon"></i>Next';
var cancelButtonFormat = '<i class="remove icon"></i>Cancel';
var backButtonFormat = '<i class="angle double left icon"></i>Back';
var step = 1;
var max = 3;
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
        }
    });
    $("#test").click(function () {
        $('#modal').modal({
            closable: false,
            observeChanges: true
        }).modal('show').modal('refresh');
    });
    $('#btnNext').click(function (e) {
        e.preventDefault();
        handleStep(true);
        return false;
    });
    $('#btnBack').click(function () {
        handleStep(false);
        return false;
    });
    table = $('#table-units').DataTable({
        ajax: urlUnits,
        scrollY: '50vh',
        columns: [{ data: 'description', name: 'description', title: 'Building', class: 'center aligned' }, { data: 'floor_number', name: 'floor_number', title: 'Floor', class: 'center aligned' }, { data: 'type', name: 'type', title: 'Unit Type', class: 'center aligned' }, { data: 'size', name: 'size', title: 'Size', class: 'center aligned' }, { data: 'price', name: 'price', title: 'Price', class: 'center aligned' }, { data: 'action', orderable: false, searchable: false, class: 'center aligned' }]
    });
    $("body").on("click", ".button-details", function () {
        console.log($(this).attr('data-value'));
        console.log('test');
    });
    $('#table-units tbody').on('click', '.button-add', function () {
        $(this).html('test');
        //var row = table.row( (this).closest('tr') );
        //table.cell(row, 5).data("B").draw();
        //console.log(row.data());
    });
    $('.dropdown').dropdown();
    $('#address-select').dropdown({
        apiSettings: {
            // this url parses query server side and returns filtered results
            url: '//api.semantic-ui.com/tags/{query}'
        }
    });
    $('.ui.checkbox').checkbox();
    $('#form2').form({
        fields: {
            firstname: {
                identifier: 'first-name',
                rules: [{
                    type: 'empty',
                    prompt: 'Please enter your first name'
                }]
            },
            lastname: {
                identifier: 'last-name',
                rules: [{
                    type: 'empty',
                    prompt: 'Please enter your last name'
                }]
            },
            email: {
                identifier: 'email',
                rules: [{
                    type: 'email',
                    prompt: 'Please enter a valid email'
                }]
            },
            gender: {
                identifier: 'gender',
                rules: [{
                    type: 'empty',
                    prompt: 'Please select a gender'
                }]
            },
            address: {
                identifier: 'address',
                rules: [{
                    type: 'empty',
                    prompt: 'Please enter your address'
                }]
            },
            terms: {
                identifier: 'terms',
                rules: [{
                    type: 'checked',
                    prompt: 'You must agree to the terms and conditions'
                }]
            }
        }
    });
});

function handleStep(isForward) {
    if (step >= max && isForward) {
        //submit logic

    } else if (step == 1 && !isForward) {
        $('#modal').modal('hide');
    } else {
        var t = '#form' + step;
        if (isForward) {
            //check if form step is valid
            if ($(t).form('is valid')) {
                updateStepUI(true);
            } else {
                $(t).form('validate form');
            }
        } else {
            //$(t).form('reset');
            $('.ui.error.message').html('');
            updateStepUI(false);
        }
    }

    function updateStepUI(isForward) {
        if (isForward) {
            step++;
        } else {
            step--;
        }
        if (step == max) {
            document.getElementById('btnNext').innerHTML = submitButtonFormat;
        } else {
            document.getElementById('btnNext').innerHTML = nextButtonFormat;
        }
        if (step == 1) {
            document.getElementById('btnBack').innerHTML = cancelButtonFormat;
        } else {
            document.getElementById('btnBack').innerHTML = backButtonFormat;
        }
        //alert(step);
        for (var i = step - 1; i > 0; i--) {
            document.getElementById("step" + i).className = "completed step";
            document.getElementById("container" + i).style.display = "none";
        }
        for (var i = step + 1; i <= max; i++) {
            document.getElementById("step" + i).className = "step";
            document.getElementById("container" + i).style.display = "none";
        }
        document.getElementById("step" + step).className = "active step";
        document.getElementById("container" + step).style.display = "block";
    }
}

/***/ })

/******/ });