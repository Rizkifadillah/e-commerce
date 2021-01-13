<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Produk;
use App\Model\Alamat;

class Cart_controller extends Controller
{
    public function add($id){
        $produk = Produk::find($id);

        $cek = \Cart::get($id);

        if($cek==null){
            \Cart::add([
                'id'=>$id,
                'name'=>$produk->nama,
                'price'=>$produk->harga,
                'quantity'=>1,
                'attributes'=>['berat'=>$produk->berat]
            ]);

        }else{
            $qty_now = $cek->quantity;
            $new_qty = $qty_now+1;

            \cart::update($id,['quantity'=>['relative'=>false,'value'=>$new_qty]]);
        }


        return redirect()->back()->with('pesan','Data Berhasil dimasukan kedalam keranjang');
    }

    public function detail(){
        $data = \Cart::getContent();

        $total_qty = \Cart::getTotalQuantity();
        $subtotal = \Cart::getSubTotal();
        $provinsi = $this->get_provinsi();

        $alamat=Alamat::first();
        $kota_asal = $alamat->kota;

        // dd($provinsi);

        // \Cart::add([
        //     'id'=>rand(),
        //     'name'=>$produk->nama,
        //     'price'=>$produk->harga,
        //     'quantity'=>1
        // ]);

        return view('beranda.cart',compact('data','total_qty','subtotal','provinsi','kota_asal'));
    }

    public function checkout($grand_total,$servis){
        $cart = \Cart::getContent();

        $items = [];
        foreach ($cart as $key => $vl) {
            # code...
            $a['id'] = date('YmdHis');
            $a['price'] = $vl['price'];
            $a['quantity'] = $vl['quantity'];
            $a['name'] = $vl['name'];
            $a['brand'] = 'Risk tech';
            $a['category'] = 'software';
            $a['merchant_name'] = 'LabQ';
            array_push($items,$a);
        }
        $auth_string = base64_encode('SB-Mid-server-kr7YM2jOelI3BfCDa2X1yOxf:');
        $data = [
                    "transaction_details"=> [
                    "order_id"=> rand(),
                    "gross_amount"=> $grand_total
                    ],
                    "item_details"=>$items
                ];

        $data = json_encode($data);
        $curl = curl_init();
 
        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://app.sandbox.midtrans.com/snap/v1/transactions",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $data,
        CURLOPT_HTTPHEADER => array(
            "Accept: application/json",
            "content-type: application/json",
            "Authorization: Basic ".$auth_string
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

    public function get_ongkir($asal,$tujuan,$kurir,$berat){
        
        $curl = curl_init();
 
        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "origin=$asal&destination=$tujuan&weight=$berat&courier=$kurir",
        CURLOPT_HTTPHEADER => array(
            "content-type: application/x-www-form-urlencoded",
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

    public function hapus($id){
        \Cart::remove($id);

        // $total_qty = \Cart::getTotalQuantity();
        // $subtotal = \Cart::getSubTotal();
        // dd($data);

        // \Cart::add([
        //     'id'=>rand(),
        //     'name'=>$produk->nama,
        //     'price'=>$produk->harga,
        //     'quantity'=>1
        // ]);

        return redirect()->back()->with('pesan','Data Berhasil dihapus');
    }

}
