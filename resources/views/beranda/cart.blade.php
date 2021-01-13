@extends('layouts.master')

@section('content')

    <table class="table">
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Berat</th>
                <th>Qty</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @php
                $total_berat = 0;
            @endphp

            @foreach($data as $dt)
                <tr>
                    <td>{{ $dt['name']}}</td>
                    <td>Rp. {{ number_format($dt['price'])}}</td>
                    <td>{{ $dt['attributes']['berat'] *  $dt['quantity']}}</td>
                    <td>{{ $dt['quantity']}}</td>
                    <td>
                    @php 
                        $total_berat += $dt['attributes']['berat'] *  $dt['quantity'];
                    @endphp
                        <div class="cart-hapus">
                            <a  href="{{ url('front/hapus-cart/'.$dt->id)}}">Hapus</a>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td><b><i>Total Produk</i></b></td>
                <td>
                    <b><i>Rp. {{number_format($subtotal)}}</i></b>
                </td>
                <td>
                    <b><i>{{ $total_berat}} gram</i></b>
                </td>
                <td><b><i>{{$total_qty}}</i></b></td>
            </tr>
        </tfoot>
    </table>

    <table>
        <tbody>
            <tr>
                <td>
                    <select name="provinsi" class="form-control">
                        <option value="">Pilih Provinsi</option>
                        @foreach($provinsi->rajaongkir->results as $pv)
                        <option value="{{$pv->province_id}}">{{$pv->province}}</option>
                        @endforeach
                    </select>
                </td>

                <td>
                    <select name="kota" class="form-control">
                        <option value="">Pilih Kota</option>
                    </select>
                </td>

                <td>
                    <select name="kurir" class="form-control">
                        <option value="">Pilih Kota</option>
                        <option value="jne">JNE</option>
                        <option value="tiki">TIKI</option>
                        <option value="pos">POS</option>
                       
                    </select>
                </td>

                <td>
                </td>
            </tr>
        </tbody>
    </table>
        <button class="btn btn-cek-ongkir btn-sm btn-flat btn-primary "><i class="fa fa-plus"></i> Cek Ongkir </button>

        <div class="list-ongkir">

        </div>
        
        <button class="btn btn-checkout btn-sm btn-flat btn-success " style="display:none;"><i class="fa fa-plus"></i> Checkout </button>

@endsection

@section('scripts')

    <script type="text/javascript">
        $(document).ready(function(){

            $('.btn-checkout').click(function(e){

                e.preventDefault();
                var servis = $("input[name='servis']").val();
                var url = "{{ url('front/checkout') }}"+'/'+"{{$subtotal}}"+'/'+servis;

                $.ajax({
                type:'get',
                dataType:'json',
                url:url,
                success:function(data){
                    console.log(data);      
                    window.location.href = data.data.redirect_url;
       
                }
                })
            })

            $('.btn-cek-ongkir').click(function(e){

                e.preventDefault();

                $('.list-ongkir').empty();
                var kota_asal = "{{$kota_asal}}";
                var kota_tujuan = $("select[name='kota']").val();
                var kurir = $("select[name='kurir']").val();
                var berat = "{{$total_berat}}";
                var url = "{{ url('front/cek-ongkir') }}"+'/'+kota_asal+'/'+kota_tujuan+'/'+kurir+'/'+berat;

                $.ajax({
                type:'get',
                dataType:'json',
                url:url,
                success:function(data){
                    console.log(data);      

                    var ongkir = '';
                    $.each(data.data.rajaongkir.results,function(i,v){
                        $.each(v.costs,function(a,b){
                            // ongkir += b.service +' '+b.cost[0].value;
                            ongkir += '<input type="radio" name="servis" value="'+b.service +'|'+b.cost[0].value+'">'+b.service +' '+b.cost[0].value;
                            ongkir += '<br>'
                        })
                    })   

                    $('.list-ongkir').append(ongkir);          
                    $('.btn-checkout').fadeIn();          
                }
                })
            })

            $("select[name='provinsi']").change(function(e){
                $("select[name='kota']").empty();
                var id = $(this).val();
                var url = "{{ url('front/get-kota') }}"+'/'+id;
                // alert(url);
                $.ajax({
                type:'get',
                dataType:'json',
                url:url,
                success:function(data){
                    console.log(data.data);

                    var hasil = '';
                    $.each(data.data.rajaongkir.results,function(i,v){
                    hasil += '<option value="'+v.city_id+'">';
                        hasil += v.type + ' ' + v.city_name;
                    hasil += '</option>';
                    });

                    $("select[name='kota']").append(hasil);
                }
                })
            })
        })
    </script>
@endsection


