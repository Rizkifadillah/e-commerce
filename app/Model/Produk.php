<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk';

    public function kategoris(){
        return $this->belongsTo('App\Model\Kategori','kategori','id');
    }
}
