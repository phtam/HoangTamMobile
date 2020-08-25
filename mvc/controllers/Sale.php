<?php 

    if(isset($_SESSION["username"])){

    class Sale extends Controller{
        
        protected $salemodel;

        function __construct()
        {
            $this->salemodel = $this->getModel("SaleModel");;
        }

        function Default(){
            $this->getView("master2",[
                "url"=>$this->getBaseUrl(),
                "page"=>"Sale_View",
                "act"=>"sale",
                "list"=>$this->salemodel->GetAllSale()
            ]);
            unset($_SESSION["txtSaleName"]);
            unset($_SESSION["txtContent"]);
            unset($_SESSION["slStartDate"]);
            unset($_SESSION["slEndDate"]);
        }

        function display_Add_Sale(){
            $this->getView("master2",[
                "url"   =>  $this->getBaseUrl(),
                "page"  =>  "Sale_Add_View",
                "act"   =>  "sale"
            ]);
        }

        function display_Update_Sale($id=0){
            if($id!=0){
                $this->getView("master2",[
                    "url"       =>  $this->getBaseUrl(),
                    "page"      =>  "Sale_Update_View",
                    "act"       =>  "sale",
                    "detail"    =>  $this->salemodel->GetDetail($id)
                ]);
            }else{
                $url = $this->getBaseUrl()."Sale";
                header("Location: ".$url);
            }
        }

        function Add_Sale(){
            if(isset($_POST["btnAdd"])){
                $name           =   $_POST["txtSaleName"];
                $content        =   $_POST["txtContent"];
                $startDate      =   $_POST["slStartDate"];
                $endDate        =   $_POST["slEndDate"];
                $file           =   $_FILES["flImage"];

                $_SESSION["txtSaleName"]    =   $name;
                $_SESSION["txtContent"]     =   $content;
                $_SESSION["slStartDate"]    =   $startDate;
                $_SESSION["slEndDate"]      =   $endDate;
                
                $error="";

                if(strlen(trim($name))==0){
                    $error="Sale Name is not blank.";
                } else if(strlen(trim($content))==0){
                    $error="Content is not blank.";
                } else if($startDate==null){
                    $error="Select start date.";
                } else if($endDate == null){
                    $error="Select end date.";
                } else if($startDate > $endDate){
                    $error="Start date must be after end date.";
                }
                else{
                    $result = $this->salemodel->AddSale($name, $content, $startDate, $endDate, $file["name"]); 

                    if($result=="true"){
                        $error = $this->Upload_Image($file);
                        unset($_SESSION["hdSaleID"]);
                        unset($_SESSION["txtSaleName"]);
                        unset($_SESSION["txtContent"]);
                        unset($_SESSION["slStartDate"]);
                        unset($_SESSION["slEndDate"]);
                    
                        $this->getView("master2",[
                            "url"       =>  $this->getBaseUrl(),
                            "page"      =>  "Sale_View",
                            "act"       =>  "sale",
                            "list"      =>  $this->salemodel->GetAllSale(),
                            "notice"    =>  "Add successfully.",
                            "error"     =>  $error
                        ]);
                    } else {
                        $error="Save failed. Please check again!";
                        $this->getView("master2",[
                            "url"   =>  $this->getBaseUrl(),
                            "page"  =>  "Sale_Add_View",
                            "act"   =>  "sale",
                            "error" =>  $error
                        ]);
                    }
                }
              
                $this->getView("master2",[
                    "url"   =>  $this->getBaseUrl(),
                    "page"  =>  "Sale_Add_View",
                    "act"   =>  "sale",
                    "error" =>  $error
                ]);
                
            }else{
                $url = $this->getBaseUrl()."Sale";
                header("Location: ".$url);
            }

        }

        function Upload_Image($file=""){
            if($file != ""){

                $tentaptin = $file["name"];
                $error = "";

                if($file['type']=="image/jpg" || $file['type']=="image/png" || $file['type']=="image/jepg"){
                    if($file['size'] <= 5242880){
                        if(!file_exists($this->getBaseUrl()."public/images_sale/".$tentaptin)){
                            if($file["error"]==0){

                                move_uploaded_file($file["tmp_name"], "./public/images_sale/".$tentaptin);
                                 
                            }else{
                                $error = "File has been failed. Please check again!";
                            }   
                        }else{
                            $error = "File already exists on the system. Please check again!";
                        }
                    }else{
                        $error = "File must be less than 5MB.";
                    }
                }else{
                    $error="File must be in .jpg or .jpeg or .png format.";
                }

                return $error;
                    

            }else{
                $url = $this->getBaseUrl()."Sale";
                header("Location: ".$url);
            }
        }

        function Update_Sale(){
            if(isset($_POST["btnCapNhat"])){
                $id         =   $_POST["hdSaleID"];
                $name       =   $_POST["txtSaleName"];
                $content    =   $_POST["txtContent"];
                $startDate  =   $_POST["slStartDate"];
                $endDate    =   $_POST["slEndDate"];
                $file       =   $_FILES["flImage"];

                $error="";

                if(strlen(trim($name))==0){
                    $error="Sale Name is not blank.";
                } else if(strlen(trim($content))==0){
                    $error="Content is not blank.";
                } else if($startDate==null){
                    $error="Select start date.";
                } else if($endDate == null){
                    $error="Select end date.";
                } else if($startDate > $endDate){
                    $error="Start date must be after end date.";
                }
                else{
                    $result = $this->salemodel->UpdateSale($id, $name, $content, $startDate, $endDate, $file["name"]); 

                    if($result=="true"){
                        $error = $this->Upload_Image($file);
                        $notice = "Save successfully.";
                        $this->getView("master2",[
                            "url"       =>  $this->getBaseUrl(),
                            "page"      =>  "Sale_View",
                            "act"       =>  "sale",
                            "list"      =>  $this->salemodel->GetAllSale(),
                            "notice"    =>   $notice,
                            "error"     =>   $error
                        ]);
                    } else {
                        $error="Save failed. Please check again!";
                        $this->getView("master2",[
                            "url"       =>  $this->getBaseUrl(),
                            "page"      =>  "Sale_Update_View",
                            "act"       =>  "sale",
                            "error"     =>  $error,
                            "detail"    =>  $this->salemodel->GetDetail($id)
                        ]);
                    }
                }
                
                $this->getView("master2",[
                    "url"       =>  $this->getBaseUrl(),
                    "page"      =>  "Sale_Update_View",
                    "act"       =>  "sale",
                    "error"     =>  $error,
                    "detail"    =>  $this->salemodel->GetDetail($id)
                ]);
                
            }else{
                $url = $this->getBaseUrl()."Sale";
                header("Location: ".$url);
            }
        }
       
        function Delete_Sale($id=0){
            if($id != 0){
                if($this->salemodel->DeleteSale($id)=="true"){
                    $notice = "Delete successfully.";
                } else {
                    $notice = "Delete failed. Sale has been managed.";
                }
                $this->getView("master2",[
                    "url"=>$this->getBaseUrl(),
                    "page"=>"Sale_View",
                    "act"=>"sale",
                    "list"=>$this->salemodel->GetAllSale(),
                    "notice"=>$notice
                ]);
            }else{
                $url = $this->getBaseUrl()."Sale";
                header("Location: ".$url);
            }
        }
 
    }
    
    } else {
        header("Location: localhost:1000/HoangTamMobile/Home");
    }


?>