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

    <!-- Google tag (gtag.js) -->
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
				{{-- <div class="">
					<div class="main-menu-header">
						<img class="img-radius" src="{{asset('/theme/ablepro/assets/images/user/avatar-2.jpg')}}" alt="User-Profile-Image">
					</div>
				</div> --}}
				{{-- <ul class="nav pcoded-inner-navbar ">
					@foreach($albums as $album)
						<li class="nav-item">
							<a href="#" class="nav-link "><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">{{$album->album}}</span></a>
						</li>
					@endforeach
				</ul> --}}
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
				</ul>
			</div>
		</div>
	</nav>
	<!-- [ navigation menu ] end -->
	<!-- [ Header ] start -->
	<header class="navbar pcoded-header navbar-expand-lg navbar-light header-blue">
				<div class="m-header">
					<a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
					<a href="#!" class="b-brand">
						<h4> <font color="#FFFFFF">K-DreamCard</font></h4>
					</a>
					<a href="#!" class="mob-toggler">
						<i class="feather icon-more-vertical"></i>
					</a>
				</div>
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
							{{-- <h5 class="m-b-10">{{$album->album}}</h5> --}}
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
		@foreach ($vipot_columns as $item)
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<h5>{{$item['album']}}</h5>
						</div>
						<div class="card-body" style="padding-top: 20px;
                        padding-left: 40px;
                        padding-right: 4-;
                        padding-right: 40px;">
							<div class="row" >
								@foreach($item['photo'] as $kb)
                                    <div class="col-sm-1">
										<img class="img-fluid card-img-top" src="{{config('app.url')}}/{{config('app.str')}}/{{$kb->pic_front}}" alt="Card image cap" style="height: 100%;">
									</div>
								@endforeach
							</div>
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
