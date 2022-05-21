@extends('layouts.app')
@push('css')
@endpush
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Pemesanan</h3>
                <div class="pull-right box-tools">
                    <a href="/pemesanan/create" type="button" class="btn btn-primary btn-sm">
                        <i class="fa fa-plus"></i> Tambah Data</a>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">

                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tgl Pemesanan</th>
                            <th>Tgl Acara</th>
                            <th>Tgl Pelunasan</th>
                            <th>No Transaksi</th>
                            <th>Kustomer</th>
                            <th>Detail Paket</th>
                            <th>Total</th>
                            <th>DP</th>
                            <th>Sisa</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $no=1;
                        @endphp
                        @foreach ($data as $item)
                        <tr>
                            <td>{{$no++}}</td>
                            <td>{{\Carbon\Carbon::parse($item->tgl_pemesanan)->format('d-m-Y')}}</td>
                            <td>{{\Carbon\Carbon::parse($item->tgl_acara)->format('d-m-Y')}}</td>
                            <td>{{\Carbon\Carbon::parse($item->tgl_pelunasan)->format('d-m-Y')}}</td>
                            <td>{{$item->nota}}</td>
                            <td>{{$item->pelanggan == null ? '' :$item->pelanggan->nama}}</td>
                            <td>
                                @foreach ($item->pemesanan_detail as $detail)
                                <li>{{$detail->paket == null ? '' :$detail->paket->nama}}</li>
                                @endforeach
                            </td>
                            <td>{{number_format($item->total)}}</td>
                            <td>{{number_format($item->dp)}}</td>
                            <td>{{number_format($item->total - $item->dp)}}</td>
                            <td>
                                <a href="/pemesanan/print/{{$item->id}}" class="btn btn-sm btn-danger"
                                    target="_blank">Nota</a>
                                <a href="/pemesanan/delete/{{$item->id}}" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Yakin ingin di hapus?');">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')

@endpush