<div id="sidebar" class="span3">

		@php
			$total_qty = \Cart::getTotalQuantity();
			$produk_cart = \Cart::getContent();
			$subtotal = \Cart::getSubTotal();
		@endphp
		<div class="well well-small"><a id="myCart" href="product_summary.html"><img src="{{asset('bootshop/themes/images/ico-cart.png')}}" alt="cart">{{ $total_qty }} Items {{ $produk_cart->count() }} produks in your cart  <span class="badge badge-warning pull-right">Rp. {{ number_format($subtotal,2,',','.') }}</span></a></div>
		<ul id="sideManu" class="nav nav-tabs nav-stacked">
            @php
                $kategoris = \App\Model\Kategori::orderBy('nama','asc')->get();
            @endphp
            
            @foreach($kategoris as $kt)
			    <li><a href="{{ url('front/kategori/'.$kt->id)}}">{{$kt->nama}} [{{$kt->produks->count()}}]</a></li>
            @endforeach
		</ul>
		<br/>

			@php
                $randoms = \App\Model\Produk::limit(2) ->inRandomOrder()->get();
            @endphp
            
            @foreach($randoms as $rd)
				<div class="thumbnail">
				  <img src="{{asset($rd->photo)}}" alt="{{$rd->nama}}" />
				  <div class="caption">
					<h5>{{$rd->nama}}</h5>
					  <h4 style="text-align:center"><a class="btn" href="{{url('front/produk/'.$rd->id)}}"> <i class="icon-zoom-in"></i></a> <a class="btn" href="{{url('front/add-cart/'.$rd->id)}}">Add to <i class="icon-shopping-cart"></i></a> <a class="btn btn-primary" href="#">Rp. {{number_format($rd->harga)}}</a></h4>
				  </div>
				</div><br/>
            @endforeach
			<div class="thumbnail">
				<img src="{{asset('bootshop/themes/images/products/kindle.png')}}" title="Bootshop New Kindel" alt="Bootshop Kindel">
				<div class="caption">
				  <h5>Kindle</h5>
				    <h4 style="text-align:center"><a class="btn" href="product_details.html"> <i class="icon-zoom-in"></i></a> <a class="btn" href="#">Add to <i class="icon-shopping-cart"></i></a> <a class="btn btn-primary" href="#">$222.00</a></h4>
				</div>
			  </div><br/>
			<div class="thumbnail">
				<img src="{{asset('bootshop/themes/images/payment_methods.png')}}" title="Bootshop Payment Methods" alt="Payments Methods">
				<div class="caption">
				  <h5>Payment Methods</h5>
				</div>
			  </div>
	</div>