<script type="text/javascript" src="<?php echo $data["url"]; ?>scripts/ckeditor/ckeditor.js"></script>
<div id="breadcrumb" class="section">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2 class="breadcrumb-header">Update Product</h2>
				<ul class="breadcrumb-tree">
					<li><a href="<?php echo $data["url"]; ?>Products">Products</a></li>
					<li class="active">Update Product</li>
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
					<?php while($row = mysqli_fetch_array($data["detail"])){ ?>
					<form action="<?php echo $data["url"]; ?>Products/Update_Product" method="POST" class="form-horizontal">
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Product Name:</label>
							<div class="col-sm-10">
								<input class="input" type="text" name="txtProductName" placeholder="Product name" value="<?= $row["pro_name"]; ?>">
							</div>
						</div>

						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Price:</label>
							<div class="col-sm-10">
								<input class="input" type="text" name="txtPrice" placeholder="Price" value="<?= $row["pro_price"]; ?>">
							</div>
						</div>
						
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Old Price:</label>
							<div class="col-sm-10">
								<input class="input" type="text" name="txtOldPrice" placeholder="Old price" value="<?= $row["pro_old_price"]; ?>">
							</div>
						</div>

						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Short Describe:</label>
							<div class="col-sm-10">
								<textarea class="input" type="text" name="txtShortDesc" placeholder="Short Describe"><?= $row["pro_short_desc"];  ?></textarea>
							</div>
						</div>

						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Describe:</label>
							<div class="col-sm-10">
								<textarea class="ckeditor" type="text" name="txtDesc" placeholder="Describe"><?= $row["pro_desc"];  ?></textarea>
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
							<label for="" class="col-sm-2 control-label">Specification:</label>
							<div class="col-sm-10">
								<textarea class="ckeditor" type="text" name="txtSpecifications" placeholder="Specification"><?php  echo $row["pro_specifications"]; ?></textarea>
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
								<input class="input" type="text" name="txtQuantity" placeholder="Quantity" value="<?= $row["pro_quantity"];  ?>">
							</div>
						</div>

						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Brand:</label>
							<div class="col-sm-10">
								<select name="slBrands" id="slBrands" class="input">
									<option value=0>Select brand</option>
									<?php while ($nsx = mysqli_fetch_array($data["brands"], MYSQLI_ASSOC)) {
										if($row["brd_id"]==$nsx["brd_id"]){
											echo "<option value=".$nsx["brd_id"]." selected >".$nsx["brd_name"]."</option>";
										}else{
											echo "<option value=".$nsx["brd_id"].">".$nsx["brd_name"]."</option>";
										}
									} ?>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Sale:</label>
							<div class="col-sm-10">
								<select name="slSale" id="slSale" class="input">
									<option value="1">Select sale</option>
									<?php while ($km = mysqli_fetch_array($data["sale"], MYSQLI_ASSOC)) {
										if($row["sal_id"]==$km["sal_id"]){
											echo "<option value=".$km["sal_id"]." selected >".$km["sal_name"]."</option>";
										}else{
											echo "<option value=".$km["sal_id"].">".$km["sal_name"]."</option>";
										}
									} ?>
								</select>
							</div>
						</div>
						
						<input type="hidden" name="hdProductID" id="hdProductID" value="<?php if(isset($_SESSION["hdProductID"])) {echo $_SESSION["hdProductID"];} else { echo $row["pro_id"]; } ?>">
						
						<div class="col-sm-2"></div>
						<input type="submit" name="btnUpdate" class="primary-btn btn-success" value="Save">
						<input type="button" name="btnCancel" class="primary-btn btn-danger" value="Cancel" onclick="window.location='<?php echo $data['url']; ?>Products';">
						
						<?php  }?>

				</form>	
			</div>
		</div>
	</div>
</div>
