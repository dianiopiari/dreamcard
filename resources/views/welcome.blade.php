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
                <div class="card text-center">
					<div class="card-block">
						<i class="feather icon-sunset f-40"></i>
						<h6 class="mt-3">K-DreamCard</h6>
						<p>Let you track your favorite kpop photocard</p>
					</div>
				</div>
                <ul class="nav pcoded-inner-navbar ">
                    <li class="nav-item pcoded-menu-caption">
					    <label>About Us</label>
					</li>
					<li class="nav-item">
					    <a href="{{config('app.url')}}/privacy-policy" class="nav-link "><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">privacy Policy</span></a>
					</li>
                    <li class="nav-item">
					    <a href="{{config('app.url')}}/terms-condition" class="nav-link "><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">privacy Policy</span></a>
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
						<!-- ========   change your logo hear   ============ -->
						{{-- <img src="{{asset('/theme/ablepro/assets/images/logo.png')}}" alt="" class="logo">
                         --}}
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
			</div>
		</div>
		<!-- [ breadcrumb ] end -->
		<!-- [ Main Content ] start -->
		<div class="row">
			<!-- [ basic-alert ] start -->
			<div class="col-md-12">
                <div class="card">
                    <div class="card-header">
						<h5>Group</h5>
					</div>
                    <div class="card-body">
                        <div class="card-columns">
                            @foreach($groups as $kb)
                                <div class="card">
                                    <img class="img-fluid card-img-top" src="{{config('app.url')}}/{{config('app.str')}}/{{$kb->logo}}" alt="Card image cap">
                                    <div class="card-body">
                                        <h5 class="card-title"><center>{{$kb->group_name}}</center></h5>
                                        {{-- <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p> --}}
                                        <center>
                                            <a href="{{config('app.url')."/app/".$kb->slug }}" class="btn btn-info" role="button">View Album</a>
                                            <a href="{{config('app.url')."/member/".$kb->slug }}" class="btn btn-danger" role="button">View Member</a>
                                        </center>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
			</div>
			<!-- [ additional-alert ] end -->
		</div>
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
