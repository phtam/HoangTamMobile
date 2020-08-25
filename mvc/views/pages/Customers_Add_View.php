<div id="breadcrumb" class="section">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2 class="breadcrumb-header">Create New Customer</h2>
				<ul class="breadcrumb-tree">
					<li><a href="<?php echo $data["url"]; ?>Products">Customer</a></li>
					<li class="active">Create New Customer</li>
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

<script>
function CheckUsername(str) {
    if (str.length == 0) {
        document.getElementById("error_username").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("error_username").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "<?php echo $data["url"] ?>Home/CheckUsername/" + str, true);
        xmlhttp.send();
    }
}

function CheckEmail(str) {
    if (str.length == 0) {
        document.getElementById("error_email").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("error_email").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "<?php echo $data["url"] ?>Home/CheckEmail/" + str, true);
        xmlhttp.send();
    }
}
</script>

<div class="section">

	<div class="container">
		<div class="row">
			
				<div class="billing-details">
					
					<form action="<?php echo $data["url"]; ?>Customers/Add_Customer" method="POST" class="form-horizontal">
					<div class="form-group">
						<label for="" class="col-sm-2 control-label">Username:</label>
						<div class="col-sm-10">
							<input class="input" autofocus type="text" pattern="[A-Za-z)-9]{6,}" title="Username from 6 to 50 characters and do not include special characters." name="txtUsername" placeholder="Username" value="<?php if(isset($_SESSION["txtUsername"])) {echo $_SESSION["txtUsername"];} ?>" onkeyup="CheckUsername(this.value)">
						</div>
					</div>

					<div class="col-sm-2"></div>
                    <div class="col-sm-10"><p id="error_username"></p></div>

					<div class="form-group">
						<label for="" class="col-sm-2 control-label">Password:</label>
						<div class="col-sm-10">
							<input class="input" type="password" pattern=".{8,}" title="Password from 8 characters or more." name="txtPassword" placeholder="Password" >
						</div>
					</div>
					
					<div class="form-group">
						<label for="" class="col-sm-2 control-label">Name:</label>
						<div class="col-sm-10">
							<input class="input" type="text" name="txtName" placeholder="Name" value="<?php if(isset($_SESSION["txtName"])) {echo $_SESSION["txtName"];} ?>">
						</div>
					</div>

					<div class="form-group">
						<label for="" class="col-sm-2 control-label">Gender:</label>
						<div class="col-sm-10">
                            <select name="slGender" id="slGender" class="input">
                                <option value="2">Select your gender</option>
                                <option <?php if(isset($_SESSION["slGender"]) && $_SESSION["slGender"]==0) {echo "selected";} ?> value="0">Male</option>
                                <option <?php if(isset($_SESSION["slGender"]) && $_SESSION["slGender"]==1) {echo "selected";} ?> value="1">Female</option>
                            </select>
                        </div>
                        
                        
					</div>

					<div class="form-group">
						<label for="" class="col-sm-2 control-label">Address:</label>
						<div class="col-sm-10">
                            <textarea class="input" type="text" name="txtAddress" placeholder="Address"><?php if(isset($_SESSION["txtAddress"])) echo $_SESSION["txtAddress"]; ?></textarea>
						</div>
					</div>

					<div class="form-group">
						<label for="" class="col-sm-2 control-label">Phone number:</label>
						<div class="col-sm-10">
							<input class="input" type="text" pattern="[0-9+-.*#]{8,12}" title="Phone number from 8 to 12 numbers." name="txtPhoneNumber" placeholder="Phone number" value="<?php if(isset($_SESSION["txtPhoneNumber"])) echo $_SESSION["txtPhoneNumber"]; ?>">
						</div>
                    </div>
                    
                    <div class="form-group">
						<label for="" class="col-sm-2 control-label">Email:</label>
						<div class="col-sm-10">
							<input class="input" type="email" name="txtEmail" placeholder="Email" value="<?php if(isset($_SESSION["txtEmail"])) echo $_SESSION["txtEmail"]; ?>" onkeyup="CheckEmail(this.value)">
						</div>
					</div>
					
					<div class="col-sm-2"></div>
                    <div class="col-sm-10"><p id="error_email"></p></div>
                    
                    <div class="form-group">
						<label for="" class="col-sm-2 control-label">Birthdate:</label>
						<div class="col-sm-10">
							<input class="input" type="date" name="slBirthdate" value="<?php if(isset($_SESSION["slBirthdate"])) echo $_SESSION["slBirthdate"]; ?>">
						</div>
					</div>

					<div class="form-group">
						<label for="" class="col-sm-2 control-label">Identity card:</label>
						<div class="col-sm-10">
							<input class="input" type="text" name="txtIdentityCard" placeholder="Identity card (No.)" value="<?php if(isset($_SESSION["txtIdentityCard"])) echo $_SESSION["txtIdentityCard"]; ?>">
						</div>
					</div>
			
					
					<div class="col-sm-2"></div>
					<input type="submit" name="btnSignUp" class="primary-btn btn-success" value="Create">
					<input type="button" name="btnBack" class="primary-btn btn-danger" value="Back" onclick="window.location='<?php echo $data['url']; ?>Customers';">
					
					</form>
				</div>
		</div>
	</div>
</div>

