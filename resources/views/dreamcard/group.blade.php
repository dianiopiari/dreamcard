<!DOCTYPE html>
<html lang="en">
<head>
	<title>Group {{@$group->group_name}}</title>
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
				<ul class="nav pcoded-inner-navbar ">
                    <li class="nav-item pcoded-hasmenu pcoded-trigger">
						<a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-box"></i></span><span class="pcoded-mtext">Member {{$group->group_name}}</span></a>
						<ul class="pcoded-submenu">
                            @foreach($members as $member)
                            <li><a href="{{config('app.url')}}/member/{{$group->slug}}/{{$member->slug}}">{{$member->member_name}}</a></li>
							@endforeach
						</ul>
					</li>
					<li class="nav-item pcoded-hasmenu pcoded-trigger">
						<a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-box"></i></span><span class="pcoded-mtext">Album {{$group->group_name}}</span></a>
						<ul class="pcoded-submenu">
							@foreach($albums as $album)
								@if ($slug==$album->slug)
									<li class="active"><a href="{{config('app.url')}}/app/{{$group->slug}}/{{$album->slug}}/0/0">{{$album->album}}</a></li>
								@else
									<li><a href="{{config('app.url')}}/app/{{$group->slug}}/{{$album->slug}}/0/0">{{$album->album}}</a></li>
								@endif
							@endforeach
						</ul>
					</li>
                    <li class="nav-item pcoded-hasmenu pcoded-trigger">
						<a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-box"></i></span><span class="pcoded-mtext">Merchandise/Event</span></a>
						<ul class="pcoded-submenu">
							@foreach($MdThums as $mdthu)
								@if ($slug==$mdthu->slug)
									<li class="active"><a href="{{config('app.url')}}/app/{{$group->slug}}/{{$mdthu->slug}}/0/0">{{$mdthu->album}}</a></li>
								@else
									<li><a href="{{config('app.url')}}/app/{{$group->slug}}/{{$mdthu->slug}}/0/0">{{$mdthu->album}}</a></li>
								@endif
							@endforeach
						</ul>
					</li>
				</ul>
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
							<h5 class="m-b-10">Group</h5>
						</div>
						<ul class="breadcrumb">
							<li class="breadcrumb-item"><a href="{{config('app.url')}}"><i class="feather icon-home"></i></a></li>
							<li class="breadcrumb-item"><a href="{{config('app.url')}}/app/{{$group->slug}}">{{$group->group_name}}</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<!-- [ breadcrumb ] end -->
		<!-- [ Main Content ] start -->
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<h5>Member</h5>
					</div>
					<div class="card-body">
                        <div class="row">
                            @foreach($members as $member)
                                <div class="col-sm-1">
                                    <a href="{{config('app.url')}}/member/{{$group->slug}}/{{$member->slug}}">
                                        <img  class="rounded-circle img-fluid card-img-top"  src="{{config('app.url')}}/{{config('app.str')}}/{{$member->photo}}" alt="Card image cap">
                                    </a>
                                    <div class="card-body">
                                        <a href="{{config('app.url')}}/member/{{$group->slug}}/{{$member->slug}}"><h5 class="card-title"><center>{{$member->member_name}}</center></h5></a>
										<center><p>{{$member->position}}</p></center>
                                    </div>
                                </div>
                            @endforeach
                        </div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<h5 class="mt-4">Album</h5>
					</div>
					<div class="card-body">
                        <div class="row">
                            @foreach($albumsThum as $albs)
								<div class="col-sm-2">
                                    <a href="{{config('app.url')}}/app/{{$group->slug}}/{{$albs->slug}}/0/0"><img class="img-fluid card-img-top" src="{{config('app.url')}}/{{config('app.str')}}/{{$albs->photo}}" alt="Card image cap"></a>
                                    <div class="card-body">
                                        <h5 class="card-title">{{$albs->album}}</h5>
                                        <div id="textbox" style="clear: both;">
                                            <p style="float: left">{{$albs->tahun}}</p>
                                            <p style="float: right;"><b>{{$albs->jumlah_phoca}}</b><small>pcs</small></p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
					</div>
				</div>
			</div>
		</div>
        <div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<h5 class="mt-4">Merchandise/Event/Concert</h5>
					</div>
					<div class="card-body">
                        <div class="row">
                            @foreach($MdThums as $MdThum)
								<div class="col-sm-2">
                                    <a href="{{config('app.url')}}/app/{{$group->slug}}/{{$MdThum->slug}}"><img class="img-fluid card-img-top" src="{{config('app.url')}}/{{config('app.str')}}/{{$MdThum->photo}}" alt="Card image cap"></a>
                                    <div class="card-body">
                                        <h5 class="card-title">{{$MdThum->album}}</h5>
										<div id="textbox" style="clear: both;">
                                            <p style="float: left">{{$MdThum->tahun}}</p>
                                            <p style="float: right;"><b>{{$MdThum->jumlah_phoca}}</b><small>pcs</small></p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
					</div>
				</div>
			</div>
		</div>
		<!-- [ Main Content ] end -->
	</div>
</div>
<!-- [ Main Content ] end -->
    <!-- Warning Section start -->
    <!-- Older IE warning message -->
    <!--[if lt IE 11]>
        <div class="ie-warning">
            <h1>Warning!!</h1>
            <p>You are using an outdated version of Internet Explorer, please upgrade
               <br/>to any of the following web browsers to access this website.
            </p>
            <div class="iew-container">
                <ul class="iew-download">
                    <li>
                        <a href="http://www.google.com/chrome/">
                            <img src="assets/images/browser/chrome.png" alt="Chrome">
                            <div>Chrome</div>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.mozilla.org/en-US/firefox/new/">
                            <img src="assets/images/browser/firefox.png" alt="Firefox">
                            <div>Firefox</div>
                        </a>
                    </li>
                    <li>
                        <a href="http://www.opera.com">
                            <img src="assets/images/browser/opera.png" alt="Opera">
                            <div>Opera</div>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.apple.com/safari/">
                            <img src="assets/images/browser/safari.png" alt="Safari">
                            <div>Safari</div>
                        </a>
                    </li>
                    <li>
                        <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                            <img src="assets/images/browser/ie.png" alt="">
                            <div>IE (11 & above)</div>
                        </a>
                    </li>
                </ul>
            </div>
            <p>Sorry for the inconvenience!</p>
        </div>
    <![endif]-->
    <!-- Warning Section Ends -->

    <!-- Required Js -->
    <script src="{{asset('/theme/ablepro/assets/js/vendor-all.min.js')}}"></script>
    <script src="{{asset('/theme/ablepro/assets/js/plugins/bootstrap.min.js')}}"></script>
    <script src="{{asset('/theme/ablepro/assets/js/ripple.js')}}"></script>
    <script src="{{asset('/theme/ablepro/assets/js/pcoded.min.js')}}"></script>
</body>
</html>
