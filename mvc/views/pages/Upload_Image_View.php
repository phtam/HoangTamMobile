<script language="javascript">
	function deleteConfirm(){
		if(confirm("Do you want to delete?")){
			return true;
		}
		else{
			return false;
		}
	}
</script>

<div id="breadcrumb" class="section">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2 class="breadcrumb-header">Update Product Image</h2>
				<ul class="breadcrumb-tree">
					<li><a href="<?= $data["url"]; ?>Products">Products</a></li>
					<li class="active">Update Product Image</li>
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

	<h3 style="color:green">
	<?php if(isset($data["notice"])){
			echo $data["notice"];
		}
	?>
	</h3>
</div>


<div class="section">
	<div class="container">
		<div class="row">
				<div class="billing-details">
					
                    <form action="<?= $data["url"]; ?>Products/Upload_Image" method="POST" class="form-horizontal" enctype="multipart/form-data" role="form">
                    <?php while($row = mysqli_fetch_array($data["detail"])){ ?>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Product ID:</label>
							<div class="col-sm-10">
								<input class="input" type="text" name="txtProductID" id="txtProductID" readonly value="<?= $row["pro_id"]; ?>">
							</div>
						</div>

                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Product Name:</label>
                            <div class="col-sm-10">
                                <input class="input" type="text" name="txtProductName" readonly value="<?= $row["pro_name"]; ?>" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Image:</label>
                            <div class="col-sm-10">
                                <input class="input" type="file" name="flImage" id="flImage">
                            </div>
						</div>
						
						
					
						<div class="col-sm-2"></div>
						<input type="submit" name="btnUpdate" class="primary-btn btn-success" value="Save">
						<input type="button" name="btnCancel" class="primary-btn btn-danger" value="Cancel" onclick="window.location='<?= $data['url']; ?>Products';">
						
						<?php } ?>
					</form>
				</div>

				

				<div class="col-sm-offset-2 col-sm-12">
					<div class="col-sm-1">
						<label for="" class="control-label">ID</label>
					</div>
					<div class="col-sm-2">
						<label for="" class="control-label">Image</label>
					</div>
					<div class="col-sm-1">
						<label for="" class="control-label">Delete</label>
					</div>
				</div>

				<?php 
				if(isset($data["hsp"])){
					$count = 1;
					while($row = mysqli_fetch_array($data["hsp"], MYSQLI_ASSOC)){ ?>
				
				<div class="col-sm-offset-2 col-sm-12">
					<div class="col-sm-1">
						<label for="" class="control-label"><?= $count; ?></label>
					</div>
					<div class="col-sm-2">
						<img src="<?= $data["url"]; ?>public/images/<?= $row["img_file_name"]; ?>" style="max-width: 80px"/>
					</div>
					<div class="col-sm-1">
						<label for="" class="control-label"><a onclick=" return deleteConfirm()" href="<?= $data["url"]; ?>Products/delete_Image/<?= $row["img_id"]; ?>/<?= $row["pro_id"]; ?>"><img src="https://img.icons8.com/officexs/50/000000/delete-sign.png" style="max-width: 20px"/></a></label>
					</div>
				</div>
				
				<?php 
					$count ++; }
				} ?>
				<!-- /form -->
			</div>

			
		
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /SECTION -->
