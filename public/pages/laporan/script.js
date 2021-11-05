$(document).ready(function() {
    $('#datetimepicker1').datetimepicker({
        viewMode: 'months',
        minViewMode: 'months',
        format: 'MM'
    });

    $('#datetimepicker').datetimepicker({
        viewMode: 'years',
        format: 'YYYY'
    });

    $('#loader-wrapper').hide();
})