<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>KWITANSI {{ $data->nomor_transaksi }}/{{ date('m/Y', strtotime($data->tanggal_transaksi)) }}</title>
    <style>
        html {
            margin-left: 75px;
            font-size: 10px;
            font-family: "Californian FB", AppleMyungjo;
            box-sizing: border-box;
        }
        table {
            border-collapse: collapse;
        }

        table th, table td {
            padding: 1px 5px;
        }

        table td, table td * {
            vertical-align: top;
        }
    </style>
</head>
<body>
    <div>
        <span style="font-size: 14px">
            <u><b>KWITANSI</b></u>
        </span>
        <div style="float: right; text-align: right">
        {{ $data->nomor_transaksi }}<br>
        {{ Tanggal::date($data->tanggal_transaksi) }}
        </div>
    </div>
    <div style="clear: both"></div>

    <img style="float: right; margin: 5px 0" src="data:image/png;base64, {!! $barcode !!}">

    <div style="padding: 0 60px 15px 0">
        <table>
            <tbody>
                <tr>
                    <td style="width: 90px">Uang Sebesar</td>
                    <td style="width: 10px; text-align: center">:</td>
                    <td>{{ number_format($data->total_transaksi, 2) }}</td>
                </tr>
                <tr>
                    <td>Terbilang</td>
                    <td style="width: 10px; text-align: center">:</td>
                    <td>{{ $terbilang }}</td>
                </tr>
                <tr>
                    <td>Untuk Pembayaran</td>
                    <td style="width: 10px; text-align: center">:</td>
                    <td>{{ $data->uraian }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <table border="1" width='100%' style="margin: 10px 0 20px">
        <thead>
            <tr>
                <th>Rekening</th>
                <th style="width: 80px">Debit</th>
                <th style="width: 80px">Kredit</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($list as $row)
            <tr>
                <td>{{ $row->akun->kode_akun. ' - ' .$row->akun->nama_akun }}</td>
                <td style="text-align: right">{{ number_format($row->debit, 2) }}</td>
                <td style="text-align: right">{{ number_format($row->kredit, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div style="margin-bottom: 15px">
        <table width='100%'>
            <tr>
                <td style="width: 150px">Telah dibukukan pada :<br>{{ Tanggal::date($data->created_at) }}</td>
                <td>Catatan Kwitansi :<br><span style="text-transform: uppercase">{{ $data->catatan_kwitansi }}</span></td>
            </tr>
        </table>
    </div>

    <div style="float: left; text-align: center; width: 50%; margin-right: 5%">
        <div style="margin-bottom: 40px">Dicatat Oleh</div>
        {{ $data->user->name }}
    </div>

    <div style="float: left; text-align: center; width: 50%; margin-left: 5%">
        <div style="margin-bottom: 40px">Akuntan Perusahaan</div>
        {{ $usaha->akuntan_perusahaan }}
    </div>
    {{-- <table width='100%' border="1">
        <tbody>
            <tr>
                <td style="text-align: center">Dicatat Oleh</td>
                <td style="text-align: center">Akuntan Perusahaan</td>
                <td rowspan="3" style="width: 150px; height: 300px">
                    <div style="margin-bottom: 5px">Telah dibukukan pada :<br>{{ Tanggal::date($data->tanggal_transaksi) }}</div>
                    Catatan :<br>{{ $data->catatan_kwitansi }} Lorem ipsum dolor sit amet consectetur adipisicing elit. Quod recusandae veritatis placeat nemo, odio quae nostrum voluptates vel ducimus? Odit asperiores cumque distinctio aperiam? Maxime ut temporibus eligendi odio est!
                </td>
            </tr>
            <tr>
                <td style="height: 40px"></td>
                <td></td>
            </tr>
            <tr>
                <td style="text-align: center"></td>
                <td style="text-align: center"></td>
            </tr>
        </tbody>
    </table> --}}


</body>
</html>
