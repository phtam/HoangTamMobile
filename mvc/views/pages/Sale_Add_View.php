<div id="breadcrumb" class="section">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2 class="breadcrumb-header">Create New Sale</h2>
				<ul class="breadcrumb-tree">
					<li><a href="<?php echo $data["url"]; ?>Products">Sale</a></li>
					<li class="active">Create New Sale</li>
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
					
					<form action="<?php echo $data["url"]; ?>Sale/Add_Sale" method="POST" class="form-horizontal" enctype="multipart/form-data" role="form">
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Sale Name:</label>
							<div class="col-sm-10">
								<input class="input" autofocus type="text" name="txtSaleName" placeholder="Sale Name" value="<?php if(isset($_SESSION["txtSaleName"])) echo $_SESSION["txtSaleName"]; ?>">
							</div>
						</div>

                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Content:</label>
                            <div class="col-sm-10">
                                <textarea class="input" type="text" name="txtContent" placeholder="Content"><?php if(isset($_SESSION["txtContent"])) echo $_SESSION["txtContent"]; ?></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Start Date:</label>
                            <div class="col-sm-10">
                                <input class="input" type="date" name="slStartDate" placeholder="Start Date" value="<?php if(isset($_SESSION["slStartDate"])) echo $_SESSION["slStartDate"]; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">End Date:</label>
                            <div class="col-sm-10">
                                <input class="input" type="date" name="slEndDate" placeholder="End Date" value="<?php if(isset($_SESSION["slEndDate"])) echo $_SESSION["slEndDate"]; ?>">
                            </div>
						</div>
						
						<div class="form-group">
                            <label for="" class="col-sm-2 control-label">Image:</label>
                            <div class="col-sm-10">
                                <input class="input" type="file" name="flImage" id="flImage">
                            </div>
						</div>

					
					
						<div class="col-sm-2"></div>
						<input type="submit" name="btnAdd" class="primary-btn btn-success" value="Create">
						<input type="button" name="btnCancel" class="primary-btn btn-danger" value="Cancel" onclick="window.location='<?php echo $data['url']; ?>Sale';">
					</form>	
					
			</div>
		</div>
	</div>
</div>

