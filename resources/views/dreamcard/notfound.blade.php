<!DOCTYPE html>
<html lang="en">
<head>
	<title>Not Found</title>
	<!-- HTML5 Shim and Respond.js IE11 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 11]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	<!-- Meta -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="description" content="" />
	<meta name="keywords" content="">
	<meta name="author" content="Phoenixcoded" />
	<!-- Favicon icon -->
	<link rel="icon" href="{{asset('/theme/ablepro/assets/images/favicon.ico')}}" type="image/x-icon">

	<!-- vendor css -->
	<link rel="stylesheet" href="{{asset('/theme/ablepro/assets/css/style.css')}}">

        <!-- Google tag (gtag.js) -->
        @include('dreamcard.analyticstracking')
</head>
<body class="">
	<!-- [ Pre-loader ] start -->
	<div class="loader-bg">
		<div class="loader-track">
			<div class="loader-fill"></div>
		</div>
	</div>
	<!-- [ Pre-loader ] End -->
	<!-- [ navigation menu ] start -->
	<nav class="pcoded-navbar menu-light ">
		<div class="navbar-wrapper  ">
			<div class="navbar-content scroll-div " >
			</div>
		</div>
	</nav>
	<!-- [ navigation menu ] end -->
	<!-- [ Header ] start -->
	<header class="navbar pcoded-header navbar-expand-lg navbar-light header-blue">
        <div class="m-header">
            <a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
            <a href="{{config('app.url')}}" class="b-brand">
                <h4> <font color="#FFFFFF">K-DreamCard</font></h4>
            </a>
            <a href="#!" class="mob-toggler">
                <i class="feather icon-more-vertical"></i>
            </a>
        </div>
        <!-- profile -->
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a href="#!" class="pop-search"><i class="feather icon-search"></i></a>
                    <div class="search-bar">
                        <input type="text" class="form-control border-0 shadow-none" placeholder="Search hear">
                        <button type="button" class="close" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                @auth
                    <li>
                        <div class="dropdown drp-user">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="feather icon-user"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right profile-notification">
                                <div class="pro-head">
                                    <span>Hai, {{ auth('web')->user()->name }}</span>
                                </div>
                                <ul class="pro-body">
                                    <li><a href="{{ route('cart') }}" class="dropdown-item"><i class="fa fa-shopping-bag"></i> My Photocard</a></li>
                                    <li><a href="{{ route('cartwtb') }}" class="dropdown-item"><i class="fa fa-heart"></i> Wishlist</a></li>
                                    <li>
                                        {{-- <a href="{{ route('logout') }}" class="dropdown-item"><i class="feather icon-log-out"></i> Log Out</a> --}}
                                        <form action="{{ route('logout') }}" method="post">
                                            @csrf
                                            <a href="javascript:;" onclick="parentNode.submit();" class="dropdown-item"><i class="feather icon-log-out"></i> Log Out</a>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                @else
                    <li>
                        <div class="dropdown drp-user">
                            <a href="{{ route('login') }}"><i class="feather icon-log-in"></i></a>
                        </div>
                    </li>
                @endauth
            </ul>
        </div>
    </header>
	<!-- [ Header ] end -->
<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
	<div class="pcoded-content">
		<!-- [ breadcrumb ] start -->
		<div class="page-header">
			<div class="page-block">
				<div class="row align-items-center">
					<div class="col-md-12">
						<div class="page-header-title">
							<h5 class="m-b-10">Not Found</h5>
                            <a href="javascript:window.history.go(-1);" type="button" class="btn btn-dark"><i class="fa fa-arrow-left"></i>&nbsp; Back&nbsp;</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
    <!-- Required Js -->
    <script src="{{asset('/theme/ablepro/assets/js/vendor-all.min.js')}}"></script>
    <script src="{{asset('/theme/ablepro/assets/js/plugins/bootstrap.min.js')}}"></script>
    <script src="{{asset('/theme/ablepro/assets/js/ripple.js')}}"></script>
    <script src="{{asset('/theme/ablepro/assets/js/pcoded.min.js')}}"></script>
</body>
</html>
