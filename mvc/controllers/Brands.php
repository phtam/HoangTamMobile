<?php 
   if(isset($_SESSION["username"])){

    class Brands extends Controller{

        protected $brandmodel;

        // Constructer
        function __construct()
        {
            $this->brandmodel = $this->getModel("BrandsModel");;
        }

        // The default display function
        function Default(){
            $this->getView("master2",[
                "url"   =>  $this->getBaseUrl(),
                "act"   =>  "brand",
                "page"  =>  "Brands_View",
                "list"  =>  $this->brandmodel->GetAllBrand()
            ]);

        }

        // Action: Display BrandsAdd View
        function display_Add_Brand(){
            $this->getView("master2",[
                "url"   =>  $this->getBaseUrl(),
                "act"   =>  "brand",
                "page"  =>  "Brands_Add_View"
            ]);
        }

        // Action: Display Brands_Update_View View
        function display_Update_Brand($id=0){
            if($id !=0 ){
                $this->getView("master2",[
                    "url"       =>  $this->getBaseUrl(),
                    "act"       =>  "brand",
                    "page"      =>  "Brands_Update_View",
                    "detail"    =>  $this->brandmodel->GetDetailBrand($id)
                ]);
            }else{
                $url = $this->getBaseUrl()."Brands";
                header("Location: ".$url);
            }
        }

        // Action: Add Brand 
        function add_Brand(){
            if(isset($_POST["btnAdd"])){
                $name    = $_POST["txtBrandName"];
                $desc    = $_POST["txtBrandDesc"];

                $_SESSION["txtBrandName"]    = $name;
                $_SESSION["txtBrandDesc"]    = $desc;

                $error="";

                if(strlen(trim($name))==0){
                    $error  = "Brand name is not blank!";
                }else{
                    $result = $this->brandmodel->AddBrand($name, $desc);
                    if($result=="true"){
                        $this->getView("master2",[
                            "url"       =>  $this->getBaseUrl(),
                            "act"       =>  "brand",
                            "page"      =>  "Brands_View",
                            "list"      =>  $this->brandmodel->GetAllBrand(),
                            "notice"    =>  "Add successfully!"
                        ]);
                        unset($_SESSION["txtBrandName"]);
                        unset($_SESSION["txtBrandDesc"]);
                    }else{
                        $this->getView("master2",[
                            "url"       =>  $this->getBaseUrl(),
                            "act"       =>  "brand",
                            "page"      =>  "Brands_View",
                            "list"      =>  $this->brandmodel->GetAllBrand(),
                            "notice"    =>  "Add new failed. Please check again."
                        ]);
                    }
                }

                $this->getView("master2",[
                    "url"   =>  $this->getBaseUrl(),
                    "act"   =>  "brand",
                    "page"  =>  "Brands_Add_View",
                    "error" =>  $error
                ]);

            }else{
                $url = $this->getBaseUrl()."Brands";
                header("Location: ".$url);
            }
            
        }

        // Action: Update Brand
        function update_Brand(){
            if(isset($_POST["btnUpdate"])){
                $id     = $_POST["hdBrandId"];
                $name   = $_POST["txtBrandName"];
                $desc   = $_POST["txtBrandDesc"];

                $error="";

                if(strlen(trim($name))==0){
                    $error  = "Brand name is not blank!";
                }else{
                    $result = $this->brandmodel->UpdateBrand($id ,$name, $desc);
                    if($result=="true"){
                        $this->getView("master2",[
                            "url"       =>  $this->getBaseUrl(),
                            "act"       =>  "brand",
                            "page"      =>  "Brands_View",
                            "list"      =>  $this->brandmodel->GetAllBrand(),
                            "notice"    =>  "Save successfully!"
                        ]);
                        
                    }else{
                        $error ="Update failed. Please check again.";
                        $this->getView("master2",[
                            "url"       =>  $this->getBaseUrl(),
                            "act"       =>  "brand",
                            "page"      =>  "Brands_Update_View",
                            "detail"    =>  $this->brandmodel->GetDetailBrand($id),
                            "error"     =>  $error
                        ]);
                        
                    }
                }

                $this->getView("master2",[
                    "url"       =>  $this->getBaseUrl(),
                    "act"       =>  "brand",
                    "page"      =>  "Brands_Update_View",
                    "detail"    =>  $this->brandmodel->GetDetailBrand($id),
                    "error"     =>  $error
                ]);

            }else{
                $url = $this->getBaseUrl()."Brands";
                header("Location: ".$url);
            }
        }

        // Action: Delete Brand
        function delete_Brand($id=0){
            if($id != 0 ){
                $result = $this->brandmodel->DeleteBrand($id);
                if($result  ==  "true"){
                    $notice = "Delete successfully!";
                }else{
                    $notice = "You cannot delete! Resources are being managed!";
                }
                $this->getView("master2",[
                    "url"       =>  $this->getBaseUrl(),
                    "act"       =>  "brand",
                    "page"      =>  "Brands_View",
                    "list"      =>  $this->brandmodel->GetAllBrand(),
                    "notice"    =>  $notice
                ]);
            }else{
                $url = $this->getBaseUrl()."Brands";
                header("Location: ".$url);
            }
        }


    } # end class

    } else {
        header("Location: localhost:1000/HoangTamMobile/Home");
    } # end if ... else

?>