@extends('layouts.master')

@section('content')
<ul class="thumbnails">


    @foreach($latests as $lt)
    <li class="span3" style="min-height:200px">
        <div class="thumbnail">
        <a  href="{{ url('front/produk/'.$lt->id)}}"><img  src="{{asset($lt->photo) }}" alt=""/></a>
        <div class="caption">
            <h5>{{ $lt->nama}}</h5>
            <p> 
                {{ $lt->kategoris->nama}} 
            </p>
            <h4 style="text-align:center"><a class="btn" href="product_details.html"> <i class="icon-zoom-in"></i></a> <a class="btn" href="#">Add to <i class="icon-shopping-cart"></i></a> <a class="btn btn-primary" href="#">Rp. {{ number_format($lt->harga) }}</a></h4>
        </div>
        </div>
    </li>
    @endforeach
</ul>	
@endsection