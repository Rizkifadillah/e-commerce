<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Produk;
class Kategori_controller extends Controller
{
    public function index($id){
        $latests = Produk::where('kategori',$id)->latest()->get();
        return view('beranda.kategori',compact('latests'));
    }
}
