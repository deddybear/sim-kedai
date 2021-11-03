<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Penjualan</title>

    <style>
        * {
            font-family: Verdana, Arial, sans-serif;
        }

        body {
            font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol";
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            
        }

        table {
            border-collapse: collapse;
            border-spacing: 0;
            border: 1px solid #ddd;
            width: 100%;
            max-width: 100%;
            margin-bottom: 1rem;
            background-color: transparent;
            font-size: x-small;
        }

        tr:nth-child(even) {
            background-color: rgba(0,0,0,.075);
        }


        th, td {
            text-align: left;
            border: 1px solid #dddddd;
            padding-left: 16px;
            padding-right: 16px;
        }

        .my-1 {
            margin-top: 0.25rem !important;
            margin-bottom: 0.25rem !important;
        }

        .my-2 {
            margin-top: 0.5rem !important;
            margin-bottom: 0.5rem !important;
        }

        .my-3 {
            margin-top: 1rem !important;
            margin-bottom: 1rem !important;
        }

        .my-4 {
            margin-top: 1.5rem !important;
            margin-bottom: 1.5rem !important;    
        }

        .my-5 {
            margin-top: 3rem !important;
            margin-bottom: 3rem !important;
        }

        .mx-0 {
            margin-left: 0 !important;
            margin-right: 0 !important; 
        }

        .mx-1 {
            margin-left: 0.25rem !important;
            margin-right: 0.25rem !important;
        }

        .mx-2 {
            margin-left: 0.5rem !important;
            margin-right: 0.5rem !important;
        }

        .mx-3 {
            margin-left: 1rem !important;
            margin-right: 1rem !important;
        }

        .mx-4 {
            margin-left: 1.5rem !important;
            margin-right: 1.5rem !important;
        }

        .mx-5 {
            margin-left: 3rem !important;
            margin-right: 3rem !important;
        }

        .mx-auto {
            margin-left: auto !important;
            margin-right: auto !important;
        }

        .container {
            width: 100%;
            padding: 30px;
            margin-right: auto;
            margin-left: auto;
        }

        .underline {
            text-decoration: underline;
        }

        .border-solid {
            border: 1px solid #343a40;
        }

        .text-center {
            text-align: center;
        }

        .text-justify {
            text-align: justify;
        }

        .text-bold {
            font-weight: bold;
        }

        .income {
            float: right !important;
            padding-left: 16px;
            padding-right: 16px;
            font-size: x-small;
        }

        .information {
            background-color: #60A7A6;
            color: #FFF;
        }

        .information .logo {
            margin: 5px;
        }

        .information table {
            padding: 10px;
            border: none !important;
        }

        .information td {
            border: none !important;
        }

        @media (min-width: 576px) {
            .container, .container-sm {
              max-width: 540px;
            }
        }

        @media (min-width: 768px) {
          .container, .container-sm, .container-md {
            max-width: 720px;
          }
        }

        @media (min-width: 992px) {
          .container, .container-sm, .container-md, .container-lg {
            max-width: 960px;
          }
        }

        @media (min-width: 1200px) {
          .container, .container-sm, .container-md, .container-lg, .container-xl {
            max-width: 1140px;
          }
        }
    </style>
</head>
<body>
    <div class="information">
        <table width="100%">
            <tr>
                <td align="left" style="width: 40%">
                    <h3>CompanyName</h3>
                    <p> https://company.com</p>
                    <p>
                       
    
                        Street 26
                        123456 City
                        United Kingdom
                    </p>
                </td>
                <td align="center" style="width: 50%">
                    <h1>Laporan Bulanan</h1>
                </td>
                <td align="right" style="width: 20%">
                    <h3>Logo Kedai</h3>
                </td>
            </tr>
        </table>
    </div>

    <div class="container">
        
        
        <div class="my-5">
            
        </div>

        <div class="my-4">
            <p class="text-bold">Laporan Pemasukan</p>
            <table class="table">
                <thead>
                    <tr>
                        <th>Tanggal & Waktu</th>
                        <th>Nama</th>
                        <th>Jumlah</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($incomes as $income)
                        <tr>
                            <td>{{ $income->created_at }}</td>
                            <td>{{ $income->name_product }}</td>
                            <td>{{ $income->amount }}</td>
                            <td>Rp. {{ number_format($income->total, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="my-5">
            <p class="text-bold">Laporan Pengeluaran</p>
            <table class="table">
                <thead>
                    <tr>
                        <th>Tanggal & Waktu</th>
                        <th>Nama</th>
                        <th>Jumlah</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($exps as $exp)
                        <tr>
                            <td>{{ $exp->created_at }}</td>
                            <td>{{ $exp->description }}</td>
                            <td>{{ $exp->amount ." ".$exp->unit }}</td>
                            <td>Rp. {{ number_format($exp->total, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="income border-solid">
            <p style="margin-block-start: .2em; margin-block-end: .2em">Pemasukan : Rp. {{ number_format($total_income, 0, ',', '.') }}</p>
            <p style="margin-block-start: .2em; margin-block-end: .2em">Pengeluaran : Rp. {{ number_format($total_exp, 0, ',', '.') }}</p>
            <p style="margin-block-start: .2em; margin-block-end: .2em">Total : Rp. {{ number_format($total_income - $total_exp, 0, ',', '.') }}</p>
        </div>

    </div>
</body>
</html>