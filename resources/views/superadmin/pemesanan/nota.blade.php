<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta content="en-us" http-equiv="Content-Language" />
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>Untitled 1</title>
    {{-- <style type="text/css">
        .auto-style1 {
            font-family: Arial, Helvetica, sans-serif;
            font-size: x-small;
        }
    </style> --}}
    <style>
        @page {
            margin-top: 80px;
            margin-left: 50px;
        }

        header {
            position: fixed;
            top: -60px;
            left: 0px;
            right: 0px;
            height: 0px;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
            /** Extra personal styles **/
            /* background-color: #03a9f4;
            color: white;
            text-align: center; 
            line-height: 35px;*/
        }

        tr,
        th,
            {
            border: 2px solid #000;
            font-size: 10px;
            font-family: Arial, Helvetica, sans-serif;
        }

        td {
            font-weight: bold;
            border: 2px solid #000;
            font-size: 10px;
        }

        footer {
            position: fixed;
            bottom: -60px;
            left: 0px;
            right: 0px;
            height: 50px;
            font-size: 8px;
            font-family: Arial, Helvetica, sans-serif;
            /** Extra personal styles **/
            /* background-color: #03a9f4;
            color: white;
            text-align: center;
            line-height: 35px; */
        }
    </style>
</head>

<body>
    <header>
        <table border="0" width="100%">
            <tr>
                <td style="border: 0px;" colspan="4" valign="top" align="center" width="100%">
                    <span style="font-size: 18px;"><strong>NOTA INVOICE PELANGGAN</strong></span><br /><br />
                </td>
            </tr>
            <tr style="border: 0px;">
                <td style="border: 0px;" width="15%">Tanggal Pemesanan</td>
                <td style="border: 0px;" width="55%">:
                    {{\Carbon\Carbon::parse($data->tgl_pemesanan)->translatedFormat('d F Y')}}</td>
                <td style="border: 0px;" width="10%">No. Transaksi</td>
                <td style="border: 0px;">: {{$data->nota}}</td>
            </tr>
            <tr style="border: 0px;">
                <td style="border: 0px;" width="15%">Tanggal Acara</td>
                <td style="border: 0px;" width="55%">:
                    {{\Carbon\Carbon::parse($data->tgl_acara)->translatedFormat('d F Y')}}</td>
                <td style="border: 0px;">Pelanggan</td>
                <td style="border: 0px;">: {{$data->pelanggan == null ? '' : $data->pelanggan->nama}}</td>
            </tr>
            <tr style="border: 0px;">
                <td style="border: 0px;" width="15%">Tanggal pelunasan</td>
                <td style="border: 0px;" width="55%">:
                    {{\Carbon\Carbon::parse($data->tgl_pelunasan)->translatedFormat('d F Y')}}</td>
                <td style="border: 0px;"></td>
                <td style="border: 0px;"> </td>
            </tr>
        </table>
        <hr>
        {{-- <p><span class="auto-style1"><strong>LAPORAN DATA SISWA </strong></span></p> --}}
    </header>
    <footer>
        <hr>
        <p>Tanggal Cetak : {{\Carbon\Carbon::now()->format('d-m-Y H:i:s')}}
        </p>
    </footer>
    <br />
    <br />
    <br />
    <main>
        <table cellpadding="5" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Paket</th>
                    <th>Harga</th>
                </tr>
            </thead>
            <tbody>
                @php
                $no = 1;
                @endphp
                @foreach ($data->pemesanan_detail as $item)
                <tr>
                    <td style="text-align: center">{{$no++}}</td>
                    <td>{{$item->paket->nama}}</td>
                    <td>{{number_format($item->harga)}}</td>

                </tr>
                @endforeach
                <tr>
                    <td rowspan=3></td>
                    <td>Total</td>
                    <td>{{number_format($data->total)}}</td>
                </tr>
                <tr>
                    <td>DP</td>
                    <td>{{number_format($data->dp)}}</td>
                </tr>
                <tr>
                    <td>Sisa</td>
                    <td>{{number_format($data->total - $data->dp)}}</td>
                </tr>
            </tbody>
        </table>
        <br />
        <table width="100%" border="0">
            <tr style="border: 0px;">
                <td width="70%" style="border: 0px;"></td>
                <td width="30%" style="border: 0px;">
                    Banjarmasin, {{\Carbon\Carbon::now()->translatedFormat('d F Y')}}<br />
                    Admin WO Bunga Marni,
                    <br />
                    <br />
                    <br />
                    <br />
                    (.............................)



                </td>
            </tr>
        </table>

    </main>
</body>

</html>