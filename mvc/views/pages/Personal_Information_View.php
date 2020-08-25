<div id="breadcrumb" class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="breadcrumb-header">Home</h3>
                <ul class="breadcrumb-tree">
                    <li><a href="<?= $data["url"]; ?>Home">Home</a></li>
                    <li class="active">Personal Information</li>
                </ul>
            </div>
        </div>
    </div>
</div>


<div class="section">
    <div class="container">
        <div class="row">
        
            <div class="col-md-12 order-details">
                <div class="section-title text-center">
                    <h3 class="title">Personal Information</h3>
                </div>
                <?php  while($row = mysqli_fetch_array($data["customer"])){ ?>
                <form action="<?php echo $data["url"]; ?>Home/Update_Personal_Information" method="POST" class="form-horizontal">
                    <div class="form-group">
                        <div class="col-md-2"></div>
                        <div class="col-md-10">
                            <p style="color:green;"><strong><?php if(isset($data["notice"])) { echo $data["notice"]; } ?></strong> </p>
                            <p style="color:red;"><strong><?php if(isset($data["error"])) { echo $data["error"]; } ?></strong> </p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">Username:</label>
                        <div class="col-sm-10">
                            <input class="input" type="text" readonly name="txtUsername" value="<?= $row["cus_username"]; ?>">
                        </div>
                    </div>
                
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">Name:</label>
                        <div class="col-sm-10">
                            <input class="input" type="text" name="txtName" placeholder="Name" value="<?= $row["cus_name"]; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">Gender:</label>
                        <div class="col-sm-10">
                            <select name="slGender" id="slGender" class="input">
                                <option value="2">Select your gender</option>
                                <option value="0" <?php if($row["cus_gender"]==0){echo "selected"; } ?>>Male</option>
                                <option value="1" <?php if($row["cus_gender"]==1){echo "selected"; } ?>>Female</option>
                            </select>
                        </div>
                    </div> 

                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">Address:</label>
                        <div class="col-sm-10">
                            <textarea class="input" type="text" name="txtAddress" placeholder="Address"><?= $row["cus_address"]; ?></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">Phone number:</label>
                        <div class="col-sm-10">
                            <input class="input" type="text" pattern="[0-9+-.*#]{8,12}" title="Phone number from 8 to 12 numbers" name="txtPhoneNumber" placeholder="Điện thoại" value="<?= $row["cus_phone_number"]; ?>">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">Email:</label>
                        <div class="col-sm-10">
                            <input class="input" type="email" name="txtEmail" readonly placeholder="Email" value="<?= $row["cus_email"]; ?>">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">Birthdate:</label>
                        <div class="col-sm-10">
                            <input class="input" type="date" name="slBirthdate" value="<?= $row["cus_birthdate"]; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">Identity card:</label>
                        <div class="col-sm-10">
                            <input class="input" type="text" name="txtIdentityCard" placeholder="Identity card (No.)" value="<?= $row["cus_identity_card"]; ?>">
                        </div>
                    </div>
			
					<div class="form-group">
                        <div class="col-sm-2"></div>
                        <input type="submit" name="btnUpdate" class="primary-btn btn-success" value="Save">
                        <input type="button" name="btnCancel" class="primary-btn btn-danger" value="Cancel" onclick="window.location='<?php echo $data['url']; ?>Home';">
                        <input type="button" name="btnDoiMatKhau" class="primary-btn btn-success" value="Change Password" onclick="window.location='<?php echo $data['url']; ?>Home/display_Change_Password';">
                    </div>
                    
				</div>

				</form>
                <?php } ?> 
            </div> <!-- // col-md-12 -->

        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->