$(document).ready(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#dataTable').DataTable()

    function domModal(textTitle, textConfrim, textClose) {
        $('.modal-title').html(textTitle)
        $('#btn-confrim').html(textConfrim)
        $('#btn-cancel').html(textClose)
    }

    $('#add').click(function() {
        domModal('Menambah Data Penjualan', 'Simpan', 'Batalkan')
    })

    $('tbody').on('click', '.edit', function() {
        $('#form')[0].reset()
        let id = $(this).attr('data')
        console.log(id)
        domModal('Edit Transaksi Penjualan', 'Simpan Perubahan', 'Batalkan')
        $('#modal_form').modal('show')
    });

    $('tbody').on('click', '.delete', function() { 
        let id = $(this).attr('data')
        console.log(id);
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
            if (result.isConfirmed) {
              Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
              )
            }
          })
    })
})