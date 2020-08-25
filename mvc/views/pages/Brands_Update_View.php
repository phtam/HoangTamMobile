<div id="breadcrumb" class="section">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2 class="breadcrumb-header">Update Brand</h2>
				<ul class="breadcrumb-tree">
					<li><a href="<?php echo $data["url"]; ?>Brands">Brand</a></li>
					<li class="active">Update Brand</li>
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
				
				<form action="<?php echo $data["url"]; ?>Brands/update_Brand" method="POST" class="form-horizontal">
					<?php while($row = mysqli_fetch_array($data["detail"])){ ?>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Brand Name:</label>
							<div class="col-sm-10">
								<input class="input" type="text" name="txtBrandName" placeholder="Brand Name" value="<?= $row["brd_name"]; ?>">
							</div>
						</div>

						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Describe:</label>
							<div class="col-sm-10">
								<textarea class="input" type="text" name="txtBrandDesc" placeholder="Describe"><?= $row["brd_desc"]; ?></textarea>
							</div>
						</div>

						<input type="hidden" name="hdBrandId" value="<?= $row["brd_id"]; ?>">

					<?php } ?>
					
					<div class="col-sm-2"></div>
					<input type="submit" name="btnUpdate" class="primary-btn btn-success" value="Save">
					<input type="button" name="btnCancel" class="primary-btn btn-danger" value="Cancel" onclick="window.location='<?php echo $data['url']; ?>Brands';">
				</form>
				
			</div>
		</div>
	</div>
</div>

