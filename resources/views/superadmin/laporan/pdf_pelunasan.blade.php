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
                {{-- <td style="border: 0px;" align="right" width="30%">
                    <img src="http://evakip.pt-banjarmasin.go.id/dist/img/logo.png" width="40px" height="50px">
                </td> --}}
                <td style="border: 0px;" valign="top" align="center" width="100%">
                    <span style="font-size: 18px;"><strong>Weeding Organizer Bunga Marni</strong></span><br />
                </td>
            </tr>
        </table>
        <hr>
        <p><span class="auto-style1"><strong>LAPORAN DATA PELUNASAN </strong></span></p>
    </header>
    <footer>
        <hr>
        <p>Tanggal Cetak : {{\Carbon\Carbon::now()->format('d-m-Y H:i:s')}}
        </p>
    </footer>
    <br />
    <main>
        <table cellpadding="5" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tgl Pemesanan</th>
                    <th>Tgl Acara</th>
                    <th>Tgl Pelunasan</th>
                    <th>NOTA</th>
                    <th>Nama</th>
                    <th>Detail Paket</th>
                    <th>Total</th>
                    <th>DP</th>
                    <th>Sisa</th>
                    <th>Bayar Sisa</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @php
                $no = 1;
                @endphp
                @foreach ($data as $item)
                <tr>
                    <td>{{$no++}}</td>
                    <td>{{\Carbon\Carbon::parse($item->tgl_pemesanan)->translatedFormat('d F Y')}}</td>
                    <td>{{\Carbon\Carbon::parse($item->tgl_acara)->translatedFormat('d F Y')}}</td>
                    <td>{{\Carbon\Carbon::parse($item->tgl_pelunasan)->translatedFormat('d F Y')}}</td>
                    <td>{{$item->nota}}</td>
                    <td>{{$item->pelanggan == null ? '': $item->pelanggan->nama}}</td>
                    <td>
                        @foreach ($item->pemesanan_detail as $detail)
                        <li>{{$detail->paket == null ? '' : $detail->paket->nama}}, {{number_format($detail->harga)}}
                        </li>
                        @endforeach
                    </td>
                    <td>{{number_format($item->total)}}</td>
                    <td>{{number_format($item->dp)}}</td>
                    <td>{{number_format($item->sisa)}}</td>
                    <td>{{number_format($item->bayar_sisa)}}</td>
                    <td>{{$item->sisa == 0 ? 'LUNAS':'BELUM LUNAS'}}</td>
                </tr>
                @endforeach

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