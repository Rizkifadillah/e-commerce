@extends('admin.layouts.master')
 
@section('content')
 
<div class="row">
    <div class="col-md-12">
        <h4>{{ $title }}</h4>
        <div class="box box-warning">
            <div class="box-header">
                <p>
                    <button class="btn btn-sm btn-flat btn-warning btn-refresh"><i class="fa fa-refresh"></i> Refresh</button>
                    <a href="{{ url('produk/add')}}" class="btn btn-sm btn-flat btn-primary "><i class="fa fa-plus"></i> Tambah</a>
                    <a href="{{ url('featured-produk')}}" class="btn btn-sm btn-flat btn-success "><i class="fa fa-check-circle"></i> Featured</a>
                </p>
            </div>
            <div class="box-body">
               
               <div class="table-responsive">
                    <table class="table table-hover myTable">
                        <thead>
                            <tr>
                            <th>Action</th>
                            <th>Kategori</th>
                                <th>Nama</th>
                                <th>Photo</th>
                                <th>Kode</th>
                                <th>Harga</th>
                                <th>Berat</th>
                                <th>Stock</th>
                                <th>Minimal Stock</th>
                                <th>Create_at</th>
                                <th>Update_at</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $dt)
                            <tr>
                                <td>
                                <div style="width:60px">
                                    <a href="{{ url('produk/'.$dt->id)}}" id-supplier="'.$id.'" class="btn btn-warning btn-xs btn-edit" id="edit"><i class="fa fa-pencil-square-o"></i></a>
                                    <button href="{{ url('produk/'.$dt->id)}}" class="btn btn-danger btn-hapus btn-xs" id="delete"><i class="fa fa-trash-o"></i></button></div>
                                </td>
                                <td>{{ $dt->kategoris->nama}}</td>
                                <td> {{ $dt->nama}}</td>
                                <td>
                                    @if($dt->photo)
                                    <img src="{{$dt->photo}}" style="width: 100px; height:100px" alt="">
                                    @else
                                    <div style="width: 100px; height:100px">
                                        <span class="info-box-icon bg-grey"><i class="fa fa-image"></i></span>
                                    </div>                                    
                                    @endif
                                </td>
                                <td> {{ $dt->kode}}</td>
                                <td>Rp. {{ number_format($dt->harga)}}</td>
                                <td> {{ $dt->berat}} gram</td>
                                <td> {{ $dt->stock}}</td>
                                <td> {{ $dt->minimal_stock}}</td>
                                <td> {{ $dt->created_at}}</td>
                                <td> {{ $dt->updated_at}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
               </div>

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