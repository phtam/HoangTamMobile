<?php while($row = mysqli_fetch_array($data["detail"])){ ?>
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<!-- Product main img -->
			
			<div class="col-md-5 col-md-push-2">
				<div id="product-main-img">
				<?php while($img = mysqli_fetch_array($data["image1"])){ ?>
					<div class="product-preview">
						<img src="<?=$data["url"]; ?>public/images/<?= $img["img_file_name"]; ?>" alt="">
					</div>
				<?php } ?>
					
				</div>
			</div>
			<!-- /Product main img -->

			<!-- Product thumb imgs -->
			<div class="col-md-2  col-md-pull-5">
				<div id="product-imgs">
				<?php while($img = mysqli_fetch_array($data["image2"])){ ?>
					<div class="product-preview">
						<img src="<?=$data["url"]; ?>public/images/<?= $img["img_file_name"]; ?>" alt="">
					</div>
				<?php } ?>
					
				</div>
			</div>
			<!-- /Product thumb imgs -->

			<!-- Product details -->
			<div class="col-md-5">
				<div class="product-details">
					<h2 class="product-name"><?=$row["pro_name"]; ?></h2>
					<div>
						<div class="product-rating">
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
						</div>
						
					</div>
					<div>
						<h3 class="product-price"><script>document.write(formatNumber(<?= $row["pro_price"];  ?>));</script><span style="font-size: 10px;"> VND</span><del class="product-old-price"><script> document.write(formatNumber(<?= $row["pro_old_price"];  ?>));</script></del></h3>	
						<span class="product-available"><?php if($row["pro_quantity"]!=0){echo "In stock";}else{echo "Out of stock";} ?></span>
					</div>
					<p><?=$row["pro_short_desc"]; ?></p>

					<div class="add-to-cart">
						<div class="qty-label">
							Quantity:
							<div class="input-number">
								<input type="number" value="1" name="qty_buy" id="qty_buy">
								<span class="qty-up">+</span>
								<span class="qty-down">-</span>
							</div>
						</div>
						<button class="add-to-cart-btn" onclick="add_to_cart_many_product(<?= $row['pro_id']; ?>); count_products();"><i class="fa fa-shopping-cart"></i> add to cart</button>
					</div>

					<ul class="product-links">
						<li>Brand:</li>
						<li><a href="<?= $data["url"]; ?>Home/display_Product/<?=$row["brd_id"]; ?>"><?=$row["brd_name"]; ?></a></li>
					</ul>

					<ul class="product-links">
						<li>Sale:</li>
						<li><?= $row["sal_name"]; ?></li>
						<li><?= $row["sal_content"]; ?></li>
					</ul>

				

				</div>
			</div>
			<!-- /Product details -->

			<!-- Product tab -->
			<div class="col-md-12">
				<div id="product-tab">
					<!-- product tab nav -->
					<ul class="tab-nav">
						<li class="active"><a data-toggle="tab" href="#tab1">Detail</a></li>
						<li><a data-toggle="tab" href="#tab2">Specifications</a></li>
						<li><a data-toggle="tab" href="#tab3">Comments</a></li>
					</ul>
					<!-- /product tab nav -->

					<!-- product tab content -->
					<div class="tab-content">
						<!-- tab1  -->
						<div id="tab1" class="tab-pane fade in active">
							<div class="row">
								<div class="col-md-12">
									<p><?=$row["pro_desc"]; ?></p>
								</div>
							</div>
						</div>
						<!-- /tab1  -->

						
						<!-- tab3  -->
						<div id="tab3" class="tab-pane fade in">
							<div class="row">
								
								<!-- Reviews -->
								<div class="col-md-7">
									<div id="reviews">
										<ul class="reviews">
											<?php if(mysqli_num_rows($data["cmt"])>0){ ?>
											<?php while($cmt = mysqli_fetch_array($data["cmt"])){ ?>
											<li>
												<div class="review-heading">
													<h5 class="name"><?= $cmt["cmt_name"]; ?></h5>
													<p class="date"><?= $cmt["cmt_date"]; ?></p>
													
												</div>
												<div class="review-body">
													<p><?= $cmt["cmt_content"]; ?></p>
												</div>
											</li>
											<?php } ?>
											<?php } else { ?>
												<p><strong>There are no comments for this product.</strong></p>
												<?php } ?>
										</ul>
										
									</div>
								</div>
								<!-- /Reviews -->

								<!-- Review Form -->
								<div class="col-md-5">
									<div id="review-form">
										<form action="<?= $data["url"]; ?>Home/Add_Comment" class="review-form" method="POST" id="form_comment">
											<input class="input" type="text" placeholder="Name" name="txtName" value="<?php if(isset($_SESSION["username"]["name"])) echo $_SESSION["username"]["name"]; ?>">
											<input class="input" type="email" placeholder="Email" name="txtEmail" value="<?php if(isset($_SESSION["username"]["mail"])) echo $_SESSION["username"]["mail"]; ?>">
											<textarea class="input" placeholder="Content" name="txtContent"></textarea>
											<input type="hidden" name="pro_id" class="input" value="<?= $row["pro_id"]; ?>">
											
											<button class="primary-btn btn-success" name="btnAdd" type="submit">Comment</button>
										</form>
									</div>
								</div>
								<!-- /Review Form -->
							</div>
						</div>
						<!-- /tab3  -->

						<!-- tab2  -->
						<div id="tab2" class="tab-pane fade in">
							<div class="row">
								<div class="col-md-12">
									<p><?= $row["pro_specifications"]; ?></p>
								</div>
							</div>
						</div>
						<!-- /tab2  -->						


					</div>
					<!-- /product tab content  -->
				</div>
			</div>
			<!-- /product tab -->
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /SECTION -->
		<?php } ?>
<!-- Section -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">

			<div class="col-md-12">
				<div class="section-title text-center">
					<h3 class="title">Sale</h3>
				</div>
			</div>

			<!-- product -->
			<?php while($row = mysqli_fetch_array($data["sale"])){ ?>
			<div class="col-md-3 col-xs-6">
				<div class="product">
					<div class="product-img">
						<img src="<?php echo $data["url"]; ?>public/images/<?= $row["img_file_name"]; ?>" alt="">
						<div class="product-label">
							<span class="sale"><?= $row["sal_name"]; ?></span>
						</div>
					</div>
					<div class="product-body">
						<p class="product-category"><?= $row["brd_name"]; ?></p>
						<h3 class="product-name"><a href="<?php echo $data["url"]; ?>Home/display_Detail_Product/<?= $row["pro_id"];  ?>"><?= $row["pro_name"]; ?></a></h3>
						<h4 class="product-price"><script>document.write(formatNumber(<?= $row["pro_price"];  ?>));</script><span style="font-size: 10px;"> VND</span><del class="product-old-price"><script> document.write(formatNumber(<?= $row["pro_old_price"];  ?>));</script></del></h4>	
						<div class="product-rating">
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
			</div>
			<?php } ?>
			<!-- /product -->
			
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /Section -->