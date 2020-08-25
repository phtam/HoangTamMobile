<div id="breadcrumb" class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="breadcrumb-header">Home</h3>
                <ul class="breadcrumb-tree">
                    <li><a href="<?= $data["url"]; ?>Home">Home</a></li>
                    <li class="active">Sign In</li>
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
                    <h3 class="title">SIGN IN</h3>
                </div>

                <form action="<?= $data["url"]; ?>Home/Log_In" class="form-horizontal" method="POST" >

                    <div class="form-group">
                        <label for="" class="col-md-2 label-control">Username: </label>
                        <div class="col-md-10">
                            <input class="input" autofocus type="text" name="txtUsername" placeholder="Username " value="<?php if(isset($_SESSION["user"])){ echo $_SESSION["user"]; } ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-md-2 label-control">Password: </label>
                        <div class="col-md-10">
                            <input class="input" type="password" name="txtPassword" placeholder="Password">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-md-2"></div>
                        <div class="col-sm-10">
                            <a href="<?= $data["url"]; ?>Home/display_Sign_Up">Create new account?</a>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-md-2"></div>
                        <div class="col-md-2">
                            <input type="submit" name="btnLogIn" class="primary-btn btn-success" value="Sign In">
                        </div>
                        <div class="col-md-2" id="fb-root"></div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-2"></div>
                        <div class="col-md-10">
                            <p style="color:red;"><strong><?php if(isset($data["error"])) { echo $data["error"]; } ?></strong> </p>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
