<div id="header">
<div class="container">
<div id="welcomeLine" class="row">
	<div class="span6">Welcome!<strong> User</strong></div>
	<div class="span6">
	<div class="pull-right">
		<a href="product_summary.html"><span class="">Rp.</span></a>
		<!-- <a href="product_summary.html"><span>&pound;</span></a> -->
		@php
			$subtotal = \Cart::getSubTotal();
		@endphp
		<span class="btn btn-mini">{{ number_format($subtotal,2,',','.') }}</span>
		<!-- <a href="product_summary.html"><span class="">$</span></a> -->
		@php
			$total_qty = \Cart::getTotalQuantity();
			$produk_cart = \Cart::getContent();
		@endphp
		<a href="{{url('front/detail-cart')}}"><span class="btn btn-mini btn-primary"><i class="icon-shopping-cart icon-white"></i> [ {{ $total_qty }} ] Itemes [ {{ $produk_cart->count() }} ] Produk in your cart </span> </a> 
	</div>
	</div>
</div>
<!-- Navbar ================================================== -->
<div id="logoArea" class="navbar">
<a id="smallScreen" data-target="#topMenu" data-toggle="collapse" class="btn btn-navbar">
	<span class="icon-bar"></span>
	<span class="icon-bar"></span>
	<span class="icon-bar"></span>
</a>
  <div class="navbar-inner">
    <a class="brand" href="{{ url('/')}}"><img src="{{ asset('bootshop/themes/images/logo.png')}}" alt="Bootsshop"/></a>
		<form class="form-inline navbar-search" method="get" action="{{ url('front/produk/search')}}" >
		<input name="keyword" id="srchFld" class="srchTxt" type="text" />
			@php
                $kategoris = \App\Model\Kategori::get();
            @endphp
            
		  <select name="kategori" class="srchTxt">
			<option value="all">All</option>
			@foreach($kategoris as $kt)
				<option value="{{$kt->id}}">{{$kt->nama}} </option>
            @endforeach
		  </select> 
		  <button type="submit" id="submitButton" class="btn btn-primary">Go</button>
    </form>
    <ul id="topMenu" class="nav pull-right">
	 <li class=""><a href="special_offer.html">Specials Offer</a></li>
	 <li class=""><a href="normal.html">Delivery</a></li>
	 <li class=""><a href="contact.html">Contact</a></li>
	 <li class="">
	 <a href="#login" role="button" data-toggle="modal" style="padding-right:0"><span class="btn btn-large btn-success">Login</span></a>
	<div id="login" class="modal hide fade in" tabindex="-1" role="dialog" aria-labelledby="login" aria-hidden="false" >
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h3>Login Block</h3>
		  </div>
		  <div class="modal-body">
			<form class="form-horizontal loginFrm">
			  <div class="control-group">								
				<input type="text" id="inputEmail" placeholder="Email">
			  </div>
			  <div class="control-group">
				<input type="password" id="inputPassword" placeholder="Password">
			  </div>
			  <div class="control-group">
				<label class="checkbox">
				<input type="checkbox"> Remember me
				</label>
			  </div>
			</form>		
			<button type="submit" class="btn btn-success">Sign in</button>
			<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
		  </div>
	</div>
	</li>
    </ul>
  </div>
</div>
</div>
</div>