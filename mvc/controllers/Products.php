<?php

    if(isset($_SESSION["username"])){

    class Products extends Controller{

        protected $productmodel;
        protected $salemodel;
        protected $brandmodel;

        
        public function __construct()
        {
            $this->productmodel = $this->getModel("ProductsModel");
            $this->salemodel    = $this->getModel("SaleModel");
            $this->brandmodel   = $this->getModel("BrandsModel");
        }
        

        function Default(){
            unset($_SESSION["hdProductID"]);
            unset($_SESSION["txtProductName"]);
            unset($_SESSION["txtPrice"]);
            unset($_SESSION["txtOldPrice"]);
            unset($_SESSION["txtShortDesc"]);
            unset($_SESSION["txtDesc"]);
            unset($_SESSION["txtQuantity"]);
            unset($_SESSION["txtSpecifications"]);
            unset($_SESSION["slBrands"]);
            unset($_SESSION["slSale"]); 
            
            $this->getView("master2",[
                "url"   =>  $this->getBaseUrl(),
                "page"  =>  "Products_View",
                "act"   =>  "product",
                "list"  =>  $this->productmodel->GetAllProducts()
            ]);
        }

        function display_Add_Product(){
            $this->getView("master2",[
                "url"       =>  $this->getBaseUrl(),
                "act"       =>  "product",
                "page"      =>  "Products_Add_View",
                "brands"    =>  $this->brandmodel->GetAllBrand(),
                "sale"      =>  $this->salemodel->GetAllSale()
            ]);
        }

        function display_Update_Product($productID=0){
            if($productID!=0){
                $this->getView("master2",[
                    "url"       =>  $this->getBaseUrl(),
                    "act"       =>  "product",
                    "page"      =>  "Products_Update_View",
                    "brands"    =>  $this->brandmodel->GetAllBrand(),
                    "sale"      =>  $this->salemodel->GetAllSale(),
                    "detail"    =>  $this->productmodel->GetDetailProduct($productID)
                ]);
            }else{
                $url = $this->getBaseUrl()."Products";
                header("Location: ".$url);
            }
        }

        function display_Upload_Image($id=0){
            if($id!=0){
                $this->getView("master2",[
                    "url"       =>  $this->getBaseUrl(),
                    "act"       =>  "product",
                    "page"      =>  "Upload_Image_View",
                    "detail"    =>  $this->productmodel->GetDetailProduct($id),
                    "hsp"       =>  $this->productmodel->GetProductImage($id)
                ]);
            }else{
                $url = $this->getBaseUrl()."Products";
                header("Location: ".$url);
            }
        }

        public function Add_Product(){
            if( isset($_POST['btnAdd']) ){
                
                $name           =    $_POST['txtProductName'];
                $price          =    $_POST['txtPrice'];
                $oldPrice       =    $_POST['txtOldPrice'];
                $shortDesc      =    $_POST['txtShortDesc'];
                $desc           =    $_POST['txtDesc'];
                $date           =    gmdate('Y-m-d H:i:s');
                $quantity       =    $_POST['txtQuantity'];
                $brand          =    $_POST['slBrands'];
                $sale           =    $_POST['slSale'];
                $specification  =    $_POST['txtSpecifications'];

                
                $_SESSION["txtProductName"]     =   $name;
                $_SESSION["txtPrice"]           =   $price;
                $_SESSION["txtOldPrice"]        =   $oldPrice;
                $_SESSION["txtShortDesc"]       =   $shortDesc;
                $_SESSION["txtDesc"]            =   $desc;
                $_SESSION["txtQuantity"]        =   $quantity;
                $_SESSION["txtSpecifications"]  =   $specification;
                $_SESSION["slBrands"]           =   $brand;
                $_SESSION["slSale"]             =   $sale;

                $error = "";

                if(strlen( trim($name) ) == 0 ){
                    $error = "Product name is not blank.";
                } else if(strlen( trim($price) ) == 0 ){
                    $error = "Price is not blank.";
                } else if(!is_numeric($price) ){
                    $error = "Price must be a cardinal number.";
                } else if(strlen( trim($oldPrice) ) == 0 ){
                    $error = "Old price is not blank.";
                } else if(!is_numeric($oldPrice) ){
                    $error = "Old price must be a cardinal number.";
                } else if(strlen( trim($shortDesc) ) == 0 ){
                    $error = "Short describe is not blank.";
                } else if(strlen( trim($desc) ) == 0 ){
                    $error = "Describe is not blank.";
                } else if(strlen( trim($specification) ) == 0 ){
                    $error = "Specification is not blank.";
                }else if(!is_numeric($quantity) ){
                    $error = "Quantity must be a cardinal number.";
                } else if($quantity == 0 ){
                    $error = "Quantity is not blank.";
                } else if($brand == 0 ){
                    $error = "Please select a brand.";
                } else if($sale == 0){
                    $error = "Please select a sale.";
                }else {
                    $result = $this->productmodel->AddProduct($name, $price, $oldPrice, $shortDesc, $desc, $specification, $date, $quantity, $brand, $sale);

                    if($result=="true"){
                        unset($_SESSION["txtProductName"]);
                        unset($_SESSION["txtPrice"]);
                        unset($_SESSION["txtOldPrice"]);
                        unset($_SESSION["txtShortDesc"]);
                        unset($_SESSION["txtDesc"]);
                        unset($_SESSION["txtQuantity"]);
                        unset($_SESSION["txtSpecifications"]);
                        unset($_SESSION["slBrands"]);
                        unset($_SESSION["slSale"]); 

                        $this->getView("master2",[
                            "url"       =>  $this->getBaseUrl(),
                            "page"      =>  "Products_View",
                            "act"       =>  "product",
                            "list"      =>  $this->productmodel->GetAllProducts(),
                            "notice"    =>  "Add successfully."
                        ]);
                        
                    } else {
                        $error="Add failed. Please check again!";
                        $this->getView("master2",[
                            "url"       =>  $this->getBaseUrl(),
                            "act"       =>  "product",
                            "page"      =>  "Products_Add_View",
                            "brands"    =>  $this->brandmodel->GetAllBrand(),
                            "sale"      =>  $this->salemodel->GetAllSale(),
                            "error"     =>  $error
                        ]);
                    }


                }

                $this->getView("master2",[
                    "url"       =>  $this->getBaseUrl(),
                    "act"       =>  "product",
                    "page"      =>  "Products_Add_View",
                    "brands"    =>  $this->brandmodel->GetAllBrand(),
                    "sale"      =>  $this->salemodel->GetAllSale(),
                    "error"     =>  $error
                ]);
               

            }else{
                $url = $this->getBaseUrl()."Products";
                header("Location: ".$url);
            }
            
        }

        public function Update_Product(){
            if( isset($_POST['btnUpdate']) ){
                $id             = $_POST['hdProductID'];
                $name           = $_POST['txtProductName'];
                $price          = $_POST['txtPrice'];
                $oldPrice       = $_POST['txtOldPrice'];
                $shortDesc      = $_POST['txtShortDesc'];
                $desc           = $_POST['txtDesc'];
                $date           = gmdate('Y-m-d H:i:s');
                $quantity       = $_POST['txtQuantity'];
                $brand          = $_POST['slBrands'];
                $sale           = $_POST['slSale'];
                $specification  = $_POST['txtSpecifications'];

                
                $error = "";

                if(strlen( trim($name) ) == 0 ){
                    $error = "Product name is not blank.";
                } else if(strlen( trim($price) ) == 0 ){
                    $error = "Price is not blank.";
                } else if(!is_numeric($price) ){
                    $error = "Price must be a cardinal number.";
                } else if(strlen( trim($oldPrice) ) == 0 ){
                    $error = "Old price is not blank.";
                } else if(!is_numeric($oldPrice) ){
                    $error = "Old price must be a cardinal number.";
                } else if(strlen( trim($shortDesc) ) == 0 ){
                    $error = "Short describe is not blank.";
                } else if(strlen( trim($desc) ) == 0 ){
                    $error = "Describe is not blank.";
                } else if(strlen( trim($specification) ) == 0 ){
                    $error = "Specification is not blank.";
                } else if(!is_numeric($quantity) ){
                    $error = "Quantity must be a cardinal number.";
                } else if($quantity == 0 ){
                    $error = "Quantity is not blank.";
                } else if($brand == 0 ){
                    $error = "Please select a brand.";
                } else if($sale == 0 ){
                    $error = "Please select a sale.";
                }else {
                    $result = $this->productmodel->UpdateProduct($id, $name, $price, $oldPrice, $shortDesc, $desc, $specification, $date, $quantity, $brand, $sale);

                    if($result=="true"){
                        $this->getView("master2",[
                            "url"       =>  $this->getBaseUrl(),
                            "page"      =>  "Products_View",
                            "act"       =>  "product",
                            "list"      =>  $this->productmodel->GetAllProducts(),
                            "notice"    =>  "Save successfully."
                        ]);
                        
                    } else {
                        $error="Save failed. Please check again!";
                        $this->getView("master2",[
                            "url"       =>  $this->getBaseUrl(),
                            "act"       =>  "product",
                            "page"      =>  "Products_Update_View",
                            "brands"    =>  $this->brandmodel->GetAllBrand(),
                            "sale"      =>  $this->salemodel->GetAllSale(),
                            "detail"    =>  $this->productmodel->GetDetailProduct($id),
                            "error"     =>  $error
                        ]);
                    }
                }

                $this->getView("master2",[
                    "url"       =>  $this->getBaseUrl(),
                    "act"       =>  "product",
                    "page"      =>  "Products_Update_View",
                    "brands"    =>  $this->brandmodel->GetAllBrand(),
                    "sale"      =>  $this->salemodel->GetAllSale(),
                    "detail"    =>  $this->productmodel->GetDetailProduct($id),
                    "error"     =>  $error
                ]);
               

            }else{
                $url = $this->getBaseUrl()."Products";
                header("Location: ".$url);
            }
        }

        function delete_Product($productID=0){
            if($productID!=0){
                if($this->productmodel->deleteProduct($productID)=="true"){
                    $notice="Delete successfully.";
                } else {
                    $notice="Delete failed. Product has been managed.";
                }
                $this->getView("master2",[
                    "url"       =>  $this->getBaseUrl(),
                    "page"      =>  "Products_View",
                    "act"       =>  "product",
                    "list"      =>  $this->productmodel->GetAllProducts(),
                    "notice"    =>  $notice
                ]);
            }else{
                $url = $this->getBaseUrl()."Products";
                header("Location: ".$url);
            }
        }

        function Upload_Image(){
            if(isset($_POST["btnUpdate"])){
                $id         = $_POST["txtProductID"];
                $file       = $_FILES["flImage"];
                $fileName   = $id."_".$file["name"];
                $error      = "";


                    if($file['type']=="image/jpg" || $file['type']=="image/png" || $file['type']=="image/jpeg"){
                    if($file['size'] <= 5242880){
                        if(!file_exists($this->getBaseUrl()."public/images/".$fileName)){
                            if($file["error"]==0){
                                move_uploaded_file($file["tmp_name"], "./public/images/".$fileName);

                                $result = $this->productmodel->UploadImage($fileName, $id);

                                if($result=="true"){
                                    $notice="Save successfully.";
                                }else{
                                    $notice="Save failed. Please check again!";
                                }

                                $this->getView("master2",[
                                    "url"       =>  $this->getBaseUrl(),
                                    "page"      =>  "Products_View",
                                    "act"       =>  "product",
                                    "list"      =>  $this->productmodel->GetAllProducts(),
                                    "notice"    =>  $notice
                                ]);         
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

                $this->getView("master2",[
                    "url"       =>  $this->getBaseUrl(),
                    "act"       =>  "product",
                    "page"      =>  "Upload_Image_View",
                    "detail"    =>  $this->productmodel->GetDetailProduct($id),
                    "hsp"       =>  $this->productmodel->GetProductImage($id),
                    "error"     =>  $error
                ]);
                    

            }else{
                $url = $this->getBaseUrl()."Products";
                header("Location: ".$url);
            }
        }

        function delete_Image($imgID=0, $productID=0){
            if($imgID!=0 || $productID!=0){
                $result = $this->productmodel->DeleteImage($imgID);

                if($result == "true"){
                    $notice="Delete successfully.";
                    $this->getView("master2",[
                        "url"       =>  $this->getBaseUrl(),
                        "act"       =>  "product",
                        "page"      =>  "Upload_Image_View",
                        "detail"    =>  $this->productmodel->GetDetailProduct($productID),
                        "hsp"       =>  $this->productmodel->GetProductImage($productID),
                        "notice"    =>  $notice
                    ]);
                } else {
                    $error="Delete failed. Please check again!";
                    $this->getView("master2",[
                        "url"       =>  $this->getBaseUrl(),
                        "act"       =>  "product",
                        "page"      =>  "Upload_Image_View",
                        "detail"    =>  $this->productmodel->GetDetailProduct($productID),
                        "hsp"       =>  $this->productmodel->GetProductImage($productID),
                        "error"     =>  $error
                    ]);
                }
            }else{
                $url = $this->getBaseUrl()."Products";
                header("Location: ".$url);
            }

            
        }


    } // end controller

    } else {
        header("Location: localhost:1000/HoangTamMobile/Home");
    } // end IF
?>