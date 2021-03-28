<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>KWITANSI</title>
    <style>
        html {
            font-size: 11px;
            font-family: "Californian FB", AppleMyungjo;
            box-sizing: border-box;
        }
        table {
            border-collapse: collapse;
        }
    </style>
</head>
<body>
    <div>
        <span style="font-size: 16px">
            <u><b>KWITANSI</b></u>
        </span>
        <div style="float: right; text-align: right">
        {{ $data->nomor_transaksi }}<br>
        {{ Tanggal::date($data->tanggal_transaksi) }}
        </div>
    </div>
    <div style="clear: both"></div>

    <div style="padding: 15px 0">
        <table>
            <tbody>
                <tr>
                    <td>Uang Sebesar</td>
                    <td style="width: 20px; text-align: center">:</td>
                    <td>{{ number_format($data->total_transaksi, 2) }}</td>
                </tr>
                <tr>
                    <td>Terbilang</td>
                    <td style="width: 20px; text-align: center">:</td>
                    <td>{{ $terbilang }}</td>
                </tr>
                <tr>
                    <td>Untuk Pembayaran</td>
                    <td style="width: 20px; text-align: center">:</td>
                    <td>{{ $data->uraian }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <table border="1" width='100%'>
        <thead>
            <tr>
                <th>Rekening</th>
                <th>Debit</th>
                <th>Kredit</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td></td>
            </tr>
        </tbody>
    </table>
</body>
</html>
