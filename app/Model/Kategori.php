<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori';

    public function produks(){
        return $this->hasMany('App\Model\Produk','kategori','id');
    }
}
