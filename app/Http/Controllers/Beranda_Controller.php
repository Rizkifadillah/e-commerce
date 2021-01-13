<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Beranda_Controller extends Controller
{
    public function index(){
        $latests = \App\Model\Produk::latest()->get();

        return view('beranda.index',compact('latests'));
    }
}
