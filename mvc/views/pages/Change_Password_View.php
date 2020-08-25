<div id="breadcrumb" class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="breadcrumb-header">Home</h3>
                <ul class="breadcrumb-tree">
                    <li><a href="<?= $data["url"]; ?>Home">Home</a></li>
                    <li class="active">Change Password</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<p id="tam"></p>
<div class="section">
    <div class="container">
        <div class="row">
        
            <div class="col-md-12 order-details">
                <div class="section-title text-center">
                    <h3 class="title">CHANGE PASSWORD</h3>
                </div>
                
                <form action="<?php echo $data["url"]; ?>Home/Change_Password" method="POST" class="form-horizontal">
                    <div class="form-group">
                        <div class="col-md-3"></div>
                        <div class="col-md-9">
                            <p style="color:green;"><strong><?php if(isset($data["notice"])) { echo $data["notice"]; } ?></strong> </p>
                            <p style="color:red;"><strong><?php if(isset($data["error"])) { echo $data["error"]; } ?></strong> </p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">Current Password:</label>
                        <div class="col-sm-9">
                            <input class="input" type="password" name="txtCurrentPassword" placeholder="Current Password">
                        </div>
                    </div>
					
					<div class="form-group">
						<label for="" class="col-sm-3 control-label">New Password:</label>
						<div class="col-sm-9">
							<input class="input" type="password" name="txtNewPassword1" placeholder="New Password">
						</div>
					</div>

					<div class="form-group">
						<label for="" class="col-sm-3 control-label">Confirm new password:</label>
						<div class="col-sm-9">
							<input class="input" type="password" name="txtNewPassword2" placeholder="Enter the new password again">
						</div>
                    </div>
                    
					<div class="form-group">
                        <div class="col-sm-3"></div>
                        <input type="submit" name="btnSave" class="primary-btn btn-success" value="Save">
                        <input type="button" name="btnCancel" class="primary-btn btn-danger" value="Cancel" onclick="window.location='<?php echo $data['url']; ?>Home';">
                        
                    </div>
                </form>

				</div>
            </div> 
        </div>
    </div>
</div>
