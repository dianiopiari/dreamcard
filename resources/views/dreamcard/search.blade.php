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
						<a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-box"></i></span><span class="pcoded-mtext">Member {{@$group->group_name}}</span></a>
						<ul class="pcoded-submenu">
                            @foreach($members as $member)
                            <li><a href="{{config('app.url')}}/member/{{$group->slug}}/{{$member->slug}}">{{$member->member_name}}</a></li>
							@endforeach
						</ul>
					</li>
					<li class="nav-item pcoded-hasmenu  pcoded-trigger">
						<a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-box"></i></span><span class="pcoded-mtext">Album {{@$group->group_name}}</span></a>
						<ul class="pcoded-submenu">
							@foreach($albums as $album)
									<li><a href="{{config('app.url')}}/app/{{$group->slug}}/{{$album->slug}}">{{$album->album}}</a></li>
							@endforeach
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
							<h5 class="m-b-10">&nbsp;</h5>
						</div>
                        <ul class="breadcrumb">
							<li class="breadcrumb-item"><a href="{{config('app.url')}}"><i class="feather icon-home"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<h5><b>Search Photocard</b></h5>
                    </div>
					<div class="card-body">
                        <div class="row">
                            <form action="{{config('app.url')}}/search/upload/proses" method="POST" enctype="multipart/form-data" class="was-validated" >
                                {{ csrf_field() }}
                                <div class="input-group cust-file-button">
                                        <input type="file" name="file" required>
                                        <div class="input-group-append">
                                            <input type="submit" value="Upload" class="btn btn-primary">
                                        </div>
                                </div>
                            </form>
                        </div>
					</div>
				</div>
			</div>
		</div>
		<!-- [ Main Content ] end -->
        <div class="row">
			<div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5><b>Result</b></h5>
                    </div>
                    <div class="card-body">
                        <div class="card-body" style="padding-top: 20px; padding-left: 40px;padding-right: 4-;padding-right: 40px;">
                                <div class="row">
                                    <div class="col-md-12">
                                            <div class="card-body" style="padding-top: 20px; padding-left: 40px;padding-right: 4-;padding-right: 40px;">
                                                <div class="row" >
                                                    @php
                                                        $i=0;
                                                    @endphp
                                                    @foreach ($distances as $item)
                                                            <div class="col-sm-1">
                                                                <center><h5 style="padding-top: 10px">{{ $item['member'] }}</h5></center>
                                                                <img class="img-fluid card-img-top" src="{{config('app.url')}}/{{config('app.str')}}/{{ $item['photo']}}" alt="Card image cap"  style="height: 85%">
                                                                <div class="middle">
                                                                    <a href="{{config('app.url')}}/photocard/{{ $item['group_slug'] }}/{{ $item['album_slug'] }}/{{ $item['id'] }}"  type="button" class="btn btn-warning textadd"><i class="feather mr-2 icon-search"></i>delete &nbsp;</a>
                                                                </div>
                                                                <h5 style="padding-top: 10px">({{ $item['album'] }})</h5>
                                                                <h6 style="padding-top: 10px">({{ $item['channel'] }})</h6>
                                                            </div>
                                                            @php
                                                                if ($i++ == 6) break;
                                                            @endphp
                                                    @endforeach
                                                </div>
                                            </div>
                                    </div>
                                </div>
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

    <script>
    </script>
</body>
</html>
