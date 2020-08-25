<script>
	function Sort(){

		var $url = "<?= $this->getBaseUrl()."Home/Sort_By_Price" ?>";
		var $min = document.getElementById("price-min").value;
		var $max = document.getElementById("price-max").value;
		var $nsx = document.getElementById("nsx_id").value;
		var $popular = document.getElementById("popular").value;
		var $ord = document.getElementById("ordinalnumber").value;
		
		$("#product").hide();

		$.ajax({
			type: 'POST',
			url: $url,
			data: {min:$min, max:$max, nsx:$nsx, popular:$popular, ord:$ord},
			success: function(data) {
				if(data == 'false') 
				{
					alert('Error! An error occurred. Please try again later');
				}else{
					document.getElementById("display_search").innerHTML = data;		
				}
			},
			error: function() {
				alert("Error! An error occurred. Please try again later");
			}
		});
	}

	function Sort_By_Brand($brand){
		alert($brand);
	}
</script>

<!-- SECTION -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<!-- ASIDE -->
			<div id="aside" class="col-md-3">
				
				<!-- aside Widget -->
				<div class="aside">
					<h3 class="aside-title">Price</h3>
					<div class="price-filter">
						<div class="input-number price-min">
							<input id="price-min" type="number" value="1000000" onchange="Sort()" onkeyup="Sort()">
							<span class="qty-up">+</span>
							<span class="qty-down">-</span>
						</div>
						<span>-</span>
						<div class="input-number price-max">
							<input id="price-max" type="number" value="50000000" onchange="Sort()" onkeyup="Sort()">
							<span class="qty-up">+</span>
							<span class="qty-down">-</span>
						</div>
					</div>
				</div>
				<!-- /aside Widget -->

				
				<!-- aside Widget -->
				<div class="aside">
					<h3 class="aside-title">sale</h3>
					<?php while($row = mysqli_fetch_array($data["sale"])){ ?>
					<div class="product-widget">
						<div class="product-img">
							<img src="<?= $data["url"]; ?>public/images/<?= $row["img_file_name"]; ?>" alt="">
						</div>
						<div class="product-body">
							<p class="product-category"><?= $row["brd_name"]; ?></p>
							<h3 class="product-name"><a href="<?= $data["url"]; ?>Home/display_Detail_Product/<?= $row["pro_id"];  ?>"><?= $row["pro_name"]; ?></a></h3>
							<h4 class="product-price"><script>document.write(formatNumber(<?= $row["pro_price"];  ?>));</script><span style="font-size: 10px;"> VND</span><del class="product-old-price"><script> document.write(formatNumber(<?= $row["pro_old_price"];  ?>));</script></del></h4>	
						</div>
					</div>
					<?php } ?>
				</div>
				<!-- /aside Widget -->
			</div>
			<!-- /ASIDE -->
			
			<!-- STORE -->
			<div id="store" class="col-md-9">
				<!-- store top filter -->
				<div class="store-filter clearfix">
					<div class="store-sort">
						<label>
							Sort:
							<select class="input-select" id="popular" onchange="Sort()">
								<option value="0">Popular</option>
								<option value="1">Sale</option>
							</select>
						</label>

						<label>
							Show:
							<select class="input-select" id="ordinalnumber" onchange="Sort()">
								<option value="20">20</option>
								<option value="5">5</option>
								<option value="10">10</option>
								<option value="30">30</option>
								<option value="50">50</option>
							</select>
						</label>
					</div>
					<ul class="store-grid">
						<li class="active"><i class="fa fa-th"></i></li>
						
					</ul>
				</div>
				<!-- /store top filter -->
						<h4><?php if(isset($data["notice"])){echo $data["notice"];} ?></h4>
				<!-- store products -->
				<div class="row">
				<p id="display_search"></p>
					<!-- product -->
					<div id="product">
					<?php if(isset($data["list"])){ ?>
						<?php while($row = mysqli_fetch_array($data["list"])){ ?>
					<div class="col-md-4 col-xs-6">
						<div class="product">
							<div class="product-img">
								<img src="<?= $data["url"]; ?>public/images/<?= $row["img_file_name"]; ?>" alt="">
								<div class="product-label">
									<span class="new"><?= $row["sal_name"]; ?></span>
								</div>
							</div>
							<div class="product-body">
								<p class="product-category"><?= $row["brd_name"]; ?></p>
								<h3 class="product-name"><a href="<?= $data["url"]; ?>Home/display_Detail_Product/<?= $row["pro_id"];  ?>"><?= $row["pro_name"]; ?></a></h3>
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
								<button class="add-to-cart-btn" onclick="add_to_cart(<?= $row['pro_id']; ?>,1); count_products()"><i class="fa fa-shopping-cart"></i> add to cart</button>
							</div>
							<input type="hidden" id="nsx_id" value="<?= $row["brd_id"]; ?>">
						</div>
					</div>
						<?php } ?>
						
					<?php } ?>
					<!-- /product -->
				</div>
					
				</div>
				<!-- /store products -->

				
			</div>
			<!-- /STORE -->
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /SECTION -->