$(document).ready(function () {

    let id;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(".date").datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true,
    });

    $('#tanggal').datetimepicker({
        viewMode: 'days',
        minViewMode: 'days',
        format: 'DD'
    });

    $('#bulan').datetimepicker({
        viewMode: 'months',
        minViewMode: 'months',
        format: 'MM'
    });

    $('#tahun').datetimepicker({
        viewMode: 'years',
        format: 'YYYY'
    });

    let message = messageErrors => {
        var temp = '';
        if (messageErrors instanceof Array) {
                messageErrors.forEach(element => {
                    temp += `${element} <br>`
                });
                return temp;
        } else {
            return messageErrors ? `${messageErrors} <br>` : ' '
        }
       
    }

    $('#dataTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/activity/",
        columns: [
            {data: "created_at", name: "created_at"},
            {data: "activity", name: "activity"},
            {data: "user_id", name: "user_id"},
            {
                data: "Actions",
                name: "Actions",
                orderable: false,
                serachable: false,
                sClass: "text-center",
            },
        ],
        initComplete: function () {
            this.api()
                .columns()
                .every(function () {
                    var that = this;
                    $("input", this.footer()).on(
                        "keyup change clear",
                        function () {
                            if (that.search() !== this.value) {
                                that.search(this.value).draw();
                            }
                        }
                    );
                });

            $('#loader-wrapper').hide();
        },
    })

    $('tbody').on('click', '.detail', function() {
        id = $(this).attr('data');

        $.ajax({
            url: `/activity/show/${id}`,
            method: "GET",
            dataType: "JSON",
            beforeSend : function () {
                $('#loader-wrapper').show();
            },
            complete: function() {
                $('#loader-wrapper').hide();
            },
            success: function (data) {
 

                Swal.fire({
                    icon: 'info',
                    title: 'Detail Aktivitas User',
                    html: `
                        <b> Deskripsi : </b> ${data.activity} <br>
                        <b> Waktu Aksi :</b> ${moment(data.created_at).format('YYYY-DD-MM hh:mm:ss')} <br>
                        <b> Aktivitas dari :</b> ${data.user[0].name} <br>
                    `,
                    showCloseButton: true,
                })
            },
            error: function (err) {
                var text = '';
            
                for (key in response.responseJSON.errors) {
                    text += message(response.responseJSON.errors[key]);                    
                }
                
                Swal.fire(
                    'Whoops ada Kesalahan',
                    `Error : <br> ${text}`,
                    'error'
                )
            },
        })

    })

    $('#form').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            url: '/activity/delete',
            method: 'DELETE',
            dataType: 'JSON',
            data: $('#form').serialize(),
            beforeSend : function () {
                $('#loader-wrapper').show();
            },
            complete: function() {
                $('#loader-wrapper').hide();
            },
            success: function (data) {
                if (data.success) {
                    Swal.fire("Sukses!", data.success, "success");
                    location.reload();
                } else {
                    Swal.fire("Peringatan!", data.info, "warning");
                }
                
            },
            error: function (response) {
                console.log(response);

                var text = '';
            
                for (key in response.responseJSON.errors) {
                    text += message(response.responseJSON.errors[key]);                    
                }
                
                Swal.fire(
                    'Whoops ada Kesalahan',
                    `Error : <br> ${text}`,
                    'error'
                )
            }
        })
    })
})