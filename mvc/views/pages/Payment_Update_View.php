<div id="breadcrumb" class="section">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2 class="breadcrumb-header">Update Payment</h2>
				<ul class="breadcrumb-tree">
					<li><a href="<?php echo $data["url"]; ?>Payments">Payments</a></li>
					<li class="active">Update Payment</li>
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
					
				<form action="<?php echo $data["url"]; ?>Payments/Update_Payment" method="POST" class="form-horizontal">
                    <?php while($row = mysqli_fetch_array($data["detail"])){ ?>
						<div class="form-group">
							<label for="" class="col-sm-3 control-label">Payment Name:</label>
							<div class="col-sm-9">
								<input class="input" type="text" name="txtPaymentName" placeholder="Payment Name" value="<?= $row["pay_name"]; ?>">
							</div>
                        </div>			
                        
                        <input type="hidden" name="hdPaymentID" value="<?= $row["pay_id"]; ?>">
					<?php } ?>
					<div class="col-sm-3"></div>
					<input type="submit" name="btnUpdate" class="primary-btn btn-success" value="Save">
					<input type="button" name="btnCancel" class="primary-btn btn-danger" value="Cancel" onclick="window.location='<?php echo $data['url']; ?>Payments';">
				

				</form>
			</div>
		</div>
	</div>
</div>

