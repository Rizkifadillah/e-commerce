<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Produk;
class Produk_controller extends Controller
{
    public function detail($id){
        $dt = Produk::find($id);

        return view('beranda.produk_detail',compact('dt'));
    }

    public function search(Request $request){
        $keyword = $request->keyword;
        $kategori = $request->kategori;

        if($kategori == 'all'){
            $latests = \App\Model\Produk::where('nama','like','%'.$keyword.'%')->latest()->get();
        }else{
            $latests = \App\Model\Produk::where('nama','like','%'.$keyword.'%')->where('kategori',$kategori)->latest()->get();

        }


        return view('beranda.index',compact('latests'));
    }
}
