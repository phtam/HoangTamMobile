<script type="text/javascript" src="<?php echo $data["url"]; ?>scripts/ckeditor/ckeditor.js"></script>
<div id="breadcrumb" class="section">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2 class="breadcrumb-header">Create New Product</h2>
				<ul class="breadcrumb-tree">
					<li><a href="<?php echo $data["url"]; ?>Products">Products</a></li>
					<li class="active">Create New Product</li>
				</ul>
			</div>
		</div>
	</div>
</div>

<div class="container">
	<h3 style="color:red">
	<?php if(isset($data["error"])){
			echo $data["error"];
		}
	?>
	</h3>
</div>


<div class="section">
	<div class="container">
		<div class="row">
				<div class="billing-details">
					
					<form action="<?php echo $data["url"]; ?>Products/Add_Product" method="POST" class="form-horizontal">
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Product Name:</label>
							<div class="col-sm-10">
								<input class="input" autofocus type="text" name="txtProductName" placeholder="Product name" value="<?php if(isset($_SESSION["txtProductName"])) echo $_SESSION["txtProductName"]; ?>">
							</div>
						</div>

						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Price:</label>
							<div class="col-sm-10">
								<input class="input" type="text" name="txtPrice" placeholder="Price" value="<?php if(isset($_SESSION["txtPrice"])) echo $_SESSION["txtPrice"]; ?>">
							</div>
						</div>
						
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Old Price:</label>
							<div class="col-sm-10">
								<input class="input" type="text" name="txtOldPrice" placeholder="Old price" value="<?php if(isset($_SESSION["txtOldPrice"])) echo $_SESSION["txtOldPrice"]; ?>">
							</div>
						</div>

						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Short Describe:</label>
							<div class="col-sm-10">
								<textarea class="input" type="text" name="txtShortDesc" placeholder="Short describe"><?php if(isset($_SESSION["txtShortDesc"])) echo $_SESSION["txtShortDesc"]; ?></textarea>
							</div>
						</div>

						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Describe:</label>
							<div class="col-sm-10">
								<textarea class="ckeditor" type="text" name="txtDesc" placeholder="Describe"><?php if(isset($_SESSION["txtDesc"])) echo $_SESSION["txtDesc"]; ?></textarea>
								<script language="javascript">
											CKEDITOR.replace( 'txtDesc',
											{
												skin : 'kama',
												extraPlugins : 'uicolor',
												uiColor: '#eeeeee',
												toolbar : [ ['Source','DocProps','-','Save','NewPage','Preview','-','Templates'],
													['Cut','Copy','Paste','PasteText','PasteWord','-','Print','SpellCheck'],
													['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
													['Form','Checkbox','Radio','TextField','Textarea','Select','Button','ImageButton','HiddenField'],
													['Bold','Italic','Underline','StrikeThrough','-','Subscript','Superscript'],
													['OrderedList','UnorderedList','-','Outdent','Indent','Blockquote'],
													['JustifyLeft','JustifyCenter','JustifyRight','JustifyFull'],
													['Link','Unlink','Anchor', 'NumberedList','BulletedList','-','Outdent','Indent'],
													['Image','Flash','Table','Rule','Smiley','SpecialChar'],
													['Style','FontFormat','FontName','FontSize'],
													['TextColor','BGColor'],[ 'UIColor' ] ]
											});
											
								</script> 
							</div>
						</div>

						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Specifications:</label>
							<div class="col-sm-10">
								<textarea class="ckeditor" type="text" name="txtSpecifications" placeholder="Specifications"><?php if(isset($_SESSION["txtSpecifications"])) echo $_SESSION["txtSpecifications"]; ?></textarea>
								<script language="javascript">
											CKEDITOR.replace( 'txtSpecifications',
											{
												skin : 'kama',
												extraPlugins : 'uicolor',
												uiColor: '#eeeeee',
												toolbar : [ ['Source','DocProps','-','Save','NewPage','Preview','-','Templates'],
													['Cut','Copy','Paste','PasteText','PasteWord','-','Print','SpellCheck'],
													['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
													['Form','Checkbox','Radio','TextField','Textarea','Select','Button','ImageButton','HiddenField'],
													['Bold','Italic','Underline','StrikeThrough','-','Subscript','Superscript'],
													['OrderedList','UnorderedList','-','Outdent','Indent','Blockquote'],
													['JustifyLeft','JustifyCenter','JustifyRight','JustifyFull'],
													['Link','Unlink','Anchor', 'NumberedList','BulletedList','-','Outdent','Indent'],
													['Image','Flash','Table','Rule','Smiley','SpecialChar'],
													['Style','FontFormat','FontName','FontSize'],
													['TextColor','BGColor'],[ 'UIColor' ] ]
											});
											
								</script> 
							</div>
						</div>

						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Quantity:</label>
							<div class="col-sm-10">
								<input class="input" type="text" name="txtQuantity" placeholder="Quantity" value="<?php if(isset($_SESSION["txtQuantity"])) echo $_SESSION["txtQuantity"]; ?>">
							</div>
						</div>

						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Brand:</label>
							<div class="col-sm-10">
								<select name="slBrands" id="slBrands" class="input">
									<option value=0 >Select brand</option>
									<?php while ($row = mysqli_fetch_array($data["brands"], MYSQLI_ASSOC)) { ?>
	
										<option <?php if(isset($_SESSION["slBrands"]) && $_SESSION["slBrands"] == $row["brd_id"]) echo "selected"; ?> value=<?= $row["brd_id"] ?> ><?= $row["brd_name"] ?></option>;
									<?php	} ?>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Sale:</label>
							<div class="col-sm-10">
								<select name="slSale" id="slSale" class="input">
									<option value=0 >Select sale</option>
									<?php while ($row = mysqli_fetch_array($data["sale"], MYSQLI_ASSOC)) { ?>
										<option <?php if(isset($_SESSION["slSale"]) && $_SESSION["slSale"] == $row["sal_id"]) echo "selected"; ?> value=<?= $row["sal_id"] ?> ><?= $row["sal_name"] ?></option>;
									<?php } ?>
								</select>
							</div>
						</div>
						
						<div class="col-sm-2"></div>
						<input type="submit" name="btnAdd" class="primary-btn btn-success" value="Create">
						<input type="button" name="btnCancel" class="primary-btn btn-danger" value="Cancel" onclick="window.location='<?php echo $data['url']; ?>Products';">
					
				</form>	
			</div>
		</div>
	</div>
</div>

