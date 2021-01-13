<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Kategori;

class Kategori_controller extends Controller
{
    public function index(){
        $title = 'List Kategori';
        $data = Kategori::orderBy('nama','asc')->get();

        return view('admin.kategori.index',compact('title','data'));
    }

    public function create(){
        $title = 'Create Kategori';
        $kode = rand();

        return view('admin.kategori.create',compact('title','kode'));
    }

    public function store(Request $request){
        $data = new Kategori;
        $data->nama = $request->nama;
        $data->kode = $request->kode;
        $data->save();

        \Session::flash('sukses','Data Berhasil Ditambah');

        return redirect('produk');
    }

    public function edit($id){
        $title = ' Edit Kategori';
        $dt = Kategori::find($id);

        return view('admin.kategori.edit',compact('title','dt'));

    }

    public function update(Request $request,$id){
        $data = Kategori::find($id);
        $data->nama = $request->nama;
        $data->kode = $request->kode;
        $data->update();

        \Session::flash('sukses','Data Berhasil Ditambah');

        return redirect('kategori');
    }

    public function delete($id){
        try {
            Kategori::where('id',$id)->delete();
        
            \Session::flash('sukses','Data berhasil di hapus');
    
        } catch(\Exception $e){
            \Session::flash('gagal', $e->getMessage());
        }
        return redirect('kategori');
        
    }
}
