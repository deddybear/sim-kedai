$(document).ready(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#dataTable').DataTable()

    $('tbody').on('click', '.show', function() {
        Swal.fire({
            title: 'Aktivitas User',
            html: 'lorem ipsum dolor si amit'
        })
    })
})