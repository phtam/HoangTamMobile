<div id="breadcrumb" class="section">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2 class="breadcrumb-header">Create New Payment</h2>
				<ul class="breadcrumb-tree">
					<li><a href="<?php echo $data["url"]; ?>Payments">Payments</a></li>
					<li class="active">Create New Payment</li>
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
					
				<form action="<?php echo $data["url"]; ?>Payments/Add_Payment" method="POST" class="form-horizontal">
					<div class="form-group">
						<label for="" class="col-sm-3 control-label">Payment Name:</label>
						<div class="col-sm-9">
							<input class="input" autofocus type="text" name="txtPaymentName" placeholder="Payment Name" value="<?php if(isset($_SESSION["txtPaymentName"])) echo $_SESSION["txtPaymentName"]; ?>">
						</div>
					</div>				
					
					<div class="col-sm-3"></div>
					<input type="submit" name="btnAdd" class="primary-btn btn-success" value="Create">
					<input type="button" name="btnCancel" class="primary-btn btn-danger" value="Cancel" onclick="window.location='<?php echo $data['url']; ?>Payments';">
			</div>

				</form>
		</div>
	</div>
</div>

