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
    {{-- <script async src="https://www.googletagmanager.com/gtag/js?id=G-1VQDNKKF6L"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-1VQDNKKF6L');
    </script> --}}

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
							{{-- <a href="{{ route('cart') }}" class="btn btn-primary"> --}}
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
                        <h5>Make a Custome Template</h5>
                        <div class="float-right">
                            <a href="{{ route('cart') }}" type="button" class="btn btn-info"><i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp; WTS &nbsp; <span class="badge badge-pill badge-danger" id="countphoto">{{count((array) session('cart')) }}</span></a>
                            <a href="{{ route('cartwtb') }}" type="button" class="btn btn-warning"><i class="feather mr-2 icon-camera" aria-hidden="true"></i>&nbsp; WTB &nbsp; <span class="badge badge-pill badge-danger" id="countphotowtb">{{count((array) session('cartwtb')) }}</span></a>
                            {{-- <button type="button" class="btn btn-success"><i class="feather mr-2 icon-check-circle"></i>Trade</button> --}}
                            <a href="{{ route('carttr') }}" type="button" class="btn btn-success"><i class="feather mr-2 icon-camera" aria-hidden="true"></i>&nbsp; Trade &nbsp;<span class="badge badge-pill badge-danger" id="countphototrhave">{{count((array) session('carttrhave')) }}</span> <span class="badge badge-pill badge-info" id="countphototrwant">{{count((array) session('carttrwant')) }}</span> </a>
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
                                                                    <a href="#"  type="button" class="btn btn-default text" onClick="Data.getPhotocard('{{$kb->id}}')"><i class="feather mr-2 icon-search"></i></a>
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

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                {{-- <h5 class="modal-title h4" id="myLargeModalLabel">Photocard</h5> --}}
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner">
                                        <!-- dinamis-->
                                    </div>
                                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev"><span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="sr-only">Previous</span></a>
                                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next"><span class="carousel-control-next-icon" aria-hidden="true"></span><span class="sr-only">Next</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Info</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="pills-tabContent">
                                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                            <p class="mb-0 info">
                                            </p>
                                        </div>
                                    </div>
                                    <div class="tab-content" id="pills-tabContent">
                                        <div class="float-left wts">
                                         </div>
                                    </div>
                                    <div style="padding-top: 1opx;padding-top: 50px;"></div>
                                    <div class="tab-content" id="pills-tabContent">
                                        <div class="float-left trade">
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
</script>

</body>
</html>
