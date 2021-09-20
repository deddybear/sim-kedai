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
        'category',
        'name_product',
        'unit'
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
        ajax: "/transaksi/pembelian",
        columns: [
            {
                data: "DT_RowIndex",
                name: "DT_RowIndex",
                orderable: false,
                searchable: false,
            },
            { data: "category", name: "category" },
            { data: "description", name: "description" },
            { data: "amount", name: "amount" },
            {
                data: function (row) {
                    return idrFormatter.format(row.nominal);
                },
                name: "nominal",
            },
            {
                data: function (row) {
                    return idrFormatter.format(row.total);
                },
                name: "total",
            },
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
        console.log(type);
        $(this).autocomplete({
            minLength: 3,
            max: 10,
            scroll: true,
            source: function (request, response) {
                $.ajax({
                    url: `/transaksi/pembelian/search`,
                    dataType: "JSON",
                    data: {
                        keyword: request.term,
                        type: type,
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

    $('#add').click(function() {
        $("#form")[0].reset();
        domModal('Menambah Data Pembelian', 'Simpan', 'Batalkan')
        method = "POST";

    })

    $('tbody').on('click', '.edit', function() {
        method = "PUT";
        $('#form')[0].reset()
        id = $(this).attr('data')
        domModal('Edit Transaksi Pembelian', 'Simpan Perubahan', 'Batalkan')
        $('#modal_form').modal('show')
    });

    $("tbody").on("click", ".detail", function () {
        id = $(this).attr("data");
        
        $.ajax({
            url: `/transaksi/pembelian/show/${id}`,
            method: "GET",
            dataType: "JSON",
            beforeSend: function () {},
            complete: function () {},
            success: function (data) {
                // console.log(data);

                Swal.fire({
                    icon: 'info',
                    title: 'Informasi Mengenai Produk',
                    html:`
                         <b> Deskripsi :</b> ${data.description} <br>
                         <b> Kategori :</b> ${data.category} <br>
                         <b> Jumlah :</b> ${data.amount} ${data.unit} <br>
                         <b> Harga Satuan :</b> ${idrFormatter.format(data.nominal)} <br>
                         <b> Total :</b> ${idrFormatter.format(data.total)} <br>
                         <b> Created By :</b> ${data.created_by[0].name} <br>
                         <b> Updated By :</b> ${data.updated_by[0].name} <br>
                         <b> Created At :</b> ${moment(data.created_at).format('YYYY-DD-MM hh:mm:ss')} <br>
                         <b> Updated At :</b> ${moment(data.updated_at).format('YYYY-DD-MM hh:mm:ss')}`,
                    showCloseButton: true,
                });
            },
            error: function (err) {},
        });
    });

    $("#form").on("submit", function (e) {
        e.preventDefault();
        var url;

        console.log(`submit ${method}`);
        if (method == "POST") {
            url = "/transaksi/pembelian";
        } else if (method == "PUT") {
            url = `/transaksi/pembelian/update/${id}`;
        }

        $.ajax({
            url: url,
            method: method,
            dataType: "JSON",
            data: $("#form").serialize(),
            beforeSend: function () {},
            complete: function () {},
            success: function (data) {
                console.log(data);
                if (data.success) {
                    Swal.fire("Sukses!", data.success, "success");
                    location.reload();
                }
            },
            error: function (response) {
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
        });
    });

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
                    url: `/transaksi/pembelian/delete/${id}`,
                    method: 'DELETE',
                    dataType: 'JSON',
                    beforeSend: function () {},
                    complete: function () {},
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