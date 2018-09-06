var AppNotify = function () {
  "use strict";
  return {
    getSuccessTopOptions: function () {
      return {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-full-width",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "500",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
      };
    },
    getSuccessRightOptions: function () {
      return {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "500",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
      };
    },
    successTop: function (message) {
      toastr.options = this.getSuccessTopOptions();

      toastr.success(message);
    },
    infoTop: function (message) {
      toastr.options = this.getSuccessTopOptions();

      toastr.info(message);
    },
    warningTop: function (message) {
      toastr.options = this.getSuccessTopOptions();

      toastr.warning(message);
    },
    errorTop: function (message) {
      toastr.options = this.getSuccessTopOptions();

      toastr.error(message);
    },
    successRight: function (message) {
      toastr.options = this.getSuccessRightOptions();

      toastr.success(message);
    },
    infoRight: function (message) {
      toastr.options = this.getSuccessRightOptions();

      toastr.info(message);
    },
    warningRight: function (message) {
      toastr.options = this.getSuccessRightOptions();

      toastr.warning(message);
    },
    errorRight: function (message) {
      toastr.options = this.getSuccessRightOptions();

      toastr.error(message);
    }
  }
}();