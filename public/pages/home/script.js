$(document).ready(function () {
    const type = ['date', 'month', 'year'];

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
            beforeSend: function() {},
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
            beforeSend: function() {},
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
        beforeSend: function() {},
        success: function(data) {
            console.log(data);
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
    
    var _seed = Date.now();
    
    function srand(seed) {
      _seed = seed;
    }
    
    function rand(min, max) {
        min = valueOrDefault(min, 0);
        max = valueOrDefault(max, 0);
        _seed = (_seed * 9301 + 49297) % 233280;
        return min + (_seed / 233280) * (max - min);
    }
    
    function valueOrDefault(value, defaultValue) {
        return typeof value === 'undefined' ? defaultValue : value;
    }
    
    function numbers(config) {
        var cfg = config || {};
        var min = valueOrDefault(cfg.min, 0);
        var max = valueOrDefault(cfg.max, 100);
        var from = valueOrDefault(cfg.from, []);
        var count = valueOrDefault(cfg.count, 8);
        var decimals = valueOrDefault(cfg.decimals, 8);
        var continuity = valueOrDefault(cfg.continuity, 1);
        var dfactor = Math.pow(10, decimals) || 0;
        var data = [];
        var i, value;
      
        for (i = 0; i < count; ++i) {
          value = (from[i] || 0) + rand(min, max);
          if (rand() <= continuity) {
            data.push(Math.round(dfactor * value) / dfactor);
          } else {
            data.push(null);
          }
        }

        return data;
    }
    


})