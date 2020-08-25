<?php

    class Home extends Controller{

        protected $productmodel;
        protected $customermodel;
        protected $salemodel;
        protected $brandmodel;
        protected $paymentmodel;
        protected $commentmodel;
        protected $ordermodel;
        protected $api;

        // Constructer
        function __construct()
        {
            $this->productmodel  =   $this->getModel("ProductsModel");
            $this->customermodel =   $this->getModel("CustomersModel");
            $this->salemodel     =   $this->getModel("SaleModel");
            $this->brandmodel    =   $this->getModel("BrandsModel");
            $this->paymentmodel  =   $this->getModel("PaymentModel");
            $this->commentmodel  =   $this->getModel("CommentsModel");
            $this->ordermodel    =   $this->getModel("OrderModel");
            $this->getPHPMailer();

            
            // Prevent web attacks with Clickjacking
            header("X-Frame-Options: SAMEORIGIN");
            header("Content-Security-Policy: frame-ancestors 'none'", false);
            
        }

       // The default function when the controller runs
        function Default(){
           $this->getView("master1",[
                "url"           =>	$this->getBaseUrl(),
                "act"           =>	"0",
                "page"          =>	"Home_View",
                "brand1"        =>	$this->brandmodel->GetAllBrand(),
                "brand2"        =>	$this->brandmodel->GetAllBrand(),
                "newproduct"    =>	$this->productmodel->display_NewProducts(),
                "hotdeal"       =>	$this->salemodel->display_HotDeal(),
                "saleproduct"   =>	$this->productmodel->display_SaleProducts(),
                "saleiphone1"   =>	$this->productmodel->display_Sale_Products(1,0,3),
                "saleiphone2"   =>	$this->productmodel->display_Sale_Products(1,3,3),
                "salesamsung1"  =>	$this->productmodel->display_Sale_Products(2,0,3),
                "salesamsung2"  =>	$this->productmodel->display_Sale_Products(2,3,3),
                "saleoppo1"     =>	$this->productmodel->display_Sale_Products(3,0,3),
                "saleoppo2"     =>	$this->productmodel->display_Sale_Products(3,3,3),
                "sale"          =>	$this->salemodel->GetTop3Sale()
            ]);

        }

        // Action: Display ProductsView
        function Manage(){
            if(isset($_SESSION["username"]["id"]) && $_SESSION["username"]["role"]==0){
                $this->getView("master2",[
                    "url"   =>	$this->getBaseUrl(),
                    "page"  =>	"Products_View",
                    "act"   =>	"product",
                    "list"  =>	$this->productmodel->GetAllProducts()
                ]);
            }else{
                $url = $this->getBaseUrl()."Home";
                header("Location: ".$url);
            }
            
        }
        
        // Action: Active Account by Gmail
        function Actice_Account($username = "", $code = ""){
            if($username != "" && $code != ""){
                if(isset($username) && isset($code)){
                    if(!$this->customermodel->CheckActiveAccount($username, $code)){
                        echo "<h2 align='center'>Activation code or username is invalid. Please check again!</h2>";
                    }else{
                        $url = $this->getBaseUrl()."Home";
                        if($this->customermodel->ActiveAccount($username)=="true"){
                            echo "<p><h2 align='center'>Account activation successful!</h2></p>"."</br>"."<p><a href='$url'>Back to Home page</a></p>";
                        }else{
                            echo "<h2 align='center'>Account activation failed. Please check again!</h2>";
                        }
                    }
                }
            }else{
                $url = $this->getBaseUrl()."Home";
                header("Location: ".$url);
            }
        }

        // Action: display Product of Shop
        function display_Product($id=0){
            if($id != 0){
                $this->getView("master1",[
                    "url"       =>	$this->getBaseUrl(),
                    "act"       =>	$id,
                    "page"      =>	"Store_View",
                    "brand1"    =>	$this->brandmodel->GetAllBrand(),
                    "brand2"    =>	$this->brandmodel->GetAllBrand(),
                    "list"      =>	$this->productmodel->GetProduct_ByBrand($id),
                    "sale"      =>	$this->productmodel->display_SaleProducts_ByBrand($id)
                ]);
            }else{
                $url = $this->getBaseUrl()."Home";
                header("Location: ".$url);
            }
        }

        // Action: display detail product 
        function display_Detail_Product($id=0){
            if($id != 0){
                $this->getView("master1",[
                    "url"   	=>	$this->getBaseUrl(),
                    "act"   	=>	"0",
                    "page"  	=>	"Detail_Product_View",
                    "brand1"	=>	$this->brandmodel->GetAllBrand(),
                    "brand2"	=>	$this->brandmodel->GetAllBrand(),
                    "detail"	=>	$this->productmodel->display_Detail_ByID($id),
                    "image1"	=>	$this->productmodel->GetProductImage($id),
                    "image2"	=>	$this->productmodel->GetProductImage($id),
                    "sale"  	=>	$this->productmodel->display_Sale_Products(1, 0, 4),
                    "cmt"   	=>	$this->commentmodel->GetCommentOfProduct($id)
                ]);
            }else{
                $url = $this->getBaseUrl()."Home";
                header("Location: ".$url);
            }
            
        }

        // Action: Search product
        function Search(){
            if(isset($_REQUEST["btn_search"])){

                $brand  = strip_tags($_REQUEST["sl_search"]);
                $keyword = strip_tags($_REQUEST["txt_search"]);

                $result = ($brand == 0)? $this->productmodel->Search_All_By_Name($keyword) : $this->productmodel->Search_All_By_Name_And_Brand($keyword, $brand);
                
                $brand = ($brand > 0) ? $brand : 1 ;

                if($result != false){
                    $this->getView("master1",[
                        "url"   	=>	$this->getBaseUrl(),
                        "act"   	=>	"0",
                        "page"  	=>	"Store_View",
                        "brand1"	=>	$this->brandmodel->GetAllBrand(),
                        "brand2"	=>	$this->brandmodel->GetAllBrand(),
                        "list"  	=>	$result,
                        "sale"  	=>	$this->productmodel->display_SaleProducts_ByBrand($brand)
                    ]);
                }else{
                    $this->getView("master1",[
                        "url"   	=>	$this->getBaseUrl(),
                        "act"   	=>	"0",
                        "page"  	=>	"Store_View",
                        "brand1"	=>	$this->brandmodel->GetAllBrand(),
                        "brand2"	=>	$this->brandmodel->GetAllBrand(),
                        "notice"	=>	"Sorry, no results found! Please check the spelling or try searching for something else",
                        "sale"  	=>	$this->productmodel->display_SaleProducts_ByBrand($brand)
                    ]);
                }
            }else{
                $url = $this->getBaseUrl()."Home";
                header("Location: ".$url);
            }
        }

        // Action: Add to cart
        function Add_To_Cart(){
           
            $id = isset($_POST["sp_ma"]) ? $_POST["sp_ma"] : null ;
            $qty = isset($_POST["sp_qty"]) ? $_POST["sp_qty"] : null ;

            if($id != 0){
                if(isset($_SESSION["cart"][$id])){
                    $_SESSION["cart"][$id]["qty"] += $qty ;
                }else{
                    $_SESSION["cart"][$id]["qty"] = $qty;
                }
            
                $result = $this->productmodel->display_Detail_ByID($id);

                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                    $_SESSION["cart"][$id]["name"] 	    = $row["pro_name"];
                    $_SESSION["cart"][$id]["image"] 	= $row["img_file_name"];
                    $_SESSION["cart"][$id]["price"] 	= $row["pro_price"]; 
                }

                $_SESSION["total"] = 0;

                foreach ($_SESSION["cart"] as $key => $value) {
                    $_SESSION["total"] += ($value["price"]*$value["qty"]);
                }

                echo "Add ".$_SESSION["cart"][$id]["name"]." to the cart successfully!";

            }else{
                $url = $this->getBaseUrl()."Home";
                header("Location: ".$url);
            }
                

        }

        // Action: display cart
        function display_Cart(){
            $this->getView("master1",[
                "url"       =>	$this->getBaseUrl(),
                "act"       =>	"0",
                "page"      =>	"Cart_View",
                "brand1"    =>	$this->brandmodel->GetAllBrand(),
                "brand2"    =>	$this->brandmodel->GetAllBrand(),
                "payment"   =>	$this->paymentmodel->GetAllPayment()
            ]);
        }

        // Action: Log out
        function Log_Out(){
            session_destroy();
            $url = $this->getBaseUrl()."Home";
            header("Location: ".$url);
        }

        // Action: delete product from cart
        function delete_product_in_cart($id=0){
            if($id != 0){
                unset($_SESSION["cart"][$id]);
                $_SESSION["total"] = 0;

                foreach ($_SESSION["cart"] as $key => $value) {
                    $_SESSION["total"] += ($value["price"]*$value["qty"]);
                }

                $_SESSION["total_qty"] = 0;
                foreach ($_SESSION["cart"] as $key => $val) {
                    $_SESSION["total_qty"] += $val["qty"];
                }
                

                $this->getView("master1",[
                    "url"       =>	$this->getBaseUrl(),
                    "act"       =>	"0",
                    "page"      =>	"Cart_View",
                    "brand1"    =>	$this->brandmodel->GetAllBrand(),
                    "brand2"    =>	$this->brandmodel->GetAllBrand(),
                    "payment"   =>	$this->paymentmodel->GetAllPayment()
                ]);

            } else {
                $url = $this->getBaseUrl()."Home";
                header("Location: ".$url);
            }
        }

        // Action: Count product in cart
        function Count_Products(){
            if(isset($_SESSION["cart"])){
                $_SESSION["total_qty"] = 0;
                foreach ($_SESSION["cart"] as $key => $val) {
                    $_SESSION["total_qty"] += $val["qty"];
                }
                echo $_SESSION["total_qty"];
            }else {
                $url = $this->getBaseUrl()."Home";
                header("Location: ".$url);
            }
        }

        // Action: display Log_In_View
        function display_LogIn(){
            $this->getView("master1",[
                "page"  	=>	"Log_In_View",
                "url"   	=>	$this->getBaseUrl(),
                "act"   	=>	"0",
                "brand1"	=>	$this->brandmodel->GetAllBrand(),
                "brand2"	=>	$this->brandmodel->GetAllBrand(),
            ]);
        }

        // Action: display Sign_Up_View
        function display_Sign_Up(){
            unset($_SESSION["txtUsername"]);
            unset($_SESSION["txtName"]);
            unset($_SESSION["slGender"]);
            unset($_SESSION["txtAddress"]);
            unset($_SESSION["txtPhoneNumber"]);
            unset($_SESSION["txtEmail"]);
            unset($_SESSION["slBirthdate"]);
            unset($_SESSION["txtIdentityCard"]);
            
            $this->getView("master1",[
                "page"  	=>	"Sign_Up_View",
                "url"   	=>	$this->getBaseUrl(),
                "act"   	=>	"0",
                "brand1"	=>	$this->brandmodel->GetAllBrand(),
                "brand2"	=>	$this->brandmodel->GetAllBrand(),
            ]);
        }

        // Action: Log In
        function Log_In(){
            if(isset($_POST["btnLogIn"])){
                $username = strip_tags($_POST["txtUsername"]); // Prevent Cross-Site Scripting attacks(XSS)
                $password = strip_tags($_POST["txtPassword"]);

                $_SESSION["user"] = $username;

                $error = "";
                if(strlen(trim($username)) == 0){
                    $error = "Please enter your username!";
                }else if(strlen(trim($password)) == 0){
                    $error = "Please enter your password!";
                }else{
                    $password = md5($password);
                    $result = $this->customermodel->LogIn($username, $password);

                    if($result=="true"){
                        
                        if($this->customermodel->check_Acticed($username) == "true"){

                            $_SESSION["username"]["id"] = $username;
                        
                            $info = $this->customermodel->GetDetailCustomer($username);

                            while($row = mysqli_fetch_array($info)){
                                $_SESSION["username"]["role"]       = $row["cus_admin"];
                                $_SESSION["username"]["mail"]       = $row["cus_email"];
                                $_SESSION["username"]["name"]       = $row["cus_name"];
                                $_SESSION["username"]["address"]    = $row["cus_address"];
                            }

                            $url = $this->getBaseUrl()."Home";
                            header("Location: ".$url);

                        } else {
                            $this->getView("master1",[
                                "page"  	=>  "Log_In_View",
                                "url"   	=>  $this->getBaseUrl(),
                                "act"   	=>  "0",
                                "brand1"	=>  $this->brandmodel->GetAllBrand(),
                                "brand2"	=>  $this->brandmodel->GetAllBrand(),
                                "error" 	=>  "Your account has not been activated. Please check your email to activate your account."
                            ]);

                        }

                    }else{
                        $this->getView("master1",[
                            "page"  	=>	"Log_In_View",
                            "url"   	=>	$this->getBaseUrl(),
                            "act"   	=>	"0",
                            "brand1"	=>	$this->brandmodel->GetAllBrand(),
                            "brand2"	=>	$this->brandmodel->GetAllBrand(),
                            "error" 	=>	"Username or password incorrect."
                        ]);
                    }

                }
                    $this->getView("master1",[
                        "page"  	=>  "Log_In_View",
                        "url"   	=>  $this->getBaseUrl(),
                        "act"   	=>  "0",
                        "brand1"	=>  $this->brandmodel->GetAllBrand(),
                        "brand2"	=>  $this->brandmodel->GetAllBrand(),
                        "error" 	=>  $error
                    ]);

            }else{
                $url = $this->getBaseUrl()."Home";
                header("Location: ".$url);
            }


        }

        // Action: Check Username 
        function CheckUsername($username)
        {
            if(trim(strlen($username))< 6 || trim(strlen($username))> 50 ){
                echo "<p style='color:red'>Username from 6 to 50 characters.</p>";
                return;
            }
            if(!$this->customermodel->CheckValidate($username)){
                echo "<p style='color:red'>Username already exists.</p>";
            }else{
                echo "<p style='color:green'>Username is valid.</p>";
            }
        }

        // Action: Check Email valid
        function CheckEmail($email)
        {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "<p style='color:red'>Email is invalid.</p>";
                return;
            }
            if(!$this->customermodel->CheckEmailValidate($email)){
                echo "<p style='color:red'>Email already exists.</p>";
            }else{
                echo "<p style='color:green'>Email is valid.</p>";
            }
        }

        # Action: Sign up
        function Sign_Up(){
            if(isset($_POST["btnSignUp"])){
                // Prevent Cross-Site Scripting attacks(XSS)
                $username     = strip_tags($_POST["txtUsername"]) ; 
                $password     = strip_tags($_POST["txtPassword"]) ;
                $name         = strip_tags($_POST["txtName"]) ;
                $gender       = strip_tags($_POST["slGender"]) ;
                $address      = strip_tags($_POST["txtAddress"]) ;
                $phonenumber  = strip_tags($_POST["txtPhoneNumber"]) ;
                $email        = strip_tags($_POST["txtEmail"]) ;
                $birthdate    = strip_tags($_POST["slBirthdate"]) ;
                $identitycard = strip_tags($_POST["txtIdentityCard"]) ;
                $code     	  = md5(rand());
                $status       = 1;
                $admin        = 1;

                $_SESSION["txtUsername"]        =   $username ;
                $_SESSION["txtName"]            =   $name ;
                $_SESSION["slGender"]           =   $gender ;
                $_SESSION["txtAddress"]         =   $address ;
                $_SESSION["txtPhoneNumber"]     =   $phonenumber ;
                $_SESSION["txtEmail"]           =   $email ;
                $_SESSION["slBirthdate"]        =   $birthdate ;
                $_SESSION["txtIdentityCard"]    =   $identitycard ;

                $error = "";

                if(strlen(trim($username))<6){
                    $error 	= "Username from 6 to 50 characters and do not include special characters.";
                }else if(!$this->customermodel->CheckValidate($username)){
                    $error 	= "Username already exists.";
                } else if(strlen(trim($password))<8){
                    $error 	= "Password from 8 characters or more.";
                } else if(strlen(trim($name))==0){
                    $error 	= "Please enter your name.";
                } else if($gender=="2"){
                    $error 	= "Please select your gender.";
                } else if(strlen(trim($address))==0){
                    $error 	= "Please enter your address.";
                } else if(strlen(trim($phonenumber))<8 || strlen(trim($phonenumber))>12){
                    $error 	= "Phone number from 8 to 12 numbers.";
                } else if(strlen(trim($email))==0){
                    $error 	= "Please enter your email.";
                } else if(!$this->customermodel->CheckEmailValidate($email)){
                    $error	="Email already exists.";
                }else if($birthdate == null){
                    $error 	= "Please select your birthdate";
                } else {

                    $password = md5($password);

                    $result = $this->customermodel->AddCustomer($username, $password ,$name, $gender, $address, $phonenumber, $email, $birthdate, $identitycard, $code, $status, $admin);

                    if($result == "true"){
                        $notice = "Sign up successfully. Please check your email to activate your account!";

                        unset($_SESSION["txtUsername"]);
                        unset($_SESSION["txtName"]);
                        unset($_SESSION["slGender"]);
                        unset($_SESSION["txtAddress"]);
                        unset($_SESSION["txtPhoneNumber"]);
                        unset($_SESSION["txtEmail"]);
                        unset($_SESSION["slBirthdate"]);
                        unset($_SESSION["txtIdentityCard"]);

                        $url        = $this->getBaseUrl()."Home/Actice_Account/$username/$code";
                        $home       = $this->getBaseUrl()."Home";
                        $content    = "<p>Congratulations $name has successfully registered your account at <a href='$home'>Hoang Tam Mobile website<a>.</p>"."<p>
                        Please click the following link to activate your account:<a href='$url'>$url</p>";
                        $subject    = "Hoang Tam Mobile";
                        $this->sendMail($subject, $content, $email, $email);
                    } else {
                        $notice = "Sign up failed. Please check again!";
                    }
                        $this->getView("master1",[
                            "url"		=>	$this->getBaseUrl(),
                            "act"		=>	"0",
                            "page"		=>	"Sign_Up_View",
                            "notice"	=>	$notice,
                            "brand1"	=>	$this->brandmodel->GetAllBrand(),
                            "brand2"	=>	$this->brandmodel->GetAllBrand(),
                        ]);
                }

                $this->getView("master1",[
                    "url"	    =>	$this->getBaseUrl(),
                    "act"	    =>	"0",
                    "page"	    =>	"Sign_Up_View",
                    "brand1"	=>	$this->brandmodel->GetAllBrand(),
                    "brand2"	=>	$this->brandmodel->GetAllBrand(),
                    "error"	    =>	$error
                ]);

            }else{
                $url = $this->getBaseUrl()."Home";
                header("Location: ".$url);
            }
        }
        

        # Action: Send Mail
        function sendMail($title, $content, $nTo, $mTo){
          
            $nFrom 		        = 'Hoang Tam Mobile';
            $mFrom 		        = 'didonghoangtam342@gmail.com'; 
            $mPass 		        = '0327291328';
            $mail               = new PHPMailer();
            $body               = $content;
            $mail->IsSMTP(); 
            $mail->CharSet   	= "utf-8";
            $mail->SMTPDebug    = 0;
            $mail->SMTPAuth     = true;
            $mail->SMTPSecure   = "ssl"; 
            $mail->Host         = "smtp.gmail.com";        
            $mail->Port         = 465;
            $mail->Username     = $mFrom;
            $mail->Password     = $mPass;
            $mail->SetFrom($mFrom, $nFrom);
            $mail->Subject      = $title;
            $mail->MsgHTML($body);
            $address 		    = $mTo;
            $mail->AddAddress($address, $nTo);
            !$mail->Send();
        }

        # Action: Add Comment
        function Add_Comment()
        {
            if(isset($_POST["btnAdd"])){    
			$name 		    = strip_tags($_POST["txtName"]) ; // Prevent Cross-Site Scripting attacks(XSS)
			$email 		    = strip_tags($_POST["txtEmail"]) ;
			$content 		= strip_tags($_POST["txtContent"]) ;
			$date 		    = gmdate('Y-m-d H:i:s') ;
			$id 			= $_POST["pro_id"] ;

			$error="";
			if(strlen(trim($name))==0){
				$error = "Please enter your name!";
			}else if(strlen(trim($email))==0){
				$error = "Please your email!";
			}else if(strlen(trim($content))==0){
				$error = "Please enter your comment";
			}else{
				$result = $this->commentmodel->AddComment($name, $email, $content, $date, $id);
				if($result == "true"){
				echo "<script>alert('Thank you for comment. We will reply as soon as possible!');</script>";
				$this->display_Detail_Product($id);
				
				}else{
				echo "<script>alert('Comments failed! Your comments are not saved');</script>";
				$this->display_Detail_Product($id); 
				}
			}
				if($error != ""){
				echo "<script>alert('$error');</script>";
				$this->display_Detail_Product($id);
				}
			} else {
			$url = $this->getBaseUrl()."Home";
			header("Location: ".$url);
			}
			
		}

        # Action: Sort By Price
        function Sort_By_Price()
        {  
            if(isset($_POST["min"]) && isset($_POST["max"]) && isset($_POST["nsx"])){

                $min 		= strip_tags($_POST["min"]);
                $max 		= strip_tags($_POST["max"]); 
                $brand 		= $_POST["nsx"];
                $popular 	= $_POST["popular"];
                $ord 		= $_POST["ord"];
                
                if(!is_numeric($min)){
                    echo "<h4>Sorry, no results found! Please check the spelling or try searching for something else</h4>";
                    return;
                }
                if(!is_numeric($max)){
                    echo "<h4>Sorry, no results found! Please check the spelling or try searching for something else</h4>";
                    return;
                }

                $result = $this->productmodel->Sort_By_Price($brand, $max, $min, $popular, $ord);

                if(mysqli_num_rows($result)==0){
                    echo "<h4>Sorry, no results found! Please check the spelling or try searching for something else</h4>";
                    return;
                }
                while($row = mysqli_fetch_array($result)){
                    
                    echo "<div class='col-md-4 col-xs-6'>";
                    echo "<div class='product'>";
                    echo "<div class='product-img'>";
                    echo "<img src='".$this->getBaseUrl()."public/images/".$row['img_file_name']."' alt=''>";
                    echo "<div class='product-label'>";
                    echo "<span class='new'>".$row["sal_name"]."</span>";
                    echo "</div>";
                    echo "</div>";
                    echo "<div class='product-body'>";
                    echo "<p class='product-category'>".$row["brd_name"]."</p>";
                    echo "<h3 class='product-name'><a href='".$this->getBaseUrl()."Home/display_Detail_Product/".$row["pro_id"]."'>".$row["pro_name"]."</a></h3>";
                    echo "<h4 class='product-price'>".$row["pro_price"]."<del class='product-old-price'>".$row["pro_old_price"]."</del></h4>";
                    echo "<div class='product-rating'>";
                    echo "<i class='fa fa-star'></i>";
                    echo "<i class='fa fa-star'></i>";
                    echo "<i class='fa fa-star'></i>";
                    echo "<i class='fa fa-star'></i>";
                    echo "<i class='fa fa-star'></i>";
                    echo "</div>";
                    echo "<div class='product-btns'>";
                    echo "<button class='add-to-compare' onclick='Add_Product_To_Compare(".$row['pro_id'].")'><i class='fa fa-exchange'></i><span class='tooltipp'>compare</span></button>";
                    echo "<button class='quick-view' onclick='display_Detail(".$row['pro_id'].")'><i class='fa fa-eye'></i><span class='tooltipp'>detail</span></button>";
                    echo "</div>";
                    echo "</div>";
                    echo "<div class='add-to-cart'>";
                    echo "<button class='add-to-cart-btn' onclick='add_to_cart(".$row['pro_id'].",1); count_products()'><i class='fa fa-shopping-cart'></i> add to cart</button>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";                
                }
            }else{
                $url = $this->getBaseUrl()."Home";
                header("Location: ".$url);
            }
        }

        # Action: Display Personal Information - using web service (REST)
        function Display_Personal_Information()
        {
            if(isset($_SESSION["username"]["id"])){

                $this->getView("master1",[
                    "url"	    =>	$this->getBaseUrl(),
                    "act"	    =>	"0",
                    "page"	    =>	"Personal_Information_View",
                    "brand1"	=>	$this->brandmodel->GetAllBrand(),
                    "brand2"	=>	$this->brandmodel->GetAllBrand(),
                    "customer"  =>	$this->customermodel->GetDetailCustomer($_SESSION["username"]["id"])

                ]);
            }else{
                $url = $this->getBaseUrl()."Home";
                header("Location: ".$url);
            }
        }

        # Action: Update Personal Information
        function Update_Personal_Information(){
            if(isset($_POST["btnUpdate"])){
                
                $username 	    = strip_tags($_POST["txtUsername"]) ; // Prevent Cross-Site Scripting attacks(XSS)
                $name 		    = strip_tags($_POST["txtName"]) ;
                $gender 	    = strip_tags($_POST["slGender"]) ;
                $address 	    = strip_tags($_POST["txtAddress"]) ;
                $phonenumber 	= strip_tags($_POST["txtPhoneNumber"]) ;
                $birthdate 	    = strip_tags($_POST["slBirthdate"]) ;
                $identitycard 	= strip_tags($_POST["txtIdentityCard"]) ;

                $error = "";

                if(strlen(trim($name))==0){
                    $error = "Please enter your name!";
                } else if($gender=="2"){
                    $error = "Please select your gender!";
                } else if(strlen(trim($address))==0){
                    $error = "Please enter your address!";
                } else if(strlen(trim($phonenumber))<8 || strlen(trim($phonenumber))>12){
                    $error = "Phone number from 8 to 12 numbers.";
                } else if($birthdate == null){
                    $error = "Please select your birthdate!";
                } else {

                    $result = $this->customermodel->UpdateCustomer($username, $name, $gender, $address, $phonenumber, $birthdate, $identitycard);

                    if($result == "true"){
                        $notice = "Save successfully";
                        $this->getView("master1",[
                            "url"		=>	$this->getBaseUrl(),
                            "act"		=>	"0",
                            "page"		=>	"Personal_Information_View",
                            "brand1"	=>	$this->brandmodel->GetAllBrand(),
                            "brand2"	=>	$this->brandmodel->GetAllBrand(),
                            "customer"	=>	$this->customermodel->GetDetailCustomer($_SESSION["username"]["id"]),
                            "notice"	=>	$notice
                        ]);


                    } else {
                        $error = "Save failed. Please check again!";
                        $this->getView("master1",[
                            "url"		=>	$this->getBaseUrl(),
                            "act"		=>	"0",
                            "page"		=>	"Personal_Information_View",
                            "brand1"	=>	$this->brandmodel->GetAllBrand(),
                            "brand2"	=>	$this->brandmodel->GetAllBrand(),
                            "customer"	=>	$this->customermodel->GetDetailCustomer($_SESSION["username"]["id"]),
                            "error"		=>	$error
                        ]);
                    }
                }

                $this->getView("master1",[
                    "url"	    =>	$this->getBaseUrl(),
                    "act"	    =>	"0",
                    "page"	    =>	"Personal_Information_View",
                    "brand1"	=>	$this->brandmodel->GetAllBrand(),
                    "brand2"	=>	$this->brandmodel->GetAllBrand(),
                    "customer"  =>	$this->customermodel->GetDetailCustomer($_SESSION["username"]["id"]),
                    "error"	    =>	$error
                ]);

            }else{
                $url = $this->getBaseUrl()."Home";
                header("Location: ".$url);
            }
        }

        #Action: Order
        function Order()
        {
            if(isset($_POST["btnOrder"])){
                // Check valid Payment
                if(!isset($_POST["payment"])){
                    $this->getView("master1",[
                        "url"		=>	$this->getBaseUrl(),
                        "act"		=>	"0",
                        "page"	    =>	"Cart_View",
                        "brand1"	=>	$this->brandmodel->GetAllBrand(),
                        "brand2"	=>	$this->brandmodel->GetAllBrand(),
                        "payment"	=>	$this->paymentmodel->GetAllPayment(),
                        "error"	=>	"Please choice your payment!"
                    ]);
                    return false;
                }
                // Check valid username
                if(!isset($_SESSION["username"]["id"])){
                    $this->getView("master1",[
                        "url"		=>	$this->getBaseUrl(),
                        "act"		=>	"0",
                        "page"	    =>	"Cart_View",
                        "brand1"	=>	$this->brandmodel->GetAllBrand(),
                        "brand2"	=>	$this->brandmodel->GetAllBrand(),
                        "payment"	=>	$this->paymentmodel->GetAllPayment(),
                        "error"	=>	"Please sign in to countinue!"
                    ]);
                    return false;
                }

                // Order
                $orderID 		= $this->ordermodel->GetIDOrder() + 1;
                $date 		    = gmdate('Y-m-d H:i:s');
                $address 		= $_SESSION["username"]["address"];
                $status 		= 0;
                $payments 	    = $_POST["payment"];
                $username 		= $_SESSION["username"]["id"];

                $result1 = $this->ordermodel->CreateOrder($orderID, $date, $address, $status, $payments, $username);
                $result2 = "";
                $result3 = "";

                foreach ($_SESSION["cart"] as $key => $value) {
                    $productID 	    = $key;
                    $quantity 		= $value["qty"];
                    $total 	        = $value["qty"] * $value["price"];
                    $result2 		= $this->ordermodel->AddProductToBill($productID, $orderID, $quantity, $total); // Add product to receipt
                    $result3 		= $this->ordermodel->UpdateAmount($productID, $orderID); // Update Amount 
                }
                
                $notice = "";

                if($result1 == "true" && $result2 == "true" && $result3 == "true"){
                    $notice = "Order Success. Products will be shipped to you soonest.";
                    unset($_SESSION["cart"]);
                    unset($_SESSION["total"]);
                    unset($_SESSION["total_qty"]);
                } else {
                    $notice = "Order failed. Please check again!";
                }
                

                $this->getView("master1",[
                    "url"	    =>	$this->getBaseUrl(),
                    "act"	    =>	"0",
                    "page"	    =>	"Cart_View",
                    "brand1"	=>	$this->brandmodel->GetAllBrand(),
                    "brand2"	=>	$this->brandmodel->GetAllBrand(),
                    "payment"	=>	$this->paymentmodel->GetAllPayment(),
                    "notice"	=>	$notice
                ]);
                

            }else{
                $this->getView("master1",[
                    "url"	    =>	$this->getBaseUrl(),
                    "act"	    =>	"0",
                    "page"	    =>	"Cart_View",
                    "brand1"	=>	$this->brandmodel->GetAllBrand(),
                    "brand2"	=>	$this->brandmodel->GetAllBrand(),
                    "payment"	=>	$this->paymentmodel->GetAllPayment()
                ]);
            }
        }

        # Action: Display Change_Password_View
        function display_Change_Password()
        {
            if(isset($_SESSION["username"]["id"])){
                $this->getView("master1",[
                    "url"	    =>	$this->getBaseUrl(),
                    "act"	    =>	"0",
                    "page"	    =>	"Change_Password_View",
                    "brand1"	=>	$this->brandmodel->GetAllBrand(),
                    "brand2"	=>	$this->brandmodel->GetAllBrand()
                ]);
            }else{
                $url = $this->getBaseUrl()."Home";
                header("Location: ".$url);
            }
        }

        # Action: Change Password
        function Change_Password()
        {
            if(isset($_POST["btnSave"])){

                $currentpass	    = strip_tags($_POST["txtCurrentPassword"]);
                $newpassword 		= strip_tags($_POST["txtNewPassword1"]);
                $re_password 	    = strip_tags($_POST["txtNewPassword2"]);

                $error = "";
                
                if(strlen(trim($newpassword)) < 8){
                    $error = "New password from 8 characters or more.";
                }else if($newpassword != $re_password){
                    $error = "Confirmation password does not match.";
                }else if($this->customermodel->CheckPassword($_SESSION["username"]["id"], $currentpass)=="false"){
                    $error = "The current password is incorrect.";
                }else{
                    $result = $this->customermodel->ChangePassword($_SESSION["username"]["id"], $newpassword);
                    
                    if($result=="true"){
                        $this->getView("master1",[
                            "url"		=>	$this->getBaseUrl(),
                            "act"		=>	"0",
                            "page"		=>	"Change_Password_View",
                            "brand1"	=>	$this->brandmodel->GetAllBrand(),
                            "brand2"	=>	$this->brandmodel->GetAllBrand(),
                            "notice"	=>	"Change password successfully."
                        ]);
                    }else{
                        $this->getView("master1",[
                            "url"		=>	$this->getBaseUrl(),
                            "act"		=>	"0",
                            "page"		=>	"Change_Password_View",
                            "brand1"	=>	$this->brandmodel->GetAllBrand(),
                            "brand2"	=>	$this->brandmodel->GetAllBrand(),
                            "error"		=>	"Change password failed. Please check again!"
                        ]);
                    }
                }

                $this->getView("master1",[
                    "url"       =>  $this->getBaseUrl(),
                    "act"       =>  "0",
                    "page"      =>  "Change_Password_View",
                    "brand1"    =>  $this->brandmodel->GetAllBrand(),
                    "brand2"    =>  $this->brandmodel->GetAllBrand(),
                    "error"     =>  $error
                ]);
            }else{
                $url = $this->getBaseUrl()."Home";
                header("Location: ".$url);
            }
        }

        // Action: display the bill of customer
        function display_The_Bills_Of_Customer()
        {
            if(isset($_SESSION["username"]["id"])){

                $this->getView("master1",[
                    "url"	    =>	$this->getBaseUrl(),
                    "act"	    =>	"bill",
                    "page"	    =>	"The_Bills_Of_Customer_View",
                    "brand1"	=>	$this->brandmodel->GetAllBrand(),
                    "brand2"	=>	$this->brandmodel->GetAllBrand(),
                    "list"	    =>	$this->ordermodel->GetBillsOfCustomer($_SESSION["username"]["id"])
                ]);
            }else{
                $url = $this->getBaseUrl()."Home";
                header("Location: ".$url);
            }
        }

        // Action: display detail the bill - using web service (REST)
        function display_Detail_The_Bill($orderID=0)
        {
            
            if($orderID != 0){

                $result = $this->ordermodel->GetCustomer($orderID);
                $json_response = "";

                if(mysqli_num_rows($result)>0)
                {
                    $row = mysqli_fetch_array($result);

                    $response['username'] = $row['cus_username'];
                    $response['name'] = $row['cus_name'];
                    $response['gender'] = $row['cus_gender'];
                    $response['address'] = $row['cus_address'];
                    $response['phone_number'] = $row['cus_phone_number'];
                    $response['email'] = $row['cus_email'];
                    $response['birthdate'] = $row['cus_birthdate'];
                    $response['identity_card'] = $row['cus_identity_card'];
                    
                    $json_response = json_encode($response);

                }

                $this->getView("master1",[
                    "url"		=>	$this->getBaseUrl(),
                    "act"		=>	"bill",
                    "page"	    =>	"The_Bill_Detail_Of_Customer_View",
                    "list"	    =>	$this->ordermodel->GetDetailOrder($orderID),
                    "payment"	=>	$this->ordermodel->GetPayment($orderID),
                    "customer"	=>	$json_response,
                    "checkout"	=>	$this->ordermodel->CheckOut($orderID),
                    "brand1"	=>	$this->brandmodel->GetAllBrand(),
                    "brand2"	=>	$this->brandmodel->GetAllBrand(), 
                ]);
            }else{
                $url = $this->getBaseUrl()."Home";
                header("Location: ".$url);
            }
            
        }
        // Action: display Sign_Up_View
        function Registration()
        {
            
            unset($_SESSION["txtUsername"]);
            unset($_SESSION["txtName"]);
            unset($_SESSION["slGender"]);
            unset($_SESSION["txtAddress"]);
            unset($_SESSION["txtPhoneNumber"]);
            unset($_SESSION["slBirthdate"]);
            unset($_SESSION["txtIdentityCard"]);

            if(isset($_POST["btnSubmit"])){
                $_SESSION["txtEmail"]= $_POST["txtEmail"];
                $this->getView("master1",[
                    "page"	    =>	"Sign_Up_View",
                    "url"	    =>	$this->getBaseUrl(),
                    "act"	    =>	"0",
                    "brand1"	=>	$this->brandmodel->GetAllBrand(),
                    "brand2"	=>	$this->brandmodel->GetAllBrand(),
                ]);
            }else{
                $url = $this->getBaseUrl()."Home";
                header("Location: ".$url);
            }
        }

        // Action: Add product to compare
        function Add_Product_To_Compare($id=0)
        {
            if(!isset($_SESSION["pro1"])){
                $_SESSION["pro1"] = $id;
            }else{
                $_SESSION["pro2"] = $id;
            }

            $url = $this->getBaseUrl()."Home";
            header("Location: ".$url);

        }

        // Action: display Compare_View
        function display_Compare()
        {
            if(isset($_SESSION["pro1"]) && isset($_SESSION["pro2"])){
                $this->getView("master1",[
                    "page"	    =>	"Compare_View",
                    "url"	    =>	$this->getBaseUrl(),
                    "act"	    =>	"compare",
                    "brand1"	=>	$this->brandmodel->GetAllBrand(),
                    "brand2"	=>	$this->brandmodel->GetAllBrand(),
                    "pro1"	    =>	$this->productmodel->SearchDetail($_SESSION["pro1"]),
                    "pro2"	    =>	$this->productmodel->SearchDetail($_SESSION["pro2"])
                ]);
            }else{
                $this->getView("master1",[
                    "page"	    =>	"Compare_View",
                    "url"	    =>	$this->getBaseUrl(),
                    "act"	    =>	"compare",
                    "brand1"	=>	$this->brandmodel->GetAllBrand(),
                    "brand2"	=>	$this->brandmodel->GetAllBrand(),
                    "notice"	=>	"<h3 align='center'>You need to select 2 products to conduct a comparison</h3>"
                ]);
            }
        }

        // Action: Change product
        function Change_Product($id=0){
            if($id != 0){
                unset($_SESSION["pro".$id]);
                $url = $this->getBaseUrl()."Home";
                header("Location: ".$url);
            }else{
                $url = $this->getBaseUrl()."Home";
                header("Location: ".$url);
            }
        }

        
    
    }
    

?>