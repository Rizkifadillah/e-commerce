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
             
            <form role="form" method="post" action="{{ url('alamat')}}">
                @csrf
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Pilih Provinsi</label>
                  <select class="form-control select2" name="provinsi" >
                  <option value="">Pilih Provinsi</option>
                    @foreach($provinsi->rajaongkir->results as $pr)
                        <option value="{{ $pr->province_id}}">{{ $pr->province}}</option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group">
                  <label for="exampleInputPassword1">Kota</label>
                  <select name="kota" class="form-control">
                  
                  </select>
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
      
      $("select[name='provinsi']").change(function(e){
        $("select[name='kota']").empty();
        var id = $(this).val();
        var url = "{{ url('alamat/get-kota') }}"+'/'+id;

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

        // btn refresh
        $('.btn-refresh').click(function(e){
            e.preventDefault();
            $('.preloader').fadeIn();
            location.reload();
        })
 
    })
</script>
 
@endsection