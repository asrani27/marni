<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PemesananDetail extends Model
{
    protected $table = 'pemesanan_detail';
    protected $guarded = ['id'];

    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class, 'pemesanan_id');
    }

    public function paket()
    {
        return $this->belongsTo(Paket::class, 'paket_id');
    }
}
