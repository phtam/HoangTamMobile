<!DOCTYPE html>
<html lang="en">
<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		<title>Hoang Tam Mobile</title>

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

		<script type="text/javascript" src="//code.jquery.com/jquery-1.8.3.js"></script>
		<!-- Ajax -->
		<script>
			// Add a product to the cart
			function add_to_cart($id, $qty){
				
				var $url = "<?= $this->getBaseUrl()."Home/Add_To_Cart" ?>";

				$.ajax({
					type: 'POST',
					url: $url,
					data: {sp_ma:$id, sp_qty:$qty},
					success: function(data) {
						if(data == 'false') 
						{
							alert('Add to cart failed!');
						}else{
							alert(data);		
						}
					},
					error: function() {
						alert("Add to cart failed!");
					}
				});
			}

			// Add more products to the cart
			function add_to_cart_many_product($id){
				var $url = "<?php echo $this->getBaseUrl()."Home/Add_To_Cart" ?>";
				var $qty = document.getElementById("qty_buy").value;
				$.ajax({
					type: 'POST',
					url: $url,
					data: {sp_ma:$id, sp_qty:$qty},
					success: function(data) {
						if(data == 'false') 
						{
							alert('Add to cart failed!');
						}else{
							alert(data);		
						}
					},
					error: function() {
						alert("Add to cart failed!");
					}
				});
			}

			// Count product 
			function count_products(){
				var $url = "<?php echo $this->getBaseUrl()."Home/Count_Products" ?>";

				$.ajax({
					type: 'POST',
					url: $url,
					success: function(data) {
						if(data == 'false') 
						{
							document.getElementById("cart_qty").innerHTML = 0;
						}else{
							document.getElementById("cart_qty").innerHTML = data;
						}
					},
					error: function() {
						alert("Add to cart failed!");
					}
				});
			}

			// Add product to compare
			function Add_Product_To_Compare(str){
				alert("Product added to compare");
				window.location='<?php echo $data['url']; ?>Home/Add_Product_To_Compare/'+str;
			}

			// Display Detail Product
			function display_Detail(str){
				window.location='<?php echo $data['url']; ?>Home/display_Detail_Product/'+str;
			}
			// fFormat Currency
			function formatNumber(nStr) {
					nStr += '';
					x = nStr.split('.');
					x1 = x[0];
					x2 = x.length > 1 ? '.' + x[1] : '';
					var rgx = /(\d+)(\d{3})/;
					while (rgx.test(x1)) {
						x1 = x1.replace(rgx, '$1' + ',' + '$2');
					}
					return x1 + x2;
				}

				
		</script>
		
		

		<!-- /Ajax -->
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
							<li><a href="<?= $data["url"] ?>Home/Display_Personal_Information"><i class="fa fa-user-o"></i> Hi, <?= $_SESSION["username"]["name"]; ?></a></li>
						<?php }else{ ?>
							<li><a href="<?php echo $data["url"]; ?>Home/display_Sign_Up"><i class="fa fa-edit"></i> Sign up</a></li>
							<li><a href="<?php echo $data["url"]; ?>Home/display_LogIn"><i class="fa fa-sign-in"></i> Sign in</a></li>
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
								<a href="<?php echo $data["url"]; ?>Home" class="logo">
									<img src="<?php echo $data["url"]; ?>img/logodidong.png" alt="">
								</a>
							</div>
						</div>
						<!-- /LOGO -->

						<!-- SEARCH BAR -->
						<div class="col-md-6">
							<div class="header-search">
								<form action="<?php echo $data["url"]; ?>Home/Search" method="POST">
									<select class="input-select" name="sl_search">
										<option value="0">All</option>
										<?php while($row = mysqli_fetch_array($data["brand1"])){ ?>
										<option value="<?= $row["brd_id"] ?>"><?= $row["brd_name"] ?></option>
										<?php } ?>										
									</select>
									<input class="input" placeholder="What are you looking for ..." name="txt_search" id="txt_search">
									<button class="search-btn" name="btn_search" id="btn_search" >Search</button>
								</form>
							</div>
						</div>
						<!-- /SEARCH BAR -->

						<!-- ACCOUNT -->
						<div class="col-md-3 clearfix">
							<div class="header-ctn">
								
								<?php if(isset($_SESSION["username"]["id"]) && $_SESSION["username"]["role"]==0){ ?>
								<div>
									<a href="<?php echo $data["url"]; ?>Home/Manage">
										<i class="fa fa-user-circle-o"></i>
										<span>Manage</span>
									</a>
								</div>
								<?php } ?>
								

								
								<div class="dropdown">
									<a href="<?= $data["url"] ?>Home/display_Cart">
										<i class="fa fa-shopping-cart"></i>
										<span>Cart</span>
										<div class="qty" ><p id="cart_qty"><?php if(isset($_SESSION["total_qty"])){ echo $_SESSION["total_qty"];}else{ echo 0;} ?></p></div>
									</a>
								</div>

								
								
								<!-- Menu Toogle -->
								<div class="menu-toggle">
									<a href="#">
										<i class="fa fa-bars"></i>
										<span>Menu</span>
									</a>
								</div>
								<!-- /Menu Toogle -->
							</div>
						</div>
						<!-- /ACCOUNT -->
					</div>
					<!-- row -->
				</div>
				<!-- container -->
			</div>
			<!-- /MAIN HEADER -->
		</header>
                <!-- /HEADER -->
                <!-- NAVIGATION -->
		<nav id="navigation">
			<!-- container -->
			<div class="container">
				<!-- responsive-nav -->
				<div id="responsive-nav">
					<!-- NAV -->
					
					<ul class="main-nav nav navbar-nav">
						<li <?php if($data["act"]=="0") echo "class='active'"; ?>><a href="<?php echo $data["url"]; ?>Home"> Home</a></li>
						<?php while($row = mysqli_fetch_array($data["brand2"])){ ?>
						<li <?php if($data["act"]== $row["brd_id"]) echo "class='active'"; ?>><a href="<?php echo $data["url"]; ?>Home/display_Product/<?= $row["brd_id"]; ?>"><?= $row["brd_name"]; ?></a></li>
						<?php } ?>
						<?php if(isset($_SESSION["username"]["id"])){ ?>
						<li <?php if($data["act"]== "bill") echo "class='active'"; ?>><a href="<?= $data["url"] ?>Home/display_The_Bills_Of_Customer"><span> Your order</span></a></li>
						<?php } ?>
						<li <?php if($data["act"]== "compare") echo "class='active'"; ?>><a href="<?= $data["url"] ?>Home/display_Compare"><span> Compare</span></a></li>
					</ul>
					<!-- /NAV -->
					</div>
				</div>
				<!-- /responsive-nav -->
			</div>
			<!-- /container -->
		</nav>
        <!-- /NAVIGATION -->
        
		<?php require_once "./mvc/views/pages/".$data["page"].".php"; ?>

		<!-- NEWSLETTER -->
		<div id="newsletter" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<div class="newsletter">
							<p>Sign Up for the <strong>NEWSLETTER</strong></p>
							<form method="POST" action="<?= $data["url"]; ?>Home/Registration">
								<input class="input" type="email" placeholder="Enter your Email" name="txtEmail">
								<button type="submit" class="newsletter-btn" name="btnSubmit"><i class="fa fa-envelope"></i> Sign up</button>
							</form>
							<ul class="newsletter-follow">
								<li>
									<a href="https://www.facebook.com/hoangtam.mio" target="_blank"><i class="fa fa-facebook"></i></a>
								</li>
								<li>
									<a href="https://twitter.com/explore" target="_blank"><i class="fa fa-twitter"></i></a>
								</li>
								<li>
									<a href="https://www.instagram.com/hoangtam342/" target="_blank"><i class="fa fa-instagram"></i></a>
								</li>
								<li>
									<a href="https://www.pinterest.com/" target="_blank"><i class="fa fa-pinterest"></i></a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /NEWSLETTER -->


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
			
	<!-- jQuery Plugins -->
	<script src="<?php echo $data["url"]; ?>js/jquery.min.js"></script>
	<script src="<?php echo $data["url"]; ?>js/bootstrap.min.js"></script>
	<script src="<?php echo $data["url"]; ?>js/slick.min.js"></script>
	<script src="<?php echo $data["url"]; ?>js/nouislider.min.js"></script>
	<script src="<?php echo $data["url"]; ?>js/jquery.zoom.min.js"></script>
	<script src="<?php echo $data["url"]; ?>js/main.js"></script>
	


</body>
</html>
