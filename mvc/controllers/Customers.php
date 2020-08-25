<?php

    if(isset($_SESSION["username"])){

    class Customers extends Controller {
        
        protected $customermodel;

        public function __construct()
        {
            $this->customermodel = $this->getModel("CustomersModel");
            $this->getPHPMailer();
        }

        function Default()
        {
            $this->getView("master2",[
                "url"   =>  $this->getBaseUrl(),
                "act"   =>  "customer",
                "page"  =>  "Customers_View",
                "list"  =>  $this->customermodel->GetAllCustomer()
            ]);
            unset($_SESSION["txtUsername"]);
            unset($_SESSION["txtName"]);
            unset($_SESSION["txtAddress"]);
            unset($_SESSION["txtPhoneNumber"]);
            unset($_SESSION["slGender"]);
            unset($_SESSION["txtEmail"]);
            unset($_SESSION["slBirthdate"]);
            unset($_SESSION["txtIdentityCard"]);

        }

        // Action: Display CustomerAdd
        function display_Add_Customer()
        {
            $this->getView("master2",[
                "url"   =>  $this->getBaseUrl(),
                "act"   =>  "customer",
                "page"  =>  "Customers_Add_View"
            ]);
        }

        // Action: display CustomerUpdate
        function display_Update_Customer($username = "")
        {
            if($username != ""){
                $this->getView("master2",[
                    "url"       =>  $this->getBaseUrl(),
                    "act"       =>  "customer",
                    "page"      =>  "Customers_Update_View",
                    "detail"    =>  $this->customermodel->GetDetailCustomer($username)

                ]);
            }else{
                $url = $this->getBaseUrl()."Customers";
                header("Location: ".$url);
            }
            
        }

        // Action: Add Customer
        function Add_Customer(){
            if(isset($_POST["btnSignUp"])){
                $username       = $_POST["txtUsername"] ;
                $password       = $_POST["txtPassword"] ;
                $name           = $_POST["txtName"] ;
                $gender         = $_POST["slGender"] ;
                $address        = $_POST["txtAddress"] ;
                $phonenumber    = $_POST["txtPhoneNumber"] ;
                $email          = $_POST["txtEmail"] ;
                $birthdate      = $_POST["slBirthdate"] ;
                $identitycard   = $_POST["txtIdentityCard"] ;
                $code           = md5(rand());
                $status         = 1;
                $admin          = 1;

                $_SESSION["txtUsername"]        =   $username ;
                $_SESSION["txtName"]            =   $name ;
                $_SESSION["txtAddress"]         =   $address ;
                $_SESSION["slGender"]           =   $gender ;
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
                        $this->getView("master2",[
                            "url"       =>  $this->getBaseUrl(),
                            "act"       =>  "customer",
                            "page"      =>  "Customers_View",
                            "list"      =>  $this->customermodel->GetAllCustomer(),
                            "notice"    =>  $notice
                        ]);
                        unset($_SESSION["txtUsername"]);
                        unset($_SESSION["txtName"]);
                        unset($_SESSION["txtAddress"]);
                        unset($_SESSION["txtPhoneNumber"]);
                        unset($_SESSION["txtEmail"]);
                        unset($_SESSION["slBirthdate"]);
                        unset($_SESSION["txtIdentityCard"]);
                        unset($_SESSION["slGender"]);

                        $url        = $this->getBaseUrl()."Home/Actice_Account/$username/$code";
                        $home       = $this->getBaseUrl()."Home";
                        $content    = "<p>Congratulations $name has successfully registered your account at <a href='$home'>Hoang Tam Mobile website<a>.</p>"."<p>
                        Please click the following link to activate your account:<a href='$url'>$url</p>";

                        $subject    = "Hoang Tam Mobile";

                        $this->sendMail($subject, $content, $email, $email);
                       

                    } else {
                        $notice = "Sign up failed. Please check again!";
                        $this->getView("master2",[
                            "url"       =>  $this->getBaseUrl(),
                            "act"       =>  "customer",
                            "page"      =>  "Customers_View",
                            "list"      =>  $this->customermodel->GetAllCustomer(),
                            "notice"    =>  $notice
                        ]);
                    }
                }

                $this->getView("master2",[
                    "url"   =>  $this->getBaseUrl(),
                    "act"   =>  "customer",
                    "page"  =>  "Customers_Add_View",
                    "error" =>  $error
                ]);

            }else{
                $url = $this->getBaseUrl()."Customers";
                header("Location: ".$url);
            }
        }

        // Action: Update Customer
        function Update_Customer(){
            if(isset($_POST["btnUpdate"])){
                $username       = $_POST["txtUsername"] ;
                $name           = $_POST["txtName"] ;
                $gender         = $_POST["slGender"] ;
                $address        = $_POST["txtAddress"] ;
                $phonenumber    = $_POST["txtPhoneNumber"] ;
                $birthdate      = $_POST["slBirthdate"] ;
                $identitycard   = $_POST["txtIdentityCard"] ;

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
                    $error = "Please select your birthdate";
                } else {

                    $result = $this->customermodel->UpdateCustomer($username, $name, $gender, $address, $phonenumber, $birthdate, $identitycard);

                    if($result == "true"){
                        $notice = "Save successfully.";
                        $this->getView("master2",[
                            "url"       =>  $this->getBaseUrl(),
                            "act"       =>  "customer",
                            "page"      =>  "Customers_View",
                            "list"      =>  $this->customermodel->GetAllCustomer(),
                            "notice"    =>  $notice
                        ]);


                    } else {
                        $error = "Save failed. Please check again!";
                        $this->getView("master2",[
                            "url"       =>  $this->getBaseUrl(),
                            "act"       =>  "customer",
                            "page"      =>  "Customers_Update_View",
                            "detail"    =>  $this->customermodel->GetDetailCustomer($username),
                            "error"     =>  $error
        
                        ]);
                    }
                }

                $this->getView("master2",[
                    "url"       =>  $this->getBaseUrl(),
                    "act"       =>  "customer",
                    "page"      =>  "Customers_Update_View",
                    "detail"    =>  $this->customermodel->GetDetailCustomer($username),
                    "error"     =>  $error
    
                ]);

            }else{
                $url = $this->getBaseUrl()."Customers";
                header("Location: ".$url);
            }
        }

        // Action: delete Customer
        function delete_Customer($username="")
        {
            if($username != ""){
                $result = $this->customermodel->DeleteCustomer($username);

                if($result == "true"){
                    $notice = "Delete successfully.";
                } else {
                    $notice= "Delete failed. Customer information is being managed.";
                }

                $this->getView("master2",[
                    "url"       =>  $this->getBaseUrl(),
                    "act"       =>  "customer",
                    "page"      =>  "Customers_View",
                    "list"      =>  $this->customermodel->GetAllCustomer(),
                    "notice"    =>  $notice
                ]);

            }else{
                $url = $this->getBaseUrl()."Customers";
                header("Location: ".$url);
            }
        }

        # Action: Send Mail
        function sendMail($title, $content, $nTo, $mTo){
          
            $nFrom              = 'Hoang Tam Mobile';
            $mFrom              = 'didonghoangtam342@gmail.com'; 
            $mPass              = '0327291328';
            $mail               = new PHPMailer();
            $body               = $content;
            $mail->IsSMTP(); 
            $mail->CharSet      = "utf-8";
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
            $address            = $mTo;
            $mail->AddAddress($address, $nTo);
            !$mail->Send();
        }
        
    }

    }else {
        header("Location: localhost:1000/HoangTamMobile/Home");
    }

?>