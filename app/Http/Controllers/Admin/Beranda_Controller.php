<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Beranda_Controller extends Controller
{
    public function index(){
        $title = 'Beranda Admin';

        return view('admin.beranda.index',compact('title'));
    }
}
