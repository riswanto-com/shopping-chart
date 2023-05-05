function errors(msg) {
    Swal.fire({
        icon: 'error',
        text: msg,
        showConfirmButton: false,
        timer: 1500
    })
}
function success(msg) {
    Swal.fire({
        position: 'top-end',
        icon: 'success',
        text: msg,
        showConfirmButton: false,
        timer: 1500
    })
}
function warning(msg) {
    Swal.fire({
        icon: 'warning',
        text: msg,
        showConfirmButton: false,
        timer: 1500
    })
}