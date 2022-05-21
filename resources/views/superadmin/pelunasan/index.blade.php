@extends('layouts.app')
@push('css')
@endpush
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Pelunasan</h3>
                <div class="pull-right box-tools">
                    {{-- <a href="/pemesanan/create" type="button" class="btn btn-primary btn-sm">
                        <i class="fa fa-plus"></i> Tambah Data</a> --}}
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">

                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tgl Pemesanan</th>
                            <th>No Transaksi</th>
                            <th>Kustomer</th>
                            <th>Detail Paket</th>
                            <th>Total</th>
                            <th>DP</th>
                            <th>Sisa</th>
                            <th>Pelunasan</th>
                            <th>Status</th>
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
                            <td>{{$item->nota}}</td>
                            <td>{{$item->pelanggan == null ? '' :$item->pelanggan->nama}}</td>
                            <td>
                                @foreach ($item->pemesanan_detail as $detail)
                                <li>{{$detail->paket == null ? '' :$detail->paket->nama}}</li>
                                @endforeach
                            </td>
                            <td>{{number_format($item->total)}}</td>
                            <td>{{number_format($item->dp)}}</td>
                            <td>{{number_format($item->sisa)}}</td>
                            <td>{{number_format($item->bayar_sisa)}}</td>
                            <td>{{$item->sisa == 0 ? 'Lunas': 'belum Lunas'}}</td>
                            <td>
                                @if ($item->sisa != 0)
                                <a href="/pelunasan/bayar/{{$item->id}}" class="btn btn-sm btn-success">Bayar</a>
                                @endif
                                <a href="/pelunasan/print/{{$item->id}}" class="btn btn-sm btn-danger"
                                    target="_blank">Nota</a>
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