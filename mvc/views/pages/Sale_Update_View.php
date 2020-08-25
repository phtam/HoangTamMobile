<div id="breadcrumb" class="section">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2 class="breadcrumb-header">Update Sale</h2>
				<ul class="breadcrumb-tree">
					<li><a href="<?php echo $data["url"]; ?>Products">Sale</a></li>
					<li class="active">Update Sale</li>
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
					
                    <form action="<?php echo $data["url"]; ?>Sale/Update_Sale" method="POST" class="form-horizontal" enctype="multipart/form-data" role="form">
                    <?php while($row = mysqli_fetch_array($data["detail"])){ ?>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Sale Name:</label>
							<div class="col-sm-10">
								<input class="input" type="text" name="txtSaleName" placeholder="Sale Name" value="<?php echo $row["sal_name"]; ?>">
							</div>
						</div>

                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Content:</label>
                            <div class="col-sm-10">
                                <textarea class="input" type="text" name="txtContent" placeholder="Content"><?php echo $row["sal_content"]; ?></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Start Date:</label>
                            <div class="col-sm-10">
                                <input class="input" type="date" name="slStartDate" placeholder="Start Date" value="<?php echo $row["sal_start_date"]; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">End Date:</label>
                            <div class="col-sm-10">
                                <input class="input" type="date" name="slEndDate" placeholder="End Date" value="<?php echo $row["sal_end_date"]; ?>">
                            </div>
						</div>
						
						<div class="form-group">
                            <label for="" class="col-sm-2 control-label">Image:</label>
                            <div class="col-sm-10">
                                <input class="input" type="file" name="flImage" id="flImage" value="<?php echo $row["sal_poster"]; ?>">
                            </div>
						</div>

                        <input type="hidden" name="hdSaleID" id="hdSaleID" value="<?php echo $row["sal_id"]; ?>">
					
					
					<div class="col-sm-2"></div>
					<input type="submit" name="btnUpdate" class="primary-btn btn-success" value="Save">
					<input type="button" name="btnCancel" class="primary-btn btn-danger" value="Cancel" onclick="window.location='<?php echo $data['url']; ?>Sale';">
					
				<?php } ?>
				</form>
			</div>
		</div>
	</div>
</div>

