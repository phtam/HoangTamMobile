<?php
    header('Content-type: application/json');
    class HoangTamMobile_API extends Controller{

        protected $customermodel;
        protected $brandmodel;
        
        # Home controller and HoangTamMobile_API using web service (REST) 

        public function __construct()
        {
            $this->customermodel = $this->getModel("CustomersModel");
            $this->brandmodel = $this->getModel("BrandsModel");
        }

        public function get_JSON_Personal_Information($username = ""){
            if ($username != "" ) {
                                
                $result = $this->customermodel->GetDetailCustomer($username);

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
                    echo $json_response;

                }
            }else{
                echo null;
            }
  
        }

        public function get_JSON_Detail_Brand($id=""){
            if($id != ""){

                $result = $this->brandmodel->GetDetailBrand($id);

                if(mysqli_num_rows($result)>0){

                    $row = mysqli_fetch_array($result);

                    $response['brd_id']     = $row['brd_id'];
                    $response['brd_name']   = $row['brd_name'];
                    $response['brd_desc']   = $row['brd_desc'];

                    $json_response = json_encode($response);
                    echo $json_response;
                }
            }else{
                echo null;
            }
            
        }

        
        
        
    } #end controller



?>