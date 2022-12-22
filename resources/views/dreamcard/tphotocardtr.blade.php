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
    <script src="{{asset('/theme/ablepro/assets/js/canvas2image.js')}}"></script>
    <script src="{{asset('/theme/ablepro/assets/js/html2canvas.min.js')}}"></script>
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
	<nav class="pcoded-navbar menu-light ">
		<div class="navbar-wrapper  ">
			<div class="navbar-content scroll-div " >
				<ul class="nav pcoded-inner-navbar ">
					<li class="nav-item pcoded-hasmenu active pcoded-trigger">
						<a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-box"></i></span><span class="pcoded-mtext">Home</span></a>
						<ul class="pcoded-submenu">
							{{-- @foreach($albums as $album)
								@if ($slug==$album->slug)
									<li class="active"><a href="{{config('app.url')}}/app/{{$group->slug}}/{{$album->slug}}">{{$album->album}}</a></li>
								@else
									<li><a href="{{config('app.url')}}/app/{{$group->slug}}/{{$album->slug}}">{{$album->album}}</a></li>
								@endif
							@endforeach --}}
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</nav>
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
							<h5 class="m-b-10">Group</h5>
						</div>
						{{-- <ul class="breadcrumb">
							<li class="breadcrumb-item"><a href="{{config('app.url')}}"><i class="feather icon-home"></i></a></li>
							<li class="breadcrumb-item"><a href="{{config('app.url')}}/app/{{$group->slug}}">{{$group->group_name}}</a></li>
						</ul> --}}
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<h5 class="mt-4"><b>Custome Template</b></h5>

                    </div>
					<div class="card-body" id="html-content-holder">
                        <div class="row">
                            @if(session('carttrhave') or session('carttrwant') )
                                <div class="container">
                                    <div class="row">
                                        <div class="col-sm">
                                            <div class="row">
                                                @foreach(session('carttrwant') as $id => $details)
                                                    <div class="col-sm-4">
                                                        <a href="#"><img class="img-fluid card-img-top" src="{{config('app.url')}}/{{config('app.str')}}/{{ $details['pic_front'] }}" alt="Card image cap"></a>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="col-sm">
                                            to
                                        </div>
                                        <div class="col-sm">
                                            <div class="row">
                                                @foreach(session('carttrhave') as $id => $details)
                                                    <div class="col-sm-4">
                                                        <a href="#"><img class="img-fluid card-img-top" src="{{config('app.url')}}/{{config('app.str')}}/{{ $details['pic_front'] }}" alt="Card image cap"></a>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @endif
                        </div>
                        <div class="row">
                            <div class="float-center">
                                <button id="btn-Preview-Image"  type="button" class="btn btn-primary"><i class="feather mr-2 icon-thumbs-up"></i>WTS</button>
                                <a id="btn-Convert-Html2Image" href="#" type="button" class="btn btn-secondary"><i class="feather mr-2 icon-camera"></i>WTB</a>
                                <a id="download-image"  href="#" type="button" class="btn btn-success"><i class="feather mr-2 icon-check-circle"></i>Trade</a>
                            </div>
                        </div>
					</div>
				</div>
			</div>
		</div>
		<!-- [ Main Content ] end -->
        <div class="row">
			<div class="col-md-12">
                <div id="previewImage"></div>
            </div>
        </div>
	</div>
</div>
    <!-- Required Js -->
    <script src="{{asset('/theme/ablepro/assets/js/vendor-all.min.js')}}"></script>
    <script src="{{asset('/theme/ablepro/assets/js/plugins/bootstrap.min.js')}}"></script>
    <script src="{{asset('/theme/ablepro/assets/js/ripple.js')}}"></script>
    <script src="{{asset('/theme/ablepro/assets/js/pcoded.min.js')}}"></script>

    <script>
        $(document).ready(function() {

            // Global variable
            var element = $("#html-content-holder");

            // Global variable
            var getCanvas;
            $("#btn-Preview-Image").on('click', function() {
                html2canvas(element, {
                onrendered: function(canvas) {
                        $("#previewImage").append(canvas);
                        getCanvas = canvas;
                    }
                });
            });
            $("#btn-Convert-Html2Image").on('click', function() {
                html2canvas(element, {
                onrendered: function(canvas) {
                    return Canvas2Image.saveAsPNG(canvas);
                    }
                });

            });

            $("#download-image").on('click', function() {
                ///alert("asa");
                html2canvas(element, {
                    onrendered: function(canvas) {
                    // document.body.appendChild(canvas);
                        return Canvas2Image.saveAsPNG(canvas);
                    }
                });
            });

        });
    </script>
</body>
</html>
