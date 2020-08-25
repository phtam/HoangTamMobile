<?php 
    if(isset($_SESSION["username"])){
        
        class Order extends Controller
        {
            protected $ordermodel;

            function __construct()
            {
                $this->ordermodel = $this->getModel("OrderModel");
            }

            function Default()
            {
                $this->getView("master2",[
                    "url"   =>  $this->getBaseUrl(),
                    "act"   =>  "order",
                    "page"  =>  "Order_View",
                    "list"  =>  $this->ordermodel->GetAllOrder()
                ]);
            }

            // Action: Display Detail Order
            function display_Detail($orderID=0)
            {
                if($orderID != 0){
                    $this->getView("master2",[
                        "url"       =>  $this->getBaseUrl(),
                        "act"       =>  "order",
                        "page"      =>  "Order_Detail_View",
                        "list"      =>  $this->ordermodel->GetDetailOrder($orderID),
                        "payment"   =>  $this->ordermodel->GetPayment($orderID),
                        "customer"  =>  $this->ordermodel->GetCustomer($orderID),
                        "checkout"  =>  $this->ordermodel->CheckOut($orderID)
                    ]);
                }else{
                    $this->getView("master2",[
                        "url"   =>  $this->getBaseUrl(),
                        "act"   =>  "order",
                        "page"  =>  "Order_View",
                        "list"  =>  $this->ordermodel->GetAllOrder()
                    ]);
                }
                
            }

            function Pay($orderID=0)
            {
                if($orderID != 0){

                    $result = $this->ordermodel->Pay($orderID);

                    if($result == "true"){
                        $this->getView("master2",[
                            "url"       =>  $this->getBaseUrl(),
                            "act"       =>  "order",
                            "page"      =>  "Order_View",
                            "list"      =>  $this->ordermodel->GetAllOrder(),
                            "notice"    =>  "Order ".$orderID." has been paid."
                        ]);
                    }else{
                        $this->getView("master2",[
                            "url"       =>  $this->getBaseUrl(),
                            "act"       =>  "order",
                            "page"      =>  "Order_View",
                            "list"      =>  $this->ordermodel->GetAllOrder(),
                            "notice"    =>  "Order ".$orderID." has not been paid."
                        ]);
                    }
                    
                }else{
                    $this->getView("master2",[
                        "url"   =>  $this->getBaseUrl(),
                        "act"   =>  "order",
                        "page"  =>  "Order_View",
                        "list"  =>  $this->ordermodel->GetAllOrder()
                    ]);
                }
            }

            // Delivery
            function Ship($orderID=0){
                if($orderID != 0){
                    $dateShipped = gmdate("Y-m-d H:i:s");

                    $result = $this->ordermodel->Ship($orderID, $dateShipped);

                    if($result == "true"){
                        $this->getView("master2",[
                            "url"       =>  $this->getBaseUrl(),
                            "act"       =>  "order",
                            "page"      =>  "Order_View",
                            "list"      =>  $this->ordermodel->GetAllOrder(),
                            "notice"    =>  "Order ".$orderID." has been shipped"
                        ]);
                    }else{
                        $this->getView("master2",[
                            "url"   =>  $this->getBaseUrl(),
                            "act"   =>  "order",
                            "page"  =>  "Order_View",
                            "list"  =>  $this->ordermodel->GetAllOrder(),
                            "notice"=>  "Order: ".$orderID." has not been shipped."
                        ]);
                    }
                    
                }else{
                    $this->getView("master2",[
                        "url"   =>  $this->getBaseUrl(),
                        "act"   =>  "order",
                        "page"  =>  "Order_View",
                        "list"  =>  $this->ordermodel->GetAllOrder()
                    ]);
                }
            }


        } // end class
        
    }else {
        header("Location: localhost:1000/HoangTamMobile/Home");
    } # end if ... else


?>