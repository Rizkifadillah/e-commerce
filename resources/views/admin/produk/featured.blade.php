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
                </p>
            </div>
            <div class="box-body">
               
             <div class="row">
                <div class="col-md-6">
                    <form method="post" action="{{url('featured-produk')}}">
                        @csrf
                        {{method_field('PUT')}}
                        <div class="form-group">
                            <select class="form-control select2" name="produk" id="">
                                <option value="">Pilih Produk</option>
                                @foreach($produks as $pd)
                                    <option value="{{$pd->id}}">{{$pd->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-md btn-success"> Submit </button>

                    </form>
                </div>
                <div class="col-md-6">
                <table class="table">
                        <thead>
                            <tr>
                                <th>Kategori</th>
                                <th>Nama</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($featured as $ft)
                            <tr>
                                
                                <td>{{ $ft->kategoris->nama}}</td>
                                <td> {{ $ft->nama}}</td>
                                
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
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