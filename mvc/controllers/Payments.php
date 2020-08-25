<?php 
    if(isset($_SESSION["username"])){
        class Payments extends Controller{

            protected $paymentmodel;
            
            function __construct()
            {
                $this->paymentmodel = $this->getModel("PaymentModel");
            }

            function Default(){
                $this->getView("master2",[
                    "url"   =>  $this->getBaseUrl(),
                    "act"   =>  "payment",
                    "page"  =>  "Payment_View",
                    "list"  =>  $this->paymentmodel->GetAllPayment()
                ]);
                unset($_SESSION["txtPaymentName"]);
            }

            function display_Add_Payment(){
                $this->getView("master2",[
                    "url"   =>  $this->getBaseUrl(),
                    "act"   =>  "payment",
                    "page"  =>  "Payment_Add_View"
                ]);
            }

            function display_Update_Payment($id){
                $this->getView("master2",[
                    "url"       =>  $this->getBaseUrl(),
                    "act"       =>  "payment",
                    "page"      =>  "Payment_Update_View",
                    "detail"    =>  $this->paymentmodel->GetDetailPayment($id)
                ]);
            }
            
            function Add_Payment(){
                if(isset($_POST["btnAdd"])){
                    $name = $_POST["txtPaymentName"];
                    $_SESSION["txtPaymentName"] = $name;

                    $error = "";
                    if(strlen(trim($name))==0){
                        $error  = "Payment name is not blank."; 
                    }else{
                        $result = $this->paymentmodel->AddPayment($name);
                        
                        if($result == "true"){
                            $this->getView("master2",[
                                "url"       =>  $this->getBaseUrl(),
                                "act"       =>  "payment",
                                "page"      =>  "Payment_View",
                                "list"      =>  $this->paymentmodel->GetAllPayment(),
                                "notice"    =>  "Add successfully."
                            ]);
                            unset($_SESSION["txtPaymentName"]);
                        }else{
                            $error = "Add failed. Please check again!"; 
                            $this->getView("master2",[
                                "url"       =>  $this->getBaseUrl(),
                                "act"       =>  "payment",
                                "page"      =>  "Payment_Add_View",
                                "notice"    =>  $error
                            ]);
                        }
                    }

                    $this->getView("master2",[
                        "url"=>$this->getBaseUrl(),
                        "act"=>"payment",
                        "page"=>"Payment_Add_View",
                        "error"=>$error
                    ]);

                }else{
                    $url = $this->getBaseUrl()."Payments";
                    header("Location: ".$url);
                }
            }
           
            function Update_Payment(){
                if(isset($_POST["btnUpdate"])){
                    $name   = $_POST["txtPaymentName"];
                    $id     = $_POST["hdPaymentID"];

                    $error  = "";
                    if(strlen(trim($name))==0){
                        $error  = "Payment name is not blank."; 
                    }else{
                        $result = $this->paymentmodel->UpdatePayment($id, $name);
                        
                        if($result == "true"){
                            $this->getView("master2",[
                                "url"       =>  $this->getBaseUrl(),
                                "act"       =>  "payment",
                                "page"      =>  "Payment_View",
                                "list"      =>  $this->paymentmodel->GetAllPayment(),
                                "notice"    =>  "Save successfully."
                            ]);
                            unset($_SESSION["txtPaymentName"]);
                        }else{
                            $error = "Save failed. Please check again!"; 
                            $this->getView("master2",[
                                "url"       =>  $this->getBaseUrl(),
                                "act"       =>  "payment",
                                "page"      =>  "Payment_Update_View",
                                "detail"    =>  $this->paymentmodel->GetDetailPayment($id),
                                "error"     =>  $error
                            ]);
                        }
                    }

                    $this->getView("master2",[
                        "url"       =>  $this->getBaseUrl(),
                        "act"       =>  "payment",
                        "page"      =>  "Payment_Update_View",
                        "detail"    =>  $this->paymentmodel->GetDetailPayment($id),
                        "error"     =>  $error
                    ]);

                }else{
                    $url = $this->getBaseUrl()."Payments";
                    header("Location: ".$url);
                }
            }
            
            function delete_Payment($id=0)
            {
                if($id!=0){
                    $result = $this->paymentmodel->DeletePayment($id);
                    $notice = "";
                    if($result == "true"){
                        $notice = "Delete successfully.";
                    }else{
                        $notice = "You can't delete the payment. Because it has been managed.";
                    }
                    $this->getView("master2",[
                        "url"       =>  $this->getBaseUrl(),
                        "act"       =>  "payment",
                        "page"      =>  "Payment_View",
                        "list"      =>  $this->paymentmodel->GetAllPayment(),
                        "notice"    =>    $notice
                    ]);
                }else{
                    $url = $this->getBaseUrl()."Payments";
                    header("Location: ".$url);
                }
            }

        }
    }else{
        header("Location: localhost:1000/HoangTamMobile/Home");
    }

?>