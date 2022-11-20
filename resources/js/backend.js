window.addEventListener('updated', event => {
    toastr.success(event.detail.message, 'Success!')
})

$(document).ready(function () {
    toastr.options = {
        "positionClass": "toast-top-right",
        "progressBar": true,
    }
})
