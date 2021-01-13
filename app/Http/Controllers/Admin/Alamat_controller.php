<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Alamat;

class Alamat_controller extends Controller
{
    public function index(){
        $title = 'Alamat';
        $provinsi = $this->get_provinsi();

        // dd($provinsi);

        return view('admin.alamat.index',compact('title','provinsi'));
    }

    public function get_provinsi(){

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "key: b6411bdb0c8eba5d31641303858c3651"
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
        // echo "cURL Error #:" . $err;
        } else {
        // echo $response;
        }

        return json_decode( $response);
    }

    public function get_kota_ajax($provinsi){
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.rajaongkir.com/starter/city?province=$provinsi",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "key: b6411bdb0c8eba5d31641303858c3651"
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
        // echo "cURL Error #:" . $err;
        } else {
        // echo $response;
        }

        return response()->json([
            'data'=> json_decode( $response)
        ]);
    }

    public function store(Request $request){
        $data = new Alamat;
        $data->provinsi = $request->provinsi;
        $data->kota = $request->kota;
        $data->save();

        return redirect()->back()->with('sukses','Alamat berhasil di simpan');
    }
}
