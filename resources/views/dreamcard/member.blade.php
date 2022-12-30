<!DOCTYPE html>
<html lang="en">
<head>
	<title>K-DreamCard</title>
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

    <script async src="https://www.googletagmanager.com/gtag/js?id=G-1VQDNKKF6L"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-1VQDNKKF6L');
    </script>

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
					<li class="nav-item pcoded-hasmenu active pcoded-trigger">
						<a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-box"></i></span><span class="pcoded-mtext">Member {{$group->group_name}}</span></a>
						<ul class="pcoded-submenu">
							@foreach($members as $al)
								@if ($slug==$al->slug)
									<li class="active"><a href="{{config('app.url')}}/member/{{$group->slug}}/{{$al->slug}}">{{$al->member_name}}</a></li>
								@else
									<li><a href="{{config('app.url')}}/member/{{$group->slug}}/{{$al->slug}}">{{$al->member_name}}</a></li>
								@endif
							@endforeach
						</ul>
					</li>
                    <li class="nav-item pcoded-hasmenu pcoded-trigger">
						<a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-box"></i></span><span class="pcoded-mtext">Album {{$group->group_name}}</span></a>
						<ul class="pcoded-submenu">
							@foreach($albums as $album)
								@if ($slug==$album->slug)
									<li class="active"><a href="{{config('app.url')}}/app/{{$group->slug}}/{{$album->slug}}">{{$album->album}}</a></li>
								@else
									<li><a href="{{config('app.url')}}/app/{{$group->slug}}/{{$album->slug}}">{{$album->album}}</a></li>
								@endif
							@endforeach
						</ul>
					</li>
                    <li class="nav-item pcoded-hasmenu pcoded-trigger">
						<a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-box"></i></span><span class="pcoded-mtext">Merchandise/Event</span></a>
						<ul class="pcoded-submenu">
							@foreach($MdThums as $mdthu)
								@if ($slug==$mdthu->slug)
									<li class="active"><a href="{{config('app.url')}}/app/{{$group->slug}}/{{$mdthu->slug}}">{{$mdthu->album}}</a></li>
								@else
									<li><a href="{{config('app.url')}}/app/{{$group->slug}}/{{$mdthu->slug}}">{{$mdthu->album}}</a></li>
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
                            @auth
                                <h5 class="m-b-10">Hai <b>{{ auth('web')->user()->name }}</b>, Welcome to K-DreamCard</h5>
                            @endauth
                        </div>
						<ul class="breadcrumb">
							<li class="breadcrumb-item"><a href="{{config('app.url')}}"><i class="feather icon-home"></i></a></li>
							<li class="breadcrumb-item"><a href="{{config('app.url')}}/app/{{$group->slug}}" >{{$group->group_name}}</a></li>
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
                        <a href="javascript:window.history.go(-1);" type="button" class="btn btn-dark"><i class="fa fa-arrow-left"></i>&nbsp; Back&nbsp;</a>
                        <div class="float-right">
                            @auth
                                <a href="{{ route('cart') }}/{{@$group->slug}}" type="button" class="btn btn-info"><i class="fa fa-shopping-bag" aria-hidden="true"></i>&nbsp; My Photocard &nbsp; <span class="badge badge-pill badge-danger" id="countphoto">{{$countphoto}}</span></a>
                                <a href="{{ route('cartwtb') }}/{{@$group->slug}}" type="button" class="btn btn-danger"><i class="fa fa-heart" aria-hidden="true"></i>&nbsp; Wishlist &nbsp; <span class="badge badge-pill badge-light" id="countphotowtb"><font color="#000000">{{$countphotowhistlist }}</font></span></a>
                            @endauth
                            <a href="{{ route('search') }}/{{@$group->slug}}" type="button" class="btn btn-success"><i class="fa fa-search" aria-hidden="true"></i>&nbsp; Looking for photocards &nbsp; </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		@foreach ($vipot_columns as $item)
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<h5>{{$item['album']}}</h5>
						</div>
						<div class="card-body" style="padding-top: 20px; padding-left: 40px;padding-right: 4-;padding-right: 40px;">
                            @foreach($item['photo'] as $cat)
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>{{$cat['cat']->channel}}</h5>
                                            </div>
                                            <div class="card-body" style="padding-top: 20px; padding-left: 40px;padding-right: 4-;padding-right: 40px;">
                                                <div class="row" >
                                                    @foreach($cat['photo'] as $kb)
                                                            <div class="col-sm-1">
                                                                <img class="img-fluid card-img-top" src="{{config('app.url')}}/{{config('app.str')}}/{{$kb->pic_front}}" alt="Card image cap" style="height: 100%;">
                                                                <div class="middle">
                                                                    <a href="{{config('app.url')}}/photocard/{{$group->slug}}/{{$album->slug}}/{{$kb->id}}"  type="button" class="btn btn-warning textadd"><i class="feather mr-2 icon-search"></i>Detail &nbsp;</a>
                                                                </div>
                                                            </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
						</div>
					</div>
				</div>
			</div>
		@endforeach
		<!-- [ Main Content ] end -->
	</div>
</div>
    <!-- Required Js -->
<script src="{{asset('/theme/ablepro/assets/js/vendor-all.min.js')}}"></script>
<script src="{{asset('/theme/ablepro/assets/js/plugins/bootstrap.min.js')}}"></script>
<script src="{{asset('/theme/ablepro/assets/js/ripple.js')}}"></script>
<script src="{{asset('/theme/ablepro/assets/js/pcoded.min.js')}}"></script>
</body>
</html>
