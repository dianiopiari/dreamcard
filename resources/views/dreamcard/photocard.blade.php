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
	<nav class="pcoded-navbar menu-light ">
		<div class="navbar-wrapper  ">
			<div class="navbar-content scroll-div " >
				<ul class="nav pcoded-inner-navbar ">
                    <li class="nav-item pcoded-hasmenu active pcoded-trigger">
						<a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-box"></i></span><span class="pcoded-mtext">Member {{$group->group_name}}</span></a>
						<ul class="pcoded-submenu">
                            @foreach($members as $member)
                            <li><a href="{{config('app.url')}}/member/{{$group->slug}}/{{$member->slug}}">{{$member->member_name}}</a></li>
							@endforeach
						</ul>
					</li>
					<li class="nav-item pcoded-hasmenu  pcoded-trigger">
						<a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-box"></i></span><span class="pcoded-mtext">Album {{$group->group_name}}</span></a>
						<ul class="pcoded-submenu">
							@foreach($albums as $album)
									<li><a href="{{config('app.url')}}/app/{{$group->slug}}/{{$album->slug}}">{{$album->album}}</a></li>
							@endforeach
						</ul>
					</li>
                    <li class="nav-item pcoded-hasmenu pcoded-trigger">
						<a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-box"></i></span><span class="pcoded-mtext">Merchandise/Event</span></a>
						<ul class="pcoded-submenu">
							@foreach($MdThums as $mdthu)
									<li><a href="{{config('app.url')}}/app/{{$group->slug}}/{{$mdthu->slug}}">{{$mdthu->album}}</a></li>
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
						</div>
						<ul class="breadcrumb">
							<li class="breadcrumb-item"><a href="{{config('app.url')}}"><i class="feather icon-home"></i></a></li>
							<li class="breadcrumb-item"><a href="{{config('app.url')}}/app/{{@$group->slug}}">{{@$group->group_name}}</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <a href="javascript:window.history.go(-1);" type="button" class="btn btn-dark"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp; Back &nbsp; </a>
                        </div>
                        <div class="float-right">
                            <a href="{{ route('cart') }}/{{@$group->slug}}" type="button" class="btn btn-info"><i class="fa fa-shopping-bag" aria-hidden="true"></i>&nbsp; My Photocard &nbsp; <span class="badge badge-pill badge-danger" id="countphoto">{{count((array) session('cart')) }}</span></a>
                            <a href="{{ route('cartwtb') }}/{{@$group->slug}}" type="button" class="btn btn-danger"><i class="fa fa-heart" aria-hidden="true"></i>&nbsp; Wishlist &nbsp; <span class="badge badge-pill badge-light" id="countphotowtb"><font color="#000000">{{count((array) session('cartwtb')) }}</font></span></a>
                            <a href="{{ route('search') }}/{{@$group->slug}}" type="button" class="btn btn-success"><i class="fa fa-search" aria-hidden="true"></i>&nbsp; Looking for photocards &nbsp; </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header" style="padding-top: 5px;border-bottom: 1px solid #ffffff;">
                        <h5>&nbsp;</h5>
                    </div>
                    <div class="card-body">
                        <!-- photocard carousel-->
                        <div class="col-sm-12">
                            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    <!-- dinamis-->
                                        <div class="carousel-item active">
                                            <img class="img-fluid card-img-top" src="{{$pic_front}}" style="height: 100%; align:center">"
                                        </div>
                                        <div class="carousel-item">
                                            <img class="img-fluid card-img-top" src="{{$pic_back}}" style="height: 100%; align:center">
                                        </div>
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev"><span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="sr-only">Previous</span></a>
                                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next"><span class="carousel-control-next-icon" aria-hidden="true"></span><span class="sr-only">Next</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="float-right">
                            <button onClick="Data.addPhotocard('{{$photocard->id}}')" class="btn btn-info"><i class="fa fa-check-circle" aria-hidden="true"></i>&nbsp; My Photocard &nbsp;</button>
                            <button onClick="Data.addPhotocardwtb('{{$photocard->id}}')" class="btn btn-danger"><i class="fa fa-check"></i>&nbsp; My Wishlist &nbsp;</button>
                        </div>
                    </div>
                    <div class="card-body">
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">INFO</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">DISQUS</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                    <div class="card-body table-border-style">
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                <tbody>
                                                    <tr>
                                                        <td>Nama</td>
                                                        <td>{{@$photocard->memberp->member_name}}</td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Group</td>
                                                        <td>{{@$photocard->groupp->group_name}}</td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Album</td>
                                                        <td><a href="{{config('app.url')}}/app/{{@$photocard->groupp->slug}}/{{@$photocard->albump->slug}}">{{@$photocard->albump->album}}</a></td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td>From</td>
                                                        <td>
                                                            <a href="{{config('app.url')}}/appc/{{@$photocard->groupp->slug}}/{{@$photocard->albump->slug}}/{{@$photocard->channelp->id}}">{{@$photocard->albump->album}}
                                                                {{@$photocard->channelp->channel}}
                                                                @switch(@$photocard->channelp->kategori_id)
                                                                    @case(0)
                                                                        <i>(Album Inclusions)</i>
                                                                        @break
                                                                    @case(1)
                                                                        <i>(Fansign/POB)</i>
                                                                        @break
                                                                    @default
                                                                        <i>(Other Photocard)</i>
                                                                @endswitch
                                                            </a>
                                                        </td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <b>Detail</b>
                                    <hr>
                                    <div class="alert alert-warning" role="alert">
                                        <p class="mb-0">
                                            {!!$photocard->credit!!}
                                        </p>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                    <p class="mb-0">
                                        <div id="disqus_thread"></div>
                                    </p>
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
        var Data = {
            "getPhotocard" : function(photocard_id){
                $.ajax({
                    url: "{{config('app.url')}}"+"/detail/" + photocard_id,
                    type:  'get',
                    dataType: "json"
                }).done(function(response){
                    $("#myModal").modal('hide');
                    $("#myModal .carousel-inner").html(response.photocard_detail);
                    $("#myModal .info").html(response.info);
                    $("#myModal .wts").html(response.wts);
                    $("#myModal .trade").html(response.trade);
                    $("#myModal").modal('show');
                });
            },
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
                        $("#myModal").modal('hide');
                    }
                }).done(function(response){
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
                        $("#myModal").modal('hide');
                    }
                }).done(function(response){
                })
            },
            "addPhotocardtrwant" : function(photocard_id){
                $.ajax({
                    url:"{{config('app.url')}}/tmp/add-to-cart-trwant" + '/' + photocard_id,
                    type:  'get',
                    dataType: "json",
                    beforeSend: function() {
                        $("#loading-image").show();
                    },
                    success: function(response) {
                        $('span#countphototrwant').html(response.countphoto);
                        $("#myModal").modal('hide');
                    }
                }).done(function(response){
                })
            },
            "addPhotocardtrhave" : function(photocard_id){
                $.ajax({
                    url:"{{config('app.url')}}/tmp/add-to-cart-trhave" + '/' + photocard_id,
                    type:  'get',
                    dataType: "json",
                    beforeSend: function() {
                        $("#loading-image").show();
                    },
                    success: function(response) {
                        $('span#countphototrhave').html(response.countphoto);
                        $("#myModal").modal('hide');
                    }
                }).done(function(response){
                })
            }
        };

        /**
        *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
        *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables    */

        var disqus_config = function () {
            this.page.url = '{{config('app.url')}}/{{$url}}';  // Replace PAGE_URL with your page's canonical URL variable
            this.page.identifier = '{{$page_id}}'; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
        };
        (function() { // DON'T EDIT BELOW THIS LINE
        var d = document, s = d.createElement('script');
        s.src = 'https://kdreamcard.disqus.com/embed.js';
        s.setAttribute('data-timestamp', +new Date());
        (d.head || d.body).appendChild(s);
        })();
    </script>
    <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
</body>
</html>
