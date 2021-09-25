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
        },
    })

    $('tbody').on('click', '.detail', function() {
        id = $(this).attr('data');

        $.ajax({
            url: `/activity/show/${id}`,
            method: "GET",
            dataType: "JSON",
            beforeSend: function () {},
            complete: function () {},
            success: function (data) {
               // console.log(data);

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
})