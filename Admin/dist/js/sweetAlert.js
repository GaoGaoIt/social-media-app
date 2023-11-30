


function alertSuccessToast(message) {
    Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: message,
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });
}

// JavaScript function for error toast
function alertErrorToast(message) {
    Swal.fire({
        icon: 'error',
        title: 'Error!',
        text: message,
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });
}