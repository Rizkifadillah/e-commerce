<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Model\Produk;
use App\Model\Kategori;

class Produk_Controller extends Controller
{
    public function index(){
        $title = 'List Produk';
        $data = Produk::orderBy('nama','asc')->get();

        return view('admin.produk.index',compact('title','data'));
    }

    public function create(){
        $title = 'Create Produk';
        $kategori = Kategori::get();

        return view('admin.produk.create',compact('title','kategori'));
    }

    public function store(Request $request){
        $file = $request->file('photo');
        if($file){
            $nama_file =$file->getClientOriginalName();
            $file->move('produk_images',$nama_file);
            $photo = 'produk_images/'.$nama_file;
        }else{
            $photo = null;
        }

        $data = new Produk;
        $data->kategori = $request->kategori;
        $data->nama = $request->nama;
        $data->kode = $request->kode;
        $data->harga = $request->harga;
        $data->berat = $request->berat;
        $data->stock = $request->stock;
        $data->minimal_stock = $request->minimal_stock;
        $data->photo = $photo;

        $data->save();

        \Session::flash('sukses','Data Berhasil Ditambah');

        return redirect('produk');
    }

    public function edit($id){
        $title = 'Edit Produk';
        $dt = Produk::find($id);
        $kategori = Kategori::get();


        return view('admin.produk.edit',compact('title','dt','kategori'));
    }

    public function update(Request $request,$id){
        $dt = Produk::find($id);
        $file = $request->file('photo');
        if($file){
            $nama_file =$file->getClientOriginalName();
            $file->move('produk_images',$nama_file);
            $photo = 'produk_images/'.$nama_file;
        }else{
            $photo = $dt->photo;
        }

        $data = Produk::find($id);
        $data->kategori = $request->kategori;
        $data->nama = $request->nama;
        $data->kode = $request->kode;
        $data->harga = $request->harga;
        $data->berat = $request->berat;
        $data->berat = $request->berat;
        $data->stock = $request->stock;
        $data->minimal_stock = $request->minimal_stock;
        $data->photo = $photo;

        $data->update();

        \Session::flash('sukses','Data Berhasil Ditambah');

        return redirect('produk');
    }

    public function delete($id){
        try {
            Produk::where('id',$id)->delete();
        
            \Session::flash('sukses','Data berhasil di hapus');
    
        } catch(\Exception $e){
            \Session::flash('gagal', $e->getMessage());
        }
        return redirect('produk');
        
    }

    public function featured(){
        $title = 'List Featured Produk';
        $produks = Produk::get();
        $featured = Produk::where('p_unggulan',1)->get();

        return view ('admin.produk.featured',compact('title','produks','featured'));
    }

    public function featured_update(Request $request){
        $id = $request->produk;

        $cek = Produk::find($id);
        if($cek->p_unggulan == 1){
            $dt = Produk::find($id);
            $dt->p_unggulan = null;
            $dt->update();
        }else{
            $dt = Produk::find($id);
            $dt->p_unggulan = 1;
            $dt->update();
        }


        return redirect()->back()->with('sukses','data berhasil di simpan');
    }
}
