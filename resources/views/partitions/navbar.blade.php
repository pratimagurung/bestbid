<div class="navbar navbar-default navbar-fixed-top" role="navigation">  
    <div class="container">
        <div class="navbar-header">
            <div class="navbar-header"><a class="navbar-brand" href="{{ url('/') }}">Best Bid</a></div>
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>

        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav pull-right">
                @guest
                <li><a href="{{ route('login') }}">Login</a></li>
                <li><a href="{{ route('register') }}">Register</a></li>
                <li><a href="{{ asset('helpfile/BestBidHelp.pdf') }}">Help</a></li>
                <li><a href="#" onclick="window.print();">Print</a></li>
                @else
                @if(Auth::user()->is_admin)
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> Admin Dashboard <span class="caret"></span>  
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{ url('/category') }}">Categories</a></li>
                        <li><a href="{{ url('/admindash/users') }}">Users</a></li>
                    </ul>
                    @endif
                    <li><a href="" data-target="#notifications" data-toggle="modal">Notifications ({{ auth()->user()->notification_count }})</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> My BestBid ({{ Auth::user()->firstname }}) <span class="caret"></span>  
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('/profile') }}">My Profile</a></li>
                            <li><a href="{{ url('/products') }}">My Products</a></li>
                            <li>
                                <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                Logout
                            </a><form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form></li>
                        </ul>
                    </li>
                    <li><a href="{{ asset('helpfile/BestBidHelp.pdf') }}">Help</a></li>
                    <li><a href="#" onclick="window.print();">Print</a></li>
                    @endguest
                </ul>
            </div>
        </div>
    </div>

    <div class="navbar navbar-inverse navbar-static-top" role="navigation" style="background-color: #e3f2fd;">
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
                    <li class="{{ Request::is('/') ? 'active' : '' }}"><a href="{{ url('/') }}">Home</a></li>
                    <li class="{{ Request::is('auction-gallery') ? 'active' : '' }}"><a href="{{ url('/auction-gallery') }}">Auction</a></li>
                    <li class="{{ Request::is('product') ? 'active' : '' }}"><a href="{{ url('/product') }}">Sell</a></li>
                    <li class="{{ Request::is('starting-soon') ? 'active' : '' }}"><a href="{{ url('/startingsoon') }}">Starting Soon</a></li>
                    <li class="{{ Request::is('ending-soon') ? 'active' : '' }}"><a href="{{ url('/endingsoon') }}">Ending Soon</a></li>
                    <li><a href="#" class="dropdown-toggle" data-toggle="dropdown">Categories<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            @foreach($categories as $category)
                            <li>
                                @if(count($category->subcategories))
                                <a class="dropdown-toggle" data-toggle="dropdown" href="{{ url('/category/'.urlencode($category->categoryname)) }}">{{ $category->categoryname }}<span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    @foreach($category->subcategories as $subcategory)
                                    <li><a href="{{ url('/show-category/'.urlencode($category->categoryname).'/'.urlencode($subcategory->name)) }}">{{ $subcategory->name }}</a></li>
                                    @endforeach
                                </ul>
                                @else
                                <a href="{{ url('/show-category'.$category->categoryname) }}">{{ $category->categoryname }}</a>
                                @endif
                            </li>
                            @endforeach
                        </ul>
                    </li>
                </ul>
                <div class="col-sm-3 col-md-3 pull-right">
                    <form method="GET" action="{{ url('/search') }}" class="navbar-form" role="search">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search" name="searchTerm" id="searchTerm">
                            <div class="input-group-btn">
                                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('partitions.notifications')
    <div class="container">