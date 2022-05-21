@extends('layouts.app')
@push('css')

@endpush
@section('content')
<div class="row">
    <form role="form" method="post" action="/pemesanan/create">
        @csrf
        <div class="col-md-3">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Info Transaksi</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->

                <div class="box-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nota</label>
                        <input type="text" name="nota" class="form-control" value="{{$kode}}" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tgl Pemesanan</label>
                        <input type="date" name="tgl_pemesanan" class="form-control"
                            value="{{\Carbon\Carbon::now()->format('Y-m-d')}}" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tgl Acara</label>
                        <input type="date" name="tgl_acara" class="form-control"
                            value="{{\Carbon\Carbon::now()->addDays(7)->format('Y-m-d')}}" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tgl Pelunasan</label>
                        <input type="date" name="tgl_pelunasan" class="form-control"
                            value="{{\Carbon\Carbon::now()->addDays(7)->format('Y-m-d')}}" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Pelanggan</label>
                        <select name="pelanggan_id" class="form-control form-control-sm">
                            <option value="">-pilih-</option>
                            @foreach ($pelanggan as $item)
                            <option value="{{$item->id}}" {{old('pelanggan_id')==$item->id ?
                                'selected':''}}>{{$item->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
        <div class="col-md-9">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Data Pemesanan</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->

                <div class="box-body">
                    <div class="form-group">
                        <select name="paket_id" class="form-control form-control-sm">
                            <option value="">-Pilih Paket-</option>
                            @foreach ($paket as $item)
                            <option value="{{$item->id}}">{{$item->nama}}, Rp. {{number_format($item->harga)}}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-block btn-primary" name="button" value="keranjang">+
                        Keranjang</button><br />
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Paket</th>
                                <th>Harga</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($keranjang as $key => $item)
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td>{{$item->paket == null ? '' :$item->paket->nama}}</td>
                                <td>Rp. {{number_format($item->harga)}}</td>
                                <td><a href="/keranjang/delete/{{$item->id}}"
                                        onclick="return confirm('Yakin ingin dihapus?');"><i
                                            class="fa fa-trash text-danger"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td></td>
                                <td>Total</td>
                                <td>Rp. {{number_format($keranjang->sum('harga'))}}</td>
                                <td>
                                    <input type="hidden" name="total" value="{{$keranjang->sum('harga')}}">
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                    <tr>
                        <td></td>
                        <td>DP/Uang Muka</td>
                        <td><input type="text" class="form-control" name="dp" value="{{old('dp')}}"
                                onkeypress="return hanyaAngka(event)"></td>
                        <td></td>
                    </tr>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary" name="button" value="checkout">Checkout</button>
                    <a href="/pemesanan/batal" onclick="return confirm('Yakin ingin dibatalkan?');"
                        class="btn btn-danger">Batal</a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('js')


@endpush