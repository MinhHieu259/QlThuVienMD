/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*********************************!*\
  !*** ./resources/js/backend.js ***!
  \*********************************/
window.addEventListener('updated', function (event) {
  toastr.success(event.detail.message, 'Success!');
});
$(document).ready(function () {
  toastr.options = {
    "positionClass": "toast-top-right",
    "progressBar": true
  };
});
/******/ })()
;