$(document).ready(function() {

    let open = {
        panelNama     : false,
        panelPassword : false,
        panelEmail    : false
    }

    let pesan = {
        panelNama     : false,
        panelUsername : false,
        panelEmail    : false
    }
    
    $('#panelNama').click(function () {
        let name = "<span class='txt-prepend strong'>Nama : </span>";
        
        if (!open.panelNama) {
            $('#setting-nama').show('slow', function () {
                if (!pesan.panelNama) {
                    $('.text_panelNama').prepend(name)
                    pesan.panelNama  = true;
                }
                open.panelNama = true;
            })
        } 
    })
    
    $('.list-group-item').on('click', '#cancelPanelNama', function(){
        if (open.panelNama) {
            $('#setting-nama').hide('slow', function(){
                $('span.text_panelNama').find('span.txt-prepend').remove()
                open.panelNama = false;
                pesan.panelNama = false;
            })
        }
        
    })

    $('#panelPassword').click(function () {

        if (!open.panelPassword) {
            $('#setting-password').show('slow', function() {
                $('.text_panelUsername').prepend(name)
                open.panelPassword = true;
            })
        }

    });

    $('.list-group-item').on('click', '#cancelPanelPassword', function () {
        if (open.panelPassword) {
            $('#setting-password').hide('slow', function() {
                $('span.text_panelUsername').find('span.txt-prepend').remove()
                open.panelPassword = false;
            })
        }
    })

    $('#panelEmail').click(function () {
        let name = "<span class='txt-prepend strong'>Email : </span>";

        if (!open.panelEmail) {
            $('#setting-email').show('slow', function() {
                if (!pesan.panelEmail) {
                    $('.text_panelEmail').prepend(name)
                    pesan.panelEmail = true;
                }
                open.panelEmail = true;
            })
        }

    });

    $('.list-group-item').on('click', '#cancelPanelEmail', function () {
        if (open.panelEmail) {
            $('#setting-email').hide('slow', function() {
                $('span.text_panelEmail').find('span.txt-prepend').remove()
                open.panelEmail = false;
                pesan.panelEmail = false;
            })
        }
    })

    $('#loader-wrapper').hide();
})