<div id="breadcrumb" class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="breadcrumb-header">Create New Brand</h2>
                <ul class="breadcrumb-tree">
                    <li><a href="<?php echo $data["url"]; ?>Brands">Brand</a></li>
                    <li class="active">Create New Brand</li>
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

                <form action="<?php echo $data["url"]; ?>Brands/add_Brand" method="POST" class="form-horizontal">
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">Brand Name:</label>
                        <div class="col-sm-10">
                            <input autofocus class="input" type="text" name="txtBrandName" placeholder="Brand Name"
                                value="<?php if(isset($_SESSION["txtBrandName"])) echo $_SESSION["txtBrandName"]; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">Describe:</label>
                        <div class="col-sm-10">
                            <textarea class="input" type="text" name="txtBrandDesc"
                                placeholder="Describe"><?php if(isset($_SESSION["txtBrandDesc"])) echo $_SESSION["txtBrandDesc"]; ?></textarea>
                        </div>
                    </div>

                    <div class="col-sm-2"></div>
                    <input type="submit" name="btnAdd" class="primary-btn btn-success" value="Create">
                    <input type="button" name="btnBack" class="primary-btn btn-danger" value="Back"
                        onclick="window.location='<?php echo $data['url']; ?>Brands';">
                </form>
            </div>
        </div>
    </div>
</div>
