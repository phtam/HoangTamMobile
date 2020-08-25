<div class="section">
	<div class="container">
		<div class="row">

			<?php while($row =mysqli_fetch_array($data["sale"])){ ?>
			<div class="col-md-4 col-xs-6">
				<div class="shop">
					<div class="shop-img">
					<img src="<?php echo $data["url"]; ?>public/images_sale/<?php echo $row["sal_poster"]; ?>"/>
					</div>
					<div class="shop-body">
						<h3><?= $row["sal_name"]; ?></h3>
						<a href="#sale" class="cta-btn">Buy now <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>
			</div>
			<?php } ?>

		</div>
	</div>
</div>

<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">

			<!-- section title -->
			<div class="col-md-12">
				<div class="section-title">
					<h3 class="title">New Products</h3>
				</div>
			</div>
			<!-- /section title -->
			
			<!-- Products tab & slick -->
			<div class="col-md-12">
				<div class="row">
					<div class="products-tabs">
						<!-- tab -->
						<div id="tab1" class="tab-pane active">
							<div class="products-slick" data-nav="#slick-nav-1">
							
							<?php while($row = mysqli_fetch_array($data["newproduct"])){ ?>
								<!-- product -->
								<div class="product">
									<div class="product-img">
										<img src="<?= $data["url"]; ?>public/images/<?= $row["img_file_name"]; ?>" alt="">
										<div class="product-label">
											<span class="new">NEW</span>
										</div>
									</div>
									<div class="product-body">
										<p class="product-category"><?= $row["brd_name"]; ?></p>
										<h3 class="product-name"><a href="<?php echo $data["url"]; ?>Home/display_Detail_Product/<?= $row["pro_id"];  ?>"><?= $row["pro_name"];  ?></a></h3>
										<h4 class="product-price"><script>document.write(formatNumber(<?= $row["pro_price"];  ?>));</script><span style="font-size: 10px;"> VND</span><del class="product-old-price"><script> document.write(formatNumber(<?= $row["pro_old_price"];  ?>));</script></del></h4>										
										<div class="product-rating">
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
										</div>
										<div class="product-btns">
											<button class="add-to-compare" onclick="Add_Product_To_Compare(<?= $row['pro_id']; ?>)"><i class="fa fa-exchange"></i><span class="tooltipp">compare</span></button>
											<button class="quick-view" onclick="display_Detail(<?= $row['pro_id']; ?>)"><i class="fa fa-eye"></i><span class="tooltipp">detail</span></button>
										</div>
									</div>
									<div class="add-to-cart">
										<button class="add-to-cart-btn" onclick="add_to_cart(<?= $row['pro_id']; ?>,1); count_products();"><i class="fa fa-shopping-cart"></i> add to cart</button>
									</div>
								</div>
							<?php } ?>
								<!-- /product -->

								
							</div>
							<div id="slick-nav-1" class="products-slick-nav"></div>
						</div>
						<!-- /tab -->
					</div>
				</div>
			</div>
			<!-- Products tab & slick -->
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /SECTION -->

		<script>
			
			<?php while($row = mysqli_fetch_array($data["hotdeal"])){  ?>
			var sale_time = "<?php echo $row['sal_end_date'];?>";
			var sale_name = "<?php echo $row['sal_name'];?>";
			var sale_content = "<?php echo $row['sal_content'];?>";
			<?php } ?>
			var countDownDate = new Date(sale_time).getTime();
						
			var x = setInterval(function() {
				
				var now = new Date().getTime();
	
				var distance = countDownDate - now;
	
				var days = Math.floor(distance / (1000 * 60 * 60 * 24));
				var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
				var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
				var seconds = Math.floor((distance % (1000 * 60)) / 1000);
				
				document.getElementById("Day").innerHTML 		= days;
				document.getElementById("Hour").innerHTML 		= hours;
				document.getElementById("Minute").innerHTML 	= minutes;
				document.getElementById("Seconds").innerHTML 	= seconds;
				document.getElementById("SaleName").innerHTML 	= sale_name;
				document.getElementById("Content").innerHTML 	= sale_content;

				document.getElementById("c_Day").innerHTML 		= (days 	>	1)? "Days" 		: "Day" ;
				document.getElementById("c_Hour").innerHTML 	= (hours 	>	1)? "Hours" 	: "Hour" ;
				document.getElementById("c_Minute").innerHTML 	= (minutes	>	1)? "Minutes" 	: "Minute" ;
				document.getElementById("c_Seconds").innerHTML 	= (seconds	>	1)? "Seconds" 	: "Second" ;
				

				if (distance < 0) {
				clearInterval(x);
				document.getElementById("Noti").innerHTML = "Promotion time has ended";
				}
			}, 1000);
		</script>


		<!-- HOT DEAL SECTION -->
		<div id="hot-deal" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<div class="hot-deal">
							<ul class="hot-deal-countdown">
								<li>
									<div>
										<h3 id="Day"></h3>
										<span id="c_Day"></span>
									</div>
								</li>
								<li>
									<div>
										<h3 id="Hour"></h3>
										<span id="c_Hour"></span>
									</div>
								</li>
								<li>
									<div>
										<h3 id="Minute"></h3>
										<span id="c_Minute"></span>
									</div>
								</li>
								<li>
									<div>
										<h3 id="Seconds"></h3>
										<span id="c_Seconds"></span>
									</div>
								</li>
							</ul>
							<h2 class="text-uppercase" id="Noti"></h2>
							<h2 class="text-uppercase" id="SaleName"></h2>
							<p id="Content"></p>
							<a class="primary-btn cta-btn" href="#sale">Buy now</a>
						</div>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /HOT DEAL SECTION -->

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">

					<!-- section title -->
					<div class="col-md-12">
						<div class="section-title">
							<h3 class="title" id="sale">Sale</h3>
						</div>
					</div>
					<!-- /section title -->

					<!-- Products tab & slick -->
					<div class="col-md-12">
						<div class="row">
							<div class="products-tabs">
								<!-- tab -->
								<div id="tab2" class="tab-pane fade in active">
									<div class="products-slick" data-nav="#slick-nav-2">
										<?php while($row = mysqli_fetch_array($data["saleproduct"])){ ?>
										<!-- product -->
										<div class="product">
											<div class="product-img">
												<img src="<?php echo $data["url"]."public/images/".$row["img_file_name"]; ?>" alt="">
												<div class="product-label">
													<span class="sale"><?= $row["sal_name"]; ?></span>
												</div>
											</div>
											<div class="product-body">
												<p class="product-category"><?= $row["brd_name"]; ?></p>
												<h3 class="product-name"><a href=""><?= $row["pro_name"]; ?></a></h3>
												<h4 class="product-price"><script>document.write(formatNumber(<?= $row["pro_price"];  ?>));</script><span style="font-size: 10px;"> VND</span><del class="product-old-price"><script> document.write(formatNumber(<?= $row["pro_old_price"];  ?>));</script></del></h4>	
												<div class="product-rating">
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
												</div>
												<div class="product-btns">
													<button class="add-to-compare" onclick="Add_Product_To_Compare(<?= $row['pro_id']; ?>)"><i class="fa fa-exchange"></i><span class="tooltipp">compare</span></button>
													<button class="quick-view" onclick="display_Detail(<?= $row['pro_id']; ?>)"><i class="fa fa-eye"></i><span class="tooltipp">detail</span></button>
												</div>
											</div>
											<div class="add-to-cart">
												<button class="add-to-cart-btn" onclick="add_to_cart(<?= $row['pro_id']; ?>,1); count_products();"><i class="fa fa-shopping-cart"></i> add to cart</button>
											</div>
										</div>
										<?php } ?>
										<!-- /product -->

										
									</div>
									<div id="slick-nav-2" class="products-slick-nav"></div>
								</div>
								<!-- /tab -->
							</div>
						</div>
					</div>
					<!-- /Products tab & slick -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-4 col-xs-6">
						<div class="section-title">
							<h4 class="title">iPhone</h4>
							<div class="section-nav">
								<div id="slick-nav-3" class="products-slick-nav"></div>
							</div>
						</div>

						<div class="products-widget-slick" data-nav="#slick-nav-3">
							<div>
								<!-- product widget -->
								<?php while($row = mysqli_fetch_array($data["saleiphone1"])){ ?>
								<div class="product-widget">
									<div class="product-img">
										<img src="<?= $data["url"]; ?>public/images/<?= $row["img_file_name"]; ?>" alt="">
									</div>
									<div class="product-body">
										<p class="product-category"><?= $row["brd_name"]; ?></p>
										<h3 class="product-name"><a href="<?php echo $data["url"]; ?>Home/display_Detail_Product/<?= $row["pro_id"];  ?>"><?= $row["pro_name"]; ?></a></h3>
										<h4 class="product-price"><script>document.write(formatNumber(<?= $row["pro_price"];  ?>));</script><span style="font-size: 10px;"> VND</span><del class="product-old-price"><script> document.write(formatNumber(<?= $row["pro_old_price"];  ?>));</script></del></h4>	
									</div>
								</div>
								<?php } ?>
								<!-- /product widget -->

							</div>

							<div>
								<!-- product widget -->
								<?php while($row = mysqli_fetch_array($data["saleiphone2"])){ ?>
								<div class="product-widget">
									<div class="product-img">
										<img src="<?= $data["url"]; ?>public/images/<?= $row["img_file_name"]; ?>" alt="">
									</div>
									<div class="product-body">
										<p class="product-category"><?= $row["brd_name"]; ?></p>
										<h3 class="product-name"><a href="<?php echo $data["url"]; ?>Home/display_Detail_Product/<?= $row["pro_id"];  ?>"><?= $row["pro_name"]; ?></a></h3>
										<h4 class="product-price"><script>document.write(formatNumber(<?= $row["pro_price"];  ?>));</script><span style="font-size: 10px;"> VND</span><del class="product-old-price"><script> document.write(formatNumber(<?= $row["pro_old_price"];  ?>));</script></del></h4>	
									</div>
								</div>
								<?php } ?>
								<!-- /product widget -->
								
							</div>
						</div>
					</div>

					<div class="col-md-4 col-xs-6">
						<div class="section-title">
							<h4 class="title">Samsung</h4>
							<div class="section-nav">
								<div id="slick-nav-4" class="products-slick-nav"></div>
							</div>
						</div>

						<div class="products-widget-slick" data-nav="#slick-nav-4">
							<div>
								<!-- product widget -->
								<?php while($row = mysqli_fetch_array($data["salesamsung1"])){ ?>
								<div class="product-widget">
									<div class="product-img">
										<img src="<?= $data["url"]; ?>public/images/<?= $row["img_file_name"]; ?>" alt="">
									</div>
									<div class="product-body">
										<p class="product-category"><?= $row["brd_name"]; ?></p>
										<h3 class="product-name"><a href="<?php echo $data["url"]; ?>Home/display_Detail_Product/<?= $row["pro_id"];  ?>"><?= $row["pro_name"]; ?></a></h3>
										<h4 class="product-price"><script>document.write(formatNumber(<?= $row["pro_price"];  ?>));</script><span style="font-size: 10px;"> VND</span><del class="product-old-price"><script> document.write(formatNumber(<?= $row["pro_old_price"];  ?>));</script></del></h4>	
									</div>
								</div>
								<?php } ?>
								<!-- /product widget -->

							</div>

							<div>
								<!-- product widget -->
								<?php while($row = mysqli_fetch_array($data["salesamsung2"])){ ?>
								<div class="product-widget">
									<div class="product-img">
										<img src="<?= $data["url"]; ?>public/images/<?= $row["img_file_name"]; ?>" alt="">
									</div>
									<div class="product-body">
										<p class="product-category"><?= $row["brd_name"]; ?></p>
										<h3 class="product-name"><a href="<?php echo $data["url"]; ?>Home/display_Detail_Product/<?= $row["pro_id"];  ?>"><?php echo $row["pro_name"]; ?></a></h3>
										<h4 class="product-price"><script>document.write(formatNumber(<?= $row["pro_price"];  ?>));</script><span style="font-size: 10px;"> VND</span><del class="product-old-price"><script> document.write(formatNumber(<?= $row["pro_old_price"];  ?>));</script></del></h4>	
									</div>
								</div>
								<?php } ?>
								<!-- /product widget -->

							</div>
						</div>
					</div>

					<div class="clearfix visible-sm visible-xs"></div>

					<div class="col-md-4 col-xs-6">
						<div class="section-title">
							<h4 class="title">OPPO</h4>
							<div class="section-nav">
								<div id="slick-nav-5" class="products-slick-nav"></div>
							</div>
						</div>

						<div class="products-widget-slick" data-nav="#slick-nav-5">
							<div>
								<!-- product widget -->
								<?php while($row = mysqli_fetch_array($data["saleoppo1"])){ ?>
								<div class="product-widget">
									<div class="product-img">
										<img src="<?= $data["url"]; ?>public/images/<?= $row["img_file_name"]; ?>" alt="">
									</div>
									<div class="product-body">
										<p class="product-category"><?= $row["brd_name"]; ?></p>
										<h3 class="product-name"><a href="<?php echo $data["url"]; ?>Home/display_Detail_Product/<?= $row["pro_id"];  ?>"><?= $row["pro_name"]; ?></a></h3>
										<h4 class="product-price"><script>document.write(formatNumber(<?= $row["pro_price"];  ?>));</script><span style="font-size: 10px;"> VND</span><del class="product-old-price"><script> document.write(formatNumber(<?= $row["pro_old_price"];  ?>));</script></del></h4>	
									</div>
								</div>
								<?php } ?>
								<!-- /product widget -->

							</div>

							<div>
								<!-- product widget -->
								<?php while($row = mysqli_fetch_array($data["saleoppo2"])){ ?>
								<div class="product-widget">
									<div class="product-img">
										<img src="<?= $data["url"]; ?>public/images/<?= $row["img_file_name"]; ?>" alt="">
									</div>
									<div class="product-body">
										<p class="product-category"><?= $row["brd_name"]; ?></p>
										<h3 class="product-name"><a href="<?php echo $data["url"]; ?>Home/display_Detail_Product/<?= $row["pro_id"];  ?>"><?= $row["pro_name"]; ?></a></h3>
										<h4 class="product-price"><script>document.write(formatNumber(<?= $row["pro_price"];  ?>));</script><span style="font-size: 10px;"> VND</span><del class="product-old-price"><script> document.write(formatNumber(<?= $row["pro_old_price"];  ?>));</script></del></h4>	
									</div>
								</div>
								<?php } ?>
								<!-- /product widget -->

							</div>
						</div>
					</div>

				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		