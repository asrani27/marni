<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    protected $table = 'keranjang';
    protected $guarded = ['id'];

    public function paket()
    {
        return $this->belongsTo(Paket::class, 'paket_id');
    }
}
