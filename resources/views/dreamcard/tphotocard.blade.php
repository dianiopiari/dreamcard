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
                                    <li><a href="user-profile.html" class="dropdown-item"><i class="feather icon-user"></i> Profile</a></li>
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
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
                        <a href="javascript:window.history.go(-1);" type="button" class="btn btn-dark"><i class="fa fa-arrow-left"></i>&nbsp; Back&nbsp;</a>
                        <div class="float-right">
                            <button  onClick="Data.clear()" class="btn btn-info"><i class="feather mr-2 icon-trash"></i>Clear Data All </button>
                            <button  id="btn-Convert-Html2Image"  class="btn btn-danger"><i class="feather mr-2 icon-camera"></i>Download Template</button>
                            <button  id="btn-Convert-Html2Image-without" class="btn btn-success"><i class="feather mr-2 icon-camera"></i>Download Without Background </button>
                        </div>
                    </div>
                    <div class="card-body" id="html-content-holder">
                        <div class="row d-flex justify-content-center">
                            <div class="col-md-12">
                                <div class="card p-3 py-4" id="html-content-holder">
                                    <div class="p-3 py-4" id="html-without-background">
                                        <div class="text-center mt-3">
                                            <div class="card-body">
                                                <h1><b>My Photocard Collection</b></h1>
                                                <h5 class="mt-2 mb-0">&nbsp;</h5>
                                                @if($hastag)
                                                    <span class="badge badge-primary">{{$hastag['tipe']}}</span>&nbsp;
                                                    <span class="badge badge-secondary">{{$hastag['photo']}}</span>&nbsp;
                                                    @foreach($hastag['group'] as $id => $groups)
                                                        <span class="badge badge-success">{{$groups['group']}}</span>
                                                    @endforeach
                                                    @foreach($hastag['member'] as $id => $members)
                                                        <span class="badge badge-danger">{{$members['member']}}</span>
                                                    @endforeach
                                                    @foreach($hastag['album'] as $id => $albums)
                                                        <span class="badge badge-info">{{$albums['album']}}</span>
                                                    @endforeach
                                                    <h5 class="mt-2 mb-0">&nbsp;</h5>
                                                @endif
                                            </div>
                                            <div class="row">
                                                @if(session('cart'))
                                                    @foreach(session('cart') as $id => $details)
                                                        <div class="col-sm-2">
                                                            <img class="img-fluid card-img-top" src="{{config('app.url')}}/{{config('app.str')}}/{{ $details['pic_front'] }}" alt="Card image cap"  style="height: 90%">
                                                            <div class="middle" style="justify-content: left">
                                                                <a href="#"  type="button" class="btn btn-default text" onClick="Data.deletePhotocard('{{ $details['id'] }}')"><i class="feather mr-2 icon-trash"></i>Delete&nbsp;</a>
                                                            </div>
                                                            <h5 style="padding-top: 10px">({{ $details['channel'] }})</h5>
                                                        </div>
                                                    @endforeach
                                                @endif
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
        var Data = {
            "deletePhotocard" : function(photocard_id){
                if(confirm("Are you sure want to remove?")) {
                    $.ajax({
                        url: '{{ route('remove.from.cart') }}',
                        method: "DELETE",
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: photocard_id
                        },
                        success: function (response) {
                            window.location.reload();
                        }
                    });
                }
            },
            "clear" : function(photocard_id){
                if(confirm("Are you sure want to clear all photocard selected?")) {
                    $.ajax({
                        url: '{{ route('remove.all.from.cart') }}',
                        method: "DELETE",
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function (response) {
                            window.location.reload();
                        }
                    });
                }
            }
        };
        $(document).ready(function() {
            // Global variable
            var element = $("#html-content-holder");
            var elementwithout = $("#html-without-background");
            // Global variable
            var getCanvas;
            $("#btn-Convert-Html2Image").on('click', function() {
                html2canvas(element, {
                onrendered: function(canvas) {
                    return Canvas2Image.saveAsPNG(canvas);
                    }
                });

            });

            $("#btn-Convert-Html2Image-without").on('click', function() {
                html2canvas(elementwithout, {
                onrendered: function(canvas) {
                    return Canvas2Image.saveAsPNG(canvas);
                    }
                });

            });

        });


    </script>
</body>
</html>
