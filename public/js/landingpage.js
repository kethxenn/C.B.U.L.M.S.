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

	$("#test").click(function () {
		$('#modal').modal({
			closable: false
		}).modal('show');
	});
	$('#btnNext').click(function () {
		handleStep(true);
		return false;
	});
	$('#btnBack').click(function () {
		handleStep(false);
		return false;
	});
});
function handleStep(isForward) {
	if (step >= max && isForward) {
		//submit
		alert('submit');
	} else if (step == 1 && !isForward) {
		alert('exit');
	} else {
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
		alert(step);
		for (var i = step - 1; i > 0; i--) {
			document.getElementById("step" + i).className = "completed step";
			document.getElementById("form" + i).style.display = "none";
		}
		for (var i = step + 1; i <= max; i++) {
			document.getElementById("step" + i).className = "step";
			document.getElementById("form" + i).style.display = "none";
		}
		document.getElementById("step" + step).className = "active step";
		document.getElementById("form" + step).style.display = "block";
	}
}

/***/ })

/******/ });