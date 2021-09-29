$(document).ready(async function () {

    // Message
    const flashdata = document.querySelector('.flashdata');
    if (flashdata) {
        const toID = document.querySelector('.data-to_id');
        const message = flashdata.children;
        Swal.fire({
            icon: message[0].innerHTML,
            title: message[1].innerHTML,
            text: message[2].innerHTML,
            showConfirmButton: false,
            timer: 1500
        });
    }
});
