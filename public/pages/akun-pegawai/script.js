$(document).ready(function () {
    moment.locale("id");
    let method;
    let id;


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    })

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

    let type = [
        'name',
        'email',
    ]

    function domModal(textTitle, textConfrim, textClose) {
        $('.modal-title').html(textTitle)
        $('#btn-confrim').html(textConfrim)
        $('#btn-cancel').html(textClose)
    }

    $(".date").datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true,
    });

    $('#dataTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/pegawai",
        columns: [
            {
                data: "DT_RowIndex",
                name: "DT_RowIndex",
                orderable: false,
                searchable: false,
            },
            { data: "name", name: "name" },
            { data: "email", name: "email" },
            { data: "email_verified_at", name: "email_verified_at" },
            { data: "created_at", name: "created_at" },
            { data: "updated_at", name: "updated_at" },
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

    $("#dataTable tfoot .search").each(function (i) {
        $(this).html(`<input 
                type="text" 
                data-type="${type[i]}" 
                class="autocomplete_f text-sm form-control" 
                placeholder="Search ${type[i].replace("_", " ").toUpperCase()}"
        />`);
    });

    $(document).on("focus", ".autocomplete_f", function () {
        let type = $(this).data("type");

        $(this).autocomplete({
            minLength: 3,
            max: 10,
            scroll: true,
            source: function (request, response) {
                $.ajax({
                    url: `/pegawai/search`,
                    dataType: "JSON",
                    data: {
                        keyword: request.term,
                        type: type,
                    },
                    beforeSend: function () {
                        $("#loader-wrapper").show();
                    },
                    complete: function () {
                        $("#loader-wrapper").hide();
                    },
                    success: function (data) {
                        console.log(data);
                        let array = [];
                        let index = 0;

                        $.map(data, function (item) {
                            array[index++] = item[type];
                        });

                        response(array);
                    },
                    error: function (err) {
                        response(["Tidak Ditemukan di Database"]);
                    },
                });
            },
        });
    });

    $("#form").on("submit", function (e) {
        e.preventDefault();

        $.ajax({
            url: '/pegawai',
            method: 'POST',
            dataType: "JSON",
            data: $("#form").serialize(),
            beforeSend: function () {
                $("#loader-wrapper").show();
            },
            complete: function () {
                $("#loader-wrapper").hide();
            },
            success: function (data) {
                
                if (data.success) {
                    Swal.fire("Sukses!", data.success, "success");
                    location.reload();
                }
            },
            error: function (response) {
                console.log(response.responseJSON.errors);
                var text = '';
            
                for (key in response.responseJSON.errors) {
                    response.responseJSON.errors[key]
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

    $('tbody').on('click', '.delete', function() { 
        let id = $(this).attr('data')
 
        Swal.fire({
            title: "Apakah kamu yakin ??",
            text: "Setelah terhapus, ini tidak bisa dikembalikan lagi!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Saya Setuju!",
            cancelButtonText: "Batalkan"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/pegawai/delete/${id}`,
                    method: 'delete',
                    dataType: 'JSON',
                    beforeSend: function () {
                        $("#loader-wrapper").show();
                    },
                    complete: function () {
                        $("#loader-wrapper").hide();
                    },
                    success: function (data) {
                        
                        Swal.fire("Deleted!", data.success, "success");
                        location.reload();
                    },
                    error: function () {
                        Swal.fire(
                            'Whoops ada Kesalahan',
                            `Error : Mohon dicoba lagi`,
                            'error'
                        )
                    }
                })
            } else {
                Swal.fire("Batal !","Opreasi penghapusan dibatalkan", "warning")
            }
        });
    })
})