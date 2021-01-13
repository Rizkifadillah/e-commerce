@extends('admin.layouts.master')
 
@section('content')
 
<div class="row">
    <div class="col-md-12">
        <h4>{{ $title }}</h4>
        <div class="box box-warning">
            <div class="box-header">
                <p>
                    <button class="btn btn-sm btn-flat btn-warning btn-refresh"><i class="fa fa-refresh"></i> Refresh</button>
                    <a href="{{ url('paket-laundry')}}" class="btn btn-sm btn-flat btn-success "><i class="fa fa-back"></i> Back</a href="{{ url('paket-laundry')}}">

                    @if ($errors->any())
                        <div class="alert alert-warning">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </p>
            </div>
            <div class="box-body">
               
            <form role="form" method="post" action="{{ url('produk/'.$dt->id)}}" enctype="multipart/form-data">
                @csrf
                {{ method_field('PUT')}}
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Pilih Kategori</label>
                  <select class="form-control select2" name="kategori" id="">

                    @foreach($kategori as $kt)
                        <option value="{{ $kt->id}}" {{ ($dt->kategori == $kt->id) ? 'selected' : ''}}>{{ $kt->nama}}</option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">Nama Kategori</label>
                  <input type="text" class="form-control" value="{{$dt->nama}}" name="nama" id="" placeholder="Nama Kategori">
                </div>

                <div class="form-group">
                  <label for="exampleInputPassword1">Kode</label>
                  <input type="number" class="form-control" value="{{$dt->kode}}" name="kode" id="" placeholder="Kode">
                </div>

                <div class="form-group">
                  <label for="exampleInputPassword1">Harga</label>
                  <input type="number" class="form-control"  value="{{$dt->harga}}" name="harga" id="" placeholder="Harga">
                </div>

                <div class="form-group">
                  <label for="exampleInputPassword1">Berat (gram)</label>
                  <input type="number" class="form-control"  value="{{$dt->berat}}" name="berat" id="" placeholder="Harga">
                </div>

                <div class="form-group">
                  <label for="exampleInputPassword1">Stock</label>
                  <input type="number" class="form-control"  value="{{$dt->stock}}" name="stock" id="" placeholder="Stock">
                </div>

                <div class="form-group">
                  <label for="exampleInputPassword1">Minimal Stock</label>
                  <input type="number" class="form-control"  value="{{$dt->minimal_stock}}" name="minimal_stock" id="" placeholder="Minimal Stock">
                </div>

                <div class="form-group">
                  <label for="exampleInputPassword1">Upload Photo</label>
                  <input type="file" name="photo" value="{{$dt->photo}}"  >
                </div>

                
              </div>
              <!-- /.box-body -->
 
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>

            </div>
        </div>
    </div>
</div>
 
@endsection
 
@section('scripts')
 
<script type="text/javascript">
    $(document).ready(function(){
 
        // btn refresh
        $('.btn-refresh').click(function(e){
            e.preventDefault();
            $('.preloader').fadeIn();
            location.reload();
        })
 
    })
</script>
 
@endsection