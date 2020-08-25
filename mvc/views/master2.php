<!DOCTYPE html>
<html lang="en">
<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		<title>Hoang Tam Mobile - Manage</title>

		<!-- Google font -->
		<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

		<!-- Bootstrap -->
		<link type="text/css" rel="stylesheet" href="<?php echo $data["url"]; ?>css/bootstrap.min.css"/>

		<!-- Slick -->
		<link type="text/css" rel="stylesheet" href="<?php echo $data["url"]; ?>css/slick.css"/>
		<link type="text/css" rel="stylesheet" href="<?php echo $data["url"]; ?>css/slick-theme.css"/>

		<!-- nouislider -->
		<link type="text/css" rel="stylesheet" href="<?php echo $data["url"]; ?>css/nouislider.min.css"/>

		<!-- Font Awesome Icon -->
		<link rel="stylesheet" href="<?php echo $data["url"]; ?>css/font-awesome.min.css">

		<!-- Custom stlylesheet -->
		<link type="text/css" rel="stylesheet" href="<?php echo $data["url"]; ?>css/style.css"/>

		<!-- Datatable -->
		<link rel="stylesheet" href="<?php echo $data["url"]; ?>datatable/css/bootstrap.min.css">
		<script src="<?php echo $data["url"]; ?>datatable/js/jquery.min.js"></script>
		<script src="<?php echo $data["url"]; ?>datatable/js/bootstrap.min.js"></script>

		<link rel="stylesheet" type="text/css" href="<?php echo $data["url"]; ?>datatable/datatables.min.css"/>

		<script type="text/javascript" src="<?php echo $data["url"]; ?>datatable/datatables.min.js"></script>
	</head>
	
	<body>
		<!-- HEADER -->
		<header>
			<!-- TOP HEADER -->
			<div id="top-header">
				<div class="container">
					<ul class="header-links pull-left">
						<li><a href="tel:0327291328"><i class="fa fa-phone"></i> +84-327-291-328</a></li>
						<li><a href="mailto: didonghoangtam342@gmail.com" target="_blank"><i class="fa fa-envelope-o"></i> didonghoangtam342@gmail.com</a></li>
						<li><a href="https://goo.gl/maps/7VQX3MQUAAd7LMSB6" target="_blank"><i class="fa fa-map-marker"></i> 1 Ly Tu Trong - Tan An - Ninh Kieu - Can Tho - Viet Nam</a></li>
					</ul>
					<ul class="header-links pull-right">
						<?php if(isset($_SESSION["username"]["id"])){ ?>
							<li><a href="<?= $data["url"] ?>Home/Log_Out"><i class="fa fa-sign-out"></i> Sign out</a></li>
							<li><a href="<?= $data["url"] ?>Home/Display_Personal_Information"><i class="fa fa-user-o"></i> <?= $_SESSION["username"]["name"]; ?></a></li>
						<?php } ?>	
					</ul>
				</div>
			</div>
			<!-- /TOP HEADER -->

			<!-- MAIN HEADER -->
			<div id="header">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">
						<!-- LOGO -->
						<div class="col-md-3">
							<div class="header-logo">
								<a href="<?= $data["url"]; ?>Home" class="logo">
									<img src="<?= $data["url"]; ?>img/logodidong.png" alt="">
								</a>
							</div>
						</div>
						<!-- /LOGO -->
						<div class="col-md-9 header-ctn clearfix" style="color:white"><h1><i class="fa fa-home"> Website management system Hoang Tam Mobile</h1></i></div>
					</div>
				</div>
			</div>
									
		</header>

		<nav id="navigation">
			<!-- container -->
			<div class="container">
				<!-- responsive-nav -->
				<div id="responsive-nav">
					<!-- NAV -->
					
					<ul class="main-nav nav navbar-nav">
						<li <?php if($data["act"]=="home") echo "class='active'"; ?>><a href="<?= $data["url"]; ?>Home"><i class="fa fa-home"> Home</i></a></li>
						<li <?php if($data["act"]=="product") echo "class='active'"; ?>><a href="<?= $data["url"]; ?>Products"><i class="fa fa-dropbox"> Products</i></a></li>
						<li <?php if($data["act"]=="customer") echo "class='active'"; ?>><a href="<?= $data["url"]; ?>Customers"><i class="fa fa-users"> Customers</i></a></li>
						<li <?php if($data["act"]=="brand") echo "class='active'"; ?>><a href="<?= $data["url"]; ?>Brands"><i class="fa fa-apple"> Brands</i></a></li>
						<li <?php if($data["act"]=="order") echo "class='active'"; ?>><a href="<?= $data["url"]; ?>Order"><i class="fa fa-pencil-square-o"> Order</i></a></li>
						<li <?php if($data["act"]=="sale") echo "class='active'"; ?>><a href="<?= $data["url"]; ?>Sale"><i class="fa fa-money"> Sale</i></a></li>
						<li <?php if($data["act"]=="payment") echo "class='active'"; ?>><a href="<?= $data["url"]; ?>Payments"><i class="fa fa-credit-card"> Payments</i></a></li>
						<li <?php if($data["act"]=="comment") echo "class='active'"; ?>><a href="<?= $data["url"]; ?>Comments"><i class="fa fa-thumbs-o-up"> Comments</i></a></li>
					</ul>
					<!-- /NAV -->
				</div>
				<!-- /responsive-nav -->
			</div>
			<!-- /container -->
		</nav>
        <!-- /NAVIGATION -->
        
		<?php require_once "./mvc/views/pages/".$data["page"].".php"; ?>

	<!-- FOOTER -->
	<footer id="footer">
		<!-- top footer -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-6 col-xs-6">
						<div class="footer">
							<h3 class="footer-title">Hoang Tam Mobile</h3>
							<p>Hoang Tam Mobile ensures peace of mind when shopping - reputation - quality.</p>
							<ul class="footer-links">
								<li><a href="https://goo.gl/maps/7VQX3MQUAAd7LMSB6" target="_blank"><i class="fa fa-map-marker"></i>1 Ly Tu Trong - Tan An - Ninh Kieu - Can Tho - Viet Nam</a></li>
								<li><a href="tel:0327291328"><i class="fa fa-phone"></i>+84-327-291-328</a></li>
								<li><a href="mailto: didonghoangtam342@gmail.com" target="_blank"><i class="fa fa-envelope-o"></i>didonghoangtam342@gmail.com</a></li>
							</ul>
						</div>
					</div>

					<div class="col-md-6 col-xs-6">
						<div class="footer">
							<h3 class="footer-title">Service</h3>
							<ul class="footer-links">
								<li><a href="#">Guarantee</a></li>
								<li><a href="#">Transport</a></li>
								<li><a href="#">Customer care</a></li>
								<li><a href="#">Technical assistance</a></li>
							</ul>
						</div>
					</div>

					
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /top footer -->

		<!-- bottom footer -->
		<div id="bottom-footer" class="section">
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12 text-center">
						<ul class="footer-payments">
							<li><a href="#"><i class="fa fa-cc-visa"></i></a></li>
							<li><a href="#"><i class="fa fa-credit-card"></i></a></li>
							<li><a href="#"><i class="fa fa-cc-paypal"></i></a></li>
							<li><a href="#"><i class="fa fa-cc-mastercard"></i></a></li>
							<li><a href="#"><i class="fa fa-cc-discover"></i></a></li>
							<li><a href="#"><i class="fa fa-cc-amex"></i></a></li>
						</ul>
						
					</div>
				</div>
					<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /bottom footer -->
	</footer>
	<!-- /FOOTER -->


</body>
</html>
