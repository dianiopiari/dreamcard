<!DOCTYPE html>
<html lang="en">
<head>
	<title>Album {{@$group->group_name}} - {{@$album->album}}</title>
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
                    <li class="nav-item pcoded-hasmenu {{$active}} pcoded-trigger">
						<a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-box"></i></span><span class="pcoded-mtext">Album {{$group->group_name}}</span></a>
						<ul class="pcoded-submenu">
							@foreach($albums as $al)
								@if ($slug==$al->slug)
									<li class="active"><a href="{{config('app.url')}}/app/{{$group->slug}}/{{$al->slug}}/0/0">{{$al->album}}</a></li>
								@else
									<li><a href="{{config('app.url')}}/app/{{$group->slug}}/{{$al->slug}}/0/0">{{$al->album}}</a></li>
								@endif
							@endforeach
						</ul>
					</li>
                    <li class="nav-item pcoded-hasmenu {{$activemd}} pcoded-trigger">
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
							<h5 class="m-b-10">{{$album->album}}</h5>
						</div>
						<ul class="breadcrumb">
							<li class="breadcrumb-item"><a href="{{config('app.url')}}"><i class="feather icon-home"></i></a></li>
							<li class="breadcrumb-item"><a href="{{config('app.url')}}/app/{{$group->slug}}" @if ($style2==1) style="background: white;color: #fd6e29;padding: 2px;" @endif>{{$group->group_name}}</a></li>
                            @if (@$isExistAlbum!=null)
                                <li class="breadcrumb-item"><a href="{{config('app.url')}}/app/{{$group->slug}}/{{$album->slug}}/0/album" @if ($style4==1) style="background: white;color: #fd6e29;padding: 2px;" @endif>Album Inclusions</a></li>
                            @endif
                            @if (@$isExistPob!=null)
                                <li class="breadcrumb-item"><a href="{{config('app.url')}}/app/{{$group->slug}}/{{$album->slug}}/0/fansign" @if ($style5==1) style="background: white;color: #fd6e29;padding: 2px;" @endif >Fansign/POB</a></li>
                            @endif
                            @if (@$isExistOther!=null)
                            <li class="breadcrumb-item"><a href="{{config('app.url')}}/app/{{$group->slug}}/{{$album->slug}}/0/other" @if ($style6==1) style="background: white;color: #fd6e29;padding: 2px;" @endif>Other</a></li>
                            @endif
						</ul>
					</div>
				</div>
			</div>
		</div>
		<!-- [ breadcrumb ] end -->
        <!-- Whislist & Search panel -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a href="javascript:window.history.go(-1);" type="button" class="btn btn-dark"><i class="fa fa-arrow-left"></i>&nbsp; Back&nbsp;</a>
                        <div class="float-right">
                            @auth
                                @if ($cek==null)
                                    <a href="{{$_SERVER['REQUEST_URI']}}/cek" type="button" class="btn btn-warning"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp; Show My Collection &nbsp;</a>
                                @else
                                    <a href="{{ str_replace("/cek","",$_SERVER['REQUEST_URI']) }}" type="button" class="btn btn-secondary"><i class="fa fa-eye-slash" aria-hidden="true"></i>&nbsp; Don't Show My Collection &nbsp;</a>
                                @endif
                                <a href="{{ route('cart') }}/{{@$group->slug}}" type="button" class="btn btn-info"><i class="fa fa-shopping-bag" aria-hidden="true"></i>&nbsp; My Photocard &nbsp; <span class="badge badge-pill badge-danger" id="countphoto">{{$countphoto}}</span></a>
                                <a href="{{ route('cartwtb') }}/{{@$group->slug}}" type="button" class="btn btn-danger"><i class="fa fa-heart" aria-hidden="true"></i>&nbsp; Wishlist &nbsp; <span class="badge badge-pill badge-light" id="countphotowtb"><font color="#000000">{{$countphotowhistlist}}</font></span></a>
                            @endauth
                            <a href="{{ route('search') }}/{{@$group->slug}}" type="button" class="btn btn-success"><i class="fa fa-search" aria-hidden="true"></i>&nbsp; Looking for photocards &nbsp; </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<!-- [ Main Content ] start -->
		@foreach ($vipot_columns as $item)
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<h5>{{$item['channel']}}</h5>
						</div>
						<div class="card-body" style="padding-top: 20px;
                        padding-left: 40px;
                        padding-right: 4-;
                        padding-right: 40px;">
							<div class="row" >
								@foreach($item['photo'] as $kb)
                                    <div class="col-sm-1">
                                        @if ($cek==null)
                                            <img class="img-fluid card-img-top" src="{{config('app.url')}}/{{config('app.str')}}/{{$kb->pic_front}}" alt="Card image cap" style="height: 100%;">
                                        @else
                                            @if (in_array($kb->id, $myphotocards))
                                                <img class="img-fluid card-img-top" src="{{config('app.url')}}/{{config('app.str')}}/{{$kb->pic_front}}" alt="Card image cap" style="height: 100%;">
                                            @else
                                                <img class="img-fluid card-img-top" src="{{config('app.url')}}/{{config('app.str')}}/{{$kb->pic_front}}" alt="Card image cap" style="height: 100%; filter:grayscale(100%)">
                                            @endif
                                       @endif
										<div class="middle">
                                            @auth
                                                <a href="{{config('app.url')}}/photocard/{{$group->slug}}/{{$album->slug}}/{{$kb->id}}"  type="button" class="btn btn-warning text"><i class="feather mr-2 icon-search"></i></a>
                                                <button onClick="Data.addPhotocard('{{$kb->id}}')" class="btn btn-info text"><i class="feather mr-2 icon-briefcase" aria-hidden="true"></i></button>
                                                <button onClick="Data.addPhotocardwtb('{{$kb->id}}')" class="btn btn-danger text"><i class="feather mr-2 icon-heart" aria-hidden="true"></i></button>
                                            @else
                                            <a href="{{config('app.url')}}/photocard/{{$group->slug}}/{{$album->slug}}/{{$kb->id}}"  type="button" class="btn btn-warning textadd"><i class="feather mr-2 icon-search"></i>Detail &nbsp;</a>
                                            @endauth
                                        </div>
									</div>
								@endforeach
							</div>
						</div>
					</div>
				</div>
			</div>
		@endforeach
		@if ($limit==1)
			<div class="row">
				<div class="col-sm-12">
					<div class="card-body">
						<center>
							<a href="{{config('app.url')}}/app/{{$group->slug}}/{{$album->slug}}/all"  type="button" class="btn btn-warning"><i class="feather mr-2 icon-check-circle"></i>ALL PHOTO CARD</a>
						</center>
					</div>
				</div>
			</div>
		@endif
		<!-- [ Main Content ] end -->
	</div>
</div>
<!-- [ Main Content ] end -->
    <!-- Warning Section Ends -->

    <!-- Required Js -->
    <script src="{{asset('/theme/ablepro/assets/js/vendor-all.min.js')}}"></script>
    <script src="{{asset('/theme/ablepro/assets/js/plugins/bootstrap.min.js')}}"></script>
    <script src="{{asset('/theme/ablepro/assets/js/ripple.js')}}"></script>
    <script src="{{asset('/theme/ablepro/assets/js/pcoded.min.js')}}"></script>
    <script src="{{asset('/theme/ablepro/assets/js/sweetalert.min.js')}}"></script>
    <script>
        var Data = {
            "addPhotocard" : function(photocard_id){
                $.ajax({
                    url:"{{config('app.url')}}/tmp/add-to-cart" + '/' + photocard_id,
                    type:  'get',
                    dataType: "json",
                    beforeSend: function() {
                        $("#loading-image").show();
                    },
                    success: function(response) {
                        $('span#countphoto').html(response.countphoto);
                        if(response.exist==1){
                            swal("Opps!", "Photocard already save on your data!", "warning");
                        }else{
                            swal("Good job!", "Photocard add to your data!", "success");
                        }
                    }
                })
            },
            "addPhotocardwtb" : function(photocard_id){
                $.ajax({
                    url:"{{config('app.url')}}/tmp/add-to-cart-wtb" + '/' + photocard_id,
                    type:  'get',
                    dataType: "json",
                    beforeSend: function() {
                        $("#loading-image").show();
                    },
                    success: function(response) {
                        $('span#countphotowtb').html(response.countphoto);
                        if(response.exist==1){
                            swal("Opps!", "Photocard already save on your wishlist!", "warning");
                        }else{
                            swal("Good job!", "Photocard add to your wishlist!", "success");
                        }
                    }
                })
            }
        };
    </script>
</body>
</html>
