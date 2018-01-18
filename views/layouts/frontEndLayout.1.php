<?php 
Yii::$app->params['page_title'] = Yii::$app->params['page_title'] == '' ? $this->title : Yii::$app->params['page_title'];
Yii::$app->params['page_small_title'] = Yii::$app->params['page_small_title'] == '' ? '': Yii::$app->params['page_small_title'];
Yii::$app->params['page_meta_title'] = Yii::$app->params['page_meta_title'] == '' ? Yii::$app->params['page_title'] : Yii::$app->params['page_meta_title'];
?>
<!--
Author: Nbita
Author URL: bienngoc.com
License: bienngoc
License URL: bienngoc.com
-->
<!DOCTYPE HTML>
<html>
	<head>
		<title><?= Yii::$app->params['page_title'] ?> | Food house</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<script type="application/x-javascript"> 
			addEventListener("load", function() { 
				setTimeout(hideURLbar, 0); }, false);
				function hideURLbar(){ 
					window.scrollTo(0,1); 
				} 
		</script>
		<!-- //for-mobile-apps -->
		<link href="/front_end/css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
		<link href="/front_end/css/style.css" rel="stylesheet" type="text/css" media="all" />
		<!-- js -->
		<script src="/front_end/js/jquery-1.11.1.min.js"></script>
		<!-- //js -->
		<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
		<link href='//fonts.googleapis.com/css?family=Great+Vibes' rel='stylesheet' type='text/css'>
		<link href='//fonts.googleapis.com/css?family=Comfortaa:400,300,700' rel='stylesheet' type='text/css'>
	</head>

	<body>
		<!-- banner-body -->
		<div class="banner-body">
			<div class="container">
				<div class="banner-body-content">
				<div class="col-xs-3 banner-body-left">
					<div class="logo">
						<h1><a href="index.html">Great <span>Taste</span></a></h1>
					</div>
					<div class="top-nav">
						<nav class="navbar navbar-default">
							<!-- Brand and toggle get grouped for better mobile display -->
							<div class="navbar-header">
							<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
							</div>

							<!-- Collect the nav links, forms, and other content for toggling -->
							<div class="collapse navbar-collapse nav-wil" id="bs-example-navbar-collapse-1">
								<nav class="stroke">
									<ul class="nav navbar-nav">
										<li class="active"><a href="index.html"><i class="home"></i>Home</a></li>
										<li><a href="photos.html" class="hvr-underline-from-left"><i class="picture1"></i>Photos</a></li>
										<li><a href="blog.html" class="hvr-underline-from-left"><i class="edit1"></i>Blog</a></li>
										<li><a href="short-codes.html" class="hvr-underline-from-left"><i class="text-size1"></i>Short Codes</a></li>
										<li><a href="mail.html" class="hvr-underline-from-left"><i class="envelope1"></i>Mail US</a></li>
									</ul>
								</nav>
							</div>
							<!-- /.navbar-collapse -->
						</nav>
					</div>
				</div>
				<div class="col-xs-9 banner-body-right">
					<div class="wmuSlider example1">
						<div class="wmuSliderWrapper">
							<article style="position: absolute; width: 100%; opacity: 0;"> 
								<div class="banner-wrap">
									<div class="banner">
									</div>
								</div>
							</article>
							<article style="position: absolute; width: 100%; opacity: 0;"> 
								<div class="banner-wrap">
									<div class="banner1">
									</div>
								</div>
							</article>
							<article style="position: absolute; width: 100%; opacity: 0;"> 
								<div class="banner-wrap">
									<div class="banner2">
									</div>
								</div>
							</article>
						</div>
					</div>
						<script src="js/jquery.wmuSlider.js"></script> 
						<script>
							$('.example1').wmuSlider();         
						</script> 
					<div class="banner-bottom">
						<div class="col-md-4 banner-left">
							<div class="col-xs-3 banner-left1">
								<div class="banner-left11">
									<span> </span>
								</div>
							</div>
							<div class="col-xs-9 banner-right1">
								<h3>cupidatat proi</h3>
							</div>
							<div class="clearfix"> </div>
							<p>Excepteur sint occaecat cupidatat non proident, 
								sunt in culpa qui.</p>
						</div>
						<div class="col-md-4 banner-left">
							<div class="col-xs-3 banner-left1">
								<div class="banner-left22">
									<span> </span>
								</div>
							</div>
							<div class="col-xs-9 banner-right1">
								<h3>sint occaecat</h3>
							</div>
							<div class="clearfix"> </div>
							<p>Excepteur sint occaecat cupidatat non proident, 
								sunt in culpa qui.</p>
						</div>
						<div class="col-md-4 banner-left">
							<div class="col-xs-3 banner-left1">
								<div class="banner-left33">
									<span> </span>
								</div>
							</div>
							<div class="col-xs-9 banner-right1">
								<h3>cupida quisu</h3>
							</div>
							<div class="clearfix"> </div>
							<p>Excepteur sint occaecat cupidatat non proident, 
								sunt in culpa qui.</p>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
				<div class="clearfix"> </div>
				<div class="col-xs-3 banner-body-left">
					<div class="latest-news">
						<h2>Latest News</h2>
						<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
						<div class="panel panel-default">
							<div class="panel-heading" role="tab" id="headingOne">
							<h4 class="panel-title">
								<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
								Michael Vol
								</a>
							</h4>
							</div>
							<div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
							<div class="panel-body">
								Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry.
							</div>
							</div>
						</div>
						<div class="panel panel-default">
							<div class="panel-heading" role="tab" id="headingTwo">
							<h4 class="panel-title">
								<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
								Andrew Rich
								</a>
							</h4>
							</div>
							<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
							<div class="panel-body">
								Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry.
							</div>
							</div>
						</div>
						<div class="panel panel-default">
							<div class="panel-heading" role="tab" id="headingThree">
							<h4 class="panel-title">
								<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
								Rita Rock
								</a>
							</h4>
							</div>
							<div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
							<div class="panel-body">
								Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry.
							</div>
							</div>
						</div>
						</div>
						<div class="join">
							<a href="single.html">Learn More</a>
						</div>
						<h3>Benefits</h3>
						<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium.</p>
					</div>
				</div>
				<div class="col-xs-9 banner-body-right">
					<div class="msg-text">
						<div class="col-xs-2 msg-text-left">
							<span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
						</div>
						<div class="col-xs-10 msg-text-right">
							<p>But I must explain to you how all this mistaken idea of 
								denouncing pleasure and praising pain was born and I will give 
								you a complete account of the system.</p>
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="msg-text-bottom">
						<div class="col-md-4 msg-text-bottom-left">
							<figure class="effect-winston">
								<a href="single.html"><img src="images/4.jpg" alt=" " class="img-responsive" />
								<figcaption>
									
								</figcaption>		
								</a>
							</figure>

							<h3><a href="single.html">vel illum qui dolorem</a></h3>
							<p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, 
								consectetur, adipisci velit, sed quia.</p>
						</div>
						<div class="col-md-4 msg-text-bottom-left">
							<figure class="effect-winston">
								<a href="single.html"><img src="images/5.jpg" alt=" " class="img-responsive" />
								<figcaption>
									
								</figcaption>	
								</a>
							</figure>
							<h3><a href="single.html">quia dolor sit amet</a></h3>
							<p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, 
								consectetur, adipisci velit, sed quia.</p>
						</div>
						<div class="col-md-4 msg-text-bottom-left">
							<figure class="effect-winston">
								<a href="single.html"><img src="images/6.jpg" alt=" " class="img-responsive" />
								<figcaption>
									
								</figcaption>	
								</a>
							</figure>
							<h3><a href="single.html">porro quisquam est</a></h3>
							<p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, 
								consectetur, adipisci velit, sed quia.</p>
						</div>
						<div class="clearfix"> </div>
					</div>
				</div>
				<div class="clearfix"> </div>
				<div class="footer">
					<div class="footer-left">
						<ul>
							<li><a href="#">Privacy Policy</a>|</li>
							<li><a href="#">Terms of Use</a>|</li>
							<li><a href="mail.html">Contact Us</a></li>
						</ul>
						<p>© 2016 Great Taste. All rights reserved | Design by <a href="http://w3layouts.com">W3layouts</a></p>
					</div>
					<div class="footer-right">
						<ul class="social-nav model-3">
							<li><a href="#" class="icon icon-border facebook"></a></li>
							<li><a href="#" class="icon icon-border twitter"></a></li>
							<li><a href="#" class="icon icon-border googleplus"></a></li>
							<li><a href="#" class="icon icon-border github"></a></li>
							<li><a href="#" class="icon icon-border rss"></a></li>
						</ul>
					</div>
					<div class="clearfix"> </div>
				</div>
			</div>
			</div>
		</div>
	<!-- //banner-body -->
	<!-- for bootstrap working -->
		<script src="js/bootstrap.js"></script>
	<!-- //for bootstrap working -->
	</body>
</html>

