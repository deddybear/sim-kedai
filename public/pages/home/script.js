$(document).ready(function () {
    const COLORS = [
        'rgb(255, 99, 132)',
        'rgb(255, 159, 64)',
        'rgb(255, 205, 86)',
        'rgb(75, 192, 192)',
        'rgb(54, 162, 235)',
        'rgb(153, 102, 255)',
        'rgb(201, 203, 207)'
    ];
    
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
    
    function months(config) {
    
        var cfg = config || {};
        var count = cfg.count || 12;
        var section = cfg.section;
        var values = [];
        var i, value;
      
        for (i = 0; i < count; ++i) {
          value = MONTHS[Math.ceil(i) % 12];
          values.push(value.substring(0, section));
        }
      
        return values;
    }
    
    const chartInOut = new Chart($('#grafik'), {
        type: 'bar',
        data: {
            labels: months({count: 12}),
            datasets: [
                {
                    label: 'Pengeluaran',
                    data: numbers({count: 12, min: 1000, max: 100000}),
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                },
                {
                    label: 'Pemasukan',
                    data: numbers({count: 12, min: 1000, max: 100000}),
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
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
})