<div class="navbar navbar-default" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
		</div>

		<div class="collapse navbar-collapse">
			<ul class="nav navbar-nav" >
				<li class="{{ Request::is('profile') ? 'active' : '' }}"><a href="{{ url('/profile') }}">Personal Information</a></li>
				<li class="{{ Request::is('profile/auctions') ? 'active' : '' }}"><a href="{{ url('/profile/auctions') }}">My Auctions</a></li>
				<li class="{{ Request::is('profile/bids') ? 'active' : '' }}"><a href="{{ url('/profile/bids') }}">My Bids</a></li>
				<li class="{{ Request::is('products') ? 'active' : '' }}"><a href="{{ url('/products') }}">My Products</a></li>
			</ul>
		</div>
	</div>
</div>