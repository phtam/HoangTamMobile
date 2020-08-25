<?php

    class CustomersModel extends DB 
    {
        function GetAllCustomer()
        {
            $sql = "SELECT `cus_username`, `cus_name`, `cus_gender`, `cus_address`, `cus_phone_number`, `cus_email`, `cus_birthdate`, `cus_identity_card`,
             `cus_code`, `cus_status`, `cus_admin` FROM `customers`";
            
            $result = mysqli_query($this->conn, $sql);
            return  $result;
        }

        function GetDetailCustomer($username)
        {
            $sql = "SELECT `cus_username`, `cus_name`, `cus_gender`, `cus_address`, `cus_phone_number`, `cus_email`, `cus_birthdate`,
             `cus_identity_card`, `cus_code`, `cus_status`, `cus_admin` FROM `customers` WHERE `cus_username`= '$username'";
            
            $result = mysqli_query($this->conn, $sql);
            return  $result;
        }

        function UpdateCustomer($username, $name, $gender, $address, $phonenumber, $birthdate, $identitycard)
        {
            $username = mysqli_real_escape_string($this->conn, $username) ; 
            $name = mysqli_real_escape_string($this->conn, $name) ;
            $gender = mysqli_real_escape_string($this->conn, $gender) ;
            $address = mysqli_real_escape_string($this->conn, $address) ;
            $phonenumber = mysqli_real_escape_string($this->conn, $phonenumber) ;
            $birthdate = mysqli_real_escape_string($this->conn, $birthdate) ;
            $identitycard = mysqli_real_escape_string($this->conn, $identitycard) ;
            
            $sql = "UPDATE `customers` SET `cus_name`='$name',`cus_gender`= $gender,`cus_address`='$address',`cus_phone_number`='$phonenumber'
            ,`cus_birthdate`='$birthdate',`cus_identity_card`='$identitycard' WHERE `cus_username`='$username'";

            $result = mysqli_query($this->conn, $sql);
            return json_encode($result);
        }

        function AddCustomer($username, $password ,$name, $gender, $address, $phonenumber, $email, $birthdate, $identitycard, $code ,$status, $admin)
        {
            $username = mysqli_real_escape_string($this->conn, $username) ; 
            $password = mysqli_real_escape_string($this->conn, $password) ;
            $name = mysqli_real_escape_string($this->conn, $name) ;
            $gender = mysqli_real_escape_string($this->conn, $gender) ;
            $address = mysqli_real_escape_string($this->conn, $address) ;
            $phonenumber = mysqli_real_escape_string($this->conn, $phonenumber) ;
            $email = mysqli_real_escape_string($this->conn, $email) ;
            $birthdate = mysqli_real_escape_string($this->conn, $birthdate) ;
            $identitycard = mysqli_real_escape_string($this->conn, $identitycard) ;
            
            $sql = "INSERT INTO `customers`(`cus_username`, `cus_password`, `cus_name`, `cus_gender`, `cus_address`, `cus_phone_number`, `cus_email`, `cus_birthdate`, `cus_identity_card`, `cus_code`, `cus_status`, `cus_admin`) 
            VALUES ('$username', '$password' ,'$name', $gender, '$address', '$phonenumber', '$email', '$birthdate', '$identitycard', '$code', $status, $admin)";
            
            $result = mysqli_query($this->conn, $sql);
            return json_encode($result);
        }

        function DeleteCustomer($username)
        {
            $sql = "DELETE FROM `customers` WHERE `cus_username`='$username'";
            $result = mysqli_query($this->conn, $sql);

            return json_encode($result);
        }

        // Check validate username
        function CheckValidate($username)
        {
            $sql = "SELECT `cus_username` FROM `customers` WHERE `cus_username`= '$username'";
            $result = mysqli_query($this->conn, $sql);
            $rows = mysqli_num_rows($result);
            
            if($rows>0){
                return false;
            }else{
                return true;
            }
        }

        // Check validate email
        function CheckEmailValidate($email)
        {
            $sql = "SELECT `cus_username` FROM `customers` WHERE `cus_email`= '$email'";
            $result = mysqli_query($this->conn, $sql);
            $rows = mysqli_num_rows($result);
            
            if($rows>0){
                return false;
            }else{
                return true;
            }
        }

        // Check actived account
        function CheckActiveAccount($username, $code)
        {
            $sql = "SELECT `cus_username` FROM `customers` WHERE `cus_username`= '$username' AND `cus_code`='$code'";
            $result = mysqli_query($this->conn, $sql);
            $rows = mysqli_num_rows($result);
            
            if($rows==1){
                return true;
            }else{
                return false;
            }
        }

        // Active account
        function ActiveAccount($username){
            $sql = "UPDATE `customers` SET `cus_status`= 0 WHERE `cus_username`='$username'";

            $result = mysqli_query($this->conn, $sql);
            return json_encode($result);
        }

        function LogIn($username, $password){
            $username = mysqli_real_escape_string($this->conn, $username); // ngăn chặn sql injection
            $password = mysqli_real_escape_string($this->conn, $password); // ngăn chặn sql injection

            $sql = "SELECT * FROM `customers` WHERE `cus_username`= '$username' AND `cus_password`='$password'";

            $result = mysqli_query($this->conn, $sql);
            
            if(mysqli_num_rows($result)>0){
                return json_encode(true);
            }else{
                return json_encode(false);
            }
        }

        // Check Role
        function check_Acticed($username){
            $sql = "SELECT * FROM `customers` WHERE `cus_username`= '$username' AND `cus_status`=0";
            $result = mysqli_query($this->conn, $sql);
            
            if(mysqli_num_rows($result)>0){
                return json_encode(true);
            }else{
                return json_encode(false);
            }
        }

        // Get Info
        function GetInfo($username)
        {
            $sql = "SELECT `cus_username`, `cus_name`, `cus_gender`, `cus_address`, `cus_phone_number`, `cus_email`, `cus_birthdate`,
             `cus_identity_card` FROM `customers` WHERE `cus_username`= '$username'";
            
            $result = mysqli_query($this->conn, $sql);
            return  $result;
        }

        function CheckPassword($username, $password)
        {
            $password = md5($password);
            $sql = "SELECT `cus_password` FROM `customers` WHERE `cus_username`= '$username' AND `cus_password`= '$password' ";
            $result = mysqli_query($this->conn, $sql);
         
            if(mysqli_num_rows($result)>0){
                return json_encode(true);
            }else{
                return json_encode(false);
            }
        }

        function ChangePassword($username, $password)
        {
            $password = mysqli_real_escape_string($this->conn, md5($password));
            $sql = "UPDATE `customers` SET `cus_password`= '$password' WHERE `cus_username`= '$username'";
            $result = mysqli_query($this->conn, $sql);
            return json_encode($result);
        }


    }
    

?>