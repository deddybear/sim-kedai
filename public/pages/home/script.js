$(document).ready(function () {
    const type = ['date', 'month', 'year'];

    $('#loader-wrapper').show();

    const value = [
        moment().format('YYYY-MM-DD'),
        moment().format('MM'),
        moment().format('YYYY')
    ];

    const tagsInc = [
        $('#inc_today'),
        $('#inc_month'),
        $('#inc_year'),
    ];

    const tagsSpe = [
        $('#spe_today'),
        $('#spe_month'),
        $('#spe_year'),
    ]
        
    const MONTHS = [
        'January',
        'February',
        'March',
        'April',
        'May',
        'June',
        'July',
        'August',
        'September',
        'October',
        'November',
        'December'
    ];

    for (let i = 0; i < 3; i++) {
        $.ajax({
            url: `/income/${type[i]}/${value[i]}`,
            method: 'GET',
            dataType: 'JSON',
            success: function(data) {
                tagsInc[i].html(data.value);
            },
            error: function() {}
        });
    }

    for (let i = 0; i < 3; i++) {
        $.ajax({
            url: `/spending/${type[i]}/${value[i]}`,
            method: 'GET',
            dataType: 'JSON',
            success: function(data) {
                tagsSpe[i].html(data.value);
            },
            error: function() {}
        });
    }

    $.ajax({
        url: `/history/${moment().format('YYYY')}`,
        method: 'GET',
        dataType: 'JSON',
        success: function(data) {
            
            const chartInOut = new Chart($('#grafik'), {
                type: 'bar',
                data: {
                    labels: MONTHS,
                    datasets: [
                        {
                            label: 'Pemasukan',
                            data: data[0],
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                        },
                        {
                            label: 'Pengeluaran',
                            data: data[1],
                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                            borderColor: 'rgba(255, 99, 132, 1)',
                        }       
                    ]
                },
                options: {
                    responsive: 'true',
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        title: {
                            display: true,
                            text: 'Grafik Data Pemasukan & Pengeluaran Per Bulan'
                        }
                    }
                }
            });

           
        },
        error: function() {}
    })

    
    $('#loader-wrapper').hide();

})